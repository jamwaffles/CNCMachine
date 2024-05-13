# CNCMachine

LinuxCNC config and scripts for my DIY CNC machine

## Mount samba share

```bash
mkdir ~/GCode
# yolo
chmod 0777 ~/GCode 
sudo apt install gvfs-backends samba cifs-utils
```

Then in `/etc/fstab`:

```
//octahedron.house/gangstacode /home/james/GCode cifs username=james,password=[password],iocharset=utf8,file_mode=0777,dir_mode=0777,noperm 0 0
```