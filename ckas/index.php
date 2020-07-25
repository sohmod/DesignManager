<?php # Script 12.5 - index.php

// This is the main page for the site.
// Include the configuration file for error management and such.
require_once ('html/includes/config.inc'); 
// Set the page title and include the HTML header.
$page_title = 'projek-projek';
include_once ('html/header.htm');
echo "</small></center></fieldset>";


/*
$file = fopen("./count/count.txt","r+"); 
$counter = fread($file, filesize("./count/count.txt")); 
fclose($file); 
if( $_SERVER["REMOTE_ADDR"] != '127.0.0.1' ) 
{$counter +=1; }
$file = fopen("./count/count.txt","w+"); 
fputs($file, $counter); 
fclose($file); 
echo '<center>&nbsp;::&nbsp;<small>  <span class="style8">';
include("./count/count.txt"); 
echo ' hits</span></small>&nbsp;::</center> <table align="center" > <legend align="center" bgcolor="red" text="#000000" ><small></legend>';
*\

//Welcome the user (by name if they are logged in).
echo '<center><h3><font color="#999999">';
if (isset($_SESSION['first_name']) && isset($_SESSION['user_id'])) {
	echo "Selamat datang , {$_SESSION['first_name']}  !     ";

}
echo '</font></h3></center>';

/*
if (substr($_SERVER['PHP_SELF'], -14) = 'ckaj/index.php') {
// Unset all of the session variables.
session_unset();
// Finally, destroy the session.
//session_destroy();
echo 'allright';
}*/
// If no first_name variable exists, redirect the user.
if (isset($_SESSION['user_id_tna'])) {
	$_SESSION = array(); // Destroy the variables.
	session_destroy(); // Destroy the session itself.
	setcookie (session_name(), '', time()-300, '/', '', 0); // Destroy the cookie.
}

?>


 <style type="text/css">
 a:link { text-decoration:none }
 a:visited { text-decoration:none }
 a:hover { text-decoration:underline }
 body { font-family:Verdana,Arial,Helvetica,sans-serif;font-size:12px;} 
.style8 {color:#CCCCCC;font-size:9px;}
</style>

<center>PROJEK:
</center>


<?php echo '<center>'; ?>
<p align="center" class="style8">
<a href= "projek_daftar.php?event=Pinda" style="text-decoration:none"> 
SENARAI & DAFTAR PROJEK</a></p>
<?php echo '</center>'; ?>
<br/><p align="center" >
<a href="../_bka/borehole/lokasi_senarai_viewonly.php" style="text-decoration:none" >Senarai &</a><br/>
<a href="../_bka/borehole/index.php" style="text-decoration:none" >Daftar Borehole</a></p>
<p align="center" ><iframe src="http://sohmod.hopto.org/images/randomsvg/38.svg" width="500" height="500" frameborder="0"></iframe></p>


<div align="center">
<?php 
// Include the HTML footer file.
include_once ('html/footer.htm');
?>





