<?php # Script 11.8 - view_files.php

// Set the page title and include the HTML header.
$order = $_GET['uj'];

$idprojek = substr($order,0,-14);
$_SESSION['kp_s'] = substr($order,-14);



$page_title = 'Download lukisan - '.$order;
include_once ('includes/header.html');
include_once ('../../ip_SERVER.php');   /// feb2015

require_once ('../mysql_connect.php'); // Connect to the database.
$_SESSION['tajuk']='tiada projek dipilih!' ;
if (isset($_GET['uj'])){


		$q = "select tajuk from daftar_projek WHERE
			daftar_id = {$idprojek}";
		$r = mysql_query ($q);
		while ($tna = mysql_fetch_array ($r)) {
		$_SESSION['tajuk'] = $tna[0];
			}
}


//echo $_SESSION['kp_s']."<==kp_s::projID==>".$idprojek;
//echo "<br>regAPP".registerer_approved($_SESSION['kp_s']);
//echo "<br>inputKP is " . $inputKP . "<br>username:".$_SESSION['username'];

// Display all the URLs.
echo '<table border="0" width="940" cellspacing="1" cellpadding="1" align="center">
	<tr>
		<td valign="top" align="left" width="250"><font size="3" color="gray" >LUKISAN & DOKUMEN PROJEK :</font></td>
		<td align="left" width="650"><font size="4" face="Verdina, Arial, Helvetica, sans-serif" color="coral" > '.$_SESSION['tajuk'].' </font></td>
	</tr>';
echo '</table><br/>';


/// feb 2015
if (registerer_approved($_SESSION['kp_s'])=='false') {
	header ("Location:  http://" . $_SERVER['HTTP_HOST'] . "/index.php");
	ob_end_clean(); // Delete the buffer.
	exit(); // Quit the script.
	}




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
		WHERE id_daftar = $idprojek ORDER BY upload_date DESC";
$result = mysql_query ($query);


$bil=0;
while ($row = mysql_fetch_array ($result, MYSQL_ASSOC)) {
$bil++;
	// If this is the first record, create the table header.
	if ($first) {
		echo '<table border="0" width="940" cellspacing="1" cellpadding="1" align="center">
	<tr>
		<td valign=\"top\" align="left" width="25"><font size="3" color="orange" >Bil.</font><a href="../projek_daftar.php?event=Pinda" ><img src="../img/favicon.ico" border="0"></a></td>
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
		<td valign=\"top\" align=\"left\" width=\"25\"><font size=\"2\" color=\"black\">{$bil}</font></td>
		<td valign=\"top\" align=\"left\" width=\"300\"><font size=\"2\" color=\"black\">{$row['description']}</font></td>
		<td valign=\"top\" align=\"left\" width=\"300\"><font size=\"2\" color=\"black\">{$row['nomlukisan']}</font></td>
		<td valign=\"top\" align=\"center\" width=\"100\" bgcolor=\"#FDFECF\"><a href=\"download_file.php?uid={$row['upload_id']}\"><font size=\"1\" color=\"orange\">{$file_pendek}</font></a></td>
		<td valign=\"top\" align=\"center\" width=\"75\"><font size=\"1\" color=\"orange\">{$row['fs']}kb</font></td>
		<td valign=\"top\" align=\"center\" width=\"75\"><font size=\"1\" color=\"orange\">{$row['d']}</font></td>
	</tr></table>\n";
	
	$first = FALSE; // One record has been returned.

} // End of while loop.

// If no records were displayed...
if ($first) {
	echo '<div align="center">There are currently no files to be viewed.<br>Pereka belum upload apa-apa!</div>';
} else {
	echo '</table>'; // Close the table.
}

mysql_close(); // Close the database connection.
include_once ('includes/footer.html'); // Require the HTML footer.
?>
