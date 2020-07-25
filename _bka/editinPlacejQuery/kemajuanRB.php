<?php 
ob_start();
session_start();
$ulasan = '' ;

include_once ('../../ip_SERVER.php');
include_once('../../'.PROJ_FOLDER.'/inc/mysql_connect2cfg.php');
require_once ('../../'.PROJ_FOLDER.'/mysql_connect.php'); // Connect to the database.




$hasSESSION=$_SESSION['daftar_id'];
if ($_SESSION['daftar_id']){
		$q = "select tajuk, OIC AS ppk, mod_kerja from daftar_projek where daftar_id = '$hasSESSION'";
		$r = mysql_query ($q) ;
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
	<title>kemajuanRB</title>
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
<!--a href="<?php echo "http://".$ipthis."/_bka/editinPlacejQuery/kemajuanRB.php";?>"><font color="green" size="2em" style="text-decoration:none"-->KemajuanRB<!--/font></a--> | 

<!--a href="<?php echo "projek_senarai.php?order={$_SESSION['ppk']}";?>">Senarai</a> |-->
<a href="<?php echo "http://".$ipthis."/_bka/editinPlacejQuery/ulasanTeknikal_general.php" ;?>">U.Teknikal</a> |
<a href="<?php echo "http://".$ipthis."/_bka/editinPlace050/penilaian_kriteria_earthwork.php" ;?>">P.Tender</a> |
<a href="<?php echo "http://".$ipthis."/_bka/editinPlace050/NeedsStatement.php" ;?>">N.S.</a> |
<a href="<?php echo "http://".$ipthis."/_bka/liveForms/MyBulkDrawings11.php" ;?>">D.Lukisan</a>
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
<font color="red">&nbsp;&nbsp;Kemajuan Kerja Sivil</font>
<font color="gray">&nbsp;&nbsp;Job no:>&nbsp;'.$chk_id.'</font>
<br/>

<!--a href="http://'.$ipthis.'/_bka/editinPlacejQuery/kemajuanRB.php"><font color="green" size="2em" style="text-decoration:none"-->KemajuanRB<!--/font></a-->
&nbsp;:&nbsp;&nbsp;&nbsp;

<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/pelantapak.php"><font color="green" size="2em" style="text-decoration:none">Data4Gmap</font></a>
&nbsp;:&nbsp;&nbsp;&nbsp;';

//<a href="http://'.PROJ_FOLDER.'/pdf/tcpdf_3_0_006/examples/bka_L-A4_markahteknikal.php"><font color="green" size="2em" style="text-decoration:none">PDF_A4L</font></a>&nbsp;:&nbsp;&nbsp;&nbsp;

//<a href="http://'.PROJ_FOLDER.'/pdf/tcpdf_3_0_006/examples/bka_L-A3_markahteknikal.php"><font color="green" size="2em" style="text-decoration:none">PDF_A3L</font></a>  <br/><br/></span></div>';


//<!-----------------s--Maklumat--s---------------->
echo '<tr>
<td bgcolor="#FFFFF" height="20" width="200" style="align:left;padding-left: 20px;font-size:15px">Perkara:</td>
<td bgcolor="#FFFFF" width="150"  style="align:center;padding-left: 10px;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;font-size:15px">
Tarikh:<br/><small><i>( format 01/12/2015 )</i></small>
</td>
<td bgcolor="#FFFFF" width="300"  style="align:center;padding-left: 10px;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;font-size:15px">
Peristiwa / maklumat :
</td>
</tr>';

echo '<tr>
<td height="40" width="200" style="align:left;padding-left: 20px;font-size:16px;font-weight:bold">
<a href="http://'.$ipthis.'/_bka/editinPlacejQuery/cartakemajuanRM11.php" style="text-decoration: none;">
Kemajuan :</a>
</td>';
for ($j=1;$j<=$bilcol;$j++){ 
$chk='kemajuan'.$j.'-'.$chk_id;
	$result=mysql_query("SELECT new_value FROM perancangan where id='$chk'") or die ('Error performing query');
    while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$kemajuan  = $row['new_value'];	}
if (empty($kemajuan) && $j==1){$kemajuan = 'dateempty'; }
if (empty($kemajuan) && $j==2){$kemajuan = 'textempty'; }
echo '<td width="' . $j*150 . '"  style="background: white url(../../bground/gn_cloth.jpg) repeat center; align:center;padding-left: 10px;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;font-size:14px;font-weight:bold">
<span id="kemajuan'.$j.'-'.$chk_id.'">'.$kemajuan.'</span></td>';
$kemajuan = '';
} echo '</tr>';


// to paste 'kemajuanRB_midbody' here


////////////////////////////////////////////////////////////
echo '</table> <BR>';


?>

<script type="text/javascript">
	
<?php

//$chk_id=$_SESSION['daftar_id'];
if (!$_SESSION['daftar_id']){ $tjk_projek='Projek Dummi .. '; $chk_id=7654321; $modus='Inhouse'; $kp_s=="123456-78-9012"; }

for ($j=1;$j<=$bilcol;$j++){ 

if ($j==1){
$setkemajuan = '$("#kemajuan'.$j.'-'.$chk_id.'").eip("save_kemajuanRB.php", { form_type: "textarea", max_rows:'. $j*2 .', cols:'. $j*16 .' });';
} 
else
{
$setkemajuan = '$("#kemajuan'.$j.'-'.$chk_id.'").eip("save_kemajuanRB.php", { form_type: "select",
		select_options: {
			brief			: "brief",
			dplan			: "dplan",
			pelanukur		: "pelanukur",
			pelansusunatur	: "pelansusunatur",
			NSorTOR			: "NSorTOR",
			lawatapak		: "lawatapak",
			surat2pberkuasa	: "surat2pberkuasa",			
			konsepRB		: "konsepRB",
			RBawalan		: "RBawalan",
			RBterperinci	: "RBterperinci",
			varifikasiRB	: "varifikasiRB",
			auditRB			: "auditRB",
			TTD				: "TTD",
			tender			: "tender",
			pnilaianTeknikal : "pnilaianTeknikal",
			pranego			: "pranego",
			nego			: "nego",
			LA				: "LA",
			miliktapak		: "miliktapak",
			pembinaan		: "pembinaan",
			auditpembinaan	: "validasiRB",			
			tambahmasa		: "tambahmasa",
			serahan			: "serahan",
			tempohkecacatan	: "tempohkecacatan",
			KIV				: "KIV",
			statustakjelas	: "statustakjelas",
			sifar			: ""}
			});	';
			}


echo $setkemajuan;
/* . '			
	$("#NoFailHOPT'.$j.'-'.$chk_id.'").eip("save_kemajuanRB.php", { form_type: "textarea", max_rows:'. $j*2 .', cols:'. $j*16 .' });
	$("#kementerian'.$j.'-'.$chk_id.'").eip("save_kemajuanRB.php", { form_type: "textarea", max_rows:'. $j*2 .', cols:'. $j*16 .' });
	$("#siling'.$j.'-'.$chk_id.'").eip("save_kemajuanRB.php", { form_type: "textarea", max_rows:'. $j*2 .', cols:'. $j*16 .' }); 
	$("#tajukProj'.$j.'-'.$chk_id.'").eip("save_kemajuanRB.php", { form_type: "textarea", max_rows:'. $j*2 .', cols:'. $j*16 .' });
	$("#hopt'.$j.'-'.$chk_id.'").eip("save_kemajuanRB.php", { form_type: "textarea", max_rows:'. $j*2 .', cols:'. $j*16 .' });
	$("#Senibina'.$j.'-'.$chk_id.'").eip("save_kemajuanRB.php", { form_type: "textarea", max_rows:'. $j*2 .', cols:'. $j*16 .' }); 	
	$("#Struktur'.$j.'-'.$chk_id.'").eip("save_kemajuanRB.php", { form_type: "textarea", max_rows:'. $j*2 .', cols:'. $j*16 .' });
	$("#Mekanikal'.$j.'-'.$chk_id.'").eip("save_kemajuanRB.php", { form_type: "textarea", max_rows:'. $j*2 .', cols:'. $j*16 .' });
	$("#Elektrikal'.$j.'-'.$chk_id.'").eip("save_kemajuanRB.php", { form_type: "textarea", max_rows:'. $j*2 .', cols:'. $j*16 .' }); 
	$("#UkurBahan'.$j.'-'.$chk_id.'").eip("save_kemajuanRB.php", { form_type: "textarea", max_rows:'. $j*2 .', cols:'. $j*16 .' });
	$("#Catatan'.$j.'-'.$chk_id.'").eip("save_kemajuanRB.php", { form_type: "textarea", max_rows:'. $j*2 .', cols:'. $j*16 .' });
			';*/

		}
	
	?>

</script>
<?php

$db=@mysql_connect($bkaHost,$bkaULogin,$bkaPass,$bkaDbase) or $error=(mysql_error()."<br>");
@mysql_select_db($bkaDbase,$db) or $error=(mysql_error());

	//$db = new mysqli($bkaHost,$bkaULogin,$bkaPass,$bkaDbase) or die(mysqli_error());
	if(!$db) {
		// Show error if we cannot connect.
		echo "ERROR: Could not connect to the database.";
	} 
else {
	$q = "SELECT * FROM laporanbulananRM11 WHERE id_daftar='$chk_id'";
	$r = mysql_query($q);
	if (mysql_num_rows($r) == 1) {
		list($x1,$x2,
		$mX[1],$mX[2],$mX[3],$mX[4],$mX[5],$mX[6],$mX[7],$mX[8],$mX[9],$mX[10],$mX[11],$mX[12],
		$mX[13],$mX[14],$mX[15],$mX[16],$mX[17],$mX[18],$mX[19],$mX[20],$mX[21],$mX[22],$mX[23],$mX[24],
		$mX[25],$mX[26],$mX[27],$mX[28],$mX[29],$mX[30],$mX[31],$mX[32],$mX[33],$mX[34],$mX[35],$mX[36],
		$mX[37],$mX[38],$mX[39],$mX[40],$mX[41],$mX[42],$mX[43],$mX[44],$mX[45],$mX[46],$mX[47],$mX[48],
		$mX[49],$mX[50],$mX[51],$mX[52],$mX[53],$mX[54],$mX[55],$mX[56],$mX[57],$mX[58],$mX[59],$mX[60],
		$mX[61],$mX[62],$mX[63],$mX[64],$mX[65],$mX[66],$mX[67],$mX[68],$mX[69],$mX[70],$mX[71],$mX[72]
		) = mysql_fetch_array($r, MYSQL_NUM);}	
	}
echo "<small><br>YR2015- ". $mX[1]." - ".$mX[2]." - ".$mX[3]." - ".$mX[4]." - ".$mX[5]." - ".$mX[6]." - ".$mX[7]." - ".$mX[8]." - ".$mX[9]." - ".$mX[10]." - ".$mX[11]." - ".$mX[12];
echo "<br>YR2016- ". $mX[13]." - ".$mX[14]." - ".$mX[15]." - ".$mX[16]." - ".$mX[17]." - ".$mX[18]." - ".$mX[19]." - ".$mX[20]." - ".$mX[21]." - ".$mX[22]." - ".$mX[23]." - ".$mX[24];
echo "<br>YR2017- ". $mX[25]." - ".$mX[26]." - ".$mX[27]." - ".$mX[28]." - ".$mX[29]." - ".$mX[30]." - ".$mX[31]." - ".$mX[32]." - ".$mX[33]." - ".$mX[34]." - ".$mX[35]." - ".$mX[36];
echo "<br>YR2018- ". $mX[37]." - ".$mX[38]." - ".$mX[39]." - ".$mX[40]." - ".$mX[41]." - ".$mX[42]." - ".$mX[43]." - ".$mX[44]." - ".$mX[45]." - ".$mX[46]." - ".$mX[47]." - ".$mX[48];
echo "<br>YR2019- ". $mX[49]." - ".$mX[50]." - ".$mX[51]." - ".$mX[52]." - ".$mX[53]." - ".$mX[54]." - ".$mX[55]." - ".$mX[56]." - ".$mX[57]." - ".$mX[58]." - ".$mX[59]." - ".$mX[60];
echo "<br>YR2020- ". $mX[61]." - ".$mX[62]." - ".$mX[63]." - ".$mX[64]." - ".$mX[65]." - ".$mX[66]." - ".$mX[67]." - ".$mX[68]." - ".$mX[69]." - ".$mX[70]." - ".$mX[71]." - ".$mX[72]."</small>";

?>
</body>
</html>
<?php // Flush the buffered output to the Web browser.
ob_flush();
?>
