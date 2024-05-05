#![no_std]
#![no_main]

use defmt_rtt as _;
use embassy_executor::Spawner;
use embassy_stm32::{
    gpio::{Level, Output, Speed},
    Config,
};
use embassy_time::{Duration, Timer};
use embedded_hal::digital::OutputPin;
use panic_probe as _;

#[embassy_executor::task]
async fn blinky(mut led: impl OutputPin + 'static) -> ! {
    loop {
        defmt::info!("Tick");

        let _ = led.set_low();
        Timer::after(Duration::from_millis(200)).await;

        let _ = led.set_high();
        Timer::after(Duration::from_millis(800)).await;
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
    defmt::unwrap!(spawner.spawn(blinky(led)));

    defmt::info!("Begin loop");

    core::future::pending::<()>().await;
}
