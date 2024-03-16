`ethercat pdos`:

```
=== Master 0, Slave 5 ===
SM0: PhysAddr 0x1800, DefaultSize 1024, ControlRegister 0x26, Enable 1
SM1: PhysAddr 0x1c00, DefaultSize 1024, ControlRegister 0x22, Enable 1
SM2: PhysAddr 0x1100, DefaultSize    0, ControlRegister 0x24, Enable 1
  RxPDO 0x1600 ""
    PDO entry 0x6040:00, 16 bit, ""
  RxPDO 0x1601 ""
    PDO entry 0x6040:00, 16 bit, ""
    PDO entry 0x6060:00,  8 bit, ""
  RxPDO 0x1602 ""
    PDO entry 0x6040:00, 16 bit, ""
    PDO entry 0x607a:00, 32 bit, ""
  RxPDO 0x1603 ""
    PDO entry 0x6040:00, 16 bit, ""
    PDO entry 0x60ff:00, 32 bit, ""
SM3: PhysAddr 0x1140, DefaultSize    0, ControlRegister 0x20, Enable 1
  TxPDO 0x1a00 ""
    PDO entry 0x6041:00, 16 bit, ""
  TxPDO 0x1a01 ""
    PDO entry 0x6041:00, 16 bit, ""
    PDO entry 0x6061:00,  8 bit, ""
  TxPDO 0x1a02 ""
    PDO entry 0x6041:00, 16 bit, ""
    PDO entry 0x6064:00, 32 bit, ""
  TxPDO 0x1a03 ""
    PDO entry 0x6041:00, 16 bit, ""
    PDO entry 0x606c:00, 32 bit, ""
```

Tried to configure with:

```xml
<syncManager idx="2" dir="out">
  <pdo idx="1601">
    <pdoEntry idx="6040" subIdx="00" bitLen="16" halPin="cia-controlword" halType="u32" />
    <pdoEntry idx="6060" subIdx="00" bitLen="8" halPin="opmode" halType="s32"/>
    <!-- <pdoEntry idx="60FF" subIdx="00" bitLen="32" halPin="target-velocity" halType="s32"/> -->
    <!-- <pdoEntry idx="607A" subIdx="00" bitLen="32" halPin="target-position" halType="s32"/> -->
  </pdo>
  <pdo idx="1603">
    <!-- <pdoEntry idx="6040" subIdx="00" bitLen="16" halPin="cia-controlword" halType="u32" /> -->
    <!-- <pdoEntry idx="6060" subIdx="00" bitLen="32" halPin="opmode" halType="s32"/> -->
    <pdoEntry idx="60FF" subIdx="00" bitLen="32" halPin="target-velocity" halType="s32"/>
    <!-- <pdoEntry idx="607A" subIdx="00" bitLen="32" halPin="target-position" halType="s32"/> -->
  </pdo>
</syncManager>
<syncManager idx="3" dir="in">
  <pdo idx="1a01">
    <pdoEntry idx="6061" subIdx="00" bitLen="8" halPin="opmode-display" halType="s32"/>
    <!-- <pdoEntry idx="6041" subIdx="00" bitLen="16" halPin="cia-statusword" halType="u32"/> -->
    <!-- <pdoEntry idx="606C" subIdx="00" bitLen="32" halPin="actual-velocity" halType="s32"/> -->
    <!-- <pdoEntry idx="6063" subIdx="00" bitLen="32" halPin="actual-position" halType="s32"/> -->
  </pdo>
  <pdo idx="1a03">
    <pdoEntry idx="6041" subIdx="00" bitLen="16" halPin="cia-statusword" halType="u32"/>
    <pdoEntry idx="606C" subIdx="00" bitLen="32" halPin="actual-velocity" halType="s32"/>
    <!-- <pdoEntry idx="6063" subIdx="00" bitLen="32" halPin="actual-position" halType="s32"/> -->
  </pdo>
</syncManager>
```

but dmesg says

```
[ 4025.615692] EtherCAT ERROR 0-5: Failed to set SAFEOP state, slave refused state change (PREOP + ERROR).
[ 4025.615955] EtherCAT ERROR 0-5: AL status message 0x001D: "Invalid output configuration".
```