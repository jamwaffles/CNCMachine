use control_box_common::Outputs;
use futures_lite::StreamExt;
use linuxcnc_hal::{
    error::PinRegisterError,
    hal_pin::{InputPin, OutputPin},
    prelude::*,
    HalComponent, RegisterResources, Resources,
};
use postcard::accumulator::{CobsAccumulator, FeedResult};
use smol::prelude::*;
use std::os::fd::AsRawFd;
use std::{error::Error, io};
use std::{
    os::fd::{FromRawFd, OwnedFd},
    time::Duration,
};

const BUF_SIZE: usize = 1024;

struct Pins {
    encoder1: InputPin<u32>,
}

impl Resources for Pins {
    type RegisterError = PinRegisterError;

    fn register_resources(comp: &RegisterResources) -> Result<Self, Self::RegisterError> {
        Ok(Pins {
            encoder1: comp.register_pin::<InputPin<u32>>("encoder-1")?,
        })
    }
}

fn main() -> Result<(), Box<dyn Error>> {
    rtapi_logger::init().ok();

    let port_name = std::env::args()
        .nth(1)
        .expect("Port name/path required, e.g. /dev/ttyACM0");
    let baud_rate = 115200;

    let comp: HalComponent<Pins> = HalComponent::new("control-box")?;

    let pins = comp.resources();

    let mut port = serialport::new(port_name.clone(), baud_rate)
        .timeout(Duration::from_millis(10))
        .open()
        .expect("Failed to open port");

    println!("Receiving data on {} at {} baud:", &port_name, &baud_rate);

    // let async_port =
    //     smol::Async::new_nonblocking(unsafe { OwnedFd::from_raw_fd(port.as_raw_fd()) })?;

    let mut cobs_buf: CobsAccumulator<BUF_SIZE> = CobsAccumulator::new();
    let mut raw_buf = [0u8; BUF_SIZE];

    smol::block_on(async {
        // while let Ok(n) = async_port
        //     .read_with(|t| rustix::io::read(t, &mut raw_buf).map_err(io::Error::from))
        //     .await
        // {
        //     let mut window = &raw_buf[0..n];

        //     'cobs: while !window.is_empty() {
        //         window = match cobs_buf.feed::<Outputs>(&window) {
        //             FeedResult::Consumed => break 'cobs,
        //             FeedResult::OverFull(new_wind) => new_wind,
        //             FeedResult::DeserError(new_wind) => new_wind,
        //             FeedResult::Success { data, remaining } => {
        //                 println!("{:?}", data);

        //                 remaining
        //             }
        //         };
        //     }
        // }

        while !comp.should_exit() {
            let buf = match port.read(&mut raw_buf) {
                Ok(ct) => &raw_buf[..ct],
                Err(ref e) if e.kind() == io::ErrorKind::TimedOut => continue,
                Err(ref e) if e.kind() == io::ErrorKind::BrokenPipe => {
                    panic!("Broken pipe")
                }
                Err(e) => {
                    eprintln!("{}", e);
                    continue;
                }
            };

            let mut window = &buf[..];

            'cobs: while !window.is_empty() {
                window = match cobs_buf.feed::<Outputs>(&window) {
                    FeedResult::Consumed => break 'cobs,
                    FeedResult::OverFull(new_wind) => new_wind,
                    FeedResult::DeserError(new_wind) => new_wind,
                    FeedResult::Success { data, remaining } => {
                        println!("{:?}", data);

                        remaining
                    }
                };
            }
        }
    });

    Ok(())
}
