<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>	
	<title>Particle Size</title>
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

$query = "select depth from eb_fieldrecord where idz = '{$_GET['deep']}' AND idy='{$_SESSION['idy']}'";
if ($r = mysql_query ($query)) { // Run the query.
while ($row = mysql_fetch_array ($r)) {
    $_SESSION['depth'] = $row[depth];
	$_SESSION['ida'] = $_GET['deep'];	
    }}

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
$tajukarr=explode(";", $tajukpost);
$dcount=count($tajukarr);
$tajuk=trim($tajukpost);
$n1=0; $n2=0; $n3=0; $n4=0; $n5=0; $n6=0;
list($ps5000, $ps3350, $ps2000, $ps1180, $ps0600, $ps0425, $ps0300, $ps0212, $ps0150, $ps0063, $ps0033, $ps0024, $ps0018, $ps0013, $ps0010, $ps0007, $ps0005, $ps0004, $ps0003, $ps0001) = explode(';', $tajuk);

$username=$_POST['username'];
$kp=$_POST['kp'];
$validinput=0;
//echo $username.' username & kp '.$kp;

		
$changeKP=$chk_logger[$_SESSION['kp_s']];
if ($changeKP=='KPPK'){$changeKP=$OIC;}
//echo $OIC.'oic<br/>';
	if(($tajuk=='') ){ //skiping
					//echo "<small>..pengasingan antara data dgn <i>';'</i> ..</small>" ;
									} else
						{
if ($changeKP <> '' && $dcount==21){						
			$query_eb = "INSERT INTO eb_atterberglimit (idy, depth, gravel, sand, silt, clay, liquid, plastic, classification, regist_date) VALUES ({$_SESSION['idy']}, '$depth', '$gravel', '$sand', '$silt', '$clay', '$liquid', '$plastic', '$classification', NOW())";	
			
	$result[$i] = @mysql_query ($query_eb); // Run the query.	
	$result[$i] ? $validinput += 1 : $validinput += 0   ;
	} else { echo "<h3 style=\"color:red;\">under construction<h3><small>.. <i>'data sediada'</i> ..</small>" ; }	
							}
						//}	
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

/*DATABASEPERIMETERS*/ 
if ($db = @mysql_connect (DB_HOST, DB_USER, DB_PASSWORD)) {
	if (!@mysql_select_db (DB_DATABASE)) {
		die ('<p>Could not select the database because: <b>' . mysql_error() . '</b></p>'); }
} else { die ('<p>Could not connect to MySQL because: <b>' . mysql_error() . '</b></p>'); }
 if ( $chk_logger<>''){

 	$query = "DELETE FROM eb_atterberglimit WHERE idy='{$_SESSION['idy']}' and  idz='{$_SESSION['idz']}'";		
			$result = @mysql_query ($query); // Run the query.
											}
			if ($result) { // If it ran OK.
			
				// Send an email, if desired.
				echo ' Data '.$id.' deleted! from borehole: '. $_SESSION['idy'];
				
			} else { // If it did not run OK.
				//my_error_handler (mysql_errno(),
			echo '::Data '.$id.'.<font color="red" size="-1"> mysql_error:'.mysql_error().'</font>::'; 	
			}  
endif; 		     
		}
?>


<form id="liveForm" action="MyAtterbergLimit.php" method="post" onsubmit="if(!Validator.AllFieldsValidated()) return false;">

			<div>
<small>Lokasi Borehole :</small><br/>		
<textarea style="border: 0; color: red; background-color: #FDFECF" cols="72" rows="3" id="inputString" name="tprojek" disabled="disabled">Latitude  : <?php echo $_SESSION['lat'].'     
Longitude : '.$_SESSION['lng'].'     
@Depth    : '. $_SESSION['depth'];?></textarea>			
			</div>	
			
			<div class="suggestionsBox" id="suggestions" style="display: none;">
				<img src="upArrow.png" style="position: relative; top: -12px; left: 70px;" alt="upArrow" />
				<div class="suggestionList" id="autoSuggestionsList">
					&nbsp;
				</div>
			</div>	
			
			<div style="float: right;"></div>
			<div class="suggestionsBox" id="suggestions" style="display: none;">
				<img src="upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
				<div class="suggestionList" id="autoSuggestionsList">
					&nbsp;
				</div>
			</div>	
			

<div>
<tr><td><font color="gray" size="1px">SOIL DESCRIPTION&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</font></td><td><font color="green" size="4px"></font></td><td><td><font color="green" size="2px"></font></td></tr>
</div>
<tr>
<td><textarea cols="50" rows="10"  style="border: 0; color: red; background-color: #FDFECF" disabled="disabled">
GRAVEL (%)
SAND (%)
SILT (%)
CLAY (%)
LIQUID LIMIT (%)
 @Moisture Content (%)
PLASTIC LIMIT (%)
CLASSIFICATION</textarea></td>&nbsp;
<td><textarea cols="6" rows="10" id="tajuk" name="tajuk" onblur="Validator.Validate(this,'tajuklukisan');">
100;
100;
100;
100;
100;
100;
100;
NONE;</textarea></td>
<!--td><img alt='vector.tutsplus.com' border='0' height="150" width='350' src='../../galleries/cplants/wheel loader 50Z.jpg' style='border: medium none;' /></td-->
</tr>

			
<small></small><input name="username" type="hidden" id="username" onblur="Validator.Validate(this,'username');" value="<?php echo $_SESSION['username'] ?>">
<small></small><input name="kp" type="hidden" id="kp" onblur="Validator.Validate(this,'kp');"value="<?php echo $_SESSION['kp_s'] ?>"><small> </small>

		<div id="innerFieldset">
			<noscript>
				<input name="submit" id="submit" type="submit" value="Register" class="action" />
			</noscript>
		</div>
		<script type="text/javascript">
			gebid('innerFieldset').innerHTML = '<input name="submit" id="submit" type="submit" value="Register" style="width: 100px;" disabled="true" />';
		</script>

	</form>

<?php
//if (isset($_POST['submit']) ) { 
/*DATABASEPERIMETERS*/ 

echo '<left><table width="600" border="1" cellspacing="" 
        cellpadding="" bordercolor="#E4F3CF" bgcolor="#FDFECF">
         <tr valign="top" >
<small>Coordinate: ( '.$_SESSION['lat'].' , '.$_SESSION['lng'].' )</small>
<a href="../borehole/lokasi_senarai.php"><small>&nbsp;&nbsp;lokasiBH</small></a>
<a href="MyParticleSize.php?deep='.$_SESSION['idz'].'"><small>&nbsp;&nbsp;ParticleSize</small></a>
<a href="MyLogofBoring.php"><small>&nbsp;&nbsp;MyLogofBoring</small></a>
	    </tr></table></left>';


print "<left><table width=\"625\" border=\"1\" cellspacing=\"1\" 
        cellpadding=\"2\" bordercolor=\"#E4F3CF\" bgcolor=\"#FDFECF\">
         <tr valign=\"top\" >
            <td width=\"625\">
              <font color=\"#000000\" size=\"1\">SOIL DESC:&nbsp;&nbsp; GRAVEL&nbsp;&nbsp; SAND&nbsp;&nbsp; SILT&nbsp;&nbsp; CLAY&nbsp;&nbsp; LL@moisture&nbsp;&nbsp; PL&nbsp;&nbsp; Classification</font>
            </td>
	    </tr>
        </table></left>";
$BIL=1;  
    $result=mysql_query("SELECT * FROM eb_atterberglimit WHERE idy='{$_SESSION['idy']}' and  depth='{$_SESSION['depth']}'") or die ('Error performing query');
      while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$id = $row['ida']; 
  
  $gravel  = $row['gravel'];
  $sand  = $row['sand'];
  $silt  = $row['silt'];
  $clay  = $row['clay'];
  $liquid  = $row['liquid'];
  $moisture  = $row['moisture'];
  $plastic  = $row['plastic'];
  $classification  = $row['classification'];

print "<left><table width=\"625\" border=\"1\" cellspacing=\"1\" cellpadding=\"0\" bordercolor=\"#E4F3CF\" bgcolor=\"#ffffff\" height=\"25\">
         <tr valign=\"top\" >
		<td width=\"625\"><a href=\"MyParticleSize.php?delete=".$id." \" onCLick=\"return confirmDelete();\" style=\"display: block; width: 100%; height: 100%; text-decoration: none;\" title=\"Record Particle Size Distribution\">
            <font color=\"#000000\" size=\"1\">".$gravel." ".$sand." ".$silt." ".$clay." ".$liquid." ".$moisture." ".$plastic." ".$classification." "."</font></a>
            </td>
	    </tr>
        </table></left>";
		
  }
//}
?>

	
</body>
</html>

