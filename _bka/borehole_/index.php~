<?php
ob_start();
session_start();
require_once('oic.php');
$_SESSION['OIC'] = $kp2OIC[$_SESSION['kp_s']];
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
	<h1>Borang Daftar Lokasi Borehole</h1>
	<form id="myForm" action="ajax.form.php" method="post">
		<div id="form_box">			
			<div>
      <p>TKH BORE</p>
      
	  <script> DateInput( 'trk_bore', true, 'YYYY-MM-DD')</script>
			</div>		
			<div>
      <p>Latitute</p>
	  <input name="lat" type="text" id="lat" class="textfield" value="">		
			</div>
			<div>
      <p>Longitude</p>
	  <input name="lng" type="text" id="lng" class="textfield" value="">		
			</div>
			<div>			
      <p>Ground Level</p>
	  <input name="ground_lvl" type="text" id="ground_lvl" class="textfield" value="">		
			</div>
			<div>			
      <p>Water Level</p>
	  <input name="water_lvl" type="text" id="water_lvl" class="textfield" value="">		
			</div>		
			<div>			
      <p>Catatan</p>
      <textarea rows="3" name="catatan" type="text" class="textfield" id="catatan" />Note:</textarea>
			</div>				

<input name="username" type="hidden" id="username" value="<?php echo $_SESSION['username'] ?>">		
<input name="user_id" type="hidden" id="user_id" value="<?php echo $_SESSION['user_id'] ?>">

		<input type="submit" name="button" id="submitter" />
		<span class="ajax-loading"><!-- spanner --></span>

<font color="gray"><small>
<?php
if (!isset($_SESSION['OIC'])) {	
echo 'Klik ke template <a href="../../ckas/index.php">Login</a>.</small>'; }
else {
echo 'Klik ke template <a href="../../ckas/projek_daftar.php?event=Pinda">Senarai Projek</a>.</small>';
} ?>
</font></div>	
	
	</form>
	<div id="log">
		<h3>Ajax Response</h3>
		<div id="log_res" ><!-- spanner --></div>
	</div>
	<span class="ajax-loading"><!-- spanner --></span>

</body>
</html>
