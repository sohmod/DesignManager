<?php 
$page_title = 'Butiran projek';
include_once ('html/header.htm');
// Welcome the user (by name if they are logged in).
if (isset($_SESSION['first_name'])) { 

echo "&nbsp;&nbsp;<i> log: {$_SESSION['first_name']} </i></small></center></fieldset>";
}
else
{ echo "</small></center></fieldset>"; }

require ("inc/projek_butiran_cfg.php");
require_once ('mysql_connect.php'); // Connect to the database.
		$getU=$_SESSION['daftar_id'];

$countdp=mysql_query("SELECT COUNT(*) FROM dplan_projek WHERE id_daftar ='{$_SESSION['daftar_id']}'");$countdp=mysql_fetch_array($countdp);
$countdp =$countdp[0];
if ($countdp===0) 
{die ("<center><font color=\"red\"> Sila isi D-plan.</font></center>");} 
		$q = "select tajuk, OIC AS ppk, mod_kerja from daftar_projek 
			where daftar_id = '$getU'";
		$r = mysql_query ($q) or die(mysql_error());
		while ($tna = mysql_fetch_array ($r)) {
		$_SESSION['tajuk'] = $tna[0];
		$_SESSION['ppk'] = $tna[1];
		$_SESSION['mod_kerja'] = $tna[2];
		
		//$_SESSION['daftar_id'] = $getU; 		
		//		ob_end_clean(); // Delete the buffer.
				
		//		header ("Location:  http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/projek_butiran.php?event=Pinda");

		//		exit();
			}		
$db=@mysql_connect($dbHost,$dbUserLogin,$dbPassword) or $error=(mysql_error()."<br>");
@mysql_select_db($dbName,$db) or $error.=(mysql_error());

if ($error) {
echo "<font color=red>> There was an error connecting to the mySQL database.</font><br><br>";
echo "Please check the database settings in the 'projek_butiran_cfg.php' file and try again.<br><br>";
echo "The error was reported as:<br>$error";exit;}
?>
<script type="text/javascript" src="jasoncalendar/calendarDateInput.js">
</script>


 <!--title> Konsol butiran Projek </title-->
 <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1">
 <style type="text/css">
 a:link { text-decoration:none ; font-size:12px; font-weight:normal }
 a:visited { text-decoration:none ; font-size:12px; font-weight:normal }
 a:hover { text-decoration:underline ; font-size:12px; font-weight:normal;background-color: #00ff00; }
 body { font-family:Verdana,Arial,Helvetica,sans-serif;font-size:12px; } 
 // background: white url(../bground/chalkbrk.jpg);// no-repeat top right; 
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
Konsol <b>Butiran</b> jobNo: <?php echo '<b>'.$_SESSION['daftar_id'].'</b>';?>
</span></div>

<div align="center"><span>
<?php $count=mysql_query("SELECT COUNT(*) FROM butiran_projek WHERE id_daftar ='{$_SESSION['daftar_id']}'");$count=mysql_fetch_array($count);
$count =$count[0]; 
if ( $count==0 ){ echo '<a href="'.$fileName.'?event=add">Input</a>'; } ?>

<a href="<?php echo "$fileName?event=Pinda";?>"> <img src="img/favicon.ico" border="0" margin-top="-50" alt="java duke!"> 
Semak & Pinda</a>
</span></div>
<div align="center"><span>
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
$end=$_REQUEST["end"];
$eventLength=$_REQUEST["eventLength"];
$id=$_REQUEST["id"]; //idx
$eid=$_REQUEST["eid"];
$del=$_REQUEST["del"];
$month0=$_REQUEST["month0"];
$day0=$_REQUEST["day0"];
$year0=$_REQUEST["year0"];


$id_daftar =$_REQUEST["id_daftar"];
$pereka =$_REQUEST["pereka"]; 
$penyemak =$_REQUEST["penyemak"]; 
$pelukis =$_REQUEST["pelukis"]; 
$start=$_REQUEST["start"]; //jadual date
$rekastart=$_REQUEST["rekastart"]; //jadual date
$rekasiap=$_REQUEST["rekasiap"];
$tender=$_REQUEST["tender"];
$mtapak=$_REQUEST["mtapak"];
$binasiap=$_REQUEST["binasiap"];
$catatan=$_REQUEST["catatan"];
$username=$_REQUEST["username"];
$kp_s=$_REQUEST["kp_s"];
$regist_date=$_REQUEST["regist_date"];
$ppenguasa=$_REQUEST["ppenguasa"];
$hadSiling=$_REQUEST["hadSiling"];
$kpda=$_REQUEST["kpda"];
$katda=$_REQUEST["katda"];
$kkontrak=$_REQUEST["kkontrak"];
$kacda=$_REQUEST["kacda"];
$kluar=$_REQUEST["kluar"];
$ktanah=$_REQUEST["ktanah"];


$kair=$_REQUEST["kair"];
$knajis=$_REQUEST["knajis"];
$kjalan=$_REQUEST["kjalan"];
$kprelim=$_REQUEST["kprelim"];
$luastapak=$_REQUEST["luastapak"];
$bilPetender=$_REQUEST["bilPetender"];
$kaedahT=$_REQUEST["kaedahT"];
$kontraktor=$_REQUEST["kontraktor"];


$id_daftarEV =$_REQUEST["id_daftarEV"];
$perekaEV =$_REQUEST["perekaEV"]; 
$penyemakEV =$_REQUEST["penyemakEV"]; 
$pelukisEV =$_REQUEST["pelukisEV"]; 

$catatanEV=$_REQUEST["catatanEV"];
$usernameEV=$_REQUEST["usernameEV"];
$kp_sEV=$_REQUEST["kp_sEV"];
$ppenguasaEV=$_REQUEST["ppenguasaEV"];
$hadSilingEV=$_REQUEST["hadSilingEV"];
$kpdaEV=$_REQUEST["kpdaEV"];
$katdaEV=$_REQUEST["katdaEV"];
$kkontrakEV=$_REQUEST["kkontrakEV"];
$kacdaEV=$_REQUEST["kacdaEV"];
$kluarEV=$_REQUEST["kluarEV"];
$ktanahEV=$_REQUEST["ktanahEV"];

$kairEV=$_REQUEST["kairEV"];
$knajisEV=$_REQUEST["knajisEV"];
$kjalanEV=$_REQUEST["kjalanEV"];
$kprelimEV=$_REQUEST["kprelimEV"];
$luastapakEV=$_REQUEST["luastapakEV"];
$bilPetenderEV=$_REQUEST["bilPetenderEV"];
$kaedahTEV=$_REQUEST["kaedahTEV"];
$kontraktorEV=$_REQUEST["kontraktorEV"];

//-------------V
$Vid_daftar =$_REQUEST["Vid_daftar"];
$Vpereka =$_REQUEST["Vpereka"]; 
$Vpenyemak =$_REQUEST["Vpenyemak"]; 
$Vpelukis =$_REQUEST["Vpelukis"]; 

$Vcatatan=$_REQUEST["Vcatatan"];
$Vusername=$_REQUEST["Vusername"];
$Vkp_s=$_REQUEST["Vkp_s"];
$Vppenguasa=$_REQUEST["Vppenguasa"];
$VhadSiling=$_REQUEST["VhadSiling"];
$Vkpda=$_REQUEST["Vkpda"];
$Vkatda=$_REQUEST["Vkatda"];
$Vkkontrak=$_REQUEST["Vkkontrak"];
$Vkacda=$_REQUEST["Vkacda"];
$Vkluar=$_REQUEST["Vkluar"];
$Vktanah=$_REQUEST["Vktanah"];

$Vkair=$_REQUEST["Vkair"];
$Vknajis=$_REQUEST["Vknajis"];
$Vkjalan=$_REQUEST["Vkjalan"];
$Vkprelim=$_REQUEST["Vkprelim"];
$Vluastapak=$_REQUEST["Vluastapak"];
$VbilPetender=$_REQUEST["VbilPetender"];
$VkaedahT=$_REQUEST["VkaedahT"];
$Vkontraktor=$_REQUEST["Vkontraktor"];

}

/////////////////////////////////////////////////////////////////////



if ($Submit=="Tambah Data") { 
$menu=1;
if (!isset($_SESSION['first_name'])) 
{die ("<center>Data tidak lengkap. <br/>Sila cuba lagi.</center>");} 

$Vid_daftar=$id_daftarEV;  

if ($Vpereka=="Perunding")  { $Vpereka=$perekaEV;    }
if ($Vpenyemak=="Perunding"){ $Vpenyemak=$penyemakEV;}

$Vpereka=$Vpereka;  
$Vpenyemak=$Vpenyemak;  


$Vpelukis=$pelukisEV;  
$startDate=$start;
$rekastartDate=$rekastart;
$rekasiapDate=$rekasiap;
$tenderDate=$tender;
$mtapakDate=$mtapak;
$binasiapDate=$binasiap;
$Vcatatan=$catatanEV; 
$Vusername=$usernameEV; 
$Vkp_s=$kp_sEV;
//$regist_date 
$Vppenguasa=$ppenguasaEV;
$VhadSiling=$hadSilingEV;
$Vkpda=$kpdaEV; 
$Vkatda=$katdaEV; 
$Vkkontrak=$kkontrakEV; 
$Vkacda=$kacdaEV; 
$Vkluar=$kluarEV; 
$Vktanah=$ktanahEV; 
$Vkair=$kairEV; 
$Vknajis=$knajisEV; 
$Vkjalan=$kjalanEV; 
$Vkprelim=$kprelimEV; 
$Vluastapak=$luastapakEV; 
$VbilPetender=$bilPetenderEV;
$VkaedahT=$kaedahTEV;
$Vkontraktor=$kontraktorEV;

$kp_s = $_SESSION['kp_s'];
$username = $_SESSION['username'];
$id_daftar = $_SESSION['daftar_id'];
?> 

<?php // Make sure the username is available.
		$query = "SELECT startDate FROM butiran_projek WHERE id_daftar= {$_SESSION['daftar_id']} AND startDate= '$startDate'";		
		$result = @mysql_query ($query);
		/* echo $result;
		echo mysql_num_rows($result).'<br/>' ;
		$kkk = mysql_num_rows($result);  
		for ($k = 0 ; $k < $kkk ; $k++){
		echo mysql_result( $result,$k ).'==>'.$startDate;
		echo '<br/>';
		} */
		
		if (mysql_num_rows($result) <> 0) { // Available.
				echo '<h5 align="center">butiran untuk tarikh  '.$startDate.'  telah ada. Sila buat pindaan!</h5>';
				//include ('footer.htm'); // Include the HTML footer.
				exit();}
else
{ ?>

<div align="center" class="style4">
<strong><span>Pasti butiran Projek !</span>
</strong></div>

<form name="form2" method="post" action="<?php echo $fileName ?>">
<div align="center"> 

<form name="form1" method="post" action="<?php echo $fileName ?>">
<div align="center"> 


<table width="800" border="1" align="center" cellpadding="1" cellspacing="0" bordercolor="#FDFECF" bgcolor= "#EBEEF5" > 
 
<tr> <td width="160" align="right" colspan="2" ><small>Tarikh input:</small>
<br/> <small><?php echo $startDate ?> </small></td>
<td align="center" colspan="8" width="640">
<small>TAJUK PROJEK:</small><br/><font color="darkgreen" size="4em" >
<?php echo $_SESSION['tajuk'].'</font><br/><font color="darkkhaki" size="1em">'.$_SESSION['mod_kerja'].'</font>';?> 
</td></tr>

<tr> <td align="center" colspan="2" width="160"><small>&nbsp; Kos kerja Saliran:<br/>
#<?php echo $Vkluar ?>
</small></td>
<td align="center" colspan="2" width="160" ><small>Tanah:<br/>
#<?php echo $Vktanah ?>
</small></td>
<td align="center" colspan="2" width="160" ><small>Bekalan Air:<br/>
#<?php echo $Vkair ?>
</small></td>
<td align="center" colspan="2" width="160" ><small>Pembetungan:<br/>
#<?php echo $Vknajis ?>
</small></td>
<td align="center" colspan="2" width="160" ><small>Jalan Dalaman:<br/>
#<?php echo $Vkjalan ?>
</small></td>
</tr>

<tr> <td align="right" colspan="2" width="160" ><small>Pereka/Perunding:</td> 
<td align="left" colspan="6" width="640" >
#<?php echo $Vpereka ?>
</small></td> 
<td align="center" colspan="2" ><small>Luas tapak:<br/>
#<?php echo $Vluastapak ?>
Ha.</small></td>
</tr>

<tr> <td align="right" colspan="2" ><small>Penyemak/ICE:</td> 
<td align="left" colspan="8" >
#<?php echo $Vpenyemak ?>
</small></td> 
</tr>

<tr> <td align="right" colspan="2" ><small>Pelukis:</td> 
<td align="left" colspan="8" >
#<?php echo $Vpelukis ?>
</small></td> 
</tr>

<tr> <td align="right" colspan="2" ><small>Peg Penguasa:</td> 
<td align="left" colspan="6" >
#<?php echo $Vppenguasa ?>
</small></td>
<td align="center" colspan="2" ><small>Prelim:<br/>
#<?php echo $Vkprelim ?>
</small></td>
</tr>

<tr>
<td align="center" colspan="2" ><small>brif&amp;lukisanDate:</small>
<br/> #<?php echo $rekastartDate ?>
</small></td>
<td align="center" colspan="2" ><small>rekasiapDate: 
<br/> #<?php echo $rekasiapDate ?>
</small></td>
<td align="center" colspan="2" ><small>tenderDate:
<br/> #<?php echo $tenderDate ?>
</small></td>
<td align="center" colspan="2" ><small>mtapakDate:
<br/> #<?php echo $mtapakDate ?>
</small></td>
<td align="center" colspan="2" ><small>binasiapDate:
<br/> #<?php echo $binasiapDate ?>
</small></td>
</tr>

<tr> 
<td align="center" colspan="2" ><small>hadSiling: <br/>
#<?php echo $VhadSiling ?>
</small></td>
<td align="center" colspan="2" ><small>PDA:<br/>
#<?php echo $Vkpda ?>
</small></td>
<td align="center" colspan="2" ><small>ATDA:<br/>
#<?php echo $Vkatda ?>
</small></td>
<td align="center" colspan="2" ><small>Kontrak:<br/>
#<?php echo $Vkkontrak ?>
</small></td>
<td align="center" colspan="2" ><small>ACDA:<br/>
#<?php echo $Vkacda ?>
</small></td>
</tr>

<tr> <td align="right" colspan="2" ><small>Kaedah Tender:</td> 
<td align="left" colspan="6" >
#<?php echo $VkaedahT ?>
</small></td>
<td align="center" colspan="2" ><small>Bil Petender:
#<?php echo $VbilPetender ?>
</small></td>
</tr>
<tr> <td align="right" colspan="2" ><small>Kontraktor:</td> 
<td align="left" colspan="8" >
#<?php echo $Vkontraktor ?>
</small></td>
</tr>

<tr> <td align="right" colspan="2" ><small>Catatan:</td> 
<td align="left" colspan="8" >
#<?php echo $Vcatatan ?>
</small></td>
</tr>


<tr align="center"> <td colspan="10"><input type="submit" name="Submit" value="Simpan Data"> 
<input type="button" name="Button" value="Pinda" onClick="history.back();">
<input type="button" name="Button" value="Batal Tambah" onClick="location='<?php echo $fileName.'?event=Pinda';  ?>'">
<br/><font color="gray"><small>
Username:<?php 
//echo $_SESSION['username']; 
?> &nbsp;&nbsp;<i>
Pendaftar id<small>[<?php 
//echo $_SESSION['kp_s']; 
?>]</i></small></font>
<input name="id_daftar" type="hidden" id="id_daftar" value="<?php echo $id_daftar ?>"> 
<input name="pereka" type="hidden" id="pereka" value="<?php echo $Vpereka ?>">
<input name="penyemak" type="hidden" id="penyemak" value="<?php echo $Vpenyemak ?>">
<input name="pelukis" type="hidden" id="pelukis" value="<?php echo $Vpelukis ?>">
<input name="start" type="hidden" id="start" value="<?php echo $start ?>">
<input name="rekastart" type="hidden" id="rekastart" value="<?php echo $rekastart ?>">
<input name="rekasiap" type="hidden" id="rekasiap" value="<?php echo $rekasiap ?>">
<input name="tender" type="hidden" id="tender" value="<?php echo $tender ?>">
<input name="mtapak" type="hidden" id="mtapak" value="<?php echo $mtapak ?>">
<input name="binasiap" type="hidden" id="binasiap" value="<?php echo $binasiap ?>">
<input name="catatan" type="hidden" id="catatan" value="<?php echo $Vcatatan ?>">
<input name="username" type="hidden" id="username" value="<?php echo $Vusername ?>">
<input name="kp_s" type="hidden" id="kp_s" value="<?php echo $Vkp_s ?>">
<!-- regist_date -->
<input name="ppenguasa" type="hidden" id="ppenguasa" value="<?php echo $Vppenguasa ?>">
<input name="hadSiling" type="hidden" id="hadSiling" value="<?php echo $VhadSiling ?>"> 
<input name="kpda" type="hidden" id="kpda" value="<?php echo $Vkpda ?>"> 
<input name="katda" type="hidden" id="katda" value="<?php echo $Vkatda?>"> 
<input name="kkontrak" type="hidden" id="kkontrak" value="<?php echo $Vkkontrak?>"> 
<input name="kacda" type="hidden" id="kacda" value="<?php echo $Vkacda?>">
<input name="kluar" type="hidden" id="kluar" value="<?php echo $Vkluar?>">
<input name="ktanah" type="hidden" id="ktanah" value="<?php echo $Vktanah?>">
<input name="kair" type="hidden" id="kair" value="<?php echo $Vkair?>">
<input name="knajis" type="hidden" id="knajis" value="<?php echo $Vknajis?>">
<input name="kjalan" type="hidden" id="kjalan" value="<?php echo $Vkjalan?>">
<input name="kprelim" type="hidden" id="kprelim" value="<?php echo $Vkprelim?>">
<input name="luastapak" type="hidden" id="luastapak" value="<?php echo $Vluastapak?>">
<input name="bilPetender" type="hidden" id="bilPetender" value="<?php echo $VbilPetender?>">
<input name="kaedahT" type="hidden" id="kaedahT" value="<?php echo $VkaedahT?>">
<input name="kontraktor" type="hidden" id="kontraktor" value="<?php echo $Vkontraktor?>">


</td> </tr> </table> </div> </form>

<?php }} 
///////////////////////////////////////////////////////////////////////////////^x}
if ($Submit=="Simpan Data") { $menu=1;
//$Bilangan=$end;
//$Bilangan=$eventlength;
//$startDate = date("Y-m-d" ,$start);
//$rekastartDate = date("Y-m-d",$rekastart);

$blokPengurus = trim($_SESSION['first_name']);
if ($bilPetender<=1){$bilPetender=1;}



if (isset($_SESSION['first_name']))
if (isset($_SESSION['daftar_id']))
 
{ $sql="INSERT INTO butiran_projek (id_daftar,pereka,penyemak,pelukis,ppenguasa,
startDate,rekastartDate,rekasiapDate,tenderDate,mtapakDate,binasiapDate,
catatan,username,kp_s,regist_date,hadSiling,kpda,katda,kkontrak,kacda,
kluar,ktanah,kair,knajis,kjalan,kprelim,luastapak,kaedahT,bilPetender,kontraktor) VALUES 
('$id_daftar','$pereka','$penyemak','$pelukis','$ppenguasa',
'$start','$rekastart','$rekasiap','$tender','$mtapak','$binasiap',
'$catatan','$username','$kp_s',NOW(),'$hadSiling','$kpda','$katda','$kkontrak','$kacda',
'$kluar','$ktanah','$kair','$knajis','$kjalan','$kprelim','$luastapak','$kaedahT','$bilPetender','$kontraktor')";

$result=mysql_query($sql); 
if (!$result) {
die('<center>Data tidak dikemaskini :  ' . mysql_error().'<br/><font color="gray"><small>Input error</small></font>');}
	else 
		{
		ob_end_clean(); // Delete the buffer.		
		header ("Location:  http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/projek_butiran.php?event=Pinda");
		exit();

		echo "<center>Data telah diupload </center><br>";}}
else 
{echo "<center>Anda perlu pilih satu projek untuk set butiran!</center>";}
else 
{echo "<center>Kegunaan pengurus kursus berdaftar saja!</center>";}}



if ($event=="add") 
if (!isset($_SESSION['first_name'])) {die ("<center>Anda tidak LOGIN !</center>");} 
else
{ $menu=1;
$count=mysql_query("SELECT COUNT(*) FROM butiran_projek WHERE id_daftar ='{$_SESSION['daftar_id']}'");$count=mysql_fetch_array($count);
$count =$count[0];

//echo $count.'--'.$daftar_id.'--'.$id_daftar.'=='.$_SESSION['daftar_id']  ;
//$Bilangan=$count+1;
if ($count==1 || $count<>0) 
{die ("<center><font color=\"red\">Data telah diupload ke pengkalan. <br/>Sila buat pindaan.</font></center>");} 

?>

<form name="form1" method="post" action="<?php echo $fileName ?>">
<div align="center"> 
<table width="800" border="1" align="center" cellpadding="1" cellspacing="0" bordercolor="#FDFECF" bgcolor= "#EBEEF5" > 
 
<tr> <td width="160" align="right" colspan="2" ><small>Tarikh input:</small>
<!--------------------------------New date format----------------------------------------->
<script> DateInput( 'start', true, 'YYYY-MM-DD')</script></td>
<td align="center" colspan="8" width="640">
<small>TAJUK PROJEK:</small><br/><font color="darkgreen" size="4em" >
<?php echo $_SESSION['tajuk'].'</font><br/><font color="darkkhaki" size="1em">'.$_SESSION['mod_kerja'].'</font>';?> 
</td></tr>

<tr> <td align="center" colspan="2" width="160" ><small>&nbsp; Kos kerja Saliran:<br/>
<input name="kluarEV" type="text" id="kluarEV" value="0.00">
</small></td>
<td align="center" colspan="2" width="160" ><small>Kos kerja Tanah:<br/>
<input name="ktanahEV" type="text" id="ktanahEV" value="0.00">
</small></td>
<td align="center" colspan="2" width="160" ><small>Kos kerja Bekalan Air:<br/>
<input name="kairEV" type="text" id="kairEV" value="0.00">
</small></td>
<td align="center" colspan="2" width="160" ><small>Kos kerja Pembetungan:<br/>
<input name="knajisEV" type="text" id="knajisEV" value="0.00">
</small></td>
<td align="center" colspan="2" width="160" ><small>Kos kerja Jalan Dalaman:<br/>
<input name="kjalanEV" type="text" id="kjalanEV" value="0.00">
</small></td>
</tr>

<tr> <td align="right" colspan="2" width="160" ><small>Pereka / Perunding:</td> 
<td align="left" colspan="6" width="640" >
<textarea name="perekaEV" cols="64" rows="1" id="perekaEV">
<?php
if ( $_SESSION['mod_kerja']=='Perunding' || $_SESSION['mod_kerja']=='Perunding DB' ){
$chkPrd=mysql_query("SELECT selectedP FROM Perunding_projek WHERE id_daftar ={$_SESSION['daftar_id']}",$db);
while ( $Prd = mysql_fetch_array($chkPrd) ) { $goodPrd = $Prd[0]; }
if ( trim($goodPrd)=='' ) { echo 'Taip nama perunding di sini.'; }else{ echo $goodPrd ; } }
else {
 echo 'PPK namakan pereka.';
 }
?>
</textarea>
</small></td> 
<td align="center" colspan="2" ><small>Pereka:<br/>
<select name="Vpereka" id="Vpereka"> 
<?php 
$bilPereka=count($perekaBKAwam)-1;	//42;
if ( $_SESSION['mod_kerja']<>'Inhouse' ){ $bilPereka= 0; }
for ($Vbka=0;$Vbka <=$bilPereka;$Vbka++) 
{ echo "<option>$perekaBKAwam[$Vbka]</option>\n";} ?> </select> 
</small></td>
</tr>

<tr> <td align="right" colspan="2" ><small>Penyemak / ICE:</td> 
<td align="left" colspan="6" >
<textarea name="penyemakEV" cols="64" rows="1" id="penyemakEV"></textarea>
</small></td> 

<td align="center" colspan="2" ><small>Penyemak:<br/>
<select name="Vpenyemak" id="Vpenyemak"> 
<?php 
for ($Vbka=0;$Vbka <=42;$Vbka++) 
{ echo "<option>$perekaBKAwam[$Vbka]</option>\n";} ?> </select> 
</small></td>

</tr>

<tr> <td align="right" colspan="2" ><small>Pelukis:</td> 
<td align="left" colspan="6" >
<textarea name="pelukisEV" cols="64" rows="1" id="pelukisEV"></textarea>
</small></td> 
<td align="center" colspan="2" ><small>Keluasan tapak ( Ha. ):<br/>
<input name="luastapakEV" type="text" id="luastapakEV" value="0.000">
</small></td>
</tr>

<tr> <td align="right" colspan="2" ><small>Peg Penguasa:</td> 
<td align="left" colspan="6" >
<textarea name="ppenguasaEV" cols="64" rows="1" id="ppenguasaEV"></textarea>
</small></td>
<td align="center" colspan="2" ><small>Kos Prelim :<br/>
<input name="kprelimEV" type="text" id="kprelimEV" value="0.00">
</small></td>
</tr>

<tr>
<td align="center" colspan="2" ><small>Trm brif&amp;lukisan</small>:
<!--------------------------------New date format----------------------------------------->
<script> DateInput( 'rekastart', false, 'YYYY-MM-DD')</script>
</small></td>
<td align="center" colspan="2" ><small>rekasiapDate: 
<!--------------------------------New date format----------------------------------------->
<script> DateInput( 'rekasiap', false, 'YYYY-MM-DD')</script>
</small></td>

<td align="center" colspan="2" ><small>tenderDate :<br/>
<!--------------------------------New date format----------------------------------------->
<script> DateInput( 'tender', false, 'YYYY-MM-DD')</script>
</small></td>
<td align="center" colspan="2" ><small>mtapakDate :<br/>
<!--------------------------------New date format----------------------------------------->
<script> DateInput( 'mtapak', false, 'YYYY-MM-DD')</script>
</small></td>
<td align="center" colspan="2" ><small>binasiapDate :<br/>
<!--------------------------------New date format----------------------------------------->
<script> DateInput( 'binasiap', false, 'YYYY-MM-DD')</script>
</small></td>
</tr>

<tr> 
<td align="center" colspan="2" ><small>hadSiling: <br/>
<input name="hadSilingEV" type="text" id="hadSilingEV" value="0.00">
</small></td>
<td align="center" colspan="2" ><small>PDA:<br/>
<input name="kpdaEV" type="text" id="kpdaEV" value="0.00">
</small></td>
<td align="center" colspan="2" ><small>ATDA:<br/>
<input name="katdaEV" type="text" id="katdaEV" value="0.00">
</small></td>
<td align="center" colspan="2" ><small>Harga Kontrak :<br/>
<input name="kkontrakEV" type="text" id="kkontrakEV" value="0.00">
</small></td>
<td align="center" colspan="2" ><small>ACDA :<br/>
<input name="kacdaEV" type="text" id="kacdaEV" value="0.00">
</small></td>
</tr>

<tr> 
<td align="right" colspan="2" ><small>Kaedah Tender:
</small></td>
<td align="center" colspan="4" ><small>
<textarea name="kaedahTEV" cols="40" rows="1" id="kaedahTEV"></textarea>
</small></td>
<td align="right" colspan="2" ><small>Bil Petender:
</small></td>
<td align="center" colspan="2" ><small>
<input name="bilPetenderEV" type="text" id="bilPetenderEV" value="0">
</small></td>
</tr>
<tr> <td align="right" colspan="2" ><small>Kontraktor:</td> 
<td align="left" colspan="6" >
<textarea name="kontraktorEV" cols="64" rows="1" id="kontraktorEV"></textarea>
</small></td>
</tr>

<tr> <td align="right" colspan="2" ><small>Catatan:</td> 
<td align="left" colspan="6" >
<textarea name="catatanEV" cols="64" rows="2" id="catatanEV"></textarea>
</small></td>
</tr>

<tr align="center"> <td colspan="10">
<input type="submit" name="Submit" value="Tambah Data"> 
<input type="button" name="Button" value="Batal Tambah" onClick="location='<?php echo $fileName.'?event=Pinda';  ?>'">
<br/><font color="gray"><small>
Username:<?php 
//echo $_SESSION['username']; 
?> &nbsp;&nbsp;<i>
Pendaftar id<small>[<?php 
//echo $_SESSION['kp_s']; 
?>]</i></small></font>
</small></td></tr> 
</table> </form> 

<?php }//}

if ($event=="Pinda")
if (!isset($_SESSION['first_name']) || !isset($_SESSION['daftar_id']) ) {echo '<center>Sila pilih satu projek dari SENARAI dan anda mesti LOGIN</center>';}
else
{$menu=1;$result=mysql_query("SELECT * FROM butiran_projek WHERE id_daftar = {$_SESSION['daftar_id']}",$db);
//$myrow=mysql_fetch_array($result);
$myrow=mysql_fetch_assoc($result);
//echo $kp_s;
if (!$myrow) {echo '<center>Belum ada butiran diupload.<br/>Klik Input.</center>';} 
else

//if ($myrow)
 { ?> 

<table width="800" border="1" align="center" cellpadding="1" cellspacing="0" bordercolor="#E4E4E4"> 
<tr bgcolor="#EBEEF5">

<td width="800" align="center" colspan = "6" bgcolor="#FDFECF" bordercolor="#EBEEF5" >
<small>TAJUK PROJEK:</small><br/><font color="darkgreen" size="2em" >
<?php echo $_SESSION['tajuk'].'</font><br/><font color="darkkhaki" size="1em">'.$_SESSION['mod_kerja'].'</font>';?> 
</td></tr> 


<?php $Bilangan = 1;
////  do start /////
do { 
if ($dateFormat==1) 
{ $first=intval(strtotime($myrow[startDate])/86400);
$start= date("m-d-Y",strtotime($myrow[startDate]));
$rekastart= date("m-d-Y",strtotime($myrow[rekastartDate]));

//$end = 1;
//$days =$end;
//------------------------------------------------------------------------------
//$sokong =$myrow[sokong];
//$sokong =$Vsokong;
}
 
if ($dateFormat==2) 
{ 
//$first=intval(strtotime($myrow[startDate])/86400);
//$start= date("Y-m-d",strtotime($myrow[startDate]));
//$rekastart= date("Y-m-d",strtotime($myrow[rekastartDate]));
} 
//----------------------------------------------
//$end = 1;
$Vbutiran = $myrow[ butiran];
$id_daftar=$myrow[id_daftar];  
$pereka=$myrow[pereka];
$penyemak=$myrow[penyemak];
$pelukis=$myrow[pelukis];
$startDate=$myrow[startDate];
$rekastartDate=$myrow[rekastartDate];
$rekasiapDate=$myrow[rekasiapDate];
$tenderDate=$myrow[tenderDate];
$mtapakDate=$myrow[mtapakDate];
$binasiapDate=$myrow[binasiapDate];
$catatan=$myrow[catatan];
$username=$myrow[username];
$kp_s=$myrow[kp_s];
//$regist_date 
$ppenguasa=$myrow[ppenguasa]; 
$hadSiling=$myrow[hadSiling];
$kpda=$myrow[kpda];
$katda=$myrow[katda];
$kkontrak=$myrow[kkontrak];
$kacda=$myrow[kacda];
$kluar=$myrow[kluar];
$ktanah=$myrow[ktanah];
$kair=$myrow[kair];
$knajis=$myrow[knajis];
$kjalan=$myrow[kjalan];
$kprelim=$myrow[kprelim];
$luastapak=$myrow[luastapak];
$bilPetender=$myrow[bilPetender];
$kaedahT=$myrow[kaedahT];
$kontraktor=$myrow[kontraktor];

$kp_s = $_SESSION['kp_s'];
$username = $_SESSION['username'];
$id_daftar = $_SESSION['daftar_id'];
////////////////////////////////////////////////////////////////////////////////////////////
/////////////////call dplan //////////
$rslt=mysql_query("SELECT startDate AS tmula , 
sketch_proposal AS sketch ,
analisa AS anal ,
rekabentuk AS reka ,
lukisan AS lukis ,
Bill_Q AS bill ,
Tender_doc AS tender ,
Design_report AS report 
FROM dplan_projek WHERE id_daftar = {$_SESSION['daftar_id']}",$db) or die(mysql_error());

		while ($proj = mysql_fetch_array ($rslt)) {
		$_SESSION['tmula'] = $proj[0];
		$_SESSION['sketch'] = $proj[1];
		$_SESSION['anal'] = $proj[2];
		$_SESSION['reka'] = $proj[3];
		$_SESSION['lukis'] = $proj[4];
		$_SESSION['bill'] = $proj[5];
		$_SESSION['tender'] = $proj[6];
		$_SESSION['report'] = $proj[7];
		}
		
if (!$proj[1]){$_SESSION['sketch'] = 1;
		$_SESSION['anal'] = 1;
		$_SESSION['reka'] = 1;
		$_SESSION['lukis'] = 1;
		$_SESSION['bill'] = 1;
		$_SESSION['tender'] = 1;
		$_SESSION['report'] = 1;}
		
		
$dplan =explode("-", $_SESSION['tmula']);
$trklapor =explode("-", $startDate);
$chktempohsifar = 0; $cts1=1;$cts2=1;$cts3=1;$cts4=1;$cts5=1;$cts6=1;$cts7=1;

//echo 'lapor:::'. $trklapor[0] .'-'. $trklapor[1] .'-'. $trklapor[2] .'<br>';

$D = $trklapor[2] ;//date("j") ; 
$M = $trklapor[1] ;//date("n") ; 
$Y = $trklapor[0] ;//date("Y") ;

$D = $trklapor[2] ; $M = $trklapor[1] ; $Y = $trklapor[0] ;
if ($D < $dplan[2] ): $D += 30 ; $M -= 1 ;
                   if ( $M = 0 ): $M = 12 ; $Y -= 1 ; endif ;
                   if ( $M = $dplan[1] ): $M = $M ; $Y = $Y ; endif ;
                   if ( $M < $dplan[1] ): $M += 12 ; $Y -= 1 ; endif ;
endif ;
$d_sketch = round((($D - $dplan[2])/7 + ($M - $dplan[1]) + ($Y - $dplan[0])*52.14285714)/$_SESSION['sketch'],3)*100 ;
//$d_sketch = round((($D - $d)/7 + ($M - $m) + ($Y - $y)*52.14285714)/$_SESSION['sketch'],3)*100 ;
?>

<tr> <td width="135" align="right"><small>Mula Rekabentuk: </small></td> 
<td width="135" align="left" class="style2"> 
<small><?php echo $dplan[2].'-'.$dplan[1].'-'.$dplan[0] ?></small>
</td> 

<?php $bar1 = ''; $pixel = $_SESSION['sketch']; $pixel1 = 0;
if ($pixel == 0){ $chktempohsifar += 0; $cts1 = 0; } else { $chktempohsifar += 1;} 
$T = $pixel ; $d = $dplan[2] ; $m = $dplan[1] ; $y = $dplan[0] ; 
$D = $trklapor[2] ; $M = $trklapor[1] ; $Y = $trklapor[0] ;
if ( $D < $d ): $D += 30 ; $M -= 1 ; $c1 = $M ; 
                   if ( $c1 === 0 ): $M = 12 ; $Y -= 1 ; endif ;
                   if ( $c1 === $m ): $M = $M ; $Y = $Y ; endif ;
                   if ( $c1 > $m ): $M = $M ; $Y = $Y ; endif ;
                   if ( $c1 < $m ): $M += 12 ; $Y -= 1 ; endif ; endif ;
if ( $D > $d || $D === $d ): $D = $D ; $c1 = $M ; 
                   if ( $c1 === $m ): $M = $M ; $Y = $Y ; endif ;
                   if ( $c1 < $m ): $M += 12 ; $Y -= 1 ; endif ; endif ;
//echo '<br/>--->chk 1>>' .$D.'-'.$M.'-'.$Y. '---chk >' .$d.'-'.$m.'-'.$y;
$d_sketch = round((($D - $d)/7 + ($M - $m)*4 + ($Y - $y)*52.14285714)/$_SESSION['sketch'],3)*100 ;
while ($T > 4 ): $m += 1; if ($m > 12):  $m -= 12; $y +=1 ;endif; $T -= 4 ; endwhile;
$m = $m; $T = $T*7 + $d; $d = $T;
while ($T > 30):$T -= 30; $d = $T; $m += 1; if ($m > 12):  $m -= 12; $y +=1 ; endif; endwhile;
for ($j=0;$j<=$pixel-1;$j++){$bar1 .=':';}   ?>

<?php $bar2 = ''; $pixel = $_SESSION['anal'] ; $pixel2 = $pixel1 + strlen($bar1) ; $T = $pixel ; 
if ($pixel == 0){ $chktempohsifar += 0; $cts2 = 0; } else { $chktempohsifar += 1;} 
$D = $trklapor[2] ; $M = $trklapor[1] ; $Y = $trklapor[0] ;
if ( $D < $d ): $D += 30 ; $M -= 1 ; $c1 = $M ; 
                   if ( $c1 === 0 ): $M = 12 ; $Y -= 1 ; endif ;
                   if ( $c1 === $m ): $M = $M ; $Y = $Y ; endif ;
                   if ( $c1 > $m ): $M = $M ; $Y = $Y ; endif ;
                   if ( $c1 < $m ): $M += 12 ; $Y -= 1 ; endif ; endif ;
if ( $D > $d || $D === $d ): $D = $D ; $c1 = $M ; 
                   if ( $c1 === $m ): $M = $M ; $Y = $Y ; endif ;
                   if ( $c1 < $m ): $M += 12 ; $Y -= 1 ; endif ; endif ;
//echo '<br/>--->chk 2>>' .$D.'-'.$M.'-'.$Y. '---chk >' .$d.'-'.$m.'-'.$y;
$d_anal = round((($D - $d)/7 + ($M - $m)*4  + ($Y - $y)*52.14285714)/ $_SESSION['anal'] ,3)*100 ;
while ($T > 4 ): $m += 1; if ($m > 12):  $m -= 12; $y +=1 ;endif; $T -= 4 ; endwhile;
$m = $m; $T = $T*7 + $d; $d = $T;
while ($T > 30):$T -= 30; $d = $T; $m += 1; if ($m > 12):  $m -= 12; $y +=1 ; endif; endwhile;
for ($j=0;$j<=$pixel-1;$j++){$bar2 .=':';}   ?> 

<?php $bar3 = ''; $pixel = $_SESSION['reka'] ; $pixel1 = $pixel2 + strlen($bar2) ; $T = $pixel ; 
if ($pixel == 0){ $chktempohsifar += 0; $cts3 = 0; } else { $chktempohsifar += 1;} 
$D = $trklapor[2] ; $M = $trklapor[1] ; $Y = $trklapor[0] ;
if ( $D < $d ): $D += 30 ; $M -= 1 ; $c1 = $M ; 
                   if ( $c1 === 0 ): $M = 12 ; $Y -= 1 ; endif ;
                   if ( $c1 === $m ): $M = $M ; $Y = $Y ; endif ;
                   if ( $c1 > $m ): $M = $M ; $Y = $Y ; endif ;
                   if ( $c1 < $m ): $M += 12 ; $Y -= 1 ; endif ; endif ;
if ( $D > $d || $D === $d ): $D = $D ; $c1 = $M ; 
                   if ( $c1 === $m ): $M = $M ; $Y = $Y ; endif ;
                   if ( $c1 < $m ): $M += 12 ; $Y -= 1 ; endif ; endif ;
//echo '<br/>--->chk 3>>' .$D.'-'.$M.'-'.$Y. '---chk >' .$d.'-'.$m.'-'.$y;
while ($T > 4 ): $m += 1; if ($m > 12):  $m -= 12; $y +=1 ;endif; $T -= 4 ; endwhile;
$m = $m; $T = $T*7 + $d; $d = $T; $y = $y ;
while ($T > 30):$T -= 30; $d = $T; $m += 1; if ($m > 12):  $m -= 12; $y +=1 ; endif; endwhile;
$d_reka = round((($D - $d)/7 + ($M - $m)*4  + ($Y - $y)*52.14285714)/ $_SESSION['reka'] ,3)*100 ;
for ($j=0;$j<=$pixel-1;$j++){$bar3 .=':';} ?> 

<?php $bar4 = ''; $pixel = $_SESSION['lukis'] ; $pixel2 = $pixel1 + strlen($bar3) ; $T = $pixel  ; 
if ($pixel == 0){ $chktempohsifar += 0; $cts4 = 0; } else { $chktempohsifar += 1;} 
$D = $trklapor[2] ; $M = $trklapor[1] ; $Y = $trklapor[0] ;
if ( $D < $d ): $D += 30 ; $M -= 1 ; $c1 = $M ; 
                   if ( $c1 === 0 ): $M = 12 ; $Y -= 1 ; endif ;
                   if ( $c1 === $m ): $M = $M ; $Y = $Y ; endif ;
                   if ( $c1 > $m ): $M = $M ; $Y = $Y ; endif ;
                   if ( $c1 < $m ): $M += 12 ; $Y -= 1 ; endif ; endif ;
if ( $D > $d || $D === $d ): $D = $D ; $c1 = $M ; 
                   if ( $c1 === $m ): $M = $M ; $Y = $Y ; endif ;
                   if ( $c1 < $m ): $M += 12 ; $Y -= 1 ; endif ; endif ;
//echo '<br/>--->chk 4>>' .$D.'-'.$M.'-'.$Y. '---chk >' .$d.'-'.$m.'-'.$y;
while ($T > 4 ): $m += 1; if ($m > 12):  $m -= 12; $y +=1 ;endif; $T -= 4 ; endwhile;
$m = $m; $T = $T*7 + $d; $d = $T;
while ($T > 30):$T -= 30; $d = $T; $m += 1; if ($m > 12):  $m -= 12; $y +=1 ; endif; endwhile;
$d_lukis = round((($D - $d)/7 + ($M - $m)*4  + ($Y - $y)*52.14285714)/ $_SESSION['lukis'] ,3)*100 ;
for ($j=0;$j<=$pixel-1;$j++){$bar4 .=':';} ?> 

<?php $bar5 = ''; $pixel = $_SESSION['bill'] ; $pixel1 = $pixel2 + strlen($bar4) ; $T = $pixel ; 
if ($pixel == 0){ $chktempohsifar += 0; $cts5 = 0; } else { $chktempohsifar += 1;} 
$D = $trklapor[2] ; $M = $trklapor[1] ; $Y = $trklapor[0] ;
if ( $D < $d ): $D += 30 ; $M -= 1 ; $c1 = $M ; 
                   if ( $c1 === 0 ): $M = 12 ; $Y -= 1 ; endif ;
                   if ( $c1 === $m ): $M = $M ; $Y = $Y ; endif ;
                   if ( $c1 > $m ): $M = $M ; $Y = $Y ; endif ;
                   if ( $c1 < $m ): $M += 12 ; $Y -= 1 ; endif ; endif ;
if ( $D > $d || $D === $d ): $D = $D ; $c1 = $M ; 
                   if ( $c1 === $m ): $M = $M ; $Y = $Y ; endif ;
                   if ( $c1 < $m ): $M += 12 ; $Y -= 1 ; endif ; endif ;
//echo '<br/>--->chk 5>>' .$D.'-'.$M.'-'.$Y. '---chk >' .$d.'-'.$m.'-'.$y;
while ($T > 4 ): $m += 1; if ($m > 12):  $m -= 12; $y +=1 ;endif; $T -= 4 ; endwhile;
$m = $m; $T = $T*7 + $d; $d = $T;
while ($T > 30):$T -= 30; $d = $T; $m += 1; if ($m > 12):  $m -= 12; $y +=1 ; endif; endwhile;
$d_bill = round((($D - $d)/7 + ($M - $m)*4  + ($Y - $y)*52.14285714)/ $_SESSION['bill'] ,3)*100 ;
for ($j=0;$j<=$pixel-1;$j++){$bar5 .=':';}   ?> 

<?php $bar6 = ''; $pixel = $_SESSION['tender'] ; $pixel2 = $pixel1 + strlen($bar5) ; $T = $pixel ; 
if ($pixel == 0){ $chktempohsifar += 0; $cts6 = 0; } else { $chktempohsifar += 1;} 
$D = $trklapor[2] ; $M = $trklapor[1] ; $Y = $trklapor[0] ;
if ( $D < $d ): $D += 30 ; $M -= 1 ; $c1 = $M ; 
                   if ( $c1 === 0 ): $M = 12 ; $Y -= 1 ; endif ;
                   if ( $c1 === $m ): $M = $M ; $Y = $Y ; endif ;
                   if ( $c1 > $m ): $M = $M ; $Y = $Y ; endif ;
                   if ( $c1 < $m ): $M += 12 ; $Y -= 1 ; endif ; endif ;
if ( $D > $d || $D === $d ): $D = $D ; $c1 = $M ; 
                   if ( $c1 === $m ): $M = $M ; $Y = $Y ; endif ;
                   if ( $c1 < $m ): $M += 12 ; $Y -= 1 ; endif ; endif ;
//echo '<br/>--->chk 6>>' .$D.'-'.$M.'-'.$Y. '---chk >' .$d.'-'.$m.'-'.$y;
while ($T > 4 ): $m += 1; if ($m > 12):  $m -= 12; $y +=1 ;endif; $T -= 4 ; endwhile;
$m = $m; $T = $T*7 + $d; $d = $T;
while ($T > 30):$T -= 30; $d = $T; $m += 1; if ($m > 12):  $m -= 12; $y +=1 ; endif; endwhile;
$d_tender = round((($D - $d)/7 + ($M - $m)*4  + ($Y - $y)*52.14285714)/ $_SESSION['tender'] ,3)*100 ;
for ($j=0;$j<=$pixel-1;$j++){$bar6 .=':';}   ?> 

<?php $bar7 = ''; $pixel = $_SESSION['report'] ; $pixel1 = $pixel2 + strlen($bar6) ; $T = $pixel ; 
if ($pixel == 0){ $chktempohsifar += 0; $cts7 = 0; } else { $chktempohsifar += 1;} 
$D = $trklapor[2] ; $M = $trklapor[1] ; $Y = $trklapor[0] ;
if ( $D < $d ): $D += 30 ; $M -= 1 ; $c1 = $M ; 
                   if ( $c1 === 0 ): $M = 12 ; $Y -= 1 ; endif ;
                   if ( $c1 === $m ): $M = $M ; $Y = $Y ; endif ;
                   if ( $c1 > $m ): $M = $M ; $Y = $Y ; endif ;
                   if ( $c1 < $m ): $M += 12 ; $Y -= 1 ; endif ; endif ;
if ( $D > $d || $D === $d ): $D = $D ; $c1 = $M ; 
                   if ( $c1 === $m ): $M = $M ; $Y = $Y ; endif ;
                   if ( $c1 < $m ): $M += 12 ; $Y -= 1 ; endif ; endif ;
//echo '<br/>--->chk 7>>' .$D.'-'.$M.'-'.$Y. '---chk >' .$d.'-'.$m.'-'.$y;
while ($T > 4 ): $m += 1; if ($m > 12):  $m -= 12; $y +=1 ;endif; $T -= 4 ; endwhile;
$m = $m; $T = $T*7 + $d; $d = $T;
while ($T > 30):$T -= 30; $d = $T; $m += 1; if ($m > 12):  $m -= 12; $y +=1 ; endif; endwhile;
$d_report = round((($D - $d)/7 + ($M - $m)*4  + ($Y - $y)*52.14285714)/ $_SESSION['report'] ,3)*100 ;
for ($j=0;$j<=$pixel-1;$j++){$bar7 .=':';}   

/*echo '<br/> kemajuan d-plan::: &nbsp;&nbsp;  '. 
' sketch '.$d_sketch .':::'.
' anal '.$d_anal .':::'.
' reka '.$d_reka .':::'.
' lukis '.$d_lukis .':::'.
' bill '.$d_bill .':::'.
' tender '.$d_tender .':::'.
' report '.$d_report .':::';*/
//echo $chktempohsifar ;

if ( $d_sketch > 100 || $d_sketch === 100 ): $d_sketch = 100 ; elseif ( $d_sketch < 0 ): $d_sketch = 0 ; else: $d_sketch = $d_sketch  ; endif ;
if ( $d_anal > 100 || $d_anal === 100 ): $d_anal = 100 ; elseif ( $d_anal < 0 ): $d_anal = 0 ; else: $d_anal = $d_anal ; endif ;
if ( $d_reka > 100 || $d_reka === 100 ): $d_reka = 100 ; elseif ( $d_reka < 0 ): $d_reka = 0 ; else: $d_reka = $d_reka ; endif ;
if ( $d_lukis > 100 || $d_lukis === 100 ): $d_lukis = 100 ; elseif ( $d_lukis < 0 ): $d_lukis = 0 ; else: $d_lukis = $d_lukis ; endif ;
if ( $d_bill > 100 || $d_bill === 100 ): $d_bill = 100 ; elseif ( $d_bill < 0 ): $d_bill = 0 ; else: $d_bill = $d_bill ; endif ;
if ( $d_tender > 100 || $d_tender === 100 ): $d_tender = 100 ; elseif ( $d_tender < 0 ): $d_tender = 0 ; else: $d_tender = $d_tender ; endif ;
if ( $d_report > 100 || $d_report === 100 ): $d_report = 100 ; elseif ( $d_report < 0 ): $d_report = 0 ; else: $d_report = $d_report ; endif ;
$d_overall = round(( $d_sketch + $d_anal + $d_reka + $d_lukis + $d_bill + $d_tender + $d_report )/$chktempohsifar,1) ;
$calc_overall = round(($sketch_proposal*$cts1 + $analisa*$cts2 + $rekabentuk*$cts3 + $lukisan*$cts4 + $Bill_Q*$cts5 + $Tender_doc*$cts6 + $Design_report*$cts7)/$chktempohsifar,1);
?> 

<td align="center" bgcolor="#FDFECF" width="260" colspan="2" > <a href="<?php echo $fileName ?>?eid=<?php echo $myrow[id] ?>"> 
<font color="#000000" size="1em">TARIKH LAPORAN:<br/><?php echo $startDate ?></font>
<img src="img/favicon.ico" border="0" margin-top="-50"> </a> </td>  

<td align="right" width="135" >
<?php echo 
'</b>&nbsp;<small> <small> '.$d.'-'.$m.'-'.$y.'</small> </td>
<td align="left" width="135" ><small>:perlu siap </small> </td> </tr> '; ?>

<tr> 
<td align="center" width="135" > 1 </td> <td align="center" width="135" > 2 </td> <td align="center" width="130" > 3 </td> <td align="center" width="130" > 4 </td> <td align="center" width="135" > 5 </td> <td align="center" width="135" > 6 </td> </tr> 

<tr> 
<td align="right"  > <font color="darkgreen" size="1em"> Pereka/Perunding </font> </td> <td colspan="5" > <font color="coral" size="2em"> <?php echo $pereka ?></font> </td> </tr> 

<tr> 
<td align="right"  > <font color="darkgreen" size="1em"> Penyemak/ICE </font> </td> <td colspan="5" > <font color="coral" size="2em"> <?php echo $penyemak ?></font> </td> </tr> 

<tr> 
<td align="right" width="135" > <font color="darkgreen" size="1em"> Pelukis </font> </td> <td colspan="5" > <font color="coral" size="2em"> <?php echo $pelukis ?></font> </td> </tr> 

<tr> 
<td align="right"  > <font color="darkgreen" size="1em"> Peg Penguasa </font> </td> <td colspan="5" > <font color="coral" size="2em"> <?php echo $ppenguasa ?></font> </td> </tr> 

<tr> 
<td align="center"  colspan="6" > <font color="darkgreen" size="2em"><small>Maklumat projek : - timeliness &amp; costs </small></font> </td> </tr> 

<tr> 
<td align="center" width="270" colspan="2" > Masa </td> <td align="center" width="260" colspan="2" > Kos kontrak </td> <td align="center" width="270" colspan="2" > Kos kerja sivil </td> </tr> 

<tr> 
<td align="right"  > <font color="darkgreen" size="1em">Trm brif&amp;lukisan :</font> </td> <td ><font color="coral" size="2em"><?php echo $rekastartDate ?></font> </td> <td align="right" > <font color="darkgreen" size="1em"> Had siling :</font> </td> <td > <font color="coral" size="2em"> <?php echo $hadSiling ?> </font>  </td> <td align="right"> <font color="darkgreen" size="1em"> Kerja saliran :</font>  </td> <td align="left" > <font color="coral" size="2em">  <?php echo $kluar ?> </font> </td> </tr> 

<tr> 
<td align="right"  > <font color="darkgreen" size="1em">Siap rekabentuk :</font> </td> <td ><font color="coral" size="2em"><?php echo $rekasiapDate ?></font> </td> <td align="right" > <font color="darkgreen" size="1em"> PDA :</font> </td> <td > <font color="coral" size="2em"> <?php echo $kpda ?> </font>  </td> <td align="right"> <font color="darkgreen" size="1em"> Kerja tanah :</font>  </td> <td align="left" > <font color="coral" size="2em">  <?php echo $ktanah ?> </font> </td> </tr> 

<tr> 
<td align="right"  > <font color="darkgreen" size="1em">Tender :</font> </td> <td ><font color="coral" size="2em"><?php echo $tenderDate ?></font> </td> <td align="right" > <font color="darkgreen" size="1em"> ATDA :</font> </td> <td > <font color="coral" size="2em"> <?php echo $katda ?> </font>  </td> <td align="right"> <font color="darkgreen" size="1em"> Kerja bekalan air :</font>  </td> <td align="left" > <font color="coral" size="2em">  <?php echo $kair ?> </font> </td> </tr> 

<tr> 
<td align="right"  > <font color="darkgreen" size="1em">Milik tapak :</font> </td> <td ><font color="coral" size="2em"><?php echo $mtapakDate ?></font> </td> <td align="right" > <font color="darkgreen" size="1em"> Kontrak :</font> </td> <td > <font color="coral" size="2em"> <?php echo $kkontrak ?> </font>  </td> <td align="right"> <font color="darkgreen" size="1em"> Kerja pembetungan :</font>  </td> <td align="left" > <font color="coral" size="2em">  <?php echo $knajis ?> </font> </td> </tr> 

<tr> 
<td align="right"  > <font color="darkgreen" size="1em">Sambung masa :</font> </td> <td ><font color="coral" size="2em"><?php echo $sambungDate.'x rekod' ?></font> </td> <td align="right" > <font color="darkgreen" size="1em"> ACDA :</font> </td> <td > <font color="coral" size="2em"> <?php echo $kacda ?> </font>  </td> <td align="right"> <font color="darkgreen" size="1em"> Kerja jalan dalaman:</font>  </td> <td align="left" > <font color="coral" size="2em">  <?php echo $kjalan ?> </font> </td> </tr> 

<tr> 
<td align="right"  > <font color="darkgreen" size="1em">Siap bina :</font> </td> <td ><font color="coral" size="2em"><?php echo $binasiapDate ?></font> </td> <td align="right" > <font color="darkgreen" size="1em"> Prelim :</font> </td> <td > <font color="coral" size="2em"> <?php echo $kprelim ?> </font>  </td> <td align="right"> <font color="darkgreen" size="1em"> Keluasan tapak :</font>  </td> <td align="left" > <font color="coral" size="2em">  <?php echo $luastapak.' Ha' ?> </font> </td> </tr> 

<tr> 
<td align="right"  > <font color="darkgreen" size="1em"> Kaedah Tender </font> </td> <td colspan="3" > <font color="coral" size="2em"> <?php echo $kaedahT ?></font> </td><td align="right" colspan="1"  > <font color="darkgreen" size="1em"> Bilangan Petender </font> </td> <td colspan="1" > <font color="coral" size="2em"> <?php echo $bilPetender ?></font> </td> </tr> 

<tr> 
<td align="right"  > <font color="darkgreen" size="1em"> Kontraktor </font> </td> <td colspan="5" > <font color="coral" size="2em"> <?php echo $kontraktor ?></font> </td> </tr> 

<tr> <td align="left" colspan="6"><font color="darkgreen" size="1em"><?php echo 'CATATAN::  '.$startDate.'</font> <br/> <font color="coral" size="2em">'.$catatan ; ?></font> </td></tr> 

<?php } 
while ($myrow=mysql_fetch_array($result));?>
</table> <br> 
<?php } } 
if ($eid) 
{ $menu=1;$result=mysql_query("SELECT * FROM butiran_projek WHERE id='$eid'",$db);
$myrow=mysql_fetch_array($result);
$dates=explode("-",$myrow[startDate]);
$datesiap=explode("-",$myrow[siapDate]);


?> 
<?php //$dates0=explode("-",$myrow[siapDate]);?> 

<form name="form1" method="post" action="<?php echo $fileName ?>">
<div align="center"> 
<table width="800" border="1" align="center" cellpadding="1" cellspacing="0" bordercolor="#FDFECF" bgcolor= "#EBEEF5" > 
 
<tr> <td width="160" align="right" colspan="2" ><small>Tarikh input:</small>
<!--------------------------------New date format----------------------------------------->
<script> DateInput( 'start', true, 'YYYY-MM-DD'<?php if ($myrow[startDate]=='0000-00-00'){echo '';}else
echo ",'".$myrow[startDate]."'" ;?>)
</script>
</td>
<td align="center" colspan="8" width="640">
<small>TAJUK PROJEK:</small><br/><font color="darkgreen" size="4em" >
<?php echo $_SESSION['tajuk'].'</font><br/><font color="darkkhaki" size="1em">'.$_SESSION['mod_kerja'].'</font>';?> 
</td></tr>

<tr> <td align="center" colspan="2" width="160" ><small>&nbsp; Kos kerja Saliran:<br/>
<input name="kluarEV" type="text" id="kluarEV" value="<?php echo $myrow[kluar];?>">
</small></td>
<td align="center" colspan="2" width="160" ><small>Kos kerja Tanah:<br/>
<input name="ktanahEV" type="text" id="ktanahEV" value="<?php echo $myrow[ktanah];?>">
</small></td>
<td align="center" colspan="2" width="160" ><small>Kos kerja Bekalan Air:<br/>
<input name="kairEV" type="text" id="kairEV" value="<?php echo $myrow[kair];?>">
</small></td>
<td align="center" colspan="2" width="160" ><small>Kos kerja Pembetungan:<br/>
<input name="knajisEV" type="text" id="knajisEV" value="<?php echo $myrow[knajis];?>">
</small></td>
<td align="center" colspan="2" width="160" ><small>Kos kerja Jalan Dalaman:<br/>
<input name="kjalanEV" type="text" id="kjalanEV" value="<?php echo $myrow[kjalan];?>">
</small></td>
</tr>

<tr> <td align="right" colspan="2" width="160" ><small>PEREKA/PERUNDING<br>(input:PPK shj):</small></td> 
<td align="left" colspan="6" width="640" >
<textarea name="perekaEV" cols="64" rows="1" id="perekaEV">
<?php echo $myrow[pereka];?>
</textarea>
</small></td>

<td align="center" colspan="2" ><small>Pereka:<br/>
<?php
$userON=superusers($_SESSION['first_name'],$_SESSION['username'],$_SESSION['kp_s']);
if (isset($_SESSION['first_name']) && $userON=='true') 

{ ?>

<select name="Vpereka" id="Vpereka"> 
<?php 
$perekaTemp=$myrow[pereka];
$Vpereka=$perekaTemp;
$bilPereka = count($perekaBKAwam)-1;	//42;
if ( $_SESSION['mod_kerja']=='Perunding' || $_SESSION['mod_kerja']=='Perunding DB' ){ $bilPereka = 0; }
for ($Vbka=0;$Vbka <=$bilPereka ;$Vbka++) 
{ echo "<option";
if ($perekaBKAwam[$Vbka]==$perekaTemp){ echo " SELECTED";} 
echo ">$perekaBKAwam[$Vbka]</option>\n";} ?> </select>
</small>
<?php } 
else 
{ echo '<b>'.$myrow[pereka].'</b>'; }
?>



</td>

</tr>

<tr> <td align="right" colspan="2" ><small>PENYEMAK / ICE:<br>(input:PPK shj)</td> 
<td align="left" colspan="6" >
<textarea name="penyemakEV" cols="64" rows="1" id="penyemakEV"><?php echo $myrow[penyemak];?></textarea>
</small></td> 

<td align="center" colspan="2" ><small>Penyemak:<br/>
<?php
$userON=superusers($_SESSION['first_name'],$_SESSION['username'],$_SESSION['kp_s']);
if (isset($_SESSION['first_name']) && $userON=='true') 

{ ?>
<select name="Vpenyemak" id="Vpenyemak"> 
<?php 
$penyemakTemp=$myrow[penyemak];
$Vpenyemak=$penyemakTemp;
$bilPenyemak =  count($perekaBKAwam)-1;	//42;
for ($Vbka=0;$Vbka <=$bilPenyemak;$Vbka++) 
{ echo "<option";
if ($perekaBKAwam[$Vbka]==$penyemakTemp){ echo " SELECTED";} 

echo ">$perekaBKAwam[$Vbka]</option>\n";} 

 ?> </select>
</small>
<?php } 
else 
{ echo '<b>'.$myrow[penyemak].'</b>'; }

?>
</td>

</tr>

<tr> <td align="right" colspan="2" ><small>Pelukis:</td> 
<td align="left" colspan="6" >
<textarea name="pelukisEV" cols="64" rows="1" id="pelukisEV"><?php echo $myrow[pelukis];?></textarea>
<td align="center" colspan="2" ><small>Keluasan tapak ( Ha. ):<br/>
<input name="luastapakEV" type="text" id="luastapakEV" value="<?php echo $myrow[luastapak];?>">
</small></td>
</small></td> 
</tr>

<tr> <td align="right" colspan="2" ><small>Peg Penguasa:</td> 
<td align="left" colspan="6" >
<textarea name="ppenguasaEV" cols="64" rows="1" id="ppenguasaEV"><?php echo $myrow[ppenguasa];?></textarea>
</small></td>
<td align="center" colspan="2" ><small>Kos Prelim :<br/>
<input name="kprelimEV" type="text" id="kprelimEV" value="<?php echo $myrow[kprelim];?>">
</small></td>
</tr>


<tr>
<td align="center" colspan="2" ><small>Trm brif&amp;lukisan</small>:<br/>
<!--------------------------------New date format----------------------------------------->
<script> DateInput( 'rekastart', false, 'YYYY-MM-DD'<?php if ($myrow[rekastartDate]=='0000-00-00'){echo '';}else
echo ",'".$myrow[rekastartDate]."'" ;?>)
</script></small></td>


<td align="center" colspan="2" ><small>rekasiapDate:<br/>
<!--------------------------------New date format----------------------------------------->
<script> DateInput( 'rekasiap', false, 'YYYY-MM-DD'<?php if ($myrow[rekasiapDate]=='0000-00-00'){echo '';}else
echo ",'".$myrow[rekasiapDate]."'" ;?>)
</script></small></td>

<td align="center" colspan="2" ><small>tenderDate:<br/>
<!--------------------------------New date format----------------------------------------->
<script> DateInput( 'tender', false, 'YYYY-MM-DD'<?php if ($myrow[tenderDate]=='0000-00-00'){echo '';}else
echo ",'".$myrow[tenderDate]."'" ;?>)
</script></small></td>

<td align="center" colspan="2" ><small>mtapakDate:<br/>
<!--------------------------------New date format----------------------------------------->
<script> DateInput( 'mtapak', false, 'YYYY-MM-DD'<?php if ($myrow[mtapakDate]=='0000-00-00'){echo '';}else
echo ",'".$myrow[mtapakDate]."'" ;?>)
</script></small></td>

<td align="center" colspan="2" ><small>binasiapDate:<br/>
<!--------------------------------New date format----------------------------------------->
<script> DateInput( 'binasiap', false, 'YYYY-MM-DD'<?php if ($myrow[binasiapDate]=='0000-00-00'){echo '';}else
echo ",'".$myrow[binasiapDate]."'" ;?>)
</script></small></td>

</tr>

<tr> 
<td align="center" colspan="2" ><small>hadSiling: <br/>
<input name="hadSilingEV" type="text" id="hadSilingEV" value="<?php echo $myrow[hadSiling];?>">
</small></td>
<td align="center" colspan="2" ><small>PDA:<br/>
<input name="kpdaEV" type="text" id="kpdaEV" value="<?php echo $myrow[kpda];?>">
</small></td>
<td align="center" colspan="2" ><small>ATDA:<br/>
<input name="katdaEV" type="text" id="katdaEV" value="<?php echo $myrow[katda];?>">
</small></td>
<td align="center" colspan="2" ><small>Harga Kontrak :<br/>
<input name="kkontrakEV" type="text" id="kkontrakEV" value="<?php echo $myrow[kkontrak];?>">
</small></td>
<td align="center" colspan="2" ><small>ACDA :<br/>
<input name="kacdaEV" type="text" id="kacdaEV" value="<?php echo $myrow[kacda];?>">
</small></td>
</tr>


<tr> 
<td align="right" colspan="2" ><small>Kaedah Tender:
</small></td>
<td align="left" colspan="4" >
<textarea name="kaedahTEV" cols="40" rows="1" id="kaedahTEV"><?php echo $myrow[kaedahT];?></textarea>
</td>
<td align="right" colspan="2" ><small>Bilangan Petender:
</small></td>
<td align="center" colspan="2" >
<input name="bilPetenderEV" type="text" id="bilPetenderEV" value="<?php echo $myrow[bilPetender];?>">
</td>
</tr>

<tr> <td align="right" colspan="2" ><small>Kontraktor:</td> 
<td align="left" colspan="8" >
<textarea name="kontraktorEV" cols="64" rows="1" id="kontraktorEV"><?php echo $myrow[kontraktor];?></textarea>
</small></td>
</tr>

<tr> <td align="right" colspan="2" ><small>Catatan:</td> 
<td align="left" colspan="8" >
<textarea name="catatanEV" cols="64" rows="2" id="catatanEV"><?php echo $myrow[catatan];?></textarea>
</small></td>
</tr>

<tr align="center">
<td colspan="10" ><input type="submit" name="Submit" value="Pinda Data"> 
<input type="button" name="Button" value="Batal Pindaan" onClick="location='<?php echo $fileName.'?event=Pinda';  ?>'">
<br/><font color="gray"><small>
Username:<?php 
//echo $_SESSION['username']; 
?> &nbsp;&nbsp;<i>
Pendaftar id<small>[<?php 
//echo $_SESSION['kp_s']; 
?>]</i></small></font>
<?php 

// set superuser
if (isset($_SESSION['first_name']) && (	
	($_SESSION['first_name']=='Wan Sohaimi' && $_SESSION['username']=='wans') || 
	 $_SESSION['kp_s']=='590803-10-6312' || 
	 $_SESSION['kp_s']=='640212-01-5729' ||

	 $_SESSION['kp_s']=='600306-02-5278' || 
	 $_SESSION['kp_s']=='611121-03-5422' || 
	 $_SESSION['kp_s']=='630425-01-5045' || 
	 $_SESSION['kp_s']=='731008-01-6709')) 
{ // do nothing 
 } else { ?>
<input name="Vpenyemak" type="hidden" id="Vpenyemak" value="<?php echo $myrow[penyemak] ?>"> 
<input name="Vpereka" type="hidden" id="Vpereka" value="<?php echo $myrow[pereka] ?>"> 
<?php } ?>

<input name="id" type="hidden" id="id" value="<?php echo $myrow[id] ?>"></td></tr> 
<input name="id_daftar" type="hidden" id="id_daftar" value="<?php echo $myrow[id_daftar] ?>"> 
<!----------------->
<!--tr>
<td width="650" align="center" colspan="2"><small><i> 
Username :<textarea name="usernameEV" cols="17" rows="1" id="usernameEV"><?php 
//echo $myrow[username]; 
?></textarea>
Pendaftar id :<font color="green">[<?php 
//echo $myrow[kp_s] ; 
?>]</font>
</small>
</td></tr--> 
</table> </form> 

<center><small>[ 
<a href="<?php echo "$fileName?del=$myrow[id]";?>" onCLick="return confirmDelete();"><small>Padam Data</small></a> ] </small>
<br> <br> </center> 
<?php } 

// set superuser
$userON=superusers($_SESSION['first_name'],$_SESSION['username'],$_SESSION['kp_s']);
if (isset($_SESSION['first_name']) && $userON=='true') 

{

if ($del) { $menu=1;$delsql="DELETE from butiran_projek WHERE id='$del';";$delresult=mysql_query($delsql);
echo "<center>Data telah dipadamkan !</center><br>";} 
}

if ($Submit=="Pinda Data"){ $menu=1;


$id_daftar=$id_daftar; 
if ($Vpereka<>"Perunding" )
				{ $pereka= $Vpereka;  $perekaEV=$Vpereka  ; }

if ($Vpenyemak<>"Perunding" )  
				{ $penyemak= $Vpenyemak;  $penyemakEV=$Vpenyemak  ; }



if ( ( str_word_count(trim($perekaEV))<3 ) && ($_SESSION['mod_kerja']=='Perunding' || $_SESSION['mod_kerja']=='Perunding DB')) { 
$chkPrd=mysql_query("SELECT selectedP FROM Perunding_projek WHERE id_daftar = {$_SESSION['daftar_id']}",$db);
while ( $Prd = mysql_fetch_array($chkPrd) ) { $goodPrd = $Prd[0]; }
if ( str_word_count(trim($goodPrd))<3 ) { echo '<center><font color="red" size="1em">Lengkapkan info Perunding !</font></center>'; }else{ $perekaEV=$goodPrd ; } }


$pereka= $perekaEV;  
$penyemak= $penyemakEV;  

$pelukis=$pelukisEV;  
$startDate=$start;
$rekastartDate=$rekastart;
$rekasiapDate=$rekasiap;
$tenderDate=$tender;
$mtapakDate=$mtapak;
$binasiapDate=$binasiap;
$catatan=$catatanEV; 
$username=$usernameEV; 
$kp_s=$kp_sEV;
//$regist_date 
$ppenguasa=$ppenguasaEV; 
$hadSiling=$hadSilingEV; 
$kpda=$kpdaEV; 
$katda=$katdaEV; 
$kkontrak=$kkontrakEV; 
$kacda=$kacdaEV; 
$kluar=$kluarEV; 
$ktanah=$ktanahEV; 
$kair=$kairEV; 
$knajis=$knajisEV; 
$kjalan=$kjalanEV; 
$kprelim=$kprelimEV; 
$luastapak=$luastapakEV;
$bilPetender=$bilPetenderEV;
$kaedahT=$kaedahTEV;
$kontraktor=$kontraktorEV;


$Vid_daftar=$id_daftarEV;  
$Vpereka=$perekaEV;  
$Vpenyemak=$penyemakEV;  
$Vpelukis=$pelukisEV;  
$startDate=$start;
$rekastartDate=$rekastart;
$rekasiapDate=$rekasiap;
$tenderDate=$tender;
$mtapakDate=$mtapak;
$binasiapDate=$binasiap;
$Vcatatan=$catatanEV; 
$Vusername=$usernameEV; 
$Vkp_s=$kp_sEV;
//$regist_date 
$Vppenguasa=$ppenguasaEV;
$VhadSiling=$hadSilingEV;
$Vkpda=$kpdaEV; 
$Vkatda=$katdaEV; 
$Vkkontrak=$kkontrakEV; 
$Vkacda=$kacdaEV; 
$Vkluar=$kluarEV; 
$Vktanah=$ktanahEV; 
$Vkair=$kairEV; 
$Vknajis=$knajisEV; 
$Vkjalan=$kjalanEV; 
$Vkprelim=$kprelimEV; 
$Vluastapak=$luastapakEV; 
$VbilPetender=$bilPetenderEV; 
$VkaedahT=$kaedahTEV; 
$Vkontraktor=$kontraktorEV; 


?> 

<form name="form2" method="post" action="<?php echo $fileName ?>">
<div align="center"> 
<table width="800" border="1" align="center" cellpadding="1" cellspacing="0" bordercolor="#00ff00" bgcolor= "#EBEEF5" > 
 
<tr> <td width="160" align="right" colspan="2" ><small>Tarikh input: 
<br/><?php echo $startDate ?> </small></td>
<td align="center" colspan="8" width="640">
<small>TAJUK PROJEK:</small><br/><font color="darkgreen" size="2em" >
<?php echo $_SESSION['tajuk'].'</font><br/><font color="darkkhaki" size="1em">'.$_SESSION['mod_kerja'].'</font>';?> 
</td></tr>

<tr> <td align="center" colspan="2" width="160"><small><span>Kos kerja Saliran:</span><br/>
#<?php echo $Vkluar ?>
</small></td>
<td align="center" colspan="2" width="160" ><small>Tanah:<br/>
#<?php echo $Vktanah ?>
</small></td>
<td align="center" colspan="2" width="160" ><small>Bekalan Air:<br/>
#<?php echo $Vkair ?>
</small></td>
<td align="center" colspan="2" width="160" ><small>Pembetungan:<br/>
#<?php echo $Vknajis ?>
</small></td>
<td align="center" colspan="2" width="160" ><small>Jalan Dalaman:<br/>
#<?php echo $Vkjalan ?>
</small></td>
</tr>

<tr> <td align="right" colspan="2" width="160" ><small>Pereka/Perunding:</td> 
<td align="left" colspan="6" width="480" ><small>
#<?php echo $Vpereka ?><small>
</small></td> 
<td align="center" colspan="2" ><small>Luas tapak:<br/>
#<?php echo $Vluastapak ?><small>
Ha.</small></td>
</tr>

<tr> <td align="right" colspan="2" ><small>Penyemak/ICE:</td> 
<td align="left" colspan="8" ><small>
#<?php echo $Vpenyemak ?>
</small></td> 
</tr>

<tr> <td align="right" colspan="2" ><small>Pelukis:</td> 
<td align="left" colspan="8" ><small>
#<?php echo $Vpelukis ?>
</small></td> 
</tr>
<tr> <td align="right" colspan="2" ><small>Peg Penguasa:</td> 
<td align="left" colspan="6" >
#<?php echo $Vppenguasa ?>
</small></td>
<td align="center" colspan="2" ><small>Prelim:<br/>
#<?php echo $Vkprelim ?>
</small></td>
</tr>

<tr>
<td align="center" colspan="2" ><small>brif&amp;lukisanDate:</small>
<br/> #<?php echo $rekastartDate ?>
</small></td>
<td align="center" colspan="2" ><small>rekasiapDate: 
<br/> #<?php echo $rekasiapDate ?>
</small></td>
<td align="center" colspan="2" ><small>tenderDate:
<br/> #<?php echo $tenderDate ?>
</small></td>
<td align="center" colspan="2" ><small>mtapakDate:
<br/> #<?php echo $mtapakDate ?>
</small></td>
<td align="center" colspan="2" ><small>binasiapDate:
<br/> #<?php echo $binasiapDate ?>
</small></td>
</tr>

<tr> 
<td align="center" colspan="2" ><small>hadSiling: <br/>
#<?php echo $VhadSiling ?>
</small></td>
<td align="center" colspan="2" ><small>PDA:<br/>
#<?php echo $Vkpda ?>
</small></td>
<td align="center" colspan="2" ><small>ATDA:<br/>
#<?php echo $Vkatda ?>
</small></td>
<td align="center" colspan="2" ><small>Kontrak:<br/>
#<?php echo $Vkkontrak ?>
</small></td>
<td align="center" colspan="2" ><small>ACDA:<br/>
#<?php echo $Vkacda ?>
</small></td>
</tr>

<tr> <td align="right" colspan="2" ><small>Kaedah Tender:</td> 
<td align="left" colspan="4" >
#<?php echo $VkaedahT ?>
</small></td>
<td align="center" colspan="2" ><small>BilPetender:</td><td align="left" colspan="2" >
#<?php echo $VbilPetender ?>
</small></td>
</tr>

<tr> <td align="right" colspan="2" ><small>Kontraktor:</td> 
<td align="left" colspan="8" >
#<?php echo $Vkontraktor ?>
</small></td>
</tr>
<tr> <td align="right" colspan="2" ><small>Catatan:</td> 
<td align="left" colspan="8" >
#<?php echo $Vcatatan ?>
</small></td>
</tr>


<tr align="center"> <td colspan="10">
<input type="submit" name="Submit" value="Simpan Pindaan"> 
<input type="button" name="Button" value="Pinda" onClick="history.back();"> 
<input type="button" name="Button" value="Batal Pindaan" onClick="location='<?php echo $fileName.'?event=Pinda';  ?>'">
<br/><font color="gray"> <i><small>Pendaftar id<small>[<?php 
//echo $_SESSION['kp_s']; 
?>]</small></small></i></font> 
<input name="id" type="hidden" id="id" value="<?php echo $id ?>"> 
 
<input name="id_daftar" type="hidden" id="id_daftar" value="<?php echo $_SESSION['daftar_id'] ?>"> 
<input name="pereka" type="hidden" id="pereka" value="<?php echo $pereka ?>">
<input name="penyemak" type="hidden" id="penyemak" value="<?php echo $penyemak ?>">
<input name="pelukis" type="hidden" id="pelukis" value="<?php echo $pelukis ?>">
<input name="start" type="hidden" id="start" value="<?php echo $start ?>">
<input name="rekastart" type="hidden" id="rekastart" value="<?php echo $rekastart ?>">
<input name="rekasiap" type="hidden" id="rekasiap" value="<?php echo $rekasiap ?>">
<input name="tender" type="hidden" id="tender" value="<?php echo $tender ?>">
<input name="mtapak" type="hidden" id="mtapak" value="<?php echo $mtapak ?>">
<input name="binasiap" type="hidden" id="binasiap" value="<?php echo $binasiap ?>">
<input name="catatan" type="hidden" id="catatan" value="<?php echo $catatan ?>">
<input name="username" type="hidden" id="username" value="<?php echo $_SESSION['username'] ?>">
<input name="kp_s" type="hidden" id="kp_s" value="<?php echo $kp_s ?>">
<!-- regist_date -->
<input name="ppenguasa" type="hidden" id="ppenguasa" value="<?php echo $ppenguasa ?>">  
<input name="hadSiling" type="hidden" id="hadSiling" value="<?php echo $hadSiling ?>"> 
<input name="kpda" type="hidden" id="kpda" value="<?php echo $kpda?>"> 
<input name="katda" type="hidden" id="katda" value="<?php echo $katda?>"> 
<input name="kkontrak" type="hidden" id="kkontrak" value="<?php echo $kkontrak?>"> 
<input name="kacda" type="hidden" id="kacda" value="<?php echo $kacda?>">
<input name="kluar" type="hidden" id="kluar" value="<?php echo $kluar?>">
<input name="ktanah" type="hidden" id="ktanah" value="<?php echo $ktanah?>">
<input name="kair" type="hidden" id="kair" value="<?php echo $kair?>">
<input name="knajis" type="hidden" id="knajis" value="<?php echo $knajis?>">
<input name="kjalan" type="hidden" id="kjalan" value="<?php echo $kjalan?>">
<input name="kprelim" type="hidden" id="kprelim" value="<?php echo $kprelim?>">
<input name="luastapak" type="hidden" id="luastapak" value="<?php echo $luastapak?>">
<input name="bilPetender" type="hidden" id="bilPetender" value="<?php echo $bilPetender?>">
<input name="kaedahT" type="hidden" id="kaedahT" value="<?php echo $kaedahT?>">
<input name="kontraktor" type="hidden" id="kontraktor" value="<?php echo $kontraktor?>">



</td> </tr> 
</table> </form>

<?php } 
if ($Submit=="Simpan Pindaan") 
{ $menu=1;
$Bilangan=$end;
if ($bilPetender<=1){$bilPetender=1;}
//$catatan = htmlspecialchars($Vcatatan,ENT_QUOTES);
//$keputusan = htmlspecialchars($Vkeputusan,ENT_QUOTES);
//$pereka = htmlspecialchars($Vpereka,ENT_QUOTES);
//$butiran = htmlspecialchars($Vbutiran,ENT_QUOTES);
//$isu = htmlspecialchars($Visu,ENT_QUOTES);
//$tajuk = htmlspecialchars($Vtajuk,ENT_QUOTES);

//$id_daftar = $Vid_daftar;
//$peratus = $Vperatus;
//$startDate=date("Y-m-d",$start);
//$rekastartDate=date("Y-m-d",$rekastart);
//echo $_SESSION['daftar_id'] .'---session id';

//$username = $Vusername;
//$kp_s = $kp_s;
//echo $id.'---id----';
//----------------------------------------- 
$sql="UPDATE butiran_projek SET  
id_daftar='$id_daftar',pereka='$pereka',penyemak='$penyemak',pelukis='$pelukis',ppenguasa='$ppenguasa',
startDate='$start',rekastartDate='$rekastart',rekasiapDate='$rekasiap',tenderDate='$tender',mtapakDate='$mtapak',binasiapDate='$binasiap',
catatan='$catatan',username='$username',kp_s='$kp_s',hadSiling='$hadSiling',kpda='$kpda',katda='$katda',kkontrak='$kkontrak',kacda='$kacda',
kluar='$kluar',ktanah='$ktanah',kair='$kair',knajis='$knajis',kjalan='$kjalan',kprelim='$kprelim',luastapak='$luastapak',kaedahT='$kaedahT',bilPetender='$bilPetender',kontraktor='$kontraktor' WHERE id='$id';";

$result=mysql_query($sql); 
if (!$result) {
die('<center>Data tidak dikemaskini :  ' . mysql_error().'<br>Pengesan error .');
  } else



{echo "<center>Telah dikemaskini. Masuk sesi baru jika klik 'semak'.</center><br>";
	ob_end_clean(); // Delete the buffer.		
	header ("Location:  http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/projek_butiran.php?event=Pinda");
	exit();}}

if ($menu!=1) 
{ $count=mysql_query("SELECT COUNT(*) FROM butiran_projek WHERE id_daftar = '{$_SESSION['daftar_id']}'");$count=mysql_fetch_array($count);
$count=$count[0];echo "<div align=\"center\">--JUMLAH DATA:<b>$count</b>--PROJEK NO:<b>{$_SESSION['daftar_id']}</b>--</div><br>";} 
?>
<div align="center">

</div> 
<br> 
<?php // Include the HTML footer file.
include_once ('html/footer.htm');
?>

