<?php # Script 12.10 - change_password.php
// This page allows a logged-in user to change their password.

// Include the configuration file for error management and such.
require_once ('html/includes/config.inc'); 

// Set the page title and include the HTML header.
$page_title = 'Change Your Password';
include_once ('html/header.htm');
echo "</small></center></fieldset>";

// If no first_name variable exists, redirect the user.
if (!isset($_SESSION['first_name'])) {

	header ("Location:  http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/index.php");
	ob_end_clean();
	exit();
	
} else {

if ($_SESSION['first_name'] == "Demo"){
	header ("Location:  http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/index.php");
	ob_end_clean();
	exit();}


	if (isset($_POST['submit'])) { // Handle the form.
	
		require_once ('mysql_connect.php'); // Connect to the database.
				
		// Check for a new password and match against the confirmed password.
		if (eregi ("^[[:alnum:]]{4,20}$", stripslashes(trim($_POST['password1'])))) {
			if ($_POST['password1'] == $_POST['password2']) {
				$p = escape_data($_POST['password1']);
			} else {
				$p = FALSE;
				echo '<p><font color="red" size="+1">Your password did not match the confirmed password!</font></p>';
			}
		} else {
			$p = FALSE;
			echo '<p><font color="red" size="+1">Please enter a valid password!</font></p>';
		}
		
		if ($p) { // If everything's OK.
	
			// Make the query.
			$query = "UPDATE users SET password=OLD_PASSWORD('$p') WHERE user_id={$_SESSION['user_id']}";		
			$result = @mysql_query ($query); // Run the query.
			if (mysql_affected_rows() == 1) { // If it ran OK.
			
				// Send an email, if desired.
				echo '<h3>Your password has been changed.</h3>';
				include ('html/footer.htm'); // Include the HTML footer.
				exit();				
				
			} else { // If it did not run OK.
			
				// Send a message to the error log, if desired.
				$message = '<p><font color="red" size="+1">Your password could not be changed due to a system error. We apologize for any inconvenience.</font></p>'; 

			}		
			mysql_close(); // Close the database connection.
	
		} else { // Failed the validation test.
			echo '<p><font color="red" size="+1">Please try again.</font></p>';		
		}
	
	} // End of the main Submit conditional.
	
	?>
	<style type="text/css">
	<!--
	@import url("newloglayout/bstyle.css");
	#align_center {
	text-align: center;
	width: 400px;
	}
	//-->
	</style>
 <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1">
 <style type="text/css">
 a:link { text-decoration:none ; font-size:12px; font-weight:normal }
 a:visited { text-decoration:none ; font-size:12px; font-weight:normal }
 a:hover { text-decoration:underline ; font-size:12px; font-weight:normal }
 body { font-family:Verdana,Arial,Helvetica,sans-serif;font-size:12px;
 //background: white url(../bground/Lumber.jpg);// no-repeat top right; 
 } 
 .style8 {color:#CCCFFF;font-size:12px; font-weight:light } > 
 </style>

<div id="align_center">
<div class="form_fields">

<h3 style="color:#999999" >Change Your Password</h3>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<fieldset>
	<p><b>New Password:</b> <input type="password" name="password1" size="20" maxlength="20" /> <small>Use only letters and numbers. Must be between 4 and 20 characters long.</small></p>
	<p><b>Confirm New Password:</b> <input type="password" name="password2" size="20" maxlength="20" /></p>
	</fieldset>
	<div align="center"><input type="submit" name="submit" value="Change My Password" /></div>
	</form><!-- End of Form -->

<?php
} // End of the !isset($_SESSION['first_name']) ELSE.
include ('html/footer.htm'); // Include the HTML footer.
?>
