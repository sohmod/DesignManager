<?php
ob_start();
session_start();
sleep( 0 );
include_once ('../../ip_SERVER.php');
include_once('../../'.PROJ_FOLDER.'/inc/mysql_connect2cfg.php');

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
//$chk_id=intval($chk_id);
$ppk =$_SESSION['ppk'];
$username =	$_SESSION['username'];
if (!$_SESSION['daftar_id']){$chk_id=7654321;$bilcol =2;$username="public";$ppk="PPK";}

//////////////	
$json = new Services_JSON( );
print $json->encode( array(
    "is_error"        => false,
    "error_text"    => "Ack!  Something broke!",
    "html"            => $new_value
) );
//////////////

	$db = new mysqli($bkaHost,$bkaULogin,$bkaPass,$bkaDbase);

	if(!$db) {
		// Show error if we cannot connect.
		echo 'ERROR: Could not connect to the database.';
	} else {




// Inserting new data
	$query1 = $db->query("INSERT into ulasanteknikal 
(id_daftar,id,url,form_type,orig_value,new_value,post_data,username,ppk,regist_date) values ('$chk_id','$id','$url','$form_type','$orig_value','$new_value','$post_data','$username','$ppk',NOW())");
}

if (substr($new_value, 0, 1)=='<') $new_value='';
// if data id exists causes insert command to fail, this will update
	$query2 = $db->query("UPDATE ulasanteknikal SET 
											orig_value='$orig_value',
											new_value='$new_value',
											post_data='$post_data',
											username='$username',
											ppk='$ppk',
											regist_date=NOW() 
											WHERE id='$id' AND id_daftar='$chk_id'") ;


	
ob_flush();				
?>
