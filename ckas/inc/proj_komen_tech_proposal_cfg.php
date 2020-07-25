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

// SET CALENDAR ADMINISTRATION LINK 
$fileName = "proj_komen_tech_proposal.php";
$calendarLink = "Lampiran_ABC.php";



//***********************************************************************************************************
//1.0	GENERAL

//1.1	Persembahan Lukisan	
	$komen [111] = " a.	Label pada lukisan";
	$komen [112] = " b.	Susunatur lukisan - Survey,Earthwork,Drainage, Road, Water, Sewer";	
	$komen [113] = " c.	Title Block";
	$komen [114] = " d.	Skala";
	$komen [115] = " e.	Penggunaan Kod Warna";
	$komen [116] = " f.	Legend dan nota selaras dengan pelan susunatur";
	$komen [117] = " g.	Penggunaan saiz & jenis tullisan yang standard";
		
//1.2	Skop Kerja	
	$komen [121] = " a.	Earthwork";
	$komen [122] = " b.	Drainage Sistem";
	$komen [123] = " c.	Road Sistem";
	$komen [124] = " d.	Sewerage sistem";
	$komen [125] = " e.	Water Supply";
		
//1.3	Design criteria	
	$komen [131] = " a.	Earthwork";
	$komen [132] = " b.	Drainage Sistem";
	$komen [133] = " c.	Road Sistem";
	$komen [134] = " d.	Sewerage sistem";
	$komen [135] = " e.	Water Supply";
		
//1.4	Laporan Rekabentuk	
	$komen [141] = " a.	Earthwork";
	$komen [142] = " b.	Drainage Sistem";
	$komen [143] = " c.	Road Sistem";
	$komen [144] = " d.	Sewerage sistem";
	$komen [145] = " e.	Water Supply";
		
		
//1.5	Pengiraan Rekabentuk	
	$komen [151] = " a.	Site Work";
	$komen [152] = " b.	Drainage Sistem";
	$komen [153] = " c.	Road Sistem";
	$komen [154] = " d.	Sewerage sistem";
	$komen [155] = " e.	Water Supply";
		
$komen [160] = " 1.6	Laporan Penyiasatan Tapak ( SI report )";
		
$komen [170] = " 1.7	Laporan EIA atau EMP";
		
$komen [180] = " 1.8	Pelan Ukur Kejuruteraan";
		
$komen [190] = " 1.9	Cop P.E dan Tandatangan";
		
		
//2.0		EARTHWORK
		
$komen [210] = " 2.1	Mematuhi M.S Standard / Btritish Standard code of Practice B.S 6031:1981 & MASMA";
		
$komen [220] = " 2.2	Pelan Susunatur Kerja Tanah	- no  lukisan";
		
	$komen [221] = " 2.2.1		Nota & Legend";
		
	$komen [222] = " 2.2.2		Sempadan Kerja Tanah";
		
	$komen [223] = " 2.2.3		Rekabentuk Platform kerja tanah sedia ada & yang akan datang";
		
	$komen [224] = " 2.2.4		Rekabentuk Formasi mestilah melepasi aras banjir yang direkabentuk atau diperolehi daripada JPS";
		
$komen [230] = " 2.3	Keratan Rentas Kerja Tanah 	-  no  lukisan";

$komen [240] = " 2.4	Laporan/lukisan ESCP	-  laporan &  lukisan";
		
	$komen [241] = " 2.4.1		Perangkap kelodak & Struktur berkaitan";
		
	$komen [242] = " 2.4.2		Kiraan hidraulik untuk perangkap kelodak / Kolam MASMA";

$komen [250] = " 2.5	Sistem Saliran sementara";

$komen [260] = " 2.6	'Turfing' mestilah mematuhi JKR Standard Spesifikasi & Building Work 2005 & JKR Green Mision";
		
$komen [270] = " 2.7	Struktur Penahan / Slope protection";
		
$komen [280] = " 2.8	Wash Trough";
		
//3.0		DRAINAGE SYSTEM

$komen [310] = " 3.1	Rekabentuk kerja saliran perlu mengambilkira keperluan JKR, JPS & PBT";

$komen [320] = " 3.2	Sistem saliran mestilah memenuhi kehendak MASMA. Direkabentuk dan dibina supaya menepati ciri-ciri hidraulik";

$komen [330] = " 3.3	Pelan susunatur sistem saliran";

	$komen [331] = " 3.3.1	Nota & Legend";

	$komen [332] = " 3.3.2	Sistem penyaliran mestilah direkabentuk disekeliling dan kiri kanan jalan";

$komen [340] = " 3.4	Semua longkang  keliling bangunan hendaklah ditutup";

$komen [350] = " 3.5	Butiran dan perincian lukisan";

$komen [360] = " 3.6	Semua longkang masuk dan keluar dari bangunan mestilah ditutup dengan penapak konkrit /jeriji besi";

$komen [370] = " 3.7	Struktur keselamatan mestilah disediakan/dicadangkan dimana-mana perlu";

// 3.8	Rekabentuk	

//3.8.1	Rekabentuk saliran perlu mematuhi kriteria minimum berikut :	
	$komen [381] = " 	a.	Perimeter Drain : Direkabentuk untuk 2 thn ARI dan disemak berdasarkan 5 Tahun ARI";
	$komen [382] = " 	b.	Saliran air Permukaan : Direkabentuk untuk 10 tahun ARI dan disemak berdasarkan 25 tahun ARI";
	$komen [383] = " 	c.	Pond direkabentuk untuk 25 tahun ARI dan disemak berdasarkan 100 tahun ARI";

$komen [390] = " 3.9	Kolam takungan ( jika ada )";
	$komen [391] = " 	a.	Lukisan tapak kolam takungan ( platform, invert, size, access, maintenance path, Trash screen, desilting basin )";
	$komen [392] = " 	b.	Kiraan Hidraulik";

	$komen [393] = " 3.10	Invert Level";

//4.0		ROAD SYSTEM

$komen [410] = " 4.1	Semua rekabentuk mestilah mematuhi kehendak Arahan Teknik JKR";

$komen [420] = " 4.2	Jalan yang direkabentuk mestilah mudah dihubungi kesemua bangunan & kemudahan sedia ada";

$komen [430] = " 4.3	Pelan Susunatur Jalan";

$komen [440] = " 4.4	Rekabentuk";
	$komen [441] = " 	a.	Geometrik jalan";
	$komen [442] = " 	b.	Jajaran Ufuk ( vertical alingment )";
	$komen [443] = " 	c	Jalan masuk utama";
	$komen [444] = " 	d.	Jalan dalaman";
	$komen [445] = " 	e.	Lebar Jalan";
	$komen [446] = " 	f.	Bahu jalan";
	$komen [447] = " 	g.	Median Jalan";
	$komen [448] = " 	h	Walkway";
	$komen [449] = " 	i.	Saliran Jalan";
	$komen [4410] = " 	j.	Rekabentuk aras banjir";
	$komen [4411] = " 	k.	Turapan";
	$komen [4412] = " 	l.	Persimpangan & Jalan masuk";

$komen [450] = " 4.5		Scope of Work";

	$komen [451] = " 4.5.1		Main entrance road";

	$komen [452] = " 4.5.2		Secondary entrance road";

	$komen [453] = " 4.5.3		Internal road system";

	$komen [454] = " 4.5.4		Hardstanding";

	$komen [455] = " 4.5.5		Illuminated parking areas";

	$komen [456] = " 4.5.6		1.5m wide walkways";

	$komen [457] = " 4.5.7		Covered walkways";

	$komen [458] = " 4.5.8		Road markings";

	$komen [459] = " 4.5.9		Road Sign";

	$komen [4510] = " 4.5.10		Round about";

$komen [460] = " 4.6		Design Consideration";

	$komen [461] = " 4.6.1		Rekabentuk persimpangan perlu mematuhi kehendak ATJ";

	$komen [462] = " 4.6.2		Kecerunan maksimum bagi jalan < 8%";

	$komen [463] = " 4.6.3		Lebar minimum turapan";

	$komen [464] = " 4.7	Keratan rentas jalan";

//5.0		WATER SUPPLY SYSTEM

$komen [510] = " 5.1	Maklumat tekanan air di tapak / kaw. Berkenaan";

$komen [520] = " 5.2	Meter bagi pili bomba & bekalan air domestik mematuhi keperluan Pihak Berkuasa berkenaan";

$komen [530] = " 5.3	Pematuhan keperluan pihak Bomba/JKR/Pihak berkuasa";

	$komen [531] = " 5.3.1	Jarak di antara pili bomba";

$komen [540] = " 5.4		Scope of Work";

	$komen [541] = " 5.4.1		Keperluan & Kapasiti Tangki air/ Tangki Menara / Suction Tank";

	$komen [542] = " 5.4.2		Rumah Pam";

	$komen [543] = " 5.4.3		Paip Retikulasi - Jenis Dan Saiz";

	$komen [544] = " 5.4.4		Booster Pump (Mekanikal)";

	$komen [550] = " 5.5		Pelan Susunatur Retikulasi air";

	$komen [551] = " 5.5.1		Kedudukan 'Tapping point'";

	$komen [552] = " 5.5.2		Air valve, Sluice valve, Scour Valve, end Valve, end cap.etc";

$komen [560] = " 5.6		Perincian Lukisan";

	$komen [561] = " 5.6.1		Pipe crossing culvert";

	$komen [562] = " 5.6.2		Pillar Fire Hydrant";

	$komen [563] = " 5.6.3		Precast Concrete Chamber";

	$komen [564] = " 5.6.4		Pipe Bedding";

	$komen [565] = " 5.6.5		Bulk Meter & Service Pipe Connection";

	$komen [566] = " 5.6.6		Standard Marker Post";

	$komen [567] = " 5.6.7		Thrust Blocks";

	$komen [568] = " 5.6.8		Pipe Trench";
	

//6.0		SISTEM KUMBAHAN

$komen [610] = " 6.1	Maklumat Sistem Kumbahan sedia ada di tapak";

	$komen [611] = " 6.1.1		Population Equivelant";

	$komen [612] = " 6.1.2		Sistem Kumbahan berpusat";

	$komen [613] = " 6.1.3		Sewer Treatment Plant";

	$komen [614] = " 6.1.4		Existing Invert Level";

$komen [620] = " 6.2	Kawasan pelepasan efluen";

$komen [630] = " 6.3		Scope of Works";

	$komen [631] = " 6.3.1		Kedudukan dan lokasi STP";

	$komen [632] = " 6.3.1.1		STP mematuhi senarai pembekal yang diluluskan oleh MOF";

	$komen [633] = " 6.3.1.2		STP yang direkabentuk sendiri perlu mematuhi garis panduan yang diluluskan oleh JPP";

	$komen [634] = " 6.3.2		Manhole";

	$komen [635] = " 6.3.2.1		Menggunakan pre-cast concrete yang mematuhi MS 8811 & BS 5911";

	$komen [636] = " 6.3.2.2		Jarak di antara manhole = 60m";

	$komen [637] = " 6.3.2.3		Internal plaster menggunakan  sulphat resistant cement";

$komen [640] = " 6.4		Pelan Susunatur";

	$komen [641] = " 6.4.1		Paip pembentung - jenis dan saiz paip";

	$komen [642] = " 6.4.2		Manhole";
	$komen [643] = " 6.4.2.1		- invert level sedia ada dan akan datang";

	$komen [644] = " 6.4.2.2		- elakkan laluan manhole di atas jalan";

	$komen [645] = " 6.4.2.3		- guna penutup yang diluluskan oleh Pihak JPP";

	$komen [646] = " 6.4.3		Pump Sump";

	$komen [647] = " 6.4.4		Keratan memanjang ( LS )";

$komen [650] = " 6.5		Perincian Lukisan";

	$komen [651] = " 6.5.1		Bedding detail";

	$komen [652] = " 6.5.2		Manhole basses";

	$komen [653] = " 6.5.3		Manhole detail";

	$komen [654] = " 6.5.4		Concrete landing & steel step";

	$komen [655] = " 6.5.5		Manhole cover & frame detail";

//7.0		FENCING & GATES 

$komen [710] = " 7.1	Kedudukan pagar pintu pagar ditunjukkan di dalam pelan susunatur";

$komen [720] = " 7.2	Maklumat Jenis-jenis pagar yang digunakan";
	$komen [721] = " 7.2.1		- Chain Link Fencing";
	$komen [722] = " 7.2.2		- & lain-lain pagar yang sesuai.(Brochure pagar dari pembekal perlu disertakan)";
		
		
$komen [730] = " 7.3	Jarak di antara 2 steel post mestilah 3000mm c/c";
		
		
$komen [740] = " 7.4	3 Stand bardbed wire diletakkan di atas lengan 'steel post' dengan bukaan sudut 450 bagi keperluan keselamatan";
		
		
$komen [750] = " 7.5	Keluli pada pagar mestilah dilindungi dari karat (cat,galvanizing. Coating ( polyrinyl choloride ( prc ) etc)";
		
		
$komen [760] = " 7.6	Pembinaan pagar mestilah sekurang-kurangnya 150mm didalam sempadan tapak. ( Tunjukkan di dalam lukisan perincian pagar )";


?>