# Setting tool offsets

Tool offsets are relative to spindle nose

The `G59.3` WCS is used for all toolsetting operations and is persisted in `linuxcnc.var`.

## Updating toolsetter position

Every tool setting session must begin with a toolsetter offset after every home as the home
positions will vary slightly.

- Remove any tools from the spindle `t0 m6 g43`
- Insert spindle probe and plug it in
- Move to rough toolsetter position `g59.3 x0 y0` (assumes previously set coords are close enough)
- Move probe tip to just above center of toolsetter and zero Z
- `o<probe-toolsetter> call`
  - Follow on-screen prompts

## Probing spindle nose

- Current WCS and position don't matter
- Make sure toolsetter is plugged in
- Remove any tools from the spindle `t0 m6 g43`
- Move spindle nose (avoiding drive dogs) to just above toolsetter
- `o<probe-spindle-nose> call`
- This sets `g59.3` Z offset

## With no existing tool offsets

- Make sure the toolsetter and spindle nose have been probed beforehand
- Make sure toolsetter is plugged in
- Remove any tools from the spindle
- Edit the tool table
  - Add the new tool
  - Add a POSITIVE Z length which is the approximate length of the tool from the BT30 gauge line
  - Save, reload, reread
- Change to the new tool with `tN m6 g43`

## With existing known accurate tool offsets

- TODO
