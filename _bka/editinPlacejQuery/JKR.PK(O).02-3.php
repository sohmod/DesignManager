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
	<title>eggBlog - _pkO_02_tiga</title>
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


$spk = '<table width="800" border="1" align="center" cellpadding="-1" cellspacing="0" bordercolor="#E4E4E4" ><tr><td colspan="3"  width="750" bgcolor="#FFFFFF" height="40" style="align:center;padding-left: 5px;font-size:12px"><b>A. KEPERLUAN PINDAAN REKABENTUK ( disediakan oleh HODT/ WPP/ WPD )</b></td></tr>';


$localLink = '<div align="center"><span>
 Tajuk projek:>&nbsp;:&nbsp;&nbsp;&nbsp; <b><font color="darkblue" style="font-size:14">'.$tjk_projek.'</font></b><br/>
<font color="gray">EIP - Borang JKR.PK(O).02-3 Kerja Sivil : </font><font color="red">PINDAAN REKABENTUK</font><font color="green">&nbsp;&nbsp;Job no:>'.$chk_id.'</font><br/>

<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/JKR.PK(O).02-2_msbka.php"><font color="blue" size="2em" style="text-decoration:none">link: JKR.PK(O).02-2or4</font></a>

&nbsp;:&nbsp;&nbsp;&nbsp;
<a href="http://'.$ipthis.'/pdf/tcpdf_4_7_003/examples/_JKR.PK(O).02-3_JQ.php"><font color="black" size="2em" style="text-decoration:none">print: PDF_A4</font></a>';

echo $localLink . $spk;

$chk='tajukprojek-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chk'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $tajukprojek  = $row['new_value'];	} if (empty($tajukprojek)){$tajukprojek = '<i>Klik2Edit</i>'; }
echo '<tr><td colspan="3" bgcolor="#FFFFFF" width="750" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>TAJUK PROJEK : </b>&nbsp;&nbsp;&nbsp;<span id="'.$chk.'">'.$tajukprojek.'</span></td></tr>';
$tajukprojek = '';

$noprojek='noprojek-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$noprojek'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $noprojek9  = $row['new_value'];	} if (empty($noprojek9)){$noprojek9 = '<i>Klik2Edit</i>'; }
$nofail='nofail-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$nofail'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $nofail9  = $row['new_value'];	} if (empty($nofail9)){$nofail9 = '<i>Klik2Edit</i>'; }
$Tarikh='Tarikh-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$Tarikh'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $Tarikh9  = $row['new_value'];	} if (empty($Tarikh9)){$Tarikh9 = '<i>Klik2Edit</i>'; }
$NoPermohonan='NoPermohonan-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$NoPermohonan'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $NoPermohonan9  = $row['new_value'];	} if (empty($NoPermohonan9)){$NoPermohonan9 = '<i>Klik2Edit</i>'; }

echo '<tr><td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>No. Projek/Ruj.Fail:&nbsp;</b><br/>&nbsp;&nbsp;&nbsp;<span id="'.$noprojek.'">'.$noprojek.'</span>  &nbsp;&nbsp;/&nbsp;&nbsp;<span id="'.$nofail.'">'.$nofail9.'</span></td>

<td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">Tarikh:<br/>&nbsp;&nbsp;&nbsp;<span id="'.$Tarikh.'">'.$Tarikh9.'</span></td>

<td bgcolor="#FFFFFF" width="250" valign="top" style="align:center;padding-left: px;font-size:12px;padding-top: 5px;padding-bottom: 5px">No Permohonan:<br/>&nbsp;&nbsp;&nbsp;<span id="'.$NoPermohonan.'">'.$NoPermohonan9.'</span></td>

</tr>';
$noprojek9 = '';$nofail9 = '';$Tarikh9 = '';$NoPermohonan9 = '';


$chk='SkopKerja-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chk'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $SkopKerja  = $row['new_value'];	} if (empty($SkopKerja)){$SkopKerja = '<i>Klik2Edit</i>'; }
echo '<tr><td colspan="3" bgcolor="#FFFFFF" width="750" valign="top" style="align:left;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>Skop Kerja<br/>Jalan / Jambatan / Cerun/ Sivil/ Struktur/ Bekalan Air/ Arkitek/ Mekanikal/ Elektrikal/dan lainlain(
nyatakan) (*)</b><br/>&nbsp;&nbsp;&nbsp;<span id="'.$chk.'">'.$SkopKerja.'</span></td></tr>';
$SkopKerja = '';


$chknama='Kategori-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chknama'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $Kategori  = $row['new_value'];	} if (empty($Kategori)){$Kategori = '<i>Klik2Edit</i>'; }
echo '<tr><td colspan="3" bgcolor="#FFFFFF" width="750" valign="top" style="align:left;padding-left: 5px;font-size:12px;padding-top: 5px;padding-bottom: 5px"><b>Kategori Pindaan/Perubahan: Rekabentuk/ Spesifikasi/ Bahan Binaan / lain-lain(*)</b><br/>&nbsp;&nbsp;&nbsp;<span id="'.$chknama.'">'.$Kategori.'</span></td></tr>';
$Kategori = '';

$chknama='Deskripsi-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chknama'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $Deskripsi  = $row['new_value'];	} if (empty($Deskripsi)){$Deskripsi = '<i>Klik2Edit</i>'; }
echo '<tr><td colspan="3" bgcolor="#FFFFFF" width="750" style="align:center;padding-left: 5px;font-size:12px"><b>Deskripsi perubahan kerja yang terlibat: (Lampiran tambahan jika perlu)</b><br/>&nbsp;&nbsp;&nbsp;<span id="'.$chknama.'">'.$Deskripsi.'</span></td></tr>';
$Deskripsi = '';

//3
$chknama='Justifikasi-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chknama'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $Justifikasi  = $row['new_value'];	} if (empty($Justifikasi)){$Justifikasi = '<i>Klik2Edit</i>'; }
echo '<tr><td colspan="3" bgcolor="#FFFFFF" width="750" style="align:center;padding-left: 5px;font-size:12px"><b>Justifikasi perubahan:(Lampiran tambahan jika perlu)<br/>Keperluan pelanggan/ Masalah tapak/ Penambahbaikan rekabentuk/ lain-lain ...</b><br/>&nbsp;&nbsp;&nbsp;<span id="'.$chknama.'">'.$Justifikasi.'</span></td></tr>';
$Justifikasi = '';

//4
$chknama='NoLukisan-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chknama'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $NoLukisan  = $row['new_value'];	} if (empty($NoLukisan)){$NoLukisan = '<i>Klik2Edit</i>'; }
echo '<tr><td colspan="3" bgcolor="#FFFFFF" width="750" style="align:center;padding-left: 5px;font-size:12px"><b>No. Lukisan(semua lukisan berkaitan)/ Spesifikasi:( Lampiran tambahan bila perlu)</b><br/>&nbsp;&nbsp;&nbsp;<span id="'.$chknama.'">'.$NoLukisan.'</span></td></tr>';
$NoLukisan = '';

//5
$chknama='PERSETUJUAN-'.$chk_id; $result=mysql_query("SELECT new_value FROM jkr_pko_02_dua where id='$chknama'") or die ('Error performing query'); while($row=mysql_fetch_array($result, MYSQL_ASSOC)){ $PERSETUJUAN  = $row['new_value'];	} if (empty($PERSETUJUAN)){$PERSETUJUAN = '<i>Klik2Edit</i>'; }
echo '
<tr><td colspan="3" bgcolor="#FFFFFF" style="align:center;padding-left: 5px;font-size:12px"><b>B. PERSETUJUAN PINDAAN REKABENTUK (untuk kegunaan diperingkat rekabentuk sahaja)</b></td></tr>
<tr><td colspan="3" bgcolor="#FFFFFF" width="750" style="align:center;padding-left: 5px;font-size:12px">&nbsp;&nbsp;&nbsp;[ ]&nbsp;&nbsp;<span id="'.$chknama.'">'.$PERSETUJUAN.'</span></td></tr>';
$PERSETUJUAN = '';

////////////////////////////////////////////////////////////
echo '</table> <BR>';

?>

<script type="text/javascript">
	
<?php
$setID = '$("#tajukprojek-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:2, cols:60 });';

$setID .= '$("#noprojek-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:1, cols:20 });';

$setID .= '$("#nofail-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:1, cols:20 });';

$setID .= '$("#NoPermohonan-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:1, cols:20 });';

$setID .= '$("#SkopKerja-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:1, cols:80 });';

$setID .= '$("#Tarikh-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:1, cols:20 });';

$setID .= '$("#Kategori-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:1, cols:80 });';

$setID .= '$("#Deskripsi-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:1, cols:80 });';

$setID .= '$("#Justifikasi-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:1, cols:80 });';

$setID .= '$("#NoLukisan-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "textarea", max_rows:1, cols:80 });';

$setID .= '$("#PERSETUJUAN-'.$chk_id.'").eip("save_jkr_pkO_02_dua.php", { form_type: "select",
		select_options: {
			0	: "",
			1	: "Dipersetujui",
			2	: "Dipersetujui dengan syarat",
			3	: "Tidak dipersetujui"}
			});';

echo $setID;

	?>

</script>


</body>
</html>
<?php // Flush the buffered output to the Web browser.
ob_flush();
?>
