#![no_std]
#![no_main]

use control_box_common::Outputs;
use core::sync::atomic::{AtomicBool, Ordering};
use defmt_rtt as _;
use embassy_executor::Spawner;
use embassy_futures::join::join;
use embassy_stm32::{
    bind_interrupts,
    exti::ExtiInput,
    gpio::{Input, Level, Output, Pull, Speed},
    peripherals::{self, PA0, PA1},
    time::Hertz,
    timer::qei::{Direction, Qei, QeiPin},
    usb::{self, Driver},
    Config,
};
use embassy_time::{Duration, Ticker, Timer};
use embassy_usb::{
    class::cdc_acm::{CdcAcmClass, State},
    driver::EndpointError,
    Builder,
};
use embedded_hal::digital::OutputPin;
use panic_probe as _;

const VID: u16 = 0xaabb;
const PID: u16 = 0xccdd;

static ENCODER_BUTTON1: AtomicBool = AtomicBool::new(false);
static ENCODER_BUTTON2: AtomicBool = AtomicBool::new(false);

bind_interrupts!(struct Irqs {
    USB_LP_CAN1_RX0 => usb::InterruptHandler<peripherals::USB>;
});

#[embassy_executor::task]
async fn heartbeat_task(mut led: impl OutputPin + 'static) -> ! {
    loop {
        let _ = led.set_low();
        Timer::after(Duration::from_millis(200)).await;

        let _ = led.set_high();
        Timer::after(Duration::from_millis(800)).await;
    }
}

#[embassy_executor::task]
async fn button1_task(mut button1: ExtiInput<'static, PA0>) -> ! {
    loop {
        button1.wait_for_any_edge().await;

        // Active low
        let state = !button1.is_high();

        defmt::info!("B1 changed to {}", state);

        ENCODER_BUTTON1.store(state, Ordering::Relaxed);
    }
}

#[embassy_executor::task]
async fn button2_task(mut button2: ExtiInput<'static, PA1>) -> ! {
    loop {
        button2.wait_for_any_edge().await;

        // Active low
        let state = !button2.is_high();

        defmt::info!("B2 changed to {}", state);

        ENCODER_BUTTON2.store(state, Ordering::Relaxed);
    }
}

#[embassy_executor::main]
async fn main(spawner: Spawner) {
    let mut config = Config::default();
    config.rcc.hse = Some(Hertz(8_000_000));
    config.rcc.sys_ck = Some(Hertz(48_000_000));
    config.rcc.pclk1 = Some(Hertz(24_000_000));
    let mut p = embassy_stm32::init(config);

    defmt::info!("Starting up");

    {
        // BluePill board has a pull-up resistor on the D+ line.
        // Pull the D+ pin down to send a RESET condition to the USB bus.
        // This forced reset is needed only for development, without it host
        // will not reset your device when you upload new firmware.
        let _dp = Output::new(&mut p.PA12, Level::Low, Speed::Low);
        Timer::after_millis(10).await;
    }

    // Create the driver, from the HAL.
    let driver = Driver::new(p.USB, Irqs, p.PA12, p.PA11);

    // Create embassy-usb Config
    let config = embassy_usb::Config::new(VID, PID);

    // Create embassy-usb DeviceBuilder using the driver and config.
    // It needs some buffers for building the descriptors.
    let mut device_descriptor = [0; 256];
    let mut config_descriptor = [0; 256];
    let mut bos_descriptor = [0; 256];
    let mut control_buf = [0; 7];

    let mut state = State::new();

    let mut builder = Builder::new(
        driver,
        config,
        &mut device_descriptor,
        &mut config_descriptor,
        &mut bos_descriptor,
        &mut [], // no msos descriptors
        &mut control_buf,
    );

    // Create classes on the builder.
    let mut class = CdcAcmClass::new(&mut builder, &mut state, 64);

    // Build the builder.
    let mut usb = builder.build();

    // Run the USB device.
    let usb_fut = usb.run();

    // // Do stuff with the class!
    // let echo_fut = async {
    //     loop {
    //         class.wait_connection().await;
    //         defmt::info!("Connected");
    //         let _ = echo(&mut class).await;
    //         defmt::info!("Disconnected");
    //     }
    // };

    // Black pill/blue pill user LED on PC13, active low
    // let led = Output::new(p.PC13, Level::Low, Speed::Low);
    // Or for the black version of the blue pill with mounting holes
    let mut led = Output::new(p.PB12, Level::High, Speed::Low);

    let encoder1 = Qei::new(p.TIM1, QeiPin::new_ch1(p.PA8), QeiPin::new_ch2(p.PA9));
    let encoder2 = Qei::new(p.TIM3, QeiPin::new_ch1(p.PA6), QeiPin::new_ch2(p.PA7));

    let button1 = Input::new(p.PA0, Pull::Down);
    let button1 = ExtiInput::new(button1, p.EXTI0);
    let button2 = Input::new(p.PA1, Pull::Down);
    let button2 = ExtiInput::new(button2, p.EXTI1);

    // defmt::unwrap!(spawner.spawn(heartbeat_task(led)));
    defmt::unwrap!(spawner.spawn(button1_task(button1)));
    defmt::unwrap!(spawner.spawn(button2_task(button2)));

    defmt::info!("Begin loop");

    let mut ticker = Ticker::every(Duration::from_millis(5));

    let mut prev = Outputs::default();

    let encoder_task = async {
        let mut out_buf = [0u8; 256];

        loop {
            defmt::info!("Waiting for connection");

            class.wait_connection().await;

            defmt::info!("USB is connected");

            // let dir1 = match encoder1.read_direction() {
            //     Direction::Upcounting => "↑",
            //     Direction::Downcounting => "↓",
            // };
            // let dir2 = match encoder2.read_direction() {
            //     Direction::Upcounting => "↑",
            //     Direction::Downcounting => "↓",
            // };

            // Divide by 4 because quadrature
            // defmt::info!(
            //     "{} {} | {} {}",
            //     encoder1.count() / 4,
            //     dir1,
            //     encoder2.count() / 4,
            //     dir2
            // );

            // ENCODER1.store(encoder1.count(), Ordering::Relaxed);
            // ENCODER2.store(encoder2.count(), Ordering::Relaxed);

            loop {
                let data = Outputs {
                    encoder1: encoder1.count(),
                    encoder2: encoder2.count(),
                    encoder1_up: matches!(encoder1.read_direction(), Direction::Upcounting),
                    encoder2_up: matches!(encoder2.read_direction(), Direction::Upcounting),
                    encoder_button1: ENCODER_BUTTON1.load(Ordering::Relaxed),
                    encoder_button2: ENCODER_BUTTON2.load(Ordering::Relaxed),
                };

                if data == prev {
                    continue;
                }

                if let Ok(send) = data.encode(&mut out_buf) {
                    if let Err(EndpointError::Disabled) = class.write_packet(send).await {
                        defmt::info!("USB is disconnected");

                        // Turn off
                        led.set_high();

                        break;
                    } else {
                        led.toggle();
                    }

                    prev = data;
                }

                ticker.next().await;
            }
        }
    };

    join(encoder_task, usb_fut).await;
}

// struct Disconnected {}

// impl From<EndpointError> for Disconnected {
//     fn from(val: EndpointError) -> Self {
//         match val {
//             EndpointError::BufferOverflow => panic!("Buffer overflow"),
//             EndpointError::Disabled => Disconnected {},
//         }
//     }
// }

// async fn echo<'d, T: Instance + 'd>(
//     class: &mut CdcAcmClass<'d, Driver<'d, T>>,
// ) -> Result<(), Disconnected> {
//     let mut buf = [0; 64];
//     let mut out_buf = [0u8; 128];

//     loop {
//         let n = class.read_packet(&mut buf).await?;

//         let data = &buf[..n];

//         defmt::info!("data: {:x}", data);

//         let count = cobs::encode_with_sentinel(data, &mut out_buf, b'\n');

//         let ret = &out_buf[0..count];

//         class.write_packet(ret).await?;
//     }
// }
