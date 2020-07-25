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
$fileName = "projek_butiran.php";
$calendarLink = "projek_butiran.php";


//Pereka

$perekaBKAwam = array (
0=>"Perunding",
// ppt
1=>"RAIHAN",
2=>"AznanShukri",   //"Dsherryls",
3=>"FirdausB",      //"HidayahA",
4=>"Yaakub",        //"Zainariah",
5=>"YusriZ",        //"MKNizam",
6=>"SuhainaR",      //"Hanifarhana",
7=>"ZainalIB",
8=>"Darwin",        //"Hamzaniah",IskhandarMY,Leena
9=>"Syahidan",
10=>"Hazrul",
11=>"saadiaahl",
12=>"zaharah",
13=>"ahmads",  // AHMADS
14=>"abdullahd", // ABDULLAHD
15=>"Azlia",

// ksi
16=>"KHAIR", 
17=>"Nurzalisa",
18=>"AmirAsrol",     //"FazelaM",
19=>"Zawiyatul",     //"NHWafi", 
20=>"Nurfahmi",      //"Hasmarini",
21=>"NurAfifi",      //"Alifah",
22=>"Hazwan",
23=>"ShazwaniJ",
24=>"Kamariza",
25=>"WanIsnizar",
26=>"SafuraD",
27=>"SuhanaMN",
28=>"NikZailan",
29=>"NurainiAG",
30=>"Elniza",
31=>"MohdIzudin",
32=>"norlizah",  // NORLIZAH

// kse
33=>"ATIKAH",  // Atikah
34=>"Amalludin",
35=>"Aslinda",
36=>"AtiqahZainal",
37=>"AzlinAB",
38=>"Ervina",
39=>"IzwanShah",
40=>"JamesM",
41=>"BadrulHishamY",
42=>"MuhdAli",
43=>"Nurfitri",
44=>"Nurhayati",
45=>"NurulAinn",
46=>"RabiatunR",
47=>"Rohaizi",
48=>"Shahrizatul",
49=>"SitiAisyahAW",
50=>"Wirda",
51=>"YasminK",
52=>"Zulhisam",

// bgn am
53=>"ISMAIL",
54=>"CMZawawi",    //"RAJA",
55=>"AliAmran",    //"WKAMAL",
56=>"HANIFAH",     //"SHafifah",
57=>"KhairulH",    //"Suzana",
58=>"Nadzim",      //"Halawiyah",
59=>"FarizAdlan",  //"MDzakir",
60=>"MFarizal",    //"Mastura","Intan" Jeffryl
61=>"Irwadi",  
62=>"NazriHK",
63=>"Yatimi",
64=>"NoorAishah",
65=>"Mazura",
66=>"NorazmiMB",  
67=>"Norasyikin",
68=>"NorlidaMS",
69=>"Rabbiatul",
70=>"RahayuMD",
71=>"Salasiah_JAM",
72=>"shahrom", // SHAHROM
73=>"SMunir",
74=>"SAsmah",
75=>"SKhodijah",
76=>"Bahri",

// staf baru 2015
77=>"_STAF_BARU_",
78=>"NFarhana",
79=>"MohdRaimiNabil",
80=>"SHaslina",
81=>"Noraida",
82=>"NorhayatiK"
);
  
?>
