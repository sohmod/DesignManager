
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

<body onload="Validator.Initialize('liveForm', 5, 'submit', 'img/check.gif', 'img/x.gif');">



<form id="liveForm" action="MyBulkDrawings11.php" method="post" onsubmit="if(!Validator.AllFieldsValidated()) return false;">


<?php

$id=$_GET['change'];

$db=mysql_connect('localhost','ajaxuser','practical') or die('Error connecting to the server');
mysql_select_db('ajax') or die('Error selecting database');

   $result=mysql_query("SELECT * FROM mydrawings WHERE id='$id'") or die ('Error performing query');
      while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$daftar_id  = $row['daftar_id'];
$tajuk  = $row['tajuk'];
$nombor = $row['nombor'];
$pelukis = $row['pelukis'];
$kategori = $row['kategori'];
$peti = $row['peti'];
$tarikh = $row['tarikh'];
}

echo $daftar_id.'daftar_id';

	$db=mysql_connect('localhost','username','password') or die('Error connecting to the server');
mysql_select_db('ckaj') or die('Error selecting database');

    $result=mysql_query("SELECT tajuk FROM daftar_projek WHERE daftar_id='$daftar_id'") or die ('Error performing query');
      while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$tjkprojek  = $row['tajuk'];}
///////////

	$db=mysql_connect('localhost','ajaxuser','practical') or die('Error connecting to the server');
mysql_select_db('ajax') or die('Error selecting database');

    $rxyz=mysql_query("SELECT gridX, gridY, xy, ze FROM lotsite WHERE daftar_id='$daftar_id'") or die ('Error performing query');
      while($rowx=mysql_fetch_array($rxyz, MYSQL_ASSOC)){
$gridX  = $rowx['gridX'];
$gridY  = $rowx['gridY'];	  
$xy  = $rowx['xy'];
$ze  = $rowx['ze'];
}


?>

			<p><small>Tajuk Projek&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</small><input type="text" size="90" id="tprojek" name="tprojek" value="<?php echo $daftar_id.' : '.$tjkprojek; ?>" /></p>
			<p><small>Tajuk Lukisan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</small><input type="text" size="90" id="tajuk" name="tajuk"  onchange="Validator.Validate(this);" onblur="Validator.Validate(this);" value="<?php echo $tajuk; ?>" /></p>
			<p><small>Nombor Lukisan&nbsp;&nbsp;&nbsp;</small><input type="text" size="90" id="nombor" name="nombor"  onchange="Validator.Validate(this);" onblur="Validator.Validate(this);" value="<?php echo $nombor; ?>" /></p>

			<p><small>Nama Pelukis :&nbsp;</small><input type="text" size="25" id="pelukis" name="pelukis"  onchange="Validator.Validate(this);" onblur="Validator.Validate(this);" value="<?php echo $pelukis; ?>" />			
			<small>&nbsp;&nbsp;&nbsp;Peti.Rak No :&nbsp;</small><input type="text" size="15" id="peti" name="peti"  onchange="Validator.Validate(this);" onblur="Validator.Validate(this);"  value="<?php echo $peti; ?>" />			
<?php 
$kategoriTest=$kategori;
?>			
			<small>&nbsp;&nbsp;&nbsp;Kategori Lukisan :&nbsp;</small>
			<select id="kategori" name="kategori" onchange="Validator.Validate(this);" onblur="Validator.Validate(this);" >
				<option value=""<?php if ($kategoriTest==""){ echo 'selected="true"';}?>></option>
				<option value="Tender"<?php if ($kategoriTest=="Tender"){ echo 'selected="true"';}?>>Tender</option>
				<option value="Kontrak"<?php if ($kategoriTest=="Kontrak"){ echo 'selected="true"';}?>>Kontrak</option>
				<option value="Pembinaan"<?php if ($kategoriTest=="Pembinaan"){ echo 'selected="true"';}?>>Pembinaan</option>
				<option value="Piawai"<?php if ($kategoriTest=="Piawai"){ echo 'selected="true"';}?>>Piawai</option>
			</select></p>
			

			<p><small>Tarikh Lukisan : </small>			
<script> DateInput( 'tarikh', true, 'YYYY-MM-DD','<?php echo $tarikh; ?>')</script>	
			</p>
<input name="daftar_id" type="hidden" id="daftar_id" value="<?php echo $daftar_id;?>">
			
<input name="username" type="hidden" id="username" value="<?php echo 'wans';?>">
<input name="kp" type="hidden" id="kp" value="<?php echo '123456-78-9012';?>">
<input name="id" type="hidden" id="id" value="<?php echo $id;?>">

<p>
<small>Kordinat X :&nbsp;</small><input type="text" size="25" id="gridX" name="gridX"  onchange="Validator.Validate(this);" onblur="Validator.Validate(this);" value="<?php echo $gridX; ?>" />	
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
<small>Kordinat Y :&nbsp;</small><input type="text" size="25" id="gridY" name="gridY"  onchange="Validator.Validate(this);" onblur="Validator.Validate(this);" value="<?php echo $gridY; ?>" />		
</p>			
		<div id="innerFieldset">
			<noscript>
				<input name="submit" id="submit" type="submit" value="UpdateData" class="action" />

			</noscript>
		</div>
		<script type="text/javascript">
			gebid('innerFieldset').innerHTML = '<input name="submit" id="submit" type="submit" value="UpdateData" style="width: 100px;" disabled="true" />';
		</script>
<textarea cols="40" rows="9" id="xy" name="xy" onblur="Validator.Validate(this,'pelukislukisan');"><?php echo $xy;?></textarea>
<textarea cols="10" rows="9" id="ze" name="ze" onblur="Validator.Validate(this,'pelukislukisan');"><?php echo $ze;?></textarea>
		
	</form>
	
</body>
</html>

