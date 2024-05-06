use control_box_common::Outputs;
use postcard::accumulator::{CobsAccumulator, FeedResult};
use std::io;
use std::time::Duration;

const BUF_SIZE: usize = 1024;

fn main() {
    let port_name = "/dev/ttyACM2";
    let baud_rate = 115200;

    let port = serialport::new(port_name, baud_rate)
        .timeout(Duration::from_millis(10))
        .open();

    match port {
        Ok(mut port) => {
            println!("Receiving data on {} at {} baud:", &port_name, &baud_rate);

            let mut cobs_buf: CobsAccumulator<BUF_SIZE> = CobsAccumulator::new();
            let mut raw_buf = [0u8; BUF_SIZE];

            loop {
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
        }
        Err(e) => {
            eprintln!("Failed to open \"{}\". Error: {}", port_name, e);
            ::std::process::exit(1);
        }
    }
}
