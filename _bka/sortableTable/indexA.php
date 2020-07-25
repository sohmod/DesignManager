<?php
	//Start session
	session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>phatfusion : sortableTable</title>

<link rel="stylesheet" href="../_common/css/main.css" type="text/css" media="all">

<link href="sortableTable.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="../_common/js/mootools.js"></script>
<script type="text/javascript" src="sortableTable.js"></script>
<?php
//echo '<link rel="stylesheet" type="text/css" href="pagine/paginator.css">';
//require_once('pagine/paginator.class.php');  

?>


</head>
<body>
<?php
//$db = new mysqli("localhost", "username", "password", "ckaj");
	//Connect to mysql db
	$conn = mysql_connect('localhost','username','password');
	mysql_select_db('ckaj',$conn);

////
$username = $_SESSION['username'];
$kpp = $_SESSION['OIC'];
$setWhere ='';
	if (!$_SESSION['OIC'] && !$_SESSION['username']): 
							$queri = "SELECT daftar_id, tajuk, OIC, lokasi, KemKlient, startDate FROM daftar_projek";
							$setWhere = " WHERE OIC <> '' ";
							$qcount =  "SELECT COUNT(*) FROM daftar_projek";
				elseif (!$_SESSION['OIC'] && $_SESSION['username']): 
						$queri = "select t1.daftar_id,
											t1.tajuk,
											t1.mod_kerja,
											t1.lokasi,
											t1.OIC,
											t1.KemKlient,
											t1.startDate,
											t1.nosiri_fail,
											t2.pereka, 
											t2.penyemak 
											from 
											daftar_projek AS t1 INNER JOIN
											butiran_projek AS t2 ON t1.daftar_id=t2.id_daftar ";
						$setWhere = "where t1.daftar_id = t2.id_daftar AND (t2.pereka ='$username' OR t2.penyemak ='$username')";
						$qcount = "SELECT COUNT(*) FROM daftar_projek AS t1 INNER JOIN butiran_projek AS t2 ON t1.daftar_id=t2.id_daftar ";
					else:	$queri = "SELECT daftar_id, tajuk, OIC, lokasi, KemKlient, startDate FROM daftar_projek";
							$setWhere = " WHERE OIC = '$kpp' ";
							$qcount =  "SELECT COUNT(*) FROM daftar_projek";
						endif;


/* $kpp = $_SESSION['OIC'];
if (preg_match("/ba/i", $_SESSION['OIC'])){$kpp = 'KPPK(BA)';}

$prunit="SELECT COUNT(*) FROM daftar_projek";
if (!$_SESSION['OIC']): $setWhere = " WHERE OIC <> '' ";
				elseif ($_SESSION['OIC']=='KPPK(KKPnPT)'): $setWhere = " WHERE OIC <> '' "; 
					else:  $setWhere = " WHERE OIC = '$kpp' ";
						endif;
$prunit .= $setWhere;*/
$count = mysql_query($qcount.$setWhere);
$num_rows=mysql_fetch_array($count);
?>


	<div id="container">
<?php
//   $pages = new Paginator;  
 //  $pages->items_total = $num_rows[0];  
   //$pages->mid_range = 10;  
 //  $pages->paginate();  
 //  echo '<div class="pagination">'.$pages->display_pages().'</div>';
?>	
		<h2 class="sortabletable"></h2>
<?php
//echo '<div class="pagination">'.$pages->display_jump_menu().$pages->display_items_per_page();
//if (!$_SESSION['OIC'] && $_SESSION['username']){echo ' <i>Pereka-> '.$_SESSION['first_name'].'</i>';}
//echo '</div>';  
/////    
$query = $queri.$setWhere ; //." $pages->limit";
?>		
		
		<div id="example">
			<div class="tableFilter">
		  		<form id="tableFilter" onsubmit="myTable.filter(this.id); return false;">Filter: 
					<select id="column">
		  				<option value="1">Tajuk</option>
						<option value="2">O.I.C</option>
						<option value="3">Lokasi</option>
						<option value="4">Kementerian</option>
						<option value="5">Tarikh Mula</option>
					</select>
					<input type="text" id="keyword" />
					<input type="submit" value="Submit" />
					<input type="reset" value="Clear" />
				</form>
		  </div>
		  
		<div class="tableFilter">
		  <table id="myTable" cellpadding="0" cellpadding="0">

		  	<thead>
				<th axis="number">Job.no</th>
				<th axis="string">Tajuk</th>
				<th axis="string">O.I.C</th>
				<th axis="string">Lokasi</th>
				<th axis="string">Kementerian</th>
				<th axis="date">Tarikh Mula</th>				
			</thead>

			<tbody>
		  

<?php

$result = mysql_query($query);
 
//$o = '<table id="myTable"><thead><tr><th>Name</th><th>Occupation</th><th>Age</th></tr></thead><tbody>';
$i = 1 ;
//while(list($daftar_id, $tajuk, $OIC, $lokasi, $KemKlient, $startDate) = $result->fetch_row()) {
	// $o .= '<tr id="'.$.'"><td>'.$name.'</td><td>'.$occu.'</td><td>'.$age.'</td></tr>';
while($row = mysql_fetch_assoc($result)) {
	$o .= 	'<tr id="'.$row['daftar_id'].'">
			<td class="sempit">'.$row['daftar_id'].'</td>
			<td class="lebar">'.$row['tajuk'].'</td>
			<td class="ngam">'.$row['OIC'].'</td>
			<td class="ngam">'.$row['lokasi'].'</td>
			<td class="ngam2">'.$row['KemKlient'].'</td>
			<td class="rightAlign">'.$row['startDate'].'</td>			
			</tr>';
}
 
$o .= '</tbody></table>';
 
echo $o; 
		  
?>			

			<tfoot>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>					
				</tr>
			</tfoot>
		  </table>

		
		<script type="text/javascript">
			var myTable = {};
			window.addEvent('domready', function(){
				myTable = new sortableTable('myTable', {overCls: 'over', onClick: function(){location='requestHandler.php?id='+(this.id)}});
			});
		</script>
		</div>
		
</div>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-3333085-1");
pageTracker._initData();
pageTracker._trackPageview();
</script>
</body>
</html>