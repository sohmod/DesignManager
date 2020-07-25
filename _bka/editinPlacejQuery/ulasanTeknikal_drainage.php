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
	<title>eggBlog - ut_drainage</title>
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
<font color="gray">EIP - Ulasan Teknikal '.$objektif.' Kerja Sivil : </font><font color="red">Drainage</font><font color="green">&nbsp;&nbsp;Job no:>'.$chk_id.'</font><br/>

<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/ulasanTeknikal_general.php"><font color="green" size="2em" style="text-decoration:none">general</font></a>
<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/ulasanTeknikal_earthwork.php"><font color="green" size="2em" style="text-decoration:none">earthwork</font></a>
<!--a href="http://'.$ipthis.'/_bka/editinPlacejQuery/ulasanTeknikal_drainage.php"><font color="green" size="2em" style="text-decoration:none"-->drainage<!--/font></a-->
<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/ulasanTeknikal_roadwork.php"><font color="green" size="2em" style="text-decoration:none">roadwork</font></a>
<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/ulasanTeknikal_watersupply.php"><font color="green" size="2em" style="text-decoration:none">watersupply</font></a>
<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/ulasanTeknikal_sewerage.php"><font color="green" size="2em" style="text-decoration:none">sewerage</font></a>';

echo $localLink . $header;

$chk='B2_0_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$chk'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_0_CK  = $row['new_value'];	} if (empty($B2_0_CK)){$B2_0_CK = '<i>Klik2Edit</i>'; }
echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>'.$itemB2[0].'</b></td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">.</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px"><b>'.$B2[0].'</b></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$chk.'">'.$B2_0_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span>.</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span>.</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span>.</span></td></tr>';
$B2_0_CK = '';

//STANDARD TOPUP100
$CK='B2_100_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_100_CK  = $row['new_value'];	}
$UJ='B2_100_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_100_UJ  = $row['new_value'];	}
$TK='B2_100_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_100_TK  = $row['new_value'];	}
$KJ='B2_100_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_100_KJ  = $row['new_value'];	}

if (empty($B2_100_CK)){$B2_100_CK = '<i>Klik2Edit<</i>'; }if (empty($B2_100_UJ)){$B2_100_UJ = '<i>Klik2Edit</i>'; }if (empty($B2_100_TK)){$B2_100_TK = '<i>Klik2Edit</i>'; }if (empty($B2_100_KJ)){$B2_100_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB2[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB2[100].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B2[100].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B2_100_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B2_100_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B2_100_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B2_100_KJ.'</span></td></tr>';
$B2_100_CK = '';$B2_100_UJ = '';$B2_100_TK = '';$B2_100_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP101
$CK='B2_101_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_101_CK  = $row['new_value'];	}
$UJ='B2_101_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_101_UJ  = $row['new_value'];	}
$TK='B2_101_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_101_TK  = $row['new_value'];	}
$KJ='B2_101_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_101_KJ  = $row['new_value'];	}

if (empty($B2_101_CK)){$B2_101_CK = '<i>Klik2Edit</i>'; }if (empty($B2_101_UJ)){$B2_101_UJ = '<i>Klik2Edit</i>'; }if (empty($B2_101_TK)){$B2_101_TK = '<i>Klik2Edit</i>'; }if (empty($B2_101_KJ)){$B2_101_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB2[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB2[101].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B2[101].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B2_101_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B2_101_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B2_101_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B2_101_KJ.'</span></td></tr>';
$B2_101_CK = '';$B2_101_UJ = '';$B2_101_TK = '';$B2_101_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP102
$CK='B2_102_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_102_CK  = $row['new_value'];	}
$UJ='B2_102_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_102_UJ  = $row['new_value'];	}
$TK='B2_102_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_102_TK  = $row['new_value'];	}
$KJ='B2_102_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_102_KJ  = $row['new_value'];	}

if (empty($B2_102_CK)){$B2_102_CK = '<i>Klik2Edit</i>'; }if (empty($B2_102_UJ)){$B2_102_UJ = '<i>Klik2Edit</i>'; }if (empty($B2_102_TK)){$B2_102_TK = '<i>Klik2Edit</i>'; }if (empty($B2_102_KJ)){$B2_102_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB2[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB2[102].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B2[102].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B2_102_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B2_102_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B2_102_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B2_102_KJ.'</span></td></tr>';
$B2_102_CK = '';$B2_102_UJ = '';$B2_102_TK = '';$B2_102_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP103
$CK='B2_103_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_103_CK  = $row['new_value'];	}
$UJ='B2_103_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_103_UJ  = $row['new_value'];	}
$TK='B2_103_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_103_TK  = $row['new_value'];	}
$KJ='B2_103_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_103_KJ  = $row['new_value'];	}

if (empty($B2_103_CK)){$B2_103_CK = '<i>Klik2Edit</i>'; }if (empty($B2_103_UJ)){$B2_103_UJ = '<i>Klik2Edit</i>'; }if (empty($B2_103_TK)){$B2_103_TK = '<i>Klik2Edit</i>'; }if (empty($B2_103_KJ)){$B2_103_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB2[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB2[103].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B2[103].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B2_103_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B2_103_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B2_103_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B2_103_KJ.'</span></td></tr>';
$B2_103_CK = '';$B2_103_UJ = '';$B2_103_TK = '';$B2_103_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP104
$CK='B2_104_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_104_CK  = $row['new_value'];	}
$UJ='B2_104_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_104_UJ  = $row['new_value'];	}
$TK='B2_104_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_104_TK  = $row['new_value'];	}
$KJ='B2_104_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_104_KJ  = $row['new_value'];	}

if (empty($B2_104_CK)){$B2_104_CK = '<i>Klik2Edit</i>'; }if (empty($B2_104_UJ)){$B2_104_UJ = '<i>Klik2Edit</i>'; }if (empty($B2_104_TK)){$B2_104_TK = '<i>Klik2Edit</i>'; }if (empty($B2_104_KJ)){$B2_104_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB2[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB2[104].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B2[104].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B2_104_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B2_104_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B2_104_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B2_104_KJ.'</span></td></tr>';
$B2_104_CK = '';$B2_104_UJ = '';$B2_104_TK = '';$B2_104_KJ = '';
//STANDARD BOTDOWN
///200

//STANDARD TOPUP200
$CK='B2_200_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_200_CK  = $row['new_value'];	}
$UJ='B2_200_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_200_UJ  = $row['new_value'];	}
$TK='B2_200_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_200_TK  = $row['new_value'];	}
$KJ='B2_200_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_200_KJ  = $row['new_value'];	}

if (empty($B2_200_CK)){$B2_200_CK = '<i>Klik2Edit</i>'; }if (empty($B2_200_UJ)){$B2_200_UJ = '<i>Klik2Edit</i>'; }if (empty($B2_200_TK)){$B2_200_TK = '<i>Klik2Edit</i>'; }if (empty($B2_200_KJ)){$B2_200_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB2[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB2[200].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B2[200].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B2_200_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B2_200_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B2_200_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B2_200_KJ.'</span></td></tr>';
$B2_200_CK = '';$B2_200_UJ = '';$B2_200_TK = '';$B2_200_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP201
$CK='B2_201_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_201_CK  = $row['new_value'];	}
$UJ='B2_201_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_201_UJ  = $row['new_value'];	}
$TK='B2_201_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_201_TK  = $row['new_value'];	}
$KJ='B2_201_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_201_KJ  = $row['new_value'];	}

if (empty($B2_201_CK)){$B2_201_CK = '<i>Klik2Edit</i>'; }if (empty($B2_201_UJ)){$B2_201_UJ = '<i>Klik2Edit</i>'; }if (empty($B2_201_TK)){$B2_201_TK = '<i>Klik2Edit</i>'; }if (empty($B2_201_KJ)){$B2_201_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB2[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB2[201].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B2[201].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B2_201_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B2_201_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B2_201_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B2_201_KJ.'</span></td></tr>';
$B2_201_CK = '';$B2_201_UJ = '';$B2_201_TK = '';$B2_201_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP202
$CK='B2_202_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_202_CK  = $row['new_value'];	}
$UJ='B2_202_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_202_UJ  = $row['new_value'];	}
$TK='B2_202_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_202_TK  = $row['new_value'];	}
$KJ='B2_202_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_202_KJ  = $row['new_value'];	}

if (empty($B2_202_CK)){$B2_202_CK = '<i>Klik2Edit</i>'; }if (empty($B2_202_UJ)){$B2_202_UJ = '<i>Klik2Edit</i>'; }if (empty($B2_202_TK)){$B2_202_TK = '<i>Klik2Edit</i>'; }if (empty($B2_202_KJ)){$B2_202_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB2[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB2[202].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B2[202].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B2_202_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B2_202_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B2_202_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B2_202_KJ.'</span></td></tr>';
$B2_202_CK = '';$B2_202_UJ = '';$B2_202_TK = '';$B2_202_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP203
$CK='B2_203_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_203_CK  = $row['new_value'];	}
$UJ='B2_203_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_203_UJ  = $row['new_value'];	}
$TK='B2_203_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_203_TK  = $row['new_value'];	}
$KJ='B2_203_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_203_KJ  = $row['new_value'];	}

if (empty($B2_203_CK)){$B2_203_CK = '<i>Klik2Edit</i>'; }if (empty($B2_203_UJ)){$B2_203_UJ = '<i>Klik2Edit</i>'; }if (empty($B2_203_TK)){$B2_203_TK = '<i>Klik2Edit</i>'; }if (empty($B2_203_KJ)){$B2_203_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB2[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB2[203].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B2[203].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B2_203_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B2_203_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B2_203_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B2_203_KJ.'</span></td></tr>';
$B2_203_CK = '';$B2_203_UJ = '';$B2_203_TK = '';$B2_203_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP204
$CK='B2_204_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_204_CK  = $row['new_value'];	}
$UJ='B2_204_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_204_UJ  = $row['new_value'];	}
$TK='B2_204_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_204_TK  = $row['new_value'];	}
$KJ='B2_204_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_204_KJ  = $row['new_value'];	}

if (empty($B2_204_CK)){$B2_204_CK = '<i>Klik2Edit</i>'; }if (empty($B2_204_UJ)){$B2_204_UJ = '<i>Klik2Edit</i>'; }if (empty($B2_204_TK)){$B2_204_TK = '<i>Klik2Edit</i>'; }if (empty($B2_204_KJ)){$B2_204_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB2[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB2[204].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B2[204].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B2_204_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B2_204_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B2_204_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B2_204_KJ.'</span></td></tr>';
$B2_204_CK = '';$B2_204_UJ = '';$B2_204_TK = '';$B2_204_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP205
$CK='B2_205_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_205_CK  = $row['new_value'];	}
$UJ='B2_205_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_205_UJ  = $row['new_value'];	}
$TK='B2_205_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_205_TK  = $row['new_value'];	}
$KJ='B2_205_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_205_KJ  = $row['new_value'];	}

if (empty($B2_205_CK)){$B2_205_CK = '<i>Klik2Edit</i>'; }if (empty($B2_205_UJ)){$B2_205_UJ = '<i>Klik2Edit</i>'; }if (empty($B2_205_TK)){$B2_205_TK = '<i>Klik2Edit</i>'; }if (empty($B2_205_KJ)){$B2_205_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB2[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB2[205].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B2[205].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B2_205_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B2_205_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B2_205_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B2_205_KJ.'</span></td></tr>';
$B2_205_CK = '';$B2_205_UJ = '';$B2_205_TK = '';$B2_205_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP206
$CK='B2_206_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_206_CK  = $row['new_value'];	}
$UJ='B2_206_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_206_UJ  = $row['new_value'];	}
$TK='B2_206_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_206_TK  = $row['new_value'];	}
$KJ='B2_206_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_206_KJ  = $row['new_value'];	}

if (empty($B2_206_CK)){$B2_206_CK = '<i>Klik2Edit</i>'; }if (empty($B2_206_UJ)){$B2_206_UJ = '<i>Klik2Edit</i>'; }if (empty($B2_206_TK)){$B2_206_TK = '<i>Klik2Edit</i>'; }if (empty($B2_206_KJ)){$B2_206_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB2[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB2[206].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B2[206].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B2_206_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B2_206_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B2_206_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B2_206_KJ.'</span></td></tr>';
$B2_206_CK = '';$B2_206_UJ = '';$B2_206_TK = '';$B2_206_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP207
$CK='B2_207_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_207_CK  = $row['new_value'];	}
$UJ='B2_207_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_207_UJ  = $row['new_value'];	}
$TK='B2_207_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_207_TK  = $row['new_value'];	}
$KJ='B2_207_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_207_KJ  = $row['new_value'];	}

if (empty($B2_207_CK)){$B2_207_CK = '<i>Klik2Edit</i>'; }if (empty($B2_207_UJ)){$B2_207_UJ = '<i>Klik2Edit</i>'; }if (empty($B2_207_TK)){$B2_207_TK = '<i>Klik2Edit</i>'; }if (empty($B2_207_KJ)){$B2_207_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB2[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB2[207].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B2[207].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B2_207_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B2_207_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B2_207_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B2_207_KJ.'</span></td></tr>';
$B2_207_CK = '';$B2_207_UJ = '';$B2_207_TK = '';$B2_207_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP208
$CK='B2_208_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_208_CK  = $row['new_value'];	}
$UJ='B2_208_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_208_UJ  = $row['new_value'];	}
$TK='B2_208_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_208_TK  = $row['new_value'];	}
$KJ='B2_208_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_208_KJ  = $row['new_value'];	}

if (empty($B2_208_CK)){$B2_208_CK = '<i>Klik2Edit</i>'; }if (empty($B2_208_UJ)){$B2_208_UJ = '<i>Klik2Edit</i>'; }if (empty($B2_208_TK)){$B2_208_TK = '<i>Klik2Edit</i>'; }if (empty($B2_208_KJ)){$B2_208_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB2[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB2[208].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B2[208].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B2_208_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B2_208_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B2_208_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B2_208_KJ.'</span></td></tr>';
$B2_208_CK = '';$B2_208_UJ = '';$B2_208_TK = '';$B2_208_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP209
$CK='B2_209_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_209_CK  = $row['new_value'];	}
$UJ='B2_209_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_209_UJ  = $row['new_value'];	}
$TK='B2_209_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_209_TK  = $row['new_value'];	}
$KJ='B2_209_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_209_KJ  = $row['new_value'];	}

if (empty($B2_209_CK)){$B2_209_CK = '<i>Klik2Edit</i>'; }if (empty($B2_209_UJ)){$B2_209_UJ = '<i>Klik2Edit</i>'; }if (empty($B2_209_TK)){$B2_209_TK = '<i>Klik2Edit</i>'; }if (empty($B2_209_KJ)){$B2_209_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB2[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB2[209].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B2[209].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B2_209_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B2_209_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B2_209_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B2_209_KJ.'</span></td></tr>';
$B2_209_CK = '';$B2_209_UJ = '';$B2_209_TK = '';$B2_209_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP210
$CK='B2_210_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_210_CK  = $row['new_value'];	}
$UJ='B2_210_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_210_UJ  = $row['new_value'];	}
$TK='B2_210_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_210_TK  = $row['new_value'];	}
$KJ='B2_210_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_210_KJ  = $row['new_value'];	}

if (empty($B2_210_CK)){$B2_210_CK = '<i>Klik2Edit</i>'; }if (empty($B2_210_UJ)){$B2_210_UJ = '<i>Klik2Edit</i>'; }if (empty($B2_210_TK)){$B2_210_TK = '<i>Klik2Edit</i>'; }if (empty($B2_210_KJ)){$B2_210_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB2[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB2[210].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B2[210].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B2_210_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B2_210_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B2_210_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B2_210_KJ.'</span></td></tr>';
$B2_210_CK = '';$B2_210_UJ = '';$B2_210_TK = '';$B2_210_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP211
$CK='B2_211_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_211_CK  = $row['new_value'];	}
$UJ='B2_211_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_211_UJ  = $row['new_value'];	}
$TK='B2_211_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_211_TK  = $row['new_value'];	}
$KJ='B2_211_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_211_KJ  = $row['new_value'];	}

if (empty($B2_211_CK)){$B2_211_CK = '<i>Klik2Edit</i>'; }if (empty($B2_211_UJ)){$B2_211_UJ = '<i>Klik2Edit</i>'; }if (empty($B2_211_TK)){$B2_211_TK = '<i>Klik2Edit</i>'; }if (empty($B2_211_KJ)){$B2_211_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB2[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB2[211].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B2[211].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B2_211_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B2_211_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B2_211_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B2_211_KJ.'</span></td></tr>';
$B2_211_CK = '';$B2_211_UJ = '';$B2_211_TK = '';$B2_211_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP212
$CK='B2_212_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_212_CK  = $row['new_value'];	}
$UJ='B2_212_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_212_UJ  = $row['new_value'];	}
$TK='B2_212_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_212_TK  = $row['new_value'];	}
$KJ='B2_212_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_212_KJ  = $row['new_value'];	}

if (empty($B2_212_CK)){$B2_212_CK = '<i>Klik2Edit</i>'; }if (empty($B2_212_UJ)){$B2_212_UJ = '<i>Klik2Edit</i>'; }if (empty($B2_212_TK)){$B2_212_TK = '<i>Klik2Edit</i>'; }if (empty($B2_212_KJ)){$B2_212_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB2[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB2[212].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B2[212].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B2_212_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B2_212_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B2_212_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B2_212_KJ.'</span></td></tr>';
$B2_212_CK = '';$B2_212_UJ = '';$B2_212_TK = '';$B2_212_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP213
$CK='B2_213_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_213_CK  = $row['new_value'];	}
$UJ='B2_213_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_213_UJ  = $row['new_value'];	}
$TK='B2_213_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_213_TK  = $row['new_value'];	}
$KJ='B2_213_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B2_213_KJ  = $row['new_value'];	}

if (empty($B2_213_CK)){$B2_213_CK = '<i>Klik2Edit</i>'; }if (empty($B2_213_UJ)){$B2_213_UJ = '<i>Klik2Edit</i>'; }if (empty($B2_213_TK)){$B2_213_TK = '<i>Klik2Edit</i>'; }if (empty($B2_213_KJ)){$B2_213_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB2[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB2[213].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B2[213].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B2_213_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B2_213_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B2_213_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B2_213_KJ.'</span></td></tr>';
$B2_213_CK = '';$B2_213_UJ = '';$B2_213_TK = '';$B2_213_KJ = '';
//STANDARD BOTDOWN

////////////////////////////////////////////////////////////
echo '</table> <BR>';

?>

<script type="text/javascript">
	
<?php
$setID = '$("#A_0_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });';

$setID .= '$("#B2_0_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });';

$setID .= '$("#B2_100_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_100_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_100_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_100_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B2_101_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B2_101_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_101_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_101_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B2_102_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B2_102_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_102_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_102_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B2_103_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B2_103_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_103_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_103_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B2_104_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B2_104_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_104_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_104_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
///200
$setID .= '$("#B2_200_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_200_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_200_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_200_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B2_201_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B2_201_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_201_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_201_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B2_202_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B2_202_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_202_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_202_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B2_203_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B2_203_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_203_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_203_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B2_204_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B2_204_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_204_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_204_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B2_205_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B2_205_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_205_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_205_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B2_206_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B2_206_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_206_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_206_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B2_207_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B2_207_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_207_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_207_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B2_208_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B2_208_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_208_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_208_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B2_209_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B2_209_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_209_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_209_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B2_210_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B2_210_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_210_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_210_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B2_211_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B2_211_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_211_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_211_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B2_212_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B2_212_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_212_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_212_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B2_213_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B2_213_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_213_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B2_213_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

echo $setID;

	?>

</script>


</body>
</html>
<?php // Flush the buffered output to the Web browser.
ob_flush();
?>
