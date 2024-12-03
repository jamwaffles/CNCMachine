use control_box_common::Outputs;
use linuxcnc_hal::{
    error::PinRegisterError,
    hal_pin::{InputPin, OutputPin},
    prelude::*,
    HalComponent, RegisterResources, Resources,
};
use postcard::accumulator::{CobsAccumulator, FeedResult};
use std::time::Duration;
use std::{error::Error, io};

const BUF_SIZE: usize = 1024;

struct Pins {
    feed_override_scale: OutputPin<f64>,
    rapid_override_scale: OutputPin<f64>,
    feed_override_value: InputPin<f64>,
    encoder1: OutputPin<i32>,
    encoder1_button: OutputPin<bool>,
    encoder2: OutputPin<i32>,
    encoder2_button: OutputPin<bool>,
}

impl Resources for Pins {
    type RegisterError = PinRegisterError;

    fn register_resources(comp: &RegisterResources) -> Result<Self, Self::RegisterError> {
        Ok(Pins {
            feed_override_scale: comp.register_pin::<OutputPin<f64>>("feed-override-scale")?,
            rapid_override_scale: comp.register_pin::<OutputPin<f64>>("rapid-override-scale")?,
            feed_override_value: comp.register_pin::<InputPin<f64>>("feed-override-value")?,
            encoder1: comp.register_pin::<OutputPin<i32>>("encoder-1")?,
            encoder1_button: comp.register_pin::<OutputPin<bool>>("encoder-1-button")?,
            encoder2: comp.register_pin::<OutputPin<i32>>("encoder-2")?,
            encoder2_button: comp.register_pin::<OutputPin<bool>>("encoder-2-button")?,
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

    port.clear(serialport::ClearBuffer::All)?;

    println!("Receiving data on {} at {} baud:", &port_name, &baud_rate);

    let mut cobs_buf: CobsAccumulator<BUF_SIZE> = CobsAccumulator::new();
    let mut raw_buf = [0u8; BUF_SIZE];

    // // Demo of reading values from INI file
    // {
    //     let ini_path = env::var("INI_FILE_NAME")?;
    //     let mut ini = configparser::ini::Ini::new();
    //     ini.load(ini_path)?;
    //     let feed_override_max = ini.getfloat("DISPLAY", "MAX_FEED_OVERRIDE")?.unwrap_or(1.0);
    //     dbg!(feed_override_max);
    // }

    let mut encoder1_prev = None;
    let mut encoder1_value = 0i32;
    let mut encoder2_prev = None;
    let mut encoder2_value = 0i32;

    // 5% for every detent
    pins.feed_override_scale.set_value(0.05)?;
    pins.rapid_override_scale.set_value(0.05)?;

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
                    // Feed override slider
                    {
                        let prev = *encoder1_prev.get_or_insert(data.encoder1);
                        let new = data.encoder1;

                        let diff = i32::from(new) - i32::from(prev);

                        let wrapped = diff.abs() > i32::from(u16::MAX / 2);

                        let res = if wrapped {
                            diff - i32::from(u16::MAX) * diff.signum()
                        } else {
                            diff
                        };

                        // + or - here inverts direction
                        encoder1_value -= res;

                        // Divide by 4 because quadrature encoder
                        pins.encoder1.set_value(encoder1_value / 4)?;

                        encoder1_prev = Some(new);
                    }

                    // Feed override reset
                    {
                        pins.encoder1_button.set_value(data.encoder_button1)?;
                    }

                    // Rapid override slider
                    {
                        let prev = *encoder2_prev.get_or_insert(data.encoder2);
                        let new = data.encoder2;

                        let diff = i32::from(new) - i32::from(prev);

                        let wrapped = diff.abs() > i32::from(u16::MAX / 2);

                        let res = if wrapped {
                            diff - i32::from(u16::MAX) * diff.signum()
                        } else {
                            diff
                        };

                        // + or - here inverts direction
                        encoder2_value -= res;

                        // Divide by 4 because quadrature encoder
                        pins.encoder2.set_value(encoder2_value / 4)?;

                        encoder2_prev = Some(new);
                    }

                    // Rapid override reset
                    {
                        pins.encoder2_button.set_value(data.encoder_button2)?;
                    }

                    remaining
                }
            };
        }
    }

    Ok(())
}
