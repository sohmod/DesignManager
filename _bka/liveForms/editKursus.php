<html>
<head>
	<title>Update Peranan</title>
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

<body onload="Validator.Initialize('liveForm', 2, 'submit', 'img/check.gif', 'img/x.gif');">
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

 	$query = "UPDATE tna_kursus SET tajuk='$tajuk', nombor='$nombor', kategori='$kategori', peti='$peti',tarikh='$tarikh', username='$username', kp='$kp', regist_date=NOW(),pelukis='$pelukis' WHERE id='$id'";		
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



<form id="liveForm" action="tnaKursus.php" method="post" onsubmit="if(!Validator.AllFieldsValidated()) return false;">

<hr align="left" width="45%" size="18" color="#7FFFD4" noshade opacity="0.4"/>
<h4><font color="red" size="+1">... under construction ...</font></h4>
<?php
include_once ('../../ip_SERVER.php');
require_once('../tnakursus/config.php');
$id=$_GET['update'];
echo $_SESSION['username'];

// Connect and select.
if ($dbc = @mysql_connect (DB_HOST, DB_USER, DB_PASSWORD)) {
	if (!@mysql_select_db (DB_DATABASE)) {
		die ('<p>Could not select the database because: <b>' . mysql_error() . '</b></p>');
	}
} else {
	die ('<p>Could not connect to MySQL because: <b>' . mysql_error() . '</b></p>'); }

   $result=mysql_query("SELECT * FROM tna_kursus WHERE idy='$id'") or die ('Error performing query');
      while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$id  = $row['id'];
$startDate  = $row['startDate'];
$Bilangan = $row['Bilangan'];
$description = $row['description'];
$kp_s = $row['kp_s'];
$tarikhDaftar = $row['tarikhDaftar'];
}
?>

			<p>Edit/Update Description Kursus ini<br/><input type="text" size="80" id="tajuklukisan" name="tajuklukisan"  onchange="Validator.Validate(this);" onblur="Validator.Validate(this);" value="<?php echo $description; ?>" /></p>
			
			<p>Kod Kursus : <br/><input type="text" size="5" id="nomborlukisan" name="nomborlukisan"  onchange="Validator.Validate(this);" onblur="Validator.Validate(this);" value="<?php echo $Bilangan; ?>" /></p>			

			</p>
			<p>Tarikh Daftar : 			
<script> DateInput( 'startDate', true, 'YYYY-MM-DD','<?php echo $startDate; ?>')</script>	
			</p>
			
<input name="username" type="hidden" id="username" value="<?php echo $_SESSION['username'];?>">
<input name="kp_s" type="hidden" id="kp_s" value="<?php echo $kp_s;?>">
<input name="id" type="hidden" id="id" value="<?php echo $id;?>">
			
			
		<div id="innerFieldset">
			<noscript>
				<input name="submit" id="submit" type="submit" value="Update" class="action" />

			</noscript>
		</div>
		<script type="text/javascript">
			gebid('innerFieldset').innerHTML = '<input name="submit" id="submit" type="submit" value="Update" style="width: 100px;" disabled="true" />';
		</script>
	</form>

	
</body>
</html>

