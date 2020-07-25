<?php
ob_start();
session_start();
sleep( 0 );
include_once ('../../ip_SERVER.php');
include_once('../../'.PROJ_FOLDER.'/inc/mysql_connect2cfg.php');
require_once ('../../'.PROJ_FOLDER.'/mysql_connect.php'); // Connect to the database.

require 'json/JSON.php';

$url        = $_POST['url'];
$form_type    = $_POST['form_type'];
$id            = $_POST['id'];
$orig_value    = $_POST['orig_value'];
$new_value    = $_POST['new_value'];
$post_data   = $_POST['data'];
if( $form_type == 'select' ) {
    $orig_option_text    = $_POST['orig_option_text'];
    $new_option_text    = $_POST['new_option_text'];
    $new_value            = $new_option_text;
}


$id_comb=$_POST["id"];
list($id_split,$chk_id) = split('-', $id_comb);
$chk_id=intval($chk_id);
$ppk =$_SESSION['ppk'];
$username =	$_SESSION['username'];
if (!$_SESSION['daftar_id']){$chk_id=7654321;$bilcol =2;$username="public";$ppk="PPK";}
	
$json = new Services_JSON( );

print $json->encode( array(
    "is_error"        => false,
    "error_text"    => "Ack!  Something broke!",
    "html"            => $new_value
) );

////////////////
	$dbDB = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
	} 
	$q = "select tajuk,lokasi,mod_kerja,OIC,nosiri_fail,KemKlient from daftar_projek where daftar_id = $chk_id";
	$qb = "select pereka, penyemak, pelukis, ppenguasa, mtapakDate, kkontrak, kaedahT, kontraktor from butiran_projek where id_daftar = $chk_id";

if ($stmt = $dbDB->prepare($q)) {
    /* execute statement */
    $stmt->execute();
    /* bind result variables */
    $stmt->bind_result($tajuk,$lokasi,$mod_kerja,$OIC,$nosiri_fail,$KemKlient);
    /* fetch values */
    while ($stmt->fetch()) {
			$tajuk = $tajuk;
			$lokasi = $lokasi;
			$mod_kerja = $mod_kerja;	
			$OIC = $OIC;
			$nosiri_fail = $nosiri_fail;
			$KemKlient = $KemKlient;    }
    /* close statement */
    $stmt->close();
}
if ($stmt = $dbDB->prepare($qb)) {
    /* execute statement */
    $stmt->execute();
    /* bind result variables */
    $stmt->bind_result($pereka, $penyemak, $pelukis, $ppenguasa, $mtapakDate, $kkontrak, $kaedahT, $kontraktor);
    /* fetch values */
    while ($stmt->fetch()) {
			$pereka = $pereka;
			$penyemak = $penyemak;
			$pelukis = $pelukis;
			$ppenguasa = $ppenguasa;
			$mtapakDate = $mtapakDate;
			$kkontrak = $kkontrak;
			$kaedahT = $kaedahT;
			$kontraktor = $kontraktor;    }
    /* close statement */
    $stmt->close();
}
/* close connection */
$dbDB->close();
//////////////

	$db = new mysqli($bkaHost,$bkaULogin,$bkaPass,$bkaDbase);

	if(!$db) {
		// Show error if we cannot connect.
		echo 'ERROR: Could not connect to the database.';
	} else {

// Get lat
	$idprlat = preg_replace("/2-/", "1-", $id);
	$idprtlat = trim($idprlat);
if ($id_split == 'latNE1' || $id_split == 'latNE2') { 	
	$q = "SELECT new_value,post_data FROM susunatur WHERE id = '$idprtlat'";
	//$q="SELECT max(new_value) as lat,min(new_value)as lng, new_value FROM susunatur where id_daftar=$chk_id";
	
if ($stmt = $db->prepare($q)) {
    $stmt->execute();
    $stmt->bind_result($new_value);
    while ($stmt->fetch()) {
			$new_value = floatval($new_value);
			if ($id_split == 'latNE1') $lat = floatval($new_value);
			if ($id_split == 'latNE2') $lng = floatval($new_value);
			}
    $stmt->close(); }	
//	$r = mysql_query($q);
//	$row = mysql_fetch_row($r);
	//if (mysql_num_rows($r)) {
//		$lng = floatval($row[0]);	
//		$lat = floatval($row[1]);
//		$new_value = $row[2];
		
		//list($lat) = mysql_fetch_array($r, MYSQLI_NUM);
		//	}
		}
/*
// Get lng
	$idprlon = preg_replace("/1-/", "2-", $id);
	$idprtlon = trim($idprlon);
if ($id_split == 'latSW1' || $id_split == 'latSW2') { 
	//$q = "SELECT new_value FROM susunatur WHERE id = '$idprtlon'";
	$q="SELECT max(new_value) as lat,min(new_value)as lng, new_value FROM susunatur where id_daftar=$chk_id";
if ($stmt = $db->prepare($q)) {
    $stmt->execute();
    $stmt->bind_result($new_value);
    while ($stmt->fetch()) {
			$lat = floatval($lat);
			$lng = floatval($lng);
			$new_value = floatval($new_value);
			}
    $stmt->close(); }		
//	$r = mysql_query($q);
//	$row = mysql_fetch_row($r);	
	//if (mysql_num_rows($r)) {
//		$lat = floatval($row[0]);	
//		$lng = floatval($row[1]);
//		$new_value = $row[2];
		
	//list($lng) = mysql_fetch_array($r, MYSQLI_NUM);
	//	}
	} */

$post_data = $lat .' , '.$lng ;
//$new_value = floatval($new_value);
$new_value = $new_value;


// Inserting new data
	$query1 = $db->query("INSERT into susunatur 
(id_daftar,id,url,form_type,orig_value,new_value,post_data,username,ppk,regist_date) values ('$chk_id','$id','$url','$form_type','$orig_value','$new_value','$post_data','$username','$ppk',NOW())");	
}

// if data id exists causes insert command to fail, this will update
	$query2 = $db->query("UPDATE susunatur SET 
											orig_value='$orig_value',
											new_value='$new_value',
											post_data='$post_data',
											username='$username',
											ppk='$ppk',
											regist_date=NOW()
											WHERE id='$id' AND id_daftar='$chk_id'");
											
// THIS QUERY XX

$query3 = $db->query("select * from laporanbulananRM9 where id_daftar='$chk_id'");
$terkini = 'Tidak ada laporan';
$tm = $query3->fetch_array(MYSQLI_NUM);
	for ($i=72;$i>1;$i--){
	if(!empty($tm[$i])){   $terkini =  $tm[$i];
						   $fieldnum = $i;
						break;
	}}

	$finfo = mysqli_fetch_field_direct($query3, $fieldnum);
    $laporterkini = $finfo->name;
	$kemajuan = $laporterkini . ' : ' . $terkini;
								
///////////////////

//$db->close();

// THIS QUERY XX
	//$dba = new mysqli($ajaxHost,$ajaxULogin,$ajaxPass,$ajaxDbase);	
// $lat=123;$lng=456;
	if(!$db) {
		// Show error if we cannot connect.
		echo 'ERROR: Could not connect to the database.';
	} else {	
	$qa = $db->query("INSERT into markers_bka2
(id_daftar,lat,lng,tajuk,lokasi,mod_kerja,OIC,nosiri_fail,KemKlient,pereka,penyemak,pelukis,ppenguasa,mtapakDate,kkontrak,kaedahT,kontraktor,kemajuan) values ('$chk_id','$lat','$lng','$tajuk','$lokasi','$mod_kerja','$OIC','$nosiri_fail','$KemKlient','$pereka','$penyemak','$pelukis','$ppenguasa','$mtapakDate','$kkontrak','$kaedahT','$kontraktor','$kemajuan')");		
					}	

// if data id exists causes insert command to fail, this will update
if ($lat==0){
	$qa2 = $db->query("UPDATE markers_bka2 SET 
											lng='$lng',
											tajuk='$tajuk',
											lokasi='$lokasi',
											mod_kerja='$mod_kerja',
											OIC='$OIC',
											nosiri_fail='$nosiri_fail',
											KemKlient='$KemKlient',
											pereka='$pereka',
											penyemak='$penyemak',
											pelukis='$pelukis',
											ppenguasa='$ppenguasa',
											mtapakDate='$mtapakDate',
											kkontrak='$kkontrak',
											kaedahT='$kaedahT',
											kontraktor='$kontraktor',
											kemajuan='$kemajuan'
											WHERE id_daftar='$chk_id'");}
if ($lng==0){											
	$qa2 = $db->query("UPDATE markers_bka2 SET 
											lat='$lat',
											tajuk='$tajuk',
											lokasi='$lokasi',
											mod_kerja='$mod_kerja',
											OIC='$OIC',
											nosiri_fail='$nosiri_fail',
											KemKlient='$KemKlient',
											pereka='$pereka',
											penyemak='$penyemak',
											pelukis='$pelukis',
											ppenguasa='$ppenguasa',
											mtapakDate='$mtapakDate',
											kkontrak='$kkontrak',
											kaedahT='$kaedahT',
											kontraktor='$kontraktor',
											kemajuan='$kemajuan'
											WHERE id_daftar='$chk_id'");}											
											
											
											
$db->close();
ob_flush();				
?>
