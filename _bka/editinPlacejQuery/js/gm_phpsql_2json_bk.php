<?php
$server="localhost";
$username="ajaxuser";
$password="practical";
$database="ajax";

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
  $kml[] = ' { "point":new GLatLng(' . $row['lat'] . ','  . $row['lng'] . '),';
  $kml[] = ' "kementerian":"' . $row['type'] . '",';
  $kml[] = ' "tajukProj":"' . $row['type'] . '",';
  $kml[] = ' "lokasi":"' . $row['type'] . '",';
  
  $kml[] = ' "kaedahR":"' . $row['type'] . '",';
  $kml[] = ' "kppk":"' . $row['type'] . '",';


  $kml[] = ' "kaedahT":"' . $row['type'] . '",';
						   
  $kml[] = ' "SO":"' . $row['type'] . '",';
  $kml[] = ' "RE":"' . $row['type'] . '",';
  $kml[] = ' "statusBina":["Bina: ' . $row['type'] . '",'.
						   '"Bina2: ' . $row['type'] . '"]'; 
  $kml[] = ' },';						   
} 

// End XML file
$kml[] = ' ]';
$kml[] = ' }';
$kmlOutput = join("\n", $kml);
echo $kmlOutput;
?>
