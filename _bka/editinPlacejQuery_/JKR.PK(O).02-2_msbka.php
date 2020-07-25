<?php 
ob_start();
session_start();
$ulasan = '' ;

include_once ('../../ip_SERVER.php');
include_once('../../'.PROJ_FOLDER.'/inc/mysql_connect2cfg.php');
require_once ('../../'.PROJ_FOLDER.'/mysql_connect.php'); // Connect to the database.
require ("inc/proj_ulasan_tech_proposal_cfg.php");

if ($_SESSION['daftar_id']){
		$q = "select tajuk, OIC AS ppk, mod_kerja from daftar_projek 
			where daftar_id = {$_SESSION['daftar_id']}";
		$r = mysql_query ($q);
		while ($tna = mysql_fetch_array ($r)) {
		$_SESSION['tajuk'] = $tna[0];
		$_SESSION['ppk'] = $tna[1];
		$_SESSION['mod_kerja'] = $tna[2];		
		//if ($_GET['bka']){$_SESSION['daftar_id'] = $_GET['bka'];}
				ob_end_clean(); // Delete the buffer.
 }}
 mysql_close();
 
  
 
//echo $_SESSION['daftar_id'].'id'.$r;
 ?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>	
	<title>eggBlog - _pkO_02_mukadepan</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="content-style-type" content="text/css" />
	<meta name="description" content="an eggBlog with checklists for civil engineering students, intro to infra works i.e. earthworks, hydrology basin, road networks, water problem, wastewater cum structural, geotechnical, installed as web applications to manage activities at design & construction stages" />
	<meta name="keywords" content="engineering, civil, infra, earthworks, hydrology, drainage, roads, watersupply, reticulation, sewerage, STP, mysql, php, eip, jeip, tcpdf, blog, free, software, open, download" />
	<META name="y_key" content="371e5c105efa0ea9">
	<link rel="icon" href="../../themes/default/favicon.ico" type="image/x-icon" />
	
	<style type="text/css">
		.jeip-saving {
			background-image: url( "ajax-loader.gif" );
			background-repeat: no-repeat;
			background-position: left;
			background-color: #903;
			color: #fff;
			padding: 0 2px 0 20px;
		}

		.jeip-mouseover, .jeip-editfield {
			background-color: #ffff99;
		}

		.jeip-savebutton {
			background-color: #36f;
			color: #fff;
			font-size: 8px;			
		}

		.jeip-cancelbutton {
			background-color: #000;
			color: #fff;
			font-size: 8px;
		}
	a:hover {
	color: #C30;
	text-decoration: none;
	background-color: #00ff00;
}	
i {  font-family: Arial, Helvetica, sans-serif; font-size: 12px ; color: #fff;}
	</style>
	

	
		<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="js/jeip.js"></script>

<fieldset> <small> <center>
<a href="<?php echo "http://".$ipthis."/".PROJ_FOLDER."/projek_daftar.php?event=Pinda";?>">Daftar</a> |
<a href="<?php echo "http://".$ipthis."/".PROJ_FOLDER."/projek_Dplan.php?event=Pinda";?>">D-Plan</a> |
<!--a href="<?php echo "projek_Perunding.php?event=Pinda";?>">Perunding</a> |-->
<a href="<?php echo "http://".$ipthis."/".PROJ_FOLDER."/projek_butiran.php?event=Pinda";?>"-->Butiran</a> |

<!--a href="<?php echo "projek_sivil.php?event=Pinda";?>">Kerja sivil</a> |
<a href="<?php echo "projek_status.php?event=Pinda";?>">Status</a> | -->
<a href="<?php echo "http://".$ipthis."/_bka/editinPlacejQuery/kemajuanRB.php";?>"><font color="green" size="2em" style="text-decoration:none">KemajuanRB</font></a> | 

<!--a href="<?php echo "projek_senarai.php?order={$_SESSION['ppk']}";?>">Senarai</a> |-->
<!--a href="<?php echo "http://".$ipthis."/_bka/editinPlacejQuery/JKR.PK(O).02-2.php" ;?>"-->U.Teknikal<!--/a--> |
<a href="<?php echo "http://".$ipthis."/_bka/editinPlace050/penilaian_kriteria_earthwork.php" ;?>">P.Tender</a> |
<a href="<?php echo "http://".$ipthis."/_bka/editinPlace050/NeedsStatement.php" ;?>">N.S.</a> |
<a href="<?php echo "http://".$ipthis."/_bka/liveforms/MyBulkDrawings11.php" ;?>">D.Lukisan</a>
</center> </small> </fieldset>			
			
<?php
//$bkaHost  $bkaULogin  $bkaPass $bkaDbase
$db=mysql_connect($bkaHost,$bkaULogin,$bkaPass) or die(mysql_error());
mysql_select_db($bkaDbase) or die(mysql_error());

$tjk_projek=$_SESSION['tajuk'];	$modus=$_SESSION['mod_kerja'];$chk_id=$_SESSION['daftar_id'];
if (!$_SESSION['daftar_id']){ $tjk_projek='Projek Dummi .. '; $chk_id=7654321; $modus='Inhouse'; $kp_s=="123456-78-9012"; }

echo $ulasan . '	
</head>
<body>
';



//<!-----------------s--Maklumat--s---------------->
$chk='A_0_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chk'") or die ('123Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_0_CK  = $row['new_value'];	}


$spk = '<table width="800" border="1" align="center" cellpadding="-1" cellspacing="0" bordercolor="#E4E4E4" ><tr><td colspan="4" bgcolor="#FFFFFF" height="40" style="align:center;padding-left: 5px;font-size:12px"><b>Borang JKR.PK(O).02-2
KAJIAN SEMULA / VERIFIKASI / VALIDASI (*)</b></td></tr>';

$spkDB = '<table width="800" border="1" align="center" cellpadding="-1" cellspacing="0" bordercolor="#E4E4E4" ><tr><td colspan="4" bgcolor="#FFFFFF" height="40" style="align:center;padding-left: 5px;font-size:12px"><b>Borang JKR.PK(O).02-4 REKOD AUDIT REKABENTUK TERPERINCI R&B</b></td></tr>';


$localLink = '<div align="center"><span>
 Tajuk projek:>&nbsp;:&nbsp;&nbsp;&nbsp; <b><font color="darkblue" style="font-size:14">'.$tjk_projek.'</font></b><br/>
<font color="gray">EIP - Borang JKR.PK(O).02-2
KAJIAN SEMULA / VERIFIKASI / VALIDASI (*) Kerja Sivil : </font><font color="red">kehadiran</font><font color="green">&nbsp;&nbsp;Job no:>'.$chk_id.'</font><br/>

<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/ulasanTeknikal_general.php"><font color="blue" size="2em" style="text-decoration:none">GunaLampiran</font></a>

<!--a href="http://'.$ipthis.'/_bka/editinPlacejQuery/JKR.PK(O).02-2_msbka.php"><font color="green" size="2em" style="text-decoration:none"-->kehadiran<!--/font></a-->
<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/JKR.PK(O).02-2_earthwork.php"><font color="green" size="2em" style="text-decoration:none">earthwork</font></a>
<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/JKR.PK(O).02-2_drainage.php"><font color="green" size="2em" style="text-decoration:none">drainage</font></a>
<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/JKR.PK(O).02-2_roadwork.php"><font color="green" size="2em" style="text-decoration:none">roadwork</font></a>
<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/JKR.PK(O).02-2_watersupply.php"><font color="green" size="2em" style="text-decoration:none">watersupply</font></a>
<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/JKR.PK(O).02-2_sewerage.php"><font color="green" size="2em" style="text-decoration:none">sewerage</font></a>
&nbsp;:&nbsp;&nbsp;&nbsp;';

if ($modus<>'Perunding DB'){
$localLink .='<a href="http://'.$ipthis.'/pdf/tcpdf_4_7_003/examples/_JKR.PK(O).02-2_JQ.php"><font color="black" size="2em" style="text-decoration:none">print: PDF_A4</font></a>';}
else {
$localLink .='<a href="http://'.$ipthis.'/pdf/tcpdf_4_7_003/examples/_JKR.PK(O).02-4_JQ.php"><font color="black" size="2em" style="text-decoration:none">print: PDF_A4</font></a>';}

$localLink .='&nbsp;:&nbsp;&nbsp;&nbsp;
<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/JKR.PK(O).02-3.php"><font color="blue" size="2em" style="text-decoration:none">link: JKR.PK(O).02-3</font></a>
';

if ($modus=='Perunding DB'):
$header =$spkDB;
$objektif='(Audit Rekabentuk)';
elseif ($modus=='Perunding'):
$header =$spk;
$objektif='(Verifikasi Rekabentuk)';
else:
$header =$spk;
$objektif='(Kajian Semula Rekabentuk)';
endif; 	

echo $localLink . $header;

$chk='tajukprojek-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chk'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $tajukprojek  = $row['new_value'];	} if (empty($tajukprojek)){$tajukprojek = '<i>Klik2Edit</i>'; }
echo '<tr><td colspan="2" bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>TAJUK PROJEK</b></td><td colspan="2" bgcolor="#FFFFFF" width="600" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$chk.'">'.$tajukprojek.'</span></td></tr>';
$tajukprojek = '';

$chk='noprojek-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chk'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $noprojek  = $row['new_value'];	} if (empty($noprojek)){$noprojek = '<i>Klik2Edit</i>'; }
echo '<tr><td colspan="2" bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>NO. PROJEK</b></td><td colspan="2" bgcolor="#FFFFFF" width="600" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$chk.'">'.$noprojek.'</span></td></tr>';
$noprojek = '';

$chk='nofail-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chk'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $nofail  = $row['new_value'];	} if (empty($nofail)){$nofail = '<i>Klik2Edit</i>'; }
echo '<tr><td colspan="2" bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>NO. FAIL</b></td><td colspan="2" bgcolor="#FFFFFF" width="600" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$chk.'">'.$nofail.'</span></td></tr>';
$nofail = '';

/*
if ($modus=='Perunding DB'){
$chk='skopcheck-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chk'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $skopcheck  = $row['new_value'];	} if (empty($skopcheck)){$skopcheck = '<i>Klik2Edit</i>'; }
echo '<tr><td colspan="2" bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>SKOP</b></td><td colspan="2" bgcolor="#FFFFFF" width="600" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$chk.'">'.$skopcheck.'</span></td></tr>';
$skopcheck = '';
}*/


if ($modus<>'Perunding DB' || $modus=='Perunding DB'){

$chk='skopcheck-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chk'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $skopcheck  = $row['new_value'];	} if (empty($skopcheck)){$skopcheck = '<i>Klik2Edit</i>'; }
echo '<tr><td bgcolor="#FFFFFF" width="40" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>SKOP</b></td><td bgcolor="#FDFECF" width="160" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>PERBINCANGAN</b></td><td colspan="2" bgcolor="#FFFFFF" width="600" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$chk.'">'.$skopcheck.'</span></td></tr>';
$skopcheck = '';

$chk='tempat-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chk'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $tempat  = $row['new_value'];	} if (empty($tempat)){$tempat = '<i>Klik2Edit</i>'; }
echo '<tr><td colspan="2" bgcolor="#FDFECF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>TEMPAT /</b></td><td colspan="2" bgcolor="#FFFFFF" width="600" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$chk.'">'.$tempat.'</span></td></tr>';
$tempat = '';

$chk='tarikhmasa-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chk'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $tarikhmasa  = $row['new_value'];	} if (empty($tarikhmasa)){$tarikhmasa = '<i>Klik2Edit</i>'; }
echo '<tr><td colspan="2" bgcolor="#FDFECF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>TARIKH/MASA</b></td><td colspan="2" bgcolor="#FFFFFF" width="600" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$chk.'">'.$tarikhmasa.'</span></td></tr>';
$tarikhmasa = '';

echo '<tr><td colspan="2" bgcolor="#FDFECF" width="200"  height="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>KEHADIRAN</b></td><td bgcolor="#FFFFFF" width="350" style="align:center;padding-left: 5px;font-size:12px"><b>Nama</b></td><td bgcolor="#FFFFFF" width="250" style="align:center;padding-left: 5px;font-size:12px"><b>Jawatan</b></td></tr>';

$chknama='knama1-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chknama'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $knama1  = $row['new_value'];	} if (empty($knama1)){$knama1 = '<i>Klik2Edit</i>'; }
$chkjawat='kjawat1-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chkjawat'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $kjawat1  = $row['new_value'];	} if (empty($kjawat1)){$kjawat1 = '<i>Klik2Edit</i>'; }
echo '<tr><td colspan="2" bgcolor="#FFFFFF" width="200"  height="30" valign="top" style="align:right;padding-left: 50px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>1</b></td><td bgcolor="#FFFFFF" width="350" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chknama.'">'.$knama1.'</span></td><td bgcolor="#FFFFFF" width="250" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chkjawat.'">'.$kjawat1.'</span></td></tr>';
$knama1 = '';$kjawat1 = '';

$chknama='knama2-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chknama'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $knama2  = $row['new_value'];	} if (empty($knama2)){$knama2 = '<i>Klik2Edit</i>'; }
$chkjawat='kjawat2-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chkjawat'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $kjawat2  = $row['new_value'];	} if (empty($kjawat2)){$kjawat2 = '<i>Klik2Edit</i>'; }
echo '<tr><td colspan="2" bgcolor="#FFFFFF" width="200"  height="30" valign="top" style="align:right;padding-left: 50px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>2</b></td><td bgcolor="#FFFFFF" width="350" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chknama.'">'.$knama2.'</span></td><td bgcolor="#FFFFFF" width="250" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chkjawat.'">'.$kjawat2.'</span></td></tr>';
$knama2 = '';$kjawat2 = '';

//3
$chknama='knama3-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chknama'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $knama3  = $row['new_value'];	} if (empty($knama3)){$knama3 = '<i>Klik2Edit</i>'; }
$chkjawat='kjawat3-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chkjawat'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $kjawat3  = $row['new_value'];	} if (empty($kjawat3)){$kjawat3 = '<i>Klik2Edit</i>'; }
echo '<tr><td colspan="2" bgcolor="#FFFFFF" width="200"  height="30" valign="top" style="align:right;padding-left: 50px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>3</b></td><td bgcolor="#FFFFFF" width="350" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chknama.'">'.$knama3.'</span></td><td bgcolor="#FFFFFF" width="250" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chkjawat.'">'.$kjawat3.'</span></td></tr>';
$knama3 = '';$kjawat3 = '';

//4
$chknama='knama4-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chknama'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $knama4  = $row['new_value'];	} if (empty($knama4)){$knama4 = '<i>Klik2Edit</i>'; }
$chkjawat='kjawat4-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chkjawat'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $kjawat4  = $row['new_value'];	} if (empty($kjawat4)){$kjawat4 = '<i>Klik2Edit</i>'; }
echo '<tr><td colspan="2" bgcolor="#FFFFFF" width="200"  height="30" valign="top" style="align:right;padding-left: 50px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>4</b></td><td bgcolor="#FFFFFF" width="350" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chknama.'">'.$knama4.'</span></td><td bgcolor="#FFFFFF" width="250" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chkjawat.'">'.$kjawat4.'</span></td></tr>';
$knama4 = '';$kjawat4 = '';

//5
$chknama='knama5-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chknama'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $knama5  = $row['new_value'];	} if (empty($knama5)){$knama5 = '<i>Klik2Edit</i>'; }
$chkjawat='kjawat5-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chkjawat'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $kjawat5  = $row['new_value'];	} if (empty($kjawat5)){$kjawat5 = '<i>Klik2Edit</i>'; }
echo '<tr><td colspan="2" bgcolor="#FFFFFF" width="200"  height="30" valign="top" style="align:right;padding-left: 50px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>5</b></td><td bgcolor="#FFFFFF" width="350" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chknama.'">'.$knama5.'</span></td><td bgcolor="#FFFFFF" width="250" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chkjawat.'">'.$kjawat5.'</span></td></tr>';
$knama5 = '';$kjawat5 = '';

//6
$chknama='knama6-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chknama'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $knama6  = $row['new_value'];	} if (empty($knama6)){$knama6 = '<i>Klik2Edit</i>'; }
$chkjawat='kjawat6-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chkjawat'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $kjawat6  = $row['new_value'];	} if (empty($kjawat6)){$kjawat6 = '<i>Klik2Edit</i>'; }
echo '<tr><td colspan="2" bgcolor="#FFFFFF" width="200"  height="30" valign="top" style="align:right;padding-left: 50px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>6</b></td><td bgcolor="#FFFFFF" width="350" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chknama.'">'.$knama6.'</span></td><td bgcolor="#FFFFFF" width="250" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chkjawat.'">'.$kjawat6.'</span></td></tr>';
$knama6 = '';$kjawat6 = '';

//7
$chknama='knama7-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chknama'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $knama7  = $row['new_value'];	} if (empty($knama7)){$knama7 = '<i>Klik2Edit</i>'; }
$chkjawat='kjawat7-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chkjawat'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $kjawat7  = $row['new_value'];	} if (empty($kjawat7)){$kjawat7 = '<i>Klik2Edit</i>'; }
echo '<tr><td colspan="2" bgcolor="#FFFFFF" width="200"  height="30" valign="top" style="align:right;padding-left: 50px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>7</b></td><td bgcolor="#FFFFFF" width="350" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chknama.'">'.$knama7.'</span></td><td bgcolor="#FFFFFF" width="250" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chkjawat.'">'.$kjawat7.'</span></td></tr>';
$knama7 = '';$kjawat7 = '';}

////////////////////////////////////////////////////////////
echo '</table> <BR>';

?>

<script type="text/javascript">
	
<?php
$setID = '$("#tajukprojek-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:60 });';

$setID .= '$("#noprojek-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:1, cols:60 });';

$setID .= '$("#nofail-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:1, cols:60 });';

$setID .= '$("#skopcheck-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:60 });';

$setID .= '$("#tempat-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:1, cols:60 });';

$setID .= '$("#tarikhmasa-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:1, cols:60 });';

$setID .= '$("#knama1-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:1, cols:30 });
$("#kjawat1-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:1, cols:30 });';

$setID .= '$("#knama2-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:1, cols:30 });
$("#kjawat2-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:1, cols:30 });';

$setID .= '$("#knama3-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:1, cols:30 });
$("#kjawat3-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:1, cols:30 });';

$setID .= '$("#knama4-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:1, cols:30 });
$("#kjawat4-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:1, cols:30 });';

$setID .= '$("#knama5-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:1, cols:30 });
$("#kjawat5-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:1, cols:30 });';

$setID .= '$("#knama6-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:1, cols:30 });
$("#kjawat6-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:1, cols:30 });';

$setID .= '$("#knama7-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:1, cols:30 });
$("#kjawat7-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:1, cols:30 });';

echo $setID;

	?>

</script>


</body>
</html>
<?php // Flush the buffered output to the Web browser.
ob_flush();
?>
