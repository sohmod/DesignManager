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
	<title>eggBlog - ut_earthwork</title>
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

$Perunding= '<table width="1200" border="1" align="center" cellpadding="-1" cellspacing="0" bordercolor="#E4E4E4"><tr><td bgcolor="#FFFFFF" height="40" width="15" style="align:center;padding-left: 5px;font-size:12px"><b>Sect.</b></td><td bgcolor="#FFFFFF" height="40" width="35" style="align:left;padding-left: 2px;font-size:12px"><b>Item</b></td><td bgcolor="#FFFFFF" height="40" width="250" style="align:center;padding-left: 10px;font-size:12px"><b>Keperluan</b><br/><small><span>(Read in conjunction with TOR, arch. drawings,  specs, approved standards etc)</span></small></td><td bgcolor="#FFFFFF" height="40" width="250" style="align:center;padding-left: 10px;font-size:12px"><b>Cadangan Perunding</b><br/><small>(Read in conjunction with drawings, document submitted)</small></td><td bgcolor="#FFFFFF" height="40" width="225" style="align:center;padding-left: 10px;font-size:12px"><b>Ulasan/ Keperluan/ Tindakan JKR</b></td><td bgcolor="#FFFFFF" height="40" width="225" style="align:center;padding-left: 10px;font-size:12px"><b>Tindakan Perunding</b></td><td bgcolor="#FFFFFF" height="40" width="200" style="align:center;padding-left: 10px;font-size:12px"><b>Keputusan JKR</b></td></tr>';

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
<font color="gray">EIP - Ulasan Teknikal '.$objektif.' Kerja Sivil : </font><font color="red">Earthwork</font><font color="green">&nbsp;&nbsp;Job no:>'.$chk_id.'</font><br/>

<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/ulasanTeknikal_general.php"><font color="green" size="2em" style="text-decoration:none">general</font></a>
<!--a href="http://'.$ipthis.'/_bka/editinPlacejQuery/ulasanTeknikal_earthwork.php"><font color="green" size="2em" style="text-decoration:none"-->earthwork<!--/font></a-->
<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/ulasanTeknikal_drainage.php"><font color="green" size="2em" style="text-decoration:none">drainage</font></a>
<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/ulasanTeknikal_roadwork.php"><font color="green" size="2em" style="text-decoration:none">roadwork</font></a>
<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/ulasanTeknikal_watersupply.php"><font color="green" size="2em" style="text-decoration:none">watersupply</font></a>
<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/ulasanTeknikal_sewerage.php"><font color="green" size="2em" style="text-decoration:none">sewerage</font></a>';

echo $localLink . $header;

$chk='B1_0_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$chk'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_0_CK  = $row['new_value'];	} if (empty($B1_0_CK)){$B1_0_CK = '<i>Klik2Edit</i>'; }
echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>'.$itemB1[0].'</b></td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">.</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px"><b>'.$B1[0].'</b></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$chk.'">'.$B1_0_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span>.</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span>.</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span>.</span></td></tr>';
$B1_0_CK = '';

//STANDARD TOPUP100
$CK='B1_100_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_100_CK  = $row['new_value'];	}
$UJ='B1_100_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_100_UJ  = $row['new_value'];	}
$TK='B1_100_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_100_TK  = $row['new_value'];	}
$KJ='B1_100_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_100_KJ  = $row['new_value'];	}

if (empty($B1_100_CK)){$B1_100_CK = '<i>Klik2Edit<</i>'; }if (empty($B1_100_UJ)){$B1_100_UJ = '<i>Klik2Edit</i>'; }if (empty($B1_100_TK)){$B1_100_TK = '<i>Klik2Edit</i>'; }if (empty($B1_100_KJ)){$B1_100_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[100].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B1[100].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B1_100_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B1_100_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B1_100_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B1_100_KJ.'</span></td></tr>';
$B1_100_CK = '';$B1_100_UJ = '';$B1_100_TK = '';$B1_100_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP101
$CK='B1_101_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_101_CK  = $row['new_value'];	}
$UJ='B1_101_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_101_UJ  = $row['new_value'];	}
$TK='B1_101_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_101_TK  = $row['new_value'];	}
$KJ='B1_101_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_101_KJ  = $row['new_value'];	}

if (empty($B1_101_CK)){$B1_101_CK = '<i>Klik2Edit</i>'; }if (empty($B1_101_UJ)){$B1_101_UJ = '<i>Klik2Edit</i>'; }if (empty($B1_101_TK)){$B1_101_TK = '<i>Klik2Edit</i>'; }if (empty($B1_101_KJ)){$B1_101_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[101].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B1[101].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B1_101_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B1_101_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B1_101_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B1_101_KJ.'</span></td></tr>';
$B1_101_CK = '';$B1_101_UJ = '';$B1_101_TK = '';$B1_101_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP102
$CK='B1_102_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_102_CK  = $row['new_value'];	}
$UJ='B1_102_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_102_UJ  = $row['new_value'];	}
$TK='B1_102_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_102_TK  = $row['new_value'];	}
$KJ='B1_102_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_102_KJ  = $row['new_value'];	}

if (empty($B1_102_CK)){$B1_102_CK = '<i>Klik2Edit</i>'; }if (empty($B1_102_UJ)){$B1_102_UJ = '<i>Klik2Edit</i>'; }if (empty($B1_102_TK)){$B1_102_TK = '<i>Klik2Edit</i>'; }if (empty($B1_102_KJ)){$B1_102_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[102].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B1[102].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B1_102_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B1_102_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B1_102_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B1_102_KJ.'</span></td></tr>';
$B1_102_CK = '';$B1_102_UJ = '';$B1_102_TK = '';$B1_102_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP103
$CK='B1_103_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_103_CK  = $row['new_value'];	}
$UJ='B1_103_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_103_UJ  = $row['new_value'];	}
$TK='B1_103_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_103_TK  = $row['new_value'];	}
$KJ='B1_103_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_103_KJ  = $row['new_value'];	}

if (empty($B1_103_CK)){$B1_103_CK = '<i>Klik2Edit</i>'; }if (empty($B1_103_UJ)){$B1_103_UJ = '<i>Klik2Edit</i>'; }if (empty($B1_103_TK)){$B1_103_TK = '<i>Klik2Edit</i>'; }if (empty($B1_103_KJ)){$B1_103_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[103].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B1[103].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B1_103_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B1_103_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B1_103_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B1_103_KJ.'</span></td></tr>';
$B1_103_CK = '';$B1_103_UJ = '';$B1_103_TK = '';$B1_103_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP104
$CK='B1_104_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_104_CK  = $row['new_value'];	}
$UJ='B1_104_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_104_UJ  = $row['new_value'];	}
$TK='B1_104_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_104_TK  = $row['new_value'];	}
$KJ='B1_104_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_104_KJ  = $row['new_value'];	}

if (empty($B1_104_CK)){$B1_104_CK = '<i>Klik2Edit</i>'; }if (empty($B1_104_UJ)){$B1_104_UJ = '<i>Klik2Edit</i>'; }if (empty($B1_104_TK)){$B1_104_TK = '<i>Klik2Edit</i>'; }if (empty($B1_104_KJ)){$B1_104_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[104].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B1[104].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B1_104_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B1_104_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B1_104_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B1_104_KJ.'</span></td></tr>';
$B1_104_CK = '';$B1_104_UJ = '';$B1_104_TK = '';$B1_104_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP105
$CK='B1_105_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_105_CK  = $row['new_value'];	}
$UJ='B1_105_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_105_UJ  = $row['new_value'];	}
$TK='B1_105_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_105_TK  = $row['new_value'];	}
$KJ='B1_105_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_105_KJ  = $row['new_value'];	}

if (empty($B1_105_CK)){$B1_105_CK = '<i>Klik2Edit</i>'; }if (empty($B1_105_UJ)){$B1_105_UJ = '<i>Klik2Edit</i>'; }if (empty($B1_105_TK)){$B1_105_TK = '<i>Klik2Edit</i>'; }if (empty($B1_105_KJ)){$B1_105_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[105].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B1[105].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B1_105_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B1_105_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B1_105_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B1_105_KJ.'</span></td></tr>';
$B1_105_CK = '';$B1_105_UJ = '';$B1_105_TK = '';$B1_105_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP106
$CK='B1_106_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_106_CK  = $row['new_value'];	}
$UJ='B1_106_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_106_UJ  = $row['new_value'];	}
$TK='B1_106_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_106_TK  = $row['new_value'];	}
$KJ='B1_106_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_106_KJ  = $row['new_value'];	}

if (empty($B1_106_CK)){$B1_106_CK = '<i>Klik2Edit</i>'; }if (empty($B1_106_UJ)){$B1_106_UJ = '<i>Klik2Edit</i>'; }if (empty($B1_106_TK)){$B1_106_TK = '<i>Klik2Edit</i>'; }if (empty($B1_106_KJ)){$B1_106_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[106].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B1[106].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B1_106_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B1_106_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B1_106_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B1_106_KJ.'</span></td></tr>';
$B1_106_CK = '';$B1_106_UJ = '';$B1_106_TK = '';$B1_106_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP107
$CK='B1_107_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_107_CK  = $row['new_value'];	}
$UJ='B1_107_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_107_UJ  = $row['new_value'];	}
$TK='B1_107_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_107_TK  = $row['new_value'];	}
$KJ='B1_107_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_107_KJ  = $row['new_value'];	}

if (empty($B1_107_CK)){$B1_107_CK = '<i>Klik2Edit</i>'; }if (empty($B1_107_UJ)){$B1_107_UJ = '<i>Klik2Edit</i>'; }if (empty($B1_107_TK)){$B1_107_TK = '<i>Klik2Edit</i>'; }if (empty($B1_107_KJ)){$B1_107_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[107].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B1[107].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B1_107_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B1_107_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B1_107_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B1_107_KJ.'</span></td></tr>';
$B1_107_CK = '';$B1_107_UJ = '';$B1_107_TK = '';$B1_107_KJ = '';
//STANDARD BOTDOWN
///////////
//STANDARD TOPUP200
$CK='B1_200_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_200_CK  = $row['new_value'];	}
$UJ='B1_200_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_200_UJ  = $row['new_value'];	}
$TK='B1_200_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_200_TK  = $row['new_value'];	}
$KJ='B1_200_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_200_KJ  = $row['new_value'];	}

if (empty($B1_200_CK)){$B1_200_CK = '<i>Klik2Edit</i>'; }if (empty($B1_200_UJ)){$B1_200_UJ = '<i>Klik2Edit</i>'; }if (empty($B1_200_TK)){$B1_200_TK = '<i>Klik2Edit</i>'; }if (empty($B1_200_KJ)){$B1_200_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[200].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B1[200].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B1_200_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B1_200_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B1_200_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B1_200_KJ.'</span></td></tr>';
$B1_200_CK = '';$B1_200_UJ = '';$B1_200_TK = '';$B1_200_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP201
$CK='B1_201_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_201_CK  = $row['new_value'];	}
$UJ='B1_201_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_201_UJ  = $row['new_value'];	}
$TK='B1_201_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_201_TK  = $row['new_value'];	}
$KJ='B1_201_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_201_KJ  = $row['new_value'];	}

if (empty($B1_201_CK)){$B1_201_CK = '<i>Klik2Edit</i>'; }if (empty($B1_201_UJ)){$B1_201_UJ = '<i>Klik2Edit</i>'; }if (empty($B1_201_TK)){$B1_201_TK = '<i>Klik2Edit</i>'; }if (empty($B1_201_KJ)){$B1_201_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[201].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B1[201].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B1_201_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B1_201_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B1_201_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B1_201_KJ.'</span></td></tr>';
$B1_201_CK = '';$B1_201_UJ = '';$B1_201_TK = '';$B1_201_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP202
$CK='B1_202_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_202_CK  = $row['new_value'];	}
$UJ='B1_202_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_202_UJ  = $row['new_value'];	}
$TK='B1_202_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_202_TK  = $row['new_value'];	}
$KJ='B1_202_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_202_KJ  = $row['new_value'];	}

if (empty($B1_202_CK)){$B1_202_CK = '<i>Klik2Edit</i>'; }if (empty($B1_202_UJ)){$B1_202_UJ = '<i>Klik2Edit</i>'; }if (empty($B1_202_TK)){$B1_202_TK = '<i>Klik2Edit</i>'; }if (empty($B1_202_KJ)){$B1_202_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[202].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B1[202].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B1_202_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B1_202_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B1_202_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B1_202_KJ.'</span></td></tr>';
$B1_202_CK = '';$B1_202_UJ = '';$B1_202_TK = '';$B1_202_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP203
$CK='B1_203_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_203_CK  = $row['new_value'];	}
$UJ='B1_203_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_203_UJ  = $row['new_value'];	}
$TK='B1_203_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_203_TK  = $row['new_value'];	}
$KJ='B1_203_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_203_KJ  = $row['new_value'];	}

if (empty($B1_203_CK)){$B1_203_CK = '<i>Klik2Edit</i>'; }if (empty($B1_203_UJ)){$B1_203_UJ = '<i>Klik2Edit</i>'; }if (empty($B1_203_TK)){$B1_203_TK = '<i>Klik2Edit</i>'; }if (empty($B1_203_KJ)){$B1_203_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[203].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B1[203].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B1_203_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B1_203_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B1_203_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B1_203_KJ.'</span></td></tr>';
$B1_203_CK = '';$B1_203_UJ = '';$B1_203_TK = '';$B1_203_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP204
$CK='B1_204_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_204_CK  = $row['new_value'];	}
$UJ='B1_204_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_204_UJ  = $row['new_value'];	}
$TK='B1_204_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_204_TK  = $row['new_value'];	}
$KJ='B1_204_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_204_KJ  = $row['new_value'];	}

if (empty($B1_204_CK)){$B1_204_CK = '<i>Klik2Edit</i>'; }if (empty($B1_204_UJ)){$B1_204_UJ = '<i>Klik2Edit</i>'; }if (empty($B1_204_TK)){$B1_204_TK = '<i>Klik2Edit</i>'; }if (empty($B1_204_KJ)){$B1_204_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[204].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B1[204].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B1_204_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B1_204_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B1_204_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B1_204_KJ.'</span></td></tr>';
$B1_204_CK = '';$B1_204_UJ = '';$B1_204_TK = '';$B1_204_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP205
$CK='B1_205_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_205_CK  = $row['new_value'];	}
$UJ='B1_205_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_205_UJ  = $row['new_value'];	}
$TK='B1_205_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_205_TK  = $row['new_value'];	}
$KJ='B1_205_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_205_KJ  = $row['new_value'];	}

if (empty($B1_205_CK)){$B1_205_CK = '<i>Klik2Edit</i>'; }if (empty($B1_205_UJ)){$B1_205_UJ = '<i>Klik2Edit</i>'; }if (empty($B1_205_TK)){$B1_205_TK = '<i>Klik2Edit</i>'; }if (empty($B1_205_KJ)){$B1_205_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[205].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B1[205].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B1_205_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B1_205_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B1_205_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B1_205_KJ.'</span></td></tr>';
$B1_205_CK = '';$B1_205_UJ = '';$B1_205_TK = '';$B1_205_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP206
$CK='B1_206_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_206_CK  = $row['new_value'];	}
$UJ='B1_206_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_206_UJ  = $row['new_value'];	}
$TK='B1_206_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_206_TK  = $row['new_value'];	}
$KJ='B1_206_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_206_KJ  = $row['new_value'];	}

if (empty($B1_206_CK)){$B1_206_CK = '<i>Klik2Edit</i>'; }if (empty($B1_206_UJ)){$B1_206_UJ = '<i>Klik2Edit</i>'; }if (empty($B1_206_TK)){$B1_206_TK = '<i>Klik2Edit</i>'; }if (empty($B1_206_KJ)){$B1_206_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[206].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B1[206].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B1_206_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B1_206_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B1_206_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B1_206_KJ.'</span></td></tr>';
$B1_206_CK = '';$B1_206_UJ = '';$B1_206_TK = '';$B1_206_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP207
$CK='B1_207_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_207_CK  = $row['new_value'];	}
$UJ='B1_207_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_207_UJ  = $row['new_value'];	}
$TK='B1_207_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_207_TK  = $row['new_value'];	}
$KJ='B1_207_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_207_KJ  = $row['new_value'];	}

if (empty($B1_207_CK)){$B1_207_CK = '<i>Klik2Edit</i>'; }if (empty($B1_207_UJ)){$B1_207_UJ = '<i>Klik2Edit</i>'; }if (empty($B1_207_TK)){$B1_207_TK = '<i>Klik2Edit</i>'; }if (empty($B1_207_KJ)){$B1_207_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[207].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B1[207].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B1_207_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B1_207_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B1_207_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B1_207_KJ.'</span></td></tr>';
$B1_207_CK = '';$B1_207_UJ = '';$B1_207_TK = '';$B1_207_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP300
$CK='B1_300_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_300_CK  = $row['new_value'];	}
$UJ='B1_300_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_300_UJ  = $row['new_value'];	}
$TK='B1_300_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_300_TK  = $row['new_value'];	}
$KJ='B1_300_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_300_KJ  = $row['new_value'];	}

if (empty($B1_300_CK)){$B1_300_CK = '<i>Klik2Edit</i>'; }if (empty($B1_300_UJ)){$B1_300_UJ = '<i>Klik2Edit</i>'; }if (empty($B1_300_TK)){$B1_300_TK = '<i>Klik2Edit</i>'; }if (empty($B1_300_KJ)){$B1_300_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[300].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B1[300].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B1_300_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B1_300_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B1_300_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B1_300_KJ.'</span></td></tr>';
$B1_300_CK = '';$B1_300_UJ = '';$B1_300_TK = '';$B1_300_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP301
$CK='B1_301_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_301_CK  = $row['new_value'];	}
$UJ='B1_301_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_301_UJ  = $row['new_value'];	}
$TK='B1_301_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_301_TK  = $row['new_value'];	}
$KJ='B1_301_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_301_KJ  = $row['new_value'];	}

if (empty($B1_301_CK)){$B1_301_CK = '<i>Klik2Edit</i>'; }if (empty($B1_301_UJ)){$B1_301_UJ = '<i>Klik2Edit</i>'; }if (empty($B1_301_TK)){$B1_301_TK = '<i>Klik2Edit</i>'; }if (empty($B1_301_KJ)){$B1_301_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[301].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B1[301].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B1_301_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B1_301_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B1_301_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B1_301_KJ.'</span></td></tr>';
$B1_301_CK = '';$B1_301_UJ = '';$B1_301_TK = '';$B1_301_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP400
$CK='B1_400_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_400_CK  = $row['new_value'];	}
$UJ='B1_400_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_400_UJ  = $row['new_value'];	}
$TK='B1_400_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_400_TK  = $row['new_value'];	}
$KJ='B1_400_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_400_KJ  = $row['new_value'];	}

if (empty($B1_400_CK)){$B1_400_CK = '<i>Klik2Edit</i>'; }if (empty($B1_400_UJ)){$B1_400_UJ = '<i>Klik2Edit</i>'; }if (empty($B1_400_TK)){$B1_400_TK = '<i>Klik2Edit</i>'; }if (empty($B1_400_KJ)){$B1_400_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[400].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B1[400].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B1_400_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B1_400_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B1_400_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B1_400_KJ.'</span></td></tr>';
$B1_400_CK = '';$B1_400_UJ = '';$B1_400_TK = '';$B1_400_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP401
$CK='B1_401_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_401_CK  = $row['new_value'];	}
$UJ='B1_401_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_401_UJ  = $row['new_value'];	}
$TK='B1_401_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_401_TK  = $row['new_value'];	}
$KJ='B1_401_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_401_KJ  = $row['new_value'];	}

if (empty($B1_401_CK)){$B1_401_CK = '<i>Klik2Edit</i>'; }if (empty($B1_401_UJ)){$B1_401_UJ = '<i>Klik2Edit</i>'; }if (empty($B1_401_TK)){$B1_401_TK = '<i>Klik2Edit</i>'; }if (empty($B1_401_KJ)){$B1_401_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[401].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B1[401].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B1_401_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B1_401_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B1_401_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B1_401_KJ.'</span></td></tr>';
$B1_401_CK = '';$B1_401_UJ = '';$B1_401_TK = '';$B1_401_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP500
$CK='B1_500_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_500_CK  = $row['new_value'];	}
$UJ='B1_500_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_500_UJ  = $row['new_value'];	}
$TK='B1_500_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_500_TK  = $row['new_value'];	}
$KJ='B1_500_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_500_KJ  = $row['new_value'];	}

if (empty($B1_500_CK)){$B1_500_CK = '<i>Klik2Edit</i>'; }if (empty($B1_500_UJ)){$B1_500_UJ = '<i>Klik2Edit</i>'; }if (empty($B1_500_TK)){$B1_500_TK = '<i>Klik2Edit</i>'; }if (empty($B1_500_KJ)){$B1_500_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FDFECF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[0].'</td><td bgcolor="#FDFECF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[500].'</td><td bgcolor="#FDFECF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B1[500].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B1_500_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B1_500_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B1_500_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B1_500_KJ.'</span></td></tr>';
$B1_500_CK = '';$B1_500_UJ = '';$B1_500_TK = '';$B1_500_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP501
$CK='B1_501_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_501_CK  = $row['new_value'];	}
$UJ='B1_501_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_501_UJ  = $row['new_value'];	}
$TK='B1_501_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_501_TK  = $row['new_value'];	}
$KJ='B1_501_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_501_KJ  = $row['new_value'];	}

if (empty($B1_501_CK)){$B1_501_CK = '<i>Klik2Edit</i>'; }if (empty($B1_501_UJ)){$B1_501_UJ = '<i>Klik2Edit</i>'; }if (empty($B1_501_TK)){$B1_501_TK = '<i>Klik2Edit</i>'; }if (empty($B1_501_KJ)){$B1_501_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[501].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B1[501].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B1_501_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B1_501_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B1_501_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B1_501_KJ.'</span></td></tr>';
$B1_501_CK = '';$B1_501_UJ = '';$B1_501_TK = '';$B1_501_KJ = '';
//STANDARD BOTDOWN

//STANDARD TOPUP502
$CK='B1_502_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$CK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_502_CK  = $row['new_value'];	}
$UJ='B1_502_UJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$UJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_502_UJ  = $row['new_value'];	}
$TK='B1_502_TK-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$TK'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_502_TK  = $row['new_value'];	}
$KJ='B1_502_KJ-'.$chk_id; $result=mysql_query("SELECT new_value FROM ulasanteknikal where id='$KJ'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $B1_502_KJ  = $row['new_value'];	}

if (empty($B1_502_CK)){$B1_502_CK = '<i>Klik2Edit</i>'; }if (empty($B1_502_UJ)){$B1_502_UJ = '<i>Klik2Edit</i>'; }if (empty($B1_502_TK)){$B1_502_TK = '<i>Klik2Edit</i>'; }if (empty($B1_502_KJ)){$B1_502_KJ = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="20" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[0].'</td><td bgcolor="#FFFFFF" width="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px">'.$itemB1[502].'</td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-bottom: 5px;padding-top: 5px">'.$B1[502].'<br></td><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$CK.'">'.$B1_502_CK.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$UJ.'">'.$B1_502_UJ.'</span></td><td bgcolor="#FFFFFF" width="225" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$TK.'">'.$B1_502_TK.'</span></td><td bgcolor="#FFFFFF" width="200" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><span id="'.$KJ.'">'.$B1_502_KJ.'</span></td></tr>';
$B1_502_CK = '';$B1_502_UJ = '';$B1_502_TK = '';$B1_501_KJ = '';
//STANDARD BOTDOWN
////////////////////////////////////////////////////////////
echo '</table> <BR>';

?>

<script type="text/javascript">
	
<?php
$setID = '$("#A_0_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });';

$setID .= '$("#B1_0_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });';

$setID .= '$("#B1_100_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_100_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_100_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_100_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B1_101_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B1_101_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_101_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_101_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B1_102_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B1_102_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_102_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_102_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B1_103_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B1_103_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_103_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_103_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B1_104_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B1_104_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_104_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_104_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B1_105_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B1_105_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_105_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_105_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B1_106_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B1_106_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_106_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_106_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B1_107_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B1_107_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_107_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_107_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

///200
$setID .= '$("#B1_200_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_200_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_200_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_200_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B1_201_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B1_201_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_201_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_201_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B1_202_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B1_202_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_202_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_202_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B1_203_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B1_203_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_203_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_203_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B1_204_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B1_204_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_204_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_204_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B1_205_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B1_205_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_205_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_205_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B1_206_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B1_206_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_206_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_206_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B1_207_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B1_207_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_207_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_207_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B1_300_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_300_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_300_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_300_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B1_301_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B1_301_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_301_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_301_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B1_400_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B1_400_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_400_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_400_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
$setID .= '$("#B1_401_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B1_401_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_401_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_401_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';

$setID .= '$("#B1_500_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B1_500_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_500_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_500_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
$setID .= '$("#B1_501_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B1_501_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_501_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_501_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
$setID .= '$("#B1_502_CK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "select",
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
$("#B1_502_UJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_502_TK-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
$("#B1_502_KJ-'.$chk_id.'").eip("save_ulasanTeknikal.php", { form_type: "textarea", max_rows:2, cols:25 });
';
echo $setID;

	?>

</script>


</body>
</html>
<?php // Flush the buffered output to the Web browser.
ob_flush();
?>