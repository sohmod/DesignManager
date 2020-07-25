<?php # Script 12.8 - logout.php
// This is the logout page for the site.

// Include the configuration file for error management and such.
require_once ('includes/config.inc'); 

// Set the page title and include the HTML header.
$page_title = 'Logout';
include_once ('header_out.htm');
// If no first_name variable exists, redirect the user.
/*if (!isset($_SESSION['first_name'])) {

	header ("Location:  http://" . $_SERVER['HTTP_HOST'] .dirname($_SERVER['PHP_SELF']) . "/index.php");
	ob_end_clean(); // Delete the buffer.
	exit(); // Quit the script.
	
} else { // Logout the user. */

	$_SESSION = array(); // Destroy the variables.
	session_destroy(); // Destroy the session itself.
	setcookie (session_name(), '', time()-300, '/', '', 0); // Destroy the cookie.

// }
?>

 <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1">
 <style type="text/css">
 a:link { text-decoration:none ; font-size:12px; font-weight:normal }
 a:visited { text-decoration:none ; font-size:12px; font-weight:normal }
 a:hover { text-decoration:underline ; font-size:12px; font-weight:normal }
 body { font-family:Verdana,Arial,Helvetica,sans-serif;font-size:12px; } 
 background: gray url(../img/bismillah.jpg);// no-repeat top right; 
 .style8 {color:#CEE3F6;font-size:12px; font-weight:light } > 
 </style>


<h3 style="text-align: center;color:red;font-size:22px;">You are now logged out.</h3>

<?php // Include the HTML footer.

include ('footer.htm'); // Include the HTML footer.
?>