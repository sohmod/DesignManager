<?php 
if (isset($_SESSION['order'])) unset ($_SESSION['order']);
//echo $_SESSION['order'].'----ss';

include_once ('../ip_SERVER.php');
include_once('inc/mysql_connect2cfg.php');
require_once ('mysql_connect.php'); // Connect to the database.
require ("inc/projek_daftar_cfg.php");


$page_title = 'Laporan bulanan ';
include_once ('html/header.htm');

$userON=superusers($_SESSION['first_name'],$_SESSION['username'],$_SESSION['kp_s']);
if ($userON=='true')
{
echo ' | <a href="projek_daftar.php?event=Pinda"><small>daftar projek</a>';
}
?>
 <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1">
 <style type="text/css">
 a:link { text-decoration:none ; font-size:12px; font-weight:normal }
 a:visited { text-decoration:none ; font-size:12px; font-weight:normal }
 a:hover { text-decoration:underline ; font-size:12px; font-weight:normal }
 body { font-family:Verdana,Arial,Helvetica,sans-serif;font-size:12px; } 
 //background: white url(../bground/bStone6.jpg);// no-repeat top right; 
 .style8 {color:#CCCFFF;font-size:12px; font-weight:light } > 
 </style>



<?php

// Welcome the user (by name if they are logged in).
if (isset($_SESSION['first_name'])) {
echo "&nbsp;&nbsp;<i> log: {$_SESSION['first_name']} </i>";

}

if (registerer_approved($_SESSION['kp_s'])=='false') {
	header ("Location:  http://" . $_SERVER['HTTP_HOST'] .dirname($_SERVER['PHP_SELF']) . "/index.php");
	ob_end_clean(); // Delete the buffer.
	exit(); // Quit the script.
	}

?>
</small></center></fieldset> 


<body text="#999">


<?php
////if ( isset($_POST['submit']) ) { // Handle the form.
?>

<form enctype="multipart/form-data" action="projek_senarai.php?order  " method="post">
<tr>
<center><table width="800" border="1" cellspacing="1" cellpadding="2" bordercolor="#E4F3CF" bgcolor="khaki">
<fieldset width="50%"><legend align="center"><small>Klik<font color="red"><a href="http://<?php echo $ipthis ?>/ckas/lukisan_senarai.php">Senarai Lukisan</a> </font> , atau
&nbsp;<font color="darkkhaki">Semak</font> data projek.
&nbsp;Ada link lain untuk kemaskini status dsb. Enjoy kerja?
</small></legend>
<tr><td><center>

<input type="submit" name="submit" value="SENARAI PROJEK" /> 
PEGAWAI BERTANGGUNG-JAWAB
<?php
$bilPereka=count($VOICbka)-1;	//42;
?>
<select name="order" id="order"> 
<?php
for ($VOIC=0; $VOIC <=$bilPereka; $VOIC++) 
{ echo "<option";
if ($VOICbka[$VOIC]==$OICEV){ echo " SELECTED";} 
echo "> $VOICbka[$VOIC] </option>\n";
} ?></select> 
<input name="kp_s" type="hidden" id="kp_s" value="<?php echo $oic_kp[$OIC];?>">
</center></td></tr>

</fieldset>	
</table>
</center></br>
</tr>
</form>


<form enctype="multipart/form-data" action="projek_senarai.php?kem  " method="post">
<center><table width="800" border="1" cellspacing="1" 
        cellpadding="2" bordercolor="#E4F3CF" bgcolor="#FDFECF">
         <tr valign="top" height="30" >
<input type="submit" name="list" value="Senarai Projek" />
            Kementerian Pelanggan
<input name="query" type="hidden" id="qa" value="select * from staf,kub where kp_s=">
<select name="kem" id="kem"> 
<?php 
for ($VKemKlient=0;$VKemKlient<=28;$VKemKlient++) 
{ echo "<option>$KemKlientFull[$VKemKlient]</option>\n";} ?> </select>
<input name="kp_s" type="hidden" id="kp_s" value="<?php echo $oic_kp[$OIC];?>">
</tr>
</table></center>
</form>




<?php 
//This is a working script
//Make sure to go through it and edit database table filelds that you are seraching
//This script assumes you are searching 3 fields
// DB_USER,DB_PASSWORD,DB_HOST,DB_NAME
$hostname_logon = DB_HOST ; 
$database_logon = DB_NAME ; 
$username_logon = DB_USER ; 
$password_logon = DB_PASSWORD ; 
//open database connection
$connections = mysql_connect($hostname_logon, $username_logon, $password_logon) or die ( "Unabale to connect to the database" );
//select database
mysql_select_db($database_logon) or die ( "Unable to select database!" );

//specify how many results to display per page
$limit = 10;

// Get the search variable from URL
$var = @$_GET['q'] ;
//trim whitespace from the stored variable
$trimmed = trim($var); 
//separate key-phrases into keywords
$trimmed_array = explode(" ",$trimmed); 
// check for an empty string and display a message.
if ($trimmed == "") {
$resultmsg = "" ;
}
// check for a search parameter
if (!isset($var)){
$resultmsg = "";}
// Build SQL Query for each keyword entered 
foreach ($trimmed_array as $trimm){

// EDIT HERE and specify your table and field names for the SQL query
$query = "SELECT * FROM daftar_projek WHERE tajuk LIKE \"%$trimm%\" ORDER BY tajuk DESC" ; 
// Execute the query to get number of rows that contain search kewords
$numresults=mysql_query ($query);
$row_num_links_main =mysql_num_rows ($numresults);
// next determine if 's' has been passed to script, if not use 0.
// 's' is a variable that gets set as we navigate the search result pages.
if (empty($s)) {
$s=1;
}
// now let's get results.
//$query .= " LIMIT $s,$limit" ;
$numresults = mysql_query ($query) or die ( "Couldn't execute query" );
$row= mysql_fetch_array ($numresults);

//store record id of every item that contains the keyword in the array we need to do this to avoid display of duplicate search result.
do{
//EDIT HERE and specify your field name that is primary key
$adid_array[] = $row[ 'daftar_id'];
}while( $row= mysql_fetch_array($numresults));
} //end foreach

if($row_num_links_main == 0 && $row_set_num == 0){
$resultmsg = "<p>Senarai carian untuk:" . $trimmed ."</p><p>Maaf, carian anda dikembalikan sifar</p>" ;
}
//delete duplicate record id's from the array. To do this we will use array_unique function
$tmparr = array_unique($adid_array); 
$i=0; 
foreach ($tmparr as $v) { 
$newarr[$i] = $v; 
$i++; 
} 
// now you can display the results returned. But first we will display the search form on the top of the page
?>

<form action="Laporan_bulanan.php" method="get" name="search">
<div align="center">
<a href="projek_daftar.php?event=Pinda"><img src="img/favicon.ico" border="0" margin-top="-50" alt="java duke!"></a>
<input name="q" type="text" value="<?php echo $q;?>"size="15"> 
<input name="search" type="submit" value="Carian">
</div>
</form>

<?php
echo "<p align=\"center\">Sila masukkan kata kunci carian dari 'TAJUK PROJEK'! </p>";
include_once ('html/footer.htm');
// display what the person searched for.
if( isset ($resultmsg)){
echo $resultmsg;
exit();
}else{
echo '<div align="left">Senarai carian untuk: ' . $var . ' -- Bil. carian: ' . $row_num_links_main;
}

foreach($newarr as $value){


// EDIT HERE and specify your table and field names for the SQL query
//$query_value = "SELECT * FROM daftar_projek WHERE daftar_id = '$value'";
$query_value = "select t1.daftar_id,t1.tajuk,t1.OIC,t1.mod_kerja,t1.username,
			t2.id_daftar,
			t2.pereka, 
			t2.penyemak 
			from 
			daftar_projek AS t1 INNER JOIN
			butiran_projek AS t2 WHERE t1.daftar_id = '$value' AND t2.id_daftar = '$value' ";

$num_value=mysql_query ($query_value);
$row_linkcat= mysql_fetch_array ($num_value);
$row_num_links= mysql_num_rows ($num_value);

$titlehigh = preg_replace ( "'($var)'si" , "<b>\\1</b>" , $row_linkcat[ 'tajuk' ] );
$linkhigh = preg_replace ( "'($var)'si" , "<b>\\1</b>" , $row_linkcat[ 'OIC' ] );
$linkdesc = preg_replace ( "'($var)'si" , "<b>\\1</b>" , $row_linkcat[ 'mod_kerja' ] );
$linkuser  = preg_replace ( "'($var)'si" , "<b>\\1</b>" , $row_linkcat[ 'username' ] );


if ($row_linkcat['pereka']  ==''){
$query_value1 = "SELECT * FROM daftar_projek WHERE daftar_id = '$value'";
$num_value1=mysql_query ($query_value1);
$row_linkcat= mysql_fetch_array ($num_value1);
$row_num_links= mysql_num_rows ($num_value1);
$titlehigh = preg_replace ( "'($var)'si" , "<b>\\1</b>" , $row_linkcat[ 'tajuk' ] );
$linkhigh = preg_replace ( "'($var)'si" , "<b>\\1</b>" , $row_linkcat[ 'OIC' ] );
$linkdesc = preg_replace ( "'($var)'si" , "<b>\\1</b>" , $row_linkcat[ 'mod_kerja' ] );
$linkuser  = preg_replace ( "'($var)'si" , "<b>\\1</b>" , $row_linkcat[ 'username' ] );

//$row_linkcat['pereka' ] ='belum asaing';
//$row_linkcat['penyemak' ]  ='belum asaing';
}

$pereka=$row_linkcat['pereka'];
$penyemak=$row_linkcat['penyemak'];
if ($row_linkcat['pereka']  ==''){$pereka='belum asaing';}
if ($row_linkcat['penyemak']  ==''){$penyemak='belum asaing';}

/*

if ($row_linkcat['penyemak']  !='' ){

//now let's make the keywods bold. To do that we will use preg_replace function. 
//EDIT parts of the lines below that have fields names like $row_linkcat[ 'field1' ]
//This script assumes you are searching only 3 fields. If you are searching more fileds make sure that add appropriate line. 
$titlehigh = preg_replace ( "'($var)'si" , "<b>\\1</b>" , $row_linkcat[ 'tajuk' ] );
$linkhigh = preg_replace ( "'($var)'si" , "<b>\\1</b>" , $row_linkcat[ 'OIC' ] );
$linkdesc = preg_replace ( "'($var)'si" , "<b>\\1</b>" , $row_linkcat[ 'mod_kerja' ] );
$linkuser  = preg_replace ( "'($var)'si" , "<b>\\1</b>" , $row_linkcat[ 'username' ] );
}
*/



foreach($trimmed_array as $trimm){
if($trimm != 'b' ){
//IF you added more fields to search make sure to add them below as well.
$titlehigh = preg_replace( "'($trimm)'si" , "<b>\\1</b>" , $titlehigh);
$linkhigh = preg_replace( "'($trimm)'si" , "<b>\\1</b>" , $linkhigh);
$linkdesc = preg_replace( "'($trimm)'si" , "<b>\\1</b>" , $linkdesc); 
$linkuser = preg_replace( "'($trimm)'si" , "<b>\\1</b>" , $linkuser); 

}
//end highlight
?>
<p>
<?php echo '( ' . $s++ . ' ) '; ?>

<?php echo '<a href="projek_daftar.php?ChooseProj='.$value.'">'.$value.'</a> - ' . $titlehigh . ' <br/> '; ?>
<?php echo $linkhigh.'<font color=pink><b>'.$linkuser.'</b></font> <br/> ';  ?>
<?php echo 'modus:<font color=cyan><b>'.$linkdesc.'</b></font> <br/> '; ?>
<?php echo  'pereka:<font color=green><b>'.$pereka.'</b></font> <br/> ';  ?>
<?php echo  'penyemak:<font color=red><b>'.$penyemak.'</b></font>  <br/> ';  ?>


</p>

<?php 
} //end foreach $trimmed_array 
/*
if($row_num_links_main > $limit){
// next we need to do the links to other search result pages
if ($s>=1) { // do not display previous link if 's' is '0'
$prevs=($s-$limit);
echo "<div align='left'><a href='$PHP_SELF?s=$prevs&q=$var&catid=$catid'>Previous " .$limit. "</a></div>";
}
// check to see if last page
$slimit =$s+$limit;
if (!($slimit >= $row_num_links_main) && $row_num_links_main!=1) {
// not last page so display next link
$n=$s+$limit;
echo "<div align='right'><a href='$PHP_SELF?s=$n&q=$var&catid=$catid'>Next " .$limit. "</a></div>";
}

}*/
} //end foreach $newarr
echo '</div>';

?>
