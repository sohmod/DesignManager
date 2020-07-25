<?php
/*
$dbHost      = "localhost";   $ajaxHost='localhost';	$bkaHost='localhost';
$dbUserLogin = "username";    $ajaxULogin='ajaxuser';	$bkaULogin='kppk';
$dbPassword  = "password";    $ajaxPass='practical';	$bkaPass='ukkptpbkackasj';
$dbName      = "ckaj";        $ajaxDbase='ajax';		$bkaDbase='bka';  
*/

include_once ('../../../ip_SERVER.php');
include_once('../../../'.PROJ_FOLDER.'/inc/mysql_connect2cfg.php');
$server=$ajaxHost;$username=$ajaxULogin;$password=$ajaxPass;$database=$ajaxDbase;



 // Opens a connection to a MySQL server.
$connection = mysql_connect ($server, $username, $password);
if (!$connection) 
{
  die('Not connected : ' . mysql_error());
}

// Sets the active MySQL database.
$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) 
{
  die ('Can\'t use db : ' . mysql_error());
}

 // Selects all the rows in the markers table.
 $query = 'SELECT * FROM markers_bka2 WHERE 1';
 $result = mysql_query($query);
 if (!$result) 
 {
  die('Invalid query: ' . mysql_error());
 }


// Creates an array of strings to hold the lines of the KML file.
$kml = array('{ "markers": [');

// htmlentities
// Iterates through the rows, printing a node for each row.
while ($row = @mysql_fetch_assoc($result)) 
{

$tajukProjek = ereg_replace('"', '', $row['tajuk']);

  $kml[] = ' { "point":new GLatLng(' . $row['lat'] . ','  . $row['lng'] . '),';
  $kml[] = ' "kementerian":"' . $row['KemKlient'] . '",';
  $kml[] = ' "tajukProj":"' . $tajukProjek . '",';
  $kml[] = ' "lokasi":"' . $row['lokasi'] . '",';
  
  $kml[] = ' "kaedahR":"' . $row['mod_kerja'] . '",';
  $kml[] = ' "kppk":"' . $aOIC[$row['OIC']] . '",';
  $kml[] = ' "pereka":"' . $row['pereka'] . '",';
  $kml[] = ' "penyemak":"' . $row['penyemak'] . '",';
  $kml[] = ' "pelukis":"' . $row['pelukis'] . '",';


  $kml[] = ' "kaedahT":"' . $row['kaedahT'] . '",';
  $kml[] = ' "kkontrak":"' . $row['kkontrak'] . '",';
  $kml[] = ' "mtapakDate":"' . $row['mtapakDate'] . '",';
						   
  $kml[] = ' "ppenguasa":"' . $row['ppenguasa'] . '",';
  $kml[] = ' "kontraktor":"' . $row['kontraktor'] . '",';
  $kml[] = ' "statusBina":[": ' . '' . '",'.
						   '"Terkini : ' . $row['kemajuan'] . '"]'; 
  $kml[] = ' },';						   
} 

// End XML file
$kml[] = ' ]';
$kml[] = ' }';
$kmlOutput = join("\r\n", $kml);

echo $kmlOutput;

?>
