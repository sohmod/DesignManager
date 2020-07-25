<?php
// Easily Simple Calendar
// Version 4.8
// Copyright 2001-2004 NashTech
// http://www.EasilySimpleCalendar.com

///////////////////////////////////////////
// LICENSING NOTICE ///////////////////////
///////////////////////////////////////////

// Please see the license.txt file for the Terms of Use.
// Visit our web site for the most-current version of the license.

//////////////////////////////
// CALENDAR DISPLAY SETUP ////
//////////////////////////////

// TIME ZONE -- GMT
// Enter the GMT value of your time zone.
// For positive "+" values, simply enter the number. For example, GMT +1 :: $gmt = "1";
// For negative "-" values, you must enter a minus sign before the number. For example, GMT -5 :: $gmt = "-5";
$gmt="-5";

// DATE FORMAT
// Set the format of dates according to the examples below
// $dateFormat=1 :: mm-dd-yyyy
// $dateFormat=2 :: dd-mm-yyyy
$dateFormat=2;
$dateFormat=2;

// WIDTH OF CALENDAR TABLE
// *** Make sure the width is set to a multiple of 7.
// *** This will ensure you have evenly spaced columns.
$tableWidth=175;

// CALENDAR CELL SPACING AND PADDING
// Set $cellSpacing to the number of pixels of cell spacing (space between each cell)
// Set $cellPadding to the number of pixels of cell padding (space around names and numbers inside cells)
$cellSpacing=1;
$cellPadding=0;

// FIRST DAY OF THE CALENDAR WEEK
// 0=Sunday; 1=Monday; 2=Tuesday; 3=Wednesday; 4=Thursday; 5=Friday; 6=Saturday
$weekDayStart=0;

// DISPLAY YEAR
// $displayYear=1 :: Will display the year number after the month name.
// By setting $displayYear to any number other than 1, the script will NOT display the year.
$displayYear=1;

// HIGHLIGHT TODAY
// $highlightToday=1 :: Will highlight today's date.
// By setting $highlightToday to any number other than 1, the script will NOT highlight todays date.
$highlightToday=1;

// RESET EVENT DATA
// $resetEvents=1 :: Will reset the event start, event end and event descriptions variables.
// By setting $resetEvents to any number other than 1, the script will NOT reset the variables.
// This is useful if you have multiple calendars on the same page and only use SQL or flat file databases.
$resetEvents=1;

// DISPLAY EMPTY CALENDAR ROWS
// $displayEmptyRows=1 :: Display the sixth row of the calendar even if there are not dates on that row.
// Setting $displayEmptyRows to any number but one (1), the script will NOT display empty calendar rows.
$displayEmptyRows=1;

//////////////////////////////
// mySQL DATABASE SETUP //////
//////////////////////////////

// READ EVENTS DATA FROM mySQL DATABASE
// You can not use mySQL events and $es/$ee command-line variables together. It will procude errors.
// $readSQL=1 :: Read dates and events for marking the calendar from a mySQL database.
// Setting $readSQL to any number but one (1), the script will NOT attempt to read mySQL data.
$readSQL=0;

// SET DATABASE CONNECTION IF USING mySQL DATABASE
// Set the variables below to connect to your mySQL server
$dbHost      = "localhost";  // Host Name
$dbUserLogin = "username";  // User Name
$dbPassword  = "password";  // User Password
$dbName      = "ckaj";  // Database Name

//////////////////////////////
// FLAT-FILE DATABASE SETUP //
//////////////////////////////

// READ EVENTS CALENDAR FROM FILE
// You can not use flat-file events and $es/$ee command-line variables together. It will procude errors.
// $readFile=1 :: Read dates and events for marking the calendar from the esdates.txt file.
// That file sould be located in the same directory as this script.
// Setting $readFile to any number but one (1), the script will NOT attempt to read the estates.txt file.
$readFile=0;

//////////////////////////////
// ADMINISTRATION SETUP //////
//////////////////////////////

// SET CALENDAR ADMINISTRATION LINK 
$fileName = "projek_daftar.php";

// SET CALENDAR LINK (The name of the actual calendar file)
$calendarLink = "projek_daftar.php";

// MAXIMUM NUMBER OF DAYS FOR EVENTS
$maxDays = 14;

// MAXIMUM NUMBER OF YEARS FOR EVENTS
$maxYears = 5;

//////////////////////////////
// POP-UP SETUP //////////////
//////////////////////////////

// USE STANDARD POP-UP WINDOW
// The Standard Pop-up window will appear if someone clicks on a date that has an event.
// $standardPop=1 :: For dates with events that have descriptions, show the standard pop-up window.
// Setting $standardPop to any number but one (1), the script will NOT use the standard pop-up window.
$standardPop=1;
$popupWidth=250;  // SET THE WIDTH OF THE EVENT VIEW POPUP WINDOW
$popupHeight=220; // SET THE HEIGHT OF THE EVENT VIEW POPUP WINDOW

//////////////////////////////
// LANGUAGE SETUP ////////////
//////////////////////////////

// DAY NAMES
// Edit the day name column headers below
$day[0]="S";
$day[1]="M";
$day[2]="T";
$day[3]="W";
$day[4]="T";
$day[5]="F";
$day[6]="S";

// MONTH NAMES
// Edit the month names below
$mth[1]="January";
$mth[2]="February";
$mth[3]="March";
$mth[4]="April";
$mth[5]="May";
$mth[6]="June";
$mth[7]="July";
$mth[8]="August";
$mth[9]="September";
$mth[10]="October";
$mth[11]="November";
$mth[12]="December";

//Jawatan dan KP

$programtxt = array (0=>'kerja',1=>'CKBA',2=>'CJLN',3=>'CKKsih',4=>'CKKsel',5=>'CKPT',6=>'UMUM');


$VOICtxt = array (0=>'PENGARAH',1=>'KPPK(BA)',2=>'KPPK(LB)',3=>'KPPK(Ksih)',4=>'KPPK(Ksel)',5=>'KPPK(PT)');
$VOIC_kp = array ('123456-78-9000','700202-02-0202','600101-01-0101','600306-02-5278','611121-03-5422','590803-10-6312');
$oic_kp = array_combine($VOICtxt, $VOIC_kp);

$VOIC_FAIL = array ('JKR.CKAJ/01.500/020/','JKR.CKAJ/05.500/020/','JKR.CKAJ/06.500/020/','JKR.CKAJ/07.500/020/',
'JKR.CKAJ/08.500/020/','JKR.CKAJ/09.500/020/');
$oic_FAIL = array_combine($VOICtxt, $VOIC_FAIL);

$VOIC_PROG = array ('UMUM','CKBA','CJLN','CKKsih','CKKsel','CKPT');
$oic_PROG = array_combine($VOICtxt , $VOIC_PROG);


//$Vlokasitxt = array (0=>'Msia',1=>'KELA',2=>'TERE',3=>'PAHA',4=>'NEG9',5=>'MELA',6=>'JOHO',
//7=>'PERL',8=>'KEDA',9=>'PINA',10=>'PERA',11=>'SELA',12=>'WPKL',13=>'WPPJ',14=>'WPLB',15=>'SABA',16=>'SERA');
$Vlokasitxt = array (0=>'MALAYSIA',1=>'KELANTAN',2=>'TERENGGANU',3=>'PAHANG',4=>'NEGERI SEMBILAN',5=>'MELAKA',6=>'JOHOR',
7=>'PERLIS',8=>'KEDAH',9=>'PULAU PINANG',10=>'PERAK',11=>'SELANGOR',12=>'WP KUALA LUMPUR',13=>'WP PUTRAJAYA',14=>'WP LABUAN',15=>'SABAH',16=>'SERAWAK');
$Vlokasi_kod = array ('MY','D','T','C','N','M','J','R','K','P','A','B','WPKL','WPPJ','WPLB','SB','SR');
$KOD_NEG = array_combine($Vlokasitxt , $Vlokasi_kod);


////KEMENTERIAN
$KemKlientFull = array(
0=>'KERAJAAN MALAYSIA',
1=>'JABATAN PERDANA MENTERI',
2=>'KEWANGAN',
3=>'KESELAMATAN DALAM NEGERI',
4=>'PERTAHANAN',
5=>'PERUMAHAN DAN KERAJAAN TEMPATAN',
6=>'KERJA RAYA',
7=>'TENAGA,AIR DAN KOMUNIKASI',
8=>'PERDAGANGAN ANTARABANGSA DAN INDUSTRI',
9=>'LUAR NEGERI',
10=>'PERTANIAN DAN INDUSTRI ASAS TANI',
11=>'SUMBER MANUSIA',
12=>'SUMBER ASLI DAN ALAM SEKITAR',
13=>'PELAJARAN MALAYSIA',
14=>'KEBUDAYAAN,KESENIAN DAN WARISAN',
15=>PEMBANGUNAN WANITA, KELUARGA DAN MASYARAKAT',
16=>'SAINS,TEKNOLOGI DAN INOVASI',
17=>'PENGANGKUTAN',
18=>'PERUSAHAAN PERLADANGAN DAN KOMODITI',
19=>'PERDAGANGAN DALAM NEGERI DAN EHWAL PENGGUNA',
20=>'KEMAJUAN LUAR BANDAR DAN WILAYAH',
21=>'PEMBANGUNAN USAHAWAN DAN KOPERASI',
22=>'PENGAJIAN TINGGI',
23=>'HAL EHWAL DALAM NEGERI',
24=>'KESIHATAN',
25=>'PENERANGAN',
26=>'WILAYAH PERSEKUTUAN',
27=>'PELANCONGAN MALAYSIA');

////
$KemKlientAbbre = array(
'',
'JPM',
'MOF',
'MOIS',
'MOD',
'KPKT',
'KKR',
'KTAK',
'MITI',
'KLN',
'AGRI',
'MOHR',
'JAS',
'MOE',
'KEKWA',
'KPWKM',
'MOSTI',
'MOT',
'KPPK',
'KPDNEP',
'KPLB',
'MECD',
'MOHE',
'MOHA',
'MOH',
'KEMPEN',
'KWP',
'MOTOUR');

$KOD_KEM = array_combine($KemKlientFull, $KemKlientAbbre);



?>