EESchema Schematic File Version 4
EELAYER 30 0
EELAYER END
$Descr A4 11693 8268
encoding utf-8
Sheet 18 20
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
L Connector:DB25_Female_MountingHoles J21
U 1 1 5E928FD4
P 5650 3650
F 0 "J21" H 5830 3652 50  0000 L CNN
F 1 "PENDANT" H 5830 3561 50  0000 L CNN
F 2 "Connector_Dsub:DSUB-25_Female_Horizontal_P2.77x2.84mm_EdgePinOffset7.70mm_Housed_MountingHolesOffset9.12mm" H 5650 3650 50  0001 C CNN
F 3 " ~" H 5650 3650 50  0001 C CNN
	1    5650 3650
	1    0    0    -1  
$EndComp
Wire Wire Line
	5350 2450 3850 2450
Wire Wire Line
	5350 2550 2600 2550
Wire Wire Line
	5350 2650 3850 2650
Wire Wire Line
	5350 2750 2600 2750
Wire Wire Line
	5350 2850 3850 2850
Wire Wire Line
	5350 3250 3850 3250
Wire Wire Line
	5350 2950 2600 2950
Text HLabel 3850 2450 0    50   Output ~ 0
SELX
Text HLabel 3850 2650 0    50   Output ~ 0
SELZ
Text HLabel 2600 2550 0    50   Output ~ 0
SELY
Text HLabel 3850 3250 0    50   Output ~ 0
SELA
Text HLabel 2600 2750 0    50   Output ~ 0
MULX1
Text HLabel 3850 2850 0    50   Output ~ 0
MULX10
Text HLabel 2600 2950 0    50   Output ~ 0
MULX100
Text HLabel 2150 3050 0    50   Output ~ 0
ESTOP+
Text HLabel 3400 1450 1    50   Input ~ 0
ENCODER5V
Wire Wire Line
	5350 4750 3400 4750
Wire Wire Line
	3400 4750 3400 1450
Wire Wire Line
	5350 3750 3500 3750
Text HLabel 4050 4450 0    50   Output ~ 0
ENCA
Text HLabel 4050 4650 0    50   Output ~ 0
ENCB
Text HLabel 3250 5850 3    50   Output ~ 0
COM
Wire Wire Line
	5350 3550 3250 3550
Wire Wire Line
	3250 3550 3250 5600
Wire Wire Line
	4050 4450 5350 4450
Wire Wire Line
	5350 4650 4050 4650
Wire Wire Line
	5650 5050 5650 5600
Connection ~ 3250 5600
Wire Wire Line
	3250 5600 3250 5850
Wire Wire Line
	3500 3750 3500 5600
Connection ~ 3500 5600
Wire Wire Line
	3500 5600 3250 5600
Wire Wire Line
	2150 3050 5350 3050
Text Label 4750 3750 0    50   ~ 0
ENCODERGND
Wire Wire Line
	3500 5600 5650 5600
Text HLabel 5350 3950 0    50   Output ~ 0
ESTOP-
$EndSCHEMATC
