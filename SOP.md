# Tool offsets general info

Tool offsets are relative to spindle nose

The `G59.3` WCS is used for all toolsetting operations and is persisted in `linuxcnc.var`.

# Set toolsetter position

1. Probe toolsetter XY position
  - Make sure **spindle probe** is plugged in
  - `t99m6g43` to use spindle probe
  - Open (not sub call) `probe-toolsetter.ngc`
  - Position probe tip just above approximate XY zero of toolsetter
  - Make sure you're on G59.3
  - Zero all axes for G59.3
  - Run program, follow on-screen prompts
1. Probe spindle nose to establish Z zero offset
  - Make sure **toolsetter** is plugged in
  - `t0m6g43` to clear tool
  - `g59.3` to make sure we're in the right coordinate system
  - Move nose just above toolsetter
  - `o<probe-spindle-nose> call`
  - This re-establishes 0 offset after homing, crash, etc
  - Check an existing known-length tool if there are any

If you probe the toolsetter XY again, you MUST run the spindle nose probe otherwise the Z offset will be incorrect.

# Set touch probe length offset

Make sure the above section is done.

This is a bit more special than a normal tool as it requires the touch probe to act as the toolsetter

- Make sure **spindle probe** is plugged in
- Make sure spindle probe has approximate tool length OR YOU WILL CRASH
- `t99m6g43` to use spindle probe
- Hold toolsetter to stop it depressing
- `o<probe-tool> call`
- Spindle probe offset is now stored

# Probing tool offsets

Make sure the **two** above sections are done

- If machine has been re-homed, the spindle nose zero needs to be reset. XY toolsetter are probably close enough.
  - Make sure **toolsetter** is plugged in
  - `t0m6g43` to clear tool
  - Move nose just above toolsetter
  - `o<probe-spindle-nose> call`
- Edit tool table and enter rough tool offset, rounding up to the nearest millimetre.
- Insert tool with `tNm6g43`
- `o<probe-tool> call`
- Tool offset is now set
