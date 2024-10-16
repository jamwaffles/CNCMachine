SamacSys ECAD Model
12871470/234518/2.50/9/4/Connector

DESIGNSPARK_INTERMEDIATE_ASCII

(asciiHeader
	(fileUnits MM)
)
(library Library_1
	(padStyleDef "r225_50"
		(holeDiam 0)
		(padShape (layerNumRef 1) (padShapeType Rect)  (shapeWidth 0.500) (shapeHeight 2.250))
		(padShape (layerNumRef 16) (padShapeType Ellipse)  (shapeWidth 0) (shapeHeight 0))
	)
	(padStyleDef "c45_h90"
		(holeDiam 0.9)
		(padShape (layerNumRef 1) (padShapeType Ellipse)  (shapeWidth 0.450) (shapeHeight 0.450))
		(padShape (layerNumRef 16) (padShapeType Ellipse)  (shapeWidth 0.450) (shapeHeight 0.450))
	)
	(padStyleDef "r350_205"
		(holeDiam 0)
		(padShape (layerNumRef 1) (padShapeType Rect)  (shapeWidth 2.050) (shapeHeight 3.500))
		(padShape (layerNumRef 16) (padShapeType Ellipse)  (shapeWidth 0) (shapeHeight 0))
	)
	(padStyleDef "r400_205"
		(holeDiam 0)
		(padShape (layerNumRef 1) (padShapeType Rect)  (shapeWidth 2.050) (shapeHeight 4.000))
		(padShape (layerNumRef 16) (padShapeType Ellipse)  (shapeWidth 0) (shapeHeight 0))
	)
	(textStyleDef "Default"
		(font
			(fontType Stroke)
			(fontFace "Helvetica")
			(fontHeight 50 mils)
			(strokeWidth 5 mils)
		)
	)
	(patternDef "675031020" (originalName "675031020")
		(multiLayer
			(pad (padNum 1) (padStyleRef r225_50) (pt -1.600, 3.725) (rotation 0))
			(pad (padNum 2) (padStyleRef r225_50) (pt -0.800, 3.725) (rotation 0))
			(pad (padNum 3) (padStyleRef r225_50) (pt 0.000, 3.725) (rotation 0))
			(pad (padNum 4) (padStyleRef r225_50) (pt 0.800, 3.725) (rotation 0))
			(pad (padNum 5) (padStyleRef r225_50) (pt 1.600, 3.725) (rotation 0))
			(pad (padNum 6) (padStyleRef c45_h90) (pt -2.200, 1.400) (rotation 90))
			(pad (padNum 7) (padStyleRef c45_h90) (pt 2.200, 1.400) (rotation 90))
			(pad (padNum 8) (padStyleRef r350_205) (pt -4.925, 3.750) (rotation 0))
			(pad (padNum 9) (padStyleRef r350_205) (pt 4.925, 3.750) (rotation 0))
			(pad (padNum 10) (padStyleRef r400_205) (pt -4.925, -0.500) (rotation 0))
			(pad (padNum 11) (padStyleRef r400_205) (pt 4.925, -0.500) (rotation 0))
		)
		(layerContents (layerNumRef 18)
			(attr "RefDes" "RefDes" (pt 0.000, 0.850) (textStyleRef "Default") (isVisible True))
		)
		(layerContents (layerNumRef 28)
			(line (pt -4.95 -4.5) (pt 4.95 -4.5) (width 0.2))
		)
		(layerContents (layerNumRef 28)
			(line (pt 4.95 -4.5) (pt 4.95 4.5) (width 0.2))
		)
		(layerContents (layerNumRef 28)
			(line (pt 4.95 4.5) (pt -4.95 4.5) (width 0.2))
		)
		(layerContents (layerNumRef 28)
			(line (pt -4.95 4.5) (pt -4.95 -4.5) (width 0.2))
		)
		(layerContents (layerNumRef 18)
			(line (pt -4.95 -3.25) (pt -4.95 -3.25) (width 0.1))
		)
		(layerContents (layerNumRef 18)
			(line (pt -4.95 -3.25) (pt -4.95 -4.5) (width 0.1))
		)
		(layerContents (layerNumRef 18)
			(line (pt -4.95 -4.5) (pt -4.95 -4.5) (width 0.1))
		)
		(layerContents (layerNumRef 18)
			(line (pt -4.95 -4.5) (pt -4.95 -3.25) (width 0.1))
		)
		(layerContents (layerNumRef 18)
			(line (pt -4.95 -4.5) (pt 4.925 -4.5) (width 0.1))
		)
		(layerContents (layerNumRef 18)
			(line (pt 4.925 -4.5) (pt 4.925 -4.5) (width 0.1))
		)
		(layerContents (layerNumRef 18)
			(line (pt 4.925 -4.5) (pt -4.95 -4.5) (width 0.1))
		)
		(layerContents (layerNumRef 18)
			(line (pt -4.95 -4.5) (pt -4.95 -4.5) (width 0.1))
		)
		(layerContents (layerNumRef 18)
			(line (pt 4.95 -4.5) (pt 4.95 -4.5) (width 0.1))
		)
		(layerContents (layerNumRef 18)
			(line (pt 4.95 -4.5) (pt 4.95 -3.25) (width 0.1))
		)
		(layerContents (layerNumRef 18)
			(line (pt 4.95 -3.25) (pt 4.95 -3.25) (width 0.1))
		)
		(layerContents (layerNumRef 18)
			(line (pt 4.95 -3.25) (pt 4.95 -4.5) (width 0.1))
		)
		(layerContents (layerNumRef 30)
			(line (pt -6.95 7.2) (pt 6.95 7.2) (width 0.1))
		)
		(layerContents (layerNumRef 30)
			(line (pt 6.95 7.2) (pt 6.95 -5.5) (width 0.1))
		)
		(layerContents (layerNumRef 30)
			(line (pt 6.95 -5.5) (pt -6.95 -5.5) (width 0.1))
		)
		(layerContents (layerNumRef 30)
			(line (pt -6.95 -5.5) (pt -6.95 7.2) (width 0.1))
		)
		(layerContents (layerNumRef 18)
			(line (pt -1.6 6.2) (pt -1.6 6.2) (width 0.2))
		)
		(layerContents (layerNumRef 18)
			(arc (pt -1.6, 6.15) (radius 0.05) (startAngle 90.0) (sweepAngle 180.0) (width 0.2))
		)
		(layerContents (layerNumRef 18)
			(line (pt -1.6 6.1) (pt -1.6 6.1) (width 0.2))
		)
		(layerContents (layerNumRef 18)
			(arc (pt -1.6, 6.15) (radius 0.05) (startAngle 270) (sweepAngle 180.0) (width 0.2))
		)
		(layerContents (layerNumRef 18)
			(line (pt -1.6 6.2) (pt -1.6 6.2) (width 0.2))
		)
		(layerContents (layerNumRef 18)
			(arc (pt -1.6, 6.15) (radius 0.05) (startAngle 90.0) (sweepAngle 180.0) (width 0.2))
		)
	)
	(symbolDef "67503-1020" (originalName "67503-1020")

		(pin (pinNum 1) (pt 0 mils 0 mils) (rotation 0) (pinLength 200 mils) (pinDisplay (dispPinName true)) (pinName (text (pt 230 mils -25 mils) (rotation 0]) (justify "Left") (textStyleRef "Default"))
		))
		(pin (pinNum 2) (pt 0 mils -100 mils) (rotation 0) (pinLength 200 mils) (pinDisplay (dispPinName true)) (pinName (text (pt 230 mils -125 mils) (rotation 0]) (justify "Left") (textStyleRef "Default"))
		))
		(pin (pinNum 3) (pt 0 mils -200 mils) (rotation 0) (pinLength 200 mils) (pinDisplay (dispPinName true)) (pinName (text (pt 230 mils -225 mils) (rotation 0]) (justify "Left") (textStyleRef "Default"))
		))
		(pin (pinNum 4) (pt 0 mils -300 mils) (rotation 0) (pinLength 200 mils) (pinDisplay (dispPinName true)) (pinName (text (pt 230 mils -325 mils) (rotation 0]) (justify "Left") (textStyleRef "Default"))
		))
		(pin (pinNum 5) (pt 0 mils -400 mils) (rotation 0) (pinLength 200 mils) (pinDisplay (dispPinName true)) (pinName (text (pt 230 mils -425 mils) (rotation 0]) (justify "Left") (textStyleRef "Default"))
		))
		(pin (pinNum 6) (pt 1100 mils 0 mils) (rotation 180) (pinLength 200 mils) (pinDisplay (dispPinName true)) (pinName (text (pt 870 mils -25 mils) (rotation 0]) (justify "Right") (textStyleRef "Default"))
		))
		(pin (pinNum 7) (pt 1100 mils -100 mils) (rotation 180) (pinLength 200 mils) (pinDisplay (dispPinName true)) (pinName (text (pt 870 mils -125 mils) (rotation 0]) (justify "Right") (textStyleRef "Default"))
		))
		(pin (pinNum 8) (pt 1100 mils -200 mils) (rotation 180) (pinLength 200 mils) (pinDisplay (dispPinName true)) (pinName (text (pt 870 mils -225 mils) (rotation 0]) (justify "Right") (textStyleRef "Default"))
		))
		(pin (pinNum 9) (pt 1100 mils -300 mils) (rotation 180) (pinLength 200 mils) (pinDisplay (dispPinName true)) (pinName (text (pt 870 mils -325 mils) (rotation 0]) (justify "Right") (textStyleRef "Default"))
		))
		(line (pt 200 mils 100 mils) (pt 900 mils 100 mils) (width 6 mils))
		(line (pt 900 mils 100 mils) (pt 900 mils -500 mils) (width 6 mils))
		(line (pt 900 mils -500 mils) (pt 200 mils -500 mils) (width 6 mils))
		(line (pt 200 mils -500 mils) (pt 200 mils 100 mils) (width 6 mils))
		(attr "RefDes" "RefDes" (pt 950 mils 300 mils) (justify Left) (isVisible True) (textStyleRef "Default"))

	)
	(compDef "67503-1020" (originalName "67503-1020") (compHeader (numPins 9) (numParts 1) (refDesPrefix J)
		)
		(compPin "1" (pinName "VBUS") (partNum 1) (symPinNum 1) (gateEq 0) (pinEq 0) (pinType Bidirectional))
		(compPin "2" (pinName "D-") (partNum 1) (symPinNum 2) (gateEq 0) (pinEq 0) (pinType Bidirectional))
		(compPin "3" (pinName "D+") (partNum 1) (symPinNum 3) (gateEq 0) (pinEq 0) (pinType Bidirectional))
		(compPin "4" (pinName "ID") (partNum 1) (symPinNum 4) (gateEq 0) (pinEq 0) (pinType Bidirectional))
		(compPin "5" (pinName "GND") (partNum 1) (symPinNum 5) (gateEq 0) (pinEq 0) (pinType Bidirectional))
		(compPin "MP1" (pinName "MP1") (partNum 1) (symPinNum 6) (gateEq 0) (pinEq 0) (pinType Bidirectional))
		(compPin "MP2" (pinName "MP2") (partNum 1) (symPinNum 7) (gateEq 0) (pinEq 0) (pinType Bidirectional))
		(compPin "MP3" (pinName "MP3") (partNum 1) (symPinNum 8) (gateEq 0) (pinEq 0) (pinType Bidirectional))
		(compPin "MP4" (pinName "MP4") (partNum 1) (symPinNum 9) (gateEq 0) (pinEq 0) (pinType Bidirectional))
		(attachedSymbol (partNum 1) (altType Normal) (symbolName "67503-1020"))
		(attachedPattern (patternNum 1) (patternName "675031020")
			(numPads 9)
			(padPinMap
				(padNum 1) (compPinRef "1")
				(padNum 2) (compPinRef "2")
				(padNum 3) (compPinRef "3")
				(padNum 4) (compPinRef "4")
				(padNum 5) (compPinRef "5")
				(padNum 6) (compPinRef "MP1")
				(padNum 7) (compPinRef "MP2")
				(padNum 8) (compPinRef "MP3")
				(padNum 9) (compPinRef "MP4")
			)
		)
		(attr "Manufacturer_Name" "Molex")
		(attr "Manufacturer_Part_Number" "67503-1020")
		(attr "Mouser Part Number" "538-67503-1020")
		(attr "Mouser Price/Stock" "https://www.mouser.co.uk/ProductDetail/Molex/67503-1020?qs=7zcQ9RRVJlhHWuXYKEhKMg%3D%3D")
		(attr "Arrow Part Number" "")
		(attr "Arrow Price/Stock" "")
		(attr "Description" "USB Connectors USB Mini-B Recept On-The-Go Rt.Angle")
		(attr "Datasheet Link" "https://www.molex.com/pdm_docs/sd/675031020_sd.pdf")
		(attr "Height" "4.05 mm")
	)

)
