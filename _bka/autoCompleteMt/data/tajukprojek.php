<?php
//$q = strtolower($_REQUEST["q"]);
//if (!$q) return;
//Connect to mysql db
$conn = mysql_connect('localhost','username','password');
mysql_select_db('ckaj',$conn);

    $query = "SELECT daftar_id, tajuk FROM daftar_projek ORDER BY daftar_id ASC";

$o = '"1"=>"myfirstprojek",<br/> ';
$result=mysql_query($query); 
$i=1;
if (!$result) {
die( 'ada error '. mysql_error()); }
while ($row = mysql_fetch_array($result)) {
	$eresAnd = ereg_replace('And', '&', $row['tajuk']);

	$eresApos = ereg_replace('"', '-', $eresAnd);
	
    $o .= '"'.$i++.'"=>"'.ereg_replace(',', '^', $eresApos).'",<br/>';
}
$i++;
$o .= '"'.$i.'"=>"myprojek"';
//echo trim($o);
//$items = array( $o );
//$array[] = $items[$o];
$items=array();
array_push($items, $o);
print_r($items);


$json = array();

foreach ($items as $key=>$value) {
	if (strpos(strtolower($value), $q) !== false) {
		$json[] = '"' . $value . '"';
	}
}

echo '[' . implode(',', $json) . ']';

?>
