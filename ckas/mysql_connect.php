<?php # Script 12.4 - mysql_connect.php

// Set the database access information as constants.

DEFINE ('DB_USER', 'ckasuser');
DEFINE ('DB_PASSWORD', 'password');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'ckas');
/*
DEFINE ('DB_USER', 'wsmedia_luqman');
DEFINE ('DB_PASSWORD', 'password!');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'wsmedia_luqman_ckas'); 
// DB_USER,DB_PASSWORD,DB_HOST,DB_NAME
DEFINE ('DB_USER', 'wsmedia_luqman');
DEFINE ('DB_PASSWORD', 'password!');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'wsmedia_luqman_ckas'); //*/
#####################

if ($dbc = @mysql_connect (DB_HOST, DB_USER, DB_PASSWORD)) { // Make the connnection.
   
	if (!mysql_select_db (DB_NAME)) { // If it can't select the database.
	
		// Handle the error.
		my_error_handler (mysql_errno(), 'Could not select the database: ' . mysql_error());	
		
		// Print a message to the user, include the footer, and kill the script.
		echo '<p><font color="red">The site is currently experiencing technical difficulties. We apologize for any inconvenience.</font></p>';
		include_once ('html/includes/footer.html');
		exit();
		
	} // End of mysql_select_db IF.
	
} else { // If it couldn't connect to MySQL.

	// Print a message to the user, include the footer, and kill the script.
	my_error_handler (mysql_errno(), 'Could not connect to the database: ' . mysql_error());
	echo '<p><font color="red">The site is currently experiencing technical difficulties. We apologize for any inconvenience.</font></p>';
	include_once ('html/includes/footer.html');
	exit();
	
}   // End of $dbc IF.

// Function for escaping and trimming form data.

function escape_data ($data) { 
	global $dbc;
	if (ini_get('magic_quotes_gpc')) {
		$data = stripslashes($data);
	}
	return mysql_real_escape_string (trim ($data), $dbc);
} 

// End of escape_data() function.

?>
