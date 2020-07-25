<?php
$gmt = "-5";$gmt="-5";$dateFormat=2;$dateFormat=2;$tableWidth=175;$cellSpacing=1;
$cellPadding=0;$weekDayStart=0;$displayYear=1;$highlightToday=1;$resetEvents=1;$displayEmptyRows=1;

//////////////////////////////
// mySQL DATABASE SETUP //////
//////////////////////////////
include_once ('mysql_connect2cfg.php');

//////////////////////////////
// FLAT-FILE DATABASE SETUP //
//////////////////////////////
$readFile=0;
//////////////////////////////
// ADMINISTRATION SETUP //////
//////////////////////////////

// SET ADMINISTRATION LINK 
$fileName = "projek_kriteria_nilai_tender.php";
$calendarLink = "Lampiran_ABC.php";




//earthwork
$kriteria [111] = " Survey Plan.";
$kriteria [112] = " Layout Plan.";
$kriteria [113] = " Earthwork Site Clearing Proposal.";
$kriteria [114] = " JPS Flood Level Confirmation.";
$kriteria [115] = "";

$kriteria [121] = " Design Criteria & Calculation.";
$kriteria [122] = " Platform & Structure";
$kriteria [123] = " Cut & Fill";
$kriteria [124] = " Surplus / Imported";
$kriteria [125] = "";

$kriteria [131] = " Details Drawing / Cross Section.";
$kriteria [132] = " Slope & Retaining Structure.";
$kriteria [133] = " Slope Protection.";
$kriteria [134] = " P.E Endorsement.";
$kriteria [135] = " Drawing Size/ Presentation.";
$kriteria [136] = " Materials/ Bronsure.*";
$kriteria [137] = "";

//roadwork
$kriteria [211] = " Layout Plan.";
$kriteria [212] = "";

$kriteria [221] = " Design Criteria & Calculation.";
$kriteria [222] = " Geometric Design.";
$kriteria [223] = " Pavement Design.";
$kriteria [224] = " Road Furniture.";
$kriteria [225] = "";

$kriteria [231] = " Details Drawing / Cross Section.";
$kriteria [232] = " Approach/Access Road.";
$kriteria [233] = " P.E Endorsement.";
$kriteria [234] = " Drawing Size/ Presentation.";
$kriteria [235] = " Materials/ Bronsure.*";
$kriteria [236] = "";

//watersupply
$kriteria [311] = " Layout Plan.";
$kriteria [312] = " Storage Capacity.";
$kriteria [313] = " JBA Water Pressure Confirmation.";
$kriteria [314] = "";

$kriteria [321] = " Design Criteria & Calculation.";
$kriteria [322] = "";
$kriteria [323] = "";
$kriteria [324] = "";
$kriteria [325] = "";

$kriteria [331] = " Details Drawing / Cross Section.";
$kriteria [332] = " Materials/ Bronsure.";
$kriteria [333] = " P.E Endorsement.";
$kriteria [334] = " Drawing Size/ Presentation.";
$kriteria [335] = "";


//sewerage
$kriteria [411] = " Layout Plan.";
$kriteria [412] = " Storage Capacity.";
$kriteria [413] = " STP/ Septic - Approved Supplier.";
$kriteria [414] = " JPP Confirmation on available networks.";
$kriteria [414] = "";

$kriteria [421] = " Design Criteria & Calculation.";
$kriteria [422] = "";
$kriteria [423] = "";
$kriteria [424] = "";
$kriteria [425] = "";

$kriteria [431] = " Details Drawing / Cross Section.";
$kriteria [432] = " Materials/ Bronsure.";
$kriteria [433] = " P.E Endorsement.";
$kriteria [434] = " Drawing Size/ Presentation.";
$kriteria [435] = "";


//drainage
$kriteria [511] = " Layout Plan.";
$kriteria [512] = " JPS Flood Level Confirmation.";
$kriteria [513] = "";
$kriteria [514] = "";

$kriteria [521] = " Design Criteria & Calculation.";
$kriteria [522] = " Compliance to MASMA";
$kriteria [523] = "";
$kriteria [524] = "";
$kriteria [525] = "";

$kriteria [531] = " Details Drawing / Cross Section.";
$kriteria [532] = " Materials/ Bronsure.";
$kriteria [533] = " P.E Endorsement.";
$kriteria [534] = " Drawing Size/ Presentation.";
$kriteria [535] = "";


?>