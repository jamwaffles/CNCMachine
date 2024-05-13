# Kollmorgen AKD

IgH master starts EoE network device by default. This seems to mess up AKD SDO reads/writes, so you gotta disable it by building from source.

```bash
git clone https://gitlab.com/etherlab.org/ethercat.git igh-ethercat
cd igh-ethercat
git checkout stable-1.5

# https://gitlab.com/etherlab.org/ethercat/-/blob/master/INSTALL.md?ref_type=heads
./bootstrap
# --disable-8139too is for kernel 6.6
# --disable-eoe is the important bit!
# --enable-igc is for Intel i211 NIC, but I ended up just using the `generic` driver anyway
# --enable-e1000e is for 82579LM on Dell Optiplex motherboard
./configure --enable-igc --enable-e100e --sysconfdir=/etc --disable-8139too --disable-eoe
make all modules
sudo make modules_install install
sudo depmod

vim /etc/ethercat.conf
```

Find out which driver a device is using with `sudo lshw -class network`. 

**NOTE:** The `e1000e` driver seems to be very jittery, so just use `generic`.

This also needs a custom build of `linuxcnc-ethercat` with this pasted into `src/realtime.mk`:

```makefile
include ../config.mk
include Kbuild

cc-option = $(shell if $(CC) $(CFLAGS) $(1) -S -o /dev/null -xc /dev/null \
						> /dev/null 2>&1; then echo "$(1)"; else echo "$(2)"; fi ;)

.PHONY: all clean install

ifeq ($(BUILDSYS),kbuild)

module = $(patsubst %.o,%.ko,$(obj-m))

ifeq (,$(findstring -Wframe-larger-than=,$(EXTRA_CFLAGS)))
	EXTRA_CFLAGS += $(call cc-option,-Wframe-larger-than=2560)
endif

$(module):
	$(MAKE) EXTRA_CFLAGS="$(EXTRA_CFLAGS)" KBUILD_EXTRA_SYMBOLS="$(RTLIBDIR)/Module.symvers $(RTAIDIR)/modules/ethercat/Module.symvers" -C $(KERNELDIR) SUBDIRS=`pwd` CC=$(CC) V=0 modules

clean::
	rm -f $(obj-m)
	rm -f *.mod.c .*.cmd
	rm -f modules.order Module.symvers
	rm -rf .tmp_versions

else

module = $(patsubst %.o,%.so,$(obj-m))

EXTRA_CFLAGS := $(filter-out -Wframe-larger-than=%,$(EXTRA_CFLAGS))

$(module): $(lcec-objs)
	$(CC) -shared -o $@ $(lcec-objs) -Wl,-rpath,$(LIBDIR) -L$(LIBDIR) -llinuxcnchal -lethercat -lrt

%.o: %.c
	$(CC) -o $@ $(EXTRA_CFLAGS) -Os -c $<

endif

all: $(module)

clean::
	rm -f $(module)
	rm -f $(lcec-objs)

install: $(module)
	mkdir -p $(DESTDIR)$(RTLIBDIR)
	cp $(module) $(DESTDIR)$(RTLIBDIR)/
```

Otherwise you get `undefined symbol: ecrt_slave_config_sdo`. The solution is from [here](https://www.forum.linuxcnc.org/9-installing-linuxcnc/41983-linuxcnc-ethercat-undefined-symbol-ecrt-slave-config-sdo#203252)

If you get "missing sperator" errors during `make`, ensure that the file is tab-indented. Space indentation is the cause of this error.

## Cycle time

Cycle times MUST match! LinuxCNC defaults to 1ms, AKD to 2ms. It is imperitive they are the same otherwise the drive won't go into CiA402 op. 1ms is set as such:

```xml
<!-- Set Cycle Time (u8) -->
<sdoConfig idx="60C2" subIdx="01">
  <sdoDataRaw data="01"/>
</sdoConfig>
<!-- Set Cycle exp (i8) -->
<sdoConfig idx="60C2" subIdx="02">
 <sdoDataRaw data="FD"/>
</sdoConfig>
```

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

