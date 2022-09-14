# CNCMachine

LinuxCNC config and scripts for my DIY CNC machine

## Install

All the files in `./hm2` need to be copied to `/lib/firmware/hm2`.

## LinuxCNC build

```bash
git checkout 750a46e460b612c62d390f317730d05e4a24cb34
./autogen.sh
./configure --with-realtime=uspace --with-python=python3 --with-boost-python=boost_python3-py39 --enable-non-distributable=yes
make -j3
sudo make setuid
```
