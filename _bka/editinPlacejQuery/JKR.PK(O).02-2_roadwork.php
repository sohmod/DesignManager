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
	<title>eggBlog - _pkO_02_roadwork</title>
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
KAJIAN SEMULA / VERIFIKASI / VALIDASI (*) Kerja Sivil : </font><font color="red">roadwork</font><font color="green">&nbsp;&nbsp;Job no:>'.$chk_id.'</font><br/>

<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/JKR.PK(O).02-2_msbka.php"><font color="green" size="2em" style="text-decoration:none">Kehadiran</font></a>
<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/JKR.PK(O).02-2_earthwork.php"><font color="green" size="2em" style="text-decoration:none">earthwork</font></a>
<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/JKR.PK(O).02-2_drainage.php"><font color="green" size="2em" style="text-decoration:none">drainage</font></a>
<!--a href="http://'.$ipthis.'/_bka/editinPlacejQuery/JKR.PK(O).02-2_roadwork.php"><font color="green" size="2em" style="text-decoration:none"-->roadwork<!--/font></a-->
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

$chknama='roadworkDraw1-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chknama'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $roadworkDraw1  = $row['new_value'];	} if (empty($roadworkDraw1)){$roadworkDraw1 = '<i>Klik2Edit</i>'; }
$chkjawat='roadworkUlas1-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chkjawat'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $roadworkUlas1  = $row['new_value'];	} if (empty($roadworkUlas1)){$roadworkUlas1 = '<i>Klik2Edit</i>'; }
echo '<tr><td bgcolor="#FFFFFF" width="50"  height="30" valign="top" style="align:center;padding-left: 15px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>1</b></td><td bgcolor="#FFFFFF" width="350" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chknama.'">'.$roadworkDraw1.'</span></td><td bgcolor="#FFFFFF" width="400" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chkjawat.'">'.$roadworkUlas1.'</span></td></tr>';
$roadworkDraw1 = '';$roadworkUlas1 = '';

$chknama='roadworkDraw2-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chknama'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $roadworkDraw2  = $row['new_value'];	} if (empty($roadworkDraw2)){$roadworkDraw2 = '<i>Klik2Edit</i>'; }
$chkjawat='roadworkUlas2-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chkjawat'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $roadworkUlas2  = $row['new_value'];	} if (empty($roadworkUlas2)){$roadworkUlas2 = '<i>Klik2Edit</i>'; }
echo '<tr><td bgcolor="#FFFFFF" width="50"  height="30" valign="top" style="align:center;padding-left: 15px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>2</b></td><td bgcolor="#FFFFFF" width="350" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chknama.'">'.$roadworkDraw2.'</span></td><td bgcolor="#FFFFFF" width="400" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chkjawat.'">'.$roadworkUlas2.'</span></td></tr>';
$roadworkDraw2 = '';$roadworkUlas2 = '';

//3
$chknama='roadworkDraw3-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chknama'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $roadworkDraw3  = $row['new_value'];	} if (empty($roadworkDraw3)){$roadworkDraw3 = '<i>Klik2Edit</i>'; }
$chkjawat='roadworkUlas3-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chkjawat'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $roadworkUlas3  = $row['new_value'];	} if (empty($roadworkUlas3)){$roadworkUlas3 = '<i>Klik2Edit</i>'; }
echo '<tr><td bgcolor="#FFFFFF" width="50"  height="30" valign="top" style="align:center;padding-left: 15px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>3</b></td><td bgcolor="#FFFFFF" width="350" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chknama.'">'.$roadworkDraw3.'</span></td><td bgcolor="#FFFFFF" width="400" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chkjawat.'">'.$roadworkUlas3.'</span></td></tr>';
$roadworkDraw3 = '';$roadworkUlas3 = '';

//4
$chknama='roadworkDraw4-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chknama'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $roadworkDraw4  = $row['new_value'];	} if (empty($roadworkDraw4)){$roadworkDraw4 = '<i>Klik2Edit</i>'; }
$chkjawat='roadworkUlas4-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chkjawat'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $roadworkUlas4  = $row['new_value'];	} if (empty($roadworkUlas4)){$roadworkUlas4 = '<i>Klik2Edit</i>'; }
echo '<tr><td bgcolor="#FFFFFF" width="50"  height="30" valign="top" style="align:center;padding-left: 15px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>4</b></td><td bgcolor="#FFFFFF" width="350" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chknama.'">'.$roadworkDraw4.'</span></td><td bgcolor="#FFFFFF" width="400" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chkjawat.'">'.$roadworkUlas4.'</span></td></tr>';
$roadworkDraw4 = '';$roadworkUlas4 = '';

//5
$chknama='roadworkDraw5-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chknama'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $roadworkDraw5  = $row['new_value'];	} if (empty($roadworkDraw5)){$roadworkDraw5 = '<i>Klik2Edit</i>'; }
$chkjawat='roadworkUlas5-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chkjawat'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $roadworkUlas5  = $row['new_value'];	} if (empty($roadworkUlas5)){$roadworkUlas5 = '<i>Klik2Edit</i>'; }
echo '<tr><td bgcolor="#FFFFFF" width="50"  height="30" valign="top" style="align:center;padding-left: 15px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>5</b></td><td bgcolor="#FFFFFF" width="350" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chknama.'">'.$roadworkDraw5.'</span></td><td bgcolor="#FFFFFF" width="400" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chkjawat.'">'.$roadworkUlas5.'</span></td></tr>';
$roadworkDraw5 = '';$roadworkUlas5 = '';

//6
$chknama='roadworkDraw6-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chknama'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $roadworkDraw6  = $row['new_value'];	} if (empty($roadworkDraw6)){$roadworkDraw6 = '<i>Klik2Edit</i>'; }
$chkjawat='roadworkUlas6-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chkjawat'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $roadworkUlas6  = $row['new_value'];	} if (empty($roadworkUlas6)){$roadworkUlas6 = '<i>Klik2Edit</i>'; }
echo '<tr><td bgcolor="#FFFFFF" width="50"  height="30" valign="top" style="align:center;padding-left: 15px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>6</b></td><td bgcolor="#FFFFFF" width="350" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chknama.'">'.$roadworkDraw6.'</span></td><td bgcolor="#FFFFFF" width="400" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chkjawat.'">'.$roadworkUlas6.'</span></td></tr>';
$roadworkDraw6 = '';$roadworkUlas6 = '';

//7
$chknama='roadworkDraw7-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chknama'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $roadworkDraw7  = $row['new_value'];	} if (empty($roadworkDraw7)){$roadworkDraw7 = '<i>Klik2Edit</i>'; }
$chkjawat='roadworkUlas7-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chkjawat'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $roadworkUlas7  = $row['new_value'];	} if (empty($roadworkUlas7)){$roadworkUlas7 = '<i>Klik2Edit</i>'; }
echo '<tr><td bgcolor="#FFFFFF" width="50"  height="30" valign="top" style="align:center;padding-left: 15px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>7</b></td><td bgcolor="#FFFFFF" width="250" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chknama.'">'.$roadworkDraw7.'</span></td><td bgcolor="#FFFFFF" width="400" style="align:center;padding-left: 5px;font-size:12px"><span id="'.$chkjawat.'">'.$roadworkUlas7.'</span></td></tr>';
$roadworkDraw7 = '';$roadworkUlas7 = '';

////////////////////////////////////////////////////////////
echo '</table> <BR>';

?>

<script type="text/javascript">
	
<?php
$setID = '$("#tajukprojek-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:60 });';

$setID .= '$("#roadworkDraw1-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });
$("#roadworkUlas1-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });';

$setID .= '$("#roadworkDraw2-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });
$("#roadworkUlas2-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });';

$setID .= '$("#roadworkDraw3-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });
$("#roadworkUlas3-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });';

$setID .= '$("#roadworkDraw4-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });
$("#roadworkUlas4-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });';

$setID .= '$("#roadworkDraw5-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });
$("#roadworkUlas5-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });';

$setID .= '$("#roadworkDraw6-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });
$("#roadworkUlas6-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });';

$setID .= '$("#roadworkDraw7-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });
$("#roadworkUlas7-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:40 });';

echo $setID;

	?>

</script>


</body>
</html>
<?php // Flush the buffered output to the Web browser.
ob_flush();
?>
