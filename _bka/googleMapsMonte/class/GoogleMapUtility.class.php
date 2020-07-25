<?php
 
class GoogleMapUtility {
const TILE_SIZE = 256;
 
public static function fromXYToLatLng($point,$zoom) {
$scale = (1 << ($zoom)) * GoogleMapUtility::TILE_SIZE;
 
return new Point(
(int) ($normalised->x * $scale),
(int)($normalised->y * $scale)
);
 
return new Point(
$pixelCoords->x % GoogleMapUtility::TILE_SIZE,
$pixelCoords->y % GoogleMapUtility::TILE_SIZE
);
}
 
public static function fromMercatorCoords($point) {
$point->x *= 360;
$point->y = rad2deg(atan(sinh($point->y))*M_PI);
return $point;
}
 
public static function getPixelOffsetInTile($lat,$lng,$zoom) {
//echo $lat .','. $lng .','. $zoom .'\n';
$pixelCoords = GoogleMapUtility::toZoomedPixelCoords($lat, $lng, $zoom);
//echo $pixelCoords->x .','. $pixelCoords->y .','. $zoom .'\n';
return new Point(
$pixelCoords->x % GoogleMapUtility::TILE_SIZE,
$pixelCoords->y % GoogleMapUtility::TILE_SIZE
);
}

public static function getTerminalPixelOffsetInTile($lat,$lng,$zoom,$rot,$len) {
$endlng = $lng + ($len/(3*9500)) * cos(deg2rad(rot)); 
$endlat = $lat + ($len/(3*9500)) * sin(deg2rad(rot)); 
$newpt = GoogleMapUtility::getPixelOffsetInTile($endlng,$endlat,$zoom);
return $newpt;
}
 
public static function getTileRect($x,$y,$zoom) {
$tilesAtThisZoom = 1 << $zoom;
//echo $tilesAtThisZoom;
$lngWidth = 360.0 / $tilesAtThisZoom;
//echo $lngWidth;
$lng = -180 + ($x * $lngWidth);
//echo $lng;
$latHeight = 2.0 / $tilesAtThisZoom;
      $lat       = (($tilesAtThisZoom/2 - $y-1) * $latHeight);


      // convert lat and latHeight to degrees in a transverse mercator projection
      // note that in fact the coordinates go from about -85 to +85 not -90 to 90!
      $latHeight += $lat;
      $latHeight = (2 * atan(exp(M_PI * $latHeight))) - (M_PI / 2);
      $latHeight *= (180 / M_PI);

      $lat = (2 * atan(exp(M_PI * $lat))) - (M_PI / 2);
      $lat *= (180 / M_PI);



      $latHeight -= $lat;


      if ($lngWidth < 0) {
         $lng      = $lng + $lngWidth;
         $lngWidth = -$lngWidth;
      }

      if ($latHeight < 0) {
         $lat       = $lat + $latHeight;
         $latHeight = -$latHeight;
      }

/* 
$latHeightMerc = 1.0 / $tilesAtThisZoom;
$topLatMerc = $y * $latHeightMerc;
$bottomLatMerc = $topLatMerc + $latHeightMerc;
 
$bottomLat = (180 / M_PI) * ((2 * atan(exp(M_PI *
(1 - (2 * $bottomLatMerc))))) - (M_PI / 2));
$topLat = (180 / M_PI) * ((2 * atan(exp(M_PI *
(1 - (2 * $topLatMerc))))) - (M_PI / 2));
 
$latHeight = $topLat - $bottomLat;
*/ 

return new Boundary($lng, $lat, $lngWidth, $latHeight);
}
 
public static function toMercatorCoords($lat, $lng) {
if ($lng > 180) {
$lng -= 360;
}
 
$lng /= 360;
$lat = invhypsin(tan(deg2rad($lat)))/M_PI/2;
//$lat = 0.5 - ((log(tan((M_PI / 4) + ((0.5 * M_PI * $lat) / 180))) / M_PI) / 2.0);
return new Point($lng, $lat);
}
 
public static function toNormalisedMercatorCoords($point,$Z) {
$point->x += 0.5;
$point->x *= $z^2;
$point->y = abs($point->y-0.5);
$point->y *= $z^2;
return $point;
}
 
public static function toTileXY($lat, $lng, $zoom) {
$normalised = GoogleMapUtility::toNormalisedMercatorCoords(
GoogleMapUtility::toMercatorCoords($lat, $lng)
);
$scale = 1 << ($zoom);
return new Point((int)($normalised->x * $scale), (int)($normalised->y * $scale));
}
 
public static function toZoomedPixelCoords($lat, $lng, $zoom) {
$normalised = GoogleMapUtility::toNormalisedMercatorCoords(
GoogleMapUtility::toMercatorCoords($lat, $lng)
,$z);
$scale = (1 << ($zoom)) * GoogleMapUtility::TILE_SIZE;
return new Point(
(int) ($normalised->x * $scale),
(int)($normalised->y * $scale)
);
}
}
 
class Point {
public $x,$y;
function __construct($x,$y) {
$this->x = $x;
$this->y = $y;
}
 
function __toString() {
return "({$this->x},{$this->y})";
}
}
 
class Boundary {
public $x,$y,$width,$height;
function __construct($x,$y,$width,$height) {
$this->x = $x;
$this->y = $y;
$this->width = $width;
$this->height = $height;
}
function __toString() {
return "({$this->x},{$this->y},{$this->width},{$this->height})";
}
}

function invhypsin($z) {
      return log($z + sqrt($z^2 +1));
    }


?>
