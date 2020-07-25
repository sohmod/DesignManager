<?php 
require_once("Excel/reader.php");

$con = mysql_connect('localhost', 'luqman_ajax', 'sohmod061284');
//$con = mysql_connect('localhost', 'username', 'password');
if (!$con)
{
die('Could not connect: ' . mysql_error());
}

mysql_select_db('luqman_ajax', $con);
//mysql_select_db('kuiz', $con);

$edata = new Spreadsheet_Excel_Reader();

// Set output Encoding.
$edata->setOutputEncoding('CP1251');

if($_FILES['file']['tmp_name'])
{

$edata->read($_FILES['file']['tmp_name']);
}

error_reporting(E_ALL ^ E_NOTICE);
$arr=array();
for ($i = 1; $i <= $edata->sheets[0]['numRows']; $i++)
{

for ($j = 1; $j <= $edata->sheets[0]['numCols']; $j++)
{
$arr[$i][$j]=$edata->sheets[0]['cells'][$i][$j];
//echo $arr[$i][$j].'<br/>';
}
//echo $i.'i--j'.$j.'<br/>';
//  

$addsql = 'INSERT into markers_bka2 (idx,id_daftar,lat,lng,tajuk,lokasi,mod_kerja,OIC,nosiri_fail,KemKlient,pereka, penyemak,pelukis,ppenguasa,mtapakDate,kkontrak,kaedahT,kontraktor,kemajuan) ';
$addsql = $addsql.'VALUES ('.$arr[$i][1].','.$arr[$i][2].','.$arr[$i][3].','.$arr[$i][4].',"'.$arr[$i][5].'","'.$arr[$i][6].'","'.$arr[$i][7].'","'.$arr[$i][8].'","'.$arr[$i][9].'","'.$arr[$i][10].'","'. $arr[$i][11].'","'.$arr[$i][12].'","'.$arr[$i][13].'","'.$arr[$i][14].'","'.$arr[$i][15].'","'.$arr[$i][16].'","'.$arr[$i][17].'","'.$arr[$i][18].'","'.$arr[$i][19].'")';
$ans=mysql_query($addsql);

}
if ($ans){ echo $ans.'-->inserted row '.$i.' col '.$j ;} else {echo '*'.mysql_error() ;}

mysql_close($con);

?>

<form name="frm" method="post" enctype="multipart/form-data" id="frm">
<input type="file" name="file" class="TextboxCss" size="30" /><input name="btn_save" type="submit" class="Button1Css" id="btn_save"  value="Save"  >
</form>
