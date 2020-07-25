<?php
/*###############################################################
---------------------------------------------------------------
@package: Google Map Class
---------------------------------------------------------------
@author:  Mitchelle C. Pascual 
---------------------------------------------------------------
@email:   mitch.pascual at gmail dot com
---------------------------------------------------------------
@site:    http://ordinarywebguy.wordpress.com
---------------------------------------------------------------
@date:    March 27, 2007
---------------------------------------------------------------
@warning: Use this class at your own risk. Not recommended to
          set more than 20 addresses at a time.
---------------------------------------------------------------
###############################################################


This class is a Google Map generator / locator which features the ff.

1. Generate location via Address. (using the GClientGeocoder()).
2. Selection of different styles of icon.
3. Selection of different colors of icon.
4. Supports multiple addresses.
5. Customize info window text.
6. Customize click link text for multiple addresses.


---------------------------------------------------------------
How to use:
---------------------------------------------------------------
1. Register google map key at http://www.google.com/apis/maps/signup.html
2. Extract EasyGoogleMap class.
3. Creat php file.
4. Insert the ff. code.


---------------------------------------------------------------
Sample Code
---------------------------------------------------------------*/
//<?php
    require('class/EasyGoogleMap.class.php');

$gm = & new EasyGoogleMap("ABQIAAAACezl5OES8dMDmq_DvDePXxR1DJfR2IAi0TSZmrrsgSOYoGgsxBTxN5RDergBZIkIAfmbeWXNM3zdtg");
//$gm->SetAddress("10 market st, san francisco");
//$gm->SetInfoWindowText("This is the address # 1.");
//$gm->SetSideClick('address 1');

//$gm->SetAddress("Manila, Philippines");
//$gm->SetInfoWindowText("This is Philippine Country.");
//$gm->SetSideClick('Philippines');

$gm->SetAddress("Jalan Nuri, Kota Damansara");
$gm->SetInfoWindowText("This Country is Selangor");
$gm->SetSideClick('KotaDmsara');

$gm->SetAddress("Kg Kota, Kelantan");
$gm->SetInfoWindowText("This Country is Kelantan");
$gm->SetSideClick('KotaBharu');
?>
<html>
<head>
<title>EasyGoogleMap</title>
<?php echo $gm->GmapsKey(); ?>
</head>
<body>
<?php echo $gm->MapHolder(); ?>
<?php echo $gm->InitJs(); ?>
<?php echo $gm->GetSideClick(); ?>
<?php echo $gm->UnloadMap(); ?>
</body>
</html>
<?php
//---------------------------------------------------------------
//End Sample Code
//---------------------------------------------------------------
//4. Test and run.
/*

//---------------------------------------------------------------
//Setting Up Properties:
//---------------------------------------------------------------
//#To Enable/Disable Map Continuous Zooming
$gm->mContinuousZoom = FALSE; # default

//#To Enable/Disable Map Double Click Zooming
$gm->mDoubleClickZoom = FALSE; # default

//#To Enable/Disable Map Scale (MI/KM)
$gm->mScale = TRUE; # default

//#To Enable/Disable Map Inset
$gm->mInset = FALSE; # default

//#To Enable/Disable Map Type (Map/Satellite/Hybrid)
$gm->mMapType = FALSE; # default


//---------------------------------------------------------------
//How to set map height and width:
//---------------------------------------------------------------
$gm->SetMapWidth(750); # default = 300
$gm->SetMapHeight(500); # default = 300


//---------------------------------------------------------------
//How to set map zoom:
//---------------------------------------------------------------
$gm->SetMapZoom(10); # default = 13


//---------------------------------------------------------------
//How to set map control if set to true:
//---------------------------------------------------------------
//#Just execute one of the ff.

$gm->SetMapControl('SMALL_PAN_ZOOM'); # default
$gm->SetMapControl('LARGE_PAN_ZOOM');
$gm->SetMapControl('SMALL_ZOOM');
$gm->SetMapControl('NONE');


//---------------------------------------------------------------
//How to customize icon:
//---------------------------------------------------------------
//#Styles:
//#Just execute one of the ff.

$gm->SetMarkerIconStyle('FLAG');
$gm->SetMarkerIconStyle('GT_FLAT'); # default
$gm->SetMarkerIconStyle('GT_PILLOW');
$gm->SetMarkerIconStyle('HOUSE');
$gm->SetMarkerIconStyle('PIN');
$gm->SetMarkerIconStyle('PUSH_PIN');
$gm->SetMarkerIconStyle('STAR');

//#Colors:
//#Just execute one of the ff.

$gm->SetMarkerIconColor('PACIFICA'); # default
$gm->SetMarkerIconColor('YOSEMITE');
$gm->SetMarkerIconColor('MOAB');
$gm->SetMarkerIconColor('GRANITE_PINE');
$gm->SetMarkerIconColor('DESERT_SPICE');
$gm->SetMarkerIconColor('CABO_SUNSET');
$gm->SetMarkerIconColor('TAHITI_SEA');
$gm->SetMarkerIconColor('POPPY');
$gm->SetMarkerIconColor('NAUTICA');
$gm->SetMarkerIconColor('DEEP_JUNGLE');
$gm->SetMarkerIconColor('SLATE');


//---------------------------------------------------------------
//How to set address(es):
//---------------------------------------------------------------
//$gm->SetAddress("Manila, Philippines");
//$gm->SetAddress("10 market st, san francisco");


//---------------------------------------------------------------
//How to customize set address info text window:
//---------------------------------------------------------------
$gm->SetInfoWindowText("This is the address # 1.");

//Note: If this method (SetInfoWindowText) wasn't called, the set address will be the default info window text.


//---------------------------------------------------------------
//How to customize click link for multiple addresses:
//---------------------------------------------------------------
$gm->SetSideClick("Click here for the address # 1.");

//Note: If this method (SetSideClick) wasn't called, the set address will be the default click link text.


//################################################################
//For any comments, suggestions and recommendations please contact at mitch.pascual at gmail dot com.
//################################################################


*/
?>