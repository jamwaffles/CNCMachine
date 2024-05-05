#![no_std]

use core::sync::atomic::{AtomicU16, Ordering};
use serde::{Deserialize, Deserializer, Serialize, Serializer};

#[derive(Debug, Copy, Clone, serde::Serialize, serde::Deserialize)]
pub struct Outputs {
    // #[serde(
    //     serialize_with = "serialize_atomic",
    //     deserialize_with = "deserialize_atomic"
    // )]
    pub encoder1: u16,
    // #[serde(
    //     serialize_with = "serialize_atomic",
    //     deserialize_with = "deserialize_atomic"
    // )]
    pub encoder2: u16,
    pub encoder_button1: bool,
    pub encoder_button2: bool,
}

// fn serialize_atomic<S>(t: &AtomicU16, ser: S) -> Result<S::Ok, S::Error>
// where
//     S: Serializer,
// {
//     t.load(Ordering::Relaxed).serialize(ser)
// }

// fn deserialize_atomic<'de, D>(de: D) -> Result<AtomicU16, D::Error>
// where
//     D: Deserializer<'de>,
// {
//     let number = u16::deserialize(de)?;

//     Ok(AtomicU16::new(number))
// }

impl Outputs {
    pub fn encode<'buf>(&self, buf: &'buf mut [u8]) -> Result<&'buf [u8], postcard::Error> {
        let res = postcard::to_slice_cobs(self, buf)?;

        Ok(&res[..])
    }

    pub fn decode<'buf>(buf: &'buf mut [u8]) -> Result<(Self, &'buf mut [u8]), postcard::Error> {
        let res = postcard::take_from_bytes_cobs(buf)?;

        Ok(res)
    }
}
