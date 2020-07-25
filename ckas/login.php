<?php # Script 12.7 - login.php
// This is the login page for the site.
$dr_entiti = $_GET['usm'];
$username = $dr_entiti;

// Include the configuration file for error management and such.
require_once ('html/includes/config.inc'); 

// Set the page title and include the HTML header.
$page_title = 'Login';
include ('html/header.htm');
echo "</small></center></fieldset>";


if (isset($_SESSION['first_name'])) {
echo "<small>Sesi semasa::> {$_SESSION['first_name']}";
}

if (isset($_POST['submit'])) { // Check if the form has been submitted.

	require_once ('mysql_connect.php'); // Connect to the database.
	
	if (empty($_POST['username'])) { // Validate the username.
		$u = FALSE;
		echo '<p><font color="red" size="+1">You forgot to enter your username!</font></p>';
	} else {
		$u = escape_data($_POST['username']);
	}
	
	if (empty($_POST['password'])) { // Validate the password.
		$p = FALSE;
		echo '<p><font color="red" size="+1">You forgot to enter your password!</font></p>';
	} else {
		$p = escape_data($_POST['password']);
	}
	
	if ($u && $p) { // If everything's OK.
	
		// Query the database.
		$query = "SELECT user_id, first_name,kp_s FROM users WHERE username='$u' AND password=OLD_PASSWORD('$p')";		
		$result = @mysql_query ($query);
		$row = mysql_fetch_array ($result, MYSQL_NUM); 
		
		if ($row) { // A match was made.
				
				// Start the session, register the values & redirect.
				$_SESSION['first_name'] = $row[1];
				$_SESSION['user_id'] = $row[0];
				$_SESSION['kp_s'] = $row[2];
				$_SESSION['username'] = $u;
				ob_end_clean(); // Delete the buffer.
				
		header ("Location:  http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/projek_daftar.php?event=Pinda");
				exit();
				
		} else { // No match was made.
			echo '<p><font color="red" size="+1">The username and password entered do not match those on file.</font></p>'; 
		}
		
		mysql_close(); // Close the database connection.
		
	} else { // If everything wasn't OK.
		echo '<p><font color="red" size="+1">Please try again.</font></p>';		
	}
	
} // End of SUBMIT conditional.
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
 //background: white url(../bground/RockpileA.jpg);// no-repeat top right; 
 background: white url(../images/randomsvg/49.svg) no-repeat top right; 
 } 
 .style8 {color:#CCCFFF;font-size:12px; font-weight:light } > 
 </style>


<div id="align_center">
<div class="form_fields">

<h3 style="color:#999999">Login</h3>
<p><small style="color:#999999" >Your browser must allow cookies in order to login.</small></p>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

Nama pengguna: <input type="text" name="username" size="20" maxlength="20" value="<?php echo $username; ?>" /><br />
Katalaluan: <input type="password" name="password" size="20" maxlength="20" /> <br />

<div align="center"><input type="submit" name="submit" value="Login" /></div>
</div>
</form>
</div>


<!--
<form action= "<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset width="60%">
<p><b> User Name: </b> <input type="text" name="username" size="20" maxlength="20" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>" />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;            
<b> Password: </b> <input type="password" name="password" size="20" maxlength="20" /> </p>
<div align="center"><input type="submit" name="submit" value="Login" /></div>
</fieldset></form> <!-- End of Form -->

<?php // Include the HTML footer.
include ('html/footer.htm');
?>