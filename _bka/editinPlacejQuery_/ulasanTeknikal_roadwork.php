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
	<title>eggBlog - ut_roadwork</title>
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
<font color="gray">EIP - Ulasan Teknikal '.$objektif.' Kerja Sivil : </font><font color="red">Roadwork</font><font color="green">&nbsp;&nbsp;Job no:>'.$chk_id.'</font><br/>

<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/ulasanTeknikal_general.php"><font color="green" size="2em" style="text-decoration:none">general</font></a>
<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/ulasanTeknikal_earthwork.php"><font color="green" size="2em" style="text-decoration:none">earthwork</font></a>
<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/ulasanTeknikal_drainage.php"><font color="green" size="2em" style="text-decoration:none">drainage</font></a>
<!--a href="http://'.$ipthis.'/_bka/editinPlacejQuery/ulasanTeknikal_roadwork.php"><font color="green" size="2em" style="text-decoration:none"-->roadwork<!--/font></a-->
<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/ulasanTeknikal_watersupply.php"><font color="green" size="2em" style="text-decoration:none">watersupply</font></a>
<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/ulasanTeknikal_sewerage.php"><font color="green" size="2em" style="text-decoration:none">sewerage</font></a>';

echo $localLink . $header;

$chk='B3_0_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$chk'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_0_CK  = $row['new_value'];	} if (empty($B3_0_CK)){$B3_0_CK = '<i>Klik2Edit</i>'; }
echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>'.$itemB3[0].'</b></td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">.</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px"><b>'.$B3[0].'</b></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$chk.'">'.$B3_0_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span>.</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span>.</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span>.</span></td></tr>';
$B3_0_CK = '';

//STANDARD TOPUP100
$CK='B3_100_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_100_CK  = $row['new_value'];	}
$UJ='B3_100_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_100_UJ  = $row['new_value'];	}
$TK='B3_100_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_100_TK  = $row['new_value'];	}
$KJ='B3_100_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_100_KJ  = $row['new_value'];	}

if (empty($B3_100_CK)){$B3_100_CK = '<i>Klik2Edit<</i>'; }if (empty($B3_100_UJ)){$B3_100_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_100_TK)){$B3_100_TK = '<i>Klik2Edit</i>'; }if (empty($B3_100_KJ)){$B3_100_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[100].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[100].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_100_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_100_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_100_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_100_KJ.'</span></td></tr>';
$B3_100_CK = '';$B3_100_UJ = '';$B3_100_TK = '';$B3_100_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP101
$CK='B3_101_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_101_CK  = $row['new_value'];	}
$UJ='B3_101_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_101_UJ  = $row['new_value'];	}
$TK='B3_101_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_101_TK  = $row['new_value'];	}
$KJ='B3_101_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_101_KJ  = $row['new_value'];	}

if (empty($B3_101_CK)){$B3_101_CK = '<i>Klik2Edit</i>'; }if (empty($B3_101_UJ)){$B3_101_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_101_TK)){$B3_101_TK = '<i>Klik2Edit</i>'; }if (empty($B3_101_KJ)){$B3_101_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[101].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[101].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_101_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_101_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_101_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_101_KJ.'</span></td></tr>';
$B3_101_CK = '';$B3_101_UJ = '';$B3_101_TK = '';$B3_101_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP102
$CK='B3_102_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_102_CK  = $row['new_value'];	}
$UJ='B3_102_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_102_UJ  = $row['new_value'];	}
$TK='B3_102_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_102_TK  = $row['new_value'];	}
$KJ='B3_102_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_102_KJ  = $row['new_value'];	}

if (empty($B3_102_CK)){$B3_102_CK = '<i>Klik2Edit</i>'; }if (empty($B3_102_UJ)){$B3_102_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_102_TK)){$B3_102_TK = '<i>Klik2Edit</i>'; }if (empty($B3_102_KJ)){$B3_102_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[102].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[102].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_102_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_102_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_102_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_102_KJ.'</span></td></tr>';
$B3_102_CK = '';$B3_102_UJ = '';$B3_102_TK = '';$B3_102_KJ = '';
//STANDARD BOTDOWN

///200
//STANDARD TOPUP200
$CK='B3_200_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_200_CK  = $row['new_value'];	}
$UJ='B3_200_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_200_UJ  = $row['new_value'];	}
$TK='B3_200_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_200_TK  = $row['new_value'];	}
$KJ='B3_200_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_200_KJ  = $row['new_value'];	}

if (empty($B3_200_CK)){$B3_200_CK = '<i>Klik2Edit</i>'; }if (empty($B3_200_UJ)){$B3_200_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_200_TK)){$B3_200_TK = '<i>Klik2Edit</i>'; }if (empty($B3_200_KJ)){$B3_200_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[200].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[200].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_200_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_200_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_200_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_200_KJ.'</span></td></tr>';
$B3_200_CK = '';$B3_200_UJ = '';$B3_200_TK = '';$B3_200_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP201
$CK='B3_201_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_201_CK  = $row['new_value'];	}
$UJ='B3_201_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_201_UJ  = $row['new_value'];	}
$TK='B3_201_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_201_TK  = $row['new_value'];	}
$KJ='B3_201_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_201_KJ  = $row['new_value'];	}

if (empty($B3_201_CK)){$B3_201_CK = '<i>Klik2Edit</i>'; }if (empty($B3_201_UJ)){$B3_201_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_201_TK)){$B3_201_TK = '<i>Klik2Edit</i>'; }if (empty($B3_201_KJ)){$B3_201_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[201].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[201].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_201_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_201_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_201_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_201_KJ.'</span></td></tr>';
$B3_201_CK = '';$B3_201_UJ = '';$B3_201_TK = '';$B3_201_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP202
$CK='B3_202_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_202_CK  = $row['new_value'];	}
$UJ='B3_202_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_202_UJ  = $row['new_value'];	}
$TK='B3_202_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_202_TK  = $row['new_value'];	}
$KJ='B3_202_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_202_KJ  = $row['new_value'];	}

if (empty($B3_202_CK)){$B3_202_CK = '<i>Klik2Edit</i>'; }if (empty($B3_202_UJ)){$B3_202_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_202_TK)){$B3_202_TK = '<i>Klik2Edit</i>'; }if (empty($B3_202_KJ)){$B3_202_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[202].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[202].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_202_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_202_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_202_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_202_KJ.'</span></td></tr>';
$B3_202_CK = '';$B3_202_UJ = '';$B3_202_TK = '';$B3_202_KJ = '';
//STANDARD BOTDOWN

//300
//STANDARD TOPUP300
$CK='B3_300_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_300_CK  = $row['new_value'];	}
$UJ='B3_300_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_300_UJ  = $row['new_value'];	}
$TK='B3_300_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_300_TK  = $row['new_value'];	}
$KJ='B3_300_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_300_KJ  = $row['new_value'];	}

if (empty($B3_300_CK)){$B3_300_CK = '<i>Klik2Edit</i>'; }if (empty($B3_300_UJ)){$B3_300_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_300_TK)){$B3_300_TK = '<i>Klik2Edit</i>'; }if (empty($B3_300_KJ)){$B3_300_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[300].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[300].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_300_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_300_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_300_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_300_KJ.'</span></td></tr>';
$B3_300_CK = '';$B3_300_UJ = '';$B3_300_TK = '';$B3_300_KJ = '';
//STANDARD BOTDOWN

//400
//STANDARD TOPUP400
$CK='B3_400_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_400_CK  = $row['new_value'];	}
$UJ='B3_400_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_400_UJ  = $row['new_value'];	}
$TK='B3_400_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_400_TK  = $row['new_value'];	}
$KJ='B3_400_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_400_KJ  = $row['new_value'];	}

if (empty($B3_400_CK)){$B3_400_CK = '<i>Klik2Edit</i>'; }if (empty($B3_400_UJ)){$B3_400_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_400_TK)){$B3_400_TK = '<i>Klik2Edit</i>'; }if (empty($B3_400_KJ)){$B3_400_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[400].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[400].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_400_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_400_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_400_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_400_KJ.'</span></td></tr>';
$B3_400_CK = '';$B3_400_UJ = '';$B3_400_TK = '';$B3_400_KJ = '';
//STANDARD BOTDOWN

//500
//STANDARD TOPUP500
$CK='B3_500_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_500_CK  = $row['new_value'];	}
$UJ='B3_500_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_500_UJ  = $row['new_value'];	}
$TK='B3_500_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_500_TK  = $row['new_value'];	}
$KJ='B3_500_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_500_KJ  = $row['new_value'];	}

if (empty($B3_500_CK)){$B3_500_CK = '<i>Klik2Edit</i>'; }if (empty($B3_500_UJ)){$B3_500_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_500_TK)){$B3_500_TK = '<i>Klik2Edit</i>'; }if (empty($B3_500_KJ)){$B3_500_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[500].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[500].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_500_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_500_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_500_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_500_KJ.'</span></td></tr>';
$B3_500_CK = '';$B3_500_UJ = '';$B3_500_TK = '';$B3_500_KJ = '';
//STANDARD BOTDOWN

//600
//STANDARD TOPUP600
$CK='B3_600_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_600_CK  = $row['new_value'];	}
$UJ='B3_600_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_600_UJ  = $row['new_value'];	}
$TK='B3_600_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_600_TK  = $row['new_value'];	}
$KJ='B3_600_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_600_KJ  = $row['new_value'];	}

if (empty($B3_600_CK)){$B3_600_CK = '<i>Klik2Edit</i>'; }if (empty($B3_600_UJ)){$B3_600_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_600_TK)){$B3_600_TK = '<i>Klik2Edit</i>'; }if (empty($B3_600_KJ)){$B3_600_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[600].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[600].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_600_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_600_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_600_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_600_KJ.'</span></td></tr>';
$B3_600_CK = '';$B3_600_UJ = '';$B3_600_TK = '';$B3_600_KJ = '';
//STANDARD BOTDOWN

//601
//STANDARD TOPUP601
$CK='B3_601_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_601_CK  = $row['new_value'];	}
$UJ='B3_601_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_601_UJ  = $row['new_value'];	}
$TK='B3_601_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_601_TK  = $row['new_value'];	}
$KJ='B3_601_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_601_KJ  = $row['new_value'];	}

if (empty($B3_601_CK)){$B3_601_CK = '<i>Klik2Edit</i>'; }if (empty($B3_601_UJ)){$B3_601_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_601_TK)){$B3_601_TK = '<i>Klik2Edit</i>'; }if (empty($B3_601_KJ)){$B3_601_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[601].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[601].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_601_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_601_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_601_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_601_KJ.'</span></td></tr>';
$B3_601_CK = '';$B3_601_UJ = '';$B3_601_TK = '';$B3_601_KJ = '';
//STANDARD BOTDOWN

//602
//STANDARD TOPUP602
$CK='B3_602_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_602_CK  = $row['new_value'];	}
$UJ='B3_602_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_602_UJ  = $row['new_value'];	}
$TK='B3_602_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_602_TK  = $row['new_value'];	}
$KJ='B3_602_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_602_KJ  = $row['new_value'];	}

if (empty($B3_602_CK)){$B3_602_CK = '<i>Klik2Edit</i>'; }if (empty($B3_602_UJ)){$B3_602_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_602_TK)){$B3_602_TK = '<i>Klik2Edit</i>'; }if (empty($B3_602_KJ)){$B3_602_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[602].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[602].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_602_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_602_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_602_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_602_KJ.'</span></td></tr>';
$B3_602_CK = '';$B3_602_UJ = '';$B3_602_TK = '';$B3_602_KJ = '';
//STANDARD BOTDOWN

//700
//STANDARD TOPUP700
$CK='B3_700_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_700_CK  = $row['new_value'];	}
$UJ='B3_700_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_700_UJ  = $row['new_value'];	}
$TK='B3_700_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_700_TK  = $row['new_value'];	}
$KJ='B3_700_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_700_KJ  = $row['new_value'];	}

if (empty($B3_700_CK)){$B3_700_CK = '<i>Klik2Edit</i>'; }if (empty($B3_700_UJ)){$B3_700_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_700_TK)){$B3_700_TK = '<i>Klik2Edit</i>'; }if (empty($B3_700_KJ)){$B3_700_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[700].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[700].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_700_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_700_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_700_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_700_KJ.'</span></td></tr>';
$B3_700_CK = '';$B3_700_UJ = '';$B3_700_TK = '';$B3_700_KJ = '';
//STANDARD BOTDOWN

//701
//STANDARD TOPUP701
$CK='B3_701_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_701_CK  = $row['new_value'];	}
$UJ='B3_701_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_701_UJ  = $row['new_value'];	}
$TK='B3_701_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_701_TK  = $row['new_value'];	}
$KJ='B3_701_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_701_KJ  = $row['new_value'];	}

if (empty($B3_701_CK)){$B3_701_CK = '<i>Klik2Edit</i>'; }if (empty($B3_701_UJ)){$B3_701_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_701_TK)){$B3_701_TK = '<i>Klik2Edit</i>'; }if (empty($B3_701_KJ)){$B3_701_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[701].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[701].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_701_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_701_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_701_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_701_KJ.'</span></td></tr>';
$B3_701_CK = '';$B3_701_UJ = '';$B3_701_TK = '';$B3_701_KJ = '';
//STANDARD BOTDOWN

//702
//STANDARD TOPUP702
$CK='B3_702_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_702_CK  = $row['new_value'];	}
$UJ='B3_702_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_702_UJ  = $row['new_value'];	}
$TK='B3_702_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_702_TK  = $row['new_value'];	}
$KJ='B3_702_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_702_KJ  = $row['new_value'];	}

if (empty($B3_702_CK)){$B3_702_CK = '<i>Klik2Edit</i>'; }if (empty($B3_702_UJ)){$B3_702_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_702_TK)){$B3_702_TK = '<i>Klik2Edit</i>'; }if (empty($B3_702_KJ)){$B3_702_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[702].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[702].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_702_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_702_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_702_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_702_KJ.'</span></td></tr>';
$B3_702_CK = '';$B3_702_UJ = '';$B3_702_TK = '';$B3_702_KJ = '';
//STANDARD BOTDOWN

//703
//STANDARD TOPUP703
$CK='B3_703_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_703_CK  = $row['new_value'];	}
$UJ='B3_703_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_703_UJ  = $row['new_value'];	}
$TK='B3_703_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_703_TK  = $row['new_value'];	}
$KJ='B3_703_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_703_KJ  = $row['new_value'];	}

if (empty($B3_703_CK)){$B3_703_CK = '<i>Klik2Edit</i>'; }if (empty($B3_703_UJ)){$B3_703_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_703_TK)){$B3_703_TK = '<i>Klik2Edit</i>'; }if (empty($B3_703_KJ)){$B3_703_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[703].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[703].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_703_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_703_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_703_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_703_KJ.'</span></td></tr>';
$B3_703_CK = '';$B3_703_UJ = '';$B3_703_TK = '';$B3_703_KJ = '';
//STANDARD BOTDOWN

//704
//STANDARD TOPUP704
$CK='B3_704_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_704_CK  = $row['new_value'];	}
$UJ='B3_704_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_704_UJ  = $row['new_value'];	}
$TK='B3_704_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_704_TK  = $row['new_value'];	}
$KJ='B3_704_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_704_KJ  = $row['new_value'];	}

if (empty($B3_704_CK)){$B3_704_CK = '<i>Klik2Edit</i>'; }if (empty($B3_704_UJ)){$B3_704_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_704_TK)){$B3_704_TK = '<i>Klik2Edit</i>'; }if (empty($B3_704_KJ)){$B3_704_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[704].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[704].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_704_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_704_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_704_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_704_KJ.'</span></td></tr>';
$B3_704_CK = '';$B3_704_UJ = '';$B3_704_TK = '';$B3_704_KJ = '';
//STANDARD BOTDOWN

//705
//STANDARD TOPUP705
$CK='B3_705_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_705_CK  = $row['new_value'];	}
$UJ='B3_705_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_705_UJ  = $row['new_value'];	}
$TK='B3_705_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_705_TK  = $row['new_value'];	}
$KJ='B3_705_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_705_KJ  = $row['new_value'];	}

if (empty($B3_705_CK)){$B3_705_CK = '<i>Klik2Edit</i>'; }if (empty($B3_705_UJ)){$B3_705_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_705_TK)){$B3_705_TK = '<i>Klik2Edit</i>'; }if (empty($B3_705_KJ)){$B3_705_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[705].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[705].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_705_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_705_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_705_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_705_KJ.'</span></td></tr>';
$B3_705_CK = '';$B3_705_UJ = '';$B3_705_TK = '';$B3_705_KJ = '';
//STANDARD BOTDOWN

//706
//STANDARD TOPUP706
$CK='B3_706_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_706_CK  = $row['new_value'];	}
$UJ='B3_706_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_706_UJ  = $row['new_value'];	}
$TK='B3_706_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_706_TK  = $row['new_value'];	}
$KJ='B3_706_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_706_KJ  = $row['new_value'];	}

if (empty($B3_706_CK)){$B3_706_CK = '<i>Klik2Edit</i>'; }if (empty($B3_706_UJ)){$B3_706_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_706_TK)){$B3_706_TK = '<i>Klik2Edit</i>'; }if (empty($B3_706_KJ)){$B3_706_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[706].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[706].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_706_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_706_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_706_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_706_KJ.'</span></td></tr>';
$B3_706_CK = '';$B3_706_UJ = '';$B3_706_TK = '';$B3_706_KJ = '';
//STANDARD BOTDOWN

//707
//STANDARD TOPUP707
$CK='B3_707_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_707_CK  = $row['new_value'];	}
$UJ='B3_707_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_707_UJ  = $row['new_value'];	}
$TK='B3_707_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_707_TK  = $row['new_value'];	}
$KJ='B3_707_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_707_KJ  = $row['new_value'];	}

if (empty($B3_707_CK)){$B3_707_CK = '<i>Klik2Edit</i>'; }if (empty($B3_707_UJ)){$B3_707_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_707_TK)){$B3_707_TK = '<i>Klik2Edit</i>'; }if (empty($B3_707_KJ)){$B3_707_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[707].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[707].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_707_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_707_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_707_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_707_KJ.'</span></td></tr>';
$B3_707_CK = '';$B3_707_UJ = '';$B3_707_TK = '';$B3_707_KJ = '';
//STANDARD BOTDOWN

//708
//STANDARD TOPUP708
$CK='B3_708_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_708_CK  = $row['new_value'];	}
$UJ='B3_708_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_708_UJ  = $row['new_value'];	}
$TK='B3_708_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_708_TK  = $row['new_value'];	}
$KJ='B3_708_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_708_KJ  = $row['new_value'];	}

if (empty($B3_708_CK)){$B3_708_CK = '<i>Klik2Edit</i>'; }if (empty($B3_708_UJ)){$B3_708_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_708_TK)){$B3_708_TK = '<i>Klik2Edit</i>'; }if (empty($B3_708_KJ)){$B3_708_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[708].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[708].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_708_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_708_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_708_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_708_KJ.'</span></td></tr>';
$B3_708_CK = '';$B3_708_UJ = '';$B3_708_TK = '';$B3_708_KJ = '';
//STANDARD BOTDOWN

//709
//STANDARD TOPUP709
$CK='B3_709_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_709_CK  = $row['new_value'];	}
$UJ='B3_709_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_709_UJ  = $row['new_value'];	}
$TK='B3_709_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_709_TK  = $row['new_value'];	}
$KJ='B3_709_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_709_KJ  = $row['new_value'];	}

if (empty($B3_709_CK)){$B3_709_CK = '<i>Klik2Edit</i>'; }if (empty($B3_709_UJ)){$B3_709_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_709_TK)){$B3_709_TK = '<i>Klik2Edit</i>'; }if (empty($B3_709_KJ)){$B3_709_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[709].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[709].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_709_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_709_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_709_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_709_KJ.'</span></td></tr>';
$B3_709_CK = '';$B3_709_UJ = '';$B3_709_TK = '';$B3_709_KJ = '';
//STANDARD BOTDOWN

//800
//STANDARD TOPUP800
$CK='B3_800_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_800_CK  = $row['new_value'];	}
$UJ='B3_800_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_800_UJ  = $row['new_value'];	}
$TK='B3_800_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_800_TK  = $row['new_value'];	}
$KJ='B3_800_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_800_KJ  = $row['new_value'];	}

if (empty($B3_800_CK)){$B3_800_CK = '<i>Klik2Edit</i>'; }if (empty($B3_800_UJ)){$B3_800_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_800_TK)){$B3_800_TK = '<i>Klik2Edit</i>'; }if (empty($B3_800_KJ)){$B3_800_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[800].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[800].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_800_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_800_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_800_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_800_KJ.'</span></td></tr>';
$B3_800_CK = '';$B3_800_UJ = '';$B3_800_TK = '';$B3_800_KJ = '';
//STANDARD BOTDOWN

//801
//STANDARD TOPUP801
$CK='B3_801_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_801_CK  = $row['new_value'];	}
$UJ='B3_801_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_801_UJ  = $row['new_value'];	}
$TK='B3_801_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_801_TK  = $row['new_value'];	}
$KJ='B3_801_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_801_KJ  = $row['new_value'];	}

if (empty($B3_801_CK)){$B3_801_CK = '<i>Klik2Edit</i>'; }if (empty($B3_801_UJ)){$B3_801_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_801_TK)){$B3_801_TK = '<i>Klik2Edit</i>'; }if (empty($B3_801_KJ)){$B3_801_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[801].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[801].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_801_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_801_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_801_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_801_KJ.'</span></td></tr>';
$B3_801_CK = '';$B3_801_UJ = '';$B3_801_TK = '';$B3_801_KJ = '';
//STANDARD BOTDOWN

//802
//STANDARD TOPUP802
$CK='B3_802_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_802_CK  = $row['new_value'];	}
$UJ='B3_802_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_802_UJ  = $row['new_value'];	}
$TK='B3_802_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_802_TK  = $row['new_value'];	}
$KJ='B3_802_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_802_KJ  = $row['new_value'];	}

if (empty($B3_802_CK)){$B3_802_CK = '<i>Klik2Edit</i>'; }if (empty($B3_802_UJ)){$B3_802_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_802_TK)){$B3_802_TK = '<i>Klik2Edit</i>'; }if (empty($B3_802_KJ)){$B3_802_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[802].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[802].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_802_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_802_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_802_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_802_KJ.'</span></td></tr>';
$B3_802_CK = '';$B3_802_UJ = '';$B3_802_TK = '';$B3_802_KJ = '';
//STANDARD BOTDOWN

//900
//STANDARD TOPUP900
$CK='B3_900_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_900_CK  = $row['new_value'];	}
$UJ='B3_900_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_900_UJ  = $row['new_value'];	}
$TK='B3_900_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_900_TK  = $row['new_value'];	}
$KJ='B3_900_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_900_KJ  = $row['new_value'];	}

if (empty($B3_900_CK)){$B3_900_CK = '<i>Klik2Edit</i>'; }if (empty($B3_900_UJ)){$B3_900_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_900_TK)){$B3_900_TK = '<i>Klik2Edit</i>'; }if (empty($B3_900_KJ)){$B3_900_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[900].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[900].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_900_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_900_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_900_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_900_KJ.'</span></td></tr>';
$B3_900_CK = '';$B3_900_UJ = '';$B3_900_TK = '';$B3_900_KJ = '';
//STANDARD BOTDOWN

//901
//STANDARD TOPUP901
$CK='B3_901_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_901_CK  = $row['new_value'];	}
$UJ='B3_901_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_901_UJ  = $row['new_value'];	}
$TK='B3_901_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_901_TK  = $row['new_value'];	}
$KJ='B3_901_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_901_KJ  = $row['new_value'];	}

if (empty($B3_901_CK)){$B3_901_CK = '<i>Klik2Edit</i>'; }if (empty($B3_901_UJ)){$B3_901_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_901_TK)){$B3_901_TK = '<i>Klik2Edit</i>'; }if (empty($B3_901_KJ)){$B3_901_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[901].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[901].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_901_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_901_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_901_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_901_KJ.'</span></td></tr>';
$B3_901_CK = '';$B3_901_UJ = '';$B3_901_TK = '';$B3_901_KJ = '';
//STANDARD BOTDOWN

//1000
//STANDARD TOPUP1000
$CK='B3_1000_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1000_CK  = $row['new_value'];	}
$UJ='B3_1000_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1000_UJ  = $row['new_value'];	}
$TK='B3_1000_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1000_TK  = $row['new_value'];	}
$KJ='B3_1000_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1000_KJ  = $row['new_value'];	}

if (empty($B3_1000_CK)){$B3_1000_CK = '<i>Klik2Edit</i>'; }if (empty($B3_1000_UJ)){$B3_1000_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_1000_TK)){$B3_1000_TK = '<i>Klik2Edit</i>'; }if (empty($B3_1000_KJ)){$B3_1000_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[1000].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[1000].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_1000_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_1000_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_1000_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_1000_KJ.'</span></td></tr>';
$B3_1000_CK = '';$B3_1000_UJ = '';$B3_1000_TK = '';$B3_1000_KJ = '';
//STANDARD BOTDOWN

//1100
//STANDARD TOPUP1100
$CK='B3_1100_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1100_CK  = $row['new_value'];	}
$UJ='B3_1100_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1100_UJ  = $row['new_value'];	}
$TK='B3_1100_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1100_TK  = $row['new_value'];	}
$KJ='B3_1100_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1100_KJ  = $row['new_value'];	}

if (empty($B3_1100_CK)){$B3_1100_CK = '<i>Klik2Edit</i>'; }if (empty($B3_1100_UJ)){$B3_1100_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_1100_TK)){$B3_1100_TK = '<i>Klik2Edit</i>'; }if (empty($B3_1100_KJ)){$B3_1100_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[1100].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[1100].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_1100_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_1100_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_1100_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_1100_KJ.'</span></td></tr>';
$B3_1100_CK = '';$B3_1100_UJ = '';$B3_1100_TK = '';$B3_1100_KJ = '';
//STANDARD BOTDOWN

//1101
//STANDARD TOPUP1101
$CK='B3_1101_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1101_CK  = $row['new_value'];	}
$UJ='B3_1101_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1101_UJ  = $row['new_value'];	}
$TK='B3_1101_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1101_TK  = $row['new_value'];	}
$KJ='B3_1101_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1101_KJ  = $row['new_value'];	}

if (empty($B3_1101_CK)){$B3_1101_CK = '<i>Klik2Edit</i>'; }if (empty($B3_1101_UJ)){$B3_1101_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_1101_TK)){$B3_1101_TK = '<i>Klik2Edit</i>'; }if (empty($B3_1101_KJ)){$B3_1101_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[1101].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[1101].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_1101_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_1101_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_1101_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_1101_KJ.'</span></td></tr>';
$B3_1101_CK = '';$B3_1101_UJ = '';$B3_1101_TK = '';$B3_1101_KJ = '';
//STANDARD BOTDOWN

//1200
//STANDARD TOPUP1200
$CK='B3_1200_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1200_CK  = $row['new_value'];	}
$UJ='B3_1200_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1200_UJ  = $row['new_value'];	}
$TK='B3_1200_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1200_TK  = $row['new_value'];	}
$KJ='B3_1200_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1200_KJ  = $row['new_value'];	}

if (empty($B3_1200_CK)){$B3_1200_CK = '<i>Klik2Edit</i>'; }if (empty($B3_1200_UJ)){$B3_1200_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_1200_TK)){$B3_1200_TK = '<i>Klik2Edit</i>'; }if (empty($B3_1200_KJ)){$B3_1200_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[1200].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[1200].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_1200_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_1200_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_1200_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_1200_KJ.'</span></td></tr>';
$B3_1200_CK = '';$B3_1200_UJ = '';$B3_1200_TK = '';$B3_1200_KJ = '';
//STANDARD BOTDOWN

//1300
//STANDARD TOPUP1300
$CK='B3_1300_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1300_CK  = $row['new_value'];	}
$UJ='B3_1300_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1300_UJ  = $row['new_value'];	}
$TK='B3_1300_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1300_TK  = $row['new_value'];	}
$KJ='B3_1300_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1300_KJ  = $row['new_value'];	}

if (empty($B3_1300_CK)){$B3_1300_CK = '<i>Klik2Edit</i>'; }if (empty($B3_1300_UJ)){$B3_1300_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_1300_TK)){$B3_1300_TK = '<i>Klik2Edit</i>'; }if (empty($B3_1300_KJ)){$B3_1300_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[1300].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[1300].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_1300_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_1300_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_1300_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_1300_KJ.'</span></td></tr>';
$B3_1300_CK = '';$B3_1300_UJ = '';$B3_1300_TK = '';$B3_1300_KJ = '';
//STANDARD BOTDOWN

//1400
//STANDARD TOPUP1400
$CK='B3_1400_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1400_CK  = $row['new_value'];	}
$UJ='B3_1400_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1400_UJ  = $row['new_value'];	}
$TK='B3_1400_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1400_TK  = $row['new_value'];	}
$KJ='B3_1400_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1400_KJ  = $row['new_value'];	}

if (empty($B3_1400_CK)){$B3_1400_CK = '<i>Klik2Edit</i>'; }if (empty($B3_1400_UJ)){$B3_1400_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_1400_TK)){$B3_1400_TK = '<i>Klik2Edit</i>'; }if (empty($B3_1400_KJ)){$B3_1400_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[1400].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[1400].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_1400_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_1400_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_1400_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_1400_KJ.'</span></td></tr>';
$B3_1400_CK = '';$B3_1400_UJ = '';$B3_1400_TK = '';$B3_1400_KJ = '';
//STANDARD BOTDOWN

//1500
//STANDARD TOPUP1500
$CK='B3_1500_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1500_CK  = $row['new_value'];	}
$UJ='B3_1500_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1500_UJ  = $row['new_value'];	}
$TK='B3_1500_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1500_TK  = $row['new_value'];	}
$KJ='B3_1500_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1500_KJ  = $row['new_value'];	}

if (empty($B3_1500_CK)){$B3_1500_CK = '<i>Klik2Edit</i>'; }if (empty($B3_1500_UJ)){$B3_1500_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_1500_TK)){$B3_1500_TK = '<i>Klik2Edit</i>'; }if (empty($B3_1500_KJ)){$B3_1500_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[1500].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[1500].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_1500_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_1500_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_1500_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_1500_KJ.'</span></td></tr>';
$B3_1500_CK = '';$B3_1500_UJ = '';$B3_1500_TK = '';$B3_1500_KJ = '';
//STANDARD BOTDOWN

//1501
//STANDARD TOPUP1501
$CK='B3_1501_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1501_CK  = $row['new_value'];	}
$UJ='B3_1501_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1501_UJ  = $row['new_value'];	}
$TK='B3_1501_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1501_TK  = $row['new_value'];	}
$KJ='B3_1501_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1501_KJ  = $row['new_value'];	}

if (empty($B3_1501_CK)){$B3_1501_CK = '<i>Klik2Edit</i>'; }if (empty($B3_1501_UJ)){$B3_1501_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_1501_TK)){$B3_1501_TK = '<i>Klik2Edit</i>'; }if (empty($B3_1501_KJ)){$B3_1501_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[1501].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[1501].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_1501_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_1501_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_1501_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_1501_KJ.'</span></td></tr>';
$B3_1501_CK = '';$B3_1501_UJ = '';$B3_1501_TK = '';$B3_1501_KJ = '';
//STANDARD BOTDOWN

//1502
//STANDARD TOPUP1502
$CK='B3_1502_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1502_CK  = $row['new_value'];	}
$UJ='B3_1502_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1502_UJ  = $row['new_value'];	}
$TK='B3_1502_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1502_TK  = $row['new_value'];	}
$KJ='B3_1502_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1502_KJ  = $row['new_value'];	}

if (empty($B3_1502_CK)){$B3_1502_CK = '<i>Klik2Edit</i>'; }if (empty($B3_1502_UJ)){$B3_1502_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_1502_TK)){$B3_1502_TK = '<i>Klik2Edit</i>'; }if (empty($B3_1502_KJ)){$B3_1502_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[1502].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[1502].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_1502_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_1502_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_1502_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_1502_KJ.'</span></td></tr>';
$B3_1502_CK = '';$B3_1502_UJ = '';$B3_1502_TK = '';$B3_1502_KJ = '';
//STANDARD BOTDOWN

//1600
//STANDARD TOPUP1600
$CK='B3_1600_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1600_CK  = $row['new_value'];	}
$UJ='B3_1600_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1600_UJ  = $row['new_value'];	}
$TK='B3_1600_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1600_TK  = $row['new_value'];	}
$KJ='B3_1600_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1600_KJ  = $row['new_value'];	}

if (empty($B3_1600_CK)){$B3_1600_CK = '<i>Klik2Edit</i>'; }if (empty($B3_1600_UJ)){$B3_1600_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_1600_TK)){$B3_1600_TK = '<i>Klik2Edit</i>'; }if (empty($B3_1600_KJ)){$B3_1600_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[1600].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[1600].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_1600_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_1600_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_1600_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_1600_KJ.'</span></td></tr>';
$B3_1600_CK = '';$B3_1600_UJ = '';$B3_1600_TK = '';$B3_1600_KJ = '';
//STANDARD BOTDOWN

//1700
//STANDARD TOPUP1700
$CK='B3_1700_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1700_CK  = $row['new_value'];	}
$UJ='B3_1700_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1700_UJ  = $row['new_value'];	}
$TK='B3_1700_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1700_TK  = $row['new_value'];	}
$KJ='B3_1700_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1700_KJ  = $row['new_value'];	}

if (empty($B3_1700_CK)){$B3_1700_CK = '<i>Klik2Edit</i>'; }if (empty($B3_1700_UJ)){$B3_1700_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_1700_TK)){$B3_1700_TK = '<i>Klik2Edit</i>'; }if (empty($B3_1700_KJ)){$B3_1700_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[1700].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[1700].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_1700_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_1700_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_1700_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_1700_KJ.'</span></td></tr>';
$B3_1700_CK = '';$B3_1700_UJ = '';$B3_1700_TK = '';$B3_1700_KJ = '';
//STANDARD BOTDOWN

//1701
//STANDARD TOPUP1701
$CK='B3_1701_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1701_CK  = $row['new_value'];	}
$UJ='B3_1701_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1701_UJ  = $row['new_value'];	}
$TK='B3_1701_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1701_TK  = $row['new_value'];	}
$KJ='B3_1701_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B3_1701_KJ  = $row['new_value'];	}

if (empty($B3_1701_CK)){$B3_1701_CK = '<i>Klik2Edit</i>'; }if (empty($B3_1701_UJ)){$B3_1701_UJ = '<i>Klik2Edit</i>'; }if (empty($B3_1701_TK)){$B3_1701_TK = '<i>Klik2Edit</i>'; }if (empty($B3_1701_KJ)){$B3_1701_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB3[1701].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B3[1701].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B3_1701_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B3_1701_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B3_1701_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B3_1701_KJ.'</span></td></tr>';
$B3_1701_CK = '';$B3_1701_UJ = '';$B3_1701_TK = '';$B3_1701_KJ = '';
//STANDARD BOTDOWN


////////////////////////////////////////////////////////////
echo '</table> <BR>';

?>

<script type="text/javascript">
	
<?php
$setID = '$("#A_0_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });';

$setID .= '$("#B3_0_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });';

$setID .= '$("#B3_100_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_100_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_100_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_100_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B3_101_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B3_101_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_101_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_101_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B3_102_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B3_102_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_102_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_102_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

///200

$setID .= '$("#B3_200_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B3_200_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_200_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_200_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B3_201_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B3_201_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_201_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_201_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B3_202_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B3_202_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_202_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_202_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';


$setID .= '$("#B3_300_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_300_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_300_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_300_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B3_400_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_400_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_400_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_400_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B3_500_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_500_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_500_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_500_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
//600
$setID .= '$("#B3_600_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B3_600_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_600_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_600_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
$setID .= '$("#B3_601_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B3_601_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_601_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_601_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
$setID .= '$("#B3_602_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B3_602_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_602_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_602_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
//700
$setID .= '$("#B3_700_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_700_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_700_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_700_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B3_701_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B3_701_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_701_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_701_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B3_702_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B3_702_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_702_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_702_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B3_703_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B3_703_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_703_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_703_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B3_704_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B3_704_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_704_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_704_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B3_705_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B3_705_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_705_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_705_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B3_706_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B3_706_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_706_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_706_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B3_707_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B3_707_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_707_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_707_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B3_708_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B3_708_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_708_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_708_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B3_709_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B3_709_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_709_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_709_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
//800
$setID .= '$("#B3_800_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_800_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_800_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_800_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
$setID .= '$("#B3_801_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B3_801_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_801_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_801_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
$setID .= '$("#B3_802_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B3_802_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_802_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_802_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
//900
$setID .= '$("#B3_900_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_900_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_900_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_900_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
$setID .= '$("#B3_901_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B3_901_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_901_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_901_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
//1000
$setID .= '$("#B3_1000_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_1000_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_1000_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_1000_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B3_1100_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_1100_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_1100_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_1100_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B3_1101_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_1101_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_1101_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_1101_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B3_1200_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_1200_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_1200_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_1200_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B3_1300_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_1300_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_1300_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_1300_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B3_1400_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_1400_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_1400_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_1400_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
//1500
$setID .= '$("#B3_1500_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_1500_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_1500_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_1500_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
$setID .= '$("#B3_1501_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B3_1501_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_1501_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_1501_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
$setID .= '$("#B3_1502_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B3_1502_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_1502_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_1502_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
//1600
$setID .= '$("#B3_1600_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_1600_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_1600_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_1600_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
//1700
$setID .= '$("#B3_1700_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_1700_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_1700_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_1700_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
$setID .= '$("#B3_1701_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B3_1701_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_1701_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B3_1701_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

echo $setID;

	?>

</script>


</body>
</html>
<?php // Flush the buffered output to the Web browser.
ob_flush();
?>
