<?php # Script 12.6 - register.php
// This is the registration page for the site.

// Include the configuration file for error management and such.
require_once ('html/includes/config.inc'); 

// Set the page title and include the HTML header.
$page_title = 'Register';
include ('html/header.htm');
echo "</small></center></fieldset>";

if (isset($_POST['submit'])) { // Handle the form.

	require_once ('mysql_connect.php'); // Connect to the database.
	
	// Check for a first name.
	if (eregi ("^[[:alpha:].' -]{2,15}$", stripslashes(trim($_POST['first_name'])))) {
		$fn = escape_data($_POST['first_name']);
	} else {
		$fn = FALSE;
		echo '<p><font color="red" size="+1">Please enter your first name!</font></p>';
	}
	
	// Check for a last name.
	if (eregi ("^[[:alpha:].' -]{2,30}$", stripslashes(trim($_POST['last_name'])))) {
		$ln = escape_data($_POST['last_name']);
	} else {
		$ln = FALSE;
		echo '<p><font color="red" size="+1">Please enter your last name!</font></p>';
	}
	
	// Check for an email address.
	if (eregi ("^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$", stripslashes(trim($_POST['email'])))) {
		$e = escape_data($_POST['email']);
	} else {
		$e = FALSE;
		echo '<p><font color="red" size="+1">Please enter a valid email address!</font></p>';
	}

	// Check for a username.
	if (eregi ("^[[:alnum:]_]{4,20}$", stripslashes(trim($_POST['username'])))) {
		$u = escape_data($_POST['username']);
	} else {
		$u = FALSE;
		echo '<p><font color="red" size="+1">Please enter a valid username!</font></p>';
	}
	
	// Check for a password and match against the confirmed password.
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
	
	// Check for kp.
	//if (eregi ("^[[:alnum:].' -]{2,15}$", stripslashes(trim($_POST['kp_s'])))) {
	//	$kp_s = escape_data($_POST['kp_s']);
	//} else {
	//	$kp_s = FALSE;
	//	echo '<p><font color="red" size="+1">Please enter your kad pengenalan baru!</font></p>';
	//}

	if (eregi ("([0-9]{6})-([0-9]{2})-([0-9]{4})",stripslashes(trim($_POST['kp_s'])),$reg)) {
		$kp_s = $reg[0];  ///escape_data($_POST['kp_s']);
	} else {
		$kp_s = FALSE;
		echo '<p><font color="red" size="+1">Please enter your kad pengenalan baru!</font></p>';
	}



	if ($fn && $ln && $e && $u && $p && $kp_s) { // If everything's OK.

		// Make sure the username is available.
		$query = "SELECT user_id FROM users WHERE username='$u'";		
		$result = @mysql_query ($query);
		
		if (mysql_num_rows($result) == 0) { // Available.
		
			// Add the user.
			$query = "INSERT INTO users (username, first_name, last_name, email, password, registration_date, kp_s) VALUES ('$u', '$fn', '$ln', '$e', OLD_PASSWORD('$p'), NOW(), '$kp_s')";		
			$result = @mysql_query ($query); // Run the query.

			if ($result) { // If it ran OK.
			
				// Send an email, if desired.
				echo '<center><h3>Thank you for registering!</h3></center>';
				include ('html/footer.htm'); // Include the HTML footer.
				exit();				
				
			} else { // If it did not run OK.
				// Send a message to the error log, if desired.
				echo '<p><font color="red" size="+1">You could not be registered due to a system error. We apologize for any inconvenience.</font></p>'; 
			}		
			
		} else { // The username is not available.
			echo '<p><font color="red" size="+1">That username is already taken.</font></p>'; 
		}
		
		mysql_close(); // Close the database connection.

	} else { // If one of the data tests failed.
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
 //background: white url(../bground/Wall4.jpg);// no-repeat top right; 
 } 
 .style8 {color:#CCCFFF;font-size:12px; font-weight:light } > 
 </style>


<div id="align_center">
<div class="form_fields">
<h3 style="color:#999999" >Daftar/Register</h3>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div>
<p>Nama pertama: <input type="text" name="first_name" size="30" maxlength="30" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>" /></p>
	
	<p>Nama kedua: <input type="text" name="last_name" size="30" maxlength="30" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>" /></p>
	
	<p>Alamat emel: <input type="text" name="email" size="35" maxlength="40" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" /> </p>
	
	<p>Nama pengguna: <input type="text" name="username" size="20" maxlength="20" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>" /> <br/> <small style="color:#999999" > Hanya abjad,nombor &amp; underscore; mesti > 4 dan < 20 pjng. </small></p>
	
	<p>Katalaluan: <input type="password" name="password1" size="20" maxlength="20" /><br/>  <small style="color:#999999" > Hanya abjad dan nombor; mesti > 4 dan < 20 pjng. </small></p>
	
	<p>Pasti katalaluan: <input type="password" name="password2" size="20" maxlength="20" /><br/>  <small style="color:#999999" > Hanya abjad dan nombor; mesti > 4 dan < 20 pjng. </small></p>
	
	<p><font color="green">Kad Pengenalan:</font> <input type="text" name="kp_s" size="20" maxlength="20" /><br/>  <small style="color:#999999" >Contoh yymmdd-xx-xxxx</small></p>
<div align="center"><input type="submit" name="submit" value="Register" /></div>
</div>	


</form>
</div>
</div>


	
	

<?php // Include the HTML footer.
include ('html/footer.htm');
?>
