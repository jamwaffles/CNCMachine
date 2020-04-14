EESchema Schematic File Version 4
EELAYER 30 0
EELAYER END
$Descr A4 11693 8268
encoding utf-8
Sheet 12 18
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
L Connector:RJ45 J15
U 1 1 5EA5A0E0
P 5550 3400
F 0 "J15" H 5220 3404 50  0000 R CNN
F 1 "ARGON J2.2" H 5220 3495 50  0000 R CNN
F 2 "Stewart:SS6488SANF1" V 5550 3425 50  0001 C CNN
F 3 "~" V 5550 3425 50  0001 C CNN
	1    5550 3400
	-1   0    0    1   
$EndComp
Text HLabel 4300 4150 3    50   UnSpc ~ 0
Gnd
Text HLabel 5150 3300 0    50   BiDi ~ 0
RS485_A
Text HLabel 5150 3600 0    50   BiDi ~ 0
RS485_B
Text HLabel 4300 2650 1    50   UnSpc ~ 0
24V
Text HLabel 5150 3400 0    50   Input ~ 0
ESTOP+
Text HLabel 5150 3500 0    50   Input ~ 0
ESTOP-
Wire Wire Line
	5150 3700 4300 3700
Wire Wire Line
	4300 3700 4300 3100
Wire Wire Line
	5150 3100 4300 3100
Connection ~ 4300 3100
Wire Wire Line
	4300 3100 4300 2650
Wire Wire Line
	5150 3800 4300 3800
Wire Wire Line
	4300 3800 4300 4150
Text Label 4750 3100 0    50   ~ 0
STO2
Text Label 4450 3700 0    50   ~ 0
ENABLE
$EndSCHEMATC
