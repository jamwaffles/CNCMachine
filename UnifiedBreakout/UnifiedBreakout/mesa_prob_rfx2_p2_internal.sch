EESchema Schematic File Version 4
EELAYER 30 0
EELAYER END
$Descr A4 11693 8268
encoding utf-8
Sheet 6 20
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
L Connector:DB25_Female_MountingHoles J10
U 1 1 5E96F66C
P 6650 3950
F 0 "J10" H 6830 3952 50  0000 L CNN
F 1 "MESA P2 INTERNAL IO" H 6830 3861 50  0000 L CNN
F 2 "Connector_Dsub:DSUB-25_Female_Horizontal_P2.77x2.84mm_EdgePinOffset7.70mm_Housed_MountingHolesOffset9.12mm" H 6650 3950 50  0001 C CNN
F 3 " ~" H 6650 3950 50  0001 C CNN
	1    6650 3950
	1    0    0    -1  
$EndComp
Text HLabel 6350 2750 0    50   BiDi ~ 0
IO_17
Text HLabel 6350 5150 0    50   Input ~ 0
IO_33_QUAD_01_IDX
Text HLabel 6350 4950 0    50   Input ~ 0
IO_32_QUAD_01_B
Text HLabel 6350 4750 0    50   Input ~ 0
IO_31_QUAD_01_A
Text HLabel 6350 4550 0    50   BiDi ~ 0
IO_30
Text HLabel 6350 4350 0    50   Output ~ 0
IO_29_STEPGEN_07_DIR
Text HLabel 6350 4150 0    50   Output ~ 0
IO_28_STEPGEN_07_STEP
Text HLabel 6350 3950 0    50   Output ~ 0
IO_27_STEPGEN_06_DIR
Text HLabel 6350 3750 0    50   Output ~ 0
IO_26_STEPGEN_06_STEP
Text HLabel 6350 3550 0    50   Output ~ 0
IO_25_STEPGEN_05_DIR
Text HLabel 6350 3350 0    50   Output ~ 0
IO_23_STEPGEN_05_STEP
Text HLabel 6350 3150 0    50   Output ~ 0
IO_21_STEPGEN_04_DIR
Text HLabel 6350 2950 0    50   Output ~ 0
IO_19_STEPGEN_04_STEP
Text HLabel 6350 2850 0    50   Output ~ 0
IO_18_PWMGEN_01_PWM
Text HLabel 6350 3050 0    50   BiDi ~ 0
IO_20
Text HLabel 6350 3250 0    50   Output ~ 0
IO_22_PWMGEN_01_DIR
Text HLabel 6350 3450 0    50   BiDi ~ 0
IO_24
Wire Wire Line
	6350 3650 5150 3650
Wire Wire Line
	5150 3650 5150 3850
Wire Wire Line
	5150 4250 6350 4250
Wire Wire Line
	6350 4050 5150 4050
Connection ~ 5150 4050
Wire Wire Line
	5150 4050 5150 4250
Wire Wire Line
	5150 3850 6350 3850
Connection ~ 5150 3850
Wire Wire Line
	5150 3850 5150 4050
Wire Wire Line
	6350 4450 5000 4450
Wire Wire Line
	5000 4450 5000 4650
Wire Wire Line
	5000 5050 6350 5050
Wire Wire Line
	6350 4850 5000 4850
Connection ~ 5000 4850
Wire Wire Line
	5000 4850 5000 5050
Wire Wire Line
	5000 4650 6350 4650
Connection ~ 5000 4650
Wire Wire Line
	5000 4650 5000 4850
Text HLabel 5150 5500 3    50   UnSpc ~ 0
GND
Wire Wire Line
	5150 5500 5150 5350
Connection ~ 5150 4250
Wire Wire Line
	5150 5350 6650 5350
Connection ~ 5150 5350
Wire Wire Line
	5150 5350 5150 4250
Text HLabel 5000 3500 1    50   UnSpc ~ 0
MESA_5V
Wire Wire Line
	5000 3500 5000 4450
Connection ~ 5000 4450
$EndSCHEMATC
