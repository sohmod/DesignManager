<?php

require_once "json/JSON.php";
$json = new Services_JSON();

//convert php object to json 
$value = array('first' => 'Steven', 'last' => 'Spielberg', 'address' => '1234 Unlisted Drive');
$output = $json->encode($value);

print($output);

?>
