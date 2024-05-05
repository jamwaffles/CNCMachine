#![no_std]
#![no_main]

use defmt_rtt as _;
use embassy_executor::Spawner;
use embassy_stm32::exti::ExtiInput;
use embassy_stm32::gpio::Input;
use embassy_stm32::peripherals::{PA0, PA1};
use embassy_stm32::{
    gpio::{Level, Output, Pull, Speed},
    timer::qei::{Direction, Qei, QeiPin},
    Config,
};
use embassy_time::{Duration, Timer};
use embedded_hal::digital::OutputPin;
use panic_probe as _;

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
        button1.wait_for_falling_edge().await;
        defmt::info!("B1 pressed!");
        button1.wait_for_rising_edge().await;
        defmt::info!("B1 released!");
    }
}

#[embassy_executor::task]
async fn button2_task(mut button1: ExtiInput<'static, PA1>) -> ! {
    loop {
        button1.wait_for_falling_edge().await;
        defmt::info!("B2 pressed!");
        button1.wait_for_rising_edge().await;
        defmt::info!("B2 released!");
    }
}

#[embassy_executor::main]
async fn main(spawner: Spawner) {
    let config = Config::default();

    defmt::info!("Start");

    let p = embassy_stm32::init(config);

    defmt::info!("Spawning blinky");

    // Black pill/blue pill user LED on PC13, active low
    // let led = Output::new(p.PC13, Level::Low, Speed::Low);
    // Or for the black version of the blue pill with mounting holes
    let led = Output::new(p.PB12, Level::Low, Speed::Low);

    let encoder1 = Qei::new(p.TIM1, QeiPin::new_ch1(p.PA8), QeiPin::new_ch2(p.PA9));
    let encoder2 = Qei::new(p.TIM3, QeiPin::new_ch1(p.PA6), QeiPin::new_ch2(p.PA7));

    let button1 = Input::new(p.PA0, Pull::Down);
    let button1 = ExtiInput::new(button1, p.EXTI0);
    let button2 = Input::new(p.PA1, Pull::Down);
    let button2 = ExtiInput::new(button2, p.EXTI1);

    defmt::unwrap!(spawner.spawn(heartbeat_task(led)));
    defmt::unwrap!(spawner.spawn(button1_task(button1)));
    defmt::unwrap!(spawner.spawn(button2_task(button2)));

    defmt::info!("Begin loop");

    loop {
        let dir1 = match encoder1.read_direction() {
            Direction::Upcounting => "↑",
            Direction::Downcounting => "↓",
        };
        let dir2 = match encoder2.read_direction() {
            Direction::Upcounting => "↑",
            Direction::Downcounting => "↓",
        };

        // Divide by 4 because quadrature
        defmt::info!(
            "{} {} | {} {}",
            encoder1.count() / 4,
            dir1,
            encoder2.count() / 4,
            dir2
        );

        Timer::after(Duration::from_millis(25)).await;
    }
}
