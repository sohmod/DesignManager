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
	<title>eggBlog - _pkO_02_sewerage</title>
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
$chk='A_0_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chk'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_0_CK  = $row['new_value'];	}


$spk = '<table width="800" border="1" align="center" cellpadding="-1" cellspacing="0" bordercolor="#E4E4E4" ><tr><td colspan="3" bgcolor="#FFFFFF" height="40" style="align:center;padding-left: 5px;font-size:12px"><b>Borang JKR.PK(O).02-2
KAJIAN SEMULA / VERIFIKASI / VALIDASI (*)</b></td></tr>';

$spkDB = '<table width="800" border="1" align="center" cellpadding="-1" cellspacing="0" bordercolor="#E4E4E4" ><tr><td colspan="3" bgcolor="#FFFFFF" height="40" style="align:center;padding-left: 5px;font-size:12px"><b>Borang JKR.PK(O).02-4 REKOD AUDIT REKABENTUK TERPERINCI R&B</b></td></tr>';


$localLink = '<div align="center"><span>
 Tajuk projek:>&nbsp;:&nbsp;&nbsp;&nbsp; <b><font color="darkblue" style="font-size:14">'.$tjk_projek.'</font></b><br/>
<font color="gray">EIP - Borang JKR.PK(O).02-2
KAJIAN SEMULA / VERIFIKASI / VALIDASI (*) Kerja Sivil : </font><font color="red">sewerage</font><font color="green">&nbsp;&nbsp;Job no:>'.$chk_id.'</font><br/>

<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/JKR.PK(O).02-2_msbka.php"><font color="green" size="2em" style="text-decoration:none">Kehadiran</font></a>
<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/JKR.PK(O).02-2_earthwork.php"><font color="green" size="2em" style="text-decoration:none">earthwork</font></a>
<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/JKR.PK(O).02-2_drainage.php"><font color="green" size="2em" style="text-decoration:none">drainage</font></a>
<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/JKR.PK(O).02-2_roadwork.php"><font color="green" size="2em" style="text-decoration:none">roadwork</font></a>
<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/JKR.PK(O).02-2_watersupply.php"><font color="green" size="2em" style="text-decoration:none">watersupply</font></a>
<!--a href="http://'.$ipthis.'/_bka/editinPlacejQuery/JKR.PK(O).02-2_sewerage.php"><font color="green" size="2em" style="text-decoration:none"-->sewerage<!--/font></a-->
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


echo '<tr><td bgcolor="#FFFFFF" width="50"  height="30" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>Bil</b></td><td bgcolor="#FFFFFF" width="350" style="align:center;padding-left: 5px;font-size:12px"><b>No. Lukisan/ Spesifikasi (*)</b></td><td bgcolor="#FFFFFF" width="400" style="align:center;padding-left: 5px;font-size:12px"><b>Ulasan</b></td></tr>';

$chknama='sewerageDraw1-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chknama'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $sewerageDraw1  = $row['new_value'];	} if (empty($sewerageDraw1)){$sewerageDraw1 = '<i>Klik2Edit</i>'; }
$chkjawat='sewerageUlas1-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chkjawat'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $sewerageUlas1  = $row['new_value'];	} if (empty($sewerageUlas1)){$sewerageUlas1 = '<i>Klik2Edit</i>'; }
echo '<tr><td bgcolor="#FFFFFF" width="50"  height="30" valign="top" style="align:center;padding-left: 15px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>1</b></td><td bgcolor="#FFFFFF" width="350" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chknama.'">'.$sewerageDraw1.'</span></td><td bgcolor="#FFFFFF" width="400" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chkjawat.'">'.$sewerageUlas1.'</span></td></tr>';
$sewerageDraw1 = '';$sewerageUlas1 = '';

$chknama='sewerageDraw2-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chknama'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $sewerageDraw2  = $row['new_value'];	} if (empty($sewerageDraw2)){$sewerageDraw2 = '<i>Klik2Edit</i>'; }
$chkjawat='sewerageUlas2-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chkjawat'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $sewerageUlas2  = $row['new_value'];	} if (empty($sewerageUlas2)){$sewerageUlas2 = '<i>Klik2Edit</i>'; }
echo '<tr><td bgcolor="#FFFFFF" width="50"  height="30" valign="top" style="align:center;padding-left: 15px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>2</b></td><td bgcolor="#FFFFFF" width="350" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chknama.'">'.$sewerageDraw2.'</span></td><td bgcolor="#FFFFFF" width="400" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chkjawat.'">'.$sewerageUlas2.'</span></td></tr>';
$sewerageDraw2 = '';$sewerageUlas2 = '';

//3
$chknama='sewerageDraw3-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chknama'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $sewerageDraw3  = $row['new_value'];	} if (empty($sewerageDraw3)){$sewerageDraw3 = '<i>Klik2Edit</i>'; }
$chkjawat='sewerageUlas3-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chkjawat'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $sewerageUlas3  = $row['new_value'];	} if (empty($sewerageUlas3)){$sewerageUlas3 = '<i>Klik2Edit</i>'; }
echo '<tr><td bgcolor="#FFFFFF" width="50"  height="30" valign="top" style="align:center;padding-left: 15px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>3</b></td><td bgcolor="#FFFFFF" width="350" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chknama.'">'.$sewerageDraw3.'</span></td><td bgcolor="#FFFFFF" width="400" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chkjawat.'">'.$sewerageUlas3.'</span></td></tr>';
$sewerageDraw3 = '';$sewerageUlas3 = '';

//4
$chknama='sewerageDraw4-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chknama'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $sewerageDraw4  = $row['new_value'];	} if (empty($sewerageDraw4)){$sewerageDraw4 = '<i>Klik2Edit</i>'; }
$chkjawat='sewerageUlas4-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chkjawat'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $sewerageUlas4  = $row['new_value'];	} if (empty($sewerageUlas4)){$sewerageUlas4 = '<i>Klik2Edit</i>'; }
echo '<tr><td bgcolor="#FFFFFF" width="50"  height="30" valign="top" style="align:center;padding-left: 15px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>4</b></td><td bgcolor="#FFFFFF" width="350" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chknama.'">'.$sewerageDraw4.'</span></td><td bgcolor="#FFFFFF" width="400" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chkjawat.'">'.$sewerageUlas4.'</span></td></tr>';
$sewerageDraw4 = '';$sewerageUlas4 = '';

//5
$chknama='sewerageDraw5-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chknama'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $sewerageDraw5  = $row['new_value'];	} if (empty($sewerageDraw5)){$sewerageDraw5 = '<i>Klik2Edit</i>'; }
$chkjawat='sewerageUlas5-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chkjawat'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $sewerageUlas5  = $row['new_value'];	} if (empty($sewerageUlas5)){$sewerageUlas5 = '<i>Klik2Edit</i>'; }
echo '<tr><td bgcolor="#FFFFFF" width="50"  height="30" valign="top" style="align:center;padding-left: 15px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>5</b></td><td bgcolor="#FFFFFF" width="350" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chknama.'">'.$sewerageDraw5.'</span></td><td bgcolor="#FFFFFF" width="400" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chkjawat.'">'.$sewerageUlas5.'</span></td></tr>';
$sewerageDraw5 = '';$sewerageUlas5 = '';

//6
$chknama='sewerageDraw6-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chknama'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $sewerageDraw6  = $row['new_value'];	} if (empty($sewerageDraw6)){$sewerageDraw6 = '<i>Klik2Edit</i>'; }
$chkjawat='sewerageUlas6-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chkjawat'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $sewerageUlas6  = $row['new_value'];	} if (empty($sewerageUlas6)){$sewerageUlas6 = '<i>Klik2Edit</i>'; }
echo '<tr><td bgcolor="#FFFFFF" width="50"  height="30" valign="top" style="align:center;padding-left: 15px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>6</b></td><td bgcolor="#FFFFFF" width="350" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chknama.'">'.$sewerageDraw6.'</span></td><td bgcolor="#FFFFFF" width="400" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chkjawat.'">'.$sewerageUlas6.'</span></td></tr>';
$sewerageDraw6 = '';$sewerageUlas6 = '';

//7
$chknama='sewerageDraw7-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chknama'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $sewerageDraw7  = $row['new_value'];	} if (empty($sewerageDraw7)){$sewerageDraw7 = '<i>Klik2Edit</i>'; }
$chkjawat='sewerageUlas7-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chkjawat'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $sewerageUlas7  = $row['new_value'];	} if (empty($sewerageUlas7)){$sewerageUlas7 = '<i>Klik2Edit</i>'; }
echo '<tr><td bgcolor="#FFFFFF" width="50"  height="30" valign="top" style="align:center;padding-left: 15px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>7</b></td><td bgcolor="#FFFFFF" width="250" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chknama.'">'.$sewerageDraw7.'</span></td><td bgcolor="#FFFFFF" width="400" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chkjawat.'">'.$sewerageUlas7.'</span></td></tr>';
$sewerageDraw7 = '';$sewerageUlas7 = '';

////////////////////////////////////////////////////////////
echo '</table> <BR>';

?>

<script type="text/javascript">
	
<?php
$setID = '$("#tajukprojek-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:60 });';

$setID .= '$("#sewerageDraw1-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });
$("#sewerageUlas1-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });';

$setID .= '$("#sewerageDraw2-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });
$("#sewerageUlas2-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });';

$setID .= '$("#sewerageDraw3-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });
$("#sewerageUlas3-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });';

$setID .= '$("#sewerageDraw4-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });
$("#sewerageUlas4-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });';

$setID .= '$("#sewerageDraw5-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });
$("#sewerageUlas5-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });';

$setID .= '$("#sewerageDraw6-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });
$("#sewerageUlas6-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });';

$setID .= '$("#sewerageDraw7-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });
$("#sewerageUlas7-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });';

echo $setID;

	?>

</script>


</body>
</html>
<?php // Flush the buffered output to the Web browser.
ob_flush();
?>