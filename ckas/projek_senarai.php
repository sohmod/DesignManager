<?php 
//$order = $_GET['uj'];
$page_title = 'Senarai projek';

include_once('inc/mysql_connect2cfg.php');
require ("inc/projek_daftar_cfg.php");

include_once ('html/header.htm');
/*
unset (
		$_SESSION['tmula'] ,
		$_SESSION['sketch'] ,
		$_SESSION['anal'] ,
		$_SESSION['reka'] ,
		$_SESSION['lukis'] ,
		$_SESSION['bill'] ,
		$_SESSION['tender'] ,
		$_SESSION['report'] ,
$_SESSION['siapaload'] ,
$_SESSION['nomgertak'] 
) ;*/
?>

 <style type="text/css">
 a:link { text-decoration:none ; font-size:12px; font-weight:normal }
 a:visited { text-decoration:none ; font-size:12px; font-weight:normal }
 a:hover { text-decoration:underline ; font-size:12px; font-weight:normal }
 body { font-family:Verdana,Arial,Helvetica,sans-serif;font-size:12px; } 
 //background: white url(../bground/rockpile.jpg);// no-repeat top right; 
 .style8 {color:#CCCFFF;font-size:12px; font-weight:light } > 
 </style>
</head>

<body>

<?php
//$chkOr = 0 ; $chkWh = 0 ;
?>
<?php
//if (isset($_GET['order'])) { // Handle the form.
if ( isset($_GET['order']) || isset($_GET['kem']) ) { // Handle the form.
$kem = $_REQUEST['kem'];
$kemno = $kem_QUERYno[$kem];

//echo $kemno.'kem'; 
$order = $_REQUEST['order'];
$kes = $oic_QUERYno[$order];

//echo $kes.'---kes';

$chkOr = substr_count("{$order}","ORDER");
$chkWh = substr_count("{$order}","WHERE");
if ($chkOr || $chkWh) {  //  $order_temp = "{$order}"
switch ( $kes ){
	case 1: $order_temp ='ORDER BY daftar_id ASC'; break;
	case 2: $order_temp ='ORDER BY startDate DESC'; break;
	case 3: $order_temp ='ORDER BY mod_kerja ASC'; break;
	case 4: $order_temp ='ORDER BY registration_date DESC'; break;
	case 5: $order_temp ='ORDER BY tajuk ASC'; break;
	case 6: $order_temp ='ORDER BY lokasi ASC'; break;

	case 7: $order_temp ='WHERE t1.mod_kerja  = \'Perunding\' ORDER BY registration_date DESC'; break;
	case 8: $order_temp ='WHERE t1.mod_kerja  = \'Perunding DB\' ORDER BY registration_date DESC'; break;
	case 9: $order_temp ='WHERE t1.mod_kerja  = \'Inhouse\' ORDER BY registration_date DESC'; break;

	case 10: $order_temp ='WHERE t1.OIC = \'KPPK(BA)\' ORDER BY tajuk ASC'; break;
	case 11: $order_temp ='WHERE t1.OIC = \'KPPK(BA)\' ORDER BY tajuk ASC'; break;
	case 12: $order_temp ='WHERE t1.OIC = \'KPPK(PT)\' ORDER BY tajuk ASC'; break;
	case 13: $order_temp ='WHERE t1.OIC = \'KPPK(Ksih)\' ORDER BY tajuk ASC'; break;
	case 14: $order_temp ='WHERE t1.OIC = \'KPPK(Ksel)\' ORDER BY tajuk ASC'; break;

	case 15: $order_temp ='WHERE mod_kerja  = \'Perunding\' AND t1.OIC = \'KPPK(BA)\' ORDER BY tajuk ASC'; break;
	case 16: $order_temp ='WHERE t1.mod_kerja  = \'Perunding\' AND t1.OIC = \'KPPK(BA)\' ORDER BY tajuk ASC'; break;
	case 17: $order_temp ='WHERE t1.mod_kerja  = \'Perunding\' AND t1.OIC = \'KPPK(PT)\' ORDER BY tajuk ASC'; break;
	case 18: $order_temp ='WHERE t1.mod_kerja  = \'Perunding\' AND t1.OIC = \'KPPK(Ksih)\' ORDER BY tajuk ASC'; break;
	case 19: $order_temp ='WHERE t1.mod_kerja  = \'Perunding\' AND t1.OIC = \'KPPK(Ksel)\' ORDER BY tajuk ASC'; break;

	case 20: $order_temp ='WHERE t1.mod_kerja  = \'Perunding DB\' AND t1.OIC = \'KPPK(BA)\' ORDER BY tajuk ASC'; break;
	case 21: $order_temp ='WHERE t1.mod_kerja  = \'Perunding DB\' AND t1.OIC = \'KPPK(BA)\' ORDER BY tajuk ASC'; break;
	case 22: $order_temp ='WHERE t1.mod_kerja  = \'Perunding DB\' AND t1.OIC = \'KPPK(PT)\' ORDER BY tajuk ASC'; break;
	case 23: $order_temp ='WHERE t1.mod_kerja  = \'Perunding DB\' AND t1.OIC = \'KPPK(Ksih)\' ORDER BY tajuk ASC'; break;
	case 24: $order_temp ='WHERE t1.mod_kerja  = \'Perunding DB\' AND t1.OIC = \'KPPK(Ksel)\' ORDER BY tajuk ASC'; break;

	case 25: $order_temp ='WHERE t1.mod_kerja  = \'Inhouse\' AND t1.OIC = \'KPPK(BA)\' ORDER BY tajuk ASC'; break;
	case 26: $order_temp ='WHERE t1.mod_kerja  = \'Inhouse\' AND t1.OIC = \'KPPK(BA)\' ORDER BY tajuk ASC'; break;
	case 27: $order_temp ='WHERE t1.mod_kerja  = \'Inhouse\' AND t1.OIC = \'KPPK(PT)\' ORDER BY tajuk ASC'; break;
	case 28: $order_temp ='WHERE t1.mod_kerja  = \'Inhouse\' AND t1.OIC = \'KPPK(Ksih)\' ORDER BY tajuk ASC'; break;
	case 29: $order_temp ='WHERE t1.mod_kerja  = \'Inhouse\' AND 
t1.OIC = \'KPPK(Ksel)\' 
ORDER BY t1.tajuk ASC'; break;

	case 30: $order_temp ='WHERE t1.mod_kerja <> \'Inhouse\' AND
					     t1.mod_kerja <> \'Perunding DB\' AND 
					     t1.mod_kerja <> \'Perunding\''; break; 



				}


 } else 
{
	if ( $order == "PENGARAH") { $order_temp == "" ;} elseif 
	( $order <> "PENGARAH" && ($order == "KPPK(BA)" || $order == "KPPK(PT)" || $order == "KPPK(Ksih)" ||
	$order == "KPPK(Ksel)" || $order == "KPPK(LB)" )){
	$order_temp = "where t1.OIC ='{$order}' ORDER BY username ASC";}  else
	{
	$order_temp = "where t1.daftar_id = t2.id_daftar AND (t2.pereka ='{$order}' OR t2.penyemak ='{$order}') ORDER BY registration_date DESC";
	} 
}

if ( $kem ) { 
$order_temp = "WHERE KemKlient = '{$kem}'";
if ( $kem=='KERAJAAN MALAYSIA' ) { 
$order_temp = "ORDER BY KemKlient DESC";
	}
 } 

echo '&nbsp;|&nbsp;<a href="Laporan_bulanan.php" ><font color="coral"><b>(Senarai Lain)</b></font></a>';

// Welcome the user (by name if they are logged in).
if (isset($_SESSION['first_name'])) {
echo "<center> Salam , {$_SESSION['first_name']} !";
$_SESSION['order'] = $order ;
}
if (!isset($_SESSION['first_name'])) {$_SESSION['order'] = $order ;}
//
//if ($_GET['order'] ==  '') {$order = 'PENGARAH';}

?>
</small></center></fieldset> 


<body bgcolor="#FFFFFF" text="#000000">

<?php


ini_set ('display_errors', 1);
error_reporting (E_ALL & ~E_NOTICE);
// Connect and select.
// $dbHost $dbUserLogin $dbPassword $dbName

if ($dbc = @mysql_connect ($dbHost,$dbUserLogin,$dbPassword)) {
	if (!@mysql_select_db ($dbName)) {
		die ('<p>Could not select the database because: <b>' . mysql_error() . '</b></p>');
	}
} else {
	die ('<p>Could not connect to MySQL because: <b>' . mysql_error() . '</b></p>');
}


print "<h4 align=\"center\"><font color=\"darkkhaki\">SENARAI PROJEK</font></h4>";
	
//*******************************8 

print "<center><table width=\"900\" border=\"1\" cellspacing=\"1\" 
        cellpadding=\"2\" bordercolor=\"#E4F3CF\" bgcolor=\"#FDFECF\">
         <tr valign=\"top\" height=\"30\" >
            <td width=\"73\">
              <font color=\"#999999\">Daftar Projek.<br/></font> 
		<a href=\"projek_daftar.php?event=Pinda\" ><img src=\"img/favicon.ico\" border=\"0\" ></a>
            </td>
		<td width=\"375\">
              <font color=\"#999999\">Tajuk Projek.</small></font>
            </td>
		<td width=\"95\">
            <font color=\"#999999\">Modus Kerja.</font>
            </td>
		<td width=\"115\">
              <font color=\"#999999\">OIC.<br/><small>Perekabentuk (upload)</small></font>
            </td>
		<td width=\"242\">
			<small><font color=\"#999999\">Lukisan/Laporan (download)<br/>::Nama Penyemak::</font></small>
            </td>
	    </tr>
        </table></center>";


// Define the query by ..... 
//$query = "select t2.mod_kerja, t3.pereka from daftar_projek AS t2, butiran_projek AS t3 ORDER BY {$order}";

if ( $order == "PENGARAH" )
{ $query = "select t1.daftar_id,
			t1.username,
			t1.tajuk,
			t1.mod_kerja,
			t1.lokasi,
			t1.OIC,
			t1.KemKlient,
			t1.nosiri_fail
			from 
			daftar_projek AS t1 GROUP BY t1.daftar_id ORDER BY username";
} elseif ( $order<>"PENGARAH" && 
 ($order == "KPPK(BA)" || $order == "KPPK(PT)" || $order == "KPPK(Ksih)" ||
  $order == "KPPK(Ksel)" || $order == "KPPK(LB)" )) {
  $query = "select t1.daftar_id,
			t1.username,
			t1.tajuk,
			t1.mod_kerja,
			t1.lokasi,
			t1.OIC,
			t1.KemKlient,
			t1.nosiri_fail
			from 
			daftar_projek AS t1 
			{$order_temp}"; 
			} elseif ($chkOr || $chkWh || $kem ){
  $query = "select t1.daftar_id,
			t1.username,
			t1.tajuk,
			t1.mod_kerja,
			t1.lokasi,
			t1.OIC,
			t1.KemKlient,
			t1.nosiri_fail
			from 
			daftar_projek AS t1 
			{$order_temp}"; }
			else {
  $query = "select t1.daftar_id,
			t1.username,
			t1.tajuk,
			t1.mod_kerja,
			t1.lokasi,
			t1.OIC,
			t1.KemKlient,
			t1.nosiri_fail,
			t2.pereka, 
			t2.penyemak 
			from 
			daftar_projek AS t1 INNER JOIN
			butiran_projek AS t2 ON t1.daftar_id=t2.id_daftar {$order_temp}"; 
 }

//echo '<center><small><font color="gray">'.$query.'</font></small></center>' ;


$result=mysql_query($query); 
if (!$result) {
die('<center>Data tidak dikemaskini :  ' . mysql_error().'<br>Fail nombor yang diketik telah ada , sila guna nombor lain.');
  }


if ($r = mysql_query ($query)) { // Run the query.

$bil = 0;
$entiti = "<center><table width=\"900\" height=\"30\" border=\"1\" cellspacing=\"0\" cellpadding=\"2\" bordercolor=\"#CCCCCC\">";

while ($row = mysql_fetch_array ($r)) {
$bil++;
////////////////////////
$entiti .= "<tr valign=\"top\" height=\"25\" >
		<td align=\"center\" width=\"75\" bgcolor=\"#E4F3CF\">
		<small><a href=\"html/laporan_status.php?uj={$row[daftar_id]}\" target=\"New Tab\" 
		<small>{$bil}</small></a></small></td>" ;


$countname = count($row['pereka']);
$nama_pereka = $row['pereka'];
//echo $countname.':';


///////////////////////////
if ( $_SESSION['daftar_id'] == $row['daftar_id'] ) {$entiti .= 
		"<td width=\"375\" bgcolor=\"#E4F3CF\" align=\"left\" >
            {$row['tajuk']}
            </td>
		<td width=\"100\" bgcolor=\"#E4F3CF\">
              <small>{$row['mod_kerja']}<br/></small>
            </td>
		<td width=\"115\" bgcolor=\"#E4F3CF\">
              <small> {$row['OIC']}<br/></small>
<a href=\"html/add_file.php?uj={$row[daftar_id]}\" target=\"bawanaik\" ><small>{ $nama_pereka }</small></a>

            </td>

		<td width=\"242\" bgcolor=\"#E4F3CF\">";

if (isset($_SESSION['first_name'])) {
$entiti .= "<small><a href=\"html/view_files_todownload.php?uj={$row[daftar_id]}{$_SESSION['kp_s']}\" target=\"lukisan\" > <small>
{$oic_FAIL[$row[OIC]]}{$KOD_KEM[$row[KemKlient]]}/{$KOD_NEG[$row[lokasi]]}{$row[nosiri_fail]}
</small> </a></small><small>";
if (intval($row[no_bpks])){
	if ($row[program]=='BKA'){
$entiti .= '<br/>'.$programNEWFAIL[$row[program]].$row[skop_kerja].'/'.$kem_QUERYnumber[$row[KemKlient]].'/'.$KOD_NEG[$row[lokasi]].' '.substr($row[startDate],2,2).'/'.$row[no_bpks].'/';
					}else{
$entiti .= '<br/>'.$programNEWFAIL[$row[program]].$kem_QUERYnumber[$row[KemKlient]].'/'.$KOD_NEG[$row[lokasi]].' '.substr($row[startDate],2,2).'/'.$row[no_bpks].'/';}}

$entiti .= "</small><br/><small>::{$row['penyemak']}::</small>
            </td></tr> "; }
else {
$entiti .= "
<small>{$oic_FAIL[$row[OIC]]}{$KOD_KEM[$row[KemKlient]]}/{$KOD_NEG[$row[lokasi]]}{$row[nosiri_fail]}</small><br/>
<small>::</small>
<a href=\"html/viewonly_files_todownload.php?uj={$row[daftar_id]}\" target=\"lukisan\" ><small>{$row['daftar_id']}</small></a><small>::<br/>{$row['penyemak']}</small></small>
            </td></tr> "; }}
			
			 else
					{$entiti .= 
		"<td width=\"375\" align=\"left\" >
            {$row['tajuk']}
            </td>
		<td width=\"100\">
              <small> {$row['mod_kerja']}<br/></small>
            </td>
		<td width=\"115\">
              <small>{$row['OIC']}<br/></small>
<a href=\"html/add_file.php?uj={$row[daftar_id]}\" target=\"bawanaik\" ><small>{$row['pereka']}</small></a>

            </td>
		<td width=\"242\" align=\"left\" >";

if (isset($_SESSION['first_name'])) {
$entiti .= "<small><a href=\"html/view_files_todownload.php?uj={$row[daftar_id]}{$_SESSION['kp_s']}\" target=\"lukisan\"><small>
{$oic_FAIL[$row[OIC]]}{$KOD_KEM[$row[KemKlient]]}/{$KOD_NEG[$row[lokasi]]}{$row[nosiri_fail]}</small>
</a></small><small>";
if (intval($row[no_bpks])){
	if ($row[program]=='BKA'){
$entiti .= '<br/>'.$programNEWFAIL[$row[program]].$row[skop_kerja].'/'.$kem_QUERYnumber[$row[KemKlient]].'/'.$KOD_NEG[$row[lokasi]].' '.substr($row[startDate],2,2).'/'.$row[no_bpks].'/';
					}else{
$entiti .= '<br/>'.$programNEWFAIL[$row[program]].$kem_QUERYnumber[$row[KemKlient]].'/'.$KOD_NEG[$row[lokasi]].' '.substr($row[startDate],2,2).'/'.$row[no_bpks].'/';}}

$entiti .= "</small><br/><small>::{$row['penyemak']}::</small>
            </td></tr> "; }
else {
$entiti .= "
<small>{$oic_FAIL[$row[OIC]]}{$KOD_KEM[$row[KemKlient]]}/{$KOD_NEG[$row[lokasi]]}{$row[nosiri_fail]}</small><br/>
<small>::</small>
<a href=\"html/viewonly_files_todownload.php?uj={$row[daftar_id]}\" target=\"lukisan\" ><small>{$row['daftar_id']}</small> </a><small>::<br/>{$row['penyemak']}</small>
            </td></tr> "; }
}     
}
/////////////////////////////////////
$entiti .= "</table></center>";
print  $entiti;
//echo '<center>&nbsp;&nbsp;<i>order ----> '.$order.'</i></center>';
echo '<br/>';
//*******************************8
} // End of query IF.
} // 

mysql_close(); // Close the database connection.


include_once ('html/footer.htm');
?>

