<?php # Script 12.5 - index.php

// This is the main page for the site.

// Include the configuration file for error management and such.
require_once ('includes/config.inc'); 

// Set the page title and include the HTML header.
$page_title = 'index3';
//include_once ('header.htm');

// This page begins the HTML header for the site.
// Start output buffering and initialize a session.
ob_start();
session_start();

// Check for a $page_title value.
if (!isset($page_title)) {
	$page_title = 'uj:GERTAK';
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/2000/REC-xhtml1-20000126/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>

<?php
//\\
$file = fopen("../count/count.txt","r+"); 
$counter = fread($file, filesize("../count/count.txt")); 
fclose($file); 
if( $_SERVER["REMOTE_ADDR"] != '127.0.0.3' ) 
{$counter +=1; }
$file = fopen("../count/count.txt","w+"); 
fputs($file, $counter); 
fclose($file); 
echo '<center>&nbsp;::&nbsp;<small><font color="green">';
include("../count/count.txt"); 
echo ' hits</font></small>&nbsp;::</center> <table align="center"> <legend align="center"><small>silasisisi </legend>';
//\\

//Welcome the user (by name if they are logged in).
echo '<h3><font color="#999999">';
if (isset($_SESSION['first_name'])) {
	echo "Selamat datang , {$_SESSION['first_name']}  !     ";

if ( 
$_SESSION['kp_s'] == '580307-03-5341' ||
$_SESSION['kp_s'] == '731015-03-5257' ||
$_SESSION['kp_s'] == '730910-01-5813' ||
$_SESSION['kp_s'] == '671201-02-5720' ||
$_SESSION['kp_s'] == '671201-02-5720' ||
$_SESSION['kp_s'] == '730321-04-5168' ||
$_SESSION['kp_s'] == '491023-06-5149' ||
$_SESSION['kp_s'] == '581216-01-5120' 
){
echo "<h6><br/><a href=\"index2.php\" style=\"text-decoration:none\">
Konsol Pengurusan Kursus  - <i>kegunaan pegawai USM saja.</i></a><br/></h6>";}
}

echo '</font></h3>';
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

<div id="align_center">
<div class="form_fields">

<h3 style="color:#999999">You are now logged out.</h3>


<?php echo '<fieldset>'; ?>
<p align="center"><a href="../../index.html" style="text-decoration:none">mukadepan</p>
<?php echo '</fieldset><fieldset>'; ?>

<p align="center"> <a href="../index.php" style="text-decoration:none">index</a></p>
<?php echo '</fieldset><fieldset>'; ?>


<p align="center"> <a href="../tna/login.php?usm=demo" style="text-decoration:none"> DEMO</a>  
<br/> Nama pengguna : demo   <br/> Katalaluan: demo     <br/><br/> 
<a href="../tna/kompeten.php" style="text-decoration:none">Konsol pemetaan kompetensi</a><br/> 
<br/>
<a href="../tna/Lampiran_ABC.php?usm=112233-44-5566" style="text-decoration:none">Lampiran A, B &amp; C</a>
<br/>
<a href="../tna/Lampiran_G.php?usm=112233-44-5566" style="text-decoration:none">Lampiran G</a></p>




<?php echo '</small></fieldset></table>  ';
// Include the HTML footer file.
include_once ('footer.htm');
?>