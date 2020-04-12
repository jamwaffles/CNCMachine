EESchema Schematic File Version 4
EELAYER 30 0
EELAYER END
$Descr A4 11693 8268
encoding utf-8
Sheet 11 18
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
L Connector:DB15_Female_MountingHoles J13
U 1 1 5E9DE5F8
P 6100 3500
F 0 "J13" H 6254 3502 50  0000 L CNN
F 1 "ENCODER IN" H 6254 3411 50  0000 L CNN
F 2 "Connector_Dsub:DSUB-15_Female_Horizontal_P2.77x2.84mm_EdgePinOffset7.70mm_Housed_MountingHolesOffset9.12mm" H 6100 3500 50  0001 C CNN
F 3 " ~" H 6100 3500 50  0001 C CNN
	1    6100 3500
	1    0    0    -1  
$EndComp
Wire Wire Line
	6100 4400 6100 4500
Text HLabel 5050 2400 1    50   Output ~ 0
IDX+
Text HLabel 5150 2400 1    50   Output ~ 0
A+
Text HLabel 4750 2400 1    50   Output ~ 0
B+
Text HLabel 4950 2400 1    50   Output ~ 0
A-
Text HLabel 4850 2400 1    50   Output ~ 0
IDX-
Text HLabel 4650 2400 1    50   Output ~ 0
B-
Wire Wire Line
	5800 2900 5700 2900
Wire Wire Line
	5700 2900 5700 2300
Wire Wire Line
	5800 3100 5300 3100
Wire Wire Line
	5300 3100 5300 4500
Wire Wire Line
	5300 4500 6100 4500
Connection ~ 6100 4500
Wire Wire Line
	6100 4500 6100 4700
Text HLabel 6100 4700 3    50   Output ~ 0
GND
$Comp
L Device:Jumper_NC_Dual JP1
U 1 1 5EA289BC
P 5700 2050
F 0 "JP1" V 5654 2152 50  0000 L CNN
F 1 "ENCODER PWR SEL" V 5745 2152 50  0000 L CNN
F 2 "Connector_PinHeader_2.54mm:PinHeader_1x03_P2.54mm_Vertical" H 5700 2050 50  0001 C CNN
F 3 "~" H 5700 2050 50  0001 C CNN
	1    5700 2050
	0    1    1    0   
$EndComp
$Comp
L Connector:DB15_Female_MountingHoles J12
U 1 1 5EA2910D
P 3800 3500
F 0 "J12" H 3706 4492 50  0000 C CNN
F 1 "ENCODER OUT" H 3706 4401 50  0000 C CNN
F 2 "Connector_Dsub:DSUB-15_Female_Horizontal_P2.77x2.84mm_EdgePinOffset7.70mm_Housed_MountingHolesOffset9.12mm" H 3800 3500 50  0001 C CNN
F 3 " ~" H 3800 3500 50  0001 C CNN
	1    3800 3500
	-1   0    0    -1  
$EndComp
Wire Wire Line
	5800 3800 4750 3800
Wire Wire Line
	4750 3800 4750 2400
Wire Wire Line
	5800 3900 4850 3900
Wire Wire Line
	4850 3900 4850 2400
Wire Wire Line
	5800 4000 4950 4000
Wire Wire Line
	4950 4000 4950 2400
Wire Wire Line
	5800 4100 5050 4100
Wire Wire Line
	5800 4200 5150 4200
Wire Wire Line
	5150 4200 5150 2400
Wire Wire Line
	5800 3600 4650 3600
Wire Wire Line
	4650 3600 4650 2400
Text Label 5700 2550 3    50   ~ 0
ARGON5V
Text HLabel 5700 1800 1    50   Input ~ 0
MESA_5V
Wire Wire Line
	5600 2050 4250 2050
Wire Wire Line
	4250 2050 4250 2900
Wire Wire Line
	4250 2900 4100 2900
Text Notes 5600 1950 2    50   ~ 0
Select between Argon 5V and Mesa 5V with this jumper
Wire Wire Line
	5300 4500 3800 4500
Wire Wire Line
	3800 4500 3800 4400
Connection ~ 5300 4500
Wire Wire Line
	5150 4200 4100 4200
Connection ~ 5150 4200
Wire Wire Line
	5050 4100 5050 2400
Wire Wire Line
	5050 4100 4100 4100
Connection ~ 5050 4100
Wire Wire Line
	4100 4000 4950 4000
Connection ~ 4950 4000
Wire Wire Line
	4850 3900 4100 3900
Connection ~ 4850 3900
Wire Wire Line
	4100 3800 4750 3800
Connection ~ 4750 3800
Wire Wire Line
	4650 3600 4100 3600
Connection ~ 4650 3600
$EndSCHEMATC
