<?php 
$page_title = 'DPlan projek';
include_once ('html/header.htm');
// Welcome the user (by name if they are logged in).
if (isset($_SESSION['first_name'])) { 

echo "&nbsp;&nbsp;<i> log: {$_SESSION['first_name']} </i></small></center></fieldset>";
}
else
{ echo "</small></center></fieldset>"; }


require ("inc/projek_Dplan_cfg.php");
require_once ('mysql_connect.php'); // Connect to the database.
		$getU=$_SESSION['daftar_id'];
		$q = "select tajuk, OIC AS ppk, mod_kerja from daftar_projek where daftar_id = '$getU';";
		$r = mysql_query ($q) or die(mysql_error());
		while ($tna = mysql_fetch_array($r)) {
		$_SESSION['tajuk'] = $tna[0];
		$_SESSION['ppk'] = $tna[1];
		$_SESSION['mod_kerja'] = $tna[2];
		
		//$_SESSION['daftar_id'] = $getU;
			
				//ob_end_clean(); // Delete the buffer.
				
				//header ("Location:  http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/projek_Dplan.php?event=Pinda ");

				//exit();

			}		
$db=@mysql_connect($dbHost,$dbUserLogin,$dbPassword) or $error=(mysql_error()."<br>");
@mysql_select_db($dbName,$db) or $error.=(mysql_error());

if ($error) {
echo "<font color=red>> There was an error connecting to the mySQL database.</font><br><br>";
echo "Please check the database settings in the 'projek_status_cfg.php' file and try again.<br><br>";
echo "The error was reported as:<br>$error";exit;}
?>

<script type="text/javascript" src="jasoncalendar/calendarDateInput.js"></script>


 <!--title> Konsol Status Projek </title-->
 <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1">
 <style type="text/css">
 a:link { text-decoration:none ; font-size:12px; font-weight:normal }
 a:visited { text-decoration:none ; font-size:12px; font-weight:normal }
 a:hover { text-decoration:underline ; font-size:12px; font-weight:normal;background-color: #00ff00; }
 body { font-family:Verdana,Arial,Helvetica,sans-serif;font-size:12px; } 
 // background: white url(../bground/graywall.jpg);// no-repeat top right; 
 .style8 {color:#CCCFFF;font-size:12px; font-weight:light } > 
 </style>



<script language="JavaScript" type="text/JavaScript"> 
function confirmDelete() 
{ return (confirm('Adakah anda pasti untuk hapuskan data ini? Pelupusan ini kekal dan tiada pemulihan!'));} 
</script>
</head>

<body> 

<div> 
<table align="center" width="800">
<div align="center"><span>
Konsol <b>D-plan</b> jobNo: <?php echo '<b>'.$_SESSION['daftar_id'].'</b>' ;?>
</span></div>

<div align="center"><span>
<?php $count=mysql_query("SELECT COUNT(*) FROM dplan_projek WHERE id_daftar ='{$_SESSION['daftar_id']}'");$count=mysql_fetch_array($count);
$count =$count[0]; 
if ( $count==0 ){ echo '<a href="'.$fileName.'?event=add">Input</a>'; } ?>

<a href="<?php echo "$fileName?event=Pinda";?>"><img src="img/favicon.ico" border="0" margin-top="-50" alt="java duke!"> 
Semak & Pinda</a>
</span></div>
<div align="center"><span>
<a href="<?php echo "projek_daftar.php?event=Pinda";?>">Daftar</a> |
<!--a href="<?php echo "projek_Dplan.php";?>"-->D-Plan<!--/a--> |
<!--a href="<?php echo "projek_Perunding.php?event=Pinda";?>">Perunding</a> |-->
<a href="<?php echo "projek_butiran.php?event=Pinda";?>">Butiran</a> |

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
?>
</span></div>
</table>
</div>

<?php 
$pv=explode(".",phpversion());
$pv=$pv[0].".".$pv[1];
$pv=$pv-4.1;
if ($pv>=0) 
{ $Submit=$_REQUEST["Submit"];
$event=$_REQUEST["event"];
$month=$_REQUEST["month"];
$day=$_REQUEST["day"];
$year=$_REQUEST["year"];
$start=$_REQUEST["start"]; //jadual date
$end=$_REQUEST["end"];
$eventLength=$_REQUEST["eventLength"];
$id=$_REQUEST["id"]; //idx
$eid=$_REQUEST["eid"];
$del=$_REQUEST["del"];

$sketch_proposal =$_REQUEST["sketch_proposal"];
$Tender_doc =$_REQUEST["Tender_doc"];
$Design_report =$_REQUEST["Design_report"];
$analisa =$_REQUEST["analisa"]; 
$rekabentuk =$_REQUEST["rekabentuk"]; 
$lukisan =$_REQUEST["lukisan"]; 
$Bill_Q =$_REQUEST["Bill_Q"]; 

$catatan =$_REQUEST["catatan"];
$username =$_REQUEST["username"];
$id_daftar =$_REQUEST["id_daftar"]; 

$sketch_proposalEV =$_REQUEST["sketch_proposalEV"];
$Tender_docEV =$_REQUEST["Tender_docEV"];
$Design_reportEV =$_REQUEST["Design_reportEV"];
$analisaEV=$_REQUEST["analisaEV"]; 
$rekabentukEV =$_REQUEST["rekabentukEV"]; 
$lukisanEV =$_REQUEST["lukisanEV"]; 
$Bill_QEV =$_REQUEST["Bill_QEV"]; 

$catatanEV =$_REQUEST["catatanEV"];
$usernameEV =$_REQUEST["usernameEV"];
$id_daftarEV =$_REQUEST["id_daftarEV"]; 

$Vsketch_proposal =$_REQUEST["Vsketch_proposal"];
$VTender_doc =$_REQUEST["VTender_doc"];
$VDesign_report =$_REQUEST["VDesign_report"];
$Vanalisa =$_REQUEST["Vanalisa"]; 
$Vrekabentuk =$_REQUEST["Vrekabentuk"]; 
$Vlukisan =$_REQUEST["Vlukisan"]; 
$VBill_Q =$_REQUEST["VBill_Q"]; 

$Vcatatan =$_REQUEST["Vcatatan"];
$Vusername =$_REQUEST["Vusername"];
$Vid_daftar =$_REQUEST["Vid_daftar"]; 

$kp_s =$_REQUEST["kp_s"];
$kp_sEV =$_REQUEST["kp_sEV"];
$Vkp_s =$_REQUEST["Vkp_s"];

}


if ($Submit=="Tambah Data") { 
$menu=1;
if (!isset($_SESSION['first_name'])) 
{die ("<center>Data tidak lengkap atau anda tidak LOGIN. <br/>Sila cuba lagi.</center>");} 

$end= $eventLength;
$Vid_daftar = $id_daftarEV;
$startDate = $start;
$VTender_doc = $Tender_docEV;
$Vsketch_proposal =$sketch_proposalEV;
$VDesign_report = $Design_reportEV;
$Vanalisa=$analisaEV; 
$Vrekabentuk =$rekabentukEV; 
$Vlukisan =$lukisanEV; 
$VBill_Q =$Bill_QEV; 
$Vcatatan = $catatanEV;
$Vusername = $usernameEV;
$Vkp_s = $kp_sEV;

$id_daftar = $Vid_daftar;
$Tender_doc = $VTender_doc;
$sketch_proposal =$Vsketch_proposal;
$Design_report = $VDesign_report;
$analisa=$Vanalisa; 
$rekabentuk =$Vrekabentuk; 
$lukisan =$Vlukisan; 
$Bill_Q =$VBill_Q;
$catatan = htmlspecialchars(stripslashes($Vcatatan),ENT_QUOTES);

$username = $_SESSION['username'];
$kp_s = $_SESSION['kp_s'];
$id_daftar = $_SESSION['daftar_id'];

?> 
<!-------------------butiran struktur------------------------->
<?php // Make sure the username is available.
		$hasSESSION=$_SESSION['daftar_id'];
		$query = "SELECT startDate FROM dplan_projek WHERE id_daftar={$_SESSION['daftar_id']} AND startDate= '$startDate'";		
		$result = @mysql_query ($query);
		/* echo $result;
		echo mysql_num_rows($result).'<br/>' ;
		$kkk = mysql_num_rows($result);  
		for ($k = 0 ; $k < $kkk ; $k++){
		echo mysql_result( $result,$k ).'==>'.$startDate;
		echo '<br/>';
		} */
		
		if (mysql_num_rows($result) <> 0) { // Available.
				echo '<h5 align="center">Status untuk tarikh  '.$startDate.'  telah ada. Sila buat pindaan!</h5>';
				//include ('footer.htm'); // Include the HTML footer.
				exit();}
else
/////////////////////////////////////////////////////////////
{ ?>

<div align="center" class="style4">
<strong><span>Pasti D-PLAN Projek !</span>
</strong></div>

<form name="form2" method="post" action="<?php echo $fileName ?>">
<div align="center"> 

<table width="800" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor= "#FDFECF" bgcolor= "#EBEEF5">

<tr align="center"> <td colspan="2">
<small>TAJUK PROJEK:</small><br/><font color="darkgreen" size="4em" >
<?php echo $_SESSION['tajuk'].'</font><br/><font color="darkkhaki" size="1em">'.$_SESSION['mod_kerja'].'</font>';?> 
</td></tr>

<tr><td width="200" align="right"><small>Tarikh Mula Projek:</small></td> <td width="600" align="left"> 
<small><?php echo $startDate ?></small>
</td> </tr> 


<!-------------------------------to note ------------------------------------------->
<?php //
{$count=mysql_query("SELECT COUNT(*) FROM dplan_projek WHERE kp_s ='$kp_s'");$count=mysql_fetch_array($count);
$count =$count[0];
$Bilangan=$count+1;}
?> 

<tr> <td align="right"><small>SKETCH PROPOSAL:</small></td><td align="left"> 
<small><?php echo $sketch_proposal ?></small>
</td> </tr> 
<tr> <td align="right"><small>ANALISIS:</small></td> <td align="left">
<small><?php echo $analisa ?></small>
</td> </tr>
<tr> <td align="right"><small>REKABENTUK:</small></td> <td align="left">
<small><?php echo $rekabentuk ?></small>
</td> </tr>
<tr> <td align="right"><small>LUKISAN:</small></td> <td align="left">
<small><?php echo $lukisan ?></small>
</td> </tr>
<tr> <td align="right"><small>Bill_Q:</small></td> <td align="left">
<small><?php echo $Bill_Q ?></small>
</td> </tr>

<tr> <td align="right"><small>Tender_doc:</small></td> <td align="left">
<small><?php echo $Tender_doc ?></small>
</td> </tr>
<tr> <td align="right"><small>Design_report </small></td> <td align="left">
<small><?php echo $Design_report ?></small>
</td> </tr>


<tr> <td align="right"><small>Catatan :</small></td> <td align="left">
<small><?php echo $catatan ?></small>
</td> </tr>

<tr align="center"> <td colspan="2"><input type="submit" name="Submit" value="Simpan Data"> 
<input type="button" name="Button" value="Pinda" onClick="history.back();">
<input type="button" name="Button" value="Batal Tambah" onClick="location='<?php echo $fileName ?>'"> 
<br/><font color="gray"><small>
Username:<?php 
//echo $_SESSION['username'] ;
?> &nbsp;&nbsp;<i>
Pendaftar id<small>[<?php 
//echo $_SESSION['kp_s']; 
?>]</i></small></font>
<input name="id_daftar" type="hidden" id="id_daftar" value="<?php echo $id_daftar ?>"> 
<input name="start" type="hidden" id="start" value="<?php echo $start ?>">
<input name="Tender_doc" type="hidden" id="Tender_doc" value="<?php echo $Tender_doc ?>"> 
<input name="sketch_proposal" type="hidden" id="sketch_proposal" value="<?php echo $sketch_proposal ?>"> 
<input name="Design_report" type="hidden" id="Design_report" value="<?php echo $Design_report ?>">
<input name="analisa" type="hidden" id="analisa" value="<?php echo $analisa ?>">
<input name="rekabentuk" type="hidden" id="rekabentuk" value="<?php echo $rekabentuk ?>">
<input name="lukisan" type="hidden" id="lukisan" value="<?php echo $lukisan ?>">
<input name="Bill_Q" type="hidden" id="Bill_Q" value="<?php echo $Bill_Q ?>">
<input name="catatan" type="hidden" id="catatan" value="<?php echo $catatan ?>">
<input name="username" type="hidden" id="username" value="<?php echo $username ?>">
<input name="kp_s" type="hidden" id="kp_s" value="<?php echo $kp_s ?>">

</td> </tr> </table> </form>

<?php }} 
///////////////////////////////////////////////////////////////////////////////^x}
if ($Submit=="Simpan Data") { $menu=1;

$blokPengurus = trim($_SESSION['first_name']);

if (isset($_SESSION['first_name']))
if (isset($_SESSION['daftar_id']))
 
{$sql="INSERT INTO dplan_projek (id_daftar,startDate,sketch_proposal,analisa,
rekabentuk,lukisan,Bill_Q,Tender_doc,Design_report,catatan,username,kp_s,regist_date) VALUES 
('$id_daftar','$start','$sketch_proposal','$analisa',
'$rekabentuk','$lukisan','$Bill_Q','$Tender_doc','$Design_report','$catatan','$username','$kp_s',NOW())";

$result=mysql_query($sql); 
if (!$result) {
die('<center>Data tidak dikemaskini :  ' . mysql_error().'<br/><font color="gray"><small>Input error</small></font>');}
	else 
		{
		ob_end_clean(); // Delete the buffer.		
		header ("Location:  http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/projek_Dplan.php?event=Pinda");
		exit();

		echo "<center>Data telah diupload </center><br>";}}

else 
{echo "<center>Pilih satu projek untuk set dplan!</center>";}
else 
{echo "<center>PPK saja dibolehkan daftar projek baru.</center>";}}

if ($event=="add") 
if (!isset($_SESSION['first_name'])) {die ("<center>Anda tidak LOGIN !</center>");} 
else

{ $menu=1;
$hasSESSION=$_SESSION['daftar_id']; // {$_SESSION['daftar_id']}
$count=mysql_query("SELECT COUNT(*) FROM dplan_projek WHERE id_daftar ={$_SESSION['daftar_id']}");$count=mysql_fetch_array($count);
$count =$count[0];
//echo $count.'--'.$daftar_id.'--'.$id_daftar.'=='.$_SESSION['daftar_id']  ;
//$Bilangan=$count+1;
if ($count==1 || $count<>0) 
{die ("<center><font color=\"red\">Data telah diupload ke pengkalan. <br/>Sila buat pindaan.</font></center>");} 


?>
<form name="form1" method="post" action="<?php echo $fileName ?>">
<div align="center"> 
<table width="800" border="1" align="center" cellpadding="1" cellspacing="0" bordercolor="#FDFECF" bgcolor= "#EBEEF5" > 
 
<tr align="center"> <td colspan="2">
<small>TAJUK PROJEK:</small><br/><font color="darkgreen" size="4em" >
<?php echo $_SESSION['tajuk'].'</font><br/><font color="darkkhaki" size="1em">'.$_SESSION['mod_kerja'].'</font>';?> 
</td></tr>

<tr> <td width="200" align="right"><small>Tarikh Mula Projek:</small></td> 
<td width="600" align="left"> <small>
<!--------------------------------New date format----------------------------------------->

<script> DateInput( 'start', false, 'YYYY-MM-DD')</script>

<!--------------------------------New date format----------------------------------------->
</td> </tr>


<?php
if ($event=="add") 
{ $menu=1;

$count=mysql_query("SELECT COUNT(*) FROM dplan_projek WHERE kp_s ='$kp_s'");$count=mysql_fetch_array($count);
$count =$count[0];
$Bilangan=$count+1;}
?>
</small></td></tr> 



<tr><td align="right"><small>SKETCH PROPOSAL:</td><td align="left">
<select name="sketch_proposalEV" id="sketch_proposalEV">
<?php for ($Vsketch_proposal=1; $Vsketch_proposal<=6; $Vsketch_proposal++) 
{ echo "<option>$Vsketch_proposal</option>\n";} ?></select>
</small>minggu</td></tr>

<tr><td align="right"><small>ANALISIS: </td><td align="left">
<select name="analisaEV" id="analisaEV">
<?php for ($Vanalisa=1; $Vanalisa<=12; $Vanalisa++) 
{ echo "<option>$Vanalisa</option>\n";} ?></select>
</small>minggu</td></tr>

<tr><td align="right"><small>REKABENTUK:</td><td align="left">
<select name="rekabentukEV" id="rekabentukEV">
<?php for ($Vrekabentuk=1; $Vrekabentuk<=12; $Vrekabentuk++) 
{ echo "<option>$Vrekabentuk</option>\n";} ?></select>
</small>minggu</td></tr>

<tr><td align="right"><small>LUKISAN:</td><td align="left">
<select name="lukisanEV" id="lukisanEV">
<?php for ($Vlukisan=1; $Vlukisan<=12; $Vlukisan++) 
{ echo "<option>$Vlukisan</option>\n";} ?></select>
</small>minggu</td></tr>

<tr><td align="right"><small>BILL QUANTITY:</td><td align="left">
<select name="Bill_QEV" id="Bill_QEV">
<?php for ($VBill_Q=1; $VBill_Q<=6; $VBill_Q++) 
{ echo "<option>$VBill_Q</option>\n";} ?></select>
</small>minggu</td></tr>

<tr><td align="right"><small>Tender_doc:</td><td align="left">
<select name="Tender_docEV" id="Tender_docEV">
<?php for ($VTender_doc=1; $VTender_doc<=6; $VTender_doc++) 
{ echo "<option>$VTender_doc</option>\n";} ?></select>
</small>minggu</td></tr>

<tr><td align="right"> <small>Design_report:</td><td align="left">
<select name="Design_reportEV" id="Design_reportEV">
<?php for ($VSI=1; $VSI<=6; $VSI++) 
{ echo "<option>$VSI</option>\n";} ?></select>
</small>minggu</td></tr>


<tr> <td align="right"><small>Catatan:</td><td align="left">
<div><textarea name="catatanEV" cols="90" rows="4" id="catatanEV"></textarea></div>
</small></td></tr>
<!----------------->


<tr align="center"> <td colspan="2">
<input type="submit" name="Submit" value="Tambah Data"> 
<input type="button" name="Button" value="Batal Tambah" onClick="location=' <?php echo $fileName ?> '">
<br>


<small><i> 
<!--Username :<textarea name="usernameEV" cols="17" rows="1" id="usernameEV"><?php echo $_SESSION['username'] ?></textarea-->
Username :<?php 
//echo $_SESSION['username'];
?>&nbsp;&nbsp;
Pendaftar id :<font color="green">[<?php 
//echo $_SESSION['kp_s'] ; 
?>]</font>

</small>
</td> 
</tr> 
</table> </form> 
<center>
<?php } 
if ($event=="Pinda")
if (!isset($_SESSION['first_name']) || !isset($_SESSION['daftar_id']) ) {echo '<center>Sila pilih satu projek dari SENARAI dan anda mesti LOGIN</center>';}
else
{$menu=1;
$hasSESSION=$_SESSION['daftar_id']; //{$_SESSION['daftar_id']}
$result=mysql_query("SELECT * FROM dplan_projek WHERE id_daftar ={$_SESSION['daftar_id']} ORDER BY startDate DESC",$db);
//$myrow=mysql_fetch_array($result);
//$myrow=mysql_fetch_assoc($result) or die(mysql_error());
$myrow=mysql_fetch_assoc($result);
echo $kp_s;
if (!$myrow) {echo '<center>Belum isi dplan.<br/>Klik Input.</center>';} 
else

//if ($myrow)
{  ?> 

<table width="800" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#E4E4E4"> 

<?php $Bilangan = 1;
do { 
 
//$Vid_daftar =$myrow[id_daftar];
$VTender_doc = $myrow[Tender_doc];
$Vsketch_proposal = $myrow[sketch_proposal];
$VDesign_report = $myrow[Design_report];
$Vanalisa = $myrow[analisa];
$Vrekabentuk = $myrow[rekabentuk]; 
$Vlukisan =$myrow[lukisan]; 
$VBill_Q =$myrow[Bill_Q]; 
$Vcatatan = $myrow[catatan];
//$Vusername = $myrow[username];
//$Vkp_s =$myrow[kp_s];
$startDate = $myrow[startDate] ;

//$id_daftar = $Vid_daftar; //$id_daftar = $_SESSION['daftar_id'];
$Tender_doc =htmlspecialchars(stripslashes($VTender_doc),ENT_QUOTES);
$sketch_proposal =htmlspecialchars(stripslashes($Vsketch_proposal),ENT_QUOTES);
$Design_report = htmlspecialchars(stripslashes($VDesign_report),ENT_QUOTES);
$analisa=htmlspecialchars(stripslashes($Vanalisa),ENT_QUOTES); 
$rekabentuk =htmlspecialchars(stripslashes($Vrekabentuk),ENT_QUOTES); 
$lukisan =htmlspecialchars(stripslashes($Vlukisan),ENT_QUOTES); 
$Bill_Q =htmlspecialchars(stripslashes($VBill_Q),ENT_QUOTES);
$catatan = htmlspecialchars(stripslashes($Vcatatan ),ENT_QUOTES) ;

$kp_s = $_SESSION['kp_s'];
$username = $_SESSION['username'];
$id_daftar = $_SESSION['daftar_id'];

?>

<tr align="center"><td width="500" colspan="3" align="center" bgcolor="#FDFECF" bordercolor="#EBEEF5" >
<small>TAJUK PROJEK:</small><br/><font color="darkgreen" size="4em" >
<?php echo $_SESSION['tajuk'].'</font><br/><font color="darkkhaki" size="1em">'.$_SESSION['mod_kerja'].'</font>';?> 
<small><a href="<?php echo $fileName ?>?eid=<?php 
echo $myrow[id] ?>"><small><img src="img/favicon.ico" border="0" margin-top="-50" >  
</small></a></small>
</td></tr>

<tr> <td width="150" align="right"><small>Tarikh Mula Projek(r/b):</small></td> 
<td  colspan="2" align="left" class="style2"> 
<small><?php echo $startDate ?></small>
</td> </tr> 

<?php 
$dates=explode("-",$startDate);
//echo ' dates:::'. $dates[0] .'-'. $dates[1] .'-'. $dates[2] ;

$bar1 = ''; $pixel =$sketch_proposal; $pixel1 = 0; 
$T = $pixel ; $d = $dates[2] ; $m = $dates[1] ; $y = $dates[0] ; 
while ($T > 4 ): $m += 1; if ($m > 12):  $m -= 12; $y +=1 ;endif; $T -= 4 ; endwhile;
$m = $m; $T = $T*7 + $d; $d = $T;
while ($T > 30):$T -= 30; $d = $T; $m += 1; if ($m > 12):  $m -= 12; $y +=1 ; endif; endwhile;
for ($j=0;$j<=$pixel-1;$j++){$bar1 .=':';}   ?> 
<tr> <td align="right"><small>Sketch proposal:</small></td> <td align="left" colspan="2"> 
<small> <?php echo $sketch_proposal.'minggu</small>&nbsp;
<font color="red" >
<b>'.$bar1.'</b></font> &nbsp;<small>'.$d.'-'.$m.'-'.$y.'</small></td> </tr> '; ?>



<?php $bar2 = ''; $pixel =$analisa ; $pixel2 = $pixel1 + strlen($bar1) ;
$T = $pixel ; //$d = $day; $m = $month; $y = $year; 
while ($T > 4 ): $m += 1; if ($m > 12):  $m -= 12; $y +=1 ;endif; $T -= 4 ; endwhile;
$m = $m; $T = $T*7 + $d; $d = $T;
while ($T > 30):$T -= 30; $d = $T; $m += 1; if ($m > 12):  $m -= 12; $y +=1 ; endif; endwhile;
//echo '::::'.$d.'<--d--';echo $m.'<--m--';echo $y.'<--y--#';
for ($j=0;$j<=$pixel-1;$j++){$bar2 .=':';}   ?> 
<tr> <td align="right"><small>analisa :</small></td> <td align="left" colspan="2">
<small><?php echo $analisa .'minggu</small>&nbsp;'.$bar1.'<font color="red" >
<b>'.$bar2.'</b></font> &nbsp;<small>'.$d.'-'.$m.'-'.$y.'</small></td> </tr> '; ?>

<?php $bar3 = ''; $pixel =$rekabentuk ; $pixel1 = $pixel2 + strlen($bar2) ;
$T = $pixel ; //$d = $day; $m = $month; $y = $year; 
while ($T > 4 ): $m += 1; if ($m > 12):  $m -= 12; $y +=1 ;endif; $T -= 4 ; endwhile;
$m = $m; $T = $T*7 + $d; $d = $T;
while ($T > 30):$T -= 30; $d = $T; $m += 1; if ($m > 12):  $m -= 12; $y +=1 ; endif; endwhile;
for ($j=0;$j<=$pixel-1;$j++){$bar3 .=':';}   ?> 
<tr> <td align="right"><small>rekabentuk :</small></td> <td align="left" colspan="2">
<small><?php echo $rekabentuk .'minggu</small>&nbsp;'.$bar1.$bar2.'
<font color="red" >
<b>'.$bar3.'</b></font> &nbsp;<small>'.$d.'-'.$m.'-'.$y.'</small></td> </tr> '; ?>

<?php $bar4 = ''; $pixel =$lukisan ; $pixel2 = $pixel1 + strlen($bar3) ;
$T = $pixel  ; //$d = $day; $m = $month; $y = $year; 
while ($T > 4 ): $m += 1; if ($m > 12):  $m -= 12; $y +=1 ;endif; $T -= 4 ; endwhile;
$m = $m; $T = $T*7 + $d; $d = $T;
while ($T > 30):$T -= 30; $d = $T; $m += 1; if ($m > 12):  $m -= 12; $y +=1 ; endif; endwhile;
for ($j=0;$j<=$pixel-1;$j++){$bar4 .=':';}   ?> 
<tr> <td align="right"><small>lukisan:</small></td> <td align="left" colspan="2">
<small><?php echo $lukisan .'minggu</small>&nbsp;' .$bar1.$bar2.$bar3.'
<font color="red" >
<b>'.$bar4.'</b></font> &nbsp;<small>'.$d.'-'.$m.'-'.$y.'</small></td> </tr> '; ?>

<?php $bar5 = ''; $pixel =$Bill_Q ; $pixel1 = $pixel2 + strlen($bar4) ;
$T = $pixel ; //$d = $day; $m = $month; $y = $year; 
while ($T > 4 ): $m += 1; if ($m > 12):  $m -= 12; $y +=1 ;endif; $T -= 4 ; endwhile;
$m = $m; $T = $T*7 + $d; $d = $T;
while ($T > 30):$T -= 30; $d = $T; $m += 1; if ($m > 12):  $m -= 12; $y +=1 ; endif; endwhile;
for ($j=0;$j<=$pixel-1;$j++){$bar5 .=':';}   ?> 
<tr> <td align="right"><small>Bill_Q:</small></td> <td align="left" colspan="2">
<small> <?php echo $Bill_Q .'minggu</small>&nbsp;' .$bar1.$bar2.$bar3.$bar4.'
<font color="red" >
<b>'.$bar5.'</b></font> &nbsp;<small>'.$d.'-'.$m.'-'.$y.'</small></td> </tr> '; ?>

<?php $bar6 = ''; $pixel =$Tender_doc; $pixel2 = $pixel1 + strlen($bar5) ;
$T = $pixel ; //$d = $day; $m = $month; $y = $year; 
while ($T > 4 ): $m += 1; if ($m > 12):  $m -= 12; $y +=1 ;endif; $T -= 4 ; endwhile;
$m = $m; $T = $T*7 + $d; $d = $T;
while ($T > 30):$T -= 30; $d = $T; $m += 1; if ($m > 12):  $m -= 12; $y +=1 ; endif; endwhile;
for ($j=0;$j<=$pixel-1;$j++){$bar6 .=':';}   ?> 
<tr> <td align="right"><small>Tender_doc:</small></td> <td align="left" colspan="2">
<small> <?php echo $Tender_doc .'minggu</small>&nbsp;' .$bar1.$bar2.$bar3.$bar4.$bar5.'
<font color="red" >
<b>'.$bar6.'</b></font> &nbsp;<small>'.$d.'-'.$m.'-'.$y.'</small></td> </tr> '; ?>

<?php $bar7 = ''; $pixel =$Design_report ; $pixel1 = $pixel2 + strlen($bar6) ;
$T = $pixel ; //$d = $day; $m = $month; $y = $year; 
while ($T > 4 ): $m += 1; if ($m > 12):  $m -= 12; $y +=1 ;endif; $T -= 4 ; endwhile;
$m = $m; $T = $T*7 + $d; $d = $T;
while ($T > 30):$T -= 30; $d = $T; $m += 1; if ($m > 12):  $m -= 12; $y +=1 ; endif; endwhile;
for ($j=0;$j<=$pixel-1;$j++){$bar7 .=':';}   ?> 
<tr> <td align="right"><small>Design_report:</small></td> <td align="left" colspan="2">
<small><?php echo $Design_report .'minggu</small>&nbsp;' .$bar1.$bar2.$bar3.$bar4.$bar5.$bar6.'
<font color="red" >
<b>'.$bar7.'</b></font> &nbsp;<small>'.$d.'-'.$m.'-'.$y.'</small></td> </tr> ';
 ?>

<tr> <td align="right"><small>Tarik patut siap r/b :</small></td> <td align="left" colspan="2">
<small><?php echo '<font color="red" >'.$d.'-'.$m.'-'.$y.'</font>' ?></small>
</td></tr>
<tr> <td align="right"><small>Catatan :</small></td> <td align="left" colspan="2">
<small><?php echo $catatan ?></small>
</td></tr>





<!--
<tr> 
<td align="left" colspan="3">
<?php //echo 
'<div style="margin-top:5px" > 
<font color="darkkhaki" size="1em"  style="margin-left:15px"><b>Sketch Proposal&nbsp;:</b></font>
<font color="coral" size="2em"  style="margin-left:5px">'.$sketch_proposal.'&nbsp;minggu</font>
</div>'.
'<div style="margin-top:5px" >
<font color="darkkhaki" size="1em" style="margin-left:15px" ><b>Analisis&nbsp;:</b></font> 
<font color="coral" size="2em"  style="margin-left:5px">'.$analisa.'&nbsp;minggu</font>
</div>'.
'<div style="margin-top:5px" >
<font color="darkkhaki" size="1em"  style="margin-left:15px" ><b>Rekabentuk&nbsp;:</b></font>
<font color="coral" size="2em"  style="margin-left:5px">'.$rekabentuk.'&nbsp;minggu</font>

</div>'.
'<div style="margin-top:5px" > 
<font color="darkkhaki" size="1em"  style="margin-left:15px"><b>Lukisan&nbsp;:</b></font>
<font color="coral" size="2em"  style="margin-left:5px">'.$lukisan.'&nbsp;minggu</font>
</div>'.
'<div style="margin-top:5px" >
<font color="darkkhaki" size="1em"  style="margin-left:15px"><b>Bill of Quantity&nbsp;:</b></font>
<font color="coral" size="2em"  style="margin-left:5px">'.$Bill_Q.'&nbsp;minggu</font>
</div>'.
'<div style="margin-top:5px" >
<font color="darkkhaki" size="1em" style="margin-left:15px" ><b>Tender_doc&nbsp;:</b></font> 
<font color="coral" size="2em"  style="margin-left:5px">'.$Tender_doc.'&nbsp;minggu</font>
</div>'.
'<div style="margin-top:5px" >
<font color="darkkhaki" size="1em"  style="margin-left:15px"><b>Design_report&nbsp;:</b></font>
<font color="coral" size="2em"  style="margin-left:5px">'.$Design_report.'&nbsp;minggu</font>

</div>'.
'<div style="margin-top:5px" > 
<font color="darkkhaki" size="1em" style="margin-left:15px" ><b>Catatan&nbsp;:</b></font>
<font color="coral" size="2em"  style="margin-left:5px">'.$catatan.'</font>
</div>'.
'<div style="margin-top:15px" > <p align="right" style="margin-top:20px"> 
<font color="darkgreen" size="1em" style="margin-left:255px"><small>Trk. daftar&nbsp;:</font>
<font color="darkgreen" size="1em"  style="margin-left:5px">'.$myrow[regist_date].'</small>&nbsp;&nbsp;</font>
</p>
</div>' ?>
</td></tr> -->

<?php } 
while ($myrow=mysql_fetch_array($result));?>
</table> <br> 
<?php } } 
if ($eid) 
{ $menu=1;$result=mysql_query("SELECT * FROM dplan_projek WHERE id='$eid'",$db);
$myrow=mysql_fetch_array($result);
$dates=explode("-",$myrow[startDate]);?> 
<?php //$dates0=explode("-",$myrow[siapDate]);?> 

<form name="form1" method="post" action="<?php echo $fileName ?>">
<div align="center"> 
<table width="800" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#FDFECF" bgcolor="#EBEEF5"> 


<tr align="center"> <td colspan="2">
<small>TAJUK PROJEK:</small><br/><font color="darkgreen" size="4em" >
<?php echo $_SESSION['tajuk'].'</font><br/><font color="darkkhaki" size="1em">'.$_SESSION['mod_kerja'].'</font>';?> 
</td></tr>


<tr> <td width="150" align="right"><small>Tarikh Mula Projek:</small></td> 
<td width="500" align="left"><p> 
<!----------------------------------------------------DateInput------------------------------------------------------------->
<script> DateInput( 'start', false, 'YYYY-MM-DD'<?php if ($myrow[startDate]=='0000-00-00'){echo '';}else
echo ",'".$myrow[startDate]."'" ;?>)
</script>
<!----------------------------------------------------DateInput------------------------------------------------------------->
</td></tr>


<tr><td align="right"><small>SKETCH PROPOSAL:</td><td align="left">
<select name="sketch_proposalEV" id="sketch_proposalEV"> 
<?php $Vsketch_proposal= $myrow[sketch_proposal]; $sketch_proposalEV=$Vsketch_proposal; 
for ($Vs=1; $Vs<=6; $Vs++) { echo "<option";
if ($Vs==$sketch_proposalEV){ echo " SELECTED";} 
echo ">$Vs</option>\n";} ?></select>
</small>minggu</td></tr>


<tr><td align="right"> <small>ANALISIS: </td><td align="left">
<select name="analisaEV" id="analisaEV"> 
<?php $Vanalisa= $myrow[analisa]; $analisaEV=$Vanalisa;
for ($Va=1; $Va<=12; $Va++) { echo "<option";
if ($Va==$analisaEV){ echo " SELECTED";} 
echo ">$Va</option>\n";} ?></select>
</small>minggu</td></tr>

<tr><td align="right"><small>REKABENTUK:</td><td align="left">
<select name="rekabentukEV" id="rekabentukEV"> 
<?php $Vrekabentuk= $myrow[rekabentuk]; $rekabentukEV=$Vrekabentuk;
for ($Vr=1; $Vr<=12; $Vr++) { echo "<option";
if ($Vr==$rekabentukEV){ echo " SELECTED";} 
echo ">$Vr</option>\n";} ?></select>
</small>minggu</td></tr>

<tr><td align="right"><small>LUKISAN:</td><td align="left">
<select name="lukisanEV" id="lukisanEV"> 
<?php $Vlukisan= $myrow[lukisan]; $lukisanEV=$Vlukisan; 
for ($Vl=1; $Vl<=12; $Vl++) { echo "<option";
if ($Vl==$lukisanEV){ echo " SELECTED";} 
echo ">$Vl</option>\n";} ?></select>
</small>minggu</td></tr>

<tr><td align="right"><small>BILL QUANTITY:</td><td align="left">
<select name="Bill_QEV" id="Bill_QEV"> 
<?php $VBill_Q= $myrow[Bill_Q]; $Bill_QEV=$VBill_Q;
for ($VB=1; $VB<=6; $VB++) { echo "<option";
if ($VB==$Bill_QEV){ echo " SELECTED";} 
echo ">$VB</option>\n";} ?></select>
</small>minggu</td></tr>

<tr><td align="right"><small>Tender_doc:</td><td align="left">
<select name="Tender_docEV" id="Tender_docEV"> 
<?php $VTender_doc= $myrow[Tender_doc]; $Tender_docEV=$VTender_doc; 
for ($Vp=1; $Vp<=6; $Vp++) { echo "<option";
if ($Vp==$Tender_docEV){ echo " SELECTED";} 
echo ">$Vp</option>\n";} ?></select>
</small>minggu</td></tr>

<tr> <td align="right"><small>Design_report:</td><td align="left">
<select name="Design_reportEV" id="Design_reportEV"> 
<?php $VDesign_report=$myrow[Design_report]; $Design_reportEV=$VDesign_report;
for ($VSI=1; $VSI<=6; $VSI++) { echo "<option";
if ($VSI==$Design_reportEV){ echo " SELECTED";} 
echo ">$VSI</option>\n";} ?></select>
</small>minggu</td></tr>


<tr> <td align="right"><small>Catatan:</td><td>
<div><textarea name="catatanEV" cols="75" rows="3" id="catatanEV"><?php echo $myrow[catatan]; ?></textarea></div>
</small></td></tr>
<!----------------->
<tr align="center">
<td colspan="2"><input type="submit" name="Submit" value="Pinda Data"> 
<input type="button" name="Button" value="Batal Pindaan" onClick="location='<?php echo $fileName.'?event=Pinda'; ?>'">
<br/><font color="gray"><small>
Username:<?php 
//echo $_SESSION['username']; 
?> &nbsp;&nbsp;<i>
Pendaftar id<small>[<?php 
//echo $_SESSION['kp_s']; 
?>]</i></small></font>

<input name="id" type="hidden" id="id" value="<?php echo $myrow[id] ?>"></td></tr> 
<input name="id_daftar" type="hidden" id="id_daftar" value="<?php echo $myrow[id_daftar] ?>"> 
<!----------------->

</table> </form> 




<center>[
<a href="<?php echo "$fileName?del=$myrow[id]";?>" onCLick="return confirmDelete() ;">Padam Data</a>]
<br> <br> </center> 
<?php } 
if ($del) { $menu=1;$delsql="DELETE from dplan_projek WHERE id='$del';";$delresult=mysql_query($delsql);
echo "<center>The dplan has been deleted.</center><br>";
if (isset($_SESSION['tmula'])){ 
    unset (
		$_SESSION['tmula'] ,
		$_SESSION['sketch'] ,
		$_SESSION['anal'] ,
		$_SESSION['reka'] ,
		$_SESSION['lukis'] ,
		$_SESSION['bill'] ,
		$_SESSION['tender'] ,
		$_SESSION['report'] ) ;}
} 

if ($Submit=="Pinda Data"){ $menu=1;

//$startDate=$month."/".$day."/".$year;$start=strtotime($startDate);
//if ($dateFormat==1) { $startDate=date("m-d-Y",$start);}  //$Bilangan=$end;} 
//if ($dateFormat==2) { $startDate=date("d-m-Y",$start);}  //$Bilangan=$end;} 
$startDate=$start;

//$id_daftar = $Vid_daftar; //$id_daftar = $_SESSION['daftar_id'];
$Tender_doc =htmlspecialchars(stripslashes($Tender_docEV),ENT_QUOTES);
$sketch_proposal =htmlspecialchars(stripslashes($sketch_proposalEV),ENT_QUOTES);
$Design_report = htmlspecialchars(stripslashes($Design_reportEV),ENT_QUOTES);
$analisa=htmlspecialchars(stripslashes($analisaEV),ENT_QUOTES); 
$rekabentuk =htmlspecialchars(stripslashes($rekabentukEV),ENT_QUOTES); 
$lukisan =htmlspecialchars(stripslashes($lukisanEV),ENT_QUOTES); 
$Bill_Q =htmlspecialchars(stripslashes($Bill_QEV),ENT_QUOTES);
$catatan = htmlspecialchars(stripslashes($catatanEV ),ENT_QUOTES) ;

?> 

<form name="form2" method="post" action="<?php echo $fileName ?>">
<div align="center"> 
<table width="800" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#FDFECF" bgcolor="#EBEEF5">
<div align="center" class="style4">
<strong><span>Pasti Pinda Data:</span>
<br></strong></div><br/>

<tr align="center"> <td colspan="2">
<small>TAJUK PROJEK:</small><br/><font color="darkgreen" size="4em" >
<?php echo $_SESSION['tajuk'].'</font><br/><font color="darkkhaki" size="1em">'.$_SESSION['mod_kerja'].'</font>';?> 

</td></tr>

<tr> <td width="150" align="right"><small>Tarikh Mula Projek:</small></td> 
<td width="450" align="left" class="style2"> 
<small><?php echo $startDate ?></small>
</td> </tr> 

<?php 
$dates=explode("-",$startDate);
//echo ' dates:::'. $dates[0] .'-'. $dates[1] .'-'. $dates[2] ;

$bar1 = ''; $pixel =$sketch_proposal; $pixel1 = 0; 
$T = $pixel ; $d = $dates[2] ; $m = $dates[1] ; $y = $dates[0] ; 
while ($T > 4 ): $m += 1; if ($m > 12):  $m -= 12; $y +=1 ;endif; $T -= 4 ; endwhile;
$m = $m; $T = $T*7 + $d; $d = $T;
while ($T > 30):$T -= 30; $d = $T; $m += 1; if ($m > 12):  $m -= 12; $y +=1 ; endif; endwhile;
for ($j=0;$j<=$pixel-1;$j++){$bar1 .=':';}   ?> 
<tr> <td align="right"><small>Sketch proposal:</small></td> <td align="left"> 
<small> <?php echo $sketch_proposal.'</small>&nbsp;
<font color="red" >
<b>'.$bar1.'</b></font> &nbsp;<small>'.$d.'-'.$m.'-'.$y.'</small></td> </tr> '; ?>



<?php $bar2 = ''; $pixel =$analisa ; $pixel2 = $pixel1 + strlen($bar1) ;
$T = $pixel ; //$d = $day; $m = $month; $y = $year; 
while ($T > 4 ): $m += 1; if ($m > 12):  $m -= 12; $y +=1 ;endif; $T -= 4 ; endwhile;
$m = $m; $T = $T*7 + $d; $d = $T;
while ($T > 30):$T -= 30; $d = $T; $m += 1; if ($m > 12):  $m -= 12; $y +=1 ; endif; endwhile;
//echo '::::'.$d.'<--d--';echo $m.'<--m--';echo $y.'<--y--#';
for ($j=0;$j<=$pixel-1;$j++){$bar2 .=':';}   ?> 
<tr> <td align="right"><small>analisa :</small></td> <td align="left">
<small><?php echo $analisa .'</small>&nbsp;'.$bar1.'<font color="red" >
<b>'.$bar2.'</b></font> &nbsp;<small>'.$d.'-'.$m.'-'.$y.'</small></td> </tr> '; ?>

<?php $bar3 = ''; $pixel =$rekabentuk ; $pixel1 = $pixel2 + strlen($bar2) ;
$T = $pixel ; //$d = $day; $m = $month; $y = $year; 
while ($T > 4 ): $m += 1; if ($m > 12):  $m -= 12; $y +=1 ;endif; $T -= 4 ; endwhile;
$m = $m; $T = $T*7 + $d; $d = $T;
while ($T > 30):$T -= 30; $d = $T; $m += 1; if ($m > 12):  $m -= 12; $y +=1 ; endif; endwhile;
for ($j=0;$j<=$pixel-1;$j++){$bar3 .=':';}   ?> 
<tr> <td align="right"><small>rekabentuk :</small></td> <td align="left">
<small><?php echo $rekabentuk .'</small>&nbsp;'.$bar1.$bar2.'
<font color="red" >
<b>'.$bar3.'</b></font> &nbsp;<small>'.$d.'-'.$m.'-'.$y.'</small></td> </tr> '; ?>

<?php $bar4 = ''; $pixel =$lukisan ; $pixel2 = $pixel1 + strlen($bar3) ;
$T = $pixel  ; //$d = $day; $m = $month; $y = $year; 
while ($T > 4 ): $m += 1; if ($m > 12):  $m -= 12; $y +=1 ;endif; $T -= 4 ; endwhile;
$m = $m; $T = $T*7 + $d; $d = $T;
while ($T > 30):$T -= 30; $d = $T; $m += 1; if ($m > 12):  $m -= 12; $y +=1 ; endif; endwhile;
for ($j=0;$j<=$pixel-1;$j++){$bar4 .=':';}   ?> 
<tr> <td align="right"><small>lukisan:</small></td> <td align="left">
<small><?php echo $lukisan .'</small>&nbsp;' .$bar1.$bar2.$bar3.'
<font color="red" >
<b>'.$bar4.'</b></font> &nbsp;<small>'.$d.'-'.$m.'-'.$y.'</small></td> </tr> '; ?>

<?php $bar5 = ''; $pixel =$Bill_Q ; $pixel1 = $pixel2 + strlen($bar4) ;
$T = $pixel ; //$d = $day; $m = $month; $y = $year; 
while ($T > 4 ): $m += 1; if ($m > 12):  $m -= 12; $y +=1 ;endif; $T -= 4 ; endwhile;
$m = $m; $T = $T*7 + $d; $d = $T;
while ($T > 30):$T -= 30; $d = $T; $m += 1; if ($m > 12):  $m -= 12; $y +=1 ; endif; endwhile;
for ($j=0;$j<=$pixel-1;$j++){$bar5 .=':';}   ?> 
<tr> <td align="right"><small>Bill_Q:</small></td> <td align="left">
<small> <?php echo $Bill_Q .'</small>&nbsp;' .$bar1.$bar2.$bar3.$bar4.'
<font color="red" >
<b>'.$bar5.'</b></font> &nbsp;<small>'.$d.'-'.$m.'-'.$y.'</small></td> </tr> '; ?>

<?php $bar6 = ''; $pixel =$Tender_doc; $pixel2 = $pixel1 + strlen($bar5) ;
$T = $pixel ; //$d = $day; $m = $month; $y = $year; 
while ($T > 4 ): $m += 1; if ($m > 12):  $m -= 12; $y +=1 ;endif; $T -= 4 ; endwhile;
$m = $m; $T = $T*7 + $d; $d = $T;
while ($T > 30):$T -= 30; $d = $T; $m += 1; if ($m > 12):  $m -= 12; $y +=1 ; endif; endwhile;
for ($j=0;$j<=$pixel-1;$j++){$bar6 .=':';}   ?> 
<tr> <td align="right"><small>Tender_doc:</small></td> <td align="left">
<small> <?php echo $Tender_doc .'</small>&nbsp;' .$bar1.$bar2.$bar3.$bar4.$bar5.'
<font color="red" >
<b>'.$bar6.'</b></font> &nbsp;<small>'.$d.'-'.$m.'-'.$y.'</small></td> </tr> '; ?>

<?php $bar7 = ''; $pixel =$Design_report ; $pixel1 = $pixel2 + strlen($bar6) ;
$T = $pixel ; //$d = $day; $m = $month; $y = $year; 
while ($T > 4 ): $m += 1; if ($m > 12):  $m -= 12; $y +=1 ;endif; $T -= 4 ; endwhile;
$m = $m; $T = $T*7 + $d; $d = $T;
while ($T > 30):$T -= 30; $d = $T; $m += 1; if ($m > 12):  $m -= 12; $y +=1 ; endif; endwhile;
for ($j=0;$j<=$pixel-1;$j++){$bar7 .=':';}   ?> 
<tr> <td align="right"><small>Design_report:</small></td> <td align="left">
<small><?php echo $Design_report .'</small>&nbsp;' .$bar1.$bar2.$bar3.$bar4.$bar5.$bar6.'
<font color="red" >
<b>'.$bar7.'</b></font> &nbsp;<small>'.$d.'-'.$m.'-'.$y.'</small></td> </tr> ';
 ?>


<tr> <td align="right"><small>Catatan :</small></td> <td align="left">
<small><?php echo $catatan ?></small>
</td></tr>

<tr align="center"> <td colspan="2">
<input type="submit" name="Submit" value="Simpan Pindaan"> 
<input type="button" name="Button" value="Pinda" onClick="history.back();"> 
<input type="button" name="Button" value="Batal Pindaan" onClick="location='<?php echo $fileName.'?event=Pinda'; ?>'"> 
<br/><font color="gray"> <i><small>Username:<?php 
//echo $_SESSION['username'];
?>
&nbsp;Pendaftar id<small>[<?php 
//echo $_SESSION['kp_s'] 
?>]</small></small></i></font> 

<input name="end" type="hidden" id="end" value="<?php echo $end ?>"> 
<input name="id" type="hidden" id="id" value="<?php echo $id ?>"> 

<input name="id_daftar" type="hidden" id="id_daftar" value="<?php echo $_SESSION['daftar_id'] ?>"> 
<input name="start" type="hidden" id="start" value="<?php echo $start ?>">
<input name="Tender_doc" type="hidden" id="Tender_doc" value="<?php echo $Tender_doc ?>"> 
<input name="sketch_proposal" type="hidden" id="sketch_proposal" value="<?php echo $sketch_proposal ?>"> 
<input name="Design_report" type="hidden" id="Design_report" value="<?php echo $Design_report ?>">
<input name="analisa" type="hidden" id="analisa" value="<?php echo $analisa ?>">
<input name="rekabentuk" type="hidden" id="rekabentuk" value="<?php echo $rekabentuk ?>">
<input name="lukisan" type="hidden" id="lukisan" value="<?php echo $lukisan ?>">
<input name="Bill_Q" type="hidden" id="Bill_Q" value="<?php echo $Bill_Q ?>">
<input name="catatan" type="hidden" id="catatan" value="<?php echo $catatan ?>">
<input name="username" type="hidden" id="username" value="<?php echo $_SESSION['username'] ?>">
<input name="kp_s" type="hidden" id="kp_s" value="<?php echo $_SESSION['kp_s'] ?>">

</td> </tr> 
</table> </form>

<?php } 
if ($Submit=="Simpan Pindaan") 
{ $menu=1;
$Bilangan=$end;
$startDate=$start;
//-----------------------------------------


$sql="UPDATE dplan_projek SET 
id_daftar='$id_daftar',startDate='$startDate',sketch_proposal='$sketch_proposal',analisa='$analisa',
rekabentuk='$rekabentuk',lukisan='$lukisan',Bill_Q='$Bill_Q',Tender_doc='$Tender_doc',Design_report='$Design_report',
catatan='$catatan',username='$username',kp_s='$kp_s' WHERE id='$id';";

$result=mysql_query($sql);
echo "<center>Telah dikemaskini. Masuk sesi baru jika klik 'semak'.</center><br>";
	ob_end_clean(); // Delete the buffer.		
	header ("Location:  http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/projek_Dplan.php?event=Pinda");
	exit();}

if ($menu!=1) 
{ $count=mysql_query("SELECT COUNT(*) FROM dplan_projek WHERE id_daftar = '{$_SESSION['daftar_id']}'");$count=mysql_fetch_array($count);
$count=$count[0];echo "<div align=\"center\">--JUMLAH DATA:<b>$count</b>--PROJEK NO:<b>{$_SESSION['daftar_id']}</b>--</div><br>";} 
?>


<?php // Include the HTML footer file.
include_once ('html/footer.htm');
?>

