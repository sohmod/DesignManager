<?php 
ob_start();
session_start();
$ulasan = '' ;

include_once ('../../ip_SERVER.php');
include_once('../../'.PROJ_FOLDER.'/inc/mysql_connect2cfg.php');
require_once ('../../'.PROJ_FOLDER.'/mysql_connect.php'); // Connect to the database.

$hasSESSION=$_SESSION['daftar_id'];
if ($_SESSION['daftar_id']){
		$q = "select tajuk, OIC AS ppk, mod_kerja from daftar_projek 
			where daftar_id = '$hasSESSION'";
		$r = mysql_query ($q);
		while ($tna = mysql_fetch_array ($r)) {
		$_SESSION['tajuk'] = $tna[0];
		$_SESSION['ppk'] = $tna[1];
		$_SESSION['mod_kerja'] = $tna[2];		

		ob_end_clean(); // Delete the buffer.
 }}
 mysql_close();
 
 ?>
 
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>	
	<title>eggBlog - Data4Gmap</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="content-style-type" content="text/css" />
	<meta name="description" content="an eggBlog with checklists for civil engineering students, intro to infra works i.e. earthworks, hydrology basin, road networks, water problem, wastewater cum structural, geotechnical, installed as web applications to manage activities at design & construction stages" />
	<meta name="keywords" content="engineering, civil, infra, earthworks, hydrology, drainage, roads, watersupply, reticulation, sewerage, STP, mysql, php, eip, jeip, tcpdf, blog, free, software, open, download" />
	<!--META name="y_key" content="371e5c105efa0ea9"-->
	<!--link rel="icon" href="../../themes/default/favicon.ico" type="image/x-icon" /-->

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
	</style>
	

	
		<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="js/jeip.js"></script>
		<!--script type="text/javascript" src="jonathanleighton/jquery.date_input.js"></script>
		<link rel="stylesheet" href="jonathanleighton/date_input.css" type="text/css">
		
		<script src="brandonaaron/jquery.livequery.js" type="text/javascript" charset="utf-8"></script>
		
		<script type="text/javascript" charset="utf-8">

			$($.date_input.initialize);
			$(function() { 
							$("#my_specific_input").date_input();
							$(".jeip-date_input")
								.livequery(function(){
								$( this ).date_input();
							});
						});
		</script--> 
<fieldset> <small> <center>
<a href="<?php echo "http://".$ipthis."/".PROJ_FOLDER."/projek_daftar.php?event=Pinda";?>">Daftar</a> |
<a href="<?php echo "http://".$ipthis."/".PROJ_FOLDER."/projek_Dplan.php?event=Pinda";?>">D-Plan</a> |
<!--a href="<?php echo "projek_Perunding.php?event=Pinda";?>">Perunding</a> |-->
<a href="<?php echo "http://".$ipthis."/".PROJ_FOLDER."/projek_butiran.php?event=Pinda";?>"-->Butiran</a> |

<!--a href="<?php echo "projek_sivil.php?event=Pinda";?>">Kerja sivil</a> |
<a href="<?php echo "projek_status.php?event=Pinda";?>">Status</a> | -->
<!--a href="<?php echo "http://".$ipthis."/_bka/editinPlacejQuery/kemajuanRB.php?bka=".$_SESSION['daftar_id'] ;?>"--><font color="green" size="2em" style="text-decoration:none">KemajuanRB</font><!--/a--> | 

<!--a href="<?php echo "projek_senarai.php?order={$_SESSION['ppk']}";?>">Senarai</a> |-->
<a href="<?php echo "http://".$ipthis."/_bka/editinPlacejQuery/ulasanTeknikal_general.php" ;?>">U.Teknikal</a> |
<a href="<?php echo "http://".$ipthis."/_bka/editinPlace050/penilaian_kriteria_earthwork.php" ;?>">P.Tender</a> |
<a href="<?php echo "http://".$ipthis."/_bka/editinPlace050/NeedsStatement.php" ;?>">N.S.</a> |
<a href="<?php echo "http://".$ipthis."/_bka/liveforms/MyBulkDrawings11.php" ;?>">D.Lukisan</a>
</center> </small> </fieldset>		
<?php

//$bkaHost  $bkaULogin  $bkaPass $bkaDbase
$db=mysql_connect($bkaHost,$bkaULogin,$bkaPass) or die(mysql_error());
mysql_select_db($bkaDbase) or die(mysql_error());
 
$bilcol =2; $widtbl=200 + 150 + 300;
$tjk_projek=$_SESSION['tajuk'];	$modus=$_SESSION['mod_kerja'];$chk_id=$_SESSION['daftar_id'];
if (!$_SESSION['daftar_id']){ $tjk_projek='Projek Dummi .. '; $chk_id=7654321; $modus='Inhouse'; $kp_s=="123456-78-9012"; }

echo $ulasan . '	

</head>
<body>
<table width="'.$widtbl.'" border="1" align="center" cellpadding="-1" cellspacing="0" bordercolor="#E4E4E4" >';

echo '<div align="center"><span>
Tajuk projek:>&nbsp;:&nbsp;&nbsp;&nbsp; <b><font color="darkblue" style="font-size:14">'.$tjk_projek.'</font></b><br/>
<font color="gray">JEIP -</font>
<font color="red">&nbsp;&nbsp;DATA4GMAP</font>
<font color="gray">&nbsp;&nbsp;Job no:>&nbsp;'.$chk_id.'</font>
<br/>

<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/kemajuanRB.php"><font color="green" size="2em" style="text-decoration:none">KemajuanRB</font></a>
&nbsp;:&nbsp;&nbsp;&nbsp;

<!--a href="http://'.$ipthis.'/_bka/editinPlacejQuery/pelantapak.php"><font color="green" size="2em" style="text-decoration:none"-->Data4Gmap<!--/font></a-->
&nbsp;:&nbsp;&nbsp;&nbsp;

<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/gm_meydaucl.html"><font color="green" size="2em" style="text-decoration:none">View Map</font></a>
&nbsp;:&nbsp;&nbsp;&nbsp;

<!--a href="http://'.PROJ_FOLDER.'/pdf/tcpdf_3_0_006/examples/bka_L-A4_markahteknikal.php"><font color="green" size="2em" style="text-decoration:none">PDF_A4L</font></a>
&nbsp;:&nbsp;&nbsp;&nbsp;

<a href="http://'.PROJ_FOLDER.'/pdf/tcpdf_3_0_006/examples/bka_L-A3_markahteknikal.php"><font color="green" size="2em" style="text-decoration:none">PDF_A3L</font></a-->  <br/><br/>
</span></div>';


//<!-----------------s--Maklumat--s---------------->
echo '<tr>
<td bgcolor="#FFFFF" height="20" width="100" style="align:left;padding-left: 20px;font-size:15px">=||=</td>
<td bgcolor="#FFFFF" width="275"  style="align:center;padding-left: 10px;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;font-size:15px">
Latitude:<br/><small><i>( 1.0 @S ; 6.0 @N )</i></small>
</td>
<td bgcolor="#FFFFF" width="275"  style="align:center;padding-left: 10px;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;font-size:15px">
Longitude:<br/><small><i>( 103-104 @S ; 99-102 @N )</i></small>
</td>
</tr>';



echo '<tr><td bgcolor="#FFFFFF" height="40" width="200" style="align:left;padding-left: 20px;font-size:14px">Coordinate : </td>';
for ($j=1;$j<=$bilcol;$j++){ 
$chk='latNE'.$j.'-'.$chk_id;
	$result=mysql_query("SELECT new_value FROM susunatur where id='$chk'") or die ('Error performing query');
    while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$latNE  = $row['new_value'];	}
if (empty($latNE) && $j==1){$latNE = 'lat_empty'; }
if (empty($latNE) && $j==2){$latNE = 'lon_empty'; }
echo '<td bgcolor="#FFFFFF" width="' . $j*150 . '"  style="align:center;padding-left: 10px;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;font-size:12px">
<span id="latNE'.$j.'-'.$chk_id.'">'.$latNE.'</span></td>';
$latNE = '';
} echo '</tr>';

/*echo '<tr><td bgcolor="#FFFFFF" height="40" width="200" style="align:left;padding-left: 20px;font-size:14px">SW</td>';
for ($j=1;$j<=$bilcol;$j++){ 
$chk='latSW'.$j.'-'.$chk_id;
	$result=mysql_query("SELECT new_value FROM susunatur where id='$chk'") ;
    while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$latSW  = $row['new_value'];	}
if (empty($latSW) && $j==1){$latSW = 'lat_empty'; }
if (empty($latSW) && $j==2){$latSW = 'lon_empty'; }
echo '<td bgcolor="#FFFFFF" width="' . $j*150 . '"  style="align:center;padding-left: 10px;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;font-size:12px"><span id="latSW'.$j.'-'.$chk_id.'">'.$latSW.'</span></td>';
$latSW = '';
} echo '</tr>';*/


// to paste 'pelantapak_midbody' here


////////////////////////////////////////////////////////////
echo '</table> <BR>';

?>

<script type="text/javascript">
	
<?php

//$chk_id=$_SESSION['daftar_id'];
//if (!$_SESSION['daftar_id']){$chk_id=987654;}

for ($j=1;$j<=$bilcol;$j++){ 

// latSW	lonSW	latNE	lonNE	imagessa

echo '			
	$("#latSW'.$j.'-'.$chk_id.'").eip("save_pelantapak.php", { form_type: "textarea", max_rows:'. $j*2 .', cols:'. $j*16 .' });
	$("#lonSW'.$j.'-'.$chk_id.'").eip("save_pelantapak.php", { form_type: "textarea", max_rows:'. $j*2 .', cols:'. $j*16 .' });
	$("#latNE'.$j.'-'.$chk_id.'").eip("save_pelantapak.php", { form_type: "textarea", max_rows:'. $j*2 .', cols:'. $j*16 .' }); 
	$("#lonNE'.$j.'-'.$chk_id.'").eip("save_pelantapak.php", { form_type: "textarea", max_rows:'. $j*2 .', cols:'. $j*16 .' });
	$("#imagessa'.$j.'-'.$chk_id.'").eip("save_pelantapak.php", { form_type: "textarea", max_rows:'. $j*2 .', cols:'. $j*16 .' });
	$("#photoI'.$j.'-'.$chk_id.'").eip("save_pelantapak.php", { form_type: "textarea", max_rows:'. $j*2 .', cols:'. $j*16 .' }); 	
	$("#photoII'.$j.'-'.$chk_id.'").eip("save_pelantapak.php", { form_type: "textarea", max_rows:'. $j*2 .', cols:'. $j*16 .' });
	$("#photoIII'.$j.'-'.$chk_id.'").eip("save_pelantapak.php", { form_type: "textarea", max_rows:'. $j*2 .', cols:'. $j*16 .' });	
			';
		}
	
	?>

</script>


</body>
</html>
<?php // Flush the buffered output to the Web browser.
ob_flush();
?>
