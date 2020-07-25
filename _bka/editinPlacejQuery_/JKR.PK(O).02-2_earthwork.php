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
	<title>eggBlog - _pkO_02_earthwork</title>
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
$chk='A_0_CK-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chk'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $A_0_CK  = $row['new_value'];	}


$spk = '<table width="800" border="1" align="center" cellpadding="-1" cellspacing="0" bordercolor="#E4E4E4" ><tr><td colspan="3" bgcolor="#FFFFFF" height="40" style="align:center;padding-left: 5px;font-size:12px"><b>Borang JKR.PK(O).02-2
KAJIAN SEMULA / VERIFIKASI / VALIDASI (*)</b></td></tr>';

$spkDB = '<table width="800" border="1" align="center" cellpadding="-1" cellspacing="0" bordercolor="#E4E4E4" ><tr><td colspan="3" bgcolor="#FFFFFF" height="40" style="align:center;padding-left: 5px;font-size:12px"><b>Borang JKR.PK(O).02-4 REKOD AUDIT REKABENTUK TERPERINCI R&B</b></td></tr>';


$localLink = '<div align="center"><span>
 Tajuk projek:>&nbsp;:&nbsp;&nbsp;&nbsp; <b><font color="darkblue" style="font-size:14">'.$tjk_projek.'</font></b><br/>
<font color="gray">EIP - Borang JKR.PK(O).02-2
KAJIAN SEMULA / VERIFIKASI / VALIDASI (*) Kerja Sivil : </font><font color="red">earthwork</font><font color="green">&nbsp;&nbsp;Job no:>'.$chk_id.'</font><br/>

<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/JKR.PK(O).02-2_msbka.php"><font color="green" size="2em" style="text-decoration:none">Kehadiran</font></a>
<!--a href="http://'.$ipthis.'/_bka/editinPlacejQuery/JKR.PK(O).02-2_earthwork.php"><font color="green" size="2em" style="text-decoration:none"-->earthwork<!--/font></a-->
<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/JKR.PK(O).02-2_drainage.php"><font color="green" size="2em" style="text-decoration:none">drainage</font></a>
<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/JKR.PK(O).02-2_roadwork.php"><font color="green" size="2em" style="text-decoration:none">roadwork</font></a>
<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/JKR.PK(O).02-2_watersupply.php"><font color="green" size="2em" style="text-decoration:none">watersupply</font></a>
<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/JKR.PK(O).02-2_sewerage.php"><font color="green" size="2em" style="text-decoration:none">sewerage</font></a>
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

$chknama='earthworkDraw1-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chknama'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $earthworkDraw1  = $row['new_value'];	} if (empty($earthworkDraw1)){$earthworkDraw1 = '<i>Klik2Edit</i>'; }
$chkjawat='earthworkUlas1-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chkjawat'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $earthworkUlas1  = $row['new_value'];	} if (empty($earthworkUlas1)){$earthworkUlas1 = '<i>Klik2Edit</i>'; }
echo '<tr><td bgcolor="#FFFFFF" width="50"  height="30" valign="top" style="align:center;padding-left: 15px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>1</b></td><td bgcolor="#FFFFFF" width="350" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chknama.'">'.$earthworkDraw1.'</span></td><td bgcolor="#FFFFFF" width="400" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chkjawat.'">'.$earthworkUlas1.'</span></td></tr>';
$earthworkDraw1 = '';$earthworkUlas1 = '';

$chknama='earthworkDraw2-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chknama'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $earthworkDraw2  = $row['new_value'];	} if (empty($earthworkDraw2)){$earthworkDraw2 = '<i>Klik2Edit</i>'; }
$chkjawat='earthworkUlas2-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chkjawat'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $earthworkUlas2  = $row['new_value'];	} if (empty($earthworkUlas2)){$earthworkUlas2 = '<i>Klik2Edit</i>'; }
echo '<tr><td bgcolor="#FFFFFF" width="50"  height="30" valign="top" style="align:center;padding-left: 15px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>2</b></td><td bgcolor="#FFFFFF" width="350" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chknama.'">'.$earthworkDraw2.'</span></td><td bgcolor="#FFFFFF" width="400" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chkjawat.'">'.$earthworkUlas2.'</span></td></tr>';
$earthworkDraw2 = '';$earthworkUlas2 = '';

//3
$chknama='earthworkDraw3-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chknama'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $earthworkDraw3  = $row['new_value'];	} if (empty($earthworkDraw3)){$earthworkDraw3 = '<i>Klik2Edit</i>'; }
$chkjawat='earthworkUlas3-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chkjawat'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $earthworkUlas3  = $row['new_value'];	} if (empty($earthworkUlas3)){$earthworkUlas3 = '<i>Klik2Edit</i>'; }
echo '<tr><td bgcolor="#FFFFFF" width="50"  height="30" valign="top" style="align:center;padding-left: 15px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>3</b></td><td bgcolor="#FFFFFF" width="350" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chknama.'">'.$earthworkDraw3.'</span></td><td bgcolor="#FFFFFF" width="400" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chkjawat.'">'.$earthworkUlas3.'</span></td></tr>';
$earthworkDraw3 = '';$earthworkUlas3 = '';

//4
$chknama='earthworkDraw4-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chknama'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $earthworkDraw4  = $row['new_value'];	} if (empty($earthworkDraw4)){$earthworkDraw4 = '<i>Klik2Edit</i>'; }
$chkjawat='earthworkUlas4-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chkjawat'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $earthworkUlas4  = $row['new_value'];	} if (empty($earthworkUlas4)){$earthworkUlas4 = '<i>Klik2Edit</i>'; }
echo '<tr><td bgcolor="#FFFFFF" width="50"  height="30" valign="top" style="align:center;padding-left: 15px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>4</b></td><td bgcolor="#FFFFFF" width="350" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chknama.'">'.$earthworkDraw4.'</span></td><td bgcolor="#FFFFFF" width="400" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chkjawat.'">'.$earthworkUlas4.'</span></td></tr>';
$earthworkDraw4 = '';$earthworkUlas4 = '';

//5
$chknama='earthworkDraw5-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chknama'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $earthworkDraw5  = $row['new_value'];	} if (empty($earthworkDraw5)){$earthworkDraw5 = '<i>Klik2Edit</i>'; }
$chkjawat='earthworkUlas5-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chkjawat'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $earthworkUlas5  = $row['new_value'];	} if (empty($earthworkUlas5)){$earthworkUlas5 = '<i>Klik2Edit</i>'; }
echo '<tr><td bgcolor="#FFFFFF" width="50"  height="30" valign="top" style="align:center;padding-left: 15px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>5</b></td><td bgcolor="#FFFFFF" width="350" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chknama.'">'.$earthworkDraw5.'</span></td><td bgcolor="#FFFFFF" width="400" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chkjawat.'">'.$earthworkUlas5.'</span></td></tr>';
$earthworkDraw5 = '';$earthworkUlas5 = '';

//6
$chknama='earthworkDraw6-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chknama'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $earthworkDraw6  = $row['new_value'];	} if (empty($earthworkDraw6)){$earthworkDraw6 = '<i>Klik2Edit</i>'; }
$chkjawat='earthworkUlas6-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chkjawat'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $earthworkUlas6  = $row['new_value'];	} if (empty($earthworkUlas6)){$earthworkUlas6 = '<i>Klik2Edit</i>'; }
echo '<tr><td bgcolor="#FFFFFF" width="50"  height="30" valign="top" style="align:center;padding-left: 15px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>6</b></td><td bgcolor="#FFFFFF" width="350" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chknama.'">'.$earthworkDraw6.'</span></td><td bgcolor="#FFFFFF" width="400" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chkjawat.'">'.$earthworkUlas6.'</span></td></tr>';
$earthworkDraw6 = '';$earthworkUlas6 = '';

//7
$chknama='earthworkDraw7-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chknama'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $earthworkDraw7  = $row['new_value'];	} if (empty($earthworkDraw7)){$earthworkDraw7 = '<i>Klik2Edit</i>'; }
$chkjawat='earthworkUlas7-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chkjawat'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $earthworkUlas7  = $row['new_value'];	} if (empty($earthworkUlas7)){$earthworkUlas7 = '<i>Klik2Edit</i>'; }
echo '<tr><td bgcolor="#FFFFFF" width="50"  height="30" valign="top" style="align:center;padding-left: 15px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>7</b></td><td bgcolor="#FFFFFF" width="250" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chknama.'">'.$earthworkDraw7.'</span></td><td bgcolor="#FFFFFF" width="400" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chkjawat.'">'.$earthworkUlas7.'</span></td></tr>';
$earthworkDraw7 = '';$earthworkUlas7 = '';

////////////////////////////////////////////////////////////
echo '</table> <BR>';

?>

<script type="text/javascript">
	
<?php
$setID = '$("#tajukprojek-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:60 });';

$setID .= '$("#earthworkDraw1-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });
$("#earthworkUlas1-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });';

$setID .= '$("#earthworkDraw2-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });
$("#earthworkUlas2-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });';

$setID .= '$("#earthworkDraw3-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });
$("#earthworkUlas3-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });';

$setID .= '$("#earthworkDraw4-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });
$("#earthworkUlas4-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });';

$setID .= '$("#earthworkDraw5-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });
$("#earthworkUlas5-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });';

$setID .= '$("#earthworkDraw6-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });
$("#earthworkUlas6-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });';

$setID .= '$("#earthworkDraw7-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });
$("#earthworkUlas7-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });';

echo $setID;

	?>

</script>


</body>
</html>
<?php // Flush the buffered output to the Web browser.
ob_flush();
?>
