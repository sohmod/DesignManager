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

///////
	
$json = new Services_JSON( );

$cday = trim(date("d-m-Y"));

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
		    exit();
	} else {

// Get tentative or actual date
	$idpr = preg_replace("/2-/", "1-", $id);
	$idprt = trim($idpr);
	$q = "SELECT new_value FROM perancangan WHERE id='$idprt'";
	$r = mysql_query($db, $q);
	if (mysql_num_rows($r) == 1) {
		list($dbevtdate) = mysql_fetch_array($r, MYSQLI_NUM);}
	if 	($dbevtdate == '' || $dbevtdate == 'ddmmYYYY'){ 
	$dbevtdate = $cday; 
	}

// Get previous saved post_data to append
	$q = "SELECT post_data FROM perancangan WHERE id='$id'";
	$r = mysql_query($db, $q);
	if (mysql_num_rows($r) == 1) {
		list($dbpost_data) = mysql_fetch_array($r, MYSQLI_NUM);}
$post_data .= $dbevtdate.$new_value.$dbpost_data ;

$dummi = "DDMMYYYY";
if (preg_match("/1-/i", $id)) {
list($day, $month, $year) = split("[/.-]", $new_value);
if ((strlen($day)==2 && strlen($month)==2 && $day >0 && $day<32) && ($month >0 && $month<13) && ($year >1900 && $year<2021)){
		// ok
		$dummi = $new_value;
		}
		else{
			// not ok
			$dummi =  "ddmmYYYY";
			}
$new_value = $dummi;		
}

// Inserting new data
$query1 = $db->query("INSERT into perancangan (id_daftar,id,url,form_type,orig_value,new_value,post_data,username,ppk,regist_date) values ('$chk_id','$id','$url','$form_type','$orig_value','$new_value','$post_data','$username','$ppk',NOW())");
}

// if data id exists causes insert command to fail, this will update
	$query2 = $db->query("UPDATE perancangan SET 
											orig_value='$orig_value',
											new_value='$new_value',
											post_data='$post_data',
											username='$username',
											ppk='$ppk',
											regist_date=NOW() 
											WHERE id='$id' AND id_daftar='$chk_id'") ;
$cmonth = date(m);
$cyear = date(Y);
list($day, $month, $year) = split('[/.-]', $dbevtdate);
$a = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
$b = array('JAN', 'FEB', 'MAR', 'APR', 'MEI', 'JUN', 'JUL', 'OGO', 'SEP', 'OKT', 'NOV', 'DIS');
$c = array_combine($a, $b);  //$c['01'] = JAN ;
$datacol = $c[$month].$year;

if ( $id_split == 'kemajuan2' ) {
			$query11 = $db->query("INSERT into laporanbulananRM9 
											(id_daftar,{$datacol},
											username,ppk,regist_date)
											values ('$chk_id','$new_value','$username','$ppk',NOW())");
											
			$query22 = $db->query("UPDATE laporanbulananRM9 SET 
											{$datacol}='$new_value',
											username='$username',
											ppk='$ppk',
											regist_date=NOW() 
											WHERE id_daftar='$chk_id'") ;		
		}
	

$db->close();	
ob_flush();				
?>
