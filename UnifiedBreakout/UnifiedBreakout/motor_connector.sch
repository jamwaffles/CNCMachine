EESchema Schematic File Version 4
EELAYER 30 0
EELAYER END
$Descr A4 11693 8268
encoding utf-8
Sheet 2 18
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
L Connector:RJ45 J7
U 1 1 5E675BA7
P 5400 3350
AR Path="/5E6754F3/5E675BA7" Ref="J7"  Part="1" 
AR Path="/5E67ECBC/5E675BA7" Ref="J?"  Part="1" 
AR Path="/5E67FD54/5E675BA7" Ref="J8"  Part="1" 
AR Path="/5E67FFE4/5E675BA7" Ref="J9"  Part="1" 
F 0 "J7" H 5070 3354 50  0000 R CNN
F 1 "RJ45" H 5070 3445 50  0000 R CNN
F 2 "Stewart:SS6488SANF1" V 5400 3375 50  0001 C CNN
F 3 "~" V 5400 3375 50  0001 C CNN
F 4 "SS-6488S-A-NF-1" H 5400 3350 50  0001 C CNN "MPN"
F 5 "Bel" H 5400 3350 50  0001 C CNN "Manufacturer"
	1    5400 3350
	-1   0    0    1   
$EndComp
Wire Wire Line
	5000 3150 3500 3150
Wire Wire Line
	5000 3350 3500 3350
Wire Wire Line
	5000 3750 3500 3750
Text HLabel 3500 3150 0    50   Input ~ 0
STEP
Text HLabel 3500 3350 0    50   Input ~ 0
DIR
Text HLabel 3500 3550 0    50   Input ~ 0
ENABLE
Text HLabel 3500 3750 0    50   Input ~ 0
ALARM
Text HLabel 4800 4000 3    50   UnSpc ~ 0
GND
Wire Wire Line
	5000 3550 3500 3550
Wire Wire Line
	5000 3050 4800 3050
Wire Wire Line
	4800 3050 4800 3250
Wire Wire Line
	5000 3250 4800 3250
Connection ~ 4800 3250
Wire Wire Line
	4800 3250 4800 3450
Wire Wire Line
	5000 3450 4800 3450
Connection ~ 4800 3450
Wire Wire Line
	4800 3450 4800 3650
Wire Wire Line
	5000 3650 4800 3650
Connection ~ 4800 3650
Wire Wire Line
	4800 3650 4800 4000
$EndSCHEMATC
