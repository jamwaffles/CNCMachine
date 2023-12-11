# Notes 

```
ethercat upload 0x608f 01 --type uint32
--> 8388608 encoder counts per rev

ethercat upload 0x6091 01 --type uint32
ethercat upload 0x6091 02 --type uint32
--> electronic gear ratio is 1/1000

ethercat upload 0x6092 01 --type uint32
--> pulses per rotation is 10000
--> this is the value set to be used in the INI file
```