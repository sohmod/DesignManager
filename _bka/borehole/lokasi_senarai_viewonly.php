<?php 
		//require_once('auth-kpp.php');

		ob_start();
		session_start();
		require_once('config.php');
$page_title = 'senarai lokasi BH';
//include_once ('html/header.htm');


// Welcome the user (by name if they are logged in).
//if (isset($_SESSION['first_name'])) {
//echo " <center> Salam Member, {$_SESSION['first_name']}!";
//echo ' | <a href="index2.php"><small>index2</small></a></center> ';
//}
?>
 <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1">

 <style type="text/css">
 a:link { text-decoration:none }
 a:visited { text-decoration:none }
 a:hover { text-decoration:underline }
 body { font-family:Verdana,Arial,Helvetica,sans-serif;font-size:12px;} 
.style8 {color:#CCCCCC;font-size:9px;} --> 
	a:hover {
	color: #C30;
	text-decoration: none;
	background-color: #00ff00;
			}	
</style>


<body bgcolor="#FFFFFF" text="#000000">

<?php
ini_set ('display_errors', 1);
error_reporting (E_ALL & ~E_NOTICE);
// Connect and select.
if ($dbc = @mysql_connect (DB_HOST, DB_USER, DB_PASSWORD)) {
	if (!@mysql_select_db (DB_DATABASE)) {
		die ('<p>Could not select the database because: <b>' . mysql_error() . '</b></p>');
	}
} else {
	die ('<p>Could not connect to MySQL because: <b>' . mysql_error() . '</b></p>');
}


print "<h5 align=\"center\"><font color=\"darkkhaki\">SENARAI LOKASI BH ";
print "SUBMITTED BY ".strtoupper($_SESSION['first_name'])."</font><br/>";

echo '<font color="gray"><small>Kembali ke template <a href="index.php">INPUT</a>.</small></font></h5>';	
//*******************************8 

$skursus = "<center><table width=\"850\" height=\"100\" border=\"1\" cellspacing=\"0\" cellpadding=\"2\" bordercolor=\"#ffffff\" bgcolor=\"#ffffff\">
         <tr valign=\"top\">
            <td width=\"100\">
              <span style=\"font-size:14px;margin-left:10px;\">Bil.</span>
            </td>
		<td width=\"100\" bgcolor=\"#FDFECF\">
              <span style=\"font-size:14px;margin-left:10px;\">Trk Bore</span>
            </td>
		<td width=\"150\" bgcolor=\"#FDFECF\">
              <span style=\"font-size:14px;margin-left:10px;\">Latitude</span>
            </td>
		<td width=\"150\" bgcolor=\"#FDFECF\">
              <span style=\"font-size:14px;margin-left:10px;\">Longitude</span>
            </td>
		<td width=\"150\" bgcolor=\"#FDFECF\">
              <span style=\"font-size:14px;margin-left:10px;\">Ground lvl</span>
            </td>
		<td width=\"150\" bgcolor=\"#FDFECF\">
              <span style=\"font-size:14px;margin-left:10px;\"> Water lvl</span>
            </td>			
		<td width=\"200\" bgcolor=\"#FDFECF\">
              <span style=\"font-size:14px;margin-left:10px;\">Catatan</span>
            </td>
          </tr>";
//        </table></center>";


// Define the query by ..... 
// $query = "select * from eb_borehole where user_id = '{$_SESSION['user_id']}' ORDER BY trk_daftar DESC";
$query = "select * from eb_borehole ORDER BY trk_daftar DESC";


if ($r = mysql_query ($query)) { // Run the query.

$bil = 0;
//$skursus = "<center><table width=\"800\" height=\"70\" border=\"1\" cellspacing=\"0\" cellpadding=\"2\" bordercolor=\"#ffffff\">";

while ($row = mysql_fetch_array ($r)) {
$bil++;
/*if ( $_GET['usm'] == $row['KodKursus'] ) {$skursus .= "
		<tr valign=\"top\">
		<td align=\"center\" width=\"50\" bgcolor=\"#FDFECF\">
			<div align=\"center\"><small>( {$bil} )</small> </div>
		</td>
		<td width=\"200\" bgcolor=\"#E4F3CF\">
            	<div align=\"center\"> <font color=\"#000000\"><small> {$row[Tajuk]} </small> </font> </div>
            </td>
		<td width=\"75\" bgcolor=\"#E4F3CF\">
              <div align=\"center\"><small>{$row[TrkMula]}</small></div>
            </td>
		<td width=\"75\" bgcolor=\"#E4F3CF\">
              <div align=\"center\"><small>{$row[TrkTamat]}</small></div>
            </td>
		<td width=\"200\" bgcolor=\"#E4F3CF\">
              <div align=\"center\"><small>{$row[Venue]}</small></div>
            </td>
		<td width=\"60\" bgcolor=\"#E4F3CF\">
<div><small><a href=\"peserta_tdbr.php?usm={$row[KodKursus]}\"><small>{$row[KodKursus]}</a></small></div>
            </td>
          </tr>";} 
		else*/
					{$skursus .= "
		<tr valign=\"top\">
		<td align=\"center\" width=\"100\" bgcolor=\"#FDFECF\">
			<div align=\"center\"><a href=\"../../_bka/liveForms/MyLogofBoring_viewonly.php?edit={$row[idy]}\"  style=\"display: block; width: 100%; height: 100%; text-decoration: none;\"><small>{$bil}</small></a></div>
		</td>
		<td width=\"100\">
              <div align=\"center\"><a href=\"../../_bka/liveForms/MyLogofBoring_viewonly.php?edit={$row[idy]}\"  style=\"display: block; width: 100%; height: 100%; text-decoration: none;\"><small>{$row[trk_bore]}</small></a></div>
            </td>
		<td width=\"150\">
              <div align=\"center\"><a href=\"../../_bka/liveForms/MyLogofBoring_viewonly.php?edit={$row[idy]}\"  style=\"display: block; width: 100%; height: 100%; text-decoration: none;\"><small>{$row[lat]}</small></a></div>
            </td>
		<td width=\"150\">
              <div align=\"center\"><a href=\"../../_bka/liveForms/MyLogofBoring_viewonly.php?edit={$row[idy]}\"  style=\"display: block; width: 100%; height: 100%; text-decoration: none;\"><small>{$row[lng]}</small></a></div>
            </td>
		<td width=\"75\">
              <div align=\"center\"><a href=\"../../_bka/liveForms/MyLogofBoring_viewonly.php?edit={$row[idy]}\"  style=\"display: block; width: 100%; height: 100%; text-decoration: none;\"><small>{$row[ground_lvl]}</small></a></div>
            </td>			
		<td width=\"75\">
              <div align=\"center\"><a href=\"../../_bka/liveForms/MyLogofBoring_viewonly.php?edit={$row[idy]}\"  style=\"display: block; width: 100%; height: 100%; text-decoration: none;\"><small>{$row[water_lvl]}</small></a></div>
            </td>			
		<td width=\"200\">
        <div align=\"left\"><a href=\"../../_bka/liveForms/MyLogofBoring_viewonly.php?edit={$row[idy]}\"  style=\"display: block; width: 100%; height: 100%; text-decoration: none;\"><span style=\"font-size:8px;margin-left:10px;\">{$row[catatan]}</span></a></div>
            </td>			
          </tr>";} 

		
        
}
$skursus .= "</table></center>";
print  $skursus;
//*******************************8
} // End of query IF.

mysql_close(); // Close the database connection.
?>
<!--
</body>
</html>
-->
<center>
<div>
<?php 
// print "<pre>".print_r($_POST, true)."</pre>";
ob_flush();

?>
