<?php
ob_start();
session_start();
require_once('config.php');
require_once('oic.php');

/////////////////123
unset ( $_SESSION['ERRMSG_ARR'] );
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	

	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	//Sanitize the POST values

    $trk_bore = $_POST['trk_bore'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
	$ground_lvl = $_POST['ground_lvl'];
	$water_lvl = $_POST['water_lvl'];
	$catatan = $_POST['catatan'];
	$user_name =  $_POST['username'];
    $user_id = $_POST['user_id'];	
    $trk_daftar = date("Y-m-d H:i:s");	

	//Input Validations
	if($lat == '' || !is_numeric($lat)) {
		$errmsg_arr[] = 'lat tercicir/numerical';
		$errflag = true;
	}
	if($lng == '' || !is_numeric($lng)) {
		$errmsg_arr[] = 'lng tercicir/numerical';
		$errflag = true;
	}
	if($ground_lvl == '' || !is_numeric($ground_lvl)) {
		$errmsg_arr[] = 'ground_lvl tercicir/numerical';
		$errflag = true;
	}
	if($water_lvl == '' || !is_numeric($water_lvl)) {
		$errmsg_arr[] = 'water_lvl tercicir/numerical';
		$errflag = true;
	}	
	if($catatan == '') {
		$errmsg_arr[] = 'catatan perlu ada';
		$errflag = true;
	}
	

	
	
	
	
	//If there are input validations, redirect back to the registration form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		print "<pre>".print_r($_SESSION['ERRMSG_ARR'], true)."</pre>";

	}	

///////////////\\\\\\\\\\\\\
//require ("oic.php");

echo '<style type="text/css">
#p {
	float: left;
	margin: 4px 0pt;
	width: 50px;}
#p input {
	float: left;
	margin: 4px 0pt;
	width: 50px;
	} 

</style>';


// login 
/*
echo 	$_SESSION['kp_s'].' kp_s ';
echo 	$_SESSION['username'].' username ';
echo 	$_SESSION['first_name'].' first_name ';
echo 	$_SESSION['user_id'].' user_id ';
*/

	$_SESSION['idy'] = $_POST['idy'];
    $_SESSION['trk_bore'] = $_POST['trk_bore'];
    $_SESSION['lat'] = $_POST['lat'];
    $_SESSION['lng'] = $_POST['lng'];
	$_SESSION['ground_lvl'] = $_POST['ground_lvl'];
	$_SESSION['water_lvl'] = $_POST['water_lvl'];
	$_SESSION['catatan'] = $_POST['catatan'];
	$_SESSION['username'] =  $_POST['username'];
    $_SESSION['user_id'] = $_POST['user_id'];	
    $_SESSION['trk_daftar'] = date("Y-m-d H:i:s");

$conn = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
mysql_select_db(DB_DATABASE,$conn);
	
$result = mysql_query("SELECT * FROM eb_borehole");
$count = mysql_num_rows($result);
	$_SESSION['idy'] = $count+1;

?>

<form action="register-success.php" method="post">
<table width="300" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor= "">	
	<tr><td width="100" style="font-size:11px">idy =></td><td><input name="idy" type="text" id="idy" value="<?php echo $_SESSION['idy'];?>" disabled="true"></td></tr>
	<tr><td width="100" style="font-size:11px">trk_bore =></td><td><input name="trk_bore" type="text" id="trk_bore" value="<?php echo $_SESSION['trk_bore'];?>" disabled="true"></td></tr>
	<tr><td width="100" style="font-size:11px">lat =></td><td><input name="lat" type="text" id="lat" value="<?php echo $_SESSION['lat'];?>" disabled="true"></td></tr>
	<tr><td width="100" style="font-size:11px">lng =></td><td><input name="lng" type="text" id="lng" value="<?php echo $_SESSION['lng'];?>" disabled="true"></td></tr>
	<tr><td width="100" style="font-size:11px">ground_lvl =></td><td><input name="ground_lvl" type="text" id="ground_lvl" value="<?php echo$_SESSION['ground_lvl'];?>" disabled="true"></td></tr>
	<tr><td width="100" style="font-size:11px">water_lvl =></td><td><input name="water_lvl" type="text" id="water_lvl" value="<?php echo$_SESSION['water_lvl'];?>" disabled="true"></td></tr>
	<tr><td width="100" style="font-size:11px">catatan =></td><td><input name="catatan" type="text" id="catatan" value="<?php echo$_SESSION['catatan'];?>" disabled="true"></td></tr>	
	<tr><td width="100" style="font-size:11px">username =></td><td><input name="username" type="text" id="username" value="<?php echo $_SESSION['username'];?>"></td></tr>	
	<tr><td width="100" style="font-size:11px">user_id =></td><td><input name="user_id" type="text" id="user_id" value="<?php echo $_SESSION['user_id'];?>" disabled="true"></td></tr>	
	<tr><td width="100" style="font-size:11px">trk_daftar =></td><td><input name="trk_daftar" type="text" id="trk_daftar" value="<?php echo $_SESSION['trk_daftar'];?>" disabled="true"></td></tr>
	<br/>	
<?php 	if(!$errflag && !empty($_SESSION['OIC'])) { ?>
	<tr><td width="100"><input type="submit" name="button1" id="submitter1" value="Daftar BoreHole" /></td></tr>
	<?php }
	 ?>
</table>
</form>

<?php 
// print "<pre>".print_r($_POST, true)."</pre>";
ob_flush();
echo '<p style="font-size:8px;color:red;align:right;"><a href="register-success.php">Insert into Database</a></p>';
echo '<p style="font-size:8px;color:red;align:right;"><a href="lokasi_senarai.php">Senarai Lokasi BH</a></p>';

?>
