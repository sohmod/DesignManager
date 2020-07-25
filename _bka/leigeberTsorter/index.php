<?php
	//Start session
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>bka - Table Sorter</title>
<link href="sortableTable.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="style.css" />
<script type="text/javascript" src="script.js"></script>
</head>
<body>

<?php
require ("../../ckaj/inc/projek_daftar_cfg.php");

	//Connect to mysql db
	$conn = mysql_connect('localhost','username','password');
	mysql_select_db('ckaj',$conn);

$username = $_SESSION['username'];
$kpp = $_SESSION['OIC'];
$setWhere ='';
	if (!$_SESSION['OIC'] && !$_SESSION['username']): 
							$queri = "SELECT daftar_id, tajuk, mod_kerja, OIC, lokasi, KemKlient, startDate, nosiri_fail FROM daftar_projek";
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

$count = mysql_query($qcount.$setWhere);
$num_rows=mysql_fetch_array($count);
$query = $queri.$setWhere ; //." $pages->limit";

?>







<div id="wrapper">
	<table cellpadding="0" cellspacing="0" border="0" class="sortable" id="sorter">
<?php
	
	$o =  	'<tr>
			<th>ID</th>
			
			<th>Tajuk Projek</th>
			<th>Modus</th>
			<th>HODT_Sivil</th>			
			<th>Lokasi</th>
			<th>Kementerian</th>
			<th>TarikhDaftar</th>			
			<th>No Fail</th>
		</tr>';
		
//$oic_FAIL[$OIC].$KOD_KEM[$KemKlient].'/'.$KOD_NEG[$lokasi].$nosiri_fail			
/*			<th>Kos 3row</th>
			<th>Trk Tender/Kontrak mula/siap</th>
			<th>K Perlaksanaan</th>
			<th>Dplan/Qplan/Brif/LwtTpk</th>
			<th>Nama Kontraktor</th>
			<th>Perunding</th>
			<th>HOPT</th>

		</tr>'; */

$result = mysql_query($query);
 
while($row = mysql_fetch_assoc($result)) {
$OIC = $row['OIC'];
$KemKlient = $row['KemKlient'];
$lokasi = $row['lokasi'];
$fail = $oic_FAIL[$OIC].$KOD_KEM[$KemKlient].'/'.$KOD_NEG[$lokasi].$row['nosiri_fail'];		

	$o .= 	'<tr id="'.$row['daftar_id'].'">
			<td class="sempit"><!--a href="#" style="text-decoration:none"-->'.$row['daftar_id'].'<!--/a--></td>
			<td class="lebar">'.$row['tajuk'].'</td> 
			<td class="ngam">'.$row['mod_kerja'].'</td>			
			<td class="ngam">'.$row['OIC'].'</td>
			<td class="ngam">'.$row['lokasi'].'</td>
			<td class="ngam2">'.$row['KemKlient'].'</td>
			<td class="ngam3">'.$row['startDate'].'</td>
			<td class="rightAlign">'.$fail.'</td>
			</tr>';
}
 
$o .= '</table>';
 
echo $o; 
		  
?>
					
</div>
<script type="text/javascript">
var sorter=new table.sorter("sorter");
sorter.init("sorter",1);
</script>
</body>
</html>