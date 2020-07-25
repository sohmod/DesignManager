<?php	
//require_once ('config.inc'); 
ob_start();
session_start();
include_once ('../../ip_SERVER.php');
include_once('../../ckas/inc/mysql_connect2cfg.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>	
	<title>BulkDrawings11</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="content-style-type" content="text/css" />
	<meta name="description" content="wanluqman's eggBlog site for students, professionals, laymen interested civil engineering infra works i.e. earthworks, hydrology-drainage, roads, water-reticulation, sewerage-networks & plants plus related structural/geotechnical works , using web based methodology to manage activities at design & construction stages " />
	<meta name="keywords" content="sohmod,managing design office,wanluqman,civil,engineer,jurutera,awam,php blog,mysql,php,blog,free,software,open source" />
	<link rel="icon" href="themes/default/favicon.ico" type="image/x-icon" />

<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript">
	function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			$.post("rpc.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} // lookup
	
	function fill(thisValue) {
		$('#inputString').val(thisValue);
		setTimeout("$('#suggestions').hide();", 200);
	}

function confirmDelete() 
{ return (confirm('Adakah anda pasti untuk hapuskan data ini? Pelupusan ini kekal dan tiada pemulihan!'));} 
	
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
	
</head>

<body onload="Validator.Initialize('liveForm', 4, 'submit', 'img/check.gif', 'img/x.gif');">
<?php	
//echo $tjkprojek . '_-_-_';
//echo $_SESSION['kp_s'].'--'.$_SESSION['first_name'].'--'.$_SESSION['user_id'].'--'.$_SESSION['kp_s'].'--'.$_SESSION['username'];



if ((isset($_POST['submit']) || isset($_GET['delete'])) ) { // Check if the form has been submitted.
$tprojekid_post=$_POST['tprojek'];
$tprojekid_arr=explode(":", $tprojekid_post);
$OIC=trim($tprojekid_arr[0]);
$daftar_id=trim($tprojekid_arr[1]);
//if ($daftar_id==''){$daftar_id=trim($_POST['tprojek']);}


if ($_POST['submit']=='Register'):

/*DATABASEPERIMETERS*/ 
   $db=@mysql_connect($ajaxHost,$ajaxULogin,$ajaxPass) or die('Error connecting to the server');
mysql_select_db($ajaxDbase) or die('Error selecting database');

//$db=mysql_connect('localhost','ajaxuser','practical') or die('Error connecting to the server');
//mysql_select_db('ajax') or die('Error selecting database');
//$daftar_id=$_POST['daftar_id'];


$tajukpost=$_POST['tajuk'];
$tajukarr=explode(";", $tajukpost);
$tajukcount=count($tajukarr);

$nomborpost=$_POST['nombor'];
$nomborarr=explode(";", $nomborpost);
$nomborcount=count($nomborarr);

$pelukispost=$_POST['pelukis'];
$pelukisarr=explode(";", $pelukispost);
$pelukiscount=count($pelukisarr);

$dcount=min($tajukcount,$nomborcount,$pelukiscount);
//echo $dcount.' bil data';


$kategori=$_POST['kategori'];
$peti=$_POST['peti'];
$tarikhraw=$_POST['tarikh'];
list($month, $day, $year) = split('[/.-]', $tarikhraw);
$tarikh=date($year.'-'.$month.'-'.$day);
//echo $month.'-'. $day.'-'. $year.$_POST['tarikh'];
$username=$_POST['username'];
$kp=$_POST['kp'];
$validinput=0;

for ($i=0;$i<=$dcount;$i++){
$tajuk=trim($tajukarr[$i]);		
$nombor=trim($nomborarr[$i]);
$pelukis=trim($pelukisarr[$i]);
$changeKP=$chkoic[$_SESSION['kp_s']];
if ($changeKP=='KPPK'){$changeKP=$OIC;}
//echo $OIC.'oic<br/>';
	if(($tajuk=='' || $nombor=='') ){ //skiping
					//echo "<small>..pengasingan antara data dgn <i>';'</i> ..</small>" ;
									} else
						{
if ($changeKP <> ''){						
			$query = "INSERT INTO mydrawings (daftar_id, tajuk, nombor, kategori, peti,tarikh, username, kp, regist_date, pelukis) VALUES ('$daftar_id', '$tajuk', '$nombor', '$kategori', '$peti', '$tarikh', '$username', '$kp', NOW(), '$pelukis')";		
	$result[$i] = @mysql_query ($query); // Run the query.	
	$result[$i] ? $validinput += 1 : $validinput += 0   ;
	} else { echo "<small>..<i>'dgn kelulusan kpp/ppk shj'</i> ..</small>" ; }	
							}
						}	
$query ? $okfail='Successfully ' : 	$okfail='No access to insert ie ' ;					
echo '<small>Generated '. ($dcount-1) .' data . ' . $okfail . $validinput .' data inserted ke db </small>';							

			if ($result[$i]) { // If it ran OK.
			
				echo $i.'<small>Registered! :: </small>';
				
			} else { // If it did not run OK.
			if (mysql_error()){echo $i.'<small>.<font color="red" size="-1"> mysql_error:'.mysql_error().'</font> :: </small>';} 	

			}
		  

elseif ($_POST['submit']=='UpdateData'):
/*DATABASEPERIMETERS*/    
   $db=@mysql_connect($ajaxHost,$ajaxULogin,$ajaxPass) or die('Error connecting to the server');
mysql_select_db($ajaxDbase) or die('Error selecting database');

//$db=mysql_connect('localhost','ajaxuser','practical') or die('Error connecting to the server');
//mysql_select_db('ajax') or die('Error selecting database');
//$daftar_id=$_POST['daftar_id'];
//echo $_POST['tarikh'].'from script';
$id=$_POST['id'];
$daftar_id=$_POST['daftar_id'];
$tajuk=$_POST['tajuk'];
$nombor=$_POST['nombor'];
$kategori=$_POST['kategori'];
$peti=$_POST['peti'];
$tarikhraw=$_POST['tarikh'];
list($year, $month, $day) = split('[/.-]', $tarikhraw);
$tarikh=date($year.'-'.$month.'-'.$day);
//echo $month.'-'. $day.'-'. $year.$_POST['tarikh'];
$username=$_POST['username'];
$kp=$_POST['kp'];
$pelukis=$_POST['pelukis'];

 	$query = "UPDATE mydrawings SET tajuk='$tajuk', nombor='$nombor', kategori='$kategori', peti='$peti',tarikh='$tarikh', username='$username', kp='$kp', regist_date=NOW(),pelukis='$pelukis' WHERE id='$id'";		
			$result = @mysql_query ($query); // Run the query.

			if ($result) { // If it ran OK.
			
				// Send an email, if desired.
				echo ' Data '.$id.' updated! ';

				//echo '<center><h3>Thank you for registering!</h3></center>';
				// exit();				
				
			} else { // If it did not run OK.
				//my_error_handler (mysql_errno(),
			echo '::Data '.$id.'.<font color="red" size="-1"> mysql_error:'.mysql_error().'</font>::'; 	

				// Send a message to the error log, if desired.
				//echo $i.'<font color="red" size="-1">system_error</font> :: '; 
			}  
	
else:
/// deleting data

$id=$_GET['delete'];
$id=trim($id);
/*DATABASEPERIMETERS*/ 
   $db=@mysql_connect($ajaxHost,$ajaxULogin,$ajaxPass) or die('Error connecting to the server');
mysql_select_db($ajaxDbase) or die('Error selecting database');

//    $db=mysql_connect('localhost','ajaxuser','practical') or die('Error connecting to the server');
//mysql_select_db('ajax') or die('Error selecting database');
//$daftar_id=$_POST['daftar_id'];
//echo $_POST['tarikh'].'from script';
//$id=$_GET['delete'];
if ( $chkoic<>'' ){

 	$query = "DELETE FROM mydrawings WHERE id='$id'";		
			$result = @mysql_query ($query); // Run the query.
											}
			if ($result) { // If it ran OK.
			
				// Send an email, if desired.
				echo ' Data '.$id.' deleted! from jobno: '. $_SESSION['daftar_id'];
			
				//echo '<center><h3>Thank you for registering!</h3></center>';
				// exit();	
//		header ("Location:  http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/MyBulkDrawings11.php");
//		exit();			
				
			} else { // If it did not run OK.
				//my_error_handler (mysql_errno(),
			echo '::Data '.$id.'.<font color="red" size="-1"> mysql_error:'.mysql_error().'</font>::'; 	

				// Send a message to the error log, if desired.
				//echo $i.'<font color="red" size="-1">system_error</font> :: '; 
			}  
endif; 		  
		  
		  
		   
		}
		
?>

<fieldset> <small> <center>
<a href="<?php echo "http://".$ipthis."/".PROJ_FOLDER."/projek_daftar.php?event=Pinda";?>">Daftar</a> |
<a href="<?php echo "http://".$ipthis."/".PROJ_FOLDER."/projek_Dplan.php?event=Pinda";?>">D-Plan</a> |
<!--a href="<?php echo "projek_Perunding.php?event=Pinda";?>">Perunding</a> |-->
<a href="<?php echo "http://".$ipthis."/".PROJ_FOLDER."/projek_butiran.php?event=Pinda";?>"-->Butiran</a> |

<!--a href="<?php echo "projek_sivil.php?event=Pinda";?>">Kerja sivil</a> |
<a href="<?php echo "projek_status.php?event=Pinda";?>">Status</a> | -->
<a href="<?php echo "http://".$ipthis."/_bka/editinPlacejQuery/kemajuanRB.php";?>"><font color="green" size="2em" style="text-decoration:none">KemajuanRB</font></a> | 

<!--a href="<?php echo "projek_senarai.php?order={$_SESSION['ppk']}";?>">Senarai</a> |-->
<a href="<?php echo "http://".$ipthis."/_bka/editinPlacejQuery/ulasanTeknikal_general.php" ;?>">U.Teknikal</a> |
<a href="<?php echo "http://".$ipthis."/_bka/editinPlace050/penilaian_kriteria_earthwork.php" ;?>">P.Tender</a> |
<a href="<?php echo "http://".$ipthis."/_bka/editinPlace050/NeedsStatement.php" ;?>">N.S.</a> |
<!--a href="<?php echo "http://".$ipthis."/_bka/liveForms/MyBulkDrawings11.php" ;?>"-->D.Lukisan<!--/a-->
<?php
if (isset($_SESSION['first_name'])){
echo ' | <a href="../../ckas/Laporan_bulanan.php">Carian</a>' ;
echo ' | <a href="../borehole/index.php" style="text-decoration:none" >D.Borehole</a>' ;
}
?>
</center> </small> </fieldset>		
		
		
		


	<form id="liveForm" action="MyBulkDrawings11.php" method="post" onsubmit="if(!Validator.AllFieldsValidated()) return false;">

			<div>
<small>Nombor peti :</small> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>Job no: Tajuk Projek (auto) </small> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>Kategori Lukisan :	</small>			
				<br /><input name="peti" type="text" size="10" id="peti" value="">	

				<textarea cols="72" rows="2" id="inputString" name="tprojek" >
Job no:<?php echo $_SESSION['daftar_id'].':-'.$_SESSION['tajuk'] ;?>
				</textarea>
				
				<!--textarea cols="72" rows="2" id="inputString" name="tprojek" onkeyup="lookup(this.value);" onblur="fill();Validator.Validate(this,'tajukprojek');" value="" disabled="true">
Job no:<?php //echo $_SESSION['daftar_id'].':-'.$_SESSION['tajuk'] ;?>
				</textarea-->

				
				<!--input type="text" size="95" value="" id="inputString" name="tprojek" onkeyup="lookup(this.value);" onblur="fill(this.value);Validator.Validate(this,'tajukprojek');" /-->
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;				
<select id="kategori" name="kategori" width="15" onchange="Validator.Validate(this);" onblur="Validator.Validate(this);">
				<option value="" selected="true"></option>
				<option value="Tender">Tender</option>
				<option value="Kontrak">Kontrak</option>
				<option value="Pembinaan">Pembinaan</option>
				<option value="Piawai">Piawai</option>
</select>			
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
			

<div><small>Tajuk Lukisan :</small> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>Nombor Lukisan :</small>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>Nama pelukis : </small>
</div>
<div><textarea cols="40" rows="5" id="tajuk" name="tajuk" onblur="Validator.Validate(this,'tajuklukisan');"></textarea>
<textarea cols="40" rows="5" id="nombor" name="nombor" onblur="Validator.Validate(this,'nomborlukisan');"></textarea>
<textarea cols="12" rows="5" id="pelukis" name="pelukis" onblur="Validator.Validate(this,'pelukislukisan');"></textarea>

</div>			
			
			<small>Tarikh Lukisan : </small>
			<script> DateInput( 'tarikh', true, 'MM/DD/YYYY')</script>
			
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
if (isset($_POST['submit']) ) { 
/*DATABASEPERIMETERS*/ 
$dbf = new mysqli($dbHost, $dbUserLogin, $dbPassword, $dbName);
$query = $dbf->query("SELECT tajuk,OIC FROM daftar_projek WHERE daftar_id='$daftar_id'");
while ($resultf = $query ->fetch_object()) {
$tprojek=$resultf->tajuk;
$OIC=$resultf->OIC;

}



echo '<left><table width="900" border="1" cellspacing="" 
        cellpadding="" bordercolor="#E4F3CF" bgcolor="#FDFECF">
         <tr valign="top" >
<small>'.$OIC.'-:'.$daftar_id.':-'.$tprojek.'</small>
	    </tr></table></left>';


print "<left><table width=\"900\" border=\"1\" cellspacing=\"1\" 
        cellpadding=\"2\" bordercolor=\"#E4F3CF\" bgcolor=\"#FDFECF\">
         <tr valign=\"top\" >
            <td width=\"50\">
              <font color=\"#000000\" size=\"1\">clickBIL2edit</font> 
            </td>
		<td width=\"350\">
              <font color=\"#000000\" size=\"1\">Tajuk Lukisan.</font>
            </td>
		<td width=\"250\">
            <font color=\"#000000\" size=\"1\">Nombor Lukisan.</font>
            </td>
		<td width=\"50\">
            <font color=\"#000000\" size=\"1\">Tarikh</font>
            </td>
		<td width=\"50\">
              <font color=\"#000000\" size=\"1\">Kategori.</font>
            </td>			
		<td width=\"100\">
              <font color=\"#000000\" size=\"1\">clickPELUKIS2delete</font>
            </td>
	    </tr>
        </table></left>";
$BIL=1;  
    $result=mysql_query("SELECT * FROM mydrawings WHERE daftar_id='$daftar_id' ORDER BY regist_date DESC") or die ('Error performing query');
      while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$id  = $row['id'];
$tajuk  = $row['tajuk'];
$nombor  = $row['nombor'];
$kategori  = $row['kategori'];
$tarikh  = $row['tarikh'];
$pelukis  = $row['pelukis'];

//echo $tajuk .'_-_-_0_-_-_'.$nombor .'_-_-_0_-_-_'.$kategori.'<br/>';

print "<left><table width=\"900\" border=\"1\" cellspacing=\"1\" cellpadding=\"0\" bordercolor=\"#E4F3CF\" bgcolor=\"#ffffff\" >
         <tr valign=\"top\" >
            <td width=\"50\" align=\"center\">
		<a href=\"MyDrawings.php?change=".$id." \" ><font color=\"#000000\" size=\"1\" margin-left=\"10\">".$BIL++."</font></a>
            </td>
		<td width=\"350\">
              <font color=\"#000000\" size=\"1\">".$tajuk."</font>
            </td>
		<td width=\"250\">
            <font color=\"#000000\" size=\"1\">".$nombor."</font>
            </td>
		<td width=\"50\">
            <font color=\"#000000\" size=\"1\">".$tarikh."</font>
            </td>
		<td width=\"50\">
              <font color=\"#000000\" size=\"1\">".$kategori."</font>
            </td>		
            <td width=\"100\" align=\"left\">
		<a href=\"MyBulkDrawings11.php?delete=".$id." \" onCLick=\"return confirmDelete();\"><font color=\"#000000\" size=\"1\" margin-left=\"10\">".$pelukis."</font></a>
            </td>
	    </tr>
        </table></left>";
		
}
}
?>

	
</body>
</html>
<?php // Flush the buffered output to the Web browser.
ob_flush();
?>
