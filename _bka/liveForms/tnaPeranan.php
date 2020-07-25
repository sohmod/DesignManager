<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>	
	<title>Peranan</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="content-style-type" content="text/css" />
	<meta name="description" content="Peranan tugas" />
	<meta name="keywords" content="managing design office,civil,engineer,jurutera,awam,infra works" />
	<link rel="icon" href="themes/default/favicon.ico" type="image/x-icon" />

<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript">
	function fill(thisValue) {
		$('#inputString').val(thisValue);
		setTimeout("$('#suggestions').hide();", 200);
	}

function confirmDelete() 
{ return (confirm('Adakah anda pasti untuk hapuskan data ini? Pelupusan ini kekal dan tiada pemulihan!<br/>'));} 
	
</script>	
<script type="text/javascript" src="jasoncalendar/calendarDateInput.js"></script>
	
	<script type="text/javascript" src="js/utils.js"></script>
	<script type="text/javascript" src="js/ValidatorTextArea.js"></script>
	<style type="text/css">

	.suggestionsBox {
		position: relative;
		left: 30px;
		margin: 10px 0px 0px 0px;
		width: 200px;
		background-color: green; //#212427;
		-moz-border-radius: 7px;
		-webkit-border-radius: 7px;
		border: 2px solid #000;	
		color: #fff;
		font-size: 12px;
		font-family: Helvetica, Arial, Verdana, Sans-Serif;
	}
	
	.suggestionList {
		margin: 0px;
		padding: 0px;
	}
	
	.suggestionList li {
		margin: 0px 0px 3px 0px;
		padding: 3px;
		cursor: pointer;
	}
	
	.suggestionList li:hover {
		background-color: #659CD8;
	}	
	a:hover {
	color: #C30;
	text-decoration: none;
	background-color: #00ff00;
			}		
	</style>
	
<?php	
include_once ('../../ip_SERVER.php');
require_once('../tnakursus/config.php');
session_start();
//unset ( $_SESSION['lat'],$_SESSION['lng'] );

// Connect and select.
if ($dbc = @mysql_connect (DB_HOST, DB_USER, DB_PASSWORD)) {
	if (!@mysql_select_db (DB_DATABASE)) {
		die ('<p>Could not select the database because: <b>' . mysql_error() . '</b></p>');
	}
} else {
	die ('<p>Could not connect to MySQL because: <b>' . mysql_error() . '</b></p>');
}
$query=mysql_query("SELECT first_name, last_name FROM tna_peranan WHERE kp_s ='{$_GET['mykad']}'"); //or die ('Error performing query..1');

if ($r = mysql_query ($query)) { // Run the query.
while ($row = mysql_fetch_array ($r)) {
    $_SESSION['first_name'] = $row[first_name];
    $_SESSION['last_name'] = $row[last_name];

	}}
?>
</head>

<body>
<hr align="left" width="62%" size="20" color="#008080" noshade opacity="0.4"/>
<?php	
// Check if the form has been submitted.

if ((isset($_POST['submit']) || isset($_GET['delete']))) { 

if ($_POST['submit']=='Update Peranan'){
$id = $_POST['id']; 
$startDate = $_POST['startDate'];
$Bilangan  = $_POST['nomborlukisan'];
$description  = $_POST['tajuklukisan'];
$kp_s  = $_POST['kp_s'];
$tarikhDaftar  = $_POST['tarikhDaftar'];


if (!empty($_SESSION['first_name'])) $query = "UPDATE tna_peranan SET startDate='$startDate', Bilangan='$Bilangan', description='$description', kp_s='$kp_s',tarikhDaftar=NOW() WHERE id='$id'";		
			$result = @mysql_query ($query); // Run the query.

			if ($result) { // If it ran OK.
			
				// Send an email, if desired.
				echo '<h4>The chosen data updated!</h4>';
}
}


if ($_GET['delete']) {
if (!empty($_SESSION['first_name'])) $delsql="DELETE from tna_peranan WHERE id='{$_GET['delete']}'";
$delresult=mysql_query($delsql);
echo "One data has been deleted just now.<br>";} 
}

//if (isset($_POST['submit']) ) { 
/*DATABASEPERIMETERS*/ 

echo '<left><table width="700" border="1" cellspacing="" 
        cellpadding="" bordercolor="#E4F3CF" bgcolor="#FDFECF">
         <tr valign="top" >
<small>Nama Staf: ( '.$_SESSION['first_name'].' '.$_SESSION['last_name'].' '.$_SESSION['kp_s'].' )</small>
<a href="../../tna/Lampiran_ABC.php?usm='.$_SESSION['kp_s'].'"><small>&nbsp;&nbsp;Lampiran_ABC</small></a>
	    </tr></table></left>';



$BIL=1;  

$result=mysql_query("SELECT * FROM tna_peranan WHERE kp_s ='600619-10-6239' ORDER BY Bilangan") or die ('Error performing query');
      while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$id = $row['id']; 
$startDate = $row['startDate'];
$Bilangan  = $row['Bilangan'];
$description  = $row['description'];
$kp_s  = $row['kp_s'];
$tarikhDaftar  = $row['tarikhDaftar'];
if ($BIL==1) print "<left><table width=\"700\" border=\"1\" cellspacing=\"1\" 
        cellpadding=\"1\" bordercolor=\"#E4F3CF\" bgcolor=\"#FDFECF\">
         <tr valign=\"top\" >
            <td width=\"50\">
              <font color=\"#000000\" size=\"2\">Edit Bil.</font> 
            </td>
		<td width=\"550\">
              <font color=\"#000000\" size=\"2\">Peranan</font>
            </td>
		<td width=\"50\">
            <font color=\"#000000\" size=\"2\">Ke<br>utama<br>an</font>
            </td>			
		<td width=\"50\">
            <font color=\"#000000\" size=\"2\">Del dataId</font>
            </td>
	    </tr>
        </table></left>";
	  
print "<left><table width=\"700\" border=\"1\" cellspacing=\"1\" cellpadding=\"0\" bordercolor=\"#E4F3CF\" bgcolor=\"#ffffff\" >
         <tr valign=\"top\" >
        <td width=\"50\" align=\"center\">
		<a href=\"editPeranan.php?update=".$id."\" style=\"display: block; width: 100%; height: 100%; text-decoration: none;\" title=\"Update this data row\"><font color=\"#000000\" size=\"2\" margin-left=\"10\">&nbsp;".$BIL++."</font></a>		
        </td>
		<td width=\"550\">
              <font color=\"#000000\" size=\"2\">&nbsp;".$description."</font>
        </td>	
		<td width=\"50\">
              <font color=\"#000000\" size=\"2\">&nbsp;".$Bilangan."</font>
        </td>			
            <td width=\"50\" align=\"center\">
		<a href=\"tnaPeranan.php?delete=".$id."\" onCLick=\"return confirmDelete();\" style=\"display: block; width: 100%; height: 100%; text-decoration: none;\" title=\"Delete this data row\"><font color=\"#000000\" size=\"2\" margin-left=\"10\">&nbsp;".$id."</font></a>
        </td>
	    </tr>
        </table></left>";
	
  }
//}
?>

	
</body>
</html>

