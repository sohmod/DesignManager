<?php 
$page_title = 'daftar';
include_once ('html/header.htm');
// Welcome the user (by name if they are logged in).
if (isset($_SESSION['first_name'])) {

echo "&nbsp;&nbsp;<i> log: {$_SESSION['first_name']} </i></small></center></fieldset>";
}
else
{ echo "</small></center></fieldset>"; }

require ("inc/projek_daftar_cfg.php");
require_once ('mysql_connect.php'); // Connect to the database.
		$q = "select tajuk, OIC AS ppk, mod_kerja, kp_s AS IDpendaftar from daftar_projek 
			where daftar_id = {$_GET['eid']} ";
		$r = mysql_query ($q);
		while ($tna = mysql_fetch_array ($r)) {
		$_SESSION['tajuk'] = $tna[0];
		$_SESSION['ppk'] = $tna[1];
		$_SESSION['mod_kerja'] = $tna[2];		
		$_SESSION['IDpendaftar'] = $tna[3];

		$_SESSION['daftar_id'] = $_GET['eid']; }

$db=@mysql_connect($dbHost,$dbUserLogin,$dbPassword) or $error=(mysql_error()."<br>");
@mysql_select_db($dbName,$db) or $error=(mysql_error());

if ($error) {
echo "<font color=red> There was an error connecting to the mySQL database.</font><br><br>";
echo "Please check the database settings in the '??' file and try again.<br><br>";
echo "The error was reported as:<br>$error";exit;}
?>
<!------------------------------new date format--------------------------->
<script type="text/javascript" src="jasoncalendar/calendarDateInput.js"></script>



 <!--title> Konsol Pendaftaran Projek </title-->
 <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1">
 <style type="text/css">
 a:link { text-decoration:none ; font-size:12px; font-weight:normal }
 a:visited { text-decoration:none ; font-size:12px; font-weight:normal }
 a:hover { text-decoration:underline ; font-size:12px; font-weight:normal;
	 background: #00ff00 url(html/images/favicon.ico) no-repeat center; }
 body { font-family:Verdana,Arial,Helvetica,sans-serif;font-size:12px; } 
 //background: white url(../bground/gn_cloth.jpg);// no-repeat top right; 
 .style8 {color:#CCCFFF;font-size:12px; font-weight:light } > 
 </style>


<script language="JavaScript" type="text/JavaScript"> 
function confirmDelete() 
{ return (confirm('Adakah anda pasti untuk hapuskan data ini? Pelupusan ini kekal dan tiada pemulihan!'));} 
</script>

</head>

<body> 
<div > 
<table align="center" width="800">
<div align="center"><span>
Konsol Pen<b>daftar</b>an jobNo: <?php echo '<b>'.$_SESSION['daftar_id'].'</b>';?>
</span></div>

<div align="center"><span>
<a href="<?php echo "$fileName?event=add";?>">Projek Baru</a>
<a href="<?php echo "$fileName?event=Pinda";?>"><img src="img/favicon.ico" border="0" margin-top="-50" alt="java duke!"> 
Semak & Pinda</a>
</span></div>
<div align="center"><span>
<!--a href="<?php echo "projek_daftar.php";?>"-->Daftar<!--/a--> |
<a href="<?php echo "projek_Dplan.php?event=Pinda";?>">D-Plan</a> |
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
echo ' | <a href="Laporan_bulanan.php">Carian</a>' ;
echo ' | <a href="../_bka/borehole/index.php" style="text-decoration:none" >D.Borehole</a>' ;
}
?>
</span></div>
</table>
</div>

<?php 
$pv=explode(".",phpversion());
$pv=$pv[0].".".$pv[1];
$pv=$pv-4.1;
if ($pv>=0) 
{ 
$ChooseProj=$_REQUEST["ChooseProj"];
$ListAll=$_REQUEST["ListAll"];
$Submit=$_REQUEST["Submit"];
$event=$_REQUEST["event"];
$month=$_REQUEST["month"];
$day=$_REQUEST["day"];
$year=$_REQUEST["year"];
$end=$_REQUEST["end"];
$eventLength=$_REQUEST["eventLength"];
$eid=$_REQUEST["eid"];
$del=$_REQUEST["del"];
$daftar_id=$_REQUEST["daftar_id"]; //idx

$username =$_REQUEST["username"]; 
$tajuk=$_REQUEST["tajuk"]; 
$lokasi =$_REQUEST["lokasi"]; 
$mod_kerja =$_REQUEST["mod_kerja"];
$OIC =$_REQUEST["OIC"]; 
$start =$_REQUEST["start"]; 
$siap =$_REQUEST["siap"]; 
$kp_s =$_REQUEST["kp_s"]; 
//registration_date
$program=$_REQUEST["program"];
$catatan=$_REQUEST["catatan"];
$nosiri_fail=$_REQUEST["nosiri_fail"];
$birth_date=$_REQUEST["birth_date"];
$KemKlient =$_REQUEST["KemKlient"];
$no_bpks=$_REQUEST["no_bpks"];   // catatan -->> no_bpks
$skop_kerja =$_REQUEST["skop_kerja"];  // mod_kerja -->> skop_kerja

$usernameEV =$_REQUEST["usernameEV"]; 
$tajukEV=$_REQUEST["tajukEV"]; 
$lokasiEV =$_REQUEST["lokasiEV"]; 
$mod_kerjaEV =$_REQUEST["mod_kerjaEV"];
$OICEV =$_REQUEST["OICEV"]; 
$startEV =$_REQUEST["startEV"];
$siapEV =$_REQUEST["siapEV"];
$kp_sEV =$_REQUEST["kp_sEV"]; 
//registration_date
$programEV=$_REQUEST["programEV"];
$catatanEV=$_REQUEST["catatanEV"];
$nosiri_failEV=$_REQUEST["nosiri_failEV"];
$birth_dateEV=$_REQUEST["birth_dateEV"];
$KemKlientEV =$_REQUEST["KemKlientEV"];
$no_bpksEV=$_REQUEST["no_bpksEV"];
$skop_kerjaEV =$_REQUEST["skop_kerjaEV"];

$Vusername =$_REQUEST["Vusername"]; 
$Vtajuk=$_REQUEST["Vtajuk"]; 
$Vlokasi =$_REQUEST["Vlokasi"]; 
$Vmod_kerja =$_REQUEST["Vmod_kerja"];
$VOIC =$_REQUEST["VOIC"]; 
$Vstart=$_REQUEST["Vstart"]; 
$Vsiap=$_REQUEST["Vsiap"]; 
$Vkp_s =$_REQUEST["Vkp_s"]; 
//registration_date
$Vprogram=$_REQUEST["Vprogram"];
$Vcatatan=$_REQUEST["Vcatatan"];
$Vnosiri_fail=$_REQUEST["Vnosiri_fail"];
$Vbirth_date=$_REQUEST["Vbirth_date"];
$VKemKlient =$_REQUEST["VKemKlient"];
$Vno_bpks=$_REQUEST["Vno_bpks"];
$Vskop_kerja =$_REQUEST["Vskop_kerja"];
}
//echo 'programEV '.$programEV.'<br>OICEV '.$OICEV.'<br>lokasiEV '.$lokasiEV.'<br>mod_kerjaEV '.$mod_kerjaEV ;
//echo '<br><br>kp_s '.$_SESSION['kp_s'].'<br>IDpendaftar '.$_SESSION['IDpendaftar'];


if ($Submit=="Projek Baru") { 



$menu=1;
if ($tajukEV=="") {die ("<center>Sila masukkan Nama Projek baru.</center>");} 

//if ($programEV=="kerja") 
//{die ("<center>Sila nyatakan Cawangan Program Kerja.</center>");} 

//if ($programEV=="BKA" && ($OICEV<>"PENGARAH" || $lokasiEV<>"PELBAGAI NEGERI" || $mod_kerjaEV<>"Piawai" ) ) 
//{die ("<center>Fail am/umum untuk Pengarah: Lokasi PELBAGAI NEGERI & Modus Piawai saja.</center>");} 


if ($programEV=="BKA" && $OICEV<>"PENGARAH") 
{die ("<center>Sila nyatakan Program Kerja Anda. <br>(Program BKA hanya daftar Kerja Piawaian oleh Admin.)</center>");} 

if ($lokasiEV=="IBU PEJABAT JKR") 
{die ("<center>Sila pilih Lokasi.</center>");} 

if ($KemKlientEV=="KERAJAAN MALAYSIA" ) 
{die ("<center>Sila pilih Kementerian Pelangan.</center>");} 

$Vtajuk = $tajukEV;
$Vlokasi = $lokasiEV;
$VKemKlient = $KemKlientEV;
$Vmod_kerja = $mod_kerjaEV;
$Vskop_kerja = $skop_kerjaEV;

if ($_SESSION['kp_s']<>SUPERUSER_ID){
$OICEV =user_kppk($_SESSION['kp_s']);}

$VOIC = $OICEV;
$Vprogram= $programEV;
$Vcatatan= $catatanEV;
$Vnosiri_fail=$nosiri_failEV;
$Vno_bpks= $no_bpksEV;


//ECHO $VOIC.'<--$VOIC' ;
$count = mysql_query("SELECT COUNT(*) FROM daftar_projek WHERE OIC ='$VOIC' AND lokasi ='$Vlokasi' AND KemKlient ='$VKemKlient' ");
if ($_SESSION['kp_s']==SUPERUSER_ID){
$count = mysql_query("SELECT COUNT(*) FROM daftar_projek WHERE mod_kerja ='Piawai' AND lokasi ='$Vlokasi' AND KemKlient ='$VKemKlient' ");}

$count = mysql_fetch_array($count);
$Vnosiri_fail = $count[0]+1;
echo '<br>nosiri_fail after count  :: '.$Vnosiri_fail;

$startDate = $start;;
$tajuk = htmlspecialchars(stripslashes($Vtajuk),ENT_QUOTES);
$lokasi = $Vlokasi;
$KemKlient = $VKemKlient;

$mod_kerja = $Vmod_kerja;
$OIC = $VOIC;
$program= $Vprogram;
$catatan= $Vcatatan;
$nosiri_fail=$Vnosiri_fail;
$no_bpks= $Vno_bpks;
$skop_kerja = $Vskop_kerja;

$username = $_SESSION['username'];
$kp_s = trim( $_SESSION['kp_s'] );
//
$userON=superusers($_SESSION['first_name'],$_SESSION['username'],$_SESSION['kp_s']);

?> 

<!-----------------------------------------------------Daftar----------------------------------------------------->
<div align="center" class="style4">
<strong><span>Pasti Daftar Projek Baru !</span>
</strong></div>

<form name="form2" method="post" action="<?php echo $fileName ?>">
<div align="center"> 

<table width="800" border="1" align="center" cellpadding="4" cellspacing="0" bordercolor= "#FDFECF" bgcolor= "#EBEEF5">

<tr><td width="200" align="right">Tarikh/Jadual:</td> <td width="600" align="left"> 
<?php echo $startDate ?>
</td> </tr> 

<!------------------------------------------------------to note---------------------------------------------------->
<tr> <td align="right" valign="top">KEMENTERIAN PELANGAN:</td> <td align="left">
<?php echo $KemKlient ?> 
</td> </tr>

<tr> <td align="right" valign="top">TAJUK PROJEK:</td> <td align="left">
<?php echo $tajuk ?>
</td> </tr>
<tr> <td align="right">Lokasi:</td> <td align="left">
<?php echo $lokasi ?>
</td> </tr>
<tr> <td align="right">Program Kerja:</td> <td align="left">
<?php echo $program ?>
</td> </tr>
<tr> <td align="right">Mod Kerja:</td> <td align="left">
<?php echo $mod_kerja;
if ($_SESSION['kp_s']==SUPERUSER_ID){ 
unset ( $_SESSION['ppk']);
	    $_SESSION['ppk'] = $OIC;} ?>
</td> </tr>
<tr> <td align="right">Skop Kerja:</td> <td align="left">
<?php echo $skop_kerja ?>
</td> </tr>

<tr> <td align="right">No BPKS:</td><td align="left" bgcolor="#FDFECF" bordercolor="#EBEEF5">
<?php echo $no_bpks ?>
</td> </tr>

<tr> <td align="right">OIC:</td> <td align="left">
<?php echo $OIC ?>
</td> </tr>
<tr> <td align="right">Catatan:</td> <td align="left">
<?php echo $catatan?>
</td> </tr>
<tr> <td align="right">Nombor Fail:</td> <td align="left">
<?php echo $programFAIL[$program].$KOD_KEM[$KemKlient].'/'.$KOD_NEG[$lokasi].$nosiri_fail ?>  
</td> </tr>

<tr align="center"> <td colspan="2"><input type="submit" name="Submit" value="Simpan Data"> 
<input type="button" name="Button" value="Pinda" onClick="history.back();">
<input type="button" name="Button" value="Batal Tambah" onClick="location='<?php echo $fileName.'?event=Pinda';  ?>'">

<input name="start" type="hidden" id="start" value="<?php echo $start ?>">
<input name="siap" type="hidden" id="siap" value="<?php echo $siap ?>">
<input name="end" type="hidden" id="end" value="<?php echo $Bilangan ?>"> 
<input name="tajuk" type="hidden" id="tajuk" value="<?php echo $tajuk ?>">
<input name="lokasi" type="hidden" id="lokasi" value="<?php echo $lokasi ?>"> 
<input name="KemKlient" type="hidden" id="KemKlient" value="<?php echo $KemKlient ?>"> 

<input name="mod_kerja" type="hidden" id="mod_kerja" value="<?php echo $mod_kerja ?>">
<input name="OIC" type="hidden" id="OIC" value="<?php echo $OIC ?>">
<input name="username" type="hidden" id="username" value="<?php echo $username ?>">
<input name="program" type="hidden" id="program" value="<?php echo trim($program) ?>"> 
<input name="kp_s" type="hidden" id="kp_s" value="<?php echo $kp_s ?>">
<input name="catatan" type="hidden" id="catatan" value="<?php echo $catatan?>"> 
<input name="nosiri_fail" type="hidden" id="nosiri_fail" value="<?php echo $nosiri_fail ?>"> 
<input name="no_bpks" type="hidden" id="no_bpks" value="<?php echo $no_bpks ?>">
<input name="skop_kerja" type="hidden" id="skop_kerja" value="<?php echo $skop_kerja ?>">
</td> </tr> </table> </form>

<?php } 

if ($Submit=="Simpan Data") { $menu=1;
$startDate = $start;
$siapDate = $siap;


$userON=superusers($_SESSION['first_name'],$_SESSION['username'],$_SESSION['kp_s']);


if (isset($_SESSION['first_name']) && $userON=='true') 
{$OIC =user_kppk($_SESSION['kp_s']);
$sql="INSERT INTO daftar_projek (username,tajuk,lokasi,mod_kerja,
OIC,startDate,siapDate,kp_s,registration_date,program,catatan,nosiri_fail,KemKlient,no_bpks,skop_kerja) VALUES 
('$username','$tajuk','$lokasi','$mod_kerja','$OIC','$startDate','$siapDate','$kp_s',NOW(),
'$program','$catatan','$nosiri_fail','$KemKlient','$no_bpks','skop_kerja')";
$result=mysql_query($sql); 
if (!$result) {
die('<center>Data tidak dikemaskini :  ' . mysql_error().'<br/><font color="gray"><small>Fail nombor yang diketik telah ada , 
sila pinda nombor fail sediada mengikut turutan <br/>atau guna nom. dummi untuk fail sediada, 
daftar fail baru, <br/>kemudian pinda nombor dummi <i>(fail sediada tadi)</i> ke nom. daftar asal.</small></font>');
  } else {	echo "<center>Data telah ditambah.</center><br>";  }


unset( $_SESSION['daftar_id'],
		  $_SESSION['tajuk'],
		   $_SESSION['mod_kerja'],
			$_SESSION['ppk'],
			 $_SESSION['no_bpks'],
			  $_SESSION['skop_kerja']
			   );
			  $_SESSION['daftar_id'] = $daftar_id ;
		     $_SESSION['tajuk'] = $tajuk ;
			$_SESSION['mod_kerja'] = $mod_kerja;
		   $_SESSION['ppk'] = $OIC ;
		  $_SESSION['no_bpks'] = $no_bpks ;
		 $_SESSION['skop_kerja'] = $skop_kerja ;

		$r=mysql_query(" SELECT max(daftar_id) FROM daftar_projek ",$db);
		while ($proj = mysql_fetch_array ($r)) {
		$_SESSION ['daftar_id'] = $proj[0];}

echo "<center>Sesi baru Projek baru : {$_SESSION ['daftar_id']} </center><br>"; 
		ob_end_clean(); // Delete the buffer.		
		header ("Location:  http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/projek_daftar.php?event=Pinda");
		exit();
	}

else  {

echo "<center>PPK saja dibolehkan daftar projek baru.</center>";
	} 
if (!isset($_SESSION['first_name'])) 
{echo "<center>Anda tidak LOGIN !</center>";}

}

if ($event=="add"){ $menu=1;
?>

<form name="form1" method="post" action="<?php echo $fileName ?>">
<div align="center"> 
<table width="800" border="1" align="center" cellpadding="4" cellspacing="0" bordercolor="#FDFECF" bgcolor= "#EBEEF5" > 

<tr> <td width="200" align="right"> <small> Tarikh daftar :</small></td> 
<td width="600" align="left" bgcolor="#FDFECF" bordercolor="#EBEEF5" > 
<!--------------------------------New date format----------------------------------------->

<script> DateInput( 'start', true, 'YYYY-MM-DD')</script>

<!--------------------------------New date format----------------------------------------->


</td> </tr> 

<?php
if ($event=="add") 
{ $menu=1;
//$count=mysql_query("SELECT COUNT(*) FROM daftar_projek WHERE kp_s ='$kp_s'");$count=mysql_fetch_array($count);
//$count =$count[0];
$Bilangan=$count+1;}
?> 
<tr> <td align="right"><small> KEMENTERIAN PELANGAN:</small> </td> 
<td align="left">
<select name="KemKlientEV" id="KemKlientEV"> 
<?php 
for ($VKemKlient=0;$VKemKlient<=30;$VKemKlient++) 
{ echo "<option>$KemKlientFull[$VKemKlient]</option>\n";} ?> </select> 
</td></tr>

<tr> <td align="right"><small> TAJUK PROJEK:</small> </td> 
<td align="left">
<textarea name="tajukEV" cols="80" rows="5" id="tajukEV" ></textarea>&nbsp;&nbsp;
</td></tr>

<tr align="center"> <td colspan="2"><small> 
Program:<select name="programEV" id="programEV"> 
<?php
for ($Vprogram=0; $Vprogram<=6; $Vprogram++) 
{ echo "<option>$programtxt[$Vprogram]</option>\n";} ?> </select>

Lokasi:<select name="lokasiEV" id="lokasiEV"> 
<?php 
for ($Vlokasi=0;$Vlokasi <=17;$Vlokasi++) 
{ echo "<option>$Vlokasitxt[$Vlokasi]</option>\n";} ?> </select> 

Modus:<select name="mod_kerjaEV" id="mod_kerjaEV"> 
<?php
$Vmod_kerjatxt = array (0=>'Inhouse',1=>'Perunding',2=>'Perunding DB');
for ($Vmod_kerja=0; $Vmod_kerja <=2; $Vmod_kerja++) 
{ echo "<option>$Vmod_kerjatxt[$Vmod_kerja]</option>\n";} ?> </select> 

<?php 
if ($_SESSION['kp_s']==SUPERUSER_ID){ ?>
Pegawai T/jawab:<select name="OICEV" id="OICEV"> 
<?php
$VOIC= $_SESSION['ppk'];
$OICEV=$VOIC;
for ($VOIC=0; $VOIC <=5; $VOIC++) 
{ echo "<option";
if ($VOICtxt[$VOIC]==$OICEV){ echo " SELECTED";} 
echo ">$VOICtxt[$VOIC]</option>\n";} ?> </select>
<?php }
///////$_SESSION['ppk'] = $OICEV;
 ?>


</td></tr>


<tr> <td align="right" bgcolor="#FA8258" >NOMBOR BPKS:
<td align="left" bgcolor="#FDFECF" bordercolor="#EBEEF5">
<input type="text" name="no_bpksEV" id="no_bpksEV">

<?php 
if ($_SESSION['kp_s']==SUPERUSER_ID){ 
$Vskop_kerjatxt = array (0=>'',1=>'KT',2=>'KHK',3=>'SS',4=>'JD',5=>'RA',6=>'SP',7=>'SPAH');?>
Skop Kerja:<select name="skop_kerjaEV" id="skop_kerjaEV"> 
<?php
for ($Vskop_kerja=0; $Vskop_kerja <=7; $Vskop_kerja++) 
{ echo "<option>$Vskop_kerjatxt[$Vskop_kerja]</option>\n";} ?> </select> 
<?php }
///////$_SESSION['ppk'] = $OICEV;
 ?>
</td>
</tr>
 

<tr> <td align="right"><small>CATATAN:</small> </td> 
<td align="left">
<textarea name="catatanEV" cols="80" rows="3" id="catatanEV"></textarea>&nbsp;&nbsp;

<tr align="center"> <td colspan="2">
<input type="submit" name="Submit" value="Projek Baru"> 
<input type="button" name="Button" value="Batal Tambah" onClick="location='<?php echo $fileName.'?event=Pinda';  ?>'">
</td> </tr>

<tr><td width="650" align="center" colspan="2"><small><i> 
Pendaftar id :<font color="green">[<?php 
//echo $_SESSION['kp_s'];
?>]</font></small></td></tr>

</table></form> 
<!--------------------------------------------------------------------------------------------------------------------->
<?php } 
$_SESSION['OIC'] = $OICEV;

if ($ChooseProj)
	{ 
	unset ($_SESSION['daftar_id']
		//$_SESSION['OIC']
						 );
		//$eid=$ChooseProj;
		    $_SESSION['daftar_id'] = $ChooseProj;
			$event="Pinda";    }

if ($ListAll=="SesiBaru")
	{ unset($_SESSION['ppk']);
		$event="Pinda";    }

if ($event=="Pinda")
if (!isset($_SESSION['first_name'])) {echo '<center>Anda mesti LOGIN.</center>';}
else
{$menu=1;
$kp_s = $_SESSION['kp_s'];
$username = $_SESSION['username'];


$userON=superusers($_SESSION['first_name'],$_SESSION['username'],$_SESSION['kp_s']);
if (isset($_SESSION['first_name']) && $userON=='true') 
{$OIC =user_kppk($_SESSION['kp_s']);$_SESSION['ppk']=$OIC;


$chkOIC = $_SESSION['ppk'];
$chkKP_S = $_SESSION['kp_s'];

if ( $chkKP_S ==SUPERUSER_ID) 
		{ if ( !$chkOIC ) {
//$result=mysql_query("SELECT * FROM daftar_projek GROUP BY daftar_id ORDER BY registration_date DESC",$db);
$result=mysql_query("SELECT * FROM daftar_projek ORDER BY daftar_id DESC",$db);

} else {

$result=mysql_query("SELECT * FROM daftar_projek WHERE OIC = '$chkOIC' GROUP BY daftar_id ORDER BY registration_date DESC",$db);}
			} else
$result=mysql_query( "SELECT * FROM daftar_projek WHERE OIC = '$chkOIC' AND (kp_s = '$chkKP_S' || kp_s = '580307-03-5341') ORDER BY registration_date DESC",$db);
			}
				else { 

		$result=mysql_query("select t1.daftar_id,
			t1.tajuk,
			t1.mod_kerja,
			t1.lokasi,
			t1.OIC,
			t1.startDate,
			t1.program,
			t1.nosiri_fail,
			t1.KemKlient,
			t1.no_bpks,
			t1.skop_kerja,
			t2.pereka, 
			t2.penyemak 
			from 
			daftar_projek AS t1 INNER JOIN
			butiran_projek AS t2 ON t1.daftar_id=t2.id_daftar 
			where t1.daftar_id = t2.id_daftar 
			AND (t2.pereka ='$username' OR t2.penyemak ='$username')",$db);

$count=mysql_query("SELECT COUNT(*) FROM butiran_projek WHERE pereka = '$username' OR penyemak = '$username'");
$count=mysql_fetch_array($count);
$count=$count[0];echo "<div align=\"center\">Bilangan projek ".$username."&nbsp;:&nbsp;<b>$count</b></div><br>";
				}
					//$result=mysql_query("SELECT 
					//		t1.daftar_id, t1.tajuk, 
					//		t2.OIC FROM daftar_projek AS t1, butiran_projek AS t2 
					//WHERE t2.OIC = '$username' AND t1.daftar_id = t2.id_daftar ORDER BY t2.regist_date DESC",$db);

$myrow=mysql_fetch_assoc($result);
if ($myrow) { ?> 
<table width="800" border="1" align="center" cellpadding="1" cellspacing="0" bordercolor="#E4E4E4"> 
<tr bgcolor="#EBEEF5" height="50"><td width="50" align="center">Bil:</td>  
<td width="70" align="center">Pinda:<br/> 
<a href=" <?php echo $fileName ?>?eid=<?php echo $_SESSION['daftar_id'] ?>">
<font color="red" size="2em"><?php echo  $_SESSION['daftar_id'] ?></font></a>
</td> 

<td width="657" align="center">
		<?php 
		$q = "select tajuk,mod_kerja from daftar_projek 
			 where daftar_id = {$_GET['ChooseProj']} ";
		$r = mysql_query ($q);
		while ($tn = mysql_fetch_array ($r)) {
		$_SESSION['tajuk'] = $tn[0];
		$_SESSION['mod_kerja'] = $tn[1];		
		} 
		?>

<a href="<?php echo "$fileName?ListAll=SesiBaru";?>"<font color="gray"> SENARAI PROJEK </font> </a> 
<?php echo '<br/><br/>  
<font color="red" size="2em">'. $_SESSION['tajuk'] .'</font><font color="darkkhaki" size="1em">:'.$_SESSION['mod_kerja'].':</font>'  ;?>

</td>
</tr> 

<?php 
$Bilangan = 1;
do { 
//----------------------------------------------
$Vlokasi = $myrow[lokasi];
$VKemKlient = $myrow[KemKlient];

$Vmod_kerja = $myrow[mod_kerja];
$VOIC = $myrow[OIC];
$start = date("d-m-Y",strtotime($myrow[startDate]));
$Vusername = $myrow[username];
$kp_s = trim($myrow[kp_s]);
?>

<tr id="ajax<?php echo $myrow[daftar_id] ?>"> 

<td align="center" bgcolor="#E4F3CF"><i>
<?php echo $Bilangan++;?>
</i></td> 

<?php if ($_SESSION['daftar_id'] == $myrow[daftar_id]){ ; ?>
<td align="center" bgcolor="#FDFECF"> 
<?php echo $myrow[daftar_id] ?>
</td> 
<td align="left" bgcolor="#FDFECF"> 
<?php echo 
'<div style="margin-top:5px" > 
<font color="darkkhaki" size="1em" >Tajuk&nbsp;:</font>
<font color="black" size="2em"  style="margin-left:5px"><b>'.nl2br($myrow[tajuk]).'</b></font>
</div>'. 
'<div style="margin-top:-1px" > 
<font color="darkkhaki" size="1em"  style="margin-left:0px">Prog.&nbsp;:</font>
<font color="coral" size="1em"  style="margin-left:5px">'.$myrow[program].'</font>
<font color="darkkhaki" size="1em"  style="margin-left:5px">/</font>
<font color="darkgreen" size="1em"  style="margin-left:5px">'.$myrow[OIC].'</font>
<font color="darkkhaki" size="1em"  style="margin-left:5px">/</font>
<font color="darkgreen" size="1em"  style="margin-left:5px">'.$myrow[mod_kerja].'</font>
<font color="darkkhaki" size="1em"  style="margin-left:5px">No. fail&nbsp;:</font>
<font color="darkgreen" size="1em"  style="margin-left:5px">'.$programFAIL[$myrow[program]].$KOD_KEM[$myrow[KemKlient]].'/'.$KOD_NEG[$myrow[lokasi]].$myrow[nosiri_fail].
'</font></div>'.'</font></div>';

if (intval($myrow[no_bpks])){
	if ($myrow[program]=='BKA'){echo '<div style="margin-top:-2px" >
<font color="coral" size="1em"  style="margin-left:300px">No. fail BPKS&nbsp;:</font>
<font color="darkgreen" size="1em"  style="margin-left:5px">'.
$programNEWFAIL[$myrow[program]].$myrow[skop_kerja].'/'.$kem_QUERYnumber[$myrow[KemKlient]].'/'.$KOD_NEG[$myrow[lokasi]].' '.substr($myrow[startDate],2,2).'/'.$myrow[no_bpks].'/'.'</font>
</div>'; } 

	else { echo '<div style="margin-top:-2px" >
<font color="coral" size="1em"  style="margin-left:300px">No. fail BPKS&nbsp;:</font>
<font color="darkgreen" size="1em"  style="margin-left:5px">'.
$programNEWFAIL[$myrow[program]].$kem_QUERYnumber[$myrow[KemKlient]].'/'.$KOD_NEG[$myrow[lokasi]].' '.substr($myrow[startDate],2,2).'/'.$myrow[no_bpks].'/'.'</font>
</div>'; } 
}?>
</td>
</tr> 


<?php } else { ?>
<td align="center" bgcolor="#ECF1EB">
<a href=" <?php echo $fileName ?>?ChooseProj=<?php echo $myrow[daftar_id] ?> ">
<?php echo $myrow[daftar_id]; ?></a></td> 
<td align="left">
<?php echo 
'<div style="margin-top:5px" > 
<font color="darkkhaki" size="1em" >Tajuk&nbsp;:</font>
<font color="black" size="2em"  style="margin-left:5px"><b>'.nl2br($myrow[tajuk]).'</b></font>
</div>'. 
'<div style="margin-top:-1px" > 
<font color="darkkhaki" size="1em"  style="margin-left:0px">Prog.&nbsp;:</font>
<font color="coral" size="1em"  style="margin-left:5px">'.$myrow[program].'</font>
<font color="darkkhaki" size="1em"  style="margin-left:5px">/</font>
<font color="darkgreen" size="1em"  style="margin-left:5px">'.$myrow[OIC].'</font>
<font color="darkkhaki" size="1em"  style="margin-left:5px">/</font>
<font color="darkgreen" size="1em"  style="margin-left:5px">'.$myrow[mod_kerja].'</font>
<font color="darkkhaki" size="1em"  style="margin-left:5px">No. fail&nbsp;:</font>
<font color="darkgreen" size="1em"  style="margin-left:5px">'.$programFAIL[$myrow[program]].$KOD_KEM[$myrow[KemKlient]].'/'.$KOD_NEG[$myrow[lokasi]].$myrow[nosiri_fail].
'</font></div>'.'</font></div>';

if (intval($myrow[no_bpks])){
	if ($myrow[program]=='BKA'){echo '<div style="margin-top:-2px" >
<font color="coral" size="1em"  style="margin-left:300px">No. fail BPKS&nbsp;:</font>
<font color="darkgreen" size="1em"  style="margin-left:5px">'.
$programNEWFAIL[$myrow[program]].$myrow[skop_kerja].'/'.$kem_QUERYnumber[$myrow[KemKlient]].'/'.$KOD_NEG[$myrow[lokasi]].' '.substr($myrow[startDate],2,2).'/<b>'.$myrow[no_bpks].'</b>/'.'</font>
</div>'; } 

	else { echo '<div style="margin-top:-2px" >
<font color="coral" size="1em"  style="margin-left:300px">No. fail BPKS&nbsp;:</font>
<font color="darkgreen" size="1em"  style="margin-left:5px">'.
$programNEWFAIL[$myrow[program]].$kem_QUERYnumber[$myrow[KemKlient]].'/'.$KOD_NEG[$myrow[lokasi]].' '.substr($myrow[startDate],2,2).'/<b>'.$myrow[no_bpks].'</b>/'.'</font>
</div>'; } 
}?>
</td>
</tr> 

<?php } }
while ($myrow=mysql_fetch_array($result));?>
</table> <br> 
<?php } } 

if ($eid) 
{ $menu=1;$result=mysql_query("SELECT * FROM daftar_projek WHERE daftar_id='$eid'",$db);
$myrow=mysql_fetch_array($result);
 ?> 

<form name="form1" method="post" action="<?php echo $fileName ?>">
<div align="center"> 
<table width="800" border="1" align="center" cellpadding="4" cellspacing="0" bordercolor="#FDFECF" bgcolor="#EBEEF5"> 
<tr> <td width="200" align="right">Tarikh daftar / pinda:</td> 
<td width="500" align="left"><p> 
<!----------------------------------------------------DateInput------------------------------------------------------------->

<script> DateInput( 'start', true, 'YYYY-MM-DD','<?php echo $myrow[startDate]; ?>' )</script>

<!----------------------------------------------------DateInput------------------------------------------------------------->
<tr> <td align="right"> 
Kementerian Pelangan:</td><td><h><?php echo '<font color="gray">'.$myrow[KemKlient].'</font>';?>
</h></td></tr>

<tr><td align="right">
TAJUK PROJEK:</td><td align="left"><h3>
<?php if ($_SESSION['IDpendaftar']===$_SESSION['kp_s']){ ?>
<textarea name="tajuk" cols="80" rows="4" id="tajuk"><?php echo $myrow[tajuk]; ?></textarea>
<?php } else {echo $myrow[tajuk]; ?> 
<input name="tajuk" type="hidden" id="tajuk" value="<?php echo $myrow[tajuk] ?>">
<?php } ?>
</h3></td></tr>

<tr align="center"> <td colspan="2"> 
Program: <?php echo '<font color="red">'.$myrow[program].'</font>';?>
&nbsp; Lokasi: <?php echo '<font color="red">'. $myrow[lokasi] .'</font>';?>
&nbsp; MODUS:
<select name="mod_kerjaEV" id="mod_kerjaEV"> 
<?php
$Vmod_kerja=$myrow[mod_kerja];
$mod_kerjaEV=$Vmod_kerja;
$Vmod_kerjatxt = array (0=>'Inhouse',1=>'Perunding',2=>'Perunding DB');
for ($Vmod_kerja=0; $Vmod_kerja <=2; $Vmod_kerja++) 
{ echo "<option";
if ($Vmod_kerjatxt[$Vmod_kerja]==$mod_kerjaEV){ echo " SELECTED";} 
echo ">$Vmod_kerjatxt[$Vmod_kerja]</option>\n";} ?> </select>

<?php 
$VOIC= $myrow[OIC];
$OICEV=$VOIC;
if ($_SESSION['kp_s']==SUPERUSER_ID){ ?>

&nbsp; Pegawai T/jawab:<select name="OICEV" id="OICEV"> 
<?php
for ($VOIC=0; $VOIC <=5; $VOIC++) 
{ echo "<option";
if ($VOICtxt[$VOIC]==$OICEV){ echo " SELECTED";} 
echo ">$VOICtxt[$VOIC]</option>\n";} ?> </select> 
<?php } ?>
</td></tr>


<tr align="center"><td colspan="2" style="margin-top:-200px">
NOMBOR FAIL: &nbsp;&nbsp;<font color="coral">
<?php 
if ($_SESSION['IDpendaftar']===$_SESSION['kp_s']){ 

echo $programFAIL[$myrow[program]].$KOD_KEM[$myrow[KemKlient]].'/'.$KOD_NEG[$myrow[lokasi]];?>
<input name="nosiri_failEV" type="text" id="nosiri_failEV" value="<?php echo $myrow[nosiri_fail] ?>"> 
<?php } else {echo $programFAIL[$myrow[program]].$KOD_KEM[$myrow[KemKlient]].'/'.$KOD_NEG[$myrow[lokasi]].$myrow[nosiri_fail] ?> 
<input name="nosiri_failEV" type="hidden" id="nosiri_failEV" value="<?php echo $myrow[nosiri_fail] ?>">
<?php } ?>
</font></td></tr>

<?php /////// required verification ///////
//IDpendaftar-2======================================================================?>
<tr bgcolor="#FDFECF" bordercolor="#EBEEF5"><td colspan="2" align="center">
NOMBOR FAIL BPKS: &nbsp;&nbsp;<font color="red"><?php

if ($_SESSION['IDpendaftar']===$_SESSION['kp_s']){ 

if ($myrow[program]=='BKA'){echo
$programNEWFAIL[$myrow[program]].$myrow[skop_kerja].'/'.$kem_QUERYnumber[$myrow[KemKlient]].'/'.$KOD_NEG[$myrow[lokasi]].' '.substr($myrow[startDate],2,2).'/';} else {
echo $programNEWFAIL[$myrow[program]].$kem_QUERYnumber[$myrow[KemKlient]].'/'.$KOD_NEG[$myrow[lokasi]].' '.substr($myrow[startDate],2,2).'/';}
?><input type="text" name="no_bpksEV" id="no_bpksEV"  value="<?php echo $myrow[no_bpks].'">';?></font>
<?php

} else {

if ($myrow[program]=='BKA'){echo
$programNEWFAIL[$myrow[program]].$myrow[skop_kerja].'/'.$kem_QUERYnumber[$myrow[KemKlient]].'/'.$KOD_NEG[$myrow[lokasi]].' '.substr($myrow[startDate],2,2).'/';} else {
echo $programNEWFAIL[$myrow[program]].$kem_QUERYnumber[$myrow[KemKlient]].'/'.$KOD_NEG[$myrow[lokasi]].' '.substr($myrow[startDate],2,2).'/';}
?><input type="hidden" name="no_bpksEV" id="no_bpksEV"  value="<?php echo $myrow[no_bpks].'">';?></font>

<?php }

if ($_SESSION['kp_s']==SUPERUSER_ID){ ?>
&nbsp; Skop Kerja:
<select name="skop_kerjaEV" id="skop_kerjaEV"> 
<?php
$Vskop_kerja=$myrow[skop_kerja];
$skop_kerjaEV=$Vskop_kerja;
$Vskop_kerjatxt = array (0=>'skop kerja',1=>'KT',2=>'KHK',3=>'SS',4=>'JD',5=>'RA',6=>'SP',7=>'SPAH');
for ($Vskop_kerja=0; $Vskop_kerja <=7; $Vskop_kerja++) 
{ echo "<option";
if ($Vskop_kerjatxt[$Vskop_kerja]==$skop_kerjaEV){ echo " SELECTED";} 
echo ">$Vskop_kerjatxt[$Vskop_kerja]</option>\n";} ?> </select>
<?php } ?>
</td></tr>



<tr><td align="right">
CATATAN:</td> <td align="left">
<textarea name="catatanEV" cols="80" rows="3" id="catatanEV"><?php echo $myrow[catatan]; ?></textarea>
</td></tr>

<tr align="center">
<td colspan="2"><input type="submit" name="Submit" value="Pinda Data"> 
<input type="button" name="Button" value="Batal Pindaan" onClick="location='<?php echo $fileName.'?event=Pinda'; ?>'">
<input name="daftar_id" type="hidden" id="daftar_id" value="<?php echo $myrow[daftar_id] ?>">
<!--input name="nosiri_failEV" type="hidden" id="nosiri_failEV" value="<?php echo $myrow[nosiri_fail] ?>"-->
<input name="programEV" type="hidden" id="programEV" value="<?php echo $myrow[program] ?>">
<input name="lokasiEV" type="hidden" id="lokasiEV" value="<?php echo $myrow[lokasi] ?>">
<input name="KemKlientEV" type="hidden" id="KemKlientEV" value="<?php echo $myrow[KemKlient] ?>">

<!--input name="no_bpksEV" type="hidden" id="no_bpksEV" value="<?php echo $myrow[no_bpks] ?>">
<input name="skop_kerjaEV" type="hidden" id="skop_kerjaEV" value="<?php echo $myrow[skop_kerja] ?>"-->

<?php 
if ($_SESSION['kp_s']<>SUPERUSER_ID){ ?>
<input name="OICEV" type="hidden" id="OICEV" value="<?php echo $myrow[OIC] ?>">
<?php } ?>

</td></tr> 
<tr><td width="650" align="center" colspan="2"><small><i> 
Username :<?php echo $username ?>&nbsp;&nbsp;
Pendaftar id :<font color="gray"><small><small>[<i><?php 
echo $myrow[kp_s]; 
?>]</i></font>
</small>
</td></tr> 
</table> </form> 
<!--------------------------------------------------------formEnd------------------------------------------------------>


<center><small>[ 
<?php 
if ($_SESSION['kp_s']==$_SESSION['IDpendaftar']){ ?>
<a href="<?php echo "$fileName?del=$myrow[daftar_id]";?>" onCLick="return confirmDelete();"><small>Padam Data</small></a>
<?php } ?> ] </small>
<br> <br> </center> 
<?php } 

$userON=superusers($_SESSION['first_name'],$_SESSION['username'],$_SESSION['kp_s']);
if (isset($_SESSION['first_name']) && $userON=='true') 
{
if ($del){ $menu=1;
	$delsql="DELETE from daftar_projek WHERE daftar_id='$del';";$delresult=mysql_query($delsql);
		echo "<center> <font color=\"khaki\"> The daftar projek has been deleted.</font> </center><br>";
	$delsql="DELETE from butiran_projek WHERE id_daftar='$del';";$delresult=mysql_query($delsql);
		echo "<center><font color=\"khaki\"> The butiran projek has been deleted.</font> </center><br>";
	$delsql="DELETE from butiran_sivil WHERE id_daftar='$del';";$delresult=mysql_query($delsql);
		echo "<center><font color=\"khaki\"> The butiran sivil has been deleted.</font> </center><br>";
	$delsql="DELETE from dplan_projek WHERE id_daftar='$del';";$delresult=mysql_query($delsql);
		echo "<center><font color=\"khaki\"> The dplan projek has been deleted.</font> </center><br>";
	$delsql="DELETE from perunding_projek WHERE id_daftar='$del';";$delresult=mysql_query($delsql);
		echo "<center><font color=\"khaki\"> The perunding projek has been deleted.</font> </center><br>";
	$delsql="DELETE from status_projek WHERE id_daftar='$del';";$delresult=mysql_query($delsql);
		echo "<center><font color=\"khaki\"> The status projek has been deleted.</font> </center><br>";
unset ( $_SESSION['daftar_id'] );
	} 
}


if ($Submit=="Pinda Data"){ $menu=1;

$startDate= $start; 
$siapDate= $siap; 

$tajuk= htmlspecialchars(stripslashes($tajuk),ENT_QUOTES);
$lokasi = $lokasiEV;
$KemKlient = $KemKlientEV;
$VOIC = $OICEV;
$Vprogram = $programEV;
$Vcatatan = $catatanEV;
$Vnosiri_fail = $nosiri_failEV;
$Vno_bpks = $no_bpksEV;

//$start = date("m-d-Y",strtotime($myrow[startDate]));
$Vusername = $usernameEV;

$Vlokasi = $lokasiEV;
$VKemKlient = $KemKlientEV;
$Vmod_kerja = $mod_kerjaEV;
$Vskop_kerja = $skop_kerjaEV;

if ($tajuk=="") {die ("<center>Sila masukkan Nama Projek baru.</center>");} 

//if ($Vprogram=="kerja") 
//{die ("<center>Sila nyatakan Cawangan Program Kerja.</center>");} 

//if ($Vprogram=="BKA" && ($VOIC<>"PENGARAH" || $Vlokasi<>"PELBAGAI NEGERI" || $Vmod_kerja<>"Piawai" ) ) 
//{die ("<center>Fail am/umum untuk Pengarah: Lokasi PELBAGAI NEGERI & Modus Piawai saja.</center>");} 

if ($Vprogram<>"BKA" && $VOIC=="PENGARAH") 
//{die ("<center>Sila asain projek kepada KPPK, tidak PENGARAH &amp; Lokasi NEGERI2.</center>");} 
{die ("<center>Sila nyatakan Program Kerja Anda. <br>(Program BKA hanya daftar Kerja Piawaian oleh Admin.)</center>");} 

if ($lokasiEV=="IBU PEJABAT JKR") 
{die ("<center>Sila pilih Lokasi.</center>");} 

if ($VKemKlient=="KERAJAAN MALAYSIA" ) 
{die ("<center>Sila pilih Kementerian Pelangan.</center>");} 

////$kp_s =$myrow[kp_s];


?> 

<form name="form2" method="post" action="<?php echo $fileName ?>">
<div align="center"> 
<table width="800" border="1" align="center" cellpadding="4" cellspacing="0" bordercolor="#FDFECF" bgcolor="#EBEEF5">
<?php


$startDate=$start; ////month."/".$day."/".$year;
$siapDate=$siap; ////month."/".$day."/".$year;
?>
<div align="center" class="style4">
<strong><span>Pasti Pinda Data:</span>
<br></strong></div><br/>

<tr> <td width="200" align="right">TARIKH DAFTAR/PINDA :</td> 
<td width="600" align="left"> 
<?php echo $startDate; ?>
</td> </tr> 

<tr> <td align="right" valign="top">KEMENTERIAN PELANGAN:</td> <td align="left">
<font color="gray"><?php echo $KemKlient ?></font>
</td> </tr>

<tr> <td align="right" valign="top">TAJUK PROJEK:</td> <td align="left">
<?php echo $tajuk ?>
</td> </tr>
<tr> <td align="right">Caw. Program Kerja:</td> <td align="left">
<?php echo $Vprogram ?>
</td> </tr>
<tr> <td align="right"> OIC CKAJ: </td> <td align="left">
<?php echo $VOIC ;
if ($_SESSION['kp_s']==SUPERUSER_ID){ 
unset ( $_SESSION['ppk']);
	    $_SESSION['ppk'] = $VOIC;} ?>
</td> </tr>
<tr> <td align="right">Lokasi:</td> <td align="left">
<?php echo $Vlokasi ?>
</td> </tr>

<tr> <td align="right">Modus Operandi:</td> <td align="left">
<?php echo $Vmod_kerja ?>
</td> </tr>

<tr> <td align="right">NOMBOR BPKS:</td> <td align="left" bgcolor="#FDFECF" bordercolor="#EBEEF5">
<?php echo $Vno_bpks ?>
</td> </tr>

<tr> <td align="right">Skop Kerja:</td> <td align="left">
<?php echo $Vskop_kerja ?>
</td> </tr>

<tr> <td align="right" valign="top">CATATAN:</td> <td align="left">
<h5><?php echo $Vcatatan ?></h5>
<tr> <td align="right" valign="top">NOMBOR FAIL:::</td> <td align="left">
<?php echo $programFAIL[$Vprogram].$KOD_KEM[$VKemKlient].'/'.$KOD_NEG[$Vlokasi].$Vnosiri_fail.'/<br>';
if ($Vskop_kerja=='') {$Vskop_kerja='???';}
if ($Vprogram=='BKA'){echo
$programNEWFAIL[$Vprogram].$Vskop_kerja.'/'.$kem_QUERYnumber[$VKemKlient].'/'.$KOD_NEG[$Vlokasi].' '.substr($startDate,2,2).'/'.$Vno_bpks.'/';} else 
{echo $programNEWFAIL[$Vprogram].$kem_QUERYnumber[$VKemKlient].'/'.$KOD_NEG[$Vlokasi].' '.substr($startDate,2,2).'/'.$Vno_bpks.'/';}
?>  

<tr align="center"> <td colspan="2">
<input type="submit" name="Submit" value="Simpan Pindaan"> 
<input type="button" name="Button" value="Pinda" onClick="history.back();"> 
<input type="button" name="Button" value="Batal Pindaan" onClick="location='<?php echo $fileName.'?event=Pinda';  ?>'">
<br/><font color="gray"> <i><small><small>Username:<?php echo $Vusername ?>&nbsp;&nbsp;Pendaftar id[<?php echo $kp_s ?>]</small></small></i></font>  
<input name="start" type="hidden" id="start" value="<?php echo $start ?>"> 
<input name="siap" type="hidden" id="siap" value="<?php echo $siap ?>"> 

<input name="end" type="hidden" id="end" value="<?php echo $end ?>"> 
<input name="daftar_id" type="hidden" id="daftar_id" value="<?php echo $daftar_id ?>"> 
<input name="tajuk" type="hidden" id="tajuk" value="<?php echo $tajuk ?>">
<input name="Vlokasi" type="hidden" id="Vlokasi" value="<?php echo $Vlokasi ?>">
<input name="VKemKlient" type="hidden" id="VKemKlient" value="<?php echo $VKemKlient ?>">

<input name="Vusername" type="hidden" id="Vusername" value="<?php echo $Vusername ?>">
<input name="Vprogram" type="hidden" id="Vprogram" value="<?php echo $Vprogram ?>">
<input name="Vcatatan" type="hidden" id="Vcatatan" value="<?php echo $Vcatatan?>">
<input name="Vnosiri_fail" type="hidden" id="Vnosiri_fail" value="<?php echo $Vnosiri_fail ?>">
<input name="Vno_bpks" type="hidden" id="Vno_bpks" value="<?php echo $Vno_bpks ?>">

<input name="Vmod_kerja" type="hidden" id="Vmod_kerja" value="<?php echo $Vmod_kerja ?>">
<input name="VOIC" type="hidden" id="VOIC" value="<?php echo $VOIC ?>">
<input name="kp_s" type="hidden" id="kp_s" value="<?php echo $kp_s ?>">
<input name="Vskop_kerja" type="hidden" id="Vskop_kerja" value="<?php echo $Vskop_kerja ?>">

</td> </tr> 
</table> </form>

<?php } 
if ($Submit=="Simpan Pindaan") 
{ $menu=1;
$Bilangan=$end;
$tajuk=htmlspecialchars($tajuk,ENT_QUOTES);
$lokasi = $Vlokasi;
$KemKlient= $VKemKlient;

$id_daftar = $Vid_daftar;
$mod_kerja = $Vmod_kerja;
$OIC = $VOIC;
$startDate=$start;
$siapDate=$siap;

$username = $_SESSION['username'];
$kp_s = $_SESSION['kp_s'];
$program= $Vprogram;
$catatan= $Vcatatan;
$nosiri_fail= $Vnosiri_fail;
$no_bpks= $Vno_bpks;
$skop_kerja = $Vskop_kerja;

//IDpendaftar-1---------------------------------------

$userON=superusers($_SESSION['first_name'],$_SESSION['username'],$_SESSION['kp_s']);
if (isset($_SESSION['first_name']) && $userON=='true' && $_SESSION['IDpendaftar']===$_SESSION['kp_s']) 
{//:: $OIC =user_kppk($_SESSION['kp_s']);


$sql="UPDATE daftar_projek SET tajuk='$tajuk',lokasi='$lokasi',mod_kerja='$mod_kerja',
OIC='$OIC',startDate='$startDate',siapDate='$siapDate',registration_date=NOW(),program='$program',
catatan='$catatan',nosiri_fail='$nosiri_fail',KemKlient='$KemKlient',no_bpks='$no_bpks',skop_kerja='$skop_kerja' WHERE daftar_id='$daftar_id';";
$result=mysql_query($sql); 
if (!$result) {
die('<center>Data tidak dikemaskini :  ' . mysql_error().'<br>Fail nombor yang diketik telah ada , sila guna nombor lain.');
  }
}
unset ( $_SESSION['daftar_id'],
		  $_SESSION['tajuk'],
		   $_SESSION['mod_kerja'],
			$_SESSION['ppk'],
			 $_SESSION['no_bpks'],
			  $_SESSION['skop_kerja']
			    );
				$_SESSION['daftar_id'] = $daftar_id ;
				 $_SESSION['tajuk'] = $tajuk ;
				   $_SESSION['mod_kerja'] = $mod_kerja;
				     $_SESSION['ppk'] = $OIC ;
					   $_SESSION['no_bpks'] = $no_bpks;
					     $_SESSION['skop_kerja'] = $skop_kerja;

echo "<center>Telah dikemaskini. Masuk sesi baru jika klik 'semak'.</center><br>";
	ob_end_clean(); // Delete the buffer.		
	header ("Location:  http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/projek_daftar.php?event=Pinda");
	exit();
} 

if ($menu!=1) 
{ $count=mysql_query("SELECT COUNT(*) FROM daftar_projek WHERE kp_s = '$kp_s'");$count=mysql_fetch_array($count);
$count=$count[0];echo "<div align=\"center\">--JUMLAH DATA:<b>$count</b>--</div><br>";} 
?>


<?php // Include the HTML footer file.
include_once ('html/footer.htm');
?>

