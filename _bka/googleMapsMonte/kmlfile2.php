<?php

//$kmlfile = 'http://127.0.0.1/_bka/googleMapsMonte/js/states.xml';
$filexml = 'js/states.xml';

if (file_exists($filexml)) {
    $xml = simplexml_load_file($filexml);
$f = fopen('states.csv', 'w');
foreach ($xml->state as $state) {
	$name = $state->name;
	$color = $state->color;
  $coords = $state->point->outerBoundaryIs->LinearRing->coordinates;
  $coordsArray = split("\n", $coords);
  for ($i = 0; $i < count($coordsArray); $i++) {
    $latlngArray = split("/>", $coordsArray[$i]);
      if (count($latlngArray) == 3) {
      $lat = $latlngArray[2];
      $lng = $latlngArray[1];

      if ($i != count($coordsArray) -2) echo ", ";
    }	
    fputcsv($f, get_object_vars($lat, $lng));
}
fclose($f);
}
echo 'saved as '.$f;
?>

