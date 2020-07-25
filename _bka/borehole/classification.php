<?php
ob_start();
session_start();
require_once('oic.php');
$_SESSION['OIC'] = $kp2OIC[$_SESSION['kp_s']];
$bil_class = 5; //	$_SESSION['bil_class'];
$jobno = 5;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="demo.css" type="text/css" />
	<script type="text/javascript" src="../_common/js/mootools-fs.js"></script>
	<script type="text/javascript" src="demo.js"></script>
	<script type="text/javascript" src="jasoncalendar/calendarDateInput.js"></script>

	<title>Daftar Borehole</title>
</head>
<body>
	<h1>Borang Klasifikasi Lapisan Tanah</h1>
	<form id="myForm" action="ajaxclass.form.php" method="post">
		<div id="form_box">	
<?php		
	for ($k = 1 ; $k <= $bil_class ; $k++){
	echo '<div>		
      <p>Classification '.$k.'</p>
      <textarea rows="1" name="class'.$jobno.'#'.$k.'" type="text" class="textfield" id="class'.$jobno.'#'.$k.'" />Describe your soil:</textarea>
			</div>'; }
?>

<input name="username" type="hidden" id="username" value="<?php echo $_SESSION['username'] ?>">		
<input name="user_id" type="hidden" id="user_id" value="<?php echo $_SESSION['user_id'] ?>">

		<input type="submit" name="button" id="submitter" />
		<span class="ajax-loading"><!-- spanner --></span>
		
<font color="gray"><small>Klik ke template <a href="../../ckas/index.php">Login</a>.</small></font>	
		</div>
		
	</form>
	<div id="log">
		<h3>Ajax Response</h3>
		<div id="log_res" ><!-- spanner --></div>
	</div>
	<span class="ajax-loading"><!-- spanner --></span>

</body>
</html>
