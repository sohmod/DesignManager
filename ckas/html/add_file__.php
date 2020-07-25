<?php # Script 11.7 - add_file.php
// This page allows users to upload files to the server.
//$ng=array;$sg=array;$ns=array();

// Set the page title and include the HTML header.
$page_title = 'Upload';
include ('includes/header.html');
	require_once ('../mysql_connect.php'); // Connect to the database.
if ( isset($_GET['uj'])){
	$_SESSION['id_daftar'] = $_GET['uj'];}

		$q = "select tajuk from daftar_projek where daftar_id = '{$_SESSION['id_daftar']}'";
		$r = mysql_query ($q);
		while ($tna = mysql_fetch_array ($r)) {
		$_SESSION['tajuk'] = $tna[0];
			}
		
//$count=mysql_query("SELECT COUNT(*) FROM butiran_struktur WHERE id_daftar = '{$_SESSION['id_daftar']}'");$count=mysql_fetch_array($count);
//$count=$count[0]; echo $count.'<--count';
$count=mysql_query("SELECT COUNT(*) FROM uploads WHERE id_daftar = '{$_SESSION['id_daftar']}'");$count=mysql_fetch_array($count);
$count=$count[0]; echo 'Jumlah lukisan uploaded = '.$count.'&nbsp;&nbsp;<small>Oleh '.$_SESSION['first_name'].
'<small>'.$_SESSION['maklum'].'</small>' ;
echo $_SESSION['nomgertak'].'<--nogertak'.$_SESSION['siapaload'] .'==='. $_SESSION['username']  ;

if (isset($_POST['submit'])) { // Handle the form.
//unset ($submit);


if ($_SESSION['tajuk']=='tiada projek dipilih!'){ echo '
<br/><font size="4" face="Verdina, Arial, Helvetica, sans-serif" color="coral" style="margin-left:100px" >
Sila daftar ! </font>
<br/><font size="4" face="Verdina, Arial, Helvetica, sans-serif" color="coral" style="margin-left:200px" >
Login ! </font>
<br/><font size="4" face="Verdina, Arial, Helvetica, sans-serif" color="coral" style="margin-left:260px" >
Pilih projek sah!
<br/><font size="4" face="Verdina, Arial, Helvetica, sans-serif" color="coral" style="margin-left:400px" >
Anyway, bukan semua dibenarkan upload files! </font>';

exit(); }
/////////
	require_once ('../mysql_connect.php'); // Connect to the database.

	// Function for escaping and trimming form data.
	/*function escape_data ($data) { 
		global $dbc;
		if (ini_get('magic_quotes_gpc')) {
			$data = stripslashes($data);
		}
		return mysql_real_escape_string (trim ($data), $dbc);
	} // End of escape_data() function.*/
	

if (!empty($_POST['id_daftar'])) {
		$i = escape_data($_POST['id_daftar']);
	} else {
		$i = FALSE;
		echo '<p><font color="coral" size="+1">Please enter a valid id_daftar!</font></p>';
	}
if (!empty($_POST['nomgertak']) || isset($_SESSION['nomgertak'])) {
	//unset ( $_SESSION['siapaload'] ) ;

		$g = escape_data($_POST['nomgertak']);
		$siapa = explode("-", $g);
			$g = 	trim($siapa[0]);
			$gs = trim($siapa[1]);
if (isset($_SESSION['nomgertak'])){$g = $_SESSION['nomgertak']; $gs = $_SESSION['siapaload'] ; }
$_SESSION['nomgertak'] = $g;
$_SESSION['siapaload'] = $gs ;
	} else {
		$g = FALSE;
		echo '<p><font color="coral" size="+1">Please enter nombor jambatan - klik butang bulat!</font></p>';
	}
	// Check for a description (not required).
	if (!empty($_POST['description'])) {
		$d = escape_data($_POST['description']);
	} else {
		$d = FALSE;
		echo '<p><font color="coral" size="+1">Please enter tajuk lukisan!</font></p>';
	}
if (!empty($_POST['nomlukisan'])) {
		$l = escape_data($_POST['nomlukisan']);
	} else {
		$l = FALSE;
		echo '<p><font color="coral" size="+1">Please enter nombor lukisan!</font></p>';
	}
	
$f=$_FILES['upload']['name'];
if (!empty($f)) {
		$f = TRUE;
	} else {
		$f = FALSE;
		echo '<p><font color="coral" size="+1">Please pilih fail!</font></p>';
	}
$u=$_SESSION['first_name'];$uw=$u;
if (!empty($u)) {
		$u = TRUE;
	} else {
		$u = FALSE;
		echo '<p><font color="coral" size="+1">You are not login!</font></p>';
	}

	if ($_SESSION['siapaload'] === $_SESSION['username']) {  // bawanaik fail oleh pereka sahaja

if ($i && $g && $l && $d && $f && $u) { // If everything's OK.

	// Add the record to the database.
	$query = "INSERT INTO uploads (file_name, file_size, file_type, id_daftar, nomgertak, nomlukisan, description, upload_date, first_name) VALUES 
('{$_FILES['upload']['name']}', {$_FILES['upload']['size']}, '{$_FILES['upload']['type']}', '$i', '$g', '$l', '$d', NOW(), '$uw')";
	$result = @mysql_query ($query);

	if ($result) {
		
		// Create the file name.
		$extension = explode ('.', $_FILES['upload']['name']);
		$uid = mysql_insert_id(); // Upload ID
		$filename = $uid . '.' . $extension[1];
		
		// Move the file over.
		if (move_uploaded_file($_FILES['upload']['tmp_name'], "../uploads/$filename")) {
			echo '<p>The file has been uploaded!</p>';
unset ( $_SESSION['maklum']  ) ;   ////, $i , $g , $l , $d , $f , $u 
$_SESSION['maklum'] = '<p>The file has been uploaded!</p>';
		} 

		else {
			echo '<p><font color="red">The file could not be moved.</font></p>';

			// Remove the record from the database.
			$query = "DELETE FROM uploads WHERE upload_id = $uid";
			$result = @mysql_query ($query);
unset ( $_SESSION['maklum'] ) ;
$_SESSION['maklum'] = '<p><font color="red">The file could not be moved.</font></p>';

		}
		
	} else { // If the query did not run OK.
		echo '<p><font color="red">Your submission could not be processed due to a system error. We apologize for any inconvenience.</font></p>'; 
unset ( $_SESSION['maklum'] ) ;
$_SESSION['maklum'] = '<p><font color="red">Your submission could not be processed due to a system error. 
				We apologize for any inconvenience.</font></p>'; 




	}

//////////////////////




		} // hujung siapa bawanaik lukisan
		







	mysql_close(); // Close the database connection.

	} else { // If one of the data tests failed.
////////////////////////
				//ob_end_clean(); // Delete the buffer.
				//header ("Location:  http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/add_file.php");
				//exit();






		echo '<p><font color="red" size="+1">Please try again.</font></p>';
			unset ( $_SESSION['maklum'] ) ;
		$_SESSION['maklum'] = '<p><font color="coral">Anda bukan pereka projek ini.</font></p>';

	}
	

} // End of the main Submit conditional.
?>
	
<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

<input type="hidden" name="MAX_FILE_SIZE" value="5120000"> <!--// //524288-->

<fieldset><legend><small><small>Sila isi borang ini untuk bawanaik fail lukisan </small>
<font color="darkkhaki"><?php echo 'Projek (ujcj) Nombor : &nbsp;'. $_SESSION['id_daftar'].'&nbsp; Jambatan:'.
$_SESSION['nomgertak'] ; ?></font> 
</small> </legend>


<div style="margin-top:15px;margin-left:25px"><font color="darkkhaki"><b>TAJUK PROJEK:</b></font> 
<font size="4" face="Verdina, Arial, Helvetica, sans-serif" color="coral" style="margin-left:53px" ><?php echo $_SESSION['tajuk'] ; ?></font></div>	 

<?php

require_once ('../mysql_connect.php'); // Connect to the database.
		$qow = "select nomstruktur, nomgertak, OIC from butiran_struktur WHERE
			id_daftar = '{$_SESSION['id_daftar']}'";
		$rw = mysql_query($qow);

		while ($row = mysql_fetch_array ($rw)) {
		echo '<font size="2" face="Verdina, Arial, Helvetica, sans-serif" style="margin-top:15px;margin-left:25px">
		<b><input type="radio" name="nomgertak" value="'.$row['nomgertak'].'-'.$row['OIC'].'" /></b>No Struktur : '. 
		$row['nomstruktur'].' / pereka '.$row['nomgertak'].'-'.$row['OIC'].'<br />'; 

} 
?>

<div style="margin-top:15px;margin-left:25px"><font color="darkkhaki"><b>Tajuk Lukisan:</b></font> 
<font color="coral" style="margin-left:67px"><textarea name="description" cols="75" rows="3"></textarea></font></div>

<div style="margin-top:15px;margin-left:25px"><font color="darkkhaki"><b>Nombor Lukisan:</b></font> 
<font color="coral" style="margin-left:53px"><textarea name="nomlukisan" cols="75" rows="2"></textarea></font></div>

<div style="margin-top:15px;margin-left:25px"><font color="darkkhaki"><b>Fail Lukisan toupload:</b></font> 
<font color="coral" style="margin-left:19px"><input type="file" name="upload" cols="75" /></font></div>

</fieldset>
	
<div align="center"><input type="submit" name="submit" value="Submit" /></div>

<input name="id_daftar" type="hidden" id="id_daftar" value="<?php echo $_SESSION['id_daftar'] ?> 



</form><!-- End of Form -->

<?php
include ('includes/footer.html'); // Include the HTML footer.
?>