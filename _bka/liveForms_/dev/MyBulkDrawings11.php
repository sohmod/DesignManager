
<html>
<head>
	<title>Live forms</title>
<script type="text/javascript" src="jquery-1.2.1.pack.js"></script>
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


function disp_prompt()
{
var name=prompt("Please enter your name","Harry Potter");
if (name!=null && name!="")
  {
  //document.write("Hello " + name + "! How are you today?");
  return true;
  }
}
	
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
	
	</style>
	
	
	<?php	
//require_once ('config.inc'); 
session_start();
$kp=array('640212-01-5729','600306-02-5278','611121-03-5422','630425-01-5045','731008-01-6709','580307-03-5341');
$ppk=array('KPPK(BA)','KPPK(Ksih)','KPPK(Ksel)','KPPK(PT)','KPPK(BA)','KPPK');
$chkoic=array_combine($kp, $ppk);
//print_r($chkoic);
?>

	
	
	
</head>

<body onload="Validator.Initialize('liveForm', 5, 'submit', 'img/check.gif', 'img/x.gif');">
<?php	
//echo $tjkprojek . '_-_-_';



if ((isset($_POST['submit']) || isset($_GET['delete'])) ) { // Check if the form has been submitted.
$tprojekid_post=$_POST['tprojek'];
$tprojekid_arr=explode(":", $tprojekid_post);
$OIC=trim($tprojekid_arr[0]);
$daftar_id=trim($tprojekid_arr[1]);
if ($daftar_id==''){$daftar_id=trim($_POST['tprojek']);}


$db=mysql_connect('localhost','username','password') or die('Error connecting to the server');
mysql_select_db('ckaj') or die('Error selecting database');

    $result=mysql_query("SELECT OIC FROM daftar_projek WHERE daftar_id='$daftar_id'") or die ('Error performing query');
    while($row=mysql_fetch_array($result, MYSQL_ASSOC)){$OIC  = $row['OIC'];}
echo $OIC.' oic<br/>';


if ($_POST['submit']=='Register'):


$db=mysql_connect('localhost','ajaxuser','practical') or die('Error connecting to the server');
mysql_select_db('ajax') or die('Error selecting database');
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



//if ($changeKP=='KPPK'){$changeKP=$OIC;}
//echo $changeKP.$OIC.'changeKP<br/>';
	if(floatval($OIC)==0 && $tajuk!='' && $nombor!='' && ($changeKP=='KPPK(BA)' || $changeKP=='KPPK(Ksih)' || $changeKP=='KPPK(Ksel)' || $changeKP=='KPPK(PT)' || $changeKP=='KPPK(BA)' || $changeKP=='KPPK')){ //do
	
			$query = "INSERT INTO mydrawings (daftar_id, tajuk, nombor, kategori, peti,tarikh, username, kp, regist_date, pelukis) VALUES ('$daftar_id', '$tajuk', '$nombor', '$kategori', '$peti', '$tarikh', '$username', '$kp', NOW(), '$pelukis')";		
	$result[$i] = @mysql_query ($query); // Run the query.	
	$validinput++;		
	
	
									} else
						{
					echo ".. jobno isn't your's or yet to login ..";

							}
						}	
echo 'INFO input : '.$dcount.' data / '. $validinput .' lukisan ke db ';							
//////for ($i=0;$i<=$dcount;$i++){

			if ($result[$i]) { // If it ran OK.
			
				// Send an email, if desired.
				echo $i.'Registered! :: ';
			 //exit();				
				
			} else { // If it did not run OK.
					//my_error_handler (mysql_errno(),
			echo $i.'.<font color="red" size="-1"> mysql_error:'.mysql_error().'</font> :: '; 	

				// Send a message to the error log, if desired.
				//echo $i.'<font color="red" size="-1">system_error</font> :: '; 
			}
		  ////////}
		  

elseif ($_POST['submit']=='UpdateData'):
    
$db=mysql_connect('localhost','ajaxuser','practical') or die('Error connecting to the server');
mysql_select_db('ajax') or die('Error selecting database');
//$daftar_id=$_POST['daftar_id'];
//echo $_POST['tarikh'].'from script';
$id=$_POST['id'];
$tprojek=$_POST['tprojek'];
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
$xy=$_POST['xy'];
$ze=$_POST['ze'];
$gridX=$_POST['gridX'];
$gridY=$_POST['gridY'];

//echo $ze.'ze'.$xy.':'.$gridX.'grid'.$gridY.'::'.$daftar_id.'tjk::'.$tajuk;

//if ($xy!='' || $ze!=''){
	$query1 = "INSERT into lotsite (daftar_id,gridX,gridY,xy,ze,regist_date,tprojek) values ('$daftar_id','$gridX','$gridY','$xy','$ze',NOW(),'$tprojek')";
	$rxyz = @mysql_query ($query1);
//	}

 	$query = "UPDATE mydrawings,lotsite SET mydrawings.tajuk='$tajuk', mydrawings.nombor='$nombor', mydrawings.kategori='$kategori', mydrawings.peti='$peti', mydrawings.tarikh='$tarikh', mydrawings.username='$username', mydrawings.kp='$kp', mydrawings.regist_date=NOW(),mydrawings.pelukis='$pelukis', lotsite.gridX='$gridX', lotsite.gridY='$gridY',lotsite.xy='$xy', lotsite.ze='$ze', lotsite.regist_date=NOW(),lotsite.tprojek='$tprojek' WHERE mydrawings.id='$id' and lotsite.daftar_id='$daftar_id'";		
	$result = @mysql_query ($query); // Run the query.

		if ($result) { // If it ran OK.	

				if ($rxyz) {	echo ' xyz '.$id.' inserted! ';	}
					echo ' Data '.$id.' updated! ';
					
	} else { // If it did not run OK.
				//my_error_handler (mysql_errno(),
echo '::Data '.$id.'.<font color="red" size="-1"> mysql_error:'.mysql_error().'</font>::'; 	

			}  
	
else:
/// deleting data

$id=$_GET['delete'];
$id=trim($id);

    $db=mysql_connect('localhost','ajaxuser','practical') or die('Error connecting to the server');
mysql_select_db('ajax') or die('Error selecting database');
//$daftar_id=$_POST['daftar_id'];
//echo $_POST['tarikh'].'from script';
//$id=$_GET['delete'];

 	$query = "DELETE FROM mydrawings WHERE id='$id'";		
			$result = @mysql_query ($query); // Run the query.

			if ($result) { // If it ran OK.
			
				// Send an email, if desired.
				echo ' Data '.$id.' deleted! from jobno: '. $_SESSION['daftar_id'];

				//echo '<center><h3>Thank you for registering!</h3></center>';
				// exit();	
//		header ("Location:  http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/MyBulkDrawings11.php?projek=".$daftar_id);
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



	<form id="liveForm" action="MyBulkDrawings11.php" method="post" onsubmit="if(!Validator.AllFieldsValidated()) return false;">

			<div>
<small>Tajuk Projek (auto) :</small> &nbsp;<a href="http://172.20.59.234/ckaj/Laporan_bulanan.php"><small>(Back)</small></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>Kategori Lukisan :</small>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>Nombor peti :</small> 			

				<textarea cols="60" rows="2" id="inputString" name="tprojek" onkeyup="lookup(this.value);" onblur="fill();Validator.Validate(this,'tajukprojek');" value="" ></textarea>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;				
<select id="kategori" name="kategori" width="15" onchange="Validator.Validate(this);" onblur="Validator.Validate(this);">
				<option value="" selected="true"></option>
				<option value="Tender">Tender</option>
				<option value="Kontrak">Kontrak</option>
				<option value="Pembinaan">Pembinaan</option>
				<option value="Piawai">Piawai</option>
</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
				<input name="peti" type="text" size="10" id="peti" value="">	
		
			</div>	
			
			<div class="suggestionsBox" id="suggestions" style="display: none;">
				<img src="upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
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
			

<div><small>Tajuk Lukisan :</small> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>Nombor Lukisan :</small>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>Nama pelukis : </small>
</div>
<div><textarea cols="40" rows="9" id="tajuk" name="tajuk" onblur="Validator.Validate(this,'tajuklukisan');"></textarea>
<textarea cols="40" rows="9" id="nombor" name="nombor" onblur="Validator.Validate(this,'nomborlukisan');"></textarea>
<textarea cols="12" rows="9" id="pelukis" name="pelukis" onblur="Validator.Validate(this,'pelukislukisan');"></textarea>

</div>			
			
			<small>Tarikh Lukisan : </small>
			<script> DateInput( 'tarikh', true, 'MM/DD/YYYY')</script>
			
<input name="username" type="hidden" id="username" onblur="Validator.Validate(this,'username');" value="<?php echo $_SESSION['username'] ?>">
<input name="kp" type="hidden" id="kp" onblur="Validator.Validate(this,'kp');"value="<?php echo $_SESSION['kp_s'] ?>">
			
			
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
//echo '<small>No.&Tajuk Projek -:&nbsp;'. $_POST['tprojek'].'</small>';
$db = new mysqli('localhost', 'username' ,'password', 'ckaj');

$query = $db->query("SELECT tajuk,OIC FROM daftar_projek WHERE daftar_id='$daftar_id'");
while ($result = $query ->fetch_object()) {
$tprojek=$result->tajuk;
$OIC=$result->OIC;

}



echo '<left><table width="800" border="1" cellspacing="" 
        cellpadding="" bordercolor="#E4F3CF" bgcolor="#FDFECF">
         <tr valign="top" >
<small>'.$OIC.'-:'.$daftar_id.':-'.$tprojek.'</small>
	    </tr></table></left>';


print "<left><table width=\"750\" border=\"1\" cellspacing=\"1\" 
        cellpadding=\"2\" bordercolor=\"#E4F3CF\" bgcolor=\"#FDFECF\">
         <tr valign=\"top\" >
            <td width=\"50\">
              <font color=\"#999999\" size=\"1\">clickBIL2edit</font> 
            </td>
		<td width=\"300\">
              <font color=\"#999999\" size=\"1\">Tajuk Lukisan.</font>
            </td>
		<td width=\"250\">
            <font color=\"#999999\" size=\"1\">Nombor Lukisan.</font>
            </td>
		<td width=\"50\">
              <font color=\"#999999\" size=\"1\">Kategori.</font>
            </td>			
		<td width=\"100\">
              <font color=\"#999999\" size=\"1\">Pelukis.</font>
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

print "<left><table width=\"750\" border=\"1\" cellspacing=\"1\" cellpadding=\"0\" bordercolor=\"#E4F3CF\" bgcolor=\"#ffffff\" >
         <tr valign=\"top\" >
            <td width=\"50\" align=\"center\">
		<a href=\"MyDrawings11.php?change=".$id." \" ><font color=\"#999999\" size=\"1\" margin-left=\"10\">".$BIL++."</font></a>
            </td>
		<td width=\"300\">
              <font color=\"#999999\" size=\"1\">".$tajuk."</font>
            </td>
		<td width=\"250\">
            <font color=\"#999999\" size=\"1\">".$nombor." &nbsp;Trk: ".$tarikh."</font>
            </td>
		<td width=\"50\">
              <font color=\"#999999\" size=\"1\">".$kategori."</font>
            </td>		
            <td width=\"100\" align=\"left\">
		<a href=\"MyBulkDrawings11.php?delete=".$id." \" onCLick=\"return confirmDelete();\"><font color=\"#999999\" size=\"1\" margin-left=\"10\">".$pelukis."</font></a>
            </td>
	    </tr>
        </table></left>";
		
}

?>

</body>
</html>

