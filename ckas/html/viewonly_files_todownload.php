<?php # Script 11.8 - view_files.php
// This page displays the files uploaded to the server.

// Set the page title and include the HTML header.
$order = $_GET['uj'];
$page_title = 'Lihat lukisan - '.$order;
//include_once ('includes/header.html');

require_once ('../mysql_connect.php'); // Connect to the database.
$_SESSION['tajuk']='tiada projek dipilih!' ;//}
if (isset($_GET['uj'])){

		$q = "select tajuk from daftar_projek WHERE
			daftar_id = {$_GET['uj']}";
		$r = mysql_query ($q);
		while ($tna = mysql_fetch_array ($r)) {
		$_SESSION['tajuk'] = $tna[0];
		}
}


// Display all the URLs.
echo '<table border="0" width="940" cellspacing="1" cellpadding="1" align="center">
	<tr>
		<td valign="top" align="left" width="250"><font size="3" color="gray" >LUKISAN / DOKUMEN PROJEK :</font></td>
		<td align="left" width="650"><font size="4" face="Verdina, Arial, Helvetica, sans-serif" color="coral" > '.$_SESSION['tajuk'].' </font></td>
	</tr>';
echo '</table><br/>';

$first = TRUE; // Initialize the variable.

// Query the database.
$query =   "SELECT  
			upload_id, 
			file_name, 
			nomlukisan, 
			ROUND(file_size/1024) AS fs, 
			description, 
			DATE_FORMAT(upload_date, '%M %e, %Y') AS d 
		FROM uploads 
		WHERE id_daftar = $order ORDER BY upload_date DESC";
$result = mysql_query ($query);


$bil=0;
while ($row = mysql_fetch_array ($result, MYSQL_ASSOC)) {
$bil++;
	// If this is the first record, create the table header.
	if ($first) {
		echo '<table border="0" width="940" cellspacing="1" cellpadding="1" align="center">
	<tr>
		<td valign=\"top\" align="left" width="25"><font size="3" color="orange" >Bil.</font></td>
		<td valign=\"top\" align="center" width="300"><font size="3" color="orange">Tajuk Lukisan / dokumen</font></td>
		<td valign=\"top\" align="center" width="300"><font size="3" color="orange" >No.Lukisan / catatan</font></td>

		<td valign=\"top\" align="center" width="100" bgcolor="#CCFECF"><font size="1" color="orange">Nama Fail
		<br/><small>(login todownload)</small></font></td>
		<td valign=\"top\" align="center" width="75"><font size="1" color="orange">Saiz fail</font></td>
		<td valign=\"top\" align="center" width="75"> <font size="1" color="orange"> Trk Upload</font></td>
	</tr>';
	} // End of $first IF.
	
	// Display each record.
$var = $row['file_name'];
$file_pendek =substr_replace($var,'',10,-5);

	echo "<table width=\"950\" height=\"25\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\" bordercolor=\"#CCCCCC\" bgcolor=\"#f2FBF0\" align=\"center\">
	<tr>
		<td valign=\"top\"  align=\"left\" width=\"25\"><font size=\"2\" color=\"black\">{$bil}</font></td>
		<td valign=\"top\"  align=\"left\" width=\"300\"><font size=\"2\" color=\"black\">{$row['nomlukisan']}</font></td>
		<td valign=\"top\"  align=\"left\" width=\"300\"><font size=\"2\" color=\"black\">{$row['description']}</font></td>
		<td valign=\"top\"  align=\"center\" width=\"100\" bgcolor=\"#FDFECF\"><font size=\"1\" color=\"orange\">{$file_pendek}</font></td>
		<td valign=\"top\"  align=\"center\" width=\"75\"><font size=\"1\" color=\"orange\">{$row['fs']}kb</font></td>
		<td valign=\"top\"  align=\"center\" width=\"75\"><font size=\"1\" color=\"orange\">{$row['d']}</font></td>
	</tr></table>\n";
	
	$first = FALSE; // One record has been returned.

} // End of while loop.

// If no records were displayed...
if ($first) {
	echo '<div align="center">There are currently no files to be viewed.</div>';
} else {
	echo '</table>'; // Close the table.
}

mysql_close(); // Close the database connection.
include_once ('includes/footer.html'); // Require the HTML footer.
?>