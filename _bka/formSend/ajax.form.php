<?php
ob_start();
session_start();
require_once('config.php');
require_once('oic.php');

/////////////////123
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
	$Tajuk = $_POST['Tajuk'];
	$Venue = $_POST['Venue'];
	$Penganjur = $_POST['Penganjur'];
	$Kos = $_POST['Kos'];
	$KodKursus = $_POST['KodKursus'];
	$BilangPeserta = $_POST['BilangPeserta'];

	//Input Validations
	if($Tajuk == '') {
		$errmsg_arr[] = 'tajuk tercicir';
		$errflag = true;
	}
	if($Venue == '') {
		$errmsg_arr[] = 'venue tercicir';
		$errflag = true;
	}
	if($Penganjur == '') {
		$errmsg_arr[] = 'Penganjur tercicir';
		$errflag = true;
	}
	if($Kos == '') {
		$errmsg_arr[] = 'Kos tercicir';
		$errflag = true;
	}	
	if($KodKursus == '') {
		$errmsg_arr[] = 'KodKursus tercicir';
		$errflag = true;
	}
	if($BilangPeserta == '') {
		$errmsg_arr[] = 'Bilangan Peserta tercicir';
		$errflag = true;
	}	
	
	$cdquot = '"';
	$posTajuk = strpos($Tajuk, $cdquot);
	$posVenue = strpos($Venue, $cdquot);
	$posPenganjur = strpos($Penganjur, $cdquot);
	$posKos = strpos($Kos, $cdquot);
	$posKodKursus = strpos($KodKursus, $cdquot);
	$posBilangPeserta = strpos($BilangPeserta, $cdquot);

	
	if($posTajuk !== false) {
		$errmsg_arr[] = 'Jangan guna double quot dlm tajuk !';
		$errflag = true;
	}
	if($posVenue !== false) {
		$errmsg_arr[] = 'Jangan guna double quot dlm venue !';
		$errflag = true;
	}
	if($posPenganjur !== false) {
		$errmsg_arr[] = 'Jangan guna double quot dlm penganjur !';
		$errflag = true;
	}
	if($posKos !== false) {
		$errmsg_arr[] = 'Jangan guna double quot dlm kos !';
		$errflag = true;
	}	
	if($posKodKursus !== false) {
		$errmsg_arr[] = 'Jangan guna double quot dlm kod kursus !';
		$errflag = true;
	}
	if($posBilangPeserta !== false) {
		$errmsg_arr[] = 'Jangan guna double quot dlm bil peserta !';
		$errflag = true;
	}	
	
	
	
	
	
	
	
	
	//If there are input validations, redirect back to the registration form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
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
	
	
	

	$_SESSION['Idy'] = $_POST['Idy'];
    $_SESSION['Tajuk'] = $_POST['Tajuk'];
    $_SESSION['TrkMula'] = $_POST['TrkMula'];
    $_SESSION['TrkTamat'] = $_POST['TrkTamat'];
	$_SESSION['Venue'] = $_POST['Venue'];
	$_SESSION['Penganjur'] = $_POST['Penganjur'];
	$_SESSION['Kos'] = $_POST['Kos'];
	$_SESSION['FailRuj'] =  $_POST['FailRuj'];
    $_SESSION['KodKursus'] = $_POST['KodKursus'];	
    $_SESSION['username'] = $_POST['username'];
	$_SESSION['BilangPeserta'] =  $_POST['BilangPeserta'];  
    $_SESSION['kp_s'] = $_POST['kp_s'];
    $_SESSION['tarikhDaftar'] = date("Y-m-d H:i:s");

$Penganjur = trim($_SESSION['Penganjur']);
//$lokasi = trim($_SESSION['lokasi']);
//$kem = trim($_SESSION['KemKlient']);
//Connect to mysql db
$conn = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
mysql_select_db(DB_DATABASE,$conn);

//$res_id = mysql_query("SELECT * FROM tna_kursus");
//$_SESSION['KodKursus'] = mysql_num_rows($res_id)+1;

	
//$result = mysql_query("SELECT * FROM tna_kursus WHERE Penganjur ='$Penganjur'");
//$count = mysql_num_rows($result);
//	$_SESSION['KodKursus'] = $count+1;

?>

<form action="register-success.php" method="post">
<table width="300" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor= "">	
	<tr><td width="100" style="font-size:11px">Tajuk =></td><td><input name="Tajuk" type="text" id="Tajuk" value="<?php echo $_SESSION['Tajuk'];?>" disabled="true"></td></tr>
	<tr><td width="100" style="font-size:11px">TrkMula =></td><td><input name="TrkMula" type="text" id="TrkMula" value="<?php echo $_SESSION['TrkMula'];?>" disabled="true"></td></tr>
	<tr><td width="100" style="font-size:11px">TrkTamat =></td><td><input name="TrkTamat" type="text" id="TrkTamat" value="<?php echo $_SESSION['TrkTamat'];?>" disabled="true"></td></tr>
	<tr><td width="100" style="font-size:11px">Venue =></td><td><input name="Venue" type="text" id="Venue" value="<?php echo $_SESSION['Venue'];?>" disabled="true"></td></tr>
	<tr><td width="100" style="font-size:11px">Penganjur =></td><td><input name="Penganjur" type="text" id="Penganjur" value="<?php echo$_SESSION['Penganjur'];?>" disabled="true"></td></tr>
	<tr><td width="100" style="font-size:11px">Kos =></td><td><input name="Kos" type="text" id="Kos" value="<?php echo$_SESSION['Kos'];?>" disabled="true"></td></tr>
	<tr><td width="100" style="font-size:11px">FailRuj =></td><td><input name="FailRuj" type="text" id="FailRuj" value="<?php echo$_SESSION['FailRuj'];?>" disabled="true"></td></tr>	
	<tr><td width="100" style="font-size:11px">KodKursus =></td><td><input name="KodKursus" type="text" id="KodKursus" value="<?php echo$_SESSION['KodKursus'];?>"></td></tr>	
	<tr><td width="100" style="font-size:11px">BilangPeserta =></td><td><input name="BilangPeserta" type="text" id="BilangPeserta" value="<?php echo$_SESSION['BilangPeserta'];?>" disabled="true"></td></tr>	
	<tr><td width="100" style="font-size:11px">username* =></td><td><input name="username" type="text" id="username" value="<?php echo$_SESSION['username'];?>" disabled="true"></td></tr>	
	<tr><td width="100" style="font-size:11px">kp_s* =></td><td><input name="kp_s" type="text" id="kp_s" value="<?php echo$_SESSION['kp_s'];?>" disabled="true"></td></tr>	
	
	
	
	<br/>
	<tr><td width="100"><input type="submit" name="button1" id="submitter1" value="Daftar Kursus" /></td></tr>
</table>
</form>

<?php 
print "<pre>".print_r($_POST, true)."</pre>";
ob_flush();

?>