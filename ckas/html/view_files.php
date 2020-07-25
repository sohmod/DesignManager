<?php # Script 11.8 - view_files.php
// This page displays the files uploaded to the server.

// Set the page title and include the HTML header.
$page_title = 'View Files';
//include_once ('includes/header.html');

require_once ('../mysql_connect.php'); // Connect to the database.

$first = TRUE; // Initialize the variable.

// Query the database.
$query = "SELECT upload_id, file_name, ROUND(file_size/1024) AS fs, description, DATE_FORMAT(upload_date, '%M %e, %Y') AS d FROM uploads ORDER BY upload_date DESC";
$result = mysql_query ($query);

// Display all the URLs.
while ($row = mysql_fetch_array ($result, MYSQL_ASSOC)) {

	// If this is the first record, create the table header.
	if ($first) {
		echo '<table border="0" width="100%" cellspacing="3" cellpadding="3" align="center">
	<tr>
		<td align="left" width="35%"><font size="-1" color="orange" >Nama Fail</font></td>
		<td align="left" width="35%"><font size="-1" color="orange" >Keterangan</font></td>
		<td align="center" width="15%"><font size="-1" color="orange" >Saiz fail</font></td>
		<td align="left" width="15%"><font size="-1" color="orange" >Trk Upload</font></td>
	</tr>';
	} // End of $first IF.
	
	// Display each record.
	echo "<table width=\"950\" height=\"25\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\" bordercolor=\"#CCCCCC\" bgcolor=\"#f2FBF0\">
	<tr>
		<td align=\"left\" width=\"35%\"><a href=\"download_file.php?uid={$row['upload_id']}\"><small>{$row['file_name']}</small></a></td>
		<td align=\"left\" width=\"35%\"><small>" . stripslashes($row['description']) . "</small></td>
		<td align=\"center\" width=\"15%\"><small>{$row['fs']}kb</small></td>
		<td align=\"left\" width=\"15%\"><small>{$row['d']}</small></td>
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