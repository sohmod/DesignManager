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
	<title>eggBlog - ut_watersupply</title>
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
<font color="gray">EIP - Ulasan Teknikal '.$objektif.' Kerja Sivil : </font><font color="red">Watersupply</font><font color="green">&nbsp;&nbsp;Job no:>'.$chk_id.'</font><br/>

<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/ulasanTeknikal_general.php"><font color="green" size="2em" style="text-decoration:none">general</font></a>
<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/ulasanTeknikal_earthwork.php"><font color="green" size="2em" style="text-decoration:none">earthwork</font></a>
<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/ulasanTeknikal_drainage.php"><font color="green" size="2em" style="text-decoration:none">drainage</font></a>
<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/ulasanTeknikal_roadwork.php"><font color="green" size="2em" style="text-decoration:none">roadwork</font></a>
<!--a href="http://'.$ipthis.'/_bka/editinPlacejQuery/ulasanTeknikal_watersupply.php"><font color="green" size="2em" style="text-decoration:none"-->watersupply<!--/font></a-->
<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/ulasanTeknikal_sewerage.php"><font color="green" size="2em" style="text-decoration:none">sewerage</font></a></a>';

echo $localLink . $header;

$chk='B4_0_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$chk'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_0_CK  = $row['new_value'];	} if (empty($B4_0_CK)){$B4_0_CK = '<i>Klik2Edit</i>'; }
echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>'.$itemB4[0].'</b></td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">.</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px"><b>'.$B4[0].'</b></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$chk.'">'.$B4_0_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span>.</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span>.</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span>.</span></td></tr>';
$B4_0_CK = '';

//STANDARD TOPUP100
$CK='B4_100_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_100_CK  = $row['new_value'];	}
$UJ='B4_100_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_100_UJ  = $row['new_value'];	}
$TK='B4_100_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_100_TK  = $row['new_value'];	}
$KJ='B4_100_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_100_KJ  = $row['new_value'];	}

if (empty($B4_100_CK)){$B4_100_CK = '<i>Klik2Edit<</i>'; }if (empty($B4_100_UJ)){$B4_100_UJ = '<i>Klik2Edit</i>'; }if (empty($B4_100_TK)){$B4_100_TK = '<i>Klik2Edit</i>'; }if (empty($B4_100_KJ)){$B4_100_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[100].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B4[100].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B4_100_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B4_100_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B4_100_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B4_100_KJ.'</span></td></tr>';
$B4_100_CK = '';$B4_100_UJ = '';$B4_100_TK = '';$B4_100_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP101
$CK='B4_101_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_101_CK  = $row['new_value'];	}
$UJ='B4_101_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_101_UJ  = $row['new_value'];	}
$TK='B4_101_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_101_TK  = $row['new_value'];	}
$KJ='B4_101_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_101_KJ  = $row['new_value'];	}

if (empty($B4_101_CK)){$B4_101_CK = '<i>Klik2Edit</i>'; }if (empty($B4_101_UJ)){$B4_101_UJ = '<i>Klik2Edit</i>'; }if (empty($B4_101_TK)){$B4_101_TK = '<i>Klik2Edit</i>'; }if (empty($B4_101_KJ)){$B4_101_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[101].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B4[101].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B4_101_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B4_101_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B4_101_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B4_101_KJ.'</span></td></tr>';
$B4_101_CK = '';$B4_101_UJ = '';$B4_101_TK = '';$B4_101_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP102
$CK='B4_102_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_102_CK  = $row['new_value'];	}
$UJ='B4_102_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_102_UJ  = $row['new_value'];	}
$TK='B4_102_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_102_TK  = $row['new_value'];	}
$KJ='B4_102_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_102_KJ  = $row['new_value'];	}

if (empty($B4_102_CK)){$B4_102_CK = '<i>Klik2Edit</i>'; }if (empty($B4_102_UJ)){$B4_102_UJ = '<i>Klik2Edit</i>'; }if (empty($B4_102_TK)){$B4_102_TK = '<i>Klik2Edit</i>'; }if (empty($B4_102_KJ)){$B4_102_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[102].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B4[102].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B4_102_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B4_102_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B4_102_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B4_102_KJ.'</span></td></tr>';
$B4_102_CK = '';$B4_102_UJ = '';$B4_102_TK = '';$B4_102_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP103
$CK='B4_103_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_103_CK  = $row['new_value'];	}
$UJ='B4_103_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_103_UJ  = $row['new_value'];	}
$TK='B4_103_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_103_TK  = $row['new_value'];	}
$KJ='B4_103_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_103_KJ  = $row['new_value'];	}

if (empty($B4_103_CK)){$B4_103_CK = '<i>Klik2Edit</i>'; }if (empty($B4_103_UJ)){$B4_103_UJ = '<i>Klik2Edit</i>'; }if (empty($B4_103_TK)){$B4_103_TK = '<i>Klik2Edit</i>'; }if (empty($B4_103_KJ)){$B4_103_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[103].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B4[103].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B4_103_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B4_103_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B4_103_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B4_103_KJ.'</span></td></tr>';
$B4_103_CK = '';$B4_103_UJ = '';$B4_103_TK = '';$B4_103_KJ = '';
//STANDARD BOTDOWN

///200

//STANDARD TOPUP200
$CK='B4_200_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_200_CK  = $row['new_value'];	}
$UJ='B4_200_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_200_UJ  = $row['new_value'];	}
$TK='B4_200_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_200_TK  = $row['new_value'];	}
$KJ='B4_200_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_200_KJ  = $row['new_value'];	}

if (empty($B4_200_CK)){$B4_200_CK = '<i>Klik2Edit</i>'; }if (empty($B4_200_UJ)){$B4_200_UJ = '<i>Klik2Edit</i>'; }if (empty($B4_200_TK)){$B4_200_TK = '<i>Klik2Edit</i>'; }if (empty($B4_200_KJ)){$B4_200_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[200].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B4[200].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B4_200_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B4_200_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B4_200_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B4_200_KJ.'</span></td></tr>';
$B4_200_CK = '';$B4_200_UJ = '';$B4_200_TK = '';$B4_200_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP201
$CK='B4_201_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_201_CK  = $row['new_value'];	}
$UJ='B4_201_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_201_UJ  = $row['new_value'];	}
$TK='B4_201_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_201_TK  = $row['new_value'];	}
$KJ='B4_201_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_201_KJ  = $row['new_value'];	}

if (empty($B4_201_CK)){$B4_201_CK = '<i>Klik2Edit</i>'; }if (empty($B4_201_UJ)){$B4_201_UJ = '<i>Klik2Edit</i>'; }if (empty($B4_201_TK)){$B4_201_TK = '<i>Klik2Edit</i>'; }if (empty($B4_201_KJ)){$B4_201_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[201].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B4[201].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B4_201_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B4_201_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B4_201_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B4_201_KJ.'</span></td></tr>';
$B4_201_CK = '';$B4_201_UJ = '';$B4_201_TK = '';$B4_201_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP202
$CK='B4_202_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_202_CK  = $row['new_value'];	}
$UJ='B4_202_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_202_UJ  = $row['new_value'];	}
$TK='B4_202_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_202_TK  = $row['new_value'];	}
$KJ='B4_202_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_202_KJ  = $row['new_value'];	}

if (empty($B4_202_CK)){$B4_202_CK = '<i>Klik2Edit</i>'; }if (empty($B4_202_UJ)){$B4_202_UJ = '<i>Klik2Edit</i>'; }if (empty($B4_202_TK)){$B4_202_TK = '<i>Klik2Edit</i>'; }if (empty($B4_202_KJ)){$B4_202_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[202].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B4[202].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B4_202_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B4_202_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B4_202_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B4_202_KJ.'</span></td></tr>';
$B4_202_CK = '';$B4_202_UJ = '';$B4_202_TK = '';$B4_202_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP300
$CK='B4_300_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_300_CK  = $row['new_value'];	}
$UJ='B4_300_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_300_UJ  = $row['new_value'];	}
$TK='B4_300_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_300_TK  = $row['new_value'];	}
$KJ='B4_300_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_300_KJ  = $row['new_value'];	}

if (empty($B4_300_CK)){$B4_300_CK = '<i>Klik2Edit</i>'; }if (empty($B4_300_UJ)){$B4_300_UJ = '<i>Klik2Edit</i>'; }if (empty($B4_300_TK)){$B4_300_TK = '<i>Klik2Edit</i>'; }if (empty($B4_300_KJ)){$B4_300_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[300].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B4[300].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B4_300_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B4_300_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B4_300_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B4_300_KJ.'</span></td></tr>';
$B4_300_CK = '';$B4_300_UJ = '';$B4_300_TK = '';$B4_300_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP301
$CK='B4_301_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_301_CK  = $row['new_value'];	}
$UJ='B4_301_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_301_UJ  = $row['new_value'];	}
$TK='B4_301_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_301_TK  = $row['new_value'];	}
$KJ='B4_301_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_301_KJ  = $row['new_value'];	}

if (empty($B4_301_CK)){$B4_301_CK = '<i>Klik2Edit</i>'; }if (empty($B4_301_UJ)){$B4_301_UJ = '<i>Klik2Edit</i>'; }if (empty($B4_301_TK)){$B4_301_TK = '<i>Klik2Edit</i>'; }if (empty($B4_301_KJ)){$B4_301_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[301].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B4[301].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B4_301_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B4_301_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B4_301_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B4_301_KJ.'</span></td></tr>';
$B4_301_CK = '';$B4_301_UJ = '';$B4_301_TK = '';$B4_301_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP400
$CK='B4_400_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_400_CK  = $row['new_value'];	}
$UJ='B4_400_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_400_UJ  = $row['new_value'];	}
$TK='B4_400_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_400_TK  = $row['new_value'];	}
$KJ='B4_400_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_400_KJ  = $row['new_value'];	}

if (empty($B4_400_CK)){$B4_400_CK = '<i>Klik2Edit</i>'; }if (empty($B4_400_UJ)){$B4_400_UJ = '<i>Klik2Edit</i>'; }if (empty($B4_400_TK)){$B4_400_TK = '<i>Klik2Edit</i>'; }if (empty($B4_400_KJ)){$B4_400_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[400].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B4[400].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B4_400_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B4_400_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B4_400_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B4_400_KJ.'</span></td></tr>';
$B4_400_CK = '';$B4_400_UJ = '';$B4_400_TK = '';$B4_400_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP401
$CK='B4_401_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_401_CK  = $row['new_value'];	}
$UJ='B4_401_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_401_UJ  = $row['new_value'];	}
$TK='B4_401_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_401_TK  = $row['new_value'];	}
$KJ='B4_401_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_401_KJ  = $row['new_value'];	}

if (empty($B4_401_CK)){$B4_401_CK = '<i>Klik2Edit</i>'; }if (empty($B4_401_UJ)){$B4_401_UJ = '<i>Klik2Edit</i>'; }if (empty($B4_401_TK)){$B4_401_TK = '<i>Klik2Edit</i>'; }if (empty($B4_401_KJ)){$B4_401_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[401].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B4[401].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B4_401_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B4_401_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B4_401_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B4_401_KJ.'</span></td></tr>';
$B4_401_CK = '';$B4_401_UJ = '';$B4_401_TK = '';$B4_401_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP500
$CK='B4_500_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_500_CK  = $row['new_value'];	}
$UJ='B4_500_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_500_UJ  = $row['new_value'];	}
$TK='B4_500_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_500_TK  = $row['new_value'];	}
$KJ='B4_500_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_500_KJ  = $row['new_value'];	}

if (empty($B4_500_CK)){$B4_500_CK = '<i>Klik2Edit</i>'; }if (empty($B4_500_UJ)){$B4_500_UJ = '<i>Klik2Edit</i>'; }if (empty($B4_500_TK)){$B4_500_TK = '<i>Klik2Edit</i>'; }if (empty($B4_500_KJ)){$B4_500_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[500].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B4[500].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B4_500_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B4_500_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B4_500_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B4_500_KJ.'</span></td></tr>';
$B4_500_CK = '';$B4_500_UJ = '';$B4_500_TK = '';$B4_500_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP501
$CK='B4_501_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_501_CK  = $row['new_value'];	}
$UJ='B4_501_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_501_UJ  = $row['new_value'];	}
$TK='B4_501_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_501_TK  = $row['new_value'];	}
$KJ='B4_501_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_501_KJ  = $row['new_value'];	}

if (empty($B4_501_CK)){$B4_501_CK = '<i>Klik2Edit</i>'; }if (empty($B4_501_UJ)){$B4_501_UJ = '<i>Klik2Edit</i>'; }if (empty($B4_501_TK)){$B4_501_TK = '<i>Klik2Edit</i>'; }if (empty($B4_501_KJ)){$B4_501_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[501].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B4[501].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B4_501_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B4_501_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B4_501_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B4_501_KJ.'</span></td></tr>';
$B4_501_CK = '';$B4_501_UJ = '';$B4_501_TK = '';$B4_501_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP600
$CK='B4_600_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_600_CK  = $row['new_value'];	}
$UJ='B4_600_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_600_UJ  = $row['new_value'];	}
$TK='B4_600_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_600_TK  = $row['new_value'];	}
$KJ='B4_600_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_600_KJ  = $row['new_value'];	}

if (empty($B4_600_CK)){$B4_600_CK = '<i>Klik2Edit</i>'; }if (empty($B4_600_UJ)){$B4_600_UJ = '<i>Klik2Edit</i>'; }if (empty($B4_600_TK)){$B4_600_TK = '<i>Klik2Edit</i>'; }if (empty($B4_600_KJ)){$B4_600_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[600].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B4[600].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B4_600_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B4_600_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B4_600_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B4_600_KJ.'</span></td></tr>';
$B4_600_CK = '';$B4_600_UJ = '';$B4_600_TK = '';$B4_600_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP700
$CK='B4_700_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_700_CK  = $row['new_value'];	}
$UJ='B4_700_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_700_UJ  = $row['new_value'];	}
$TK='B4_700_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_700_TK  = $row['new_value'];	}
$KJ='B4_700_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_700_KJ  = $row['new_value'];	}

if (empty($B4_700_CK)){$B4_700_CK = '<i>Klik2Edit</i>'; }if (empty($B4_700_UJ)){$B4_700_UJ = '<i>Klik2Edit</i>'; }if (empty($B4_700_TK)){$B4_700_TK = '<i>Klik2Edit</i>'; }if (empty($B4_700_KJ)){$B4_700_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[700].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B4[700].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B4_700_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B4_700_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B4_700_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B4_700_KJ.'</span></td></tr>';
$B4_700_CK = '';$B4_700_UJ = '';$B4_700_TK = '';$B4_700_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP800
$CK='B4_800_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_800_CK  = $row['new_value'];	}
$UJ='B4_800_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_800_UJ  = $row['new_value'];	}
$TK='B4_800_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_800_TK  = $row['new_value'];	}
$KJ='B4_800_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_800_KJ  = $row['new_value'];	}

if (empty($B4_800_CK)){$B4_800_CK = '<i>Klik2Edit</i>'; }if (empty($B4_800_UJ)){$B4_800_UJ = '<i>Klik2Edit</i>'; }if (empty($B4_800_TK)){$B4_800_TK = '<i>Klik2Edit</i>'; }if (empty($B4_800_KJ)){$B4_800_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[800].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B4[800].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B4_800_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B4_800_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B4_800_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B4_800_KJ.'</span></td></tr>';
$B4_800_CK = '';$B4_800_UJ = '';$B4_800_TK = '';$B4_800_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP801
$CK='B4_801_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_801_CK  = $row['new_value'];	}
$UJ='B4_801_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_801_UJ  = $row['new_value'];	}
$TK='B4_801_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_801_TK  = $row['new_value'];	}
$KJ='B4_801_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_801_KJ  = $row['new_value'];	}

if (empty($B4_801_CK)){$B4_801_CK = '<i>Klik2Edit</i>'; }if (empty($B4_801_UJ)){$B4_801_UJ = '<i>Klik2Edit</i>'; }if (empty($B4_801_TK)){$B4_801_TK = '<i>Klik2Edit</i>'; }if (empty($B4_801_KJ)){$B4_801_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[801].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B4[801].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B4_801_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B4_801_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B4_801_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B4_801_KJ.'</span></td></tr>';
$B4_801_CK = '';$B4_801_UJ = '';$B4_801_TK = '';$B4_801_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP802
$CK='B4_802_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_802_CK  = $row['new_value'];	}
$UJ='B4_802_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_802_UJ  = $row['new_value'];	}
$TK='B4_802_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_802_TK  = $row['new_value'];	}
$KJ='B4_802_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_802_KJ  = $row['new_value'];	}

if (empty($B4_802_CK)){$B4_802_CK = '<i>Klik2Edit</i>'; }if (empty($B4_802_UJ)){$B4_802_UJ = '<i>Klik2Edit</i>'; }if (empty($B4_802_TK)){$B4_802_TK = '<i>Klik2Edit</i>'; }if (empty($B4_802_KJ)){$B4_802_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[802].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B4[802].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B4_802_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B4_802_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B4_802_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B4_802_KJ.'</span></td></tr>';
$B4_802_CK = '';$B4_802_UJ = '';$B4_802_TK = '';$B4_802_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP900
$CK='B4_900_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_900_CK  = $row['new_value'];	}
$UJ='B4_900_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_900_UJ  = $row['new_value'];	}
$TK='B4_900_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_900_TK  = $row['new_value'];	}
$KJ='B4_900_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_900_KJ  = $row['new_value'];	}

if (empty($B4_900_CK)){$B4_900_CK = '<i>Klik2Edit</i>'; }if (empty($B4_900_UJ)){$B4_900_UJ = '<i>Klik2Edit</i>'; }if (empty($B4_900_TK)){$B4_900_TK = '<i>Klik2Edit</i>'; }if (empty($B4_900_KJ)){$B4_900_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[900].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B4[900].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B4_900_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B4_900_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B4_900_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B4_900_KJ.'</span></td></tr>';
$B4_900_CK = '';$B4_900_UJ = '';$B4_900_TK = '';$B4_900_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP901
$CK='B4_901_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_901_CK  = $row['new_value'];	}
$UJ='B4_901_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_901_UJ  = $row['new_value'];	}
$TK='B4_901_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_901_TK  = $row['new_value'];	}
$KJ='B4_901_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_901_KJ  = $row['new_value'];	}

if (empty($B4_901_CK)){$B4_901_CK = '<i>Klik2Edit</i>'; }if (empty($B4_901_UJ)){$B4_901_UJ = '<i>Klik2Edit</i>'; }if (empty($B4_901_TK)){$B4_901_TK = '<i>Klik2Edit</i>'; }if (empty($B4_901_KJ)){$B4_901_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[901].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B4[901].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B4_901_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B4_901_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B4_901_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B4_901_KJ.'</span></td></tr>';
$B4_901_CK = '';$B4_901_UJ = '';$B4_901_TK = '';$B4_901_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP902
$CK='B4_902_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_902_CK  = $row['new_value'];	}
$UJ='B4_902_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_902_UJ  = $row['new_value'];	}
$TK='B4_902_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_902_TK  = $row['new_value'];	}
$KJ='B4_902_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_902_KJ  = $row['new_value'];	}

if (empty($B4_902_CK)){$B4_902_CK = '<i>Klik2Edit</i>'; }if (empty($B4_902_UJ)){$B4_902_UJ = '<i>Klik2Edit</i>'; }if (empty($B4_902_TK)){$B4_902_TK = '<i>Klik2Edit</i>'; }if (empty($B4_902_KJ)){$B4_902_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[902].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B4[902].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B4_902_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B4_902_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B4_902_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B4_902_KJ.'</span></td></tr>';
$B4_902_CK = '';$B4_902_UJ = '';$B4_902_TK = '';$B4_902_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP903
$CK='B4_903_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_903_CK  = $row['new_value'];	}
$UJ='B4_903_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_903_UJ  = $row['new_value'];	}
$TK='B4_903_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_903_TK  = $row['new_value'];	}
$KJ='B4_903_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_903_KJ  = $row['new_value'];	}

if (empty($B4_903_CK)){$B4_903_CK = '<i>Klik2Edit</i>'; }if (empty($B4_903_UJ)){$B4_903_UJ = '<i>Klik2Edit</i>'; }if (empty($B4_903_TK)){$B4_903_TK = '<i>Klik2Edit</i>'; }if (empty($B4_903_KJ)){$B4_903_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[903].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B4[903].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B4_903_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B4_903_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B4_903_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B4_903_KJ.'</span></td></tr>';
$B4_903_CK = '';$B4_903_UJ = '';$B4_903_TK = '';$B4_903_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP904
$CK='B4_904_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_904_CK  = $row['new_value'];	}
$UJ='B4_904_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_904_UJ  = $row['new_value'];	}
$TK='B4_904_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_904_TK  = $row['new_value'];	}
$KJ='B4_904_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_904_KJ  = $row['new_value'];	}

if (empty($B4_904_CK)){$B4_904_CK = '<i>Klik2Edit</i>'; }if (empty($B4_904_UJ)){$B4_904_UJ = '<i>Klik2Edit</i>'; }if (empty($B4_904_TK)){$B4_904_TK = '<i>Klik2Edit</i>'; }if (empty($B4_904_KJ)){$B4_904_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[904].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B4[904].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B4_904_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B4_904_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B4_904_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B4_904_KJ.'</span></td></tr>';
$B4_904_CK = '';$B4_904_UJ = '';$B4_904_TK = '';$B4_904_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP905
$CK='B4_905_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_905_CK  = $row['new_value'];	}
$UJ='B4_905_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_905_UJ  = $row['new_value'];	}
$TK='B4_905_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_905_TK  = $row['new_value'];	}
$KJ='B4_905_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_905_KJ  = $row['new_value'];	}

if (empty($B4_905_CK)){$B4_905_CK = '<i>Klik2Edit</i>'; }if (empty($B4_905_UJ)){$B4_905_UJ = '<i>Klik2Edit</i>'; }if (empty($B4_905_TK)){$B4_905_TK = '<i>Klik2Edit</i>'; }if (empty($B4_905_KJ)){$B4_905_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[905].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B4[905].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B4_905_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B4_905_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B4_905_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B4_905_KJ.'</span></td></tr>';
$B4_905_CK = '';$B4_905_UJ = '';$B4_905_TK = '';$B4_905_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP906
$CK='B4_906_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_906_CK  = $row['new_value'];	}
$UJ='B4_906_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_906_UJ  = $row['new_value'];	}
$TK='B4_906_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_906_TK  = $row['new_value'];	}
$KJ='B4_906_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_906_KJ  = $row['new_value'];	}

if (empty($B4_906_CK)){$B4_906_CK = '<i>Klik2Edit</i>'; }if (empty($B4_906_UJ)){$B4_906_UJ = '<i>Klik2Edit</i>'; }if (empty($B4_906_TK)){$B4_906_TK = '<i>Klik2Edit</i>'; }if (empty($B4_906_KJ)){$B4_906_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[906].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B4[906].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B4_906_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B4_906_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B4_906_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B4_906_KJ.'</span></td></tr>';
$B4_906_CK = '';$B4_906_UJ = '';$B4_906_TK = '';$B4_906_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP907
$CK='B4_907_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_907_CK  = $row['new_value'];	}
$UJ='B4_907_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_907_UJ  = $row['new_value'];	}
$TK='B4_907_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_907_TK  = $row['new_value'];	}
$KJ='B4_907_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_907_KJ  = $row['new_value'];	}

if (empty($B4_907_CK)){$B4_907_CK = '<i>Klik2Edit</i>'; }if (empty($B4_907_UJ)){$B4_907_UJ = '<i>Klik2Edit</i>'; }if (empty($B4_907_TK)){$B4_907_TK = '<i>Klik2Edit</i>'; }if (empty($B4_907_KJ)){$B4_907_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[907].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B4[907].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B4_907_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B4_907_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B4_907_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B4_907_KJ.'</span></td></tr>';
$B4_907_CK = '';$B4_907_UJ = '';$B4_907_TK = '';$B4_907_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP908
$CK='B4_908_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_908_CK  = $row['new_value'];	}
$UJ='B4_908_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_908_UJ  = $row['new_value'];	}
$TK='B4_908_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_908_TK  = $row['new_value'];	}
$KJ='B4_908_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_908_KJ  = $row['new_value'];	}

if (empty($B4_908_CK)){$B4_908_CK = '<i>Klik2Edit</i>'; }if (empty($B4_908_UJ)){$B4_908_UJ = '<i>Klik2Edit</i>'; }if (empty($B4_908_TK)){$B4_908_TK = '<i>Klik2Edit</i>'; }if (empty($B4_908_KJ)){$B4_908_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[908].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B4[908].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B4_908_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B4_908_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B4_908_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B4_908_KJ.'</span></td></tr>';
$B4_908_CK = '';$B4_908_UJ = '';$B4_908_TK = '';$B4_908_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP909
$CK='B4_909_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_909_CK  = $row['new_value'];	}
$UJ='B4_909_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_909_UJ  = $row['new_value'];	}
$TK='B4_909_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_909_TK  = $row['new_value'];	}
$KJ='B4_909_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_909_KJ  = $row['new_value'];	}

if (empty($B4_909_CK)){$B4_909_CK = '<i>Klik2Edit</i>'; }if (empty($B4_909_UJ)){$B4_909_UJ = '<i>Klik2Edit</i>'; }if (empty($B4_909_TK)){$B4_909_TK = '<i>Klik2Edit</i>'; }if (empty($B4_909_KJ)){$B4_909_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[909].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B4[909].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B4_909_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B4_909_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B4_909_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B4_909_KJ.'</span></td></tr>';
$B4_909_CK = '';$B4_909_UJ = '';$B4_909_TK = '';$B4_909_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP1000
$CK='B4_1000_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_1000_CK  = $row['new_value'];	}
$UJ='B4_1000_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_1000_UJ  = $row['new_value'];	}
$TK='B4_1000_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_1000_TK  = $row['new_value'];	}
$KJ='B4_1000_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_1000_KJ  = $row['new_value'];	}

if (empty($B4_1000_CK)){$B4_1000_CK = '<i>Klik2Edit</i>'; }if (empty($B4_1000_UJ)){$B4_1000_UJ = '<i>Klik2Edit</i>'; }if (empty($B4_1000_TK)){$B4_1000_TK = '<i>Klik2Edit</i>'; }if (empty($B4_1000_KJ)){$B4_1000_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[1000].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B4[1000].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B4_1000_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B4_1000_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B4_1000_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B4_1000_KJ.'</span></td></tr>';
$B4_1000_CK = '';$B4_1000_UJ = '';$B4_1000_TK = '';$B4_1000_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP1100
$CK='B4_1100_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_1100_CK  = $row['new_value'];	}
$UJ='B4_1100_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_1100_UJ  = $row['new_value'];	}
$TK='B4_1100_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_1100_TK  = $row['new_value'];	}
$KJ='B4_1100_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_1100_KJ  = $row['new_value'];	}

if (empty($B4_1100_CK)){$B4_1100_CK = '<i>Klik2Edit</i>'; }if (empty($B4_1100_UJ)){$B4_1100_UJ = '<i>Klik2Edit</i>'; }if (empty($B4_1100_TK)){$B4_1100_TK = '<i>Klik2Edit</i>'; }if (empty($B4_1100_KJ)){$B4_1100_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[1100].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B4[1100].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B4_1100_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B4_1100_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B4_1100_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B4_1100_KJ.'</span></td></tr>';
$B4_1100_CK = '';$B4_1100_UJ = '';$B4_1100_TK = '';$B4_1100_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP1200
$CK='B4_1200_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_1200_CK  = $row['new_value'];	}
$UJ='B4_1200_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_1200_UJ  = $row['new_value'];	}
$TK='B4_1200_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_1200_TK  = $row['new_value'];	}
$KJ='B4_1200_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_1200_KJ  = $row['new_value'];	}

if (empty($B4_1200_CK)){$B4_1200_CK = '<i>Klik2Edit</i>'; }if (empty($B4_1200_UJ)){$B4_1200_UJ = '<i>Klik2Edit</i>'; }if (empty($B4_1200_TK)){$B4_1200_TK = '<i>Klik2Edit</i>'; }if (empty($B4_1200_KJ)){$B4_1200_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[1200].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B4[1200].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B4_1200_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B4_1200_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B4_1200_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B4_1200_KJ.'</span></td></tr>';
$B4_1200_CK = '';$B4_1200_UJ = '';$B4_1200_TK = '';$B4_1200_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP1300
$CK='B4_1300_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_1300_CK  = $row['new_value'];	}
$UJ='B4_1300_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_1300_UJ  = $row['new_value'];	}
$TK='B4_1300_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_1300_TK  = $row['new_value'];	}
$KJ='B4_1300_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_1300_KJ  = $row['new_value'];	}

if (empty($B4_1300_CK)){$B4_1300_CK = '<i>Klik2Edit</i>'; }if (empty($B4_1300_UJ)){$B4_1300_UJ = '<i>Klik2Edit</i>'; }if (empty($B4_1300_TK)){$B4_1300_TK = '<i>Klik2Edit</i>'; }if (empty($B4_1300_KJ)){$B4_1300_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[1300].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B4[1300].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B4_1300_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B4_1300_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B4_1300_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B4_1300_KJ.'</span></td></tr>';
$B4_1300_CK = '';$B4_1300_UJ = '';$B4_1300_TK = '';$B4_1300_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP1400
$CK='B4_1400_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_1400_CK  = $row['new_value'];	}
$UJ='B4_1400_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_1400_UJ  = $row['new_value'];	}
$TK='B4_1400_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_1400_TK  = $row['new_value'];	}
$KJ='B4_1400_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B4_1400_KJ  = $row['new_value'];	}

if (empty($B4_1400_CK)){$B4_1400_CK = '<i>Klik2Edit</i>'; }if (empty($B4_1400_UJ)){$B4_1400_UJ = '<i>Klik2Edit</i>'; }if (empty($B4_1400_TK)){$B4_1400_TK = '<i>Klik2Edit</i>'; }if (empty($B4_1400_KJ)){$B4_1400_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB4[1400].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B4[1400].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B4_1400_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B4_1400_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B4_1400_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B4_1400_KJ.'</span></td></tr>';
$B4_1400_CK = '';$B4_1400_UJ = '';$B4_1400_TK = '';$B4_1400_KJ = '';
//STANDARD BOTDOWN











////////////////////////////////////////////////////////////
echo '</table> <BR>';

?>

<script type="text/javascript">
	
<?php
$setID = '$("#A_0_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });';

$setID .= '$("#B4_0_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });';

$setID .= '$("#B4_100_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_100_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_100_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_100_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B4_101_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B4_101_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_101_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_101_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B4_102_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B4_102_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_102_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_102_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B4_103_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B4_103_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_103_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_103_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

///200
$setID .= '$("#B4_200_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_200_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_200_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_200_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B4_201_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B4_201_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_201_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_201_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B4_202_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B4_202_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_202_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_202_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

///300
$setID .= '$("#B4_300_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_300_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_300_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_300_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B4_301_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B4_301_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_301_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_301_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

///400
$setID .= '$("#B4_400_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_400_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_400_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_400_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B4_401_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B4_401_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_401_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_401_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

///500
$setID .= '$("#B4_500_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_500_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_500_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_500_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B4_501_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B4_501_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_501_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_501_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

///600
$setID .= '$("#B4_600_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_600_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_600_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_600_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

///700
$setID .= '$("#B4_700_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_700_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_700_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_700_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

///800
$setID .= '$("#B4_800_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_800_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_800_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_800_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B4_801_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B4_801_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_801_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_801_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B4_802_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B4_802_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_802_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_802_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

///900
$setID .= '$("#B4_900_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_900_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_900_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_900_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B4_901_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B4_901_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_901_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_901_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B4_902_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B4_902_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_902_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_902_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B4_903_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B4_903_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_903_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_903_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B4_904_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B4_904_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_904_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_904_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B4_905_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B4_905_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_905_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_905_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B4_906_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B4_906_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_906_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_906_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B4_907_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B4_907_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_907_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_907_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B4_908_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B4_908_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_908_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_908_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B4_909_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B4_909_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_909_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_909_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

///1000
$setID .= '$("#B4_1000_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_1000_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_1000_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_1000_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

///1100
$setID .= '$("#B4_1100_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_1100_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_1100_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_1100_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

///1200
$setID .= '$("#B4_1200_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_1200_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_1200_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_1200_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

///1300
$setID .= '$("#B4_1300_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_1300_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_1300_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_1300_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

///1400
$setID .= '$("#B4_1400_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_1400_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_1400_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B4_1400_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
echo $setID;

	?>

</script>


</body>
</html>
<?php // Flush the buffered output to the Web browser.
ob_flush();
?>
