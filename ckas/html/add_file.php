<?php # Script 11.7 - add_file.php
// This page allows users to upload files to the server.
//$ng=array;$sg=array;$ns=array();

// Set the page title and include the HTML header.
//include_once ('header.htm');

$page_title = 'Upload bka';


include ('includes/header.html');
	require_once ('../mysql_connect.php'); // Connect to the database.
if ( isset($_GET['uj'])){
	$_SESSION['id_daftar'] = $_GET['uj'];}

		$q = "select tajuk, mod_kerja from daftar_projek where daftar_id = '{$_SESSION['id_daftar']}'";
		$r = mysql_query ($q);
		while ($tna = mysql_fetch_array ($r)) {
		$_SESSION['tajuk'] = $tna[0];
		$_SESSION['mod_kerja'] = $tna[1];

$perPen =mysql_query("SELECT pereka, penyemak FROM butiran_projek WHERE id_daftar ='{$_SESSION['id_daftar']}'");
$perekaPenyemak =mysql_fetch_array($perPen);
$_SESSION['siapaload']= $perekaPenyemak[1];
if ($_SESSION['mod_kerja']=='Inhouse'){
		$_SESSION['siapaload']= $perekaPenyemak[0];}

			}
		
//echo 'strtolower('.$_SESSION['siapaload'].') === strtolower('.$_SESSION['username'].')';    

if (isset($_POST['submit'])) { // Handle the form.


if ($_SESSION['tajuk']=='tiada projek dipilih!'){ echo '
<br/><font size="4" face="Verdina, Arial, Helvetica, sans-serif" color="coral" style="margin-left:100px" >
Sila daftar ! </font>
<br/><font size="4" face="Verdina, Arial, Helvetica, sans-serif" color="coral" style="margin-left:200px" >
Sila Login ! </font>
<br/><font size="4" face="Verdina, Arial, Helvetica, sans-serif" color="coral" style="margin-left:260px" >
Pilih projek anda!
<br/><font size="4" face="Verdina, Arial, Helvetica, sans-serif" color="coral" style="margin-left:400px" >
Maaf, bukan semua dibenarkan upload files! </font>';

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

	// Check for a description (required).
	if (!empty($_POST['description'])) {
		$d = escape_data($_POST['description']);
	} else {
		$d = FALSE;
		echo '<p><font color="coral" size="+1">Please enter tajuk lukisan / dokumen!</font></p>';
	}
if (!empty($_POST['nomlukisan'])) {
		$l = escape_data($_POST['nomlukisan']);
	} else {
		$l = FALSE;
		echo '<p><font color="coral" size="+1">Please enter nombor lukisan / catatan dokumen!</font></p>';
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

if (strtolower($_SESSION['siapaload']) === strtolower($_SESSION['username'])){  // bawanaik fail oleh pereka sahaja
 		$user = TRUE;
	} else {
		$user = FALSE;
		echo '<p><font color="coral" size="+1">Anda bukan pereka projek ini!</font></p>';
	}




if ($i && $l && $d && $f && $u && $user) { // If everything's OK.

	// Add the record to the database.
	$query = "INSERT INTO uploads (file_name, file_size, file_type, id_daftar, nomlukisan, description, upload_date, first_name) VALUES 
('{$_FILES['upload']['name']}', {$_FILES['upload']['size']}, '{$_FILES['upload']['type']}', '$i', '$l', '$d', NOW(), '$uw')";
	$result = @mysql_query ($query);

	if ($result) {
		
		// Create the file name.
		$extension = explode ('.', $_FILES['upload']['name']);
		$uid = mysql_insert_id(); // Upload ID
		$filename = $uid . '.' . $extension[1];
		
		// Move the file over.
		if (move_uploaded_file($_FILES['upload']['tmp_name'], "../uploads/$filename")) {
		$indicator = rand();
			echo '<p>The file has been uploaded! &nbsp;Load indicator:<font color="green">'.$indicator.'</font></p>' ;
		} 

		else {
			echo '<p><font color="red">The file could not be moved.</font></p>';

			// Remove the record from the database.
			$query = "DELETE FROM uploads WHERE upload_id = $uid";
			$result = @mysql_query ($query);

		}
		
	} else { // If the query did not run OK.
		echo '<p><font color="red">Your submission could not be processed due to a system error. We apologize for any inconvenience.</font></p>'; 
	}		

	mysql_close(); // Close the database connection.

	} else { // If one of the data tests failed.
		echo '<p><font color="red" size="+1">Please try again.</font></p>';
	}

} // End of the main Submit conditional.
?>
	
<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

<input type="hidden" name="MAX_FILE_SIZE" value="5120000"> <!--// //524288-->

<fieldset><legend><small><small>Sila isi borang ini untuk bawanaik
<font color="darkkhaki"> lukisan / laporan / photo projek </font> 
</small> </legend>

<table width="600" border="1" align="left" cellpadding="4" cellspacing="0" bordercolor= "#FDFECF" bgcolor= "#EBEEF5">
<div style="margin-top:15px;margin-left:25px"><font color="darkkhaki"><b>TAJUK PROJEK:</b></font> 
<font size="4" face="Verdina, Arial, Helvetica, sans-serif" color="coral" style="margin-left:53px" >
<?php echo $_SESSION['tajuk'] ; ?></font></div>


<div style="margin-top:15px;margin-left:25px"><font color="darkkhaki"><b>Tajuk lukisan / laporan:</b></font> 
<font color="coral" style="margin-left:25px"><textarea name="description" cols="75" rows="2"></textarea></font></div>

<div style="margin-top:15px;margin-left:25px"><font color="darkkhaki"><b>Nombor lukisan / catatan:</b></font> 
<font color="coral" style="margin-left:25px"><textarea name="nomlukisan" cols="75" rows="2"></textarea></font></div>

<div style="margin-top:15px;margin-left:25px"><font color="darkkhaki"><b>Pilih lukisan / dokumen :</b></font> 
<font color="coral" style="margin-left:25px"><input type="file" name="upload" cols="75" /></font>
<input type="submit" name="submit" value="Upload file" /></div>
<input name="id_daftar" type="hidden" id="id_daftar" value="<?php echo $_SESSION['id_daftar'] ?> 

</table> 


</fieldset>
	


</form><!-- End of Form -->

<?php
include ('includes/footer.html'); // Include the HTML footer.
?>