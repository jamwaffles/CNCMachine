EESchema Schematic File Version 4
EELAYER 30 0
EELAYER END
$Descr A4 11693 8268
encoding utf-8
Sheet 1 1
Title ""
Date ""
Rev ""
Comp ""
Comment1 ""
Comment2 ""
Comment3 ""
Comment4 ""
$EndDescr
$Comp
L Device:R_Small R?
U 1 1 5ED2428F
P 5200 3100
F 0 "R?" V 5004 3100 50  0000 C CNN
F 1 "1k" V 5095 3100 50  0000 C CNN
F 2 "" H 5200 3100 50  0001 C CNN
F 3 "~" H 5200 3100 50  0001 C CNN
	1    5200 3100
	0    1    1    0   
$EndComp
$Comp
L Device:R_Small R?
U 1 1 5ED2347B
P 5200 3400
F 0 "R?" V 5004 3400 50  0000 C CNN
F 1 "3k3" V 5095 3400 50  0000 C CNN
F 2 "" H 5200 3400 50  0001 C CNN
F 3 "~" H 5200 3400 50  0001 C CNN
	1    5200 3400
	0    1    1    0   
$EndComp
Wire Wire Line
	5400 3400 5300 3400
Wire Wire Line
	5500 3400 5500 3100
Wire Wire Line
	5500 3100 5300 3100
$Comp
L Connector_Generic:Conn_02x03_Odd_Even X1
U 1 1 5ED27CCA
P 3350 3450
F 0 "X1" H 3400 3125 50  0000 C CNN
F 1 "RESOLVER" H 3400 3216 50  0000 C CNN
F 2 "" H 3350 3450 50  0001 C CNN
F 3 "~" H 3350 3450 50  0001 C CNN
	1    3350 3450
	1    0    0    1   
$EndComp
$Comp
L Connector_Generic:Conn_01x03 X2
U 1 1 5ED28516
P 2200 2350
F 0 "X2" H 2118 2025 50  0000 C CNN
F 1 "BATT" H 2118 2116 50  0000 C CNN
F 2 "" H 2200 2350 50  0001 C CNN
F 3 "~" H 2200 2350 50  0001 C CNN
	1    2200 2350
	-1   0    0    1   
$EndComp
NoConn ~ 2400 2450
$Comp
L power:GND #PWR?
U 1 1 5ED293AB
P 2750 2550
F 0 "#PWR?" H 2750 2300 50  0001 C CNN
F 1 "GND" H 2755 2377 50  0000 C CNN
F 2 "" H 2750 2550 50  0001 C CNN
F 3 "" H 2750 2550 50  0001 C CNN
	1    2750 2550
	1    0    0    -1  
$EndComp
Wire Wire Line
	2400 2350 2750 2350
Wire Wire Line
	2750 2350 2750 2550
Wire Wire Line
	5400 4200 5400 4000
$Comp
L power:GND #PWR?
U 1 1 5ED29A54
P 5250 4200
F 0 "#PWR?" H 5250 3950 50  0001 C CNN
F 1 "GND" H 5255 4027 50  0000 C CNN
F 2 "" H 5250 4200 50  0001 C CNN
F 3 "" H 5250 4200 50  0001 C CNN
	1    5250 4200
	1    0    0    -1  
$EndComp
$Comp
L power:GND #PWR?
U 1 1 5ED29E4F
P 3650 3550
F 0 "#PWR?" H 3650 3300 50  0001 C CNN
F 1 "GND" H 3655 3377 50  0000 C CNN
F 2 "" H 3650 3550 50  0001 C CNN
F 3 "" H 3650 3550 50  0001 C CNN
	1    3650 3550
	1    0    0    -1  
$EndComp
$Comp
L Connector_Generic:Conn_02x03_Odd_Even X?
U 1 1 5ED2AB12
P 5900 7000
F 0 "X?" H 5950 6675 50  0000 C CNN
F 1 "RESOLVER_WIRE" H 5950 6766 50  0000 C CNN
F 2 "" H 5900 7000 50  0001 C CNN
F 3 "~" H 5900 7000 50  0001 C CNN
	1    5900 7000
	1    0    0    1   
$EndComp
$Comp
L power:GND #PWR?
U 1 1 5ED2AED6
P 5700 7450
F 0 "#PWR?" H 5700 7200 50  0001 C CNN
F 1 "GND" H 5705 7277 50  0000 C CNN
F 2 "" H 5700 7450 50  0001 C CNN
F 3 "" H 5700 7450 50  0001 C CNN
	1    5700 7450
	1    0    0    -1  
$EndComp
$Comp
L Device:R_Small STATOR
U 1 1 5ED2B72E
P 5950 7450
F 0 "STATOR" V 5754 7450 50  0000 C CNN
F 1 "44r2" V 5845 7450 50  0000 C CNN
F 2 "" H 5950 7450 50  0001 C CNN
F 3 "~" H 5950 7450 50  0001 C CNN
	1    5950 7450
	0    1    1    0   
$EndComp
Wire Wire Line
	5850 7450 5700 7450
Wire Wire Line
	5700 7450 5700 7100
Wire Wire Line
	6050 7450 6200 7450
Wire Wire Line
	6200 7450 6200 7100
Connection ~ 5700 7450
$Comp
L Device:R_Small COIL1
U 1 1 5ED2CD04
P 5950 6550
F 0 "COIL1" V 5754 6550 50  0000 C CNN
F 1 "160r" V 5845 6550 50  0000 C CNN
F 2 "" H 5950 6550 50  0001 C CNN
F 3 "~" H 5950 6550 50  0001 C CNN
	1    5950 6550
	0    1    1    0   
$EndComp
$Comp
L Device:R_Small COIL2
U 1 1 5ED2E6EA
P 5950 6250
F 0 "COIL2" V 5754 6250 50  0000 C CNN
F 1 "160r" V 5845 6250 50  0000 C CNN
F 2 "" H 5950 6250 50  0001 C CNN
F 3 "~" H 5950 6250 50  0001 C CNN
	1    5950 6250
	0    1    1    0   
$EndComp
Wire Wire Line
	5700 6900 5600 6900
Wire Wire Line
	5600 6900 5600 6550
Wire Wire Line
	5600 6550 5850 6550
Wire Wire Line
	6050 6550 6300 6550
Wire Wire Line
	6300 6550 6300 6900
Wire Wire Line
	6300 6900 6200 6900
Wire Wire Line
	5850 6250 5550 6250
Wire Wire Line
	5550 6250 5550 7000
Wire Wire Line
	5550 7000 5700 7000
Wire Wire Line
	6050 6250 6350 6250
Wire Wire Line
	6350 6250 6350 7000
Wire Wire Line
	6350 7000 6200 7000
Text Notes 5250 7150 0    50   ~ 0
BLK/WHT
Text Notes 5250 7050 0    50   ~ 0
BLK
Text Notes 5250 6950 0    50   ~ 0
BLU
Text Notes 6400 6950 0    50   ~ 0
YEL
Text Notes 6400 7050 0    50   ~ 0
RED
Text Notes 6400 7150 0    50   ~ 0
RED/WHT
$Comp
L MCU_Microchip_PIC16:PIC16F54-ISO U?
U 1 1 5ED32A9F
P 8450 4550
F 0 "U?" H 8650 5500 50  0000 C CNN
F 1 "PIC16LC71" H 8800 5400 50  0000 C CNN
F 2 "" H 8450 4550 50  0001 C CIN
F 3 "http://ww1.microchip.com/downloads/en/DeviceDoc/41213D.pdf" H 8450 4550 50  0001 C CNN
	1    8450 4550
	1    0    0    -1  
$EndComp
$Comp
L power:GND #PWR?
U 1 1 5ED34049
P 8450 5550
F 0 "#PWR?" H 8450 5300 50  0001 C CNN
F 1 "GND" H 8455 5377 50  0000 C CNN
F 2 "" H 8450 5550 50  0001 C CNN
F 3 "" H 8450 5550 50  0001 C CNN
	1    8450 5550
	1    0    0    -1  
$EndComp
$Comp
L Regulator_Linear:L78L05_SO8 U?
U 1 1 5ED349FD
P 4350 6000
F 0 "U?" H 4350 6242 50  0000 C CNN
F 1 "L78L05_SO8" H 4350 6151 50  0000 C CNN
F 2 "Package_SO:SOIC-8_3.9x4.9mm_P1.27mm" H 4450 6200 50  0001 C CIN
F 3 "http://www.st.com/content/ccc/resource/technical/document/datasheet/15/55/e5/aa/23/5b/43/fd/CD00000446.pdf/files/CD00000446.pdf/jcr:content/translations/en.CD00000446.pdf" H 4550 6000 50  0001 C CNN
	1    4350 6000
	1    0    0    -1  
$EndComp
$Comp
L power:GND #PWR?
U 1 1 5ED3649F
P 4350 6300
F 0 "#PWR?" H 4350 6050 50  0001 C CNN
F 1 "GND" H 4355 6127 50  0000 C CNN
F 2 "" H 4350 6300 50  0001 C CNN
F 3 "" H 4350 6300 50  0001 C CNN
	1    4350 6300
	1    0    0    -1  
$EndComp
$Comp
L power:+5V #PWR?
U 1 1 5ED36A0F
P 4950 5800
F 0 "#PWR?" H 4950 5650 50  0001 C CNN
F 1 "+5V" H 4965 5973 50  0000 C CNN
F 2 "" H 4950 5800 50  0001 C CNN
F 3 "" H 4950 5800 50  0001 C CNN
	1    4950 5800
	1    0    0    -1  
$EndComp
Wire Wire Line
	4650 6000 4950 6000
Wire Wire Line
	4950 6000 4950 5800
$Comp
L IndramatResolver:X24C04S IC1
U 1 1 5ED3A323
P 7650 2550
F 0 "IC1" H 7650 3031 50  0000 C CNN
F 1 "X24C04S" H 7650 2940 50  0000 C CNN
F 2 "" H 7650 2550 50  0001 C CNN
F 3 "" H 7650 2550 50  0001 C CNN
	1    7650 2550
	1    0    0    -1  
$EndComp
Wire Wire Line
	8050 2650 8050 2850
Wire Wire Line
	8050 2850 7650 2850
$Comp
L power:GND #PWR?
U 1 1 5ED3DC88
P 7650 2850
F 0 "#PWR?" H 7650 2600 50  0001 C CNN
F 1 "GND" H 7655 2677 50  0000 C CNN
F 2 "" H 7650 2850 50  0001 C CNN
F 3 "" H 7650 2850 50  0001 C CNN
	1    7650 2850
	1    0    0    -1  
$EndComp
Connection ~ 7650 2850
$Comp
L power:+5V #PWR?
U 1 1 5ED3E515
P 7650 1950
F 0 "#PWR?" H 7650 1800 50  0001 C CNN
F 1 "+5V" H 7665 2123 50  0000 C CNN
F 2 "" H 7650 1950 50  0001 C CNN
F 3 "" H 7650 1950 50  0001 C CNN
	1    7650 1950
	1    0    0    -1  
$EndComp
Wire Wire Line
	7650 2250 7650 1950
Wire Wire Line
	7250 2650 7250 2850
Wire Wire Line
	7250 2850 7650 2850
Connection ~ 7250 2650
Wire Wire Line
	7250 2450 7250 2550
Connection ~ 7250 2550
Wire Wire Line
	7250 2550 7250 2650
Wire Wire Line
	9250 4050 9850 4050
Text GLabel 8050 2450 2    50   Input ~ 0
SDA
Text GLabel 9250 4550 2    50   Input ~ 0
SDA
Text GLabel 8050 2550 2    50   Input ~ 0
SCL
$Comp
L Device:D_Schottky_Small D?
U 1 1 5ED42439
P 3800 6000
F 0 "D?" H 3800 5793 50  0000 C CNN
F 1 "BAR18" H 3800 5884 50  0000 C CNN
F 2 "" V 3800 6000 50  0001 C CNN
F 3 "https://www.mouser.co.uk/datasheet/2/389/bar18-1848885.pdf" V 3800 6000 50  0001 C CNN
	1    3800 6000
	-1   0    0    1   
$EndComp
Wire Wire Line
	3900 6000 4050 6000
$Comp
L power:+BATT #PWR?
U 1 1 5ED469EB
P 2650 2000
F 0 "#PWR?" H 2650 1850 50  0001 C CNN
F 1 "+BATT" H 2665 2173 50  0000 C CNN
F 2 "" H 2650 2000 50  0001 C CNN
F 3 "" H 2650 2000 50  0001 C CNN
	1    2650 2000
	1    0    0    -1  
$EndComp
Wire Wire Line
	2400 2250 2650 2250
Wire Wire Line
	2650 2250 2650 2000
$Comp
L power:VDD #PWR?
U 1 1 5ED47AB1
P 5800 3400
F 0 "#PWR?" H 5800 3250 50  0001 C CNN
F 1 "VDD" H 5815 3573 50  0000 C CNN
F 2 "" H 5800 3400 50  0001 C CNN
F 3 "" H 5800 3400 50  0001 C CNN
	1    5800 3400
	1    0    0    -1  
$EndComp
$Comp
L power:VDD #PWR?
U 1 1 5ED48643
P 2300 3100
F 0 "#PWR?" H 2300 2950 50  0001 C CNN
F 1 "VDD" H 2315 3273 50  0000 C CNN
F 2 "" H 2300 3100 50  0001 C CNN
F 3 "" H 2300 3100 50  0001 C CNN
	1    2300 3100
	1    0    0    -1  
$EndComp
$Comp
L power:VDD #PWR?
U 1 1 5ED48F5C
P 3450 5700
F 0 "#PWR?" H 3450 5550 50  0001 C CNN
F 1 "VDD" H 3465 5873 50  0000 C CNN
F 2 "" H 3450 5700 50  0001 C CNN
F 3 "" H 3450 5700 50  0001 C CNN
	1    3450 5700
	1    0    0    -1  
$EndComp
Wire Wire Line
	3700 6000 3450 6000
Wire Wire Line
	3450 5700 3450 6000
$Comp
L IndramatResolver:9645H U?
U 1 1 5ED4C24B
P 5850 1550
F 0 "U?" H 5850 1600 50  0000 C CNN
F 1 "9645H" H 5850 1500 50  0000 C CNN
F 2 "" H 5500 2050 50  0001 C CNN
F 3 "" H 5700 2150 50  0001 C CNN
	1    5850 1550
	1    0    0    -1  
$EndComp
$Comp
L power:GND #PWR?
U 1 1 5ED4D37C
P 5850 2100
F 0 "#PWR?" H 5850 1850 50  0001 C CNN
F 1 "GND" H 5855 1927 50  0000 C CNN
F 2 "" H 5850 2100 50  0001 C CNN
F 3 "" H 5850 2100 50  0001 C CNN
	1    5850 2100
	1    0    0    -1  
$EndComp
Text GLabel 5100 3400 0    50   Input ~ 0
PIN2_9
Text GLabel 6150 1700 2    50   Input ~ 0
PIN2_9
Text GLabel 5100 3100 0    50   Input ~ 0
PIN4_1
Text GLabel 5550 1300 0    50   Input ~ 0
PIN4_1
Wire Wire Line
	5600 3400 5600 2850
Wire Wire Line
	5600 2850 5000 2850
Wire Wire Line
	5700 2550 5300 2550
$Comp
L Device:R_Small R?
U 1 1 5ED244B4
P 5200 2550
F 0 "R?" V 5004 2550 50  0000 C CNN
F 1 "1k" V 5095 2550 50  0000 C CNN
F 2 "" H 5200 2550 50  0001 C CNN
F 3 "~" H 5200 2550 50  0001 C CNN
	1    5200 2550
	0    1    1    0   
$EndComp
Wire Wire Line
	5700 2550 5700 3400
Text GLabel 5550 1700 0    50   Input ~ 0
PIN8_5
Text GLabel 5100 2550 0    50   Input ~ 0
PIN8_5
$Comp
L power:+5V #PWR?
U 1 1 5ED56B8E
P 5850 1100
F 0 "#PWR?" H 5850 950 50  0001 C CNN
F 1 "+5V" H 5865 1273 50  0000 C CNN
F 2 "" H 5850 1100 50  0001 C CNN
F 3 "" H 5850 1100 50  0001 C CNN
	1    5850 1100
	1    0    0    -1  
$EndComp
Text GLabel 3650 3450 2    50   Input ~ 0
PIN3_RESOLVER4
Text GLabel 5500 4000 3    50   Input ~ 0
PIN3_RESOLVER4
Wire Wire Line
	5400 4200 5250 4200
Text GLabel 5600 4000 3    50   Input ~ 0
PIN5_RESOLVER3
Text GLabel 3150 3450 0    50   Input ~ 0
PIN5_RESOLVER3
Wire Wire Line
	2300 3550 2300 3100
Wire Wire Line
	2300 3550 3150 3550
Text GLabel 3150 3350 0    50   Input ~ 0
PIN7_RESOLVER5
Text GLabel 5700 4000 3    50   Input ~ 0
PIN7_RESOLVER5
Text GLabel 5800 4000 3    50   Input ~ 0
PIN9_RESOLVER6
Text GLabel 3650 3350 2    50   Input ~ 0
PIN9_RESOLVER6
Wire Wire Line
	5850 2100 5850 2050
Wire Wire Line
	6150 1600 6550 1600
Wire Wire Line
	6550 1600 6550 2050
Wire Wire Line
	6550 2050 5850 2050
Connection ~ 5850 2050
Wire Wire Line
	5850 2050 5850 2000
Wire Wire Line
	6150 1300 6550 1300
Wire Wire Line
	6550 1300 6550 1600
Connection ~ 6550 1600
Wire Wire Line
	8450 5550 8450 5500
Wire Wire Line
	7650 4650 7650 5500
Wire Wire Line
	7650 5500 8450 5500
Connection ~ 8450 5500
Wire Wire Line
	8450 5500 8450 5450
$Comp
L Device:R_Small R?
U 1 1 5ED3C22A
P 9600 4450
F 0 "R?" V 9404 4450 50  0000 C CNN
F 1 "10k" V 9495 4450 50  0000 C CNN
F 2 "" H 9600 4450 50  0001 C CNN
F 3 "~" H 9600 4450 50  0001 C CNN
	1    9600 4450
	0    1    1    0   
$EndComp
Wire Wire Line
	9250 4450 9500 4450
Wire Wire Line
	9850 4050 9850 4450
Wire Wire Line
	9850 5500 8450 5500
Wire Wire Line
	9700 4450 9850 4450
Connection ~ 9850 4450
Wire Wire Line
	9850 4450 9850 4750
Wire Wire Line
	9250 4750 9850 4750
Connection ~ 9850 4750
Wire Wire Line
	9850 4750 9850 5150
Wire Wire Line
	9250 5150 9850 5150
Connection ~ 9850 5150
Wire Wire Line
	9850 5150 9850 5500
$Comp
L power:+BATT #PWR?
U 1 1 5ED4608E
P 8450 3400
F 0 "#PWR?" H 8450 3250 50  0001 C CNN
F 1 "+BATT" H 8465 3573 50  0000 C CNN
F 2 "" H 8450 3400 50  0001 C CNN
F 3 "" H 8450 3400 50  0001 C CNN
	1    8450 3400
	1    0    0    -1  
$EndComp
Wire Wire Line
	8450 3650 8450 3400
$Comp
L Device:L L?
U 1 1 5ED480CF
P 1200 4400
F 0 "L?" H 1253 4446 50  0000 L CNN
F 1 "L" H 1253 4355 50  0000 L CNN
F 2 "" H 1200 4400 50  0001 C CNN
F 3 "~" H 1200 4400 50  0001 C CNN
	1    1200 4400
	1    0    0    -1  
$EndComp
$Comp
L Device:L L?
U 1 1 5ED48C3E
P 3500 4500
F 0 "L?" H 3553 4546 50  0000 L CNN
F 1 "L" H 3553 4455 50  0000 L CNN
F 2 "" H 3500 4500 50  0001 C CNN
F 3 "~" H 3500 4500 50  0001 C CNN
	1    3500 4500
	1    0    0    -1  
$EndComp
$Comp
L Device:L L?
U 1 1 5ED48F65
P 3750 4500
F 0 "L?" H 3803 4546 50  0000 L CNN
F 1 "L" H 3803 4455 50  0000 L CNN
F 2 "" H 3750 4500 50  0001 C CNN
F 3 "~" H 3750 4500 50  0001 C CNN
	1    3750 4500
	1    0    0    -1  
$EndComp
$Comp
L power:+BATT #PWR?
U 1 1 5ED4A5DA
P 1200 4250
F 0 "#PWR?" H 1200 4100 50  0001 C CNN
F 1 "+BATT" H 1215 4423 50  0000 C CNN
F 2 "" H 1200 4250 50  0001 C CNN
F 3 "" H 1200 4250 50  0001 C CNN
	1    1200 4250
	1    0    0    -1  
$EndComp
$Comp
L power:+BATT #PWR?
U 1 1 5ED4AB2C
P 3500 4350
F 0 "#PWR?" H 3500 4200 50  0001 C CNN
F 1 "+BATT" H 3515 4523 50  0000 C CNN
F 2 "" H 3500 4350 50  0001 C CNN
F 3 "" H 3500 4350 50  0001 C CNN
	1    3500 4350
	1    0    0    -1  
$EndComp
$Comp
L power:+BATT #PWR?
U 1 1 5ED4ADD6
P 3750 4350
F 0 "#PWR?" H 3750 4200 50  0001 C CNN
F 1 "+BATT" H 3765 4523 50  0000 C CNN
F 2 "" H 3750 4350 50  0001 C CNN
F 3 "" H 3750 4350 50  0001 C CNN
	1    3750 4350
	1    0    0    -1  
$EndComp
$Comp
L Device:C_Small C?
U 1 1 5ED51341
P 1450 4750
F 0 "C?" V 1221 4750 50  0000 C CNN
F 1 "0" V 1312 4750 50  0000 C CNN
F 2 "" H 1450 4750 50  0001 C CNN
F 3 "~" H 1450 4750 50  0001 C CNN
	1    1450 4750
	0    1    1    0   
$EndComp
$Comp
L Transistor_BJT:BC856 Q?
U 1 1 5ED51B6A
P 1350 5200
F 0 "Q?" H 1541 5154 50  0000 L CNN
F 1 "BC856" H 1541 5245 50  0000 L CNN
F 2 "Package_TO_SOT_SMD:SOT-23" H 1550 5125 50  0001 L CIN
F 3 "http://www.fairchildsemi.com/ds/BC/BC856.pdf" H 1350 5200 50  0001 L CNN
	1    1350 5200
	-1   0    0    1   
$EndComp
$Comp
L Device:R_Small R?
U 1 1 5ED5492F
P 4900 2850
F 0 "R?" V 4704 2850 50  0000 C CNN
F 1 "100r" V 4795 2850 50  0000 C CNN
F 2 "" H 4900 2850 50  0001 C CNN
F 3 "~" H 4900 2850 50  0001 C CNN
	1    4900 2850
	0    1    1    0   
$EndComp
$Comp
L IndramatResolver:X3 X3?
U 1 1 5ED565CB
P 5600 3700
F 0 "X3?" V 5646 3372 50  0000 R CNN
F 1 "X3" V 5555 3372 50  0000 R CNN
F 2 "" H 5650 3250 50  0001 C CNN
F 3 "" H 5650 3250 50  0001 C CNN
	1    5600 3700
	0    -1   -1   0   
$EndComp
$Comp
L Device:D_Schottky_Small D?
U 1 1 5ED5EF41
P 4800 1800
F 0 "D?" H 4800 1593 50  0000 C CNN
F 1 "BAR18" H 4800 1684 50  0000 C CNN
F 2 "" V 4800 1800 50  0001 C CNN
F 3 "https://www.mouser.co.uk/datasheet/2/389/bar18-1848885.pdf" V 4800 1800 50  0001 C CNN
	1    4800 1800
	-1   0    0    1   
$EndComp
Wire Wire Line
	5550 1800 4900 1800
Text GLabel 4700 1500 0    50   Input ~ 0
PIN3_PIC2
Text GLabel 9250 4250 2    50   Input ~ 0
PIN3_PIC2
$Comp
L Device:R_Small R?
U 1 1 5ED62A4D
P 5000 1500
F 0 "R?" V 4804 1500 50  0000 C CNN
F 1 "2k" V 4895 1500 50  0000 C CNN
F 2 "" H 5000 1500 50  0001 C CNN
F 3 "~" H 5000 1500 50  0001 C CNN
	1    5000 1500
	0    1    1    0   
$EndComp
$Comp
L Device:R_Small R?
U 1 1 5ED62E59
P 4800 1500
F 0 "R?" V 4604 1500 50  0000 C CNN
F 1 "2k" V 4695 1500 50  0000 C CNN
F 2 "" H 4800 1500 50  0001 C CNN
F 3 "~" H 4800 1500 50  0001 C CNN
	1    4800 1500
	0    1    1    0   
$EndComp
Wire Wire Line
	5550 1500 5100 1500
$EndSCHEMATC
