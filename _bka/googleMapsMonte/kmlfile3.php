<?php

$kmlfile = 'http://maps.google.com/maps/ms?ie=UTF8&hl=en&msa=0&output=kml&msid=109250181535574469723.00043cb961e5234cea628';

$xml = simplexml_load_file($kmlfile) or die("url not loading");

echo "var states = { <br/>";
foreach($xml->Document->Placemark as $placemark) {
  $name = $placemark->name;
  echo "$" . $name . " = '[";
  $coords = $placemark->Polygon->outerBoundaryIs->LinearRing->coordinates;
  $coordsArray = split("\n", $coords);
  for ($i = 0; $i < count($coordsArray); $i++) {
    $latlngArray = split(",", $coordsArray[$i]);
      if (count($latlngArray) == 3) {
      $lat = $latlngArray[1];
      $lng = $latlngArray[0];
      echo "new GLatLng(" . $lat . "," . $lng . ")";
      if ($i != count($coordsArray) -2) echo ", ";
    }
  }
  echo "]';<br/>";
}
echo "}";
?>


