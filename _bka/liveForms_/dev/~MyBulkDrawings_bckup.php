
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


?>

	
	
	
</head>

<body onload="Validator.Initialize('liveForm', 5, 'submit', 'img/check.gif', 'img/x.gif');">
<?php	
//echo $tjkprojek . '_-_-_';



if (isset($_POST['submit']) || isset($_GET['delete'])) { // Check if the form has been submitted.
if ($_POST['submit']=='Register'):

$tprojekid_post=$_POST['tprojek'];
$tprojekid_arr=explode(":", $tprojekid_post);
$daftar_id=trim($tprojekid_arr[0]);

/*	$db=mysql_connect('localhost','username','password') or die('Error connecting to the server');
mysql_select_db('ckaj') or die('Error selecting database');

    $result=mysql_query("SELECT tajuk FROM daftar_projek WHERE daftar_id='$daftar_id'") or die ('Error performing query');
      while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$tjkprojek  = $row['tajuk'];}
//echo '_-_-_0_-_-_'.$tjkprojek .'_-_-_0_-_-_';
*/

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
	if($tajuk=='' || $nombor==''){ //skiping
									} else
						{
			$query = "INSERT INTO mydrawings (daftar_id, tajuk, nombor, kategori, peti,tarikh, username, kp, regist_date, pelukis) VALUES ('$daftar_id', '$tajuk', '$nombor', '$kategori', '$peti', '$tarikh', '$username', '$kp', NOW(), '$pelukis')";		
	$result[$i] = @mysql_query ($query); // Run the query.	
	$validinput++;	
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

    $db=mysql_connect('localhost','ajaxuser','practical') or die('Error connecting to the server');
mysql_select_db('ajax') or die('Error selecting database');
//$daftar_id=$_POST['daftar_id'];
//echo $_POST['tarikh'].'from script';
//$id=$_GET['delete'];

 	$query = "DELETE FROM mydrawings WHERE id='$id'";		
			$result = @mysql_query ($query); // Run the query.

			if ($result) { // If it ran OK.
			
				// Send an email, if desired.
				echo ' Data '.$id.' deleted! ';

				//echo '<center><h3>Thank you for registering!</h3></center>';
				// exit();	
//		header ("Location:  http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/MyBulkDrawings.php?projek=".$daftar_id);
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



	<form id="liveForm" action="MyBulkDrawings.php" method="post" onsubmit="if(!Validator.AllFieldsValidated()) return false;">

			<div>
<small>Nombor peti :</small> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>Tajuk Projek (auto) :</small> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>Kategori Lukisan :	</small>			
				<br /><input name="peti" type="text" size="10" id="peti" value="">	

				<input type="text" size="95" value="" id="inputString" name="tprojek" onkeyup="lookup(this.value);" onblur="fill();Validator.Validate(this,'tajukprojek');" />
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
			

<div><small>Tajuk Lukisan :</small> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>Nombor Lukisan :</small>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>Nama pelukis : </small>
</div>
<div><textarea cols="40" rows="9" id="tajuk" name="tajuk" onblur="Validator.Validate(this,'tajuklukisan');"></textarea>
<textarea cols="40" rows="9" id="nombor" name="nombor" onblur="Validator.Validate(this,'nomborlukisan');"></textarea>
<textarea cols="12" rows="9" id="pelukis" name="pelukis" onblur="Validator.Validate(this,'pelukislukisan');"></textarea>

</div>			
			
			<small>Tarikh Lukisan : </small>
			<script> DateInput( 'tarikh', true, 'MM/DD/YYYY')</script>
			
<input name="username" type="hidden" id="username" value="<?php echo 'wans';?>">
<input name="kp" type="hidden" id="kp" value="<?php echo '123456-78-9012';?>">
			
			
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
echo '<small>No.&Tajuk Projek -:&nbsp;'. $_POST['tprojek'].'</small>';


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
		<a href=\"MyDrawings.php?change=".$id." \" ><font color=\"#999999\" size=\"1\" margin-left=\"10\">".$BIL++."</font></a>
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
            <td width=\"100\" align=\"center\">
		<a href=\"MyBulkDrawings.php?delete=".$id." \" onCLick=\"return confirmDelete();\"><font color=\"#999999\" size=\"1\" margin-left=\"10\">".$pelukis."</font></a>
            </td>
	    </tr>
        </table></left>";
		
}

?>









 
	
	
	
	
</body>
</html>

