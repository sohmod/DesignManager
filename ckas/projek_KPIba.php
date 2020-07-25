 <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1">
 <style type="text/css">
 a:link { text-decoration:none ; font-size:12px; font-weight:normal }
 a:visited { text-decoration:none ; font-size:12px; font-weight:normal }
 a:hover { text-decoration:underline ; font-size:12px; font-weight:normal; bgcolor: #00ff00; cursor: help }
 
 body { font-family:Verdana,Arial,Helvetica,sans-serif;font-size:12px;
 background: white url(../bground/bStone6.jpg);// no-repeat top right; 
 } 
 .style8 {color:#CCCFFF;font-size:12px; font-weight:light } > 
</style>

<body background="rockpile.jpg" bgcolor="#333333" text="#999">

<?php
///////
include_once ('../ip_SERVER.php');

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

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<center><h>KPI.BHG.KEJ.AWAM(BA)</h></center><br/>';
$cday = date(d);
$cmonth = date(m);
$cmonth1 = date(m)-1;
$cmonth2 = date(m)-2;
$cyear = date(Y);

$a = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
$b = array('JAN', 'FEB', 'MAR', 'APR', 'MEI', 'JUN', 'JUL', 'OGO', 'SEP', 'OKT', 'NOV', 'DIS');
$c = array_combine($a, $b);  //$c['01'] = JAN ;

$date1 = new DateTime("$cday-$cmonth1-$cyear");
$date2 = new DateTime("$cday-$cmonth2-$cyear");

$prev1 =  $date1->format("d-m-Y");
list($day1, $month1, $year1) = split('[-]', $prev1);
$prev2 = $date2->format("d-m-Y");
list($day2, $month2, $year2) = split('[-]', $prev2);
$dataco0 = $c[$cmonth].$cyear;
$dataco1 = $c[$month1].$year1;
$dataco2 = $c[$month2].$year2;
//echo $dataco0 .'/'. $dataco1 .'/'. $dataco2;

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

$tajukproj = array('');
for ($i = $cnt2 - 1; $i >= 0; $i--) {
    if (!mysql_data_seek($perancangan0, $i)) {
        echo "Cannot seek to row $i: " . mysql_error() . "\n";
        continue;
    }
    if (!($row = mysql_fetch_assoc($perancangan0))) {
        continue;
    }
	$tajukproj[] = $row['id_daftar'];
    //echo $row['id_daftar'] . "<br />\n";
}
mysql_free_result($perancangan0);
//print_r ($tajukproj);

//1
$tangguhxjls1 = mysql_query("SELECT COUNT(*) FROM laporanbulananRM9 where $dataco1='KIV' || $dataco1='statustakjelas'");
$perancangan1 = mysql_query("SELECT COUNT(*) FROM laporanbulananRM9 where $dataco1='dplan' || $dataco1='pelanukur' || $dataco1='pelansusunatur' || $dataco1='NSorTOR' || $dataco1='lawatapak'");
$rekabentuk1 = mysql_query("SELECT COUNT(*) FROM laporanbulananRM9 where $dataco1='surat2pberkuasa' || $dataco1='konsepRB' || $dataco1='RBawalan' || $dataco1='RBterperinci' || $dataco1='varifikasiRB' || $dataco1='auditRB'");
$perolehan1 = mysql_query("SELECT COUNT(*) FROM laporanbulananRM9 where $dataco1='TTD' || $dataco1='tender' || $dataco1='pnilaianTeknikal' || $dataco1='pranego' || $dataco1='nego' || $dataco1='LA'");
$pembinaan1 = mysql_query("SELECT COUNT(*) FROM laporanbulananRM9 where $dataco1='miliktapak' || $dataco1='pembinaan' || $dataco1='validasiRB' || $dataco1='tambahmasa'");
$serahan1 = mysql_query("SELECT COUNT(*) FROM laporanbulananRM9 where $dataco1='serahan' || $dataco1='tempohkecacatan' || $dataco1='SEMPURNA'");

$tangguhxjls1 = mysql_fetch_row($tangguhxjls1);
$perancangan1 = mysql_fetch_row($perancangan1);
$rekabentuk1 = mysql_fetch_row($rekabentuk1);
$perolehan1 = mysql_fetch_row($perolehan1);
$pembinaan1 = mysql_fetch_row($pembinaan1);
$serahan1 = mysql_fetch_row($serahan1);

//2
$tangguhxjls2 = mysql_query("SELECT COUNT(*) FROM laporanbulananRM9 where $dataco2='KIV' || $dataco2='statustakjelas'");
$perancangan2 = mysql_query("SELECT COUNT(*) FROM laporanbulananRM9 where $dataco2='dplan' || $dataco2='pelanukur' || $dataco2='pelansusunatur' || $dataco2='NSorTOR' || $dataco2='lawatapak'");
$rekabentuk2 = mysql_query("SELECT COUNT(*) FROM laporanbulananRM9 where $dataco2='surat2pberkuasa' || $dataco2='konsepRB' || $dataco2='RBawalan' || $dataco2='RBterperinci' || $dataco2='varifikasiRB' || $dataco2='auditRB'");
$perolehan2 = mysql_query("SELECT COUNT(*) FROM laporanbulananRM9 where $dataco2='TTD' || $dataco2='tender' || $dataco2='pnilaianTeknikal' || $dataco2='pranego' || $dataco2='nego' || $dataco2='LA'");
$pembinaan2 = mysql_query("SELECT COUNT(*) FROM laporanbulananRM9 where $dataco2='miliktapak' || $dataco2='pembinaan' || $dataco2='validasiRB' || $dataco2='tambahmasa'");
$serahan2 = mysql_query("SELECT COUNT(*) FROM laporanbulananRM9 where $dataco2='serahan' || $dataco2='tempohkecacatan' || $dataco2='SEMPURNA'");

$tangguhxjls2 = mysql_fetch_row($tangguhxjls2);
$perancangan2 = mysql_fetch_row($perancangan2);
$rekabentuk2 = mysql_fetch_row($rekabentuk2);
$perolehan2 = mysql_fetch_row($perolehan2);
$pembinaan2 = mysql_fetch_row($pembinaan2);
$serahan2 = mysql_fetch_row($serahan2);

echo "<center>
<tr><span style=\"align: center; height: 50px; font-size: 16px; color: #000\">LAPORAN KEMAJUAN BULANAN</span></tr></center>";

	echo "<table width=\"880\" height=\"25\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\" bordercolor=\"#CCCCCC\" 
	bgcolor=\"#ffffff\" align=\"center\">
	<tr>
		<td valign=\"top\" align=\"center\" width=\"110\"><font size=\"2\" color=\"orange\">Status_>  Bulan_v</font></td>
	
		<td valign=\"top\" align=\"center\" width=\"110\"><font size=\"2\" color=\"orange\">Perancangan</font></td>
		<td valign=\"top\" align=\"center\" width=\"110\"><font size=\"2\" color=\"black\">Rekabentuk</font></td>
		<td valign=\"top\" align=\"center\" width=\"110\"><font size=\"2\" color=\"coral\">Perolehan</font></td>
		<td valign=\"top\" align=\"center\" width=\"110\"><font size=\"2\" color=\"orange\">Pembinaan</font></td>
		<td valign=\"top\" align=\"center\" width=\"110\"><font size=\"2\" color=\"black\">Serahan</font></td>
		<td valign=\"top\" align=\"center\" width=\"110\"><font size=\"2\" color=\"black\">KIV/xjelas</font></td>
		<td valign=\"top\" align=\"center\" width=\"110\"><font size=\"2\" color=\"black\">Jumlah Projek</font></td>
		
	</tr>";
	$jp0=$cnt1+$cnt2+$cnt3+$cnt4+$cnt5+$cnt6;
	echo "	
	<tr>
		<td valign=\"top\" align=\"center\" width=\"110\"><font size=\"2\" color=\"orange\">$dataco0</font></td>
		
		<td valign=\"top\" align=\"center\" width=\"110\"><font size=\"2\" color=\"orange\"><a href=\"projek_KPI_butiranBA.php?bka=$dataco0-PERANCANGAN\">$cnt2</a></font></td>
		<td valign=\"top\" align=\"center\" width=\"110\"><font size=\"2\" color=\"black\"><a href=\"projek_KPI_butiranBA.php?bka=$dataco0-REKABENTUK\">$cnt3</a></font></td>
		<td valign=\"top\" align=\"center\" width=\"110\"><font size=\"2\" color=\"coral\"><a href=\"projek_KPI_butiranBA.php?bka=$dataco0-PEROLEHAN\">$cnt4</a></font></td>
		<td valign=\"top\" align=\"center\" width=\"110\"><font size=\"2\" color=\"orange\"><a href=\"projek_KPI_butiranBA.php?bka=$dataco0-PEMBINAAN\">$cnt5</a></font></td>
		<td valign=\"top\" align=\"center\" width=\"110\"><font size=\"2\" color=\"black\"><a href=\"projek_KPI_butiranBA.php?bka=$dataco0-SERAHAN\">$cnt6</a></font></td>
		<td valign=\"top\" align=\"center\" width=\"110\"><font size=\"2\" color=\"black\"><a href=\"projek_KPI_butiranBA.php?bka=$dataco0-TANGGUH\">$cnt1</a></font></td>
		<td valign=\"top\" align=\"center\" width=\"110\"><font size=\"2\" color=\"black\">$jp0</font></td>
		
	</tr>";
	$jp1=$serahan1[0]+$pembinaan1[0]+$perolehan1[0]+$rekabentuk1[0]+$perancangan1[0]+$tangguhxjls1[0];	
	echo "	
	<tr>
		<td valign=\"top\" align=\"center\" width=\"110\"><font size=\"2\" color=\"orange\">$dataco1</font></td>
	
		<td valign=\"top\" align=\"center\" width=\"110\"><font size=\"2\" color=\"orange\">$perancangan1[0]</font></td>
		<td valign=\"top\" align=\"center\" width=\"110\"><font size=\"2\" color=\"black\">$rekabentuk1[0]</font></td>
		<td valign=\"top\" align=\"center\" width=\"110\"><font size=\"2\" color=\"coral\">$perolehan1[0]</font></td>
		<td valign=\"top\" align=\"center\" width=\"110\"><font size=\"2\" color=\"orange\">$pembinaan1[0]</font></td>
		<td valign=\"top\" align=\"center\" width=\"110\"><font size=\"2\" color=\"black\">$serahan1[0]</font></td>
		<td valign=\"top\" align=\"center\" width=\"110\"><font size=\"2\" color=\"black\">$tangguhxjls1[0]</font></td>
		<td valign=\"top\" align=\"center\" width=\"110\"><font size=\"2\" color=\"black\">$jp1</font></td>
		
	</tr>";
	$jp2=$serahan2[0]+$pembinaan2[0]+$perolehan2[0]+$rekabentuk2[0]+$perancangan2[0]+$tangguhxjls2[0];	
	echo "	
	<tr>
		<td valign=\"top\" align=\"center\" width=\"110\"><font size=\"2\" color=\"orange\">$dataco2</font></td>
	
		<td valign=\"top\" align=\"center\" width=\"110\"><font size=\"2\" color=\"orange\">$perancangan2[0]</font></td>
		<td valign=\"top\" align=\"center\" width=\"110\"><font size=\"2\" color=\"black\">$rekabentuk2[0]</font></td>
		<td valign=\"top\" align=\"center\" width=\"110\"><font size=\"2\" color=\"coral\">$perolehan2[0]</font></td>
		<td valign=\"top\" align=\"center\" width=\"110\"><font size=\"2\" color=\"orange\">$pembinaan2[0]</font></td>
		<td valign=\"top\" align=\"center\" width=\"110\"><font size=\"2\" color=\"black\">$serahan2[0]</font></td>
		<td valign=\"top\" align=\"center\" width=\"110\"><font size=\"2\" color=\"black\">$tangguhxjls2[0]</font></td>
		<td valign=\"top\" align=\"center\" width=\"110\"><font size=\"2\" color=\"black\">$jp2</font></td>
		
	</tr>";		
	
	echo "</table>\n";


mysql_close(); // Close the database connection.

echo '<center><a href="http://'.$ipthis.'/'.PROJ_FOLDER.'/Laporan_bulanan.php"><font size="1" color="#808080">Laporan bulanan BKA</font></a></center>';

?>


<?php // Include the HTML footer file.
//include_once ('html/footer.htm');
?>
