
<html>
<head>
	<title>Live forms</title>
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
	


</script>	
<script type="text/javascript" src="jasoncalendar/calendarDateInput.js"></script>
	
	<script type="text/javascript" src="js/utils.js"></script>
	<script type="text/javascript" src="js/Validator.js"></script>
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

<body onload="Validator.Initialize('liveForm', 1, 'submit', 'img/check.gif', 'img/x.gif');">
<?php	


if (isset($_POST['submit']) ) { // Check if the form has been submitted.

$db=mysql_connect('localhost','ajaxuser','practical') or die('Error connecting to the server');
mysql_select_db('ajax') or die('Error selecting database');
//$daftar_id=$_POST['daftar_id'];
echo $_POST['tarikh'].'from script';
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
				echo '<center><h3>The chosen data updated!</h3></center>';
				
	$db = new mysqli('localhost', 'ajaxuser' ,'practical', 'ajax');
	if(!$db) {
		// Show error if we cannot connect.
		echo 'ERROR: Could not connect to the database.';
	} else {
	$query1 = $db->query("INSERT into lotsite (id_daftar,xyz,regist_date) values 
('$daftar_id','$xyz',NOW())");
}

	$query2 = $db->query("UPDATE lotsite SET xyz='$xyz',regist_date=NOW() WHERE id_daftar='$id_daftar'") ;
				
	if ($query1){echo '<center><h3>xyz inserted!</h3></center>';}
	else {echo '<center><h3>xyz updated!</h3></center>';}
		
				
				
				
				
				
				// exit();				
				
			} else { // If it did not run OK.
					//my_error_handler (mysql_errno(),
					echo 'Could not select the database: ' . mysql_error();	

				// Send a message to the error log, if desired.
				echo '<p><font color="red" size="+1">You could not be registered due to a system error. We apologize for any inconvenience.</font></p>'; 
			}  
}
?>



<form id="liveForm" action="MyBulkDrawings11.php" method="post" onsubmit="if(!Validator.AllFieldsValidated()) return false;">


<?php

$id=$_GET['eid'];

$result=mysql_query("SELECT * FROM tna_peranan WHERE id='$eid'",$db);
$myrow=mysql_fetch_array($result);
$dates=explode("-",$myrow[startDate]);


$db=mysql_connect('localhost','username','password') or die('Error connecting to the server');
mysql_select_db('ckaj') or die('Error selecting database');

   $result=mysql_query("SELECT * FROM tna_peranan WHERE id='$id'") or die ('Error performing query');
      while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$idset  = $id;
$Bilangan  = $row['tajuk'];
$description = $row['nombor'];
$startDate = $row['pelukis'];
}


    $result=mysql_query("SELECT tajuk FROM daftar_projek WHERE daftar_id='$daftar_id'") or die ('Error performing query');
      while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$tjkprojek  = $row['tajuk'];}
?>

			<p>Tajuk Projek<br/><input type="text" size="80" id="tprojek" name="tprojek" value="<?php echo $daftar_id.' :- '.$tjkprojek; ?>" /></p>
			<p>Tajuk Lukisan<br/><input type="text" size="80" id="tajuk" name="tajuk"  onchange="Validator.Validate(this);" onblur="Validator.Validate(this);" value="<?php echo $tajuk; ?>" /></p>
			<p>Nombor Lukisan<br/><input type="text" size="60" id="nombor" name="nombor"  onchange="Validator.Validate(this);" onblur="Validator.Validate(this);" value="<?php echo $nombor; ?>" /></p>
			<p>Nama Pelukis<br/><input type="text" size="60" id="pelukis" name="pelukis"  onchange="Validator.Validate(this);" onblur="Validator.Validate(this);" value="<?php echo $pelukis; ?>" /></p>
			
<?php 
$kategoriTest=$kategori;
?>			
			<p>Kategori Lukisan :
			<select id="kategori" name="kategori" onchange="Validator.Validate(this);" onblur="Validator.Validate(this);" >
				<option value=""<?php if ($kategoriTest==""){ echo 'selected="true"';}?>></option>
				<option value="Tender"<?php if ($kategoriTest=="Tender"){ echo 'selected="true"';}?>>Tender</option>
				<option value="Kontrak"<?php if ($kategoriTest=="Kontrak"){ echo 'selected="true"';}?>>Kontrak</option>
				<option value="Pembinaan"<?php if ($kategoriTest=="Pembinaan"){ echo 'selected="true"';}?>>Pembinaan</option>
				<option value="Piawai"<?php if ($kategoriTest=="Piawai"){ echo 'selected="true"';}?>>Piawai</option>
			</select>
			
			
			Peti.Rak No : <input type="text" size="15" id="peti" name="peti"  onchange="Validator.Validate(this);" onblur="Validator.Validate(this);"  value="<?php echo $peti; ?>" />
			</p>
			<p>Tarikh Lukisan : 			
<script> DateInput( 'tarikh', true, 'YYYY-MM-DD','<?php echo $tarikh; ?>')</script>	
			</p>
<input name="daftar_id" type="hidden" id="daftar_id" value="<?php echo $daftar_id;?>">
			
<input name="username" type="hidden" id="username" value="<?php echo 'wans';?>">
<input name="kp" type="hidden" id="kp" value="<?php echo '123456-78-9012';?>">
<input name="id" type="hidden" id="id" value="<?php echo $id;?>">
<textarea cols="30" rows="9" id="xyz" name="xyz" onblur="Validator.Validate(this,'pelukislukisan');"></textarea>
			
			
		<div id="innerFieldset">
			<noscript>
				<input name="submit" id="submit" type="submit" value="UpdateData" class="action" />

			</noscript>
		</div>
		<script type="text/javascript">
			gebid('innerFieldset').innerHTML = '<input name="submit" id="submit" type="submit" value="UpdateData" style="width: 100px;" disabled="true" />';
		</script>
	</form>













 
	
	
	
	
</body>
</html>

