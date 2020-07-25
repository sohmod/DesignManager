<?php 
$kpi = $_GET['bka'];
list($dataco0,$kmaju) = split('-', $kpi);

// Include the configuration file for error management and such.
require_once ('html/includes/config.inc'); 

// Set the page title and include the HTML header.
$page_title = 'kpi ba';
include ('html/header.htm');
echo "</small></center></fieldset>";
?>

 <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1">
 <style type="text/css">
 a:link { text-decoration:none ; font-size:12px; font-weight:normal }
 a:visited { text-decoration:none ; font-size:12px; font-weight:normal }
 a:hover { text-decoration:underline ; font-size:12px; font-weight:normal }
 body { font-family:Verdana,Arial,Helvetica,sans-serif;font-size:12px;
 background: white url(../bground/bStone6.jpg);// no-repeat top right; 
 } 
 .style8 {color:#000000 ;font-size:14px; font-weight:normal  } > 
 </style>

<body background="rockpile.jpg" bgcolor="#333333" text="#999">

<?php
///////
include_once ('../ip_SERVER.php');
echo '<center><h>SENARAI.PROJEK.BHG.KEJ.AWAM(BA)</h></center><br/>';

$server="localhost";
$username="kppk";
$password="ukkptpbkackasj";
$database="bka";
 // Opens a connection to a MySQL server.
$connection = mysql_connect ($server, $username, $password);
if (!$connection) 
{
  die('Not connected : ' . mysql_error());
}

// Sets the active MySQL database.
$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) 
{
  die ('Can\'t use db : ' . mysql_error());
}
//////
$c1="($dataco0='KIV' || $dataco0='statustakjelas') && ppk='KPPK(BA)'";
$c2="($dataco0='dplan' || $dataco0='pelanukur' || $dataco0='pelansusunatur' || $dataco0='NSorTOR' || $dataco0='lawatapak') && ppk='KPPK(BA)'";
$c3="($dataco0='surat2pberkuasa' || $dataco0='konsepRB' || $dataco0='RBawalan' || $dataco0='RBterperinci' || $dataco0='varifikasiRB' || $dataco0='auditRB') && ppk='KPPK(BA)'";
$c4="($dataco0='TTD' || $dataco0='tender' || $dataco0='pnilaianTeknikal' || $dataco0='pranego' || $dataco0='nego' || $dataco0='LA') && ppk='KPPK(BA)'";
$c5="($dataco0='miliktapak' || $dataco0='pembinaan' || $dataco0='validasiRB' || $dataco0='tambahmasa') && ppk='KPPK(BA)'";
$c6="($dataco0='serahan' || $dataco0='tempohkecacatan' || $dataco0='SEMPURNA') && ppk='KPPK(BA)'";


$tangguhxjls0 = mysql_query("SELECT id_daftar FROM laporanbulananRM9 where ".$c1 );
$perancangan0 = mysql_query("SELECT id_daftar FROM laporanbulananRM9 where ".$c2 );
$rekabentuk0 = mysql_query("SELECT id_daftar FROM laporanbulananRM9 where ".$c3 );
$perolehan0 = mysql_query("SELECT id_daftar FROM laporanbulananRM9 where ".$c4 );
$pembinaan0 = mysql_query("SELECT id_daftar FROM laporanbulananRM9 where ".$c5 );
$serahan0 = mysql_query("SELECT id_daftar FROM laporanbulananRM9 where ".$c6 );
$cnt1 = mysql_num_rows($tangguhxjls0) ;
$cnt2 = mysql_num_rows($perancangan0) ;
$cnt3 = mysql_num_rows($rekabentuk0) ;
$cnt4 = mysql_num_rows($perolehan0) ;
$cnt5 = mysql_num_rows($pembinaan0) ;
$cnt6 = mysql_num_rows($serahan0) ;
if ($kmaju=='TANGGUH'){ 
			$ckhas = $cnt1;
			$quekhas = $tangguhxjls0; }
if ($kmaju=='PERANCANGAN'){ 
			$ckhas = $cnt2;
			$quekhas = $perancangan0; }
if ($kmaju=='REKABENTUK'){ 
			$ckhas = $cnt3;
			$quekhas = $rekabentuk0; }
if ($kmaju=='PEROLEHAN'){ 
			$ckhas = $cnt4;
			$quekhas = $perolehan0; }
if ($kmaju=='PEMBINAAN'){ 
			$ckhas = $cnt5;
			$quekhas = $pembinaan0; }
if ($kmaju=='SERAHAN'){ 
			$ckhas = $cnt6;
			$quekhas = $serahan0; }



			
$tajukproj = array('');
for ($i = $ckhas - 1; $i >= 0; $i--) {
    if (!mysql_data_seek($quekhas, $i)) {
        echo "Cannot seek to row $i: " . mysql_error() . "\n";
        continue;
    }
    if (!($row = mysql_fetch_assoc($quekhas))) {
        continue;
    }
	$tajukproj[] = $row['id_daftar'];
    //echo $row['id_daftar'] . "<br />\n";
}
mysql_free_result($quekhas);
//print_r ($tajukproj);
$cnt = count($tajukproj);
$chk = '';
for ($i=1; $i<=$cnt - 1; $i++){
		 if ( $i<$cnt - 1 ){ $chk .= 'daftar_id='.$tajukproj[$i].' || ';}
				else { $chk .= 'daftar_id='.$tajukproj[$i] ;}
				}
//echo '<br/>'. $chk;



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////
$server="localhost";
$username="username";
$password="password";
$database="ckaj";
 // Opens a connection to a MySQL server.
$connection = mysql_connect ($server, $username, $password);
if (!$connection) 
{
  die('Not connected : ' . mysql_error());
}
// Sets the active MySQL database.
$db_select = mysql_select_db($database, $connection);
if (!$db_select) 
{
  die ('Can\'t use db : ' . mysql_error());
}
//////
$tajuk2list = mysql_query("SELECT tajuk,OIC FROM daftar_projek where ".$chk );
echo "<center><tr><span style=\"align: center; height: 50px; font-size: 14px; color: #000\">DALAM ". $kmaju ."</span></tr></center>";
	echo "<table width=\"820\" height=\"25\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\" bordercolor=\"#CCCCCC\" 	bgcolor=\"#ffffff\" align=\"center\">";
$bil= 1;
for ($i = mysql_num_rows($tajuk2list) - 1; $i >= 0; $i--) {
    if (!mysql_data_seek($tajuk2list, $i)) {
        echo "Cannot seek to row $i: " . mysql_error() . "\n";
        continue;
    }
    if (!($row = mysql_fetch_assoc($tajuk2list))) {
        continue;
    }
    echo "<tr class=\"style8\"><td valign=\"top\" align=\"center\" width=\"50\">".$bil++."</td><td valign=\"top\" align=\"left\" width=\"720\">" . $row['tajuk'] . "</td><td valign=\"top\" align=\"center\" width=\"50\"><font size=\"1\" color=\"orange\">" . $row['OIC'] . "</font></td></tr>\n";
}
	
	echo "</table>\n";


mysql_close(); // Close the database connection.

echo '<center><a href="http://'.$ipthis.'/'.PROJ_FOLDER.'/Laporan_bulanan.php"><font size="1" color="#808080">Laporan bulanan BKA</font></a></center>';

?>


<?php // Include the HTML footer file.
//include_once ('html/footer.htm');
?>
