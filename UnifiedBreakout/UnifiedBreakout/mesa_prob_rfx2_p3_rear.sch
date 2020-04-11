EESchema Schematic File Version 4
EELAYER 30 0
EELAYER END
$Descr A4 11693 8268
encoding utf-8
Sheet 10 20
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
L Connector:DB25_Female_MountingHoles J11
U 1 1 5E96286A
P 5350 3250
F 0 "J11" H 5530 3252 50  0000 L CNN
F 1 "MESA P3 REAR IO" H 5530 3161 50  0000 L CNN
F 2 "Connector_Dsub:DSUB-25_Female_Horizontal_P2.77x2.84mm_EdgePinOffset7.70mm_Housed_MountingHolesOffset9.12mm" H 5350 3250 50  0001 C CNN
F 3 " ~" H 5350 3250 50  0001 C CNN
	1    5350 3250
	1    0    0    -1  
$EndComp
Text HLabel 5350 5050 3    50   Output ~ 0
GND
Text HLabel 3700 4600 3    50   Output ~ 0
MESA_5V
Wire Wire Line
	3700 3750 3700 3950
Connection ~ 3700 4150
Wire Wire Line
	3700 4150 3700 4350
Connection ~ 3700 3950
Wire Wire Line
	3700 3950 3700 4150
Wire Wire Line
	3700 3550 3700 3350
Connection ~ 3700 3150
Wire Wire Line
	3700 3150 3700 2950
Connection ~ 3700 3350
Wire Wire Line
	3700 3350 3700 3150
Wire Wire Line
	3700 4350 3700 4600
Connection ~ 3700 4350
Wire Wire Line
	3700 3550 3550 3550
Wire Wire Line
	3550 3550 3550 5000
Connection ~ 3700 3550
Wire Wire Line
	5350 4650 5350 5000
Text HLabel 5050 2050 0    50   BiDi ~ 0
IO_00
Text HLabel 5050 2150 0    50   Output ~ 0
IO_01_PWMGEN_00_PWM
Text HLabel 5050 2250 0    50   Output ~ 0
IO_02_STEPGEN_00_STEP
Text HLabel 5050 2350 0    50   BiDi ~ 0
IO_03
Text HLabel 5050 2450 0    50   Output ~ 0
IO_04_STEPGEN_00_DIR
Text HLabel 5050 2650 0    50   Output ~ 0
IO_06_STEPGEN_01_STEP
Text HLabel 5050 2750 0    50   BiDi ~ 0
IO_07
Text HLabel 5050 2850 0    50   Output ~ 0
IO_08_STEPGEN_01_DIR
Text HLabel 5050 3050 0    50   Output ~ 0
IO_09_STEPGEN_02_STEP
Text HLabel 5050 3250 0    50   Output ~ 0
IO_10_STEPGEN_02_DIR
Text HLabel 5050 3450 0    50   Output ~ 0
IO_11_STEPGEN_03_STEP
Text HLabel 5050 3650 0    50   Output ~ 0
IO_12_STEPGEN_03_DIR
Text HLabel 5050 3850 0    50   BiDi ~ 0
IO_13
Text HLabel 5050 4050 0    50   Input ~ 0
IO_14_QUAD_00_A
Text HLabel 5050 4250 0    50   Input ~ 0
IO_15_QUAD_00_B
Text HLabel 5050 4450 0    50   Input ~ 0
IO_16_QUAD_00_IDX
Wire Wire Line
	3700 2950 5050 2950
Wire Wire Line
	3700 3150 5050 3150
Wire Wire Line
	3700 3350 5050 3350
Wire Wire Line
	3700 3550 5050 3550
Wire Wire Line
	3700 3750 5050 3750
Wire Wire Line
	3700 3950 5050 3950
Wire Wire Line
	3700 4150 5050 4150
Wire Wire Line
	3700 4350 5050 4350
Wire Wire Line
	3550 5000 5350 5000
Connection ~ 5350 5000
Wire Wire Line
	5350 5000 5350 5050
Text HLabel 5050 2550 0    50   Output ~ 0
IO_05_PWMGEN_00_DIR
$EndSCHEMATC
