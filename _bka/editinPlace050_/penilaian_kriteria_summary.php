<?php 
ob_start();
session_start();
$ulasan = '';

include_once ('../../ip_SERVER.php');
include_once('../../'.PROJ_FOLDER.'/inc/mysql_connect2cfg.php');
require_once ('../../'.PROJ_FOLDER.'/mysql_connect.php'); // Connect to the database.
require ("inc/proj_kriteria_pnilaian_tech_cfg.php");

if ($_SESSION['daftar_id']){
		$q = "select t1.tajuk, t1.OIC AS ppk, t2.bilPetender from daftar_projek AS t1 , butiran_projek AS t2 where t1.daftar_id = {$_SESSION['daftar_id']} AND t2.id_daftar = {$_SESSION['daftar_id']}";
		$r = mysql_query ($q);
		while ($tna = mysql_fetch_array ($r)) {
		$_SESSION['tajuk'] = $tna[0];
		$_SESSION['ppk'] = $tna[1];
		$_SESSION['bilPetender'] = $tna[2];
		$chk_id=$_SESSION['daftar_id'];

		ob_end_clean(); // Delete the buffer.
 }}
 mysql_close();
function InsertUpdata($id,$new_content,$id_daftar,$username,$kp,$H,$U,$P,$D){
	$db = new mysqli($H,$U,$P,$D);
	if(!$db) {
		// Show error if we cannot connect.
		echo 'ERROR: Could not connect to the database.';
	} else {
	$query1 = $db->query("INSERT into kriteria (id,new_content,id_daftar,username,kp,regist_date) values 
('$id','$new_content','$chk_id','$username','$kp',NOW())");
}

	$query2 = $db->query("UPDATE kriteria SET new_content='$new_content', username='$username',kp='$kp',regist_date=NOW() WHERE id='$id' AND id_daftar='$chk_id'") ;
}

 
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>	
	<title>pt_summary</title>
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
<!--a href="<?php echo "http://".$ipthis."/_bka/editinPlace050/penilaian_kriteria_earthwork.php" ;?>"-->P.Tender<!--/a--> |
<a href="<?php echo "http://".$ipthis."/_bka/editinPlace050/NeedsStatement.php" ;?>">N.S.</a> |
<a href="<?php echo "http://".$ipthis."/_bka/liveForms/MyBulkDrawings11.php" ;?>">D.Lukisan</a>
</center> </small> </fieldset>			
		
<?php

$db=mysql_connect($ajaxHost,$ajaxULogin,$ajaxPass) or die('Error connecting to the server');
      mysql_select_db($ajaxDbase) or die('Error selecting database');
	  
$bilPetender = $_SESSION['bilPetender'];
if ($_SESSION['bilPetender']==0){$bilPetender = 1; }
if ($_SESSION['bilPetender']>15){$bilPetender = 15; }
if (!$_SESSION['daftar_id']){$chk_id=7654321;$bilPetender =2;$username='public';$kp='123456-78-9012';}

$widtbl=450 + 130 * $bilPetender;
echo '	
</head>
<body>
<table width="'.$widtbl.'" border="1" align="center" cellpadding="-1" cellspacing="0" bordercolor="#E4E4E4" >';
echo '<div align="center"><span>
Tajuk projek:>&nbsp;:&nbsp;&nbsp;&nbsp; <b><font color="darkblue" style="font-size:14">'.$_SESSION['tajuk'].'</font></b>
<br/>
<font color="gray">EditInPlace - <b>Penilaian</b> Teknikal Kerja Sivil : </font><font color="red">Summary</font>
<font color="green">&nbsp;Job no:>'.$_SESSION['daftar_id'].'</font><br/>

<a href="http://'.$ipthis.'/_bka/editinPlace050/penilaian_kriteria_earthwork.php"><font color="green" size="2em" style="text-decoration:none">earthwork</font></a>
<a href="http://'.$ipthis.'/_bka/editinPlace050/penilaian_kriteria_drainage.php"><font color="green" size="2em" style="text-decoration:none">drainage</font></a>
<a href="http://'.$ipthis.'/_bka/editinPlace050/penilaian_kriteria_roadwork.php"><font color="green" size="2em" style="text-decoration:none">roadwork</font></a>
<a href="http://'.$ipthis.'/_bka/editinPlace050/penilaian_kriteria_watersupply.php"><font color="green" size="2em" style="text-decoration:none">watersupply</font></a>
<a href="http://'.$ipthis.'/_bka/editinPlace050/penilaian_kriteria_sewerage.php"><font color="green" size="2em" style="text-decoration:none">sewerage</font></a>
<!--a href="http://'.$ipthis.'/_bka/editinPlace050/penilaian_kriteria_summary.php"><font color="green" size="2em" style="text-decoration:none"-->summary<!--/font></a-->
&nbsp;:&nbsp;&nbsp;&nbsp;<br/>
<a href="http://'.$ipthis.'/pdf/tcpdf_3_0_006/examples/bka_P-A4_markahteknikal.php"><font color="black" size="2em" style="text-decoration:none">print:&nbsp;&nbsp;&nbsp; PDF_A4P</font></a>
&nbsp;:&nbsp;&nbsp;&nbsp;
<a href="http://'.$ipthis.'/pdf/tcpdf_3_0_006/examples/bka_L-A4_markahteknikal.php"><font color="black" size="2em" style="text-decoration:none">PDF_A4L</font></a>
&nbsp;:&nbsp;&nbsp;&nbsp;
<a href="http://'.$ipthis.'/pdf/tcpdf_3_0_006/examples/bka_P-A3_markahteknikal.php"><font color="black" size="2em" style="text-decoration:none">PDF_A3P</font></a>
&nbsp;:&nbsp;&nbsp;&nbsp;
<a href="http://'.$ipthis.'/pdf/tcpdf_3_0_006/examples/bka_L-A3_markahteknikal.php"><font color="black" size="2em" style="text-decoration:none">PDF_A3L</font></a>
</span></div>';


echo '
<!----------------------------->
<tr height="25">
<td colspan="4" bgcolor="#FFFFFF" align="right"  style="padding-right: 5px;font-size:14px">Petender :</td>';

for ($j=1;$j<=$bilPetender;$j++){ 

$chk='PETENDER'.$j.'#'.$chk_id;

      $result=mysql_query("SELECT * FROM kriteria WHERE id='$chk'") or die ('Error performing query');
      while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$id  = $row['id'];
$form_type = $row['form_type'];
$old_content = $row['old_content'];
$new_content = $row['new_content'];
$old_option = $row['old_option'];
$new_option = $row['new_option'];
$old_option_text = $row['old_option_text'];
$new_option_text = $row['new_option_text'];
$id_daftar = $row['id_daftar'];
$petender = $new_content;$new_content='';
	}
echo '<td colspan="2" bgcolor="#FFFFFF" align="center" style="padding-left: 0px;font-size:16px">
<span id="PETENDER'.$j.'#'.$chk_id.'">'. $petender .'</span></td>';	
	}
echo '</tr>	
<!---------------------------->';

echo '
<!---------------------------->
<tr>

<td colspan="3" bgcolor="#FFFFFF" height="20" width="350" align="right" style="align:right;padding-left: 20px;font-size:12px">Perkara&nbsp;&nbsp;</td>
<td bgcolor="#FFFFFF" height="20" width="50" style="align:center;padding-left: 20px;font-size:11px">WTG</td>';

$gredskor='';
for ($j=1;$j<=$bilPetender;$j++){ 

$gredskor .=
'<td bgcolor="#FFFFFF" height="20" width="65" style="align:center;padding-left: 20px;font-size:11px">GRADE</td>
<td bgcolor="#FFFFFF" height="20" width="65" style="align:center;padding-left: 20px;font-size:11px">SCORE</td>';
							}
echo $gredskor.'</tr>
<!-------------------e------------------>'; 
			

//<!------------start----scope---earthwork------------------>
//$scope = 5; //earthwork
//$chk_id=$_SESSION['daftar_id'];
//if (!$_SESSION['daftar_id']){$chk_id=7654321;}


echo ' 
<tr height="25">
<td colspan="3" width="380" bgcolor="#FFFFFF" align="right" style="align:right;padding-left: 5px;font-size:12px">Jumlah Besar Pemberat, Gred & Skor&nbsp;&nbsp;</td>
<td bgcolor="#FDFECF" bordercolor="#EBEEF5" style="align:center;padding-left: 20px;font-size:12px">';

$chk1='WORKSCOPE_1#'.$chk_id;$chk2='WORKSCOPE_2#'.$chk_id;$chk3='WORKSCOPE_3#'.$chk_id;$chk4='WORKSCOPE_4#'.$chk_id;$chk5='WORKSCOPE_5#'.$chk_id;

	$result=mysql_query("SELECT SUM(new_content) FROM kriteria where (id='$chk1' || id='$chk2' || id='$chk3' || id='$chk4' || id='$chk5')") or die ('Error performing query');
$swtg=mysql_fetch_array($result);	  
$JumlahBesar=$swtg[0];

echo '<span id="JumlahBesar#'.$chk_id.'">'.
$JumlahBesar.'</span></td>';
InsertUpdata('JumlahBesar#'.$chk_id, $JumlahBesar, $chk_id, $username, $kp ,$ajaxHost,$ajaxULogin,$ajaxPass,$ajaxDbase);

for ($j=1;$j<=$bilPetender;$j++){ 
///variable shall be manually tally to array kod or id & must be equal no of criteria considered
$chk_g1="gred10".$j."#".$chk_id;$chk_g2="gred20".$j."#".$chk_id;$chk_g3="gred30".$j."#".$chk_id;$chk_g4="gred40".$j."#".$chk_id;$chk_g5="gred50".$j."#".$chk_id;

$chk_s1="skor10".$j."#".$chk_id;$chk_s2="skor20".$j."#".$chk_id;$chk_s3="skor30".$j."#".$chk_id;$chk_s4="skor40".$j."#".$chk_id;$chk_s5="skor50".$j."#".$chk_id;

            $result=mysql_query("SELECT SUM(new_content) FROM kriteria where (id='$chk_g1' || id='$chk_g2' || id='$chk_g3' || id='$chk_g4' || id='$chk_g5')") or die ('Error performing query');
$sumg=mysql_fetch_array($result);	  
$sumgred=$sumg[0];  // 3 el

            $result=mysql_query("SELECT SUM(new_content) FROM kriteria where (id='$chk_s1' || id='$chk_s2' || id='$chk_s3' || id='$chk_s4' || id='$chk_s5')") or die ('Error performing query');
$sums=mysql_fetch_array($result);	  
$sumskor=$sums[0]; // 1 el


$GredBesar = round($sumgred,2);
$SkorBesar = round($sumskor,2);

echo '<td bgcolor="#FDFECF" bordercolor="#EBEEF5" style="align:center;padding-left: 20px;font-size:12px">
<span id="GredBesar'.$j.'#'.$chk_id.'">'. $GredBesar .'</span></td>';
echo '<td bgcolor="#FDFECF" bordercolor="#EBEEF5" style="align:center;padding-left: 20px;font-size:12px">
<span id="SkorBesar'.$j.'#'.$chk_id.'">'.$SkorBesar.'</span></td>';		
InsertUpdata('GredBesar'.$j.'#'.$chk_id, $GredBesar, $chk_id, $username, $kp ,$ajaxHost,$ajaxULogin,$ajaxPass,$ajaxDbase);
InsertUpdata('SkorBesar'.$j.'#'.$chk_id, $SkorBesar, $chk_id, $username, $kp ,$ajaxHost,$ajaxULogin,$ajaxPass,$ajaxDbase);

		}

echo '</tr>';
//<!------------e----scope---earthwork------------------>


//<!-----------------s--Recommendations--s---------------->

$chk='PeratusAwam#'.$chk_id;
      $result=mysql_query("SELECT new_content FROM kriteria WHERE id='$chk'") or die ('Error performing query');
      while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$PeratusAwam = floatval($row['new_content']);}


echo '<tr height="25"><td colspan="3" bgcolor="#FFFFFF" align="right" style="align:center;padding-left: 5px;font-size:12px">Peratus untuk Kejuruteraan Awam&nbsp;&nbsp;</td><td bgcolor="#FFFFFF" style="align:center;padding-left: 20px;font-size:12px"><span id="PeratusAwam#'.$chk_id.'">'.$PeratusAwam.'</span></td>';


for ($j=1;$j<=$bilPetender;$j++){ 

$chk_g1="gred10".$j."#".$chk_id;$chk_g2="gred20".$j."#".$chk_id;$chk_g3="gred30".$j."#".$chk_id;$chk_g4="gred40".$j."#".$chk_id;$chk_g5="gred50".$j."#".$chk_id;

$chk_s1="skor10".$j."#".$chk_id;$chk_s2="skor20".$j."#".$chk_id;$chk_s3="skor30".$j."#".$chk_id;$chk_s4="skor40".$j."#".$chk_id;$chk_s5="skor50".$j."#".$chk_id;

            $result=mysql_query("SELECT SUM(new_content) FROM kriteria where (id='$chk_g1' || id='$chk_g2' || id='$chk_g3' || id='$chk_g4' || id='$chk_g5')") or die ('Error performing query');
$sumg=mysql_fetch_array($result);	  
$sumgred=$sumg[0];  // 3 el

            $result=mysql_query("SELECT SUM(new_content) FROM kriteria where (id='$chk_s1' || id='$chk_s2' || id='$chk_s3' || id='$chk_s4' || id='$chk_s5')") or die ('Error performing query');
$sums=mysql_fetch_array($result);	  
$sumskor=$sums[0]; // 1 el

if ($JumlahBesar>0){
$GredSelaras = round($sumgred*$PeratusAwam/$JumlahBesar,2);
$SkorSelaras = round($sumskor*$PeratusAwam/$JumlahBesar,2);}
		

echo '<td bgcolor="#FDFECF" bordercolor="#EBEEF5" style="align:center;padding-left: 20px;font-size:12px">
<span id="GredSelaras'.$j.'#'.$chk_id.'"><b>'.$GredSelaras.'</b></span></td>
<td bgcolor="#FDFECF" bordercolor="#EBEEF5" style="align:center;padding-left: 20px;font-size:12px">
<span id="SkorSelaras'.$j.'#'.$chk_id.'"><b>'.$SkorSelaras.'</b></span></td>';

InsertUpdata('GredSelaras'.$j.'#'.$chk_id, $GredSelaras, $chk_id, $username, $kp ,$ajaxHost,$ajaxULogin,$ajaxPass,$ajaxDbase);
InsertUpdata('SkorSelaras'.$j.'#'.$chk_id, $SkorSelaras, $chk_id, $username, $kp ,$ajaxHost,$ajaxULogin,$ajaxPass,$ajaxDbase);

} 
echo '</tr>';

//<!-----------------s--ulasan--s---------------->

echo '<tr><td colspan="4" bgcolor="#FFFFFF" height="40" width="350" align="right" style="align:right;padding-left: 20px;font-size:12px">Kelebihan&nbsp;&nbsp;</td>';
for ($j=1;$j<=$bilPetender;$j++){ 
$chk='UlasanPositif'.$j.'#'.$chk_id;
	$result=mysql_query("SELECT new_content FROM kriteria where id='$chk'") or die ('Error performing query');
    while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$UlasanPositif = $row['new_content'];	}
echo '<td colspan="2" bgcolor="#FFFFFF" style="align:center;padding-left: 20px;font-size:12px">
<span id="UlasanPositif'.$j.'#'.$chk_id.'">'.$UlasanPositif.'</span></td>';
$UlasanPositif='';} echo '</tr>';

echo '<tr><td colspan="4" bgcolor="#FFFFFF" height="40" width="350" align="right" style="align:right;padding-left: 20px;font-size:12px">Kekurangan&nbsp;&nbsp;</td>';
for ($j=1;$j<=$bilPetender;$j++){ 
$chk='UlasanNegatif'.$j.'#'.$chk_id;
	$result=mysql_query("SELECT new_content FROM kriteria where id='$chk'") or die ('Error performing query');
    while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$UlasanNegatif = $row['new_content'];	}
echo '<td colspan="2" bgcolor="#FFFFFF" style="align:center;padding-left: 20px;font-size:12px">
<span id="UlasanNegatif'.$j.'#'.$chk_id.'">'.$UlasanNegatif.'</span></td>';
$UlasanNegatif='';} echo '</tr>';

echo '<tr><td colspan="4" bgcolor="#FFFFFF" height="40" width="350" align="right" style="align:right;padding-left: 20px;font-size:12px">Rumusan&nbsp;&nbsp;</td>';
for ($j=1;$j<=$bilPetender;$j++){ 
$chk='UlasanRumusan'.$j.'#'.$chk_id;
	$result=mysql_query("SELECT new_content FROM kriteria where id='$chk'") or die ('Error performing query');
    while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$UlasanRumusan  = $row['new_content'];	}
echo '<td colspan="2" bgcolor="#FFFFFF" style="align:center;padding-left: 20px;font-size:12px">
<span id="UlasanRumusan'.$j.'#'.$chk_id.'">'.$UlasanRumusan.'</span></td>';
$UlasanRumusan='';} echo '</tr>';

////////////////////////////////////////////////////////////
echo '
<!----------------------------------------->
<!---//////////////--><!---//////////////-->
</table> <BR>';


?>

<!--  script start-->
<script type="text/javascript">
	EditInPlace.defaults['save_url'] = 'save_kriteria.php';
<?php
echo " $('JumlahBesar#".$chk_id."').editInPlace();"; 	
echo " $('PeratusAwam#".$chk_id."').editInPlace();"; 
	
for ($j=1;$j<=$bilPetender;$j++){ 	
	echo "
$('PETENDER".$j."#".$chk_id."').editInPlace({	form_type: 'textarea'});
$('skorBesar".$j."#".$chk_id."').editInPlace({	form_type: 'textarea'});
$('gredBesar".$j."#".$chk_id."').editInPlace({	form_type: 'textarea'});
$('GredSelaras".$j."#".$chk_id."').editInPlace({	form_type: 'textarea'});
$('SkorSelaras".$j."#".$chk_id."').editInPlace({	form_type: 'textarea'});
$('UlasanPositif".$j."#".$chk_id."').editInPlace({	form_type: 'textarea'});
$('UlasanNegatif".$j."#".$chk_id."').editInPlace({	form_type: 'textarea'});
$('UlasanRumusan".$j."#".$chk_id."').editInPlace({	form_type: 'textarea'});
";
	}
?>
</script>
<!--  script end-->


</body>
</html>
<?php // Flush the buffered output to the Web browser.
ob_flush();
?>
