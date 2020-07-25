<?php # Script 11.8 - view_files.php
// This page displays the files uploaded to the server.

// Set the page title and include the HTML header.
$order = $_GET['uj'];
$page_title = 'Kemajuan - '.$order;
include_once ('includes/header.html');
require ("../inc/projek_daftar_cfg.php");

require_once ('../mysql_connect.php'); // Connect to the database.

$first = TRUE; // Initialize the variable.

// Query the database.
/*$query = "SELECT upload_id, file_name, nom_lukisan, ROUND(file_size/1024) AS fs, description, DATE_FORMAT(upload_date, '%M %e, %Y') AS d FROM uploads 
WHERE id_daftar = $order ORDER BY upload_date DESC";*/
$query = "select 	t1.daftar_id,
			t1.tajuk,
			t1.mod_kerja,
			t1.lokasi,
			t1.OIC,
			t1.KemKlient,
			t1.nosiri_fail,
			t1.catatan AS catDaftar,
			t2.pereka,t2.penyemak,t2.kontraktor,t2.hadSiling AS kos2,
			t2.rekasiapDate,t2.tenderDate,t2.mtapakDate,t2.binasiapDate,
			t2.catatan AS catButiran,
			t3.luaran,t3.tanah,t3.bekalanair,t3.pembetungan,t3.jalan,
			t4.startDate,t4.progress,t4.sketch_proposal,t4.survey_work,t4.SI_work,
			t4.LAcquire,t4.analisa,t4.rekabentuk,t4.lukisan,t4.Bill_Q,t4.catatan
			from 
			daftar_projek AS t1,
			butiran_projek AS t2,
			butiran_sivil AS t3,
			status_projek AS t4
			where t1.daftar_id = {$_GET['uj']}
			and t2.id_daftar = {$_GET['uj']}
			and t3.id_daftar = {$_GET['uj']}
			and t4.id_daftar = {$_GET['uj']} ORDER BY t4.startDate desc
			";




$result = mysql_query ($query);

$count=mysql_query("SELECT COUNT(*) FROM status_projek where id_daftar = {$_GET['uj']}");
$count=mysql_fetch_array($count);
$count=$count[0];

if (!$result) {
die('<center>Data tidak dikemaskini :  ' . mysql_error().'<br/><font color="gray"><small>Input error</small></font>');}




// Display all the URLs.
$bil=$count+1;
while ($row = mysql_fetch_array ($result, MYSQL_ASSOC)) {
//if ($bil==1){exit;}
$bil--;
	// If this is the first record, create the table header.
	if ($first) {

		 
//		<td align="left" width="10" bgcolor="#CCFECF"><font size="1" color="orange"> </font></td>


	echo ' <table border="0" width="850" cellspacing="1" cellpadding="1" align="center">
	<tr>
		<td align="left" width="600" colspan="2" ><font size="2" color="green" > </font>
		<font size="2" color="orange" >Tajuk Projek:</font><br/>
		<font size="2" color="green" ><b>'.$row['tajuk'].'</b></font></td>

		<td align="left" width="150"> <font size="2" color="orange">Modus Operandi:</font><br/>
		<font size="2" color="darkgray" >'.$row['mod_kerja'].'  </font></td>
		<td align="left" width="150"> <font size="2" color="orange">Kos Projek:</font><br/>
		<font size="2" color="darkgray" >RM&nbsp; '.$row['kos2'].'  </font></td>
	</tr>
	</table>';
	echo '<table border="0" width="850" cellspacing="1" cellpadding="1" align="center">
	<tr>
		<td align="right" width="850" > 
		<font size="1px" color="gray"> <small><small>FAIL PROJEK : '.
$oic_FAIL[$row[OIC]].$KOD_KEM[$row[KemKlient]].'/'.$KOD_NEG[$row[lokasi]].$row[nosiri_fail].
'</small></small>  </font></td>
	</table>';

	echo '<table width="850" border="0" cellspacing="1" cellpadding="1" bordercolor="#CCCCCC" bgcolor="#c2FBF0" align="center">
	<tr>
		<td align="left" valign="top" width="50"> <font size="1" color="gray" style="margin-left:25px" >::</font></td>
		<td align="left" valign="top" width="800" colspan="3" > <font size="1" color="gray" >Pegawai bertanggung jawab:'.$row['OIC'].'</font></td>
	</tr></table>';

	echo '<table width="850" border="0" cellspacing="1" cellpadding="1" bordercolor="#CCCCCC" bgcolor="#f2FBF0" align="center">
	<tr>
		<td align="left" valign="top" width="50"> <font size="1" color="gray" style="margin-left:25px" >::</font></td>
		<td align="left" valign="top" width="360" colspan="2" > <font size="1" color="gray" >Pereka:'. $row['pereka'] .' </font></td>
		<td align="left" valign="top" width="360" colspan="2" ><font size="1" color="gray" >Penyemak:'. $row['penyemak'] .' </font></td>
	</tr></table>';



echo '
<table border="0" width="850" cellspacing="1" cellpadding="1" align="center">
<tr valign="top" height="5" > <td width="200" valign="center" > <small> 
<div class="demo-show"> 
<h5>Kerja luar :</h5> 
<div> <font size="2" color="darkgray"> '. ereg_replace("#","<br/>", $row['luaran']) .'</font></div> 
<h5>Kerja tanah :</h5> 
<div><font size="2" color="darkgray"> '. ereg_replace("#","<br/>", $row['tanah']) .'</font></div> 
<h5>Kerja bekalan air :</h5> 
<div><font size="2" color="darkgray"> '. ereg_replace("#","<br/>", $row['bekalanair']) .'</font></div> 
<h5>Kerja pembetungan :</h5> 
<div><font size="2" color="darkgray"> '. ereg_replace("#","<br/>", $row['pembetungan']) .'</font></div> 
<h5>Kerja jalan :</h5> 
<div><font size="2" color="darkgray"> '. ereg_replace("#","<br/>", $row['jalan']) .'</font></div> 
<h5>Catatan :</h5> 
<div><font size="2" color="darkgray"> '. ereg_replace("#","<br/>", $row['catDaftar']) .'</font></div> 
</div> </small> 
</td></tr>
</table>
';

//echo '<br/>';

	echo ' <table border="0" width="850" cellspacing="1" cellpadding="1" align="center">
	<tr>
		<td align="left" width="850" > 
		<font size="1px" color="gray" > Laporan Kemajuan Projek Nom: '.$order.'</font></td>
	</table>';

	echo "<table width=\"850\" height=\"25\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\" bordercolor=\"#CCCCCC\" 
	bgcolor=\"#d3FCF0\" align=\"center\">
	<tr>
		<td valign=\"top\" align=\"center\" width=\"25\"><font size=\"1\" color=\"orange\">  bil</font></td>
		<td valign=\"top\" align=\"center\" width=\"125\"><font size=\"1\" color=\"black\"> tarikh</font></td>
		<td valign=\"top\" align=\"center\" width=\"75\"><font size=\"1\" color=\"coral\"> peratus<br>kemajuan</font></td>
		<td valign=\"top\" align=\"center\" width=\"75\"><font size=\"1\" color=\"orange\"> tahap<br>kemajuan</font></td>
		<td valign=\"top\" align=\"center\" width=\"75\"><font size=\"1\" color=\"black\"> survey</font></td>
		<td valign=\"top\" align=\"center\" width=\"75\"><font size=\"1\" color=\"black\"> SI</font></td>
		<td valign=\"top\" align=\"center\" width=\"75\"><font size=\"1\" color=\"black\"> LA</font></td>
		<td valign=\"top\" align=\"center\" width=\"75\"><font size=\"1\" color=\"orange\"> analisa</font></td>
		<td valign=\"top\" align=\"center\" width=\"75\"><font size=\"1\" color=\"orange\"> rekabentuk</font></td>
		<td valign=\"top\" align=\"center\" width=\"75\"><font size=\"1\" color=\"orange\"> lukisan</font></td>
		<td valign=\"top\" align=\"center\" width=\"75\"><font size=\"1\" color=\"orange\"> Bill_Q</font></td>
	</tr></table>\n";



	} // End of $first IF.
	
	// Display each record.
	echo "<table width=\"850\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\" bordercolor=\"#CCCCCC\" 
	bgcolor=\"#f2FBF0\" align=\"center\">
	<tr>
		<td valign=\"top\" align=\"center\" width=\"25\"> <font size=\"1\" color=\"black\"> {$bil}</font></td>

		<td valign=\"top\" align=\"center\" width=\"125\"><font size=\"1\" color=\"coral\">{$row['startDate']}</a> </font></td>
		<td valign=\"top\" align=\"center\" width=\"75\"><font size=\"1\" color=\"black\">{$row['progress']}</font></td>
		<td valign=\"top\" align=\"center\" width=\"75\" bgcolor=\"#FDFECF\" bordercolor=\"#EBEEF5\"><font size=\"1\" color=\"black\">{$row['sketch_proposal']}</font></td>
		<td valign=\"top\" align=\"center\" width=\"75\"><font size=\"1\" color=\"orange\"> {$row['survey_work']}</font></td>
		<td valign=\"top\" align=\"center\" width=\"75\"><font size=\"1\" color=\"orange\"> {$row['SI_work']}</font></td>
		<td valign=\"top\" align=\"center\" width=\"75\"><font size=\"1\" color=\"orange\"> {$row['LAcquire']}</font></td>
		<td valign=\"top\" align=\"center\" width=\"75\"><font size=\"1\" color=\"black\">{$row['analisa']}</font></td>
		<td valign=\"top\" align=\"center\" width=\"75\"><font size=\"1\" color=\"black\">{$row['rekabentuk']}</font></td>
		<td valign=\"top\" align=\"center\" width=\"75\"><font size=\"1\" color=\"black\"> {$row['lukisan']}</font></td>
		<td valign=\"top\" align=\"center\" width=\"75\"><font size=\"1\" color=\"black\"> {$row['Bill_Q']}</font></td>
	</tr>		

<tr><td colspan=\"11\"><div class=\"demo-show\"><h5><small><i>Catatan Status : {$bil} </i></small></h5><div> <font size=\"2\" color=\"darkgray\">"
.ereg_replace('#','<br/>',$row['catatan']).
"</font></div></div></td></tr>
</table>\n";



	$first = FALSE; // One record has been returned.

} // End of while loop.

// If no records were displayed...
if ($first) {
	echo '<div align="center">There are currently no files to be viewed.</div>';
} else {
	//echo ' </table> '; // Close the table.
}

mysql_close(); // Close the database connection.
include_once ('includes/footer.html'); // Require the HTML footer.
?>