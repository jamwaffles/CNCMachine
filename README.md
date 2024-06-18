# CNCMachine

LinuxCNC config and scripts for my DIY CNC machine

## NFS

<https://askubuntu.com/questions/7117/which-to-use-nfs-or-samba>

Better than Samba. `sudo apt install nfs-common`

In `/etc/fstab`:

```
192.168.0.9:/media/gangstacode  /home/james/GCode  nfs auto,_netdev,rw,hard,intr 0 0
```

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