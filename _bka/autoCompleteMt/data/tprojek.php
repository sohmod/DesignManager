<?php
$q = strtolower($_REQUEST["q"]);
if (!$q) return;
//Connect to mysql db
$conn = mysql_connect('localhost','username','password');
mysql_select_db('ckaj',$conn);

    $query = "SELECT daftar_id, tajuk FROM daftar_projek ORDER BY daftar_id ASC LIMIT 10";

$items = array("0"=>"my1stprojek");
$result=mysql_query($query); 
if (!$result) {
die( 'ada error '. mysql_error()); }
while ($row = mysql_fetch_array($result)) {
	array_push($items, ereg_replace(',', '^', $row['tajuk']));
}
$detmy1stproj = array_shift($items);

//print_r($items);


$json = array();

foreach ($items as $key=>$value) {
	if (strpos(strtolower($value), $q) !== false) {
		$json[] = '"' . $value . '"';
	}
}

echo '[' . implode(',', $json) . ']';

?>
