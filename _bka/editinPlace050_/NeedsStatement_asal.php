<?php 
ob_start();
session_start();
$ulasan = '';

include_once ('../../ip_SERVER.php');
include_once('../../'.PROJ_FOLDER.'/inc/mysql_connect2cfg.php');
require_once ('../../'.PROJ_FOLDER.'/mysql_connect.php'); // Connect to the database.
require ("inc/proj_kriteria_pnilaian_tech_cfg.php");


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
 
 ?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>	
	<title>eggBlog - ns</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="content-style-type" content="text/css" />
	<meta name="description" content="an eggBlog with checklists for civil engineering students, intro to infra works i.e. earthworks, hydrology basin, road networks, water problem, wastewater cum structural, geotechnical, installed as web applications to manage activities at design & construction stages" />
	<meta name="keywords" content="engineering, civil, infra, earthworks, hydrology, drainage, roads, watersupply, reticulation, sewerage, STP, mysql, php, eip, jeip, tcpdf, blog, free, software, open, download" />
	<META name="y_key" content="371e5c105efa0ea9">
	<link rel="icon" href="../../themes/default/favicon.ico" type="image/x-icon" />
		
    <style type="text/css">
        .eip_savebutton {height:15px; background-color: #36f; color: #fff; font-size: 9px;font-weight: bold;}
        .eip_cancelbutton {height:15px; background-color: #000; color: #fff; font-size: 9px;font-weight: bold;}
        .eip_saving { background-image: url('ajax-loader.gif'); background-repeat: no-repeat; background-position: left; color: #903; padding: 0 0 0 20px; }
        .eip_empty { color: #afafaf; border: 1px solid #afafaf; padding: 3px;}
        .eip_editfield { background-color: #ff9; }
	a:hover {
	color: #C30;
	text-decoration: none;
	background-color: #00ff00;
			}			
    </style>	
    <script type="text/javascript" src="prototype.js"></script>
    <script type="text/javascript" src="editinplace.js"></script>

<fieldset> <small> <center>
<a href="<?php echo "http://".$ipthis."/".PROJ_FOLDER."/projek_daftar.php?event=Pinda";?>">Daftar</a> |
<a href="<?php echo "http://".$ipthis."/".PROJ_FOLDER."/projek_Dplan.php?event=Pinda";?>">D-Plan</a> |
<!--a href="<?php echo "projek_Perunding.php?event=Pinda";?>">Perunding</a> |-->
<a href="<?php echo "http://".$ipthis."/".PROJ_FOLDER."/projek_butiran.php?event=Pinda";?>"-->Butiran</a> |

<!--a href="<?php echo "projek_sivil.php?event=Pinda";?>">Kerja sivil</a> |
<a href="<?php echo "projek_status.php?event=Pinda";?>">Status</a> | -->
<a href="<?php echo "http://".$ipthis."/_bka/editinPlacejQuery/kemajuanRB.php";?>"><font color="green" size="2em" style="text-decoration:none">KemajuanRB</font></a> | 

<!--a href="<?php echo "projek_senarai.php?order={$_SESSION['ppk']}";?>">Senarai</a> |-->
<a href="<?php echo "http://".$ipthis."/_bka/editinPlacejQuery/ulasanTeknikal_general.php" ;?>">U.Teknikal</a> |
<a href="<?php echo "http://".$ipthis."/_bka/editinPlace050/penilaian_kriteria_earthwork.php" ;?>">P.Tender</a> |
<!--a href="<?php echo "http://".$ipthis."/_bka/editinPlace050/NeedsStatement.php" ;?>"-->N.S.<!--/a--> |
<a href="<?php echo "http://".$ipthis."/_bka/liveforms/MyBulkDrawings11.php" ;?>">D.Lukisan</a>
</center> </small> </fieldset>			
		
<?php

//$db=mysql_connect($ajaxHost,$ajaxULogin,$ajaxPass) or die('Error connecting to the server');
//      mysql_select_db($ajaxDbase) or die('Error selecting database');

$db=mysql_connect($ajaxHost,$ajaxULogin,$ajaxPass) or die(mysql_error());
      mysql_select_db($ajaxDbase) or die(mysql_error());

	  
$bilPetender = $_SESSION['bilPetender'];
if ($_SESSION['bilPetender']>15){$bilPetender = 15; }
$chk_id=$_SESSION['daftar_id'];
if (!$_SESSION['daftar_id']){$chk_id=7654321;$bilPetender =2;$username='public';$kp='123456-78-9012';}

$widtbl=700;
echo '	
</head>
<body>
<table width="'.$widtbl.'" border="1" align="center" cellpadding="-1" cellspacing="0" bordercolor="#E4E4E4" >';

echo '<div align="center"><span>
Tajuk projek:>&nbsp;:&nbsp;&nbsp;&nbsp; <b><font color="darkblue" style="font-size:14">'.$_SESSION['tajuk'].'</font></b><br/>
<font color="gray">Edit In Place - <b>SKOP</b> Kerja Sivil : </font>&nbsp;&nbsp;<font color="red">NEEDS STATEMENT</font>&nbsp;&nbsp;&nbsp;<font color="green">Job no:>'.$_SESSION['daftar_id'].'</font>
<br/>

<a href="http://'.$ipthis.'/pdf/tcpdf_3_0_006/examples/bka_needstatement_v0608.php"><font color="black" size="2em" style="text-decoration:none">print: pdf_A4P</font></a>
</span></div>';




//<!-----------------s--ulasan--s---------------->

echo '<tr>
<td bgcolor="#FFFFFF" height="40" width="100" align="center" style="align:center;padding-left: 2px;font-size:12px">Earthworks</td>
<td bgcolor="#FFFFFF" height="40" width="100" align="center" style="align:center;padding-left: 2px;font-size:12px">Drainage</td>
<td bgcolor="#FFFFFF" height="40" width="100" align="center" style="align:center;padding-left: 2px;font-size:12px">Roadworks</td>
<td bgcolor="#FFFFFF" height="40" width="100" align="center" style="align:center;padding-left: 2px;font-size:12px">Water Supply</td>
<td bgcolor="#FFFFFF" height="40" width="100" align="center" style="align:center;padding-left: 2px;font-size:12px">Sewerage</td>
<td bgcolor="#FFFFFF" height="40" width="100" align="center" style="align:center;padding-left: 2px;font-size:12px">Waste Disposal</td>
<td bgcolor="#FFFFFF" height="40" width="100" align="center" style="align:center;padding-left: 2px;font-size:12px">Fencing & Gates</td>
</tr><tr>';

$chk='earthwork#'.$chk_id;
	$result=mysql_query("SELECT new_content FROM kriteria where id='$chk'") or die ('Error performing query');
    while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$earthwork  = $row['new_content'];	}
echo '<td bgcolor="#FFFFFF" height="30" style="align:center;padding-left: 15px;font-size:12px">
<span id="earthwork#'.$chk_id.'">'.$earthwork.'</span></td>';

$chk='drainage#'.$chk_id;
	$result=mysql_query("SELECT new_content FROM kriteria where id='$chk'") or die ('Error performing query');
    while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$drainage  = $row['new_content'];	}
echo '<td bgcolor="#FFFFFF" height="30" style="align:center;padding-left: 15px;font-size:12px">
<span id="drainage#'.$chk_id.'">'.$drainage.'</span></td>';

$chk='roadworks#'.$chk_id;
	$result=mysql_query("SELECT new_content FROM kriteria where id='$chk'") or die ('Error performing query');
    while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$roadworks  = $row['new_content'];	}
echo '<td bgcolor="#FFFFFF" height="30" style="align:center;padding-left: 15px;font-size:12px">
<span id="roadworks#'.$chk_id.'">'.$roadworks.'</span></td>';

$chk='watersupply#'.$chk_id;
	$result=mysql_query("SELECT new_content FROM kriteria where id='$chk'") or die ('Error performing query');
    while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$watersupply  = $row['new_content'];	}
echo '<td bgcolor="#FFFFFF" height="30" style="align:center;padding-left: 15px;font-size:12px">
<span id="watersupply#'.$chk_id.'">'.$watersupply.'</span></td>';

$chk='sewerage#'.$chk_id;
	$result=mysql_query("SELECT new_content FROM kriteria where id='$chk'") or die ('Error performing query');
    while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$sewerage  = $row['new_content'];	}
echo '<td bgcolor="#FFFFFF" height="30" style="align:center;padding-left: 15px;font-size:12px">
<span id="sewerage#'.$chk_id.'">'.$sewerage.'</span></td>';

$chk='wastedisposal#'.$chk_id;
	$result=mysql_query("SELECT new_content FROM kriteria where id='$chk'") or die ('Error performing query');
    while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$wastedisposal  = $row['new_content'];	}
echo '<td bgcolor="#FFFFFF" height="30" style="align:center;padding-left: 15px;font-size:12px">
<span id="wastedisposal#'.$chk_id.'">'.$wastedisposal.'</span></td>';

$chk='fencingates#'.$chk_id;
	$result=mysql_query("SELECT new_content FROM kriteria where id='$chk'") or die ('Error performing query');
    while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$fencingates  = $row['new_content'];	}
echo '<td bgcolor="#FFFFFF" height="30" style="align:center;padding-left: 15px;font-size:12px">
<span id="fencingates#'.$chk_id.'">'.$fencingates.'</span></td>';


echo '</tr>';





////////////////////////////////////////////////////////////
echo '
<!----------------------------------------->
<!---//////////////--><!---//////////////-->
</table> <BR>';


?>


<script type="text/javascript">
	EditInPlace.defaults['save_url'] = 'save_kriteria.php';
	
<?php

$chk_id=$_SESSION['daftar_id'];
if (!$_SESSION['daftar_id']){$chk_id=7654321;}



//echo " $('JumlahBesar#".$chk_id."').editInPlace();"; 	
//echo " $('PeratusAwam#".$chk_id."').editInPlace();"; 
	
	echo " 
	$('earthwork#".$chk_id."').editInPlace({	form_type: 'select',select_options: { '0':'Ada','1':'Tiada'}});
	$('drainage#".$chk_id."').editInPlace({	form_type: 'select',select_options: { '0':'Ada','1':'Tiada'}});
	$('roadworks#".$chk_id."').editInPlace({	form_type: 'select',select_options: { '0':'Ada','1':'Tiada'}});
	$('watersupply#".$chk_id."').editInPlace({	form_type: 'select',select_options: { '0':'Ada','1':'Tiada'}});
	$('sewerage#".$chk_id."').editInPlace({	form_type: 'select',select_options: { '0':'Ada','1':'Tiada'}});
	$('wastedisposal#".$chk_id."').editInPlace({	form_type: 'select',select_options: { '0':'Ada','1':'Tiada'}});
	$('fencingates".$j."#".$chk_id."').editInPlace({	form_type: 'select',select_options: { '0':'Ada','1':'Tiada'}});
	";
	
	
	


	?>

</script>


</body>
</html>
<?php // Flush the buffered output to the Web browser.
ob_flush();
?>
