<?php # Script 12.9 - forgot_password.php
// This page allows a user to reset their password, if forgotten.

// Include the configuration file for error management and such.
require_once ('html/includes/config.inc'); 

// Set the page title and include the HTML header.
$page_title = 'Forgot Your Password';
include_once ('html/header.htm');
echo "</small></center></fieldset>";

if (isset($_POST['submit'])) { // Handle the form.

	require_once ('mysql_connect.php'); // Connect to the database.
			
	if (empty($_POST['username'])) { // Validate the username.
		$u = FALSE;
		echo '<p><font color="red" size="+1">You forgot to enter your username!</font></p>';
	} else {
		$u = escape_data($_POST['username']);
		
		// Check for the existence of that username.
		$query = "SELECT user_id, email FROM users WHERE username='$u'";		
		$result = @mysql_query ($query);
		$row = mysql_fetch_array ($result, MYSQL_NUM); 
		if ($row) {
			$uid = $row[0];
			$email = $row[1];
		} else {
			echo '<p><font color="red" size="+1">The submitted username does not match those on file!</font></p>';
			$u = FALSE;
		}
		
	}
	
	if ($u) { // If everything's OK.

		// Create a new, random password.
		$p = substr ( md5(uniqid(rand(),1)), 3, 10);

		// Make the query.
		$query = "UPDATE users SET password=OLD_PASSWORD('$p') WHERE user_id=$uid";		
		$result = @mysql_query ($query); // Run the query.
		if (mysql_affected_rows() == 1) { // If it ran OK.
		
			// Send an email.
			$body = "Your password to log into 'wsmedia6.com/ckas' has been temporarily changed to '$p'. Please log-in using this password and your username. At that time you may change your password to something more familiar.";
			mail ($email, 'Your temporary password.', $body, 'From: admin@sitename.com');
			echo '<h3>Your password has been changed. You will receive the new, temporary password at the email address with which you registered. Once you have logged in with this password, you may change it by clicking on the "Change Password" link.</h3>';
			//include ('includes/footer.html'); // Include the HTML footer.
			include ('html/footer.htm');
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
 //background: white url(../bground/Asphalt.jpg);// no-repeat top right; 
 } 
 .style8 {color:#CCCFFF;font-size:12px; font-weight:light } > 
 </style>

<div id="align_center">
<div class="form_fields">

<h3 style="color:#999999" >Reset Your Password</h3>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div>
Nama pengguna: <input type="text" name="username" size="20" maxlength="20" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>" />
<br/><small style="color:#999999" >Enter your username and your password will be reset.</small> 
<div align="center"><input type="submit" name="submit" value="Reset My Password" /></div>

</div>
</form>
</div>
</div>

<!--
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset>
	<p><b>User Name:</b> <input type="text" name="username" size="20" maxlength="20" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>" />
&nbsp;Enter your username and your password will be reset.</p> 
</fieldset>
<div align="center"><input type="submit" name="submit" value="Reset My Password" /></div>
</form><!-- End of Form -->

<?php
include ('html/footer.htm'); // Include the HTML footer.
?>
