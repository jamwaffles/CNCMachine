EESchema Schematic File Version 4
EELAYER 30 0
EELAYER END
$Descr A4 11693 8268
encoding utf-8
Sheet 3 18
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
F 0 "J9" H 5070 3354 50  0000 R CNN
F 1 "RJ45" H 5070 3445 50  0000 R CNN
F 2 "Connector_RJ:RJ45_Ninigi_GE" V 5400 3375 50  0001 C CNN
F 3 "~" V 5400 3375 50  0001 C CNN
	1    5400 3350
	-1   0    0    1   
$EndComp
Wire Wire Line
	5000 3150 4800 3150
Wire Wire Line
	4800 3150 4800 3350
Wire Wire Line
	5000 3350 4800 3350
Connection ~ 4800 3350
Wire Wire Line
	4800 3350 4800 3550
Wire Wire Line
	5000 3550 4800 3550
Connection ~ 4800 3550
Wire Wire Line
	4800 3550 4800 3750
Wire Wire Line
	5000 3750 4800 3750
Connection ~ 4800 3750
Wire Wire Line
	5000 3050 3500 3050
Wire Wire Line
	5000 3250 3500 3250
Wire Wire Line
	5000 3450 3500 3450
Wire Wire Line
	5000 3650 3500 3650
Wire Wire Line
	4800 3750 4800 4000
Text HLabel 3500 3050 0    50   Input ~ 0
STEP
Text HLabel 3500 3250 0    50   Input ~ 0
DIR
Text HLabel 3500 3450 0    50   Input ~ 0
ENABLE
Text HLabel 3500 3650 0    50   Input ~ 0
ALARM
Text HLabel 4800 4000 3    50   UnSpc ~ 0
GND
$EndSCHEMATC
