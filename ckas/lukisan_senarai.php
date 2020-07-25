<?php
// Include the configuration file for error management and such.
//require_once ('html/includes/config.inc');
require_once ('mysql_connect.php'); // Connect to the database.
include_once('inc/mysql_connect2cfg.php');
require ("inc/projek_daftar_cfg.php");


// Set the page title and include the HTML header.
$page_title = 'senarai lukisan';
include ('html/header.htm');
echo "</small></center></fieldset>";

?>

</head>

<body>


<table align="center" width="800">
<div align="center"><span><small>
<a href="<?php echo "projek_daftar.php?event=Pinda";?>">Daftar</a> |
<a href="<?php echo "projek_Dplan.php?event=Pinda";?>">D-Plan</a> |
<!--a href="<?php echo "projek_Perunding.php?event=Pinda";?>">Perunding</a> |-->
<!--a href="<?php echo "projek_butiran.php?event=Pinda";?>"-->Butiran<!--/a--> |

<!--a href="<?php echo "projek_sivil.php?event=Pinda";?>">Kerja sivil</a> |
<a href="<?php echo "projek_status.php?event=Pinda";?>">Status</a> | -->
<a href="<?php echo "http://".$ipthis."/_bka/editinPlacejQuery/kemajuanRB.php";?>"><font color="green" size="2em" style="text-decoration:none">KemajuanRB</font></a> | 

<!--a href="<?php echo "projek_senarai.php?order={$_SESSION['ppk']}";?>">Senarai</a> |-->
<a href="<?php echo "http://".$ipthis."/_bka/editinPlacejQuery/ulasanTeknikal_general.php" ;?>">U.Teknikal</a> |
<a href="<?php echo "http://".$ipthis."/_bka/editinPlace050/penilaian_kriteria_earthwork.php" ;?>">P.Tender</a> |
<a href="<?php echo "http://".$ipthis."/_bka/editinPlace050/NeedsStatement.php" ;?>">N.S.</a> |
<a href="<?php echo "http://".$ipthis."/_bka/liveForms/MyBulkDrawings11.php" ;?>">D.Lukisan</a>
<?php
if (isset($_SESSION['first_name'])){
echo ' | <a href="Laporan_bulanan.php">Carian</a>' ;}
?></small>
</span></div>
</table>

<form id="liveForm" action="lukisan_senarai.php" method="post" 	>
<select name="gplukis" id="gplukis"> 
<?php 

   $db=@mysql_connect($ajaxHost,$ajaxULogin,$ajaxPass) or die('Error connecting to the server');
mysql_select_db($ajaxDbase) or die('Error selecting database');
    $result=mysql_query("SELECT DISTINCT pelukis FROM mydrawings") or die ('Error performing query');
$num_rows = mysql_num_rows($result);	
$pelukis = array("PELUKIS");$chklukis = array("PELUKIS");

      while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
		if (trim($row['pelukis'])<>''){
			array_push($pelukis, trim($row['pelukis']));
			array_push($chklukis, trim($row['pelukis']));}
							}
for ($j=0;$j<=$num_rows;$j++) 
{ echo '<option value="'.$pelukis[$j].'">'.$pelukis[$j].'</option>';
}?>
</select>	
<input name="submit" id="submit" type="submit" value="Senarai" class="action" />
</form>
	
	
<?php
if (isset($_POST['submit'])) { // Check if the form has been submitted.
$pelukis=$_POST['gplukis'];


echo '<small>Pelukis -:&nbsp;'. $pelukis.'</small>';?>

<?php

print "<left><table width=\"800\" border=\"1\" cellspacing=\"1\" 
        cellpadding=\"2\" bordercolor=\"#E4F3CF\" bgcolor=\"#FDFECF\">
         <tr valign=\"top\" >
            <td width=\"30\">
              <font color=\"#000000\" size=\"1\">Bil.</font> 
            </td>
            <td width=\"50\">
              <font color=\"#000000\" size=\"1\"><li>Job no.</li></font> 
            </td>			
		<td width=\"300\">
              <font color=\"#000000\" size=\"1\">Tajuk Lukisan.</font>
            </td>
		<td width=\"250\">
            <font color=\"#000000\" size=\"1\">Nombor Lukisan.</font>
            </td>
		<td width=\"50\">
              <font color=\"#000000\" size=\"1\">Kategori.</font>
            </td>			
		<td width=\"100\">
              <font color=\"#000000\" size=\"1\">Tarikh Lukisan.</font>
            </td>
	    </tr>
        </table></left>";


		
$dbajax=mysql_connect($ajaxHost,$ajaxULogin,$ajaxPass) or die('Error connecting to the server');
mysql_select_db($ajaxDbase) or die('Error selecting database');	
	
$BIL=1;
$myjob = array();

    $result=mysql_query("SELECT * FROM mydrawings WHERE pelukis='$pelukis' ORDER BY daftar_id DESC") or die ('Error performing query');
      while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$id  = $row['id'];
$tajuk  = $row['tajuk'];
$nombor  = $row['nombor'];
$kategori  = $row['kategori'];
$tarikh  = $row['tarikh'];
$daftar_id  = $row['daftar_id'];
if ($BIL==1){ $distinct_id=$daftar_id; }

		if ($row['daftar_id']!=$distinct_id || $BIL==1){
			array_push($myjob, $daftar_id);
			$distinct_id=$daftar_id;
			}


print "<left><table width=\"800\" border=\"1\" cellspacing=\"1\" cellpadding=\"0\" bordercolor=\"#E4F3CF\" bgcolor=\"#ffffff\" >
         <tr valign=\"top\" >
            <td width=\"35\" align=\"center\">
		<font color=\"#000000\" size=\"1\" margin-left=\"10\">".$BIL++."</font>
            </td>
            <td width=\"55\" align=\"center\"><font color=\"#000000\" size=\"1\">".$daftar_id."</font>
            </td>				
		<td width=\"305\">
              <font color=\"#000000\" size=\"1\">".$tajuk."</font>
            </td>
		<td width=\"255\">
            <font color=\"#000000\" size=\"1\">".$nombor."</font>
            </td>
		<td width=\"55\">
              <font color=\"#000000\" size=\"1\">".$kategori."</font>
            </td>		
            <td width=\"105\" align=\"center\">
		<font color=\"#000000\" size=\"1\" margin-left=\"10\">".$tarikh."</font>
            </td>
	    </tr>
        </table></left>";
}
$dbckaj=mysql_connect($dbHost,$dbUserLogin,$dbPassword) or die('Error connecting to the server');
mysql_select_db($dbName) or die('Error selecting database');	

for ($i=0;$i<count($myjob);$i++){
$tprojek = ' Tajuk projek tidak didaftar! ';
$result=mysql_query("SELECT tajuk FROM daftar_projek WHERE daftar_id='$myjob[$i]'") or die ('Error performing query');
      while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
	  	  if ($row['tajuk']!=$tprojek){$tprojek = $tprojek = $row['tajuk'];}
	  }
	  								
echo '<font color="#999999" size="1"><li>'.$myjob[$i].' : '.$tprojek.'</li></font>';}

}
?>

</body>
</html>

