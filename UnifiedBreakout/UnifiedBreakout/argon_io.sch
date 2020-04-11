EESchema Schematic File Version 4
EELAYER 30 0
EELAYER END
$Descr A4 11693 8268
encoding utf-8
Sheet 11 20
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
L Connector_Generic:Conn_02x13_Odd_Even J14
U 1 1 5E9EBBAB
P 5250 3600
F 0 "J14" H 5300 4417 50  0000 C CNN
F 1 "ARGON J5" H 5300 4326 50  0000 C CNN
F 2 "Connector_IDC:IDC-Header_2x13_P2.54mm_Vertical" H 5250 3600 50  0001 C CNN
F 3 "~" H 5250 3600 50  0001 C CNN
	1    5250 3600
	1    0    0    -1  
$EndComp
Text HLabel 5050 3000 0    50   Output ~ 0
GND
Text HLabel 5550 3500 2    50   Input ~ 0
GPO1
Text HLabel 5550 3600 2    50   Input ~ 0
GPO2
Text HLabel 5550 3700 2    50   Input ~ 0
GPO3
Text HLabel 5550 3800 2    50   Input ~ 0
GPO4
Text HLabel 5550 3900 2    50   Input ~ 0
GPI1
Text HLabel 5550 4000 2    50   Input ~ 0
GPI2
Text HLabel 5550 4100 2    50   Input ~ 0
GPI3
Text HLabel 5550 4200 2    50   Input ~ 0
GPI4
Text HLabel 7250 2850 2    50   Input ~ 0
STEPGEN_STEP
Text HLabel 7250 3400 2    50   Input ~ 0
STEPGEN_DIR
Text HLabel 6750 3400 0    50   Input ~ 0
PWM_SIGNAL
Text HLabel 6750 2850 0    50   Input ~ 0
PWM_DIR
$Comp
L Device:Jumper_NC_Dual JP2
U 1 1 5E9F4611
P 7000 2850
F 0 "JP2" H 7000 3089 50  0000 C CNN
F 1 "HSIN1" H 7000 2998 50  0000 C CNN
F 2 "Connector_PinHeader_2.54mm:PinHeader_1x03_P2.54mm_Vertical" H 7000 2850 50  0001 C CNN
F 3 "~" H 7000 2850 50  0001 C CNN
	1    7000 2850
	1    0    0    -1  
$EndComp
$Comp
L Device:Jumper_NC_Dual JP3
U 1 1 5E9F56E4
P 7000 3400
F 0 "JP3" H 7000 3547 50  0000 C CNN
F 1 "HSIN2" H 7000 3638 50  0000 C CNN
F 2 "Connector_PinHeader_2.54mm:PinHeader_1x03_P2.54mm_Vertical" H 7000 3400 50  0001 C CNN
F 3 "~" H 7000 3400 50  0001 C CNN
	1    7000 3400
	1    0    0    1   
$EndComp
Wire Wire Line
	7000 2950 7000 3100
Wire Wire Line
	7000 3200 7000 3300
Wire Wire Line
	5550 3100 7000 3100
Wire Wire Line
	5550 3200 7000 3200
$EndSCHEMATC
