EESchema Schematic File Version 4
EELAYER 30 0
EELAYER END
$Descr A4 11693 8268
encoding utf-8
Sheet 14 18
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
L Isolator:4N35 U2
U 1 1 5EA62D6B
P 5750 3500
AR Path="/5EA623AE/5EA62D6B" Ref="U2"  Part="1" 
AR Path="/5EA6C72A/5EA62D6B" Ref="U?"  Part="1" 
AR Path="/5EA6DC71/5EA62D6B" Ref="U?"  Part="1" 
AR Path="/5EA6F0AA/5EA62D6B" Ref="U?"  Part="1" 
AR Path="/5EA70605/5EA62D6B" Ref="U?"  Part="1" 
AR Path="/5EA7F263/5EA62D6B" Ref="U3"  Part="1" 
AR Path="/5EA816C6/5EA62D6B" Ref="U4"  Part="1" 
AR Path="/5EA83CCC/5EA62D6B" Ref="U5"  Part="1" 
AR Path="/5EA86618/5EA62D6B" Ref="U6"  Part="1" 
AR Path="/5E9C48DA/5EA62D6B" Ref="U?"  Part="1" 
AR Path="/5E9C48F7/5EA62D6B" Ref="U?"  Part="1" 
AR Path="/5E9DEC5E/5EA62D6B" Ref="U7"  Part="1" 
AR Path="/5E9DEC7B/5EA62D6B" Ref="U8"  Part="1" 
F 0 "U3" H 5750 3825 50  0000 C CNN
F 1 "4N35" H 5750 3734 50  0000 C CNN
F 2 "Package_DIP:DIP-6_W7.62mm" H 5550 3300 50  0001 L CIN
F 3 "https://www.vishay.com/docs/81181/4n35.pdf" H 5750 3500 50  0001 L CNN
F 4 "4N35" H 5750 3500 50  0001 C CNN "MPN"
F 5 "Vishay" H 5750 3500 50  0001 C CNN "Manufacturer"
	1    5750 3500
	1    0    0    -1  
$EndComp
$Comp
L Device:R R14
U 1 1 5EA63E66
P 5250 3900
AR Path="/5EA623AE/5EA63E66" Ref="R14"  Part="1" 
AR Path="/5EA6C72A/5EA63E66" Ref="R?"  Part="1" 
AR Path="/5EA6DC71/5EA63E66" Ref="R?"  Part="1" 
AR Path="/5EA6F0AA/5EA63E66" Ref="R?"  Part="1" 
AR Path="/5EA70605/5EA63E66" Ref="R?"  Part="1" 
AR Path="/5EA7F263/5EA63E66" Ref="R16"  Part="1" 
AR Path="/5EA816C6/5EA63E66" Ref="R18"  Part="1" 
AR Path="/5EA83CCC/5EA63E66" Ref="R20"  Part="1" 
AR Path="/5EA86618/5EA63E66" Ref="R22"  Part="1" 
AR Path="/5E9C48DA/5EA63E66" Ref="R?"  Part="1" 
AR Path="/5E9C48F7/5EA63E66" Ref="R?"  Part="1" 
AR Path="/5E9DEC5E/5EA63E66" Ref="R24"  Part="1" 
AR Path="/5E9DEC7B/5EA63E66" Ref="R26"  Part="1" 
F 0 "R16" H 5320 3946 50  0000 L CNN
F 1 "2K2" H 5320 3855 50  0000 L CNN
F 2 "Resistor_THT:R_Axial_DIN0207_L6.3mm_D2.5mm_P10.16mm_Horizontal" V 5180 3900 50  0001 C CNN
F 3 "~" H 5250 3900 50  0001 C CNN
F 4 "CFR-25JB-52-2K2" H 5250 3900 50  0001 C CNN "MPN"
F 5 "Yageo" H 5250 3900 50  0001 C CNN "Manufacturer"
	1    5250 3900
	1    0    0    -1  
$EndComp
$Comp
L Connector:RJ14 J16
U 1 1 5EA649A8
P 3750 3300
AR Path="/5EA623AE/5EA649A8" Ref="J16"  Part="1" 
AR Path="/5EA6C72A/5EA649A8" Ref="J?"  Part="1" 
AR Path="/5EA6DC71/5EA649A8" Ref="J?"  Part="1" 
AR Path="/5EA6F0AA/5EA649A8" Ref="J?"  Part="1" 
AR Path="/5EA70605/5EA649A8" Ref="J?"  Part="1" 
AR Path="/5EA7F263/5EA649A8" Ref="J17"  Part="1" 
AR Path="/5EA816C6/5EA649A8" Ref="J18"  Part="1" 
AR Path="/5EA83CCC/5EA649A8" Ref="J19"  Part="1" 
AR Path="/5EA86618/5EA649A8" Ref="J20"  Part="1" 
AR Path="/5E9C48DA/5EA649A8" Ref="J?"  Part="1" 
AR Path="/5E9C48F7/5EA649A8" Ref="J?"  Part="1" 
AR Path="/5E9DEC5E/5EA649A8" Ref="J22"  Part="1" 
AR Path="/5E9DEC7B/5EA649A8" Ref="J23"  Part="1" 
F 0 "J17" H 3421 3304 50  0000 R CNN
F 1 "RJ14" H 3421 3395 50  0000 R CNN
F 2 "Wurth:615004141121" V 3750 3325 50  0001 C CNN
F 3 "~" V 3750 3325 50  0001 C CNN
F 4 "615004141121" H 3750 3300 50  0001 C CNN "MPN"
F 5 "Wurth" H 3750 3300 50  0001 C CNN "Manufacturer"
	1    3750 3300
	1    0    0    1   
$EndComp
Wire Wire Line
	5450 3600 5250 3600
Wire Wire Line
	5250 3600 5250 3750
$Comp
L Device:R R15
U 1 1 5EA66D61
P 6150 3900
AR Path="/5EA623AE/5EA66D61" Ref="R15"  Part="1" 
AR Path="/5EA6C72A/5EA66D61" Ref="R?"  Part="1" 
AR Path="/5EA6DC71/5EA66D61" Ref="R?"  Part="1" 
AR Path="/5EA6F0AA/5EA66D61" Ref="R?"  Part="1" 
AR Path="/5EA70605/5EA66D61" Ref="R?"  Part="1" 
AR Path="/5EA7F263/5EA66D61" Ref="R17"  Part="1" 
AR Path="/5EA816C6/5EA66D61" Ref="R19"  Part="1" 
AR Path="/5EA83CCC/5EA66D61" Ref="R21"  Part="1" 
AR Path="/5EA86618/5EA66D61" Ref="R23"  Part="1" 
AR Path="/5E9C48DA/5EA66D61" Ref="R?"  Part="1" 
AR Path="/5E9C48F7/5EA66D61" Ref="R?"  Part="1" 
AR Path="/5E9DEC5E/5EA66D61" Ref="R25"  Part="1" 
AR Path="/5E9DEC7B/5EA66D61" Ref="R27"  Part="1" 
F 0 "R17" H 6220 3946 50  0000 L CNN
F 1 "220K" H 6220 3855 50  0000 L CNN
F 2 "Resistor_THT:R_Axial_DIN0207_L6.3mm_D2.5mm_P10.16mm_Horizontal" V 6080 3900 50  0001 C CNN
F 3 "~" H 6150 3900 50  0001 C CNN
F 4 "CFR-25JB-52-220K" H 6150 3900 50  0001 C CNN "MPN"
F 5 "Yageo" H 6150 3900 50  0001 C CNN "Manufacturer"
	1    6150 3900
	1    0    0    -1  
$EndComp
Wire Wire Line
	6050 3400 6150 3400
Wire Wire Line
	6150 3400 6150 3750
Text HLabel 6050 4400 3    50   UnSpc ~ 0
GND
Wire Wire Line
	6050 3600 6050 4300
Text HLabel 6400 3500 2    50   Output ~ 0
SIGNAL
Wire Wire Line
	6050 3500 6300 3500
Wire Wire Line
	6150 4050 6150 4300
Wire Wire Line
	6150 4300 6050 4300
Connection ~ 6050 4300
Wire Wire Line
	6050 4300 6050 4400
Wire Wire Line
	6050 4300 5250 4300
Wire Wire Line
	5250 4300 5250 4050
Wire Wire Line
	4150 3400 5450 3400
Text HLabel 4150 3300 2    50   UnSpc ~ 0
24V
Text HLabel 4150 3200 2    50   UnSpc ~ 0
5V
Text HLabel 4150 3500 2    50   UnSpc ~ 0
GND
$Comp
L Device:R R27
U 1 1 5E9E2B63
P 6300 3050
AR Path="/5EA623AE/5E9E2B63" Ref="R27"  Part="1" 
AR Path="/5EA7F263/5E9E2B63" Ref="R28"  Part="1" 
AR Path="/5EA816C6/5E9E2B63" Ref="R29"  Part="1" 
AR Path="/5EA83CCC/5E9E2B63" Ref="R30"  Part="1" 
AR Path="/5EA86618/5E9E2B63" Ref="R31"  Part="1" 
F 0 "R28" H 6370 3096 50  0000 L CNN
F 1 "10K" H 6370 3005 50  0000 L CNN
F 2 "Resistor_THT:R_Axial_DIN0207_L6.3mm_D2.5mm_P10.16mm_Horizontal" V 6230 3050 50  0001 C CNN
F 3 "~" H 6300 3050 50  0001 C CNN
F 4 "CFR-25JB-52-10K " H 6300 3050 50  0001 C CNN "MPN"
F 5 "Yageo" H 6300 3050 50  0001 C CNN "Manufacturer"
	1    6300 3050
	1    0    0    -1  
$EndComp
Wire Wire Line
	6300 3200 6300 3500
Connection ~ 6300 3500
Wire Wire Line
	6300 3500 6400 3500
Text HLabel 6300 2900 1    50   UnSpc ~ 0
MESA_5V
$EndSCHEMATC
