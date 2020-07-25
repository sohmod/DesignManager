<?php 
$page_title = 'projek_Perunding_projek';
include_once ('html/header.htm');
// Welcome the user (by name if they are logged in).
if (isset($_SESSION['first_name'])) { 

echo "&nbsp;&nbsp;<i> log: {$_SESSION['first_name']} </i></small></center></fieldset>";
}
else
{ echo "</small></center></fieldset>"; }

require ("inc/projek_Perunding_cfg.php");
require_once ('mysql_connect.php'); // Connect to the database.
		$q = "select tajuk, OIC AS ppk, mod_kerja from daftar_projek 
			where daftar_id = {$_GET['uj']}";
		$r = mysql_query ($q);
		while ($tna = mysql_fetch_array ($r)) {
		$_SESSION['tajuk'] = $tna[0];
		$_SESSION['ppk'] = $tna[1];
		$_SESSION['mod_kerja'] = $tna[2];
		$_SESSION['daftar_id'] = $_GET['uj'];

			
				ob_end_clean(); // Delete the buffer.
				
				header ("Location:  http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/projek_Perunding.php?event=Pinda ");

				exit();
			}
	
$db=@mysql_connect($dbHost,$dbUserLogin,$dbPassword) or $error=(mysql_error()."<br>");
@mysql_select_db($dbName,$db) or $error.=(mysql_error());

if ($error) {
echo "<font color=red>> There was an error connecting to the mySQL database.</font><br><br>";
echo "Please check the database settings in the 'projek_status_cfg.php' file and try again.<br><br>";
echo "The error was reported as:<br>$error";exit;}
?>
<script type="text/javascript" src="jasoncalendar/calendarDateInput.js">
</script>

 <!--title> Konsol Status Projek </title-->
 <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1">
 <style type="text/css">
 a:link { text-decoration:none ; font-size:12px; font-weight:normal }
 a:visited { text-decoration:none ; font-size:12px; font-weight:normal }
 a:hover { text-decoration:underline ; font-size:12px; font-weight:normal;background-color: #00ff00; }
 body { font-family:Verdana,Arial,Helvetica,sans-serif;font-size:12px; } 
 // background: white url(../bground/gypsum.jpg);// no-repeat top right;
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
<table align="center" width="400">
Konsol <b>Perunding</b> Projek <?php echo '<b>'.$_SESSION['daftar_id'].'</b>' ;?> Bhg. Kej. Awam, CKAJ.
</table>

<fieldset width="400"> <small> <center>
<?php $count=mysql_query("SELECT COUNT(*) FROM Perunding_projek WHERE id_daftar ='{$_SESSION['daftar_id']}'");$count=mysql_fetch_array($count);
$count =$count[0]; 
if ( $count==0 ){ echo '<a href="'.$fileName.'?event=add">Input</a>'; } ?>



<a href="<?php echo "$fileName?event=Pinda";?>"><img src="img/favicon.ico" border="0" margin-top="-50" alt="java duke!"> 
Semak & Pinda</a>
</center> </small> </fieldset>
<fieldset> <small> <center>
<a href="<?php echo "projek_daftar.php?event=Pinda";?>">Daftar</a> |
<a href="<?php echo "projek_Dplan.php?event=Pinda";?>">D-Plan</a> |
<!--a href="<?php echo "projek_Perunding.php.php";?>"-->Perunding<!--/a--> |
<a href="<?php echo "projek_butiran.php?event=Pinda";?>">Butiran</a> |

<!--a href="<?php echo "projek_sivil.php?event=Pinda";?>">Kerja sivil</a> |
<a href="<?php echo "projek_status.php?event=Pinda";?>">Status</a> | -->
<a href="<?php echo "http://".$ipthis."/_bka/editinPlacejQuery/kemajuanRB.php";?>"><font color="green" size="2em" style="text-decoration:none">KemajuanRB</font></a> | 

<!--a href="<?php echo "projek_senarai.php?order={$_SESSION['ppk']}";?>">Senarai</a> |-->
<a href="<?php echo "http://".$ipthis."/_bka/editinplace-0.5.0/ulasan_sivil_general.php" ;?>">U.Teknikal</a> |
<a href="<?php echo "http://".$ipthis."/_bka/editinplace-0.5.0/penilaian_kriteria_earthwork.php" ;?>">P.Tender</a> |
<a href="<?php echo "http://".$ipthis."/_bka/editinplace-0.5.0/NeedsStatement.php" ;?>">N.S.</a> |
<a href="<?php echo "http://".$ipthis."/_bka/liveforms/MyBulkDrawings11.php" ;?>">D.Lukisan</a>
</center> </small> </fieldset>
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

$terima =$_REQUEST["terima"];
$selectedP =$_REQUEST["selectedP"];
$selecP =$_REQUEST["selecP"];
$ulasan =$_REQUEST["ulasan"];
$jawab =$_REQUEST["jawab"]; 
$nameP1 =$_REQUEST["nameP1"]; 
$nameP2 =$_REQUEST["nameP2"]; 
$nameP3 =$_REQUEST["nameP3"]; 

$catatan =$_REQUEST["catatan"];
$username =$_REQUEST["username"];
$id_daftar =$_REQUEST["id_daftar"]; 

$terimaEV =$_REQUEST["terimaEV"];
$selectedPEV =$_REQUEST["selectedPEV"];
$selecPEV =$_REQUEST["selecPEV"];
$ulasanEV =$_REQUEST["ulasanEV"];
$jawabEV=$_REQUEST["jawabEV"]; 
$nameP1EV =$_REQUEST["nameP1EV"]; 
$nameP2EV =$_REQUEST["nameP2EV"]; 
$nameP3EV =$_REQUEST["nameP3EV"]; 

$catatanEV =$_REQUEST["catatanEV"];
$usernameEV =$_REQUEST["usernameEV"];
$id_daftarEV =$_REQUEST["id_daftarEV"]; 

$Vterima =$_REQUEST["Vterima"];
$VselectedP =$_REQUEST["VselectedP"];
$VselecP =$_REQUEST["VselecP"];
$Vulasan =$_REQUEST["Vulasan"];
$Vjawab =$_REQUEST["Vjawab"]; 
$VnameP1 =$_REQUEST["VnameP1"]; 
$VnameP2 =$_REQUEST["VnameP2"]; 
$VnameP3 =$_REQUEST["VnameP3"]; 

$Vcatatan =$_REQUEST["Vcatatan"];
$Vusername =$_REQUEST["Vusername"];
$Vid_daftar =$_REQUEST["Vid_daftar"]; 

$kp_s =$_REQUEST["kp_s"];
$kp_sEV =$_REQUEST["kp_sEV"];
$Vkp_s =$_REQUEST["Vkp_s"];

}



//////////////////////////////////////////////////VVVV
if ($pv<0) 
{ $Submit=$HTTP_POST_VARS["Submit"];
$event=$HTTP_GET_VARS["event"];
$month=$HTTP_POST_VARS["month"];
$day=$HTTP_POST_VARS["day"];
$year=$HTTP_POST_VARS["year"];
$start=$HTTP_POST_VARS["start"];
$end=$HTTP_POST_VARS["end"];
$description=$HTTP_POST_VARS["description"];
$eventLength=$HTTP_POST_VARS["eventLength"];
$id=$HTTP_POST_VARS["id"];
$eid=$HTTP_GET_VARS["eid"];
$del=$HTTP_GET_VARS["del"];
}
/////////////////////////////////////////////////////////AAAAAAAAAAA


if ($Submit=="Syor Perunding") { 
$menu=1;
if (!isset($_SESSION['first_name'])) 
{die ("<center>Data tidak lengkap atau anda tidak LOGIN. <br/>Sila cuba lagi.</center>");} 

$end= $eventLength;
$Vid_daftar = $id_daftarEV;
$startDate = $start;
$VselectedP = $selectedPEV;
$Vterima =$terimaEV;
$VselecP = $selecPEV;
$Vulasan = $ulasanEV;
$Vjawab=$jawabEV; 
$VnameP1 =$nameP1EV; 
$VnameP2 =$nameP2EV; 
$VnameP3 =$nameP3EV; 
$Vcatatan = $catatanEV;
$Vusername = $usernameEV;
$Vkp_s = $kp_sEV;

//if ($dateFormat==1) { $startDate=date("m-d-Y",$start);$Bilangan=$end;}
//if ($dateFormat==2) { $startDate=date("d-m-Y",$start);$Bilangan=$end;} 
//if ($dateFormat==2) { $startDate=date("Y-m-d",$start);$Bilangan=$end;} 
$id_daftar = $Vid_daftar;
$selectedP = $VselectedP;
//$terima =$Vterima;
//$selecP = $VselecP;
//$ulasan = $Vulasan;
//$jawab=$Vjawab; 
$nameP1 =$VnameP1; 
$nameP2 =$VnameP2; 
$nameP3 =$VnameP3;
$catatan = htmlspecialchars(stripslashes($Vcatatan),ENT_QUOTES);

$username = $_SESSION['username'];
$kp_s = $_SESSION['kp_s'];
$id_daftar = $_SESSION['daftar_id'];

?> 
<!-------------------butiran struktur------------------------->
<?php // Make sure the username is available.
		$query = "SELECT startDate FROM Perunding_projek WHERE id_daftar= {$_SESSION['daftar_id']} AND startDate= '$startDate'";		
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
<strong><span>Pasti Perunding Projek ini !</span>
</strong></div>

<form name="form2" method="post" action="<?php echo $fileName ?>">
<div align="center"> 

<table width="800" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor= "#FDFECF" bgcolor= "#EBEEF5">

<tr align="center"> <td colspan="2" width="800" >
<small>TAJUK PROJEK:</small><br/><font color="darkgreen" size="4em" >
<?php echo $_SESSION['tajuk'].'</font><br/><font color="darkkhaki" size="1em">'.$_SESSION['mod_kerja'].'</font>';?> 
</td></tr>

<tr><td width="200" align="right"><small>Trk surat HOPT :</small></td> <td width="600" align="left"> 
<small><?php echo $start ?></small>
</td> </tr> 


<!-------------------------------to note ------------------------------------------->
<?php //
{$count=mysql_query("SELECT COUNT(*) FROM Perunding_projek WHERE kp_s ='$kp_s'");$count=mysql_fetch_array($count);
$count =$count[0];
$Bilangan=$count+1;}
?> 

<tr> <td align="right"><small>Trk terima :</small></td><td align="left"> 
<small><?php echo $terima ?></small>
</td> </tr> 
<tr> <td align="right"><small>Trk jawab (+ TOR/NS):</small></td> <td align="left">
<small><?php echo $jawab ?></small>
</td> </tr>
<tr> <td align="right"><small>nameP1:</small></td> <td align="left">
<small><?php echo $nameP1 ?></small>
</td> </tr>
<tr> <td align="right"><small>nameP2:</small></td> <td align="left">
<small><?php echo $nameP2 ?></small>
</td> </tr>
<tr> <td align="right"><small>nameP3:</small></td> <td align="left">
<small><?php echo $nameP3 ?></small>
</td> </tr>

<tr> <td align="right"><small>selectedPerunding:</small></td> <td align="left">
<small><?php echo $selectedP ?></small>
</td> </tr>
<tr> <td align="right"><small>Trk selecP :</small></td> <td align="left">
<small><?php echo $selecP ?></small>
</td> </tr>
<tr> <td align="right"><small>Trk ulasan :</small></td> <td align="left">
<small><?php echo $ulasan ?></small>
</td> </tr>


<tr> <td align="right"><small>Catatan :</small></td> <td align="left">
<small><?php echo $catatan ?></small>
</td> </tr>

<tr align="center"> <td colspan="2"><input type="submit" name="Submit" value="Simpan Data"> 
<input type="button" name="Button" value="Pinda" onClick="history.back();">
<input type="button" name="Button" value="Batal Tambah" onClick="location='<?php echo $fileName ?>'"> 
<br/><font color="gray"><small>
Username:<?php echo $_SESSION['username'] ?> &nbsp;&nbsp;<i>
Pendaftar id<small>[<?php echo $_SESSION['kp_s']; ?>]</i></small></font>
<input name="id_daftar" type="hidden" id="id_daftar" value="<?php echo $id_daftar ?>"> 
<input name="start" type="hidden" id="start" value="<?php echo $start ?>">
<input name="selectedP" type="hidden" id="selectedP" value="<?php echo $selectedP ?>"> 
<input name="terima" type="hidden" id="terima" value="<?php echo $terima ?>"> 
<input name="selecP" type="hidden" id="selecP" value="<?php echo $selecP ?>">
<input name="ulasan" type="hidden" id="ulasan" value="<?php echo $ulasan ?>">
<input name="jawab" type="hidden" id="jawab" value="<?php echo $jawab ?>">
<input name="nameP1" type="hidden" id="nameP1" value="<?php echo $nameP1 ?>">
<input name="nameP2" type="hidden" id="nameP2" value="<?php echo $nameP2 ?>">
<input name="nameP3" type="hidden" id="nameP3" value="<?php echo $nameP3 ?>">
<input name="catatan" type="hidden" id="catatan" value="<?php echo $catatan ?>">
<input name="username" type="hidden" id="username" value="<?php echo $username ?>">
<input name="kp_s" type="hidden" id="kp_s" value="<?php echo $kp_s ?>">

</td> </tr> </table> </form>

<?php }} 
///////////////////////////////////////////////////////////////////////////////^x}
if ($Submit=="Simpan Data") { $menu=1;
//$Bilangan=$end;
//$Bilangan=$eventlength;
$startDate = date("Y-m-d",$start);
$siapDate = date("Y-m-d",$start0);
$blokPengurus = trim($_SESSION['first_name']);

if ($_SESSION['mod_kerja'] == 'Perunding'	||	$_SESSION['mod_kerja'] == 'Perunding DB')
if (isset($_SESSION['first_name']))
if (isset($_SESSION['daftar_id']))

{$sql="INSERT INTO Perunding_projek (id_daftar,startDate,terimaDate,jawabDate,
nameP1,nameP2,nameP3,selectedP,selecPDate,ulasanDate,catatan,username,kp_s,regist_date) VALUES 
('$id_daftar','$start','$terima','$jawab',
'$nameP1','$nameP2','$nameP3','$selectedP','$selecP','$ulasan','$catatan','$username','$kp_s',NOW())";

$result=mysql_query($sql); 
if (!$result) {
die('<center>Data tidak dikemaskini :  ' . mysql_error().'<br/><font color="gray"><small>Input error</small></font>');}
	else 
		{
		$sql1="update ckaj.butiran_projek set pereka= '$selectedP' where id_daftar='$id_daftar'" ; 
		$result1=mysql_query($sql1); 
		
		ob_end_clean(); // Delete the buffer.		
		header ("Location:  http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/projek_Perunding.php?event=Pinda");
		exit();

		echo "<center>Data telah diupload </center><br>";}}

else 
{echo "<center>Pilih satu projek untuk set butiran struktur!</center>";}
else 
{echo "<center>PPK saja dibolehkan daftar projek baru.</center>";}
else 
{echo "<center>Projek dalaman tidak perlu perunding. Input tidak disimpan.</center>";} }

if ($event=="add") 
if (!isset($_SESSION['first_name'])) {die ("<center>Anda tidak LOGIN !</center>");} 
else

{ $menu=1;
$count=mysql_query("SELECT COUNT(*) FROM Perunding_projek WHERE id_daftar ='{$_SESSION['daftar_id']}'");$count=mysql_fetch_array($count);
$count =$count[0];
//echo $count.'--'.$daftar_id.'--'.$id_daftar.'=='.$_SESSION['daftar_id']  ;
//$Bilangan=$count+1;
if ($count==1 || $count<>0) 
{die ("<center><font color=\"red\">Data telah diupload ke pengkalan. <br/>Sila buat pindaan.</font></center>");} 


?>
<form name="form1" method="post" action="<?php echo $fileName ?>">
<div align="center"> 
<table width="800" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#FDFECF" bgcolor= "#EBEEF5" > 
 
<?php
if ($event=="add") 
{ $menu=1;
$count=mysql_query("SELECT COUNT(*) FROM Perunding_projek WHERE kp_s ='$kp_s'");$count=mysql_fetch_array($count);
$count =$count[0];
$Bilangan=$count+1;}
?>

<tr align="center"> <td colspan="4" width="800" >
<small>TAJUK PROJEK:</small><br/><font color="darkgreen" size="4em" >
<?php echo $_SESSION['tajuk'].'</font><br/><font color="darkkhaki" size="1em">'.$_SESSION['mod_kerja'].'</font>';?>
</td></tr>

<tr> <td width="200" align="right"><small>Trk surat HOPT:</small></td> 
<td width="200" align="left"> 
<!--------------------------------New date format----------------------------------------->
<script> DateInput( 'start', false, 'YYYY-MM-DD')</script></td>


<td width="200" align="right"><small>Trk terima surat HOPT:</small></td> 
<td width="200" align="left"> 
<!--------------------------------New date format----------------------------------------->
<script> DateInput( 'terima', false, 'YYYY-MM-DD')</script></td> </tr> 

<tr> <td width="200" align="right" ><small>Perunding nameP1EV:</td><td width="400" colspan="2" align="center" >
<textarea name="nameP1EV" cols="60" rows="2" id="nameP1EV"></textarea>
</small> </td> <td width="200" align="left"><small>Trk jawab(+ TOR/NS):</small>
<script> DateInput( 'jawab', false, 'YYYY-MM-DD')</script>
</td></tr>

<tr> <td align="right"><small>nameP2EV:</td><td colspan="2" align="center"  >
<textarea name="nameP2EV" cols="60" rows="2" id="nameP2EV"></textarea>
</small></td></tr>

<tr> <td align="right"><small>nameP3EV:</td><td colspan="2" align="center"  >
<textarea name="nameP3EV" cols="60" rows="2" id="nameP3EV"></textarea>
</small></td></tr>

<tr> <td align="right"><small>Perunding dilantik:</td><td colspan="2" align="center"  >
<textarea name="selectedPEV" cols="60" rows="2" id="catatanEV"></textarea>
</small></td><td align="left"><small>Trk keputusan/lantik:</small>
<script> DateInput( 'selecP', false, 'YYYY-MM-DD')</script></td></tr>

<!--------------------------------New date format----------------------------------------->

<tr> <td align="right"><small>Ulasan/catatan:</td><td colspan="2" align="center">
<textarea name="catatanEV" cols="60" rows="3" id="catatanEV"></textarea>
</small></td><td align="left"><small>Trk htr ulasan/(semak MOA):</small>
<script> DateInput( 'ulasan', false, 'YYYY-MM-DD')</script></td></tr> 


<!---------------------------------------------------------------------------------------->


<tr align="center"> <td colspan="4">
<input type="submit" name="Submit" value="Syor Perunding"> 
<input type="button" name="Button" value="Batal Tambah" onClick="location=' <?php echo $fileName ?> '">
<br> 
<small><i> 
<!--Username :<textarea name="usernameEV" cols="17" rows="1" id="usernameEV"><?php echo $_SESSION['username'] ?></textarea-->
Username :<?php echo $_SESSION['username'] ?>&nbsp;&nbsp;
Pendaftar id :<font color="green">[<?php echo $_SESSION['kp_s'] ; ?>]</font>

</small>
</td> 
</tr> 
</table> </form> 
<center>
<?php } 
if ($event=="Pinda")
if (!isset($_SESSION['first_name'])) {echo '<center>Sila pilih satu projek dari SENARAI dan anda mesti LOGIN</center>';}
else
{$menu=1;$result=mysql_query("SELECT * FROM Perunding_projek WHERE id_daftar = {$_SESSION['daftar_id']} ORDER BY startDate DESC",$db);
//$myrow=mysql_fetch_array($result);
$myrow=mysql_fetch_assoc($result);
//echo $kp_s;
if (!$myrow) {echo '<center>Belum isi data pengesyoran.<br/>Klik Input.</center>';} 
else

//if ($myrow)
{  ?> 

<table width="800" border="1" align="center" cellpadding="1" cellspacing="0" bordercolor="#E4E4E4"> 
<tr bgcolor="#EBEEF5"> <td width="150" align="center">Pinda:</td>  
<td width="150" align="center">Modus operandi:</td> 
<!-----------------------------v to chk---------------------------------------->
<!-----td width="35" align="center">Days</td----------------------------------->

<td width="500" align="center" bgcolor="#FDFECF" bordercolor="#EBEEF5" >
<small>TAJUK PROJEK:</small><br/><font color="darkgreen" size="4em" >
<?php echo $_SESSION['tajuk'].'</font><br/><font color="darkkhaki" size="1em">'.$_SESSION['mod_kerja'].'</font>';?> 
</td></tr> 


<?php $Bilangan = 1;
do { 
//if ($dateFormat==1) 
{ 
//$first=intval(strtotime($myrow[startDate])/86400);
//$start=date("m-d-Y",strtotime($myrow[startDate]));
//$end = 1;
//$days =$end;
//------------------------------------------------------------------------------
//$sokong =$myrow[sokong];
//$sokong =$Vsokong;
}
 
if ($dateFormat==2) 
{ 
//$first=intval(strtotime($myrow[startDate])/86400);
//$day   = date("j");                  
} 
//----------------------------------------------
//$end= $eventLength;     $end = $Bilangan;//
//$Vid_daftar =$myrow[id_daftar];
$Vstart = $myrow[startDate];
$VselectedP = $myrow[selectedP];
$Vterima = $myrow[terimaDate];
$VselecP = $myrow[selecPDate];
$Vulasan = $myrow[ulasanDate];
$Vjawab  = $myrow[jawabDate];
$VnameP1 = $myrow[nameP1]; 
$VnameP2 =$myrow[nameP2]; 
$VnameP3 =$myrow[nameP3]; 
$Vcatatan = $myrow[catatan];
//$Vusername = $myrow[username];
//$Vkp_s =$myrow[kp_s];

//if ($dateFormat==1) { $startDate=date("m-d-Y",$start);$Bilangan=$end;}
//if ($dateFormat==2) { $startDate=date("d-m-Y",$start);$Bilangan=$end;} 
//if ($dateFormat==2) { $startDate=date("Y-m-d",$start);$Bilangan=$end;} 

//$id_daftar = $Vid_daftar; //$id_daftar = $_SESSION['daftar_id'];
$selectedP =htmlspecialchars(stripslashes($VselectedP),ENT_QUOTES);
//$terima =htmlspecialchars(stripslashes($Vterima),ENT_QUOTES);
//$selecP = htmlspecialchars(stripslashes($VselecP),ENT_QUOTES);
//$jawab=htmlspecialchars(stripslashes($Vjawab),ENT_QUOTES); 
$nameP1 =htmlspecialchars(stripslashes($VnameP1),ENT_QUOTES); 
$nameP2 =htmlspecialchars(stripslashes($VnameP2),ENT_QUOTES); 
$nameP3 =htmlspecialchars(stripslashes($VnameP3),ENT_QUOTES);
$catatan = htmlspecialchars(stripslashes($Vcatatan ),ENT_QUOTES) ;

$kp_s = $_SESSION['kp_s'];
$username = $_SESSION['username'];
$id_daftar = $_SESSION['daftar_id'];

?>

<tr> 
<td align="center" bgcolor="#E4F3CF"><small><a href="<?php echo $fileName ?>?eid=<?php 
echo $myrow[id] ?>"><small><img src="img/favicon.ico" border="0" margin-top="-50" >  
</small></a></small></td> 

<td align="center" bgcolor="#ECF1EB" ><?php echo $_SESSION['mod_kerja']; ?> 
<?php 
if ($_SESSION['mod_kerja']==='Inhouse')
{echo '<br><br><font color="darkkhaki"><small><b><i> TERKINI !</i></b></small></font><br>
<font color="gray"><small>Projek dalaman.<br>Data perunding<br>tidak relevan.</small></font>'; }
?>

</td> 



<td align="left">
<?php echo 
'<div style="margin-top:5px" > 
<font color="darkkhaki" size="1em"  style="margin-left:15px"><b>Trk surat HOPT&nbsp;:</b></font>
<font color="coral" size="2em"  style="margin-left:5px">'.$Vstart .'</font>
</div>'.
'<div style="margin-top:5px" > 
<font color="darkkhaki" size="1em"  style="margin-left:15px"><b>Trk terima surat HOPT&nbsp;:</b></font>
<font color="coral" size="2em"  style="margin-left:5px">'.$Vterima.'</font>
</div>'.
'<div style="margin-top:5px" >
<font color="darkkhaki" size="1em" style="margin-left:15px" ><b>Trk jawab (+ TOR/NS):</b></font> 
<font color="coral" size="2em"  style="margin-left:5px">'.$Vjawab.'</font>
</div>'.
'<div style="margin-top:5px" >
<font color="darkkhaki" size="1em"  style="margin-left:15px" ><b>Perunding P1&nbsp;:</b></font>
<font color="coral" size="2em"  style="margin-left:5px">'.$nameP1.'</font>

</div>'.
'<div style="margin-top:5px" > 
<font color="darkkhaki" size="1em"  style="margin-left:15px"><b>Perunding P2&nbsp;:</b></font>
<font color="coral" size="2em"  style="margin-left:5px">'.$nameP2.'</font>
</div>'.
'<div style="margin-top:5px" >
<font color="darkkhaki" size="1em"  style="margin-left:15px"><b>Perunding P3&nbsp;:</b></font>
<font color="coral" size="2em"  style="margin-left:5px">'.$nameP3.'</font>
</div>'.
'<div style="margin-top:5px" >
<font color="darkkhaki" size="1em" style="margin-left:15px" ><b>Perunding projek&nbsp;:</b></font> 
<font color="coral" size="2em"  style="margin-left:5px">'.$selectedP.'</font>
</div>'.
'<div style="margin-top:5px" >
<font color="darkkhaki" size="1em"  style="margin-left:15px"><b>Trk. selecP&nbsp;:</b></font>
<font color="coral" size="2em"  style="margin-left:5px">'.$VselecP.'</font>
</div>'.

'<div style="margin-top:5px" >
<font color="darkkhaki" size="1em"  style="margin-left:15px"><b>Trk. ulasan/(semak MOA)&nbsp;:</b></font>
<font color="coral" size="2em"  style="margin-left:5px">'.$Vulasan.'</font>

</div>'.
'<div style="margin-top:5px" > 
<font color="darkkhaki" size="1em" style="margin-left:15px" ><b>Catatan&nbsp;:</b></font>
<font color="coral" size="2em"  style="margin-left:5px">'.$catatan.'</font>
</div>'.
'<div style="margin-top:15px" > <p align="right" style="margin-top:20px"> 
<font color="darkgreen" size="1em" style="margin-left:255px">Trk. daftar&nbsp;:</font>
<font color="darkgreen" size="1em"  style="margin-left:5px">'.$myrow[regist_date].'&nbsp;&nbsp;</font>
</p>
</div>' ?>
</td></tr> 

<?php } 
while ($myrow=mysql_fetch_array($result));?>
</table> <br> 
<?php } } 
if ($eid) 
{ $menu=1;$result=mysql_query("SELECT * FROM Perunding_projek WHERE id='$eid'",$db);
$myrow=mysql_fetch_array($result);
$dates=explode("-", $myrow[startDate] );?> 
<?php //$dates0=explode("-", $myrow[siapDate]);?> 

<form name="form1" method="post" action="<?php echo $fileName ?>">
<div align="center"> 
<table width="800" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#FDFECF" bgcolor="#EBEEF5"> 

<tr align="center"> <td colspan="4">
<small>TAJUK PROJEK:</small><br/><font color="darkgreen" size="4em" >
<?php echo $_SESSION['tajuk'].'</font><br/><font color="darkkhaki" size="1em">'.$_SESSION['mod_kerja'].'</font>';?> 
</td></tr>

<tr> <td width="200" align="right"><small>Trk surat HOPT:</small></td> 
<td width="200" align="left"> 
<!--------------------------------New date format----------------------------------------->
<script> DateInput( 'start', false, 'YYYY-MM-DD' <?php if ($myrow[startDate]=='0000-00-00'){echo '';}else
echo ",'".$myrow[startDate]."'" ;?>)
</script></td>


<td width="200" align="right"><small>Trk terima surat HOPT:</small></td> 
<td width="200" align="left"> 
<!--------------------------------New date format----------------------------------------->
<script> DateInput( 'terima', false, 'YYYY-MM-DD' <?php if ($myrow[terimaDate]==='0000-00-00'){echo '';}else
echo ",'".$myrow[terimaDate]."'" ;?> )

</script></td> </tr> 

<tr> <td align="right"><small>Perunding nameP1EV:</td><td colspan="2">
<div><textarea name="nameP1EV" cols="75" rows="2" id="nameP1EV"><?php echo $myrow[nameP1];?></textarea></div>
</small> </td> <td align="left"><small>Trk jawab (+ TOR/NS):</small>
<script> DateInput( 'jawab', false, 'YYYY-MM-DD' <?php if ($myrow[jawabDate]==='0000-00-00'){echo '';}else
echo ",'".$myrow[jawabDate]."'" ;?> )
</script></td></tr>

<tr> <td align="right"><small>nameP2EV:</td><td colspan="2" >
<div><textarea name="nameP2EV" cols="75" rows="2" id="nameP2EV"><?php echo $myrow[nameP2];?></textarea></div>
</small></td></tr>

<tr> <td align="right"><small>nameP3EV:</td><td colspan="2" >
<div><textarea name="nameP3EV" cols="75" rows="2" id="nameP3EV"><?php echo $myrow[nameP3];?></textarea></div>
</small></td></tr>

<tr> <td align="right"><small>Perunding dilantik:</td><td colspan="2" >
<div><textarea name="selectedPEV" cols="75" rows="2" id="catatanEV"><?php echo $myrow[selectedP];?></textarea></div>
</small></td><td align="left"><small>Trk keputusan/lantikan:</small>
<script> DateInput( 'selecP', false, 'YYYY-MM-DD' <?php if ($myrow[selecPDate]==='0000-00-00'){echo '';}else
echo ",'".$myrow[selecPDate]."'" ;?> )
</script></td></tr>

<!--------------------------------New date format----------------------------------------->

<tr> <td align="right"><small>Ulasan/catatan:</td><td colspan="2" >
<div><textarea name="catatanEV" cols="75" rows="3" id="catatanEV"><?php echo $myrow[catatan];?></textarea></div>
</small></td><td align="left"><small>Trk htr ulasan/(semak MOA):</small>
<script> DateInput( 'ulasan', false, 'YYYY-MM-DD' <?php if ($myrow[ulasanDate]==='0000-00-00'){echo '';}else
echo ",'".$myrow[ulasanDate]."'" ;?> )
</script></td></tr> 
<!--------------------------------------------------------------------------------------------------------------->

<tr align="center">
<td colspan="4"><input type="submit" name="Submit" value="Pinda Data"> 
<input type="button" name="Button" value="Batal Pindaan" onClick="location='<?php echo $fileName.'?event=Pinda';  ?>'">
<br/><font color="gray"><small>
Username:<?php echo $_SESSION['username'] ?> &nbsp;&nbsp;<i>
Pendaftar id<small>[<?php echo $_SESSION['kp_s']; ?>]</i></small></font>

<input name="id" type="hidden" id="id" value="<?php echo $myrow[id] ?>"></td></tr> 
<input name="id_daftar" type="hidden" id="id_daftar" value="<?php echo $myrow[id_daftar] ?>"> 
<!--------------------------------------------------------------------------------------------------------------->
</table> </form> 

<center>[
<a href="<?php echo "$fileName?del=$myrow[id]";?>" onCLick="return confirmDelete() ;">Padam Data</a>]
<br> <br> </center> 
<?php } 
if ($del) { $menu=1;$delsql="DELETE from Perunding_projek WHERE id='$del';";$delresult=mysql_query($delsql);
echo "<center>The Perunding has been deleted.</center><br>";
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
$startDate  = $startEV ;
$terimaDate = $terimaEV ;
$selecPDate = $selecPEV ;
$ulasanDate = $ulasanEV ;
$jawabDate  = $jawabEV ;
//$id_daftar = $Vid_daftar; //$id_daftar = $_SESSION['daftar_id'];
$selectedP =$selectedPEV;
//$terima =htmlspecialchars(stripslashes($terimaEV),ENT_QUOTES);
//$selecP = htmlspecialchars(stripslashes($selecPEV),ENT_QUOTES);
//$jawab=htmlspecialchars(stripslashes($jawabEV),ENT_QUOTES); 
$nameP1 =$nameP1EV; 
$nameP2 =$nameP2EV; 
$nameP3 =$nameP3EV;
$catatan = htmlspecialchars(stripslashes($catatanEV ),ENT_QUOTES) ;

?> 

<form name="form2" method="post" action="<?php echo $fileName ?>">
<div align="center"> 
<table width="800" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#FDFECF" bgcolor="#EBEEF5">
<?php

//$startDate=$month."/".$day."/".$year;
//$start=strtotime($startDate);
//if ($dateFormat==1) { $format="mm-dd-yyyy";}
//if ($dateFormat==2) { $format="dd-mm-yyyy";}
//$end=$eventLength;
//if ($dateFormat==1) { $startDate=date("m-d-Y",$start);} //$Bilangan=$end;}
//if ($dateFormat==2) { $startDate=date("d-m-Y",$start);} // $Bilangan=$end;} 
?>
<div align="center" class="style4">
<strong><span>Pasti Pinda Data:</span>
<br></strong></div><br/>

<table width="800" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor= "#FDFECF" bgcolor= "#EBEEF5">

<tr align="center"> <td colspan="2">
<small>TAJUK PROJEK:</small><br/><font color="darkgreen" size="4em" >
<?php echo $_SESSION['tajuk'].'</font><br/><font color="darkkhaki" size="1em">'.$_SESSION['mod_kerja'].'</font>';?>
</td></tr>

<tr><td width="200" align="right"><small>Trk surat HOPT :</small></td> <td width="600" align="left"> 
<small><?php echo $start ?></small>
</td> </tr> 


<!-------------------------------to note ------------------------------------------->
<?php //
{$count=mysql_query("SELECT COUNT(*) FROM Perunding_projek WHERE kp_s ='$kp_s'");$count=mysql_fetch_array($count);
$count =$count[0];
$Bilangan=$count+1;}
?> 

<tr> <td align="right"><small>Trk terima :</small></td><td align="left"> 
<small><?php echo $terima ?></small>
</td> </tr> 
<tr> <td align="right"><small>Trk jawab (+ TOR/NS):</small></td> <td align="left">
<small><?php echo $jawab ?></small>
</td> </tr>
<tr> <td align="right"><small>nameP1:</small></td> <td align="left">
<small><?php echo $nameP1 ?></small>
</td> </tr>
<tr> <td align="right"><small>nameP2:</small></td> <td align="left">
<small><?php echo $nameP2 ?></small>
</td> </tr>
<tr> <td align="right"><small>nameP3:</small></td> <td align="left">
<small><?php echo $nameP3 ?></small>
</td> </tr>

<tr> <td align="right"><small>selectedPerunding:</small></td> <td align="left">
<small><?php echo $selectedP ?></small>
</td> </tr>
<tr> <td align="right"><small>Trk selecP :</small></td> <td align="left">
<small><?php echo $selecP ?></small>
</td> </tr>
<tr> <td align="right"><small>Trk ulasan/(semak MOA) :</small></td> <td align="left">
<small><?php echo $ulasan ?></small>
</td> </tr>


<tr> <td align="right"><small>Catatan :</small></td> <td align="left">
<small><?php echo $catatan ?></small>
</td> </tr>
<tr align="center"> <td colspan="2">
<input type="submit" name="Submit" value="Simpan Pindaan"> 
<input type="button" name="Button" value="Pinda" onClick="history.back();"> 
<input type="button" name="Button" value="Batal Pindaan" onClick="location='<?php echo $fileName.'?event=Pinda';  ?>'"> 
<br/><font color="gray"> <i><small>Username:<?php echo $_SESSION['username'] ?>
&nbsp;Pendaftar id<small>[<?php echo $_SESSION['kp_s'] ?>]</small></small></i></font> 

<input name="end" type="hidden" id="end" value="<?php echo $end ?>"> 
<input name="id" type="hidden" id="id" value="<?php echo $id ?>"> 

<input name="id_daftar" type="hidden" id="id_daftar" value="<?php echo $_SESSION['daftar_id'] ?>"> 
<input name="start" type="hidden" id="start" value="<?php echo $start ?>">
<input name="selectedP" type="hidden" id="selectedP" value="<?php echo $selectedP ?>"> 
<input name="terima" type="hidden" id="terima" value="<?php echo $terima ?>"> 
<input name="selecP" type="hidden" id="selecP" value="<?php echo $selecP ?>">
<input name="ulasan" type="hidden" id="ulasan" value="<?php echo $ulasan ?>">

<input name="jawab" type="hidden" id="jawab" value="<?php echo $jawab ?>">
<input name="nameP1" type="hidden" id="nameP1" value="<?php echo $nameP1 ?>">
<input name="nameP2" type="hidden" id="nameP2" value="<?php echo $nameP2 ?>">
<input name="nameP3" type="hidden" id="nameP3" value="<?php echo $nameP3 ?>">
<input name="catatan" type="hidden" id="catatan" value="<?php echo $catatan ?>">
<input name="username" type="hidden" id="username" value="<?php echo $_SESSION['username'] ?>">
<input name="kp_s" type="hidden" id="kp_s" value="<?php echo $_SESSION['kp_s'] ?>">

</td> </tr> 
</table> </form>

<?php } 
if ($Submit=="Simpan Pindaan") 
{ $menu=1;
//$Bilangan=$end;
//$startDate=date("Y-m-d",$start);

echo $start.'<start---';
//-----------------------------------------


$sql="UPDATE Perunding_projek SET 
id_daftar='$id_daftar',startDate='$start',terimaDate='$terima',jawabDate='$jawab',
nameP1='$nameP1',nameP2='$nameP2',nameP3='$nameP3',selectedP='$selectedP',selecPDate='$selecP',
ulasanDate='$ulasan',catatan='$catatan',username='$username',kp_s='$kp_s' WHERE id='$id';";

$result=mysql_query($sql);

		$sql1="update ckaj.butiran_projek set pereka= '$selectedP' where id_daftar='$id_daftar'" ; 
		$result1=mysql_query($sql1); 
		
		
echo "<center>Telah dikemaskini. Masuk sesi baru jika klik 'semak'.</center><br>";
	ob_end_clean(); // Delete the buffer.		
	header ("Location:  http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/projek_Perunding.php?event=Pinda");
	exit();}

if ($menu!=1) 
{ $count=mysql_query("SELECT COUNT(*) FROM Perunding_projek WHERE id_daftar = '{$_SESSION['daftar_id']}'");$count=mysql_fetch_array($count);
$count=$count[0];echo "<div align=\"center\">--JUMLAH DATA:<b>$count</b>--PROJEK NO:<b>{$_SESSION['daftar_id']}</b>--</div><br>";} 
?>

<!--a href="http://www.EasilySimpleCalendar.com/" target="_blank"><span class="style8">
&copy;2004 Easily Simple Calendar 4.8</span></a-->
<br> 
<?php // Include the HTML footer file.

include_once ('html/footer.htm');
?>

