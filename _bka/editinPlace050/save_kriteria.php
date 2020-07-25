<?php
/*

We get the following values by default from EditInPlace:

id - The DOM id
form_type - The edit field type (text, textarea, select)
old_content - The pre-edited content
new_content - The edited content

If the form_type was select then we'll also get

old_option - The pre-edited option
new_option - The edited option
old_option_text - The pre-edited display option
new_option_text - The edited display option

If any additional data was specified via the xhr_data option
then it will also be provided.

 */

// Add a little delay so that the user has a chance
// to actually see the saving message.
sleep(0);
include_once ('../../ip_SERVER.php');
include_once('../../'.PROJ_FOLDER.'/inc/mysql_connect2cfg.php');

$id				= $_POST["id"];
$form_type		= $_POST["form_type"];
$old_content	= rawurldecode($_POST["old_content"]);
$new_content	= rawurldecode($_POST["new_content"]);


if($form_type == "select") {
	$old_option			= $_POST["old_option"];
	$new_option			= $_POST["new_option"];
	$old_option_text	= $_POST["old_option_text"];
	$new_option_text	= $_POST["new_option_text"];
}

$id_comb=$_POST["id"];
list($id_split,$chk_id) = split('#', $id_comb);
$chk_id=intval($chk_id);

//	print_r("<pre>\n" . print_r($_POST, true) . "\n</pre>\n");
///////
	//$chk_id=$_SESSION['daftar_id']; //floatval($old_content);
	$kp =$_SESSION['kp_s'];
	$username =	$_SESSION['username'];
	
//print '----'.$test.'----';

print(rawurldecode($new_content));

///////
	$db = new mysqli($ajaxHost, $ajaxULogin ,$ajaxPass, $ajaxDbase);


	if(!$db) {
		// Show error if we cannot connect.
		echo 'ERROR: Could not connect to the database.';
	} else {
	$query1 = $db->query("INSERT into kriteria (id,new_content,old_content,form_type,old_option,new_option,old_option_text,new_option_text,id_daftar,username,kp,regist_date) values 
('$id','$form_type','$old_content','$new_content','$old_option','$new_option','$old_option_text','$new_option_text','$chk_id','$username','$kp',NOW())");
}

	$query2 = $db->query("UPDATE kriteria SET new_content='$new_content', old_content='$old_content', old_option='$old_option',new_option='$new_option',old_option_text='$old_option_text',new_option_text='$new_option_text',username='$username',kp='$kp',regist_date=NOW() WHERE id='$id' AND id_daftar='$chk_id'") ;

	

	
				
?>
