<?php 
require_once("Excel/reader.php");

$con = mysql_connect('localhost', 'username', 'password');
if (!$con)
{
die('Could not connect: ' . mysql_error());
}

mysql_select_db('test', $con);

$edata = new Spreadsheet_Excel_Reader();

// Set output Encoding.
$edata->setOutputEncoding('CP1251');

if($_FILES['file']['tmp_name'])
{

$edata->read($_FILES['file']['tmp_name']);
}

error_reporting(E_ALL ^ E_NOTICE);
$arr=array();
for ($i = 2; $i <= $edata->sheets[0]['numRows']; $i++)
{

for ($j = 2; $j <= $edata->sheets[0]['numCols']; $j++)
{
$arr[$i][$j]=$edata->sheets[0]['cells'][$i][$j];
echo $arr[$i][$j].' , ';
}
/*	
$addsql = "insert into soalank1 ('Soalan' , 'JawapanAA' , 'JawapanBB' , 'JawapanCC' , 'JawapanDD' , 'JawaBENAR' , 'Kodquest') ";
$addsql = $addsql."VALUES ('".$arr[$i][2]."','".$arr[$i][3]."','".$arr[$i][4]."','".$arr[$i][5]."','".$arr[$i][6]."','".$arr[$i][7]."','".$arr[$i][8]."'),";
$ans=mysql_query($addsql);
echo $ans.'ans'.mysql_error() ;
*/

echo "|> <br/><br/> <|";
} 



mysql_close($con);

?>

<form name="frm" method="post" enctype="multipart/form-data" id="frm">
<input type="file" name="file" class="TextboxCss" size="30" /><input name="btn_save" type="submit" class="Button1Css" id="btn_save"  value="Save"  >
</form>
