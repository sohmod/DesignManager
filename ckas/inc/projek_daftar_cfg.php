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
$fileName = "projek_daftar.php";
$calendarLink = "projek_daftar.php";

/*/Jawatan dan KP
$programtxt = array (
0=>'kerja',
1=>'CKBA',
2=>'CJLN',
3=>'CKKsih',
4=>'CKKsel',
5=>'CKPT',
6=>'BKA'  // UMUM
);*/
//Jawatan dan KP
$programtxt = array (
0=>'BKA',
1=>'CKBA',
2=>'CJLN',
3=>'CKKsih',
4=>'CKKsel',
5=>'CKPT'
);

$VOICtxt = array (
0=>'PENGARAH',
1=>'KPPK(BA)',
2=>'KPPK(LB)',
3=>'KPPK(Ksih)',
4=>'KPPK(Ksel)',
5=>'KPPK(PT)'
);

$VOIC_kp = array (
'123456-78-9000',
'700202-02-0202',
'600101-01-0101',
'600306-02-5278',
'611121-03-5422',
'590803-10-6312'
);
$oic_kp = array_combine($VOICtxt, $VOIC_kp);

$VOIC_FAIL = array (
'jkr.ckasj/01.500/020/',
'jkr.ckasj/05.500/020/',
'jkr.ckasj/06.500/020/',
'jkr.ckasj/07.500/020/',
'jkr.ckasj/08.500/020/',
'jkr.ckasj/09.500/020/'
);
$oic_FAIL = array_combine($VOICtxt, $VOIC_FAIL);
$programFAIL = array_combine($programtxt, $VOIC_FAIL);

$VOIC_NEWFAIL = array (
'JKR/CKAS/BKA/P-',
'JKR/CKAS/13/',
'JKR/CKAS/--/',
'JKR/CKAS/07/',
'JKR/CKAS/06/',
'JKR/CKAS/14/'
);
$oic_NEWFAIL = array_combine($VOICtxt, $VOIC_NEWFAIL);
$programNEWFAIL = array_combine($programtxt, $VOIC_NEWFAIL);


$VOIC_PROG = array (
'UMUM',
'CKBA',
'CJLN',
'CKKsih',
'CKKsel',
'CKPT'
);
$oic_PROG = array_combine($VOICtxt , $VOIC_PROG);


////-----------------------------------------------------------------------
$Vlokasitxt = array (
0=>'IBU PEJABAT JKR',
1=>'KELANTAN',
2=>'TERENGGANU',
3=>'PAHANG',
4=>'NEGERI SEMBILAN',
5=>'MELAKA',
6=>'JOHOR',
7=>'PERLIS',
8=>'KEDAH',
9=>'PULAU PINANG',
10=>'PERAK',
11=>'SELANGOR',
12=>'WP KUALA LUMPUR',
13=>'WP PUTRAJAYA',
14=>'WP LABUAN',
15=>'SABAH',
16=>'SERAWAK',
17=>'PELBAGAI NEGERI'
);


$Vlokasi_kod = array (
'IP',
'D',
'T',
'C',
'N',
'M',
'J',
'R',
'K',
'P',
'A',
'B',
'W',    //'WPKL',
'PJ',   //'WPPJ',
'L',   //'WPLB',
'S',    //'SB',
'QS',   //'SR'
'PEL'
);


$KOD_NEG = array_combine($Vlokasitxt , $Vlokasi_kod);

//////------------------------------------------------------------------------------------------------
////KEMENTERIAN
$KemKlientFull = array(
0=>'KERAJAAN MALAYSIA',
1=>'JABATAN PERDANA MENTERI',
2=>'KEWANGAN',
3=>'PERTAHANAN',
4=>'KESELAMATAN DALAM NEGERI',
5=>'PERUMAHAN DAN KERAJAAN TEMPATAN',
6=>'KERJA RAYA',
7=>'PERDAGANGAN ANTARABANGSA DAN INDUSTRI',
8=>'LUAR NEGERI',
9=>'PENERANGAN',
10=>'SUMBER MANUSIA',
11=>'BELIA DAN SUKAN',
12=>'PERDAGANGAN DALAM NEGERI DAN EHWAL PENGGUNA',
13=>'TENAGA,AIR DAN KOMUNIKASI',
14=>'PELAJARAN MALAYSIA',
15=>'PENGAJIAN TINGGI',
16=>'PEMBANGUNAN USAHAWAN DAN KOPERASI',
17=>'SUMBER ASLI DAN ALAM SEKITAR',
18=>'PERTANIAN DAN INDUSTRI ASAS TANI',
19=>'PENGANGKUTAN',
20=>'SAINS,TEKNOLOGI DAN INOVASI',
21=>'PELANCONGAN MALAYSIA',
22=>'PERPADUAN KEBUDAYAAN,KESENIAN DAN WARISAN',
23=>'PEMBANGUNAN WANITA, KELUARGA DAN MASYARAKAT',
24=>'KEMAJUAN LUAR BANDAR DAN WILAYAH',
25=>'PERUSAHAAN PERLADANGAN DAN KOMODITI',
26=>'KESIHATAN',
27=>'WILAYAH PERSEKUTUAN',
28=>'HAL EHWAL DALAM NEGERI',
29=>'-',
30=>'PELBAGAI KLIEN'
);

$VKEM_queryNO = array (0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30);
$kem_QUERYno = array_combine($KemKlientFull , $VKEM_queryNO); 
$kem_QUERYnumber = array_combine($KemKlientFull, $VKEM_queryNO); 
////
$KemKlientAbbre = array(
'MY',
'JPM',
'MOF',
'MOD',
'MOIS',
'KPKT',
'KKR',
'MITI',
'KLN',
'KEMPEN',
'MOHR',
'BDS',
'KPDNEP',
'KTAK',
'MOE',
'MOHE',
'MECD',
'JAS',
'AGRI',
'MOT',
'MOSTI',
'MOTOUR',
'KEKWA',
'KPWKM',
'KPLB',
'KPPK',
'MOH',
'KWP',
'MOHA',
'-',
'PIAWAI'
);

$KOD_KEM = array_combine($KemKlientFull, $KemKlientAbbre);
$kem_QUERYname = array_combine($KemKlientFull, $KemKlientAbbre); 
/////////////////
$VOICbka = array (
0=>"PENGARAH",
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

// unit kppk 
77=>"KPPK(BA)",
78=>"KPPK(PT)",
79=>"KPPK(Ksih)",
80=>"KPPK(Ksel)",

// staf baru 2015
81=>"_STAF_BARU_",
82=>"NFarhana",
83=>"MohdRaimiNabil",
84=>"SHaslina",
85=>"Noraida",
86=>"NorhayatiK"
);

/*
1=>"RAIHAN",
2=>"Dsherryls",
3=>"HidayahA",
4=>"Zainariah",
5=>"MKNizam",
6=>"Hanifarhana",
7=>"ZainalIB",
8=>"Hamzaniah",
9=>"PerekaPT1",
10=>"PerekaPT2",

11=>"ATIKAH",
12=>"Shahfizan", 
13=>"HayatiS",
14=>"MohdAzlanN",
15=>"Wirda",
16=>"SitiN", 
17=>"PerekaKE1", 
18=>"PerekaKE2", 

19=>"KHAIR", 
20=>"FazelaM",
21=>"NHWafi", 
22=>"Hasmarini",
23=>"Alifah",
24=>"PerekaKI1",
25=>"PerekaKI2",
26=>"PerekaKI3",

27=>"WKAMAL",
28=>"ISMAIL",
29=>"RAJA",
30=>"SHafifah",
31=>"Suzana",
32=>"Halawiyah",
33=>"MDzakir",
34=>"Mastura",
35=>"Intan",
*/

/////////////////  
$VOICkppk = array (
1=> 'ORDER 1: nombor semua fail',
2=> 'ORDER 2: tarikh daftar',
3=> 'ORDER 3: modus kerja',
4=> 'ORDER 4: saat daftar',
5=> 'ORDER 5: semua tajuk',
6=> 'ORDER 6: semua lokasi',
7=> 'ORDER 7: semua Perunding',
8=> 'ORDER 8: semua Perunding BD',
9=> 'ORDER 9: semua Inhouse',
10=> 'ORDER 10: fail KPPK(LB)',
11=> 'ORDER 11: fail KPPK(BA)',
12=> 'ORDER 12: fail KPPK(PT)',
13=> 'ORDER 13: fail KPPK(Ksih)',
14=> 'ORDER 14: fail KPPK(Ksel)',
15=> 'ORDER 15: Perunding KPPK(LB)',
16=> 'ORDER 16: Perunding KPPK(BA)',
17=> 'ORDER 17: Perunding KPPK(PT)',
18=> 'ORDER 18: Perunding KPPK(Ksih)',
19=> 'ORDER 19: Perunding KPPK(Ksel)',
20=> 'ORDER 20: Perunding BD KPPK(LB)',
21=> 'ORDER 21: Perunding BD KPPK(BA)',
22=> 'ORDER 22: Perunding BD KPPK(PT)',
23=> 'ORDER 23: Perunding BD KPPK(Ksih)',
24=> 'ORDER 24: Perunding BD KPPK(Ksel)',
25=> 'ORDER 25: Inhouse KPPK(LB)',
26=> 'ORDER 26: Inhouse KPPK(BA)',
27=> 'ORDER 27: Inhouse KPPK(PT)',
28=> 'ORDER 28: Inhouse KPPK(Ksih)',
29=> 'ORDER 29: Inhouse KPPK(Ksel)',
30=> 'ORDER 30: donno modus kerja'
);

$VOIC_queryNO = array (1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30);

$oic_QUERYno = array_combine($VOICkppk , $VOIC_queryNO ); 

//////////////////////////////////////test downward
/*

if (!isset($_REQUEST['ChooseProj'])) { $_REQUEST['ChooseProj']="dummy"; }
if (!isset($_REQUEST['ListAll'])) { $_REQUEST['ListAll']="dummy"; }
if (!isset($_REQUEST['Submit'])) { $_REQUEST['Submit']="dummy"; }
if (!isset($_REQUEST['event'])) { $_REQUEST['event']="dummy"; }
if (!isset($_REQUEST['month'])) { $_REQUEST['month']="dummy"; }
if (!isset($_REQUEST['day'])) { $_REQUEST['day']="dummy"; }
if (!isset($_REQUEST['year'])) { $_REQUEST['year']="dummy"; }
if (!isset($_REQUEST['end'])) { $_REQUEST['end']="dummy"; }
if (!isset($_REQUEST['eventLength'])) { $_REQUEST['eventLength']="dummy"; }
if (!isset($_REQUEST['eid'])) { $_REQUEST['eid']="dummy"; }
if (!isset($_REQUEST['del'])) { $_REQUEST['del']="dummy"; }
if (!isset($_REQUEST['daftar_id'])) { $_REQUEST['daftar_id']="dummy"; }



if (!isset($_REQUEST['username'])) { $_REQUEST['username']="dummy"; }
if (!isset($_REQUEST['tajuk'])) { $_REQUEST['tajuk']="dummy"; }
if (!isset($_REQUEST['lokasi'])) { $_REQUEST['lokasi']="dummy"; }
if (!isset($_REQUEST['mod_kerja'])) { $_REQUEST['mod_kerja']="dummy"; }
if (!isset($_REQUEST['OIC'])) { $_REQUEST['OIC']="dummy"; }
if (!isset($_REQUEST['start'])) { $_REQUEST['start']="dummy"; }
if (!isset($_REQUEST['siap'])) { $_REQUEST['siap']="dummy"; }
if (!isset($_REQUEST['kp_s'])) { $_REQUEST['kp_s']="dummy"; }
if (!isset($_REQUEST['program'])) { $_REQUEST['program']="dummy"; }
if (!isset($_REQUEST['catatan'])) { $_REQUEST['catatan']="dummy"; }
if (!isset($_REQUEST['nosiri_fail'])) { $_REQUEST['nosiri_fail']="dummy"; }
if (!isset($_REQUEST['birth_date'])) { $_REQUEST['birth_date']="dummy"; }
if (!isset($_REQUEST['KemKlient'])) { $_REQUEST['KemKlient']="dummy"; }



if (!isset($_REQUEST['usernameEV'])) { $_REQUEST['usernameEV']="dummy"; }
if (!isset($_REQUEST['tajukEV'])) { $_REQUEST['tajukEV']="dummy"; }
if (!isset($_REQUEST['lokasiEV'])) { $_REQUEST['lokasiEV']="dummy"; }
if (!isset($_REQUEST['mod_kerjaEV'])) { $_REQUEST['mod_kerjaEV']="dummy"; }
if (!isset($_REQUEST['OICEV'])) { $_REQUEST['OICEV']="dummy"; }
if (!isset($_REQUEST['startEV'])) { $_REQUEST['startEV']="dummy"; }
if (!isset($_REQUEST['siapEV'])) { $_REQUEST['siapEV']="dummy"; }
if (!isset($_REQUEST['kp_sEV'])) { $_REQUEST['kp_sEV']="dummy"; }
if (!isset($_REQUEST['programEV'])) { $_REQUEST['programEV']="dummy"; }
if (!isset($_REQUEST['catatanEV'])) { $_REQUEST['catatanEV']="dummy"; }
if (!isset($_REQUEST['nosiri_failEV'])) { $_REQUEST['nosiri_failEV']="dummy"; }
if (!isset($_REQUEST['birth_dateEV'])) { $_REQUEST['birth_dateEV']="dummy"; }
if (!isset($_REQUEST['KemKlientEV'])) { $_REQUEST['KemKlientEV']="dummy"; }



if (!isset($_REQUEST['Vusername'])) { $_REQUEST['Vusername']="dummy"; }
if (!isset($_REQUEST['Vtajuk'])) { $_REQUEST['Vtajuk']="dummy"; }
if (!isset($_REQUEST['Vlokasi'])) { $_REQUEST['Vlokasi']="dummy"; }
if (!isset($_REQUEST['Vmod_kerja'])) { $_REQUEST['Vmod_kerja']="dummy"; }
if (!isset($_REQUEST['VOIC'])) { $_REQUEST['VOIC']="dummy"; }
if (!isset($_REQUEST['Vstart'])) { $_REQUEST['Vstart']="dummy"; }
if (!isset($_REQUEST['Vsiap'])) { $_REQUEST['Vsiap']="dummy"; }
if (!isset($_REQUEST['Vkp_s'])) { $_REQUEST['Vkp_s']="dummy"; }
if (!isset($_REQUEST['Vprogram'])) { $_REQUEST['Vprogram']="dummy"; }
if (!isset($_REQUEST['Vcatatan'])) { $_REQUEST['Vcatatan']="dummy"; }
if (!isset($_REQUEST['Vnosiri_fail'])) { $_REQUEST['Vnosiri_fail']="dummy"; }
if (!isset($_REQUEST['Vbirth_date'])) { $_REQUEST['Vbirth_date']="dummy"; }
if (!isset($_REQUEST['VKemKlient'])) { $_REQUEST['VKemKlient']="dummy"; }

*/

error_reporting (0); // Production level



?>
