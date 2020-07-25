<?php # Script 11.9 - download_file.php
// This pages handles file downloads through headers.

if (is_numeric ($_GET['uid'])) { // Check for an upload ID.

	require_once ('../mysql_connect.php'); // Connect to the database.

	// Get the information for this file.
	$query = "SELECT file_name, file_type, file_size FROM uploads WHERE upload_id = {$_GET['uid']}";
	$result = mysql_query ($query);
	list ($fn, $ft, $fs) = mysql_fetch_array ($result, MYSQL_NUM);
	mysql_close(); // Close the database connection.

	// Determine the file name on the server.
	$extension = explode ('.', $fn);
	$the_file = '../uploads/' . $_GET['uid'] . '.' . $extension[1];
	
	// Check if it exists.
	if (file_exists ($the_file)) {
	

		// Send the file.		
		//header ("Cache-Control: private");  // tambahan yg disyor oleh somebody
		header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
		header ("Content-Type: application/$ft");
		header ("Content-disposition: attachment; filename=$fn");
		//header ("Content-disposition: inline; filename=$fn");
		header ("Content-Length: $fs");
		readfile ($the_file);
		
		$message = '<p>The file has been sent.</p>';

	} else { // File doesn't exist.
		$message = '<p><font color="red">The file could not be located on the server. We apologize for any inconvenience.</font></p>'; 
	}


} else { // No valid upload ID.

		$message = '<p><font color="red">Please select a valid file to download.</font></p>'; 

}

// Set the page title and include the HTML header.
$page_title = 'File Download';
include_once ('includes/header.html');

echo $message;

include_once ('includes/footer.html');
?>