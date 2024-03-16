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

# A bit of progress

Latest and greatest:

```
[ 5216.664882] EtherCAT: Requesting master 0...
[ 5216.664886] EtherCAT: Successfully requested master 0.
[ 5216.665566] EtherCAT 0: Domain0: Logical address 0x00000000, 97 byte, expected working counter 14.
[ 5216.665568] EtherCAT 0:   Datagram domain0-0-main: Logical offset 0x00000000, 97 byte, type LRW.
[ 5216.665580] EtherCAT 0: Master thread exited.
[ 5216.665581] EtherCAT 0: Stopping EoE thread.
[ 5216.665589] EtherCAT 0: EoE thread exited.
[ 5216.665590] EtherCAT 0: Starting EoE thread.
[ 5216.665635] EtherCAT 0: Starting EtherCAT-OP thread.
[ 5216.665665] EtherCAT WARNING 0: 1 datagram TIMED OUT!
[ 5216.665667] EtherCAT WARNING 0: 1 datagram UNMATCHED!
[ 5222.049852] EtherCAT WARNING 0-0: Slave did not sync after 5000 ms.
[ 5227.257843] EtherCAT WARNING 0-1: Slave did not sync after 5000 ms.
[ 5232.441586] EtherCAT WARNING 0-2: Slave did not sync after 5000 ms.
[ 5232.662095] EtherCAT ERROR 0-5: Mailbox error response received - Unknown error reply code 0x0000.
[ 5232.662101] EtherCAT WARNING 0-5: Invalid mailbox response for eoe0s5.
[ 5232.718108] EtherCAT ERROR 0-5: Mailbox error response received - Unknown error reply code 0x0000.
[ 5232.718113] EtherCAT WARNING 0-5: Invalid mailbox response for eoe0s5.
[ 5232.758105] EtherCAT ERROR 0-5: Mailbox error response received - Unknown error reply code 0x0000.
[ 5232.758112] EtherCAT WARNING 0-5: Invalid mailbox response for eoe0s5.
[ 5232.838118] EtherCAT ERROR 0-5: Mailbox error response received - Unknown error reply code 0x0000.
[ 5232.838124] EtherCAT WARNING 0-5: Invalid mailbox response for eoe0s5.
[ 5232.862152] EtherCAT ERROR 0-5: Mailbox error response received - Unknown error reply code 0x0000.
[ 5232.862183] EtherCAT WARNING 0-5: Invalid mailbox response for eoe0s5.
[ 5232.878123] EtherCAT WARNING 0-5: Other mailbox protocol response for eoe0s5.
[ 5232.878648] EtherCAT ERROR 0-5: Reception of CoE download response failed: No response.
[ 5232.878657] EtherCAT WARNING 0-5: Failed to set number of assigned PDOs of SM2.
[ 5232.878658] EtherCAT WARNING 0-5: Currently assigned PDOs: (none). PDOs to assign: 0x1600
[ 5232.878664] EtherCAT WARNING 0-5: PDO configuration failed.
[ 5232.909607] EtherCAT 0: Slave states on main device: OP.
[ 5243.373563] EtherCAT WARNING 0-5: Failed to receive mbox check datagram for eoe0s5.
[ 5243.697557] EtherCAT WARNING 0: 1 datagram TIMED OUT!
```