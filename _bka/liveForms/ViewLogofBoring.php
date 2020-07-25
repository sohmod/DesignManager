<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>	
	<title>View BH Log</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="content-style-type" content="text/css" />
	<meta name="description" content="Blog site for Log of Boring ie raw geotechnical data to assist civil engineering designers and planners" />
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
require_once('../borehole/config.php');
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

$query = "select lat,lng from eb_borehole where idy = '{$_GET['view']}'";
if ($r = mysql_query ($query)) { // Run the query.
while ($row = mysql_fetch_array ($r)) {
    $_SESSION['lat'] = $row[lat];
    $_SESSION['lng'] = $row[lng];
    $_SESSION['idy'] = $_GET['view'];}}
?>
</head>

<body onload="Validator.Initialize('liveForm', 1, 'submit', 'img/check.gif', 'img/x.gif');">
<?php	

if ((isset($_POST['submit']) || isset($_GET['delete'])) ) { // Check if the form has been submitted.
$tprojekid_post=$_POST['tprojek'];
$tprojekid_arr=explode(":", $tprojekid_post);
$OIC=trim($tprojekid_arr[0]);
$daftar_id=trim($tprojekid_arr[1]);

if ($_POST['submit']=='Register'):
/*DATABASEPERIMETERS*/ 
// Connect and select.
if ($db = @mysql_connect (DB_HOST, DB_USER, DB_PASSWORD)) {
	if (!@mysql_select_db (DB_DATABASE)) {
		die ('<p>Could not select the database because: <b>' . mysql_error() . '</b></p>'); }
} else { die ('<p>Could not connect to MySQL because: <b>' . mysql_error() . '</b></p>'); }

$tajukpost=$_POST['tajuk'];
$tajukarr=explode("#", $tajukpost);
$dcount=count($tajukarr);

$username=$_POST['username'];
$kp=$_POST['kp'];
$validinput=0;
//echo $username.' username & kp '.$kp;

for ($i=0;$i<=$dcount;$i++){
$tajuk=trim($tajukarr[$i]);
$depth=0; $spt=''; $rratio=''; $classification='';
list($depth, $spt, $rratio, $classification) = explode(';', $tajuk);
$classification=trim($classification);
$spt=trim($spt);
$n1=0; $n2=0; $n3=0; $n4=0; $n5=0; $n6=0;
list($n1, $n2, $n3, $n4, $n5, $n6) = explode(' ', $spt);
		
// check max soil strata
 $count=mysql_query("SELECT COUNT(*) FROM eb_fieldrecord WHERE idy={$_SESSION['idy']}");
 $count=mysql_fetch_array($count);
 $count=$count[0];	

	
	
		
$changeKP=$chk_logger[$_SESSION['kp_s']];
if ($changeKP=='KPPK'){$changeKP=$OIC;}
//echo $OIC.'oic<br/>';
	if(($tajuk=='') ){ //skiping
					//echo "<small>..pengasingan antara data dgn <i>';'</i> ..</small>" ;
									} else
						{
if ($changeKP <> '' && $classification <>'' && $count<=75){						
			$query_eb = "INSERT INTO eb_fieldrecord (idy, depth, n1, n2, n3, n4, n5, n6, rratio, classification, regist_date) VALUES ({$_SESSION['idy']}, '$depth', '$n1', '$n2', '$n3', '$n4', '$n5', '$n6', '$rratio', '$classification', NOW())";	
			
	$result[$i] = @mysql_query ($query_eb); // Run the query.	
	$result[$i] ? $validinput += 1 : $validinput += 0   ;
	} else { echo "<small>.. <i>'data sediada'</i> ..</small>" ; }	
							}
						}	
$query_eb ? $okfail='Successfully inserted '. ($dcount-1) .' data row.' : 	$okfail='No data inserted.' ;					
echo '<small>' . $okfail .'/valid data '. $validinput .'.</small>';		

			if ($result[$i]) { // If it ran OK.
			
				echo $i.'<small>Registered! :: </small>';
				
			} else { // If it did not run OK.
			if (mysql_error()){echo $i.'<small>.<font color="red" size="-1"> mysql_error:'.mysql_error().'</font> :: </small>';} 	

			}
		  

elseif ($_POST['submit']=='UpdateData'):
/*DATABASEPERIMETERS*/    
// do nothing 
	
else:
/// deleting data

 
endif; 		     
		}
?>
<small>Lokasi Borehole :</small><br/>

<?php
//if (isset($_POST['submit']) ) { 
/*DATABASEPERIMETERS*/ 

echo '<left><table width="700" border="1" cellspacing="" 
        cellpadding="" bordercolor="#E4F3CF" bgcolor="#FDFECF">
         <tr valign="top" >
<small>Coordinate: ( '.$_SESSION['lat'].' , '.$_SESSION['lng'].' )</small>
<a href="../borehole/lokasi_senarai.php"><small>&nbsp;&nbsp;lokasiBH</small></a>
	    </tr></table></left>';


print "<left><table width=\"700\" border=\"1\" cellspacing=\"1\" 
        cellpadding=\"2\" bordercolor=\"#E4F3CF\" bgcolor=\"#FDFECF\">
         <tr valign=\"top\" >
            <td width=\"50\">
              <font color=\"#000000\" size=\"1\">Bil.</font> 
            </td>
		<td width=\"100\">
              <font color=\"#000000\" size=\"1\">Depth</font>
            </td>
		<td width=\"150\">
            <font color=\"#000000\" size=\"1\">SPT (N values)</font>
            </td>
		<td width=\"100\">
              <font color=\"#000000\" size=\"1\">Recovery ratio (R)</font>
            </td>			
		<td width=\"300\">
              <font color=\"#000000\" size=\"1\">Description</font>
            </td>
	    </tr>
        </table></left>";
$BIL=1;  
    $result=mysql_query("SELECT * FROM eb_fieldrecord WHERE idy={$_SESSION['idy']} ORDER BY depth ASC") or die ('Error performing query');
      while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$id = $row['idz']; 
$depth = $row['depth'];
$n1  = $row['n1'];$n2  = $row['n2'];$n3  = $row['n3'];
$n4  = $row['n4'];$n5  = $row['n5'];$n6  = $row['n6'];
$rratio  = $row['rratio'];
$classification  = $row['classification'];
	  
print "<left><table width=\"700\" border=\"1\" cellspacing=\"1\" cellpadding=\"0\" bordercolor=\"#E4F3CF\" bgcolor=\"#ffffff\" >
         <tr valign=\"top\" >
        <td width=\"50\" align=\"center\">
			<font color=\"#000000\" size=\"1\" margin-left=\"10\">".$BIL++."</font>
            </td>
		<td width=\"100\">
              <font color=\"#000000\" size=\"1\">".$depth."</font>
            </td>
		<td width=\"150\">
            <font color=\"#000000\" size=\"1\">".$n1." | ".$n2." | ".$n3." | ".$n4." | ".$n5." | ".$n6." "."</font>
            </td>
		<td width=\"100\">
              <font color=\"#000000\" size=\"1\">".$rratio."</font>
            </td>		
            <td width=\"300\" align=\"left\">
		<font color=\"#000000\" size=\"1\" margin-left=\"10\">".$classification."</font>
            </td>
	    </tr>
        </table></left>";
	
  }
//}
?>

	
</body>
</html>

