<?php
ob_start();
session_start();
require_once('oic.php');

$_SESSION['OIC'] = $kp2OIC[$_SESSION['kp_s']];
echo $_SESSION['OIC'].'oic';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="demo.css" type="text/css" />
	<script type="text/javascript" src="../_common/js/mootools-fs.js"></script>
	<script type="text/javascript" src="demo.js"></script>
	<script type="text/javascript" src="jasoncalendar/calendarDateInput.js"></script>

	<title>MooTools: Form.Send Kursus</title>
</head>
<body>
	<h1>Borang Daftar Kursus/latihan guna Ajax</h1>
	<form id="myForm" action="ajax.form.php" method="post">
		<div id="form_box">			
			<div>
      <p>TAJUK</p>
      <textarea rows="3" name="Tajuk" type="text" class="textfield" id="Tajuk" />tajuk kursus ...</textarea>
			</div>
			<div>
      <p>TKH MULA</p>
      
	  <script> DateInput( 'TrkMula', true, 'YYYY-MM-DD')</script>
			</div>
			<div>
      <p>TKH Tamat</p>
      
	  <script> DateInput( 'TrkTamat', false, 'YYYY-MM-DD')</script>
			</div>				
			<div>
      <p>Venue</p>
      <textarea rows="2" name="Venue" type="text" class="textfield" id="Venue" />venue  ...</textarea>
			</div>
			<div>
      <p>Penganjur</p>
      		<select name="Penganjur" type="text" class="textfield" id="Penganjur">
		          <option value="BKA" selected="selected">BKA</option>
		          <option value="CKASJ">CKASJ</option>
		          <option value="CPK">CPK</option>
		          <option value="PROKOM">PROKOM</option>
		          <option value="IKRAM">IKRAM</option>
		          <option value="Others">Others</option>	  
		        </select>	
			</div>
			<div>			
      <p>Kos</p>
      <textarea rows="1" name="Kos" type="text" class="textfield" id="Kos" />RM 0.00</textarea>
			</div>
			<div>			
      <p>Kod Kursus</p>
      <textarea rows="1" name="KodKursus" type="text" class="textfield" id="KodKursus" />kod1 </textarea>
			</div>
			<div>			
      <p>Bil Peserta</p>
      <textarea rows="1" name="BilangPeserta" type="text" class="textfield" id="BilangPeserta" />bil </textarea>
			</div>				
			
			
			
			<div>
      <p>Fail Rujukan</p>
      <textarea rows="1" name="FailRuj" type="text" class="textfield" id="FailRuj" />no fail ...</textarea>
			</div>
<input name="username" type="hidden" id="username" value="<?php echo $_SESSION['username'] ?>">		
<input name="kp_s" type="hidden" id="kp_s" value="<?php echo $_SESSION['kp_s'] ?>">

			
			<input type="submit" name="button" id="submitter" />
		<span class="ajax-loading"><!-- spanner --></span>
		
		
		</div>
	</form>
	<div id="log">
		<h3>Ajax Response</h3>
		<div id="log_res" ><!-- spanner --></div>
	</div>
	<span class="ajax-loading"><!-- spanner --></span>

</body>
</html>