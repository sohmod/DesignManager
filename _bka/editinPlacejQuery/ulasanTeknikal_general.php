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
 
//echo $_SESSION['daftar_id'].'id';
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>	
	<title>eggBlog - ut_general</title>
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
	

	
		<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
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
<!--a href="<?php echo "http://".$ipthis."/_bka/editinPlacejQuery/ulasanTeknikal_general.php" ;?>"-->U.Teknikal<!--/a--> |
<a href="<?php echo "http://".$ipthis."/_bka/editinPlace050/penilaian_kriteria_earthwork.php" ;?>">P.Tender</a> |
<a href="<?php echo "http://".$ipthis."/_bka/editinPlace050/NeedsStatement.php" ;?>">N.S.</a> |
<a href="<?php echo "http://".$ipthis."/_bka/liveForms/MyBulkDrawings11.php" ;?>">D.Lukisan</a>
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
$chk='A_0_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$chk'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_0_CK  = $row['new_value'];	}


$PerundingDB= '<table width="1200" border="1" align="center" cellpadding="-1" cellspacing="0" bordercolor="#E4E4E4" ><tr><td bgcolor="#FFFFFF" height="40" width="15" style="align:center;padding-left: 5px;font-size:12px"><b>Sect.</b></td><td bgcolor="#FFFFFF" height="40" width="35" style="align:left;padding-left: 2px;font-size:12px"><b>Item</b></td><td bgcolor="#FFFFFF" height="40" width="250" style="align:center;padding-left: 10px;font-size:12px"><b>Keperluan</b><br><small>(Read in conjunction with document of Need Statement)</small></td><td bgcolor="#FFFFFF" height="40" width="250" style="align:center;padding-left: 10px;font-size:12px"><b>Cadangan Kontraktor/Perunding</b><br/><small>(Read in conjunction with drawings, specs, document submitted)</small></td><td bgcolor="#FFFFFF" height="40" width="225" style="align:center;padding-left: 10px;font-size:12px"><b>Ulasan/ Keperluan/ Tindakan JKR</b></td><td bgcolor="#FFFFFF" height="40" width="225" style="align:center;padding-left: 10px;font-size:12px"><b>Tindakan Pihak Kontraktor</b></td><td bgcolor="#FFFFFF" height="40" width="200" style="align:center;padding-left: 10px;font-size:12px"><b>Keputusan JKR</b></td></tr>';

$Perunding= '<table width="1200" border="1" align="center" cellpadding="-1" cellspacing="0" bordercolor="#E4E4E4" ><tr><td bgcolor="#FFFFFF" height="40" width="15" style="align:center;padding-left: 5px;font-size:12px"><b>Sect.</b></td><td bgcolor="#FFFFFF" height="40" width="35" style="align:left;padding-left: 2px;font-size:12px"><b>Item</b></td><td bgcolor="#FFFFFF" height="40" width="250" style="align:center;padding-left: 10px;font-size:12px"><b>Keperluan</b><br/><small><span>(Read in conjunction with TOR, arch. drawings,  specs, approved standards etc)</span></small></td><td bgcolor="#FFFFFF" height="40" width="250" style="align:center;padding-left: 10px;font-size:12px"><b>Cadangan Perunding</b><br/><small>(Read in conjunction with drawings, document submitted)</small></td><td bgcolor="#FFFFFF" height="40" width="225" style="align:center;padding-left: 10px;font-size:12px"><b>Ulasan/ Keperluan/ Tindakan JKR</b></td><td bgcolor="#FFFFFF" height="40" width="225" style="align:center;padding-left: 10px;font-size:12px"><b>Tindakan Perunding</b></td><td bgcolor="#FFFFFF" height="40" width="200" style="align:center;padding-left: 10px;font-size:12px"><b>Keputusan JKR</b></td></tr>';

$Inhouse= '<table width="1200" border="1" align="center" cellpadding="-1" cellspacing="0" bordercolor="#E4E4E4" ><tr><td bgcolor="#FFFFFF" height="40" width="15" style="align:center;padding-left: 5px;font-size:12px"><b>Sect.</b></td><td bgcolor="#FFFFFF" height="40" width="35" style="align:left;padding-left: 2px;font-size:12px"><b>Item</b></td><td bgcolor="#FFFFFF" height="40" width="250" style="align:center;padding-left: 10px;font-size:12px"><b>Keperluan</b><br/><small><span>(Read in conjunction with arch. drawings,  specs, approved standards etc)</span></small></td><td bgcolor="#FFFFFF" height="40" width="250" style="align:center;padding-left: 10px;font-size:12px"><b>Cadangan/ Rekabentuk</b><br/><small>(Read in conjunction with civil drawings & details)</small></td><td bgcolor="#FFFFFF" height="40" width="225" style="align:center;padding-left: 10px;font-size:12px"><b>Ulasan/  Tindakan Penyemak</b></td><td bgcolor="#FFFFFF" height="40" width="225" style="align:center;padding-left: 10px;font-size:12px"><b>Tindakan Pereka</b></td><td bgcolor="#FFFFFF" height="40" width="200" style="align:center;padding-left: 10px;font-size:12px"><b>Keputusan PPK/ KPPK</b></td></tr>';

if ($modus=='Perunding DB'):
$header =$PerundingDB;
$objektif='(Audit Rekabentuk)';
elseif ($modus=='Perunding'):
$header =$Perunding;
$objektif='(Varifikasi Rekabentuk)';
else:
$header =$Inhouse;
$objektif='(Semakan Rekabentuk)';
endif; 	

if (!$_SESSION['daftar_id']){
if ($A_0_CK=='Perunding DB'):
$header =$PerundingDB;
$objektif='(Audit Rekabentuk)';
elseif ($A_0_CK=='Perunding'):
$header =$Perunding;
$objektif='(Varifikasi Rekabentuk)';
else:
$header =$Inhouse;
$objektif='(Semakan Rekabentuk)';
endif; 	  }

$localLink = '<div align="center"><span>
 Tajuk projek:>&nbsp;:&nbsp;&nbsp;&nbsp; <b><font color="darkblue" style="font-size:14">'.$tjk_projek.'</font></b><br/>
<font color="gray">EIP - Ulasan Teknikal '.$objektif.' Kerja Sivil : </font><font color="red">General</font><font color="green">&nbsp;&nbsp;Job no:>'.$chk_id.'</font><br/>

<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/JKR.PK(O).02-2_msbka.php"><font color="blue" size="2em" style="text-decoration:none">GunaBorangSPK</font></a>

<!--a href="http://'.$ipthis.'/_bka/editinPlacejQuery/ulasanTeknikal_general.php"><font color="green" size="2em" style="text-decoration:none"-->general<!--/font></a-->
<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/ulasanTeknikal_earthwork.php"><font color="green" size="2em" style="text-decoration:none">earthwork</font></a>
<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/ulasanTeknikal_drainage.php"><font color="green" size="2em" style="text-decoration:none">drainage</font></a>
<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/ulasanTeknikal_roadwork.php"><font color="green" size="2em" style="text-decoration:none">roadwork</font></a>
<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/ulasanTeknikal_watersupply.php"><font color="green" size="2em" style="text-decoration:none">watersupply</font></a>
<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/ulasanTeknikal_sewerage.php"><font color="green" size="2em" style="text-decoration:none">sewerage</font></a>
&nbsp;:&nbsp;&nbsp;&nbsp;
<a href="http://'.$ipthis.'/pdf/tcpdf_4_7_003/examples/_ulasanTeknikal_JQmerge.php"><font color="black" size="2em" style="text-decoration:none">print: PDF_A4</font></a>';

if ($modus<>'Perunding DB'){
$localLink .='&nbsp;&nbsp;&nbsp;<a href="http://'.$ipthis.'/pdf/tcpdf_4_7_003/examples/_JKR.PK(O).02-2cpg_JQ.php"><font color="black" size="2em" style="text-decoration:none">&PageCvr</font></a>';}
else {
$localLink .='&nbsp;&nbsp;&nbsp;<a href="http://'.$ipthis.'/pdf/tcpdf_4_7_003/examples/_JKR.PK(O).02-4cpg_JQ.php"><font color="black" size="2em" style="text-decoration:none">&PageCvr</font></a>';}



//<a href="http://'.$ipthis.'/pdf/tcpdf_4_7_003/examples/_ulasanTeknikal_JQmerge.php"><font color="black" size="2em" style="text-decoration:none">print: PDF_A4</font></a>';


// <a href="http://'.$ipthis.'/pdf/tcpdf_3_0_006/examples/bka_L-A4_ulasanteknikal_JQ.php"><font color="black" size="2em" style="text-decoration:none">print: PDF_A4</font></a>';




echo $localLink . $header;

$chk='A_0_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$chk'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_0_CK  = $row['new_value'];	} if (empty($A_0_CK)){$A_0_CK = '<i>Klik2Edit</i>'; }
echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>'.$itemA[0].'</b></td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">.</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px"><b>'.$A[0].'</b></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$chk.'">'.$A_0_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span>.</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span>.</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span>.</span></td></tr>';
$A_0_CK = '';

//STANDARD TOPUP100
$CK='A_100_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_100_CK  = $row['new_value'];	}
$UJ='A_100_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_100_UJ  = $row['new_value'];	}
$TK='A_100_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_100_TK  = $row['new_value'];	}
$KJ='A_100_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_100_KJ  = $row['new_value'];	}

if (empty($A_100_CK)){$A_100_CK = '<i>Klik2Edit</i>'; }if (empty($A_100_UJ)){$A_100_UJ = '<i>Klik2Edit</i>'; }if (empty($A_100_TK)){$A_100_TK = '<i>Klik2Edit</i>'; }if (empty($A_100_KJ)){$A_100_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[100].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$A[100].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$A_100_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$A_100_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$A_100_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$A_100_KJ.'</span></td></tr>';
$A_100_CK = '';$A_100_UJ = '';$A_100_TK = '';$A_100_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP200
$CK='A_200_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_200_CK  = $row['new_value'];	}
$UJ='A_200_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_200_UJ  = $row['new_value'];	}
$TK='A_200_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_200_TK  = $row['new_value'];	}
$KJ='A_200_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_200_KJ  = $row['new_value'];	}

if (empty($A_200_CK)){$A_200_CK = '<i>Klik2Edit</i>'; }if (empty($A_200_UJ)){$A_200_UJ = '<i>Klik2Edit</i>'; }if (empty($A_200_TK)){$A_200_TK = '<i>Klik2Edit</i>'; }if (empty($A_200_KJ)){$A_200_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[200].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$A[200].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$A_200_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$A_200_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$A_200_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$A_200_KJ.'</span></td></tr>';
$A_200_CK = '';$A_200_UJ = '';$A_200_TK = '';$A_200_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP300
$CK='A_300_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_300_CK  = $row['new_value'];	}
$UJ='A_300_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_300_UJ  = $row['new_value'];	}
$TK='A_300_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_300_TK  = $row['new_value'];	}
$KJ='A_300_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_300_KJ  = $row['new_value'];	}

if (empty($A_300_CK)){$A_300_CK = '<i>Klik2Edit</i>'; }if (empty($A_300_UJ)){$A_300_UJ = '<i>Klik2Edit</i>'; }if (empty($A_300_TK)){$A_300_TK = '<i>Klik2Edit</i>'; }if (empty($A_300_KJ)){$A_300_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[300].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$A[300].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$A_300_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$A_300_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$A_300_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$A_300_KJ.'</span></td></tr>';
$A_300_CK = '';$A_300_UJ = '';$A_300_TK = '';$A_300_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP400
$CK='A_400_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_400_CK  = $row['new_value'];	}
$UJ='A_400_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_400_UJ  = $row['new_value'];	}
$TK='A_400_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_400_TK  = $row['new_value'];	}
$KJ='A_400_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_400_KJ  = $row['new_value'];	}

if (empty($A_400_CK)){$A_400_CK = '<i>Klik2Edit</i>'; }if (empty($A_400_UJ)){$A_400_UJ = '<i>Klik2Edit</i>'; }if (empty($A_400_TK)){$A_400_TK = '<i>Klik2Edit</i>'; }if (empty($A_400_KJ)){$A_400_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[400].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$A[400].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$A_400_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$A_400_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$A_400_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$A_400_KJ.'</span></td></tr>';
$A_400_CK = '';$A_400_UJ = '';$A_400_TK = '';$A_400_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP500
$CK='A_500_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_500_CK  = $row['new_value'];	}
$UJ='A_500_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_500_UJ  = $row['new_value'];	}
$TK='A_500_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_500_TK  = $row['new_value'];	}
$KJ='A_500_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_500_KJ  = $row['new_value'];	}

if (empty($A_500_CK)){$A_500_CK = '<i>Klik2Edit</i>'; }if (empty($A_500_UJ)){$A_500_UJ = '<i>Klik2Edit</i>'; }if (empty($A_500_TK)){$A_500_TK = '<i>Klik2Edit</i>'; }if (empty($A_500_KJ)){$A_500_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[500].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$A[500].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$A_500_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$A_500_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$A_500_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$A_500_KJ.'</span></td></tr>';
$A_500_CK = '';$A_500_UJ = '';$A_500_TK = '';$A_500_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP600
$CK='A_600_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_600_CK  = $row['new_value'];	}
$UJ='A_600_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_600_UJ  = $row['new_value'];	}
$TK='A_600_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_600_TK  = $row['new_value'];	}
$KJ='A_600_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_600_KJ  = $row['new_value'];	}

if (empty($A_600_CK)){$A_600_CK = '<i>Klik2Edit</i>'; }if (empty($A_600_UJ)){$A_600_UJ = '<i>Klik2Edit</i>'; }if (empty($A_600_TK)){$A_600_TK = '<i>Klik2Edit</i>'; }if (empty($A_600_KJ)){$A_600_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[600].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$A[600].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$A_600_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$A_600_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$A_600_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$A_600_KJ.'</span></td></tr>';
$A_600_CK = '';$A_600_UJ = '';$A_600_TK = '';$A_600_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP700
$CK='A_700_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_700_CK  = $row['new_value'];	}
$UJ='A_700_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_700_UJ  = $row['new_value'];	}
$TK='A_700_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_700_TK  = $row['new_value'];	}
$KJ='A_700_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_700_KJ  = $row['new_value'];	}

if (empty($A_700_CK)){$A_700_CK = '<i>Klik2Edit</i>'; }if (empty($A_700_UJ)){$A_700_UJ = '<i>Klik2Edit</i>'; }if (empty($A_700_TK)){$A_700_TK = '<i>Klik2Edit</i>'; }if (empty($A_700_KJ)){$A_700_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[700].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$A[700].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$A_700_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$A_700_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$A_700_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$A_700_KJ.'</span></td></tr>';
$A_700_CK = '';$A_700_UJ = '';$A_700_TK = '';$A_700_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP800
$CK='A_800_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_800_CK  = $row['new_value'];	}
$UJ='A_800_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_800_UJ  = $row['new_value'];	}
$TK='A_800_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_800_TK  = $row['new_value'];	}
$KJ='A_800_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_800_KJ  = $row['new_value'];	}

if (empty($A_800_CK)){$A_800_CK = '<i>Klik2Edit</i>'; }if (empty($A_800_UJ)){$A_800_UJ = '<i>Klik2Edit</i>'; }if (empty($A_800_TK)){$A_800_TK = '<i>Klik2Edit</i>'; }if (empty($A_800_KJ)){$A_800_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[800].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$A[800].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$A_800_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$A_800_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$A_800_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$A_800_KJ.'</span></td></tr>';
$A_800_CK = '';$A_800_UJ = '';$A_800_TK = '';$A_800_KJ = '';
//STANDARD BOTDOWN


///900

//STANDARD TOPUP900
$CK='A_900_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_900_CK  = $row['new_value'];	}
$UJ='A_900_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_900_UJ  = $row['new_value'];	}
$TK='A_900_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_900_TK  = $row['new_value'];	}
$KJ='A_900_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_900_KJ  = $row['new_value'];	}

if (empty($A_900_CK)){$A_900_CK = '<i>Klik2Edit</i>'; }if (empty($A_900_UJ)){$A_900_UJ = '<i>Klik2Edit</i>'; }if (empty($A_900_TK)){$A_900_TK = '<i>Klik2Edit</i>'; }if (empty($A_900_KJ)){$A_900_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[900].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$A[900].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$A_900_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$A_900_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$A_900_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$A_900_KJ.'</span></td></tr>';
$A_900_CK = '';$A_900_UJ = '';$A_900_TK = '';$A_900_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP901
$CK='A_901_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_901_CK  = $row['new_value'];	}
$UJ='A_901_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_901_UJ  = $row['new_value'];	}
$TK='A_901_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_901_TK  = $row['new_value'];	}
$KJ='A_901_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_901_KJ  = $row['new_value'];	}

if (empty($A_901_CK)){$A_901_CK = '<i>Klik2Edit</i>'; }if (empty($A_901_UJ)){$A_901_UJ = '<i>Klik2Edit</i>'; }if (empty($A_901_TK)){$A_901_TK = '<i>Klik2Edit</i>'; }if (empty($A_901_KJ)){$A_901_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[901].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$A[901].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$A_901_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$A_901_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$A_901_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$A_901_KJ.'</span></td></tr>';
$A_901_CK = '';$A_901_UJ = '';$A_901_TK = '';$A_901_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP902
$CK='A_902_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_902_CK  = $row['new_value'];	}
$UJ='A_902_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_902_UJ  = $row['new_value'];	}
$TK='A_902_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_902_TK  = $row['new_value'];	}
$KJ='A_902_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_902_KJ  = $row['new_value'];	}

if (empty($A_902_CK)){$A_902_CK = '<i>Klik2Edit</i>'; }if (empty($A_902_UJ)){$A_902_UJ = '<i>Klik2Edit</i>'; }if (empty($A_902_TK)){$A_902_TK = '<i>Klik2Edit</i>'; }if (empty($A_902_KJ)){$A_902_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[902].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$A[902].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$A_902_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$A_902_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$A_902_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$A_902_KJ.'</span></td></tr>';
$A_902_CK = '';$A_902_UJ = '';$A_902_TK = '';$A_902_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP903
$CK='A_903_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_903_CK  = $row['new_value'];	}
$UJ='A_903_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_903_UJ  = $row['new_value'];	}
$TK='A_903_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_903_TK  = $row['new_value'];	}
$KJ='A_903_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_903_KJ  = $row['new_value'];	}

if (empty($A_903_CK)){$A_903_CK = '<i>Klik2Edit</i>'; }if (empty($A_903_UJ)){$A_903_UJ = '<i>Klik2Edit</i>'; }if (empty($A_903_TK)){$A_903_TK = '<i>Klik2Edit</i>'; }if (empty($A_903_KJ)){$A_903_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[903].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$A[903].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$A_903_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$A_903_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$A_903_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$A_903_KJ.'</span></td></tr>';
$A_903_CK = '';$A_903_UJ = '';$A_903_TK = '';$A_903_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP904
$CK='A_904_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_904_CK  = $row['new_value'];	}
$UJ='A_904_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_904_UJ  = $row['new_value'];	}
$TK='A_904_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_904_TK  = $row['new_value'];	}
$KJ='A_904_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_904_KJ  = $row['new_value'];	}

if (empty($A_904_CK)){$A_904_CK = '<i>Klik2Edit</i>'; }if (empty($A_904_UJ)){$A_904_UJ = '<i>Klik2Edit</i>'; }if (empty($A_904_TK)){$A_904_TK = '<i>Klik2Edit</i>'; }if (empty($A_904_KJ)){$A_904_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[904].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$A[904].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$A_904_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$A_904_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$A_904_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$A_904_KJ.'</span></td></tr>';
$A_904_CK = '';$A_904_UJ = '';$A_904_TK = '';$A_904_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP905
$CK='A_905_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_905_CK  = $row['new_value'];	}
$UJ='A_905_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_905_UJ  = $row['new_value'];	}
$TK='A_905_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_905_TK  = $row['new_value'];	}
$KJ='A_905_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_905_KJ  = $row['new_value'];	}

if (empty($A_905_CK)){$A_905_CK = '<i>Klik2Edit</i>'; }if (empty($A_905_UJ)){$A_905_UJ = '<i>Klik2Edit</i>'; }if (empty($A_905_TK)){$A_905_TK = '<i>Klik2Edit</i>'; }if (empty($A_905_KJ)){$A_905_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[905].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$A[905].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$A_905_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$A_905_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$A_905_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$A_905_KJ.'</span></td></tr>';
$A_905_CK = '';$A_905_UJ = '';$A_905_TK = '';$A_905_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP906
$CK='A_906_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_906_CK  = $row['new_value'];	}
$UJ='A_906_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_906_UJ  = $row['new_value'];	}
$TK='A_906_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_906_TK  = $row['new_value'];	}
$KJ='A_906_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_906_KJ  = $row['new_value'];	}

if (empty($A_906_CK)){$A_906_CK = '<i>Klik2Edit</i>'; }if (empty($A_906_UJ)){$A_906_UJ = '<i>Klik2Edit</i>'; }if (empty($A_906_TK)){$A_906_TK = '<i>Klik2Edit</i>'; }if (empty($A_906_KJ)){$A_906_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[906].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$A[906].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$A_906_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$A_906_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$A_906_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$A_906_KJ.'</span></td></tr>';
$A_906_CK = '';$A_906_UJ = '';$A_906_TK = '';$A_906_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP907
$CK='A_907_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_907_CK  = $row['new_value'];	}
$UJ='A_907_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_907_UJ  = $row['new_value'];	}
$TK='A_907_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_907_TK  = $row['new_value'];	}
$KJ='A_907_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_907_KJ  = $row['new_value'];	}

if (empty($A_907_CK)){$A_907_CK = '<i>Klik2Edit</i>'; }if (empty($A_907_UJ)){$A_907_UJ = '<i>Klik2Edit</i>'; }if (empty($A_907_TK)){$A_907_TK = '<i>Klik2Edit</i>'; }if (empty($A_907_KJ)){$A_907_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[907].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$A[907].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$A_907_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$A_907_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$A_907_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$A_907_KJ.'</span></td></tr>';
$A_907_CK = '';$A_907_UJ = '';$A_907_TK = '';$A_907_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP908
$CK='A_908_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_908_CK  = $row['new_value'];	}
$UJ='A_908_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_908_UJ  = $row['new_value'];	}
$TK='A_908_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_908_TK  = $row['new_value'];	}
$KJ='A_908_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_908_KJ  = $row['new_value'];	}

if (empty($A_908_CK)){$A_908_CK = '<i>Klik2Edit</i>'; }if (empty($A_908_UJ)){$A_908_UJ = '<i>Klik2Edit</i>'; }if (empty($A_908_TK)){$A_908_TK = '<i>Klik2Edit</i>'; }if (empty($A_908_KJ)){$A_908_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[908].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$A[908].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$A_908_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$A_908_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$A_908_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$A_908_KJ.'</span></td></tr>';
$A_908_CK = '';$A_908_UJ = '';$A_908_TK = '';$A_908_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP909
$CK='A_909_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_909_CK  = $row['new_value'];	}
$UJ='A_909_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_909_UJ  = $row['new_value'];	}
$TK='A_909_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_909_TK  = $row['new_value'];	}
$KJ='A_909_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_909_KJ  = $row['new_value'];	}

if (empty($A_909_CK)){$A_909_CK = '<i>Klik2Edit</i>'; }if (empty($A_909_UJ)){$A_909_UJ = '<i>Klik2Edit</i>'; }if (empty($A_909_TK)){$A_909_TK = '<i>Klik2Edit</i>'; }if (empty($A_909_KJ)){$A_909_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[909].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$A[909].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$A_909_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$A_909_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$A_909_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$A_909_KJ.'</span></td></tr>';
$A_909_CK = '';$A_909_UJ = '';$A_909_TK = '';$A_909_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP910
$CK='A_910_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_910_CK  = $row['new_value'];	}
$UJ='A_910_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_910_UJ  = $row['new_value'];	}
$TK='A_910_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_910_TK  = $row['new_value'];	}
$KJ='A_910_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_910_KJ  = $row['new_value'];	}

if (empty($A_910_CK)){$A_910_CK = '<i>Klik2Edit</i>'; }if (empty($A_910_UJ)){$A_910_UJ = '<i>Klik2Edit</i>'; }if (empty($A_910_TK)){$A_910_TK = '<i>Klik2Edit</i>'; }if (empty($A_910_KJ)){$A_910_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[910].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$A[910].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$A_910_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$A_910_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$A_910_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$A_910_KJ.'</span></td></tr>';
$A_910_CK = '';$A_910_UJ = '';$A_910_TK = '';$A_910_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP911
$CK='A_911_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_911_CK  = $row['new_value'];	}
$UJ='A_911_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_911_UJ  = $row['new_value'];	}
$TK='A_911_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_911_TK  = $row['new_value'];	}
$KJ='A_911_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_911_KJ  = $row['new_value'];	}

if (empty($A_911_CK)){$A_911_CK = '<i>Klik2Edit</i>'; }if (empty($A_911_UJ)){$A_911_UJ = '<i>Klik2Edit</i>'; }if (empty($A_911_TK)){$A_911_TK = '<i>Klik2Edit</i>'; }if (empty($A_911_KJ)){$A_911_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[911].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$A[911].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$A_911_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$A_911_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$A_911_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$A_911_KJ.'</span></td></tr>';
$A_911_CK = '';$A_911_UJ = '';$A_911_TK = '';$A_911_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP912
$CK='A_912_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_912_CK  = $row['new_value'];	}
$UJ='A_912_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_912_UJ  = $row['new_value'];	}
$TK='A_912_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_912_TK  = $row['new_value'];	}
$KJ='A_912_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_912_KJ  = $row['new_value'];	}

if (empty($A_912_CK)){$A_912_CK = '<i>Klik2Edit</i>'; }if (empty($A_912_UJ)){$A_912_UJ = '<i>Klik2Edit</i>'; }if (empty($A_912_TK)){$A_912_TK = '<i>Klik2Edit</i>'; }if (empty($A_912_KJ)){$A_912_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[912].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$A[912].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$A_912_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$A_912_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$A_912_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$A_912_KJ.'</span></td></tr>';
$A_912_CK = '';$A_912_UJ = '';$A_912_TK = '';$A_912_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP913
$CK='A_913_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_913_CK  = $row['new_value'];	}
$UJ='A_913_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_913_UJ  = $row['new_value'];	}
$TK='A_913_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_913_TK  = $row['new_value'];	}
$KJ='A_913_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_913_KJ  = $row['new_value'];	}

if (empty($A_913_CK)){$A_913_CK = '<i>Klik2Edit</i>'; }if (empty($A_913_UJ)){$A_913_UJ = '<i>Klik2Edit</i>'; }if (empty($A_913_TK)){$A_913_TK = '<i>Klik2Edit</i>'; }if (empty($A_913_KJ)){$A_913_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[913].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$A[913].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$A_913_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$A_913_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$A_913_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$A_913_KJ.'</span></td></tr>';
$A_913_CK = '';$A_913_UJ = '';$A_913_TK = '';$A_913_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP914
$CK='A_914_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_914_CK  = $row['new_value'];	}
$UJ='A_914_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_914_UJ  = $row['new_value'];	}
$TK='A_914_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_914_TK  = $row['new_value'];	}
$KJ='A_914_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_914_KJ  = $row['new_value'];	}

if (empty($A_914_CK)){$A_914_CK = '<i>Klik2Edit</i>'; }if (empty($A_914_UJ)){$A_914_UJ = '<i>Klik2Edit</i>'; }if (empty($A_914_TK)){$A_914_TK = '<i>Klik2Edit</i>'; }if (empty($A_914_KJ)){$A_914_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[914].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$A[914].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$A_914_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$A_914_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$A_914_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$A_914_KJ.'</span></td></tr>';
$A_914_CK = '';$A_914_UJ = '';$A_914_TK = '';$A_914_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP915
$CK='A_915_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_915_CK  = $row['new_value'];	}
$UJ='A_915_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_915_UJ  = $row['new_value'];	}
$TK='A_915_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_915_TK  = $row['new_value'];	}
$KJ='A_915_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_915_KJ  = $row['new_value'];	}

if (empty($A_915_CK)){$A_915_CK = '<i>Klik2Edit</i>'; }if (empty($A_915_UJ)){$A_915_UJ = '<i>Klik2Edit</i>'; }if (empty($A_915_TK)){$A_915_TK = '<i>Klik2Edit</i>'; }if (empty($A_915_KJ)){$A_915_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[915].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$A[915].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$A_915_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$A_915_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$A_915_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$A_915_KJ.'</span></td></tr>';
$A_915_CK = '';$A_915_UJ = '';$A_915_TK = '';$A_915_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP916
$CK='A_916_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_916_CK  = $row['new_value'];	}
$UJ='A_916_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_916_UJ  = $row['new_value'];	}
$TK='A_916_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_916_TK  = $row['new_value'];	}
$KJ='A_916_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_916_KJ  = $row['new_value'];	}

if (empty($A_916_CK)){$A_916_CK = '<i>Klik2Edit</i>'; }if (empty($A_916_UJ)){$A_916_UJ = '<i>Klik2Edit</i>'; }if (empty($A_916_TK)){$A_916_TK = '<i>Klik2Edit</i>'; }if (empty($A_916_KJ)){$A_916_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[916].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$A[916].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$A_916_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$A_916_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$A_916_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$A_916_KJ.'</span></td></tr>';
$A_916_CK = '';$A_916_UJ = '';$A_916_TK = '';$A_916_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP1000
$CK='A_1000_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1000_CK  = $row['new_value'];	}
$UJ='A_1000_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1000_UJ  = $row['new_value'];	}
$TK='A_1000_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1000_TK  = $row['new_value'];	}
$KJ='A_1000_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1000_KJ  = $row['new_value'];	}

if (empty($A_1000_CK)){$A_1000_CK = '<i>Klik2Edit</i>'; }if (empty($A_1000_UJ)){$A_1000_UJ = '<i>Klik2Edit</i>'; }if (empty($A_1000_TK)){$A_1000_TK = '<i>Klik2Edit</i>'; }if (empty($A_1000_KJ)){$A_1000_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[1000].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$A[1000].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$A_1000_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$A_1000_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$A_1000_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$A_1000_KJ.'</span></td></tr>';
$A_1000_CK = '';$A_1000_UJ = '';$A_1000_TK = '';$A_1000_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP1100
$CK='A_1100_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1100_CK  = $row['new_value'];	}
$UJ='A_1100_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1100_UJ  = $row['new_value'];	}
$TK='A_1100_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1100_TK  = $row['new_value'];	}
$KJ='A_1100_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1100_KJ  = $row['new_value'];	}

if (empty($A_1100_CK)){$A_1100_CK = '<i>Klik2Edit</i>'; }if (empty($A_1100_UJ)){$A_1100_UJ = '<i>Klik2Edit</i>'; }if (empty($A_1100_TK)){$A_1100_TK = '<i>Klik2Edit</i>'; }if (empty($A_1100_KJ)){$A_1100_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[1100].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$A[1100].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$A_1100_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$A_1100_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$A_1100_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$A_1100_KJ.'</span></td></tr>';
$A_1100_CK = '';$A_1100_UJ = '';$A_1100_TK = '';$A_1100_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP1200
$CK='A_1200_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1200_CK  = $row['new_value'];	}
$UJ='A_1200_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1200_UJ  = $row['new_value'];	}
$TK='A_1200_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1200_TK  = $row['new_value'];	}
$KJ='A_1200_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1200_KJ  = $row['new_value'];	}

if (empty($A_1200_CK)){$A_1200_CK = '<i>Klik2Edit</i>'; }if (empty($A_1200_UJ)){$A_1200_UJ = '<i>Klik2Edit</i>'; }if (empty($A_1200_TK)){$A_1200_TK = '<i>Klik2Edit</i>'; }if (empty($A_1200_KJ)){$A_1200_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[1200].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$A[1200].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$A_1200_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$A_1200_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$A_1200_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$A_1200_KJ.'</span></td></tr>';
$A_1200_CK = '';$A_1200_UJ = '';$A_1200_TK = '';$A_1200_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP1300
$CK='A_1300_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1300_CK  = $row['new_value'];	}
$UJ='A_1300_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1300_UJ  = $row['new_value'];	}
$TK='A_1300_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1300_TK  = $row['new_value'];	}
$KJ='A_1300_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1300_KJ  = $row['new_value'];	}

if (empty($A_1300_CK)){$A_1300_CK = '<i>Klik2Edit</i>'; }if (empty($A_1300_UJ)){$A_1300_UJ = '<i>Klik2Edit</i>'; }if (empty($A_1300_TK)){$A_1300_TK = '<i>Klik2Edit</i>'; }if (empty($A_1300_KJ)){$A_1300_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[1300].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$A[1300].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$A_1300_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$A_1300_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$A_1300_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$A_1300_KJ.'</span></td></tr>';
$A_1300_CK = '';$A_1300_UJ = '';$A_1300_TK = '';$A_1300_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP1400
$CK='A_1400_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1400_CK  = $row['new_value'];	}
$UJ='A_1400_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1400_UJ  = $row['new_value'];	}
$TK='A_1400_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1400_TK  = $row['new_value'];	}
$KJ='A_1400_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1400_KJ  = $row['new_value'];	}

if (empty($A_1400_CK)){$A_1400_CK = '<i>Klik2Edit</i>'; }if (empty($A_1400_UJ)){$A_1400_UJ = '<i>Klik2Edit</i>'; }if (empty($A_1400_TK)){$A_1400_TK = '<i>Klik2Edit</i>'; }if (empty($A_1400_KJ)){$A_1400_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[1400].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$A[1400].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$A_1400_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$A_1400_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$A_1400_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$A_1400_KJ.'</span></td></tr>';
$A_1400_CK = '';$A_1400_UJ = '';$A_1400_TK = '';$A_1400_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP1500
$CK='A_1500_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1500_CK  = $row['new_value'];	}
$UJ='A_1500_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1500_UJ  = $row['new_value'];	}
$TK='A_1500_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1500_TK  = $row['new_value'];	}
$KJ='A_1500_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1500_KJ  = $row['new_value'];	}

if (empty($A_1500_CK)){$A_1500_CK = '<i>Klik2Edit</i>'; }if (empty($A_1500_UJ)){$A_1500_UJ = '<i>Klik2Edit</i>'; }if (empty($A_1500_TK)){$A_1500_TK = '<i>Klik2Edit</i>'; }if (empty($A_1500_KJ)){$A_1500_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[1500].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$A[1500].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$A_1500_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$A_1500_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$A_1500_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$A_1500_KJ.'</span></td></tr>';
$A_1500_CK = '';$A_1500_UJ = '';$A_1500_TK = '';$A_1500_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP1600
$CK='A_1600_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1600_CK  = $row['new_value'];	}
$UJ='A_1600_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1600_UJ  = $row['new_value'];	}
$TK='A_1600_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1600_TK  = $row['new_value'];	}
$KJ='A_1600_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1600_KJ  = $row['new_value'];	}

if (empty($A_1600_CK)){$A_1600_CK = '<i>Klik2Edit</i>'; }if (empty($A_1600_UJ)){$A_1600_UJ = '<i>Klik2Edit</i>'; }if (empty($A_1600_TK)){$A_1600_TK = '<i>Klik2Edit</i>'; }if (empty($A_1600_KJ)){$A_1600_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[1600].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$A[1600].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$A_1600_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$A_1600_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$A_1600_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$A_1600_KJ.'</span></td></tr>';
$A_1600_CK = '';$A_1600_UJ = '';$A_1600_TK = '';$A_1600_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP1700
$CK='A_1700_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1700_CK  = $row['new_value'];	}
$UJ='A_1700_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1700_UJ  = $row['new_value'];	}
$TK='A_1700_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1700_TK  = $row['new_value'];	}
$KJ='A_1700_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1700_KJ  = $row['new_value'];	}

if (empty($A_1700_CK)){$A_1700_CK = '<i>Klik2Edit</i>'; }if (empty($A_1700_UJ)){$A_1700_UJ = '<i>Klik2Edit</i>'; }if (empty($A_1700_TK)){$A_1700_TK = '<i>Klik2Edit</i>'; }if (empty($A_1700_KJ)){$A_1700_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[1700].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$A[1700].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$A_1700_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$A_1700_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$A_1700_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$A_1700_KJ.'</span></td></tr>';
$A_1700_CK = '';$A_1700_UJ = '';$A_1700_TK = '';$A_1700_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP1800
$CK='A_1800_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1800_CK  = $row['new_value'];	}
$UJ='A_1800_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1800_UJ  = $row['new_value'];	}
$TK='A_1800_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1800_TK  = $row['new_value'];	}
$KJ='A_1800_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1800_KJ  = $row['new_value'];	}

if (empty($A_1800_CK)){$A_1800_CK = '<i>Klik2Edit</i>'; }if (empty($A_1800_UJ)){$A_1800_UJ = '<i>Klik2Edit</i>'; }if (empty($A_1800_TK)){$A_1800_TK = '<i>Klik2Edit</i>'; }if (empty($A_1800_KJ)){$A_1800_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[1800].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$A[1800].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$A_1800_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$A_1800_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$A_1800_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$A_1800_KJ.'</span></td></tr>';
$A_1800_CK = '';$A_1800_UJ = '';$A_1800_TK = '';$A_1800_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP1900
$CK='A_1900_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1900_CK  = $row['new_value'];	}
$UJ='A_1900_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1900_UJ  = $row['new_value'];	}
$TK='A_1900_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1900_TK  = $row['new_value'];	}
$KJ='A_1900_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_1900_KJ  = $row['new_value'];	}

if (empty($A_1900_CK)){$A_1900_CK = '<i>Klik2Edit</i>'; }if (empty($A_1900_UJ)){$A_1900_UJ = '<i>Klik2Edit</i>'; }if (empty($A_1900_TK)){$A_1900_TK = '<i>Klik2Edit</i>'; }if (empty($A_1900_KJ)){$A_1900_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[1900].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$A[1900].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$A_1900_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$A_1900_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$A_1900_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$A_1900_KJ.'</span></td></tr>';
$A_1900_CK = '';$A_1900_UJ = '';$A_1900_TK = '';$A_1900_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP2000
$CK='A_2000_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_2000_CK  = $row['new_value'];	}
$UJ='A_2000_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_2000_UJ  = $row['new_value'];	}
$TK='A_2000_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_2000_TK  = $row['new_value'];	}
$KJ='A_2000_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_2000_KJ  = $row['new_value'];	}

if (empty($A_2000_CK)){$A_2000_CK = '<i>Klik2Edit</i>'; }if (empty($A_2000_UJ)){$A_2000_UJ = '<i>Klik2Edit</i>'; }if (empty($A_2000_TK)){$A_2000_TK = '<i>Klik2Edit</i>'; }if (empty($A_2000_KJ)){$A_2000_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[2000].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$A[2000].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$A_2000_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$A_2000_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$A_2000_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$A_2000_KJ.'</span></td></tr>';
$A_2000_CK = '';$A_2000_UJ = '';$A_2000_TK = '';$A_2000_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP2100
$CK='A_2100_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_2100_CK  = $row['new_value'];	}
$UJ='A_2100_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_2100_UJ  = $row['new_value'];	}
$TK='A_2100_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_2100_TK  = $row['new_value'];	}
$KJ='A_2100_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_2100_KJ  = $row['new_value'];	}

if (empty($A_2100_CK)){$A_2100_CK = '<i>Klik2Edit</i>'; }if (empty($A_2100_UJ)){$A_2100_UJ = '<i>Klik2Edit</i>'; }if (empty($A_2100_TK)){$A_2100_TK = '<i>Klik2Edit</i>'; }if (empty($A_2100_KJ)){$A_2100_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemA[2100].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$A[2100].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$A_2100_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$A_2100_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$A_2100_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$A_2100_KJ.'</span></td></tr>';
$A_2100_CK = '';$A_2100_UJ = '';$A_2100_TK = '';$A_2100_KJ = '';
//STANDARD BOTDOWN






















////////////////////////////////////////////////////////////
echo '</table> <BR>';

?>

<script type="text/javascript">
	
<?php
$setID = '$("#A_0_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });';

$setID .= '$("#A_100_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_100_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_100_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_100_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
//200
$setID .= '$("#A_200_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_200_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_200_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_200_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
//300
$setID .= '$("#A_300_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_300_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_300_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_300_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
//400
$setID .= '$("#A_400_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_400_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_400_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_400_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
//500
$setID .= '$("#A_500_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_500_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_500_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_500_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
//600
$setID .= '$("#A_600_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_600_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_600_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_600_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
//700
$setID .= '$("#A_700_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_700_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_700_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_700_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
//800
$setID .= '$("#A_800_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_800_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_800_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_800_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

///900
$setID .= '$("#A_900_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_900_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_900_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_900_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#A_901_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
		select_options: {
			0	: "Tiada",
			1	: "Tidak ditunjuk/nyata",
			2	: "Tidak memenuhi N.S.",
			3	: "Tidak dikemuka",
			4	: "Ada , lengkap",
			5	: "Ada , tidak lengkap",
			6	: "Ada , tidak standard",
			7	: "Tidak Aplikabel",
			8	: ""}
			});	
$("#A_901_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_901_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_901_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#A_902_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
		select_options: {
			0	: "Tiada",
			1	: "Tidak ditunjuk/nyata",
			2	: "Tidak memenuhi N.S.",
			3	: "Tidak dikemuka",
			4	: "Ada , lengkap",
			5	: "Ada , tidak lengkap",
			6	: "Ada , tidak standard",
			7	: "Tidak Aplikabel",
			8	: ""}
			});	
$("#A_902_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_902_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_902_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#A_903_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
		select_options: {
			0	: "Tiada",
			1	: "Tidak ditunjuk/nyata",
			2	: "Tidak memenuhi N.S.",
			3	: "Tidak dikemuka",
			4	: "Ada , lengkap",
			5	: "Ada , tidak lengkap",
			6	: "Ada , tidak standard",
			7	: "Tidak Aplikabel",
			8	: ""}
			});	
$("#A_903_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_903_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_903_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#A_904_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
		select_options: {
			0	: "Tiada",
			1	: "Tidak ditunjuk/nyata",
			2	: "Tidak memenuhi N.S.",
			3	: "Tidak dikemuka",
			4	: "Ada , lengkap",
			5	: "Ada , tidak lengkap",
			6	: "Ada , tidak standard",
			7	: "Tidak Aplikabel",
			8	: ""}
			});	
$("#A_904_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_904_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_904_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#A_905_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
		select_options: {
			0	: "Tiada",
			1	: "Tidak ditunjuk/nyata",
			2	: "Tidak memenuhi N.S.",
			3	: "Tidak dikemuka",
			4	: "Ada , lengkap",
			5	: "Ada , tidak lengkap",
			6	: "Ada , tidak standard",
			7	: "Tidak Aplikabel",
			8	: ""}
			});	
$("#A_905_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_905_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_905_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#A_906_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
		select_options: {
			0	: "Tiada",
			1	: "Tidak ditunjuk/nyata",
			2	: "Tidak memenuhi N.S.",
			3	: "Tidak dikemuka",
			4	: "Ada , lengkap",
			5	: "Ada , tidak lengkap",
			6	: "Ada , tidak standard",
			7	: "Tidak Aplikabel",
			8	: ""}
			});	
$("#A_906_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_906_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_906_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#A_907_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
		select_options: {
			0	: "Tiada",
			1	: "Tidak ditunjuk/nyata",
			2	: "Tidak memenuhi N.S.",
			3	: "Tidak dikemuka",
			4	: "Ada , lengkap",
			5	: "Ada , tidak lengkap",
			6	: "Ada , tidak standard",
			7	: "Tidak Aplikabel",
			8	: ""}
			});	
$("#A_907_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_907_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_907_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#A_908_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
		select_options: {
			0	: "Tiada",
			1	: "Tidak ditunjuk/nyata",
			2	: "Tidak memenuhi N.S.",
			3	: "Tidak dikemuka",
			4	: "Ada , lengkap",
			5	: "Ada , tidak lengkap",
			6	: "Ada , tidak standard",
			7	: "Tidak Aplikabel",
			8	: ""}
			});	
$("#A_908_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_908_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_908_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#A_909_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
		select_options: {
			0	: "Tiada",
			1	: "Tidak ditunjuk/nyata",
			2	: "Tidak memenuhi N.S.",
			3	: "Tidak dikemuka",
			4	: "Ada , lengkap",
			5	: "Ada , tidak lengkap",
			6	: "Ada , tidak standard",
			7	: "Tidak Aplikabel",
			8	: ""}
			});	
$("#A_909_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_909_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_909_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#A_910_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
		select_options: {
			0	: "Tiada",
			1	: "Tidak ditunjuk/nyata",
			2	: "Tidak memenuhi N.S.",
			3	: "Tidak dikemuka",
			4	: "Ada , lengkap",
			5	: "Ada , tidak lengkap",
			6	: "Ada , tidak standard",
			7	: "Tidak Aplikabel",
			8	: ""}
			});	
$("#A_910_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_910_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_910_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#A_911_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
		select_options: {
			0	: "Tiada",
			1	: "Tidak ditunjuk/nyata",
			2	: "Tidak memenuhi N.S.",
			3	: "Tidak dikemuka",
			4	: "Ada , lengkap",
			5	: "Ada , tidak lengkap",
			6	: "Ada , tidak standard",
			7	: "Tidak Aplikabel",
			8	: ""}
			});	
$("#A_911_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_911_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_911_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#A_912_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
		select_options: {
			0	: "Tiada",
			1	: "Tidak ditunjuk/nyata",
			2	: "Tidak memenuhi N.S.",
			3	: "Tidak dikemuka",
			4	: "Ada , lengkap",
			5	: "Ada , tidak lengkap",
			6	: "Ada , tidak standard",
			7	: "Tidak Aplikabel",
			8	: ""}
			});	
$("#A_912_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_912_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_912_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#A_913_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
		select_options: {
			0	: "Tiada",
			1	: "Tidak ditunjuk/nyata",
			2	: "Tidak memenuhi N.S.",
			3	: "Tidak dikemuka",
			4	: "Ada , lengkap",
			5	: "Ada , tidak lengkap",
			6	: "Ada , tidak standard",
			7	: "Tidak Aplikabel",
			8	: ""}
			});	
$("#A_913_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_913_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_913_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
//
$setID .= '$("#A_914_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
		select_options: {
			0	: "Tiada",
			1	: "Tidak ditunjuk/nyata",
			2	: "Tidak memenuhi N.S.",
			3	: "Tidak dikemuka",
			4	: "Ada , lengkap",
			5	: "Ada , tidak lengkap",
			6	: "Ada , tidak standard",
			7	: "Tidak Aplikabel",
			8	: ""}
			});	
$("#A_914_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_914_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_914_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#A_915_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
		select_options: {
			0	: "Tiada",
			1	: "Tidak ditunjuk/nyata",
			2	: "Tidak memenuhi N.S.",
			3	: "Tidak dikemuka",
			4	: "Ada , lengkap",
			5	: "Ada , tidak lengkap",
			6	: "Ada , tidak standard",
			7	: "Tidak Aplikabel",
			8	: ""}
			});	
$("#A_915_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_915_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_915_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#A_916_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
		select_options: {
			0	: "Tiada",
			1	: "Tidak ditunjuk/nyata",
			2	: "Tidak memenuhi N.S.",
			3	: "Tidak dikemuka",
			4	: "Ada , lengkap",
			5	: "Ada , tidak lengkap",
			6	: "Ada , tidak standard",
			7	: "Tidak Aplikabel",
			8	: ""}
			});	
$("#A_916_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_916_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_916_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

//1000
$setID .= '$("#A_1000_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_1000_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_1000_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_1000_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
//1100
$setID .= '$("#A_1100_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_1100_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_1100_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_1100_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
//1200
$setID .= '$("#A_1200_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_1200_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_1200_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_1200_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
//1300
$setID .= '$("#A_1300_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_1300_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_1300_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_1300_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
//1400
$setID .= '$("#A_1400_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_1400_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_1400_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_1400_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
//1500
$setID .= '$("#A_1500_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_1500_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_1500_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_1500_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
//1600
$setID .= '$("#A_1600_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_1600_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_1600_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_1600_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
//1700
$setID .= '$("#A_1700_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_1700_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_1700_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_1700_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
//1800
$setID .= '$("#A_1800_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_1800_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_1800_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_1800_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
//1900
$setID .= '$("#A_1900_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_1900_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_1900_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_1900_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
//2000
$setID .= '$("#A_2000_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_2000_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_2000_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_2000_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
//2100
$setID .= '$("#A_2100_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_2100_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_2100_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#A_2100_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';





echo $setID;

	?>

</script>


</body>
</html>
<?php // Flush the buffered output to the Web browser.
ob_flush();
?>
