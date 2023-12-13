# Notes 

```
ethercat -p 1 upload 0x608f 01 --type uint32
--> 8388608 encoder counts per rev

ethercat -p 1 upload 0x6091 01 --type uint32
ethercat -p 1 upload 0x6091 02 --type uint32
--> electronic gear ratio is 1/1000

ethercat -p 1 upload 0x6092 01 --type uint32
--> pulses per rotation is 10000
--> this is the value set to be used in the INI file
```

# Torque mode

**Does not work with CiA402 component**

Torque mode moves all control to lcnc. Thread here <https://forum.linuxcnc.org/12-milling/27653-analog-servos-torque-mode-velocity-mode-both?start=20>.

- 3KHz servo thread.
- `pid.0.feedback-deriv` connected to the velocity output of the 7i77 encoder
- `pid.0.error-previous-target` set to `1`.

	From [`pid`](http://linuxcnc.org/docs/html/man/man9/pid.9.html):

	> Use previous invocation’s target vs. current position for error calculation, like the motion controller expects. This may make torque-mode position loops and loops requiring a large I gain easier to tune, by eliminating velocity-dependent following error.

# Leadshine MotionStudio

Add `contrib` to Debian sources.

Download MotionStudio v2 beta blabla

`sudo usermod -a -G dialout linuxcnc`

```bash
WINEARCH=win32 winetricks -q vb6run comctl32ocx mdac28 msxml6 dotnet35sp1 dsdmo jet40 dotnet20sp2
```