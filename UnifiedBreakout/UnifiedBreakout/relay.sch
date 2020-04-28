EESchema Schematic File Version 4
EELAYER 30 0
EELAYER END
$Descr A4 11693 8268
encoding utf-8
Sheet 8 18
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
L Relay:JW2 RL1
U 1 1 5E97D1CA
P 5750 3250
AR Path="/5E97B88B/5E97D1CA" Ref="RL1"  Part="1" 
AR Path="/5E986E17/5E97D1CA" Ref="RL?"  Part="1" 
AR Path="/5E987622/5E97D1CA" Ref="RL?"  Part="1" 
AR Path="/5E98D570/5E97D1CA" Ref="RL2"  Part="1" 
AR Path="/5E98DEDA/5E97D1CA" Ref="RL3"  Part="1" 
F 0 "RL3" V 4983 3250 50  0000 C CNN
F 1 "JW2" V 5074 3250 50  0000 C CNN
F 2 "Relay_THT:Relay_DPDT_Panasonic_JW2" H 6400 3200 50  0001 L CNN
F 3 "http://www3.panasonic.biz/ac/e_download/control/relay/power/catalog/mech_eng_jw.pdf?via=ok" H 5750 3250 50  0001 C CNN
F 4 "RTE24012" H 5750 3250 50  0001 C CNN "Alternative MPN"
F 5 "RT424012" H 5750 3250 50  0001 C CNN "MPN"
F 6 "TE Connectivity" H 5750 3250 50  0001 C CNN "Manufacturer"
	1    5750 3250
	0    1    1    0   
$EndComp
$Comp
L Transistor_BJT:BC547 Q1
U 1 1 5E97E5AE
P 4600 3450
AR Path="/5E97B88B/5E97E5AE" Ref="Q1"  Part="1" 
AR Path="/5E986E17/5E97E5AE" Ref="Q?"  Part="1" 
AR Path="/5E987622/5E97E5AE" Ref="Q?"  Part="1" 
AR Path="/5E98D570/5E97E5AE" Ref="Q2"  Part="1" 
AR Path="/5E98DEDA/5E97E5AE" Ref="Q3"  Part="1" 
F 0 "Q3" H 4791 3496 50  0000 L CNN
F 1 "BC547" H 4791 3405 50  0000 L CNN
F 2 "Package_TO_SOT_THT:TO-92_Inline_Wide" H 4800 3375 50  0001 L CIN
F 3 "http://www.fairchildsemi.com/ds/BC/BC547.pdf" H 4600 3450 50  0001 L CNN
F 4 "BC547CTFR" H 4600 3450 50  0001 C CNN "MPN"
F 5 "ON Semiconductor" H 4600 3450 50  0001 C CNN "Manufacturer"
	1    4600 3450
	1    0    0    -1  
$EndComp
$Comp
L Diode:1N4001 D6
U 1 1 5E97F269
P 5750 2250
AR Path="/5E97B88B/5E97F269" Ref="D6"  Part="1" 
AR Path="/5E986E17/5E97F269" Ref="D?"  Part="1" 
AR Path="/5E987622/5E97F269" Ref="D?"  Part="1" 
AR Path="/5E98D570/5E97F269" Ref="D8"  Part="1" 
AR Path="/5E98DEDA/5E97F269" Ref="D10"  Part="1" 
F 0 "D10" H 5750 2033 50  0000 C CNN
F 1 "1N4001" H 5750 2124 50  0000 C CNN
F 2 "Diode_THT:D_DO-41_SOD81_P10.16mm_Horizontal" H 5750 2075 50  0001 C CNN
F 3 "http://www.vishay.com/docs/88503/1n4001.pdf" H 5750 2250 50  0001 C CNN
	1    5750 2250
	-1   0    0    1   
$EndComp
$Comp
L Device:LED D5
U 1 1 5E9816C4
P 4700 2100
AR Path="/5E97B88B/5E9816C4" Ref="D5"  Part="1" 
AR Path="/5E986E17/5E9816C4" Ref="D?"  Part="1" 
AR Path="/5E987622/5E9816C4" Ref="D?"  Part="1" 
AR Path="/5E98D570/5E9816C4" Ref="D7"  Part="1" 
AR Path="/5E98DEDA/5E9816C4" Ref="D9"  Part="1" 
F 0 "D9" V 4739 1982 50  0000 R CNN
F 1 "LED" V 4648 1982 50  0000 R CNN
F 2 "LED_THT:LED_D3.0mm" H 4700 2100 50  0001 C CNN
F 3 "~" H 4700 2100 50  0001 C CNN
	1    4700 2100
	0    -1   -1   0   
$EndComp
$Comp
L Device:R R9
U 1 1 5E982C8C
P 4700 2500
AR Path="/5E97B88B/5E982C8C" Ref="R9"  Part="1" 
AR Path="/5E986E17/5E982C8C" Ref="R?"  Part="1" 
AR Path="/5E987622/5E982C8C" Ref="R?"  Part="1" 
AR Path="/5E98D570/5E982C8C" Ref="R11"  Part="1" 
AR Path="/5E98DEDA/5E982C8C" Ref="R13"  Part="1" 
F 0 "R13" H 4770 2546 50  0000 L CNN
F 1 "680R" H 4770 2455 50  0000 L CNN
F 2 "Resistor_THT:R_Axial_DIN0207_L6.3mm_D2.5mm_P7.62mm_Horizontal" V 4630 2500 50  0001 C CNN
F 3 "~" H 4700 2500 50  0001 C CNN
F 4 "CFR-25JB-52-680R" H 4700 2500 50  0001 C CNN "MPN"
F 5 "Yageo" H 4700 2500 50  0001 C CNN "Manufacturer"
	1    4700 2500
	1    0    0    -1  
$EndComp
Text HLabel 6150 1800 1    50   Input ~ 0
+12V
Text HLabel 4700 4000 3    50   Output ~ 0
GND
Text HLabel 6050 3750 2    50   Input ~ 0
IN_B
Text HLabel 5450 3250 0    50   Output ~ 0
OUT_A
Text HLabel 5450 3650 0    50   Output ~ 0
OUT_B
Wire Wire Line
	6150 1800 6150 1900
Wire Wire Line
	6150 2850 6050 2850
Wire Wire Line
	5900 2250 6150 2250
Connection ~ 6150 2250
Wire Wire Line
	6150 2250 6150 2850
Wire Wire Line
	5600 2250 5450 2250
Wire Wire Line
	5450 2250 5450 2850
Wire Wire Line
	6150 1900 4700 1900
Wire Wire Line
	4700 1900 4700 1950
Connection ~ 6150 1900
Wire Wire Line
	6150 1900 6150 2250
Wire Wire Line
	4700 2250 4700 2350
Wire Wire Line
	4700 2650 4700 2850
Wire Wire Line
	4700 3650 4700 4000
Wire Wire Line
	4700 2850 5450 2850
Connection ~ 4700 2850
Wire Wire Line
	4700 2850 4700 3250
Connection ~ 5450 2850
Text HLabel 3900 3450 0    50   Input ~ 0
ENABLE
$Comp
L Device:R R8
U 1 1 5E98535D
P 4150 3450
AR Path="/5E97B88B/5E98535D" Ref="R8"  Part="1" 
AR Path="/5E986E17/5E98535D" Ref="R?"  Part="1" 
AR Path="/5E987622/5E98535D" Ref="R?"  Part="1" 
AR Path="/5E98D570/5E98535D" Ref="R10"  Part="1" 
AR Path="/5E98DEDA/5E98535D" Ref="R12"  Part="1" 
F 0 "R12" V 3943 3450 50  0000 C CNN
F 1 "2K2" V 4034 3450 50  0000 C CNN
F 2 "Resistor_THT:R_Axial_DIN0207_L6.3mm_D2.5mm_P7.62mm_Horizontal" V 4080 3450 50  0001 C CNN
F 3 "~" H 4150 3450 50  0001 C CNN
F 4 "CFR-25JB-52-2K2" H 4150 3450 50  0001 C CNN "MPN"
F 5 "Yageo" H 4150 3450 50  0001 C CNN "Manufacturer"
	1    4150 3450
	0    1    1    0   
$EndComp
Wire Wire Line
	4400 3450 4300 3450
Wire Wire Line
	4000 3450 3900 3450
Text HLabel 6050 3350 2    50   Input ~ 0
IN_A
$EndSCHEMATC
