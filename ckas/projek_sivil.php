<?php 
$page_title = 'Kerja sivil';
include_once ('html/header.htm');
// Welcome the user (by name if they are logged in).
if (isset($_SESSION['first_name'])) { 

echo "&nbsp;&nbsp;<i> log: {$_SESSION['first_name']} </i></small></center></fieldset>";
}
else
{ echo "</small></center></fieldset>"; }

require ("inc/projek_sivil_cfg.php");
require_once ('mysql_connect.php'); // Connect to the database.
		$getU=$_SESSION['daftar_id'];
		$q = "select tajuk, OIC AS ppk, mod_kerja from daftar_projek 
			where daftar_id = '$getU'";
		$r = mysql_query ($q);
		while ($tna = mysql_fetch_array ($r)) {
		$_SESSION['tajuk'] = $tna[0];
		$_SESSION['ppk'] = $tna[1];
		$_SESSION['mod_kerja'] = $tna[2];
		$_SESSION['daftar_id'] = $_GET['uj'];
			
		//		ob_end_clean(); // Delete the buffer.
				
		//		header ("Location:  http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/projek_sivil.php?event=Pinda");

		//		exit();

			}
//echo 	$_SESSION['order'].'-----order';	
$db=@mysql_connect($dbHost,$dbUserLogin,$dbPassword) or $error=(mysql_error()."<br>");
@mysql_select_db($dbName,$db) or $error.=(mysql_error());

if ($error) {
echo "<font color=red>> There was an error connecting to the mySQL database.</font><br><br>";
echo "Please check the database settings in the 'projek_sivil_cfg.php' file and try again.<br><br>";
echo "The error was reported as:<br>$error";exit;}
?>
<!------------------------------new date format--------------------------->
<script type="text/javascript" src="jasoncalendar/calendarDateInput.js"></script>




 <!--title> Konsol sivil Projek </title-->
 <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1">
 <style type="text/css">
 a:link { text-decoration:none ; font-size:12px; font-weight:normal }
 a:visited { text-decoration:none ; font-size:12px; font-weight:normal }
 a:hover { text-decoration:underline ; font-size:12px; font-weight:normal }
 body { font-family:Verdana,Arial,Helvetica,sans-serif;font-size:12px;} 
 // background: white url(../bground/sand2.jpg);// no-repeat top right; 
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
Konsol <b>Kerja Sivil</b> Projek <?php echo '<b>'.$_SESSION['daftar_id'].'</b>';?> Bhg. Kej. Awam, CKAJ.
</table>

<fieldset> <small> <center>
<?php $count=mysql_query("SELECT COUNT(*) FROM butiran_sivil WHERE id_daftar ='{$_SESSION['daftar_id']}'");$count=mysql_fetch_array($count);
$count =$count[0]; 
if ( $count==0 ){ echo '<a href="'.$fileName.'?event=add">Input</a>'; } ?>

<a href="<?php echo "$fileName?event=Pinda";?>"><img src="img/favicon.ico" border="0" margin-top="-50" alt="java duke!"> 
Semak & Pinda</a>
</center> </small> </fieldset>
<fieldset> <small> <center>
<a href="<?php echo "projek_daftar.php?event=Pinda";?>">Daftar</a> |
<a href="<?php echo "projek_Dplan.php?event=Pinda";?>">D-Plan</a> |
<a href="<?php echo "projek_Perunding.php?event=Pinda";?>">Perunding</a> |
<a href="<?php echo "projek_butiran.php?event=Pinda";?>">Butiran</a> |
<!--a href="<?php echo "projek_sivil.php?event=Pinda";?>"-->Kerja Sivil<!--/a--> | 
<a href="<?php echo "projek_status.php?event=Pinda";?>">Status</a> |
<a href="<?php echo "projek_senarai.php?order={$_SESSION['order']}" ;?>">Senarai</a> |
<a href="<?php echo "http://".$ipthis."/ajax/editinplace-0.5.0/ulasan_sivil_general.php" ;?>">P.Teknikal</a> |
<a href="<?php echo "http://".$ipthis."/ajax/editinplace-0.5.0/penilaian_kriteria_earthwork.php" ;?>">P.Tender</a> |
<a href="<?php echo "http://".$ipthis."/ajax/editinplace-0.5.0/NeedsStatement.php" ;?>">N.S.</a> |
<a href="<?php echo "http://".$ipthis."/ajax/liveforms/MyBulkDrawings11.php" ;?>">D.Lukisan</a>
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

$id_daftar = $_REQUEST["id_daftar"];  //nombor projek
$OIC=$_REQUEST["OIC"];  //pereka
$luaran=$_REQUEST["luaran"];
$tanah=$_REQUEST["tanah"];
$bekalanair=$_REQUEST["bekalanair"];
$pembetungan=$_REQUEST["pembetungan"];
$jalan=$_REQUEST["jalan"];


$username=$_REQUEST["username"];
$kp_s=$_REQUEST["kp_s"];

$id_daftarEV = $_REQUEST["id_daftarEV"];
$OICEV=$_REQUEST["OICEV"];
$luaranEV=$_REQUEST["luaranEV"];
$tanahEV=$_REQUEST["tanahEV"];
$bekalanairEV=$_REQUEST["bekalanairEV"];
$pembetunganEV=$_REQUEST["pembetunganEV"];
$jalanEV=$_REQUEST["jalanEV"];
$usernameEV=$_REQUEST["usernameEV"];
$kp_sEV=$_REQUEST["kp_sEV"];

$Vid_daftar = $_REQUEST["Vid_daftar"];
$VOIC=$_REQUEST["VOIC"];
$Vluaran=$_REQUEST["Vluaran"];
$Vtanah=$_REQUEST["Vtanah"];
$Vbekalanair=$_REQUEST["Vbekalanair"];
$Vpembetungan=$_REQUEST["Vpembetungan"];
$Vjalan=$_REQUEST["Vjalan"];
$Vusername=$_REQUEST["Vusername"];
$Vkp_s=$_REQUEST["Vkp_s"];

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
///////////////////////////////////////////////////AAAA


if ($Submit=="Kerja Sivil") { 
$menu=1;
if (!isset($_SESSION['first_name'])) 
{die ("<center>Data tidak lengkap. <br/>Sila cuba lagi.</center>");} 

//$Vid_daftar = $id_daftarEV;
$startDate = $start;

$Vid_daftar = $id_daftarEV;
$VOIC=$OICEV;
$Vluaran=$luaranEV;
$Vtanah=$tanahEV;
$Vbekalanair=$bekalanairEV;
$Vpembetungan=$pembetunganEV;
$Vjalan=$jalanEV;

$Vusername=$usernameEV;
$Vkp_s=$kp_sEV;

//$id_daftar = $Vid_daftar;
$OIC=$OICEV;
$luaran= htmlspecialchars(stripslashes($luaranEV),ENT_QUOTES);
$tanah=htmlspecialchars(stripslashes($tanahEV),ENT_QUOTES);
$bekalanair=htmlspecialchars(stripslashes($bekalanairEV),ENT_QUOTES);
$pembetungan=htmlspecialchars(stripslashes($pembetunganEV),ENT_QUOTES);
$jalan=htmlspecialchars(stripslashes($jalanEV),ENT_QUOTES);

$kp_s = $_SESSION['kp_s'];
$username = $_SESSION['username'];
$id_daftar = $_SESSION['daftar_id'];

?> 
<!-------------------butiran sivil------------------------->
<?php // Make sure the username is available.
		//$query = "SELECT nomgertak FROM butiran_sivil WHERE id_daftar = {$_SESSION['daftar_id']}";
$count=mysql_query("SELECT COUNT(*) FROM butiran_sivil  WHERE id_daftar ='{$_SESSION['daftar_id']}'");
$count=mysql_fetch_array($count);
		
		/*$result = @mysql_query ($query);
		echo $result;
		echo mysql_num_rows($result).'<br/>' ;
		$kkk = mysql_num_rows($result);  
		for ($k = 0 ; $k < $kkk ; $k++){
		echo mysql_result( $result,$k ).'==>'.$startDate;
		echo '<br/>';
		} */
		
		if ($count == 0) { // Available.
				echo '<h5 align="center">butiran sivil untuk tarikh  '.$startDate.'  telah ada. Sila buat pindaan!</h5>';
				//include ('footer.htm'); // Include the HTML footer.
				exit();}
else
/////////////////////////////////////////////////////////////
{ ?>

<div align="center" class="style4">
<strong><span>Pasti kerja sivil Projek ini!</span>
</strong></div>

<form name="form2" method="post" action="<?php echo $fileName ?>">
<div align="center"> 

<table width="800" border="1" align="center" cellpadding="6" cellspacing="0" bordercolor= "#FDFECF" bgcolor= "#EBEEF5">
<tr align="center"> <td colspan="2">
<small>TAJUK PROJEK:</small><br/><font color="darkgreen" size="4em" >
<?php echo $_SESSION['tajuk'].'</font><br/><font color="darkkhaki" size="1em">'.$_SESSION['mod_kerja'].'</font>';?> 
</td></tr>

<tr><td width="150" align="right"><small>Tarikh Laporan:</small></td> <td width="650" align="left"> 
<small><?php echo $startDate ?></small>
</td> </tr> 

<!-------------------------------to note ------------------------------------------->
<!--tr> <td align="right"><small>Pereka:</small></td> <td align="left"><small-->
<?php //echo $OIC ?>
<!--/small></td> </tr-->

<tr> <td align="right"><small>Kerja Luar/saliran :</small></td> <td align="left">
<small><?php echo $luaran ?></small>
</td> </tr>

<tr> <td align="right"><small>Kerja Tanah:</small></td> <td align="left">
<small><?php echo $tanah ?></small>
</td> </tr>

<tr> <td align="right"><small>Kerja Bekalan Air:</small></td> <td align="left">
<small><?php echo $bekalanair ?></small>
</td> </tr>

<tr> <td align="right"><small>Kerja Pembetungan:</small></td> <td align="left">
<small><?php echo $pembetungan ?></small>
</td> </tr>

<tr> <td align="right"><small>Kerja Jalan:</small></td> <td align="left">
<small><?php echo $jalan ?></small>
</td> </tr>

<tr align="center"> <td colspan="2"><input type="submit" name="Submit" value="Simpan Data"> 
<input type="button" name="Button" value="Pinda" onClick="history.back();">
<input type="button" name="Button" value="Batal Tambah" onClick="location='<?php echo $fileName ?>'"> 
<br/><font color="gray"><small>
Username:<?php echo $_SESSION['username'] ?> &nbsp;&nbsp;<i>
Pendaftar id<small>[<?php echo $_SESSION['kp_s']; ?>]</i></small></font>

<input name="start" type="hidden" id="start" value="<?php echo $start ?>">
<input name="end" type="hidden" id="end" value="<?php echo $Bilangan ?>"> 

<input name="id_daftar" type="hidden" id="id_daftar" value="<?php echo $id_daftar ?>">
<input name="OIC"	type="hidden" id="OIC" value="<?php echo $OIC ?>">
<input name="luaran" type="hidden" id="luaran" value="<?php echo $luaran ?>">
<input name="tanah" type="hidden" id="tanah" value="<?php echo $tanah ?>">
<input name="bekalanair" type="hidden" id="bekalanair" value="<?php echo $bekalanair ?>">
<input name="pembetungan" type="hidden" id="pembetungan" value="<?php echo $pembetungan ?>">
<input name="jalan" type="hidden" id="jalan" value="<?php echo $jalan ?>">

<input name="username" type="hidden" id="username" value="<?php echo $username ?>">	
<input name="kp_s" type="hidden" id="kp_s" value="<?php echo $kp_s ?>">

</td> </tr> </table> </form>

<?php }} 
///////////////////////////////////////////////////////////////////////////////^x}
if ($Submit=="Simpan Data") { $menu=1;
//$Bilangan=$end;
//$Bilangan=$eventlength;
$startDate = $start;
//$siapDate = date("Y-m-d",$start0);

$blokPengurus = trim($_SESSION['first_name']);




if (isset($_SESSION['first_name']))
if (isset($_SESSION['daftar_id']))

{$sql="INSERT INTO butiran_sivil
(id_daftar,OIC,luaran,tanah,bekalanair,pembetungan,jalan,
username,kp_s,startDate,regist_date)
VALUES
('$id_daftar','$OIC','$luaran','$tanah','$bekalanair','$pembetungan','$jalan',
'$username','$kp_s','$startDate',NOW())";

$result=mysql_query($sql); 
if (!$result) {
die('<center>Data tidak dikemaskini :  ' . mysql_error().'<br/><font color="gray"><small>Input error</small></font>');}
	else 
		{
		ob_end_clean(); // Delete the buffer.		
		header ("Location:  http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/projek_sivil.php?event=Pinda");
		exit();

		echo "<center>Data telah diupload </center><br>";}}

else 
{echo "<center>Pilih satu projek untuk set butiran sivil!</center>";}
else 
{echo "<center>PPK saja dibolehkan daftar projek baru.</center>";}}




if ($event=="add") 
if (!isset($_SESSION['first_name'])) {die ("<center>Anda tidak LOGIN !</center>");} 
else
{ $menu=1;
$count=mysql_query("SELECT COUNT(*) FROM butiran_sivil WHERE id_daftar ='{$_SESSION['daftar_id']}'");$count=mysql_fetch_array($count);
$count =$count[0];
//echo $count.'--'.$daftar_id.'--'.$id_daftar.'=='.$_SESSION['daftar_id']  ;
$Bilangan=$count+1;
if ( $count <>0 )
{die ("<center><font color=\"red\">Semua Data telah diupload ke pengkalan. <br/>Sila buat pindaan.</font></center>");} 

?>

<form name="form1" method="post" action="<?php echo $fileName ?>">
<div align="center"> 
<table width="1200" border="1" align="center" cellpadding="4" cellspacing="0" bordercolor="#FDFECF" bgcolor= "#EBEEF5" > 
 
<tr align="center"> <td colspan="1" > </td> <td colspan="3">
<small>TAJUK PROJEK:</small><br/><font color="darkgreen" size="4em" >
<?php echo $_SESSION['tajuk'].'</font><br/><font color="darkkhaki" size="1em">'.$_SESSION['mod_kerja'].'</font>';?> 
</td><td colspan="1"> </td> </tr>

<tr> <td width="240" align="right"><small><b>Tarikh Laporan:</b></small></td> 
<td width="600" align="left" colspan="3" >
<!--------------------------------New date format----------------------------------------->
<script> DateInput( 'start', true, 'YYYY-MM-DD')</script>
</td>
<td width="240">:</td>
</tr> 

<tr> <td width="240"> LUAR/SALIRAN </td>
<td width="240"> TANAH </td>
<td width="240"> BEKALAN AIR </td>
<td width="240"> PEMBETUNGAN </td>
<td width="240" > JALAN </td>
</tr>


<!--tr><td align="right"><small>id_daftar:</td><td align="left">
<textarea name="id_daftarEV" cols="80" rows="1" id="id_daftarEV"></textarea></small></td></tr-->

<!--tr><td align="right"><small>OIC:</td><td align="left">
<textarea name="OICEV" cols="80" rows="1" id="OICEV"></textarea></small></td></tr-->

<tr><td align="left" width="240" ><small>
<textarea name="luaranEV" cols="40" rows="45" id="luaranEV" style="font-size:10px;font-weight:normal
;font-family:Verdana,Arial,Helvetica;background:white url(../bground/sand2.jpg)">
Longkang ; Sump ; Swail ; Subsoil ; Penahan Hakisan ; Turfing ; Tembok 

#


1::Umum
#1.1 Blok tajuk

#1.2 Pelan lokasi termasuk batu sempadan untuk tapak dan lot-lot bersebelahan, nama jalan, sungai dalam kawasan dan arah ke bandar berdekatan.

#1.3 Tunjuk arah Utara.

#1.4 Skala (1 : 500 atau 1 : 1000)

#1.5 Warna:Butiran  ; Merah:Kerja-kerja baru ; Kuning:Jalan/dataran kejat ; Hijau:Tanaman rumput ; Biru:Kerja-kerja meroboh

#2::Keadaan tanah.

#2.1 Jalan masuk ke cadangan tapak dan bangunan-bangunan sediada.

#2.2.1 Keadaan - elok / rosak

#2.2.2 Bangunan sediada

#- asas bangunan sediada mungkin terjejas oleh kerja-kerja cerucuk.

#- kawasan antara bangunan-bangunan sediada tidak mencukupi atau yang mungkin akan menimbulkan masalah pembinaan.
</textarea></small></td>

<td align="left" width="240" >
<textarea name="tanahEV" cols="40" rows="45" id="tanahEV" style="font-size:10px;font-weight:normal
;font-family:Verdana,Arial,Helvetica;background:white url(../bground/sand2.jpg)">
Potong ; Tambak ; Unsuitable ; import-export-removal ;  Batu-batan

#


2.2 Keadaan Fizikal Tanah

#2.2.1 Lukisan kontor atau aras titik, termasuk keadaan tanah bersebelahan jika perlu.

#2.2.2 Gambaran secara umum:

#- berpaya atau berbatu.

#- jenis tumbuh-tumbuhan jika ada.

#- punca air.

#- ekoloji.

#2.2.3 Perbezaan antara aras sediada dengan aras formasi yang dicadangkan:

#(i) mass-haul diagram or other method:

#- balanced.
#- imported fill / borrow area.
#- excessive cut.

#(ii) slope stability.

#(iii) road gradient ( < 1 : 10 ).

#(iv) paras banjir ikut rekod JPT dan kemungkinan banjir.



</textarea></small></td>

<td align="left" width="240" >
<textarea name="bekalanairEV" cols="40" rows="45" id="bekalanairEV" style="font-size:10px;font-weight:normal
;font-family:Verdana,Arial,Helvetica;background:white url(../bground/sand2.jpg)">
Kegunaan Harian ; Tangki Simpanan ; Tekanan ; Sedutan ; Pump/Graviti ; Paip - bahan , ukuran , panjang , specials

#


#2.2.4 Orientasi bangunan / tataatur blok:

#(i) mengikut arah Timur-Barat seberapa boleh.

#(ii) punca kebisingan - di"staggered" jika boleh.

#(iii) bangunan satu tingkat atau bertingkat.

#(iv) arah angin.

#(v) Bangunan-bangunan sediada.


#3::Kemudahan-kemudahan.

#3.1.4 Sistem retikulasi air.

#- menara tangki air jika perlu.

#- tangki sedut / pam jika perlu.

#- pili bomba jika perlu.

#- paip air : saiz, jenis / kelas.

#- meter air.

#- paip air sediada perigi / pam air untuk kawasan tiada bekalan air.	
		
</textarea></small></td>


<td align="left" width="240" >
<textarea name="pembetunganEV" cols="40" rows="45" id="pembetunganEV" style="font-size:10px;font-weight:normal
;font-family:Verdana,Arial,Helvetica;background:white url(../bground/sand2.jpg)">
PE ; Tangki - kapasiti , bahan ; Paip - bahan , ukuran , panjang , Lurang 


#


#3.1 Sistem pembentungan / pembersihan pembentungan.

#3.1.1 Saluran pembentungan:

#- jenis spt. VCP.

#- saiz ( minima 6" atau 150mm ).

#- cerun dan arah.

#- lurang - saiz dan aras ( invert level ).

#- kemudahan jalan ke pusat pembersihan najis (untuk kerja penyelenggaraan)

#3.1.2 Sistem pembersihan pembentungan:

#- sistem pusat.

#- alternatif sistem pembersihan pembentungan.

#3.1.3 Sistem saliran permukaan:

#- arah pembuangan air.

#- saliran : jenis, saiz / arah.

#- takungan / pembetong : jenis, saiz, gradient / invert level.

</textarea></small></td>

<td align="left" width="240" >
<textarea name="jalanEV" cols="40" rows="45" id="jalanEV" style="font-size:10px;font-weight:normal
;font-family:Verdana,Arial,Helvetica;background:white url(../bground/sand2.jpg)">
Jalan Dalaman ; Struktur jalan ; Kerb ; Bahu ; Scupper drain ; Simpang ; Papan Tanda ; Garisan Jalan ; Penghadang ; Access ; Safety ; AC/DC
#


4::Kajian Peruntukan.

#- Kepadatan

#- Had tinggi maksima

#- Keperluan letak kereta

#- Arahan pembangunan

#- Program pembesaran

#5::Kajian Keselamatan.

#- Keperluan bomba

#- Cul-de-sac

#- Alternatif pintu masuk

#- Privacy



#6::Gambar / rekod sediada.

#- Foto tapak jika ada khususnya untuk tapak yang rumit.

#- Rekod / maklumat sediada.

</textarea></small></td></tr>

<!--tr><td align="right"><small>username:</td><td align="left">
<textarea name="usernameEV" cols="64" rows="1" id="usernameEV"></textarea></small></td></tr-->

<!--tr><td align="right"><small>kp_s:</td><td align="left">
<textarea name="kp_sEV" cols="64" rows="1" id="kp_sEV"></textarea></small></td></tr-->


<tr align="center"> <td colspan="5">
<input type="submit" name="Submit" value="Kerja Sivil"> 
<input type="button" name="Button" value="Batal Tambah" onClick="location=' <?php echo $fileName ?> '">
<br/><font color="gray"><small>
Username:<?php echo $_SESSION['username'] ?> &nbsp;&nbsp;<i>
Pendaftar id<small>[<?php echo $_SESSION['kp_s']; ?>]</i></small></font>
</small></td></tr> 
</table> </form> 

<?php }//}
if ($event=="Pinda")
if (!isset($_SESSION['first_name'])) {echo '<center>Sila pilih satu projek dari SENARAI dan anda mesti LOGIN</center>';}
else
{$menu=1;$result=mysql_query("SELECT * FROM butiran_sivil WHERE id_daftar = {$_SESSION['daftar_id']}",$db);
//$myrow=mysql_fetch_array($result);
$myrow=mysql_fetch_assoc($result);
//echo $kp_s;
if (!$myrow) {echo '<center> Belum ada butiran kerja sivil diupload.<br/>Klik Input.</center>';} 
else

//if ($myrow)
 { ?> 

<table width="1200" border="1" align="center" cellpadding="1" cellspacing="0" bordercolor="#E4E4E4"> 
<tr bgcolor="#EBEEF5"> <td width="240" align="center">Pinda</td>  
<!-----------------------------v to chk---------------------------------------->
<!-----td width="35" align="center">Days</td----------------------------------->
<td width="650" align="center" colspan="3" bgcolor="#FDFECF" bordercolor="#EBEEF5" >
<small>TAJUK PROJEK:</small><br/><font color="darkgreen" size="4em" >
<?php echo $_SESSION['tajuk'].'</font><br/><font color="darkkhaki" size="1em">'.$_SESSION['mod_kerja'].'</font>';?> 
</td>
<td width="240" align="center">Upload lukisan</td> 
</tr> 

<?php 
//$Bilangan = 1;
do { 
//if ($dateFormat==1) 
//{ $first=intval(strtotime($myrow[startDate])/86400);
//$start=date("m-d-Y",strtotime($myrow[startDate]));
//$end = 1;
//$days =$end;
//------------------------------------------------------------------------------
//$sokong =$myrow[sokong];
//$sokong =$Vsokong;
//}

//if ($dateFormat==2) 
//{ $first=intval(strtotime($myrow[startDate])/86400);
//$day   = date("j");                  } 
//----------------------------------------------
//$end = 1;

$Vid_daftar = $myrow[id_daftar];
$VOIC=$myrow[OIC];
$Vluaran=$myrow[luaran];
$Vtanah=$myrow[tanah];
$Vbekalanair=$myrow[bekalanair];
$Vpembetungan=$myrow[pembetungan];
$Vjalan=$myrow[jalan];

//$Vusername=$myrow[username];
//$Vkp_s=$myrow[kp_s];

//$id_daftar = htmlspecialchars(stripslashes($Vid_daftar),ENT_QUOTES);
$OIC = $VOIC;
$luaran= htmlspecialchars(stripslashes($Vluaran),ENT_QUOTES);
$tanah=htmlspecialchars(stripslashes($Vtanah),ENT_QUOTES);
$bekalanair=htmlspecialchars(stripslashes($Vbekalanair),ENT_QUOTES);
$pembetungan=htmlspecialchars(stripslashes($Vpembetungan),ENT_QUOTES);
$jalan=htmlspecialchars(stripslashes($Vjalan),ENT_QUOTES);

//$username=htmlspecialchars(stripslashes($Vusername),ENT_QUOTES);
//$kp_s=htmlspecialchars(stripslashes($Vkp_s),ENT_QUOTES);

$kp_s = $_SESSION['kp_s'];
$username = $_SESSION['username'];
$id_daftar = $_SESSION['daftar_id'];
////////////////////////////////////////////////////////////////////////////////////////////
/////////////////call dplan ////////////////////////////////////////////////////////////////
$rslt=mysql_query("SELECT startDate AS tmula , 
sketch_proposal AS sketch ,
analisa AS anal ,
rekabentuk AS reka ,
lukisan AS lukis ,
Bill_Q AS bill ,
Tender_doc AS tender ,
Design_report AS report
                     FROM Dplan_projek WHERE id_daftar = {$_SESSION['daftar_id']}",$db);
		while ($proj = mysql_fetch_array ($rslt)) {
		$_SESSION['tmula'] = $proj[0];
		$_SESSION['sketch'] = $proj[1];
		$_SESSION['anal'] = $proj[2];
		$_SESSION['reka'] = $proj[3];
		$_SESSION['lukis'] = $proj[4];
		$_SESSION['bill'] = $proj[5];
		$_SESSION['tender'] = $proj[6];
		$_SESSION['report'] = $proj[7];}

$dplan =explode("-", $_SESSION['tmula']);
$trklapor =explode("-", $start);
$chktempohsifar = 0; $cts1=1;$cts2=1;$cts3=1;$cts4=1;$cts5=1;$cts6=1;$cts7=1;

//echo 'lapor:::'.$trklapor[0].'-'.$trklapor[1].'-'.$trklapor[2];


$D = date("j") ; $M = date("n") ; $Y = date("Y") ;
if ($D < $dplan[2] ): $D += 30 ; $M -= 1 ;
                   if ( $M = 0 ): $M = 12 ; $Y -= 1 ; endif ;
                   if ( $M = $dplan[1] ): $M = $M ; $Y = $Y ; endif ;
                   if ( $M < $dplan[1] ): $M += 12 ; $Y -= 1 ; endif ;
endif ;
$d_sketch = round((($D - $dplan[2])/7 + ($M - $dplan[1]) + ($Y - $dplan[0])*52)/$_SESSION['sketch'],3)*100 ;
//$d_sketch = round((($D - $d)/7 + ($M - $m) + ($Y - $y)*52)/$_SESSION['sketch'],3)*100 ;
?>

<tr> 
<td align="center" colspan="1"  bgcolor="#E4F3CF"><small><a href="<?php echo $fileName ?>?eid=<?php 
echo $myrow[id] ?>"> <img src="img/favicon.ico" border="0" margin-top="-50"></a> </td>

<td align="center" colspan="3"><small> Mula rekabentuk: &nbsp;&nbsp;

<?php $bar1 = ''; $pixel = $_SESSION['sketch']; $pixel1 = 0;
if ($pixel == 0){ $chktempohsifar += 0; $cts1 = 0; } else { $chktempohsifar += 1;} 
$T = $pixel ; $d = $dplan[2] ; $m = $dplan[1] ; $y = $dplan[0] ; 
$D = $trklapor[0] ; $M = $trklapor[1] ; $Y = $trklapor[2] ;
if ( $D < $d ): $D += 30 ; $M -= 1 ; $c1 = $M ; 
                   if ( $c1 === 0 ): $M = 12 ; $Y -= 1 ; endif ;
                   if ( $c1 === $m ): $M = $M ; $Y = $Y ; endif ;
                   if ( $c1 > $m ): $M = $M ; $Y = $Y ; endif ;
                   if ( $c1 < $m ): $M += 12 ; $Y -= 1 ; endif ; endif ;
if ( $D > $d || $D === $d ): $D = $D ; $c1 = $M ; 
                   if ( $c1 === $m ): $M = $M ; $Y = $Y ; endif ;
                   if ( $c1 < $m ): $M += 12 ; $Y -= 1 ; endif ; endif ;
//echo '<br/>--->chk 1>>' .$D.'-'.$M.'-'.$Y. '---chk >' .$d.'-'.$m.'-'.$y;
$d_sketch = round((($D - $d)/7 + ($M - $m)*4 + ($Y - $y)*52)/$_SESSION['sketch'],3)*100 ;
while ($T > 4 ): $m += 1; if ($m > 12):  $m -= 12; $y +=1 ;endif; $T -= 4 ; endwhile;
$m = $m; $T = $T*7 + $d; $d = $T;
while ($T > 30):$T -= 30; $d = $T; $m += 1; if ($m > 12):  $m -= 12; $y +=1 ; endif; endwhile;
for ($j=0;$j<=$pixel-1;$j++){$bar1 .=':';}   ?>

<?php $bar2 = ''; $pixel = $_SESSION['anal'] ; $pixel2 = $pixel1 + strlen($bar1) ; $T = $pixel ; 
if ($pixel == 0){ $chktempohsifar += 0; $cts2 = 0; } else { $chktempohsifar += 1;} 
$D = $trklapor[0] ; $M = $trklapor[1] ; $Y = $trklapor[2] ;
if ( $D < $d ): $D += 30 ; $M -= 1 ; $c1 = $M ; 
                   if ( $c1 === 0 ): $M = 12 ; $Y -= 1 ; endif ;
                   if ( $c1 === $m ): $M = $M ; $Y = $Y ; endif ;
                   if ( $c1 > $m ): $M = $M ; $Y = $Y ; endif ;
                   if ( $c1 < $m ): $M += 12 ; $Y -= 1 ; endif ; endif ;
if ( $D > $d || $D === $d ): $D = $D ; $c1 = $M ; 
                   if ( $c1 === $m ): $M = $M ; $Y = $Y ; endif ;
                   if ( $c1 < $m ): $M += 12 ; $Y -= 1 ; endif ; endif ;
//echo '<br/>--->chk 2>>' .$D.'-'.$M.'-'.$Y. '---chk >' .$d.'-'.$m.'-'.$y;
$d_anal = round((($D - $d)/7 + ($M - $m)*4  + ($Y - $y)*52)/ $_SESSION['anal'] ,3)*100 ;
while ($T > 4 ): $m += 1; if ($m > 12):  $m -= 12; $y +=1 ;endif; $T -= 4 ; endwhile;
$m = $m; $T = $T*7 + $d; $d = $T;
while ($T > 30):$T -= 30; $d = $T; $m += 1; if ($m > 12):  $m -= 12; $y +=1 ; endif; endwhile;
for ($j=0;$j<=$pixel-1;$j++){$bar2 .=':';}   ?> 

<?php $bar3 = ''; $pixel = $_SESSION['reka'] ; $pixel1 = $pixel2 + strlen($bar2) ; $T = $pixel ; 
if ($pixel == 0){ $chktempohsifar += 0; $cts3 = 0; } else { $chktempohsifar += 1;} 
$D = $trklapor[0] ; $M = $trklapor[1] ; $Y = $trklapor[2] ;
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
$d_reka = round((($D - $d)/7 + ($M - $m)*4  + ($Y - $y)*52)/ $_SESSION['reka'] ,3)*100 ;
for ($j=0;$j<=$pixel-1;$j++){$bar3 .=':';} ?> 

<?php $bar4 = ''; $pixel = $_SESSION['lukis'] ; $pixel2 = $pixel1 + strlen($bar3) ; $T = $pixel  ; 
if ($pixel == 0){ $chktempohsifar += 0; $cts4 = 0; } else { $chktempohsifar += 1;} 
$D = $trklapor[0] ; $M = $trklapor[1] ; $Y = $trklapor[2] ;
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
$d_lukis = round((($D - $d)/7 + ($M - $m)*4  + ($Y - $y)*52)/ $_SESSION['lukis'] ,3)*100 ;
for ($j=0;$j<=$pixel-1;$j++){$bar4 .=':';} ?> 

<?php $bar5 = ''; $pixel = $_SESSION['bill'] ; $pixel1 = $pixel2 + strlen($bar4) ; $T = $pixel ; 
if ($pixel == 0){ $chktempohsifar += 0; $cts5 = 0; } else { $chktempohsifar += 1;} 
$D = $trklapor[0] ; $M = $trklapor[1] ; $Y = $trklapor[2] ;
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
$d_bill = round((($D - $d)/7 + ($M - $m)*4  + ($Y - $y)*52)/ $_SESSION['bill'] ,3)*100 ;
for ($j=0;$j<=$pixel-1;$j++){$bar5 .=':';}   ?> 

<?php $bar6 = ''; $pixel = $_SESSION['tender'] ; $pixel2 = $pixel1 + strlen($bar5) ; $T = $pixel ; 
if ($pixel == 0){ $chktempohsifar += 0; $cts6 = 0; } else { $chktempohsifar += 1;} 
$D = $trklapor[0] ; $M = $trklapor[1] ; $Y = $trklapor[2] ;
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
$d_tender = round((($D - $d)/7 + ($M - $m)*4  + ($Y - $y)*52)/ $_SESSION['tender'] ,3)*100 ;
for ($j=0;$j<=$pixel-1;$j++){$bar6 .=':';}   ?> 

<?php $bar7 = ''; $pixel = $_SESSION['report'] ; $pixel1 = $pixel2 + strlen($bar6) ; $T = $pixel ; 
if ($pixel == 0){ $chktempohsifar += 0; $cts7 = 0; } else { $chktempohsifar += 1;} 
$D = $trklapor[0] ; $M = $trklapor[1] ; $Y = $trklapor[2] ;
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
$d_report = round((($D - $d)/7 + ($M - $m)*4  + ($Y - $y)*52)/ $_SESSION['report'] ,3)*100 ;
for ($j=0;$j<=$pixel-1;$j++){$bar7 .=':';}   

echo $dplan[2].'-'.$dplan[1].'-'.$dplan[0] .'&nbsp;&nbsp;----->&nbsp;&nbsp;'. $d.'-'.$m.'-'.$y ;
?>
&nbsp;&nbsp; :perlu siap </small> </td> 
<td align="center" colspan="1"  bgcolor="#E4C3CC"><small><a href="html/add_file.php?uj=<?php echo $_SESSION['daftar_id']?>" onClick="location:ctrl+T;" > 
<img src="img/favicon.ico" border="0" margin-top="-50"></small></a> </td>
</tr>

<tr> <td width="240"> LUAR/SALIRAN </td>
<td width="240"> TANAH </td>
<td width="240"> BEKALAN AIR </td>
<td width="240"> PEMBETUNGAN </td>
<td width="240" > JALAN </td>
</tr>

<tr> 
<?php
$_SESSION['order'] = $OIC; ?>
<?php echo 
'<tr><td align="left" width="240">
<textarea cols="40" rows="45" style="font-size:10px;font-weight:normal
;font-family:Verdana,Arial,Helvetica">
>'
.$luaran. 
'</textarea></small></td>'.

'<td align="left" width="240">
<textarea cols="40" rows="45" style="font-size:10px;font-weight:normal
;font-family:Verdana,Arial,Helvetica">
>'
.$tanah. 
'</textarea></small></td>'.

'<td align="left" width="240">
<textarea cols="40" rows="45" style="font-size:10px;font-weight:normal
;font-family:Verdana,Arial,Helvetica">
>'
.$bekalanair. 
'</textarea></small></td>'.

'<td align="left" width="240">
<textarea cols="40" rows="45" style="font-size:10px;font-weight:normal
;font-family:Verdana,Arial,Helvetica">
>'
.$pembetungan. 
'</textarea></small></td>'.

'<td align="left" width="240">
<textarea cols="40" rows="45" style="font-size:10px;font-weight:normal
;font-family:Verdana,Arial,Helvetica">
>'
.$jalan. 
'</textarea></small></td></tr>';

 ?>

<?php } 
while ($myrow=mysql_fetch_array($result));?>
</table> <br> 
<?php } } 
if ($eid) 
{ $menu=1;$result=mysql_query("SELECT * FROM butiran_sivil WHERE id='$eid'",$db);
$myrow=mysql_fetch_array($result);
$dates=explode("-",$myrow[startDate]);?> 
<?php //$dates0=explode("-",$myrow[siapDate]);?> 

<form name="form1" method="post" action="<?php echo $fileName ?>">
<div align="center"> 
<table width="1200" border="1" align="center" cellpadding="4" cellspacing="0" bordercolor="#FDFECF" bgcolor= "#EBEEF5" > 
 
<tr align="center"> <td colspan="1" > </td> <td colspan="3">
<small>TAJUK PROJEK:</small><br/><font color="darkgreen" size="4em" >
<?php echo $_SESSION['tajuk'].'</font><br/><font color="darkkhaki" size="1em">'.$_SESSION['mod_kerja'].'</font>';?> 
</td><td colspan="1"> </td> </tr>

<tr> <td width="240" align="right"><small><b>Tarikh Laporan Rekabentuk:</b></small></td> 
<td width="600" align="left" colspan="3" >
<!----------------------------------------------------DateInput------------------------------------------------------------->
<script> DateInput( 'start', true, 'YYYY-MM-DD','<?php echo $myrow[startDate]; ?>' )</script>
</td>
<td width="240">:</td>
</tr> 

<tr> <td width="240"> LUAR/SALIRAN </td>
<td width="240"> TANAH </td>
<td width="240"> BEKALAN AIR </td>
<td width="240"> PEMBETUNGAN </td>
<td width="240" > JALAN </td>

</tr>


<!--tr><td align="right"><small>id_daftar:</td><td align="left">
<textarea name="id_daftarEV" cols="80" rows="1" id="id_daftarEV"></textarea></small></td></tr-->

<!--tr><td align="right"><small>OIC:</td><td align="left">
<textarea name="OICEV" cols="80" rows="1" id="OICEV"></textarea></small></td></tr-->

<tr><td align="left" width="240" >
<textarea name="luaranEV" cols="40" rows="45" id="luaranEV" style="font-size:10px;font-weight:normal
;font-family:Verdana,Arial,Helvetica">
<?php echo $myrow['luaran'] ?> 
</textarea></small></td>

<td align="left" width="240" >
<textarea name="tanahEV" cols="40" rows="45" id="tanahEV" style="font-size:10px;font-weight:normal
;font-family:Verdana,Arial,Helvetica">
<?php echo $myrow['tanah'] ?> 
</textarea></small></td>

<td align="left" width="240" >
<textarea name="bekalanairEV" cols="40" rows="45" id="bekalanairEV" style="font-size:10px;font-weight:normal;font-family:Verdana,Arial,Helvetica">
<?php echo $myrow['bekalanair'] ?> 
</textarea></small></td>


<td align="left" width="240" >
<textarea name="pembetunganEV" cols="40" rows="45" id="pembetunganEV" style="font-size:10px;font-weight:normal;font-family:Verdana,Arial,Helvetica">
<?php echo $myrow['pembetungan'] ?> 
</textarea></small></td>

<td align="left" width="240" >
<textarea name="jalanEV" cols="40" rows="45" id="jalanEV" style="font-size:10px;font-weight:normal;font-family:Verdana,Arial,Helvetica">
<?php echo $myrow['jalan'] ?> 
</textarea></small></td></tr>

<!--tr><td align="right"><small>username:</td><td align="left">
<textarea name="usernameEV" cols="64" rows="1" id="usernameEV"></textarea></small></td></tr-->

<!--tr><td align="right"><small>kp_s:</td><td align="left">
<textarea name="kp_sEV" cols="64" rows="1" id="kp_sEV"></textarea></small></td></tr-->

<!----------------->
<tr align="center">
<td colspan="5"><input type="submit" name="Submit" value="Pinda Data"> 
<input type="button" name="Button" value="Batal Pindaan" onClick="location='<?php echo $fileName.'?event=Pinda'; ?>'">
<br/><font color="gray"><small>
Username: <?php echo $_SESSION['username'] ?> &nbsp;&nbsp;<i>
Pendaftar id<small>[<?php echo $_SESSION['kp_s']; ?>]</i></small></font>

<input name="id" type="hidden" id="id" value="<?php echo $myrow[id] ?>"></td></tr> 
<input name="id_daftar" type="hidden" id="id_daftar" value="<?php echo $myrow[id_daftar] ?>"> 

<!----------------->
</table> </form> 

<center>[
<a href="<?php echo "$fileName?del=$myrow[id]";?>" onCLick="return confirmDelete() ;">Padam Data</a>]
<br> <br> </center> 
<?php } 
if ($del) { $menu=1;$delsql="DELETE from butiran_sivil WHERE id='$del';";$delresult=mysql_query($delsql);
echo "<center>Data telah dipadamkan !</center><br>";} 

if ($Submit=="Pinda Data"){ $menu=1;
//$end=$eventLength;

$startDate=$start;
//if ($dateFormat==1) { $startDate=date("m-d-Y",$start);}  //$Bilangan=$end;} 
//if ($dateFormat==2) { $startDate=date("d-m-Y",$start);}  //$Bilangan=$end;} 

//$id_daftar = $id_daftarEV;
$OIC = $OICEV;
$luaran=htmlspecialchars(stripslashes($luaranEV),ENT_QUOTES);
$tanah=htmlspecialchars(stripslashes($tanahEV),ENT_QUOTES);
$bekalanair=htmlspecialchars(stripslashes($bekalanairEV),ENT_QUOTES);
$pembetungan=htmlspecialchars(stripslashes($pembetunganEV),ENT_QUOTES);
$jalan=htmlspecialchars(stripslashes($jalanEV),ENT_QUOTES);

//$username=htmlspecialchars(stripslashes($usernameEV),ENT_QUOTES);
//$kp_s=htmlspecialchars(stripslashes($kp_sEV),ENT_QUOTES);

/////////////////
?> 

<form name="form2" method="post" action="<?php echo $fileName ?>">
<div align="center"> 
<table width="800" border="1" align="center" cellpadding="6" cellspacing="0" bordercolor= "#FDFECF" bgcolor= "#EBEEF5">
<tr align="center"> <td colspan="2">
<small>TAJUK PROJEK:</small><br/><font color="darkgreen" size="4em" >
<?php echo $_SESSION['tajuk'].'</font><br/><font color="darkkhaki" size="1em">'.$_SESSION['mod_kerja'].'</font>';?> 
</td></tr>

<tr><td width="150" align="right"><small>Tarikh Laporan:</small></td> <td width="650" align="left"> 
<small><?php echo $startDate ?></small>
</td> </tr> 

<!-------------------------------to note ------------------------------------------->
<!--tr> <td align="right"><small>Pereka:</small></td> <td align="left"><small-->
<?php //echo $OIC ?>
<!--/small></td> </tr-->

<tr> <td align="right"><small>Kerja Luar/saliran :</small></td> <td align="left">
<small><?php echo $luaran ?></small>
</td> </tr>

<tr> <td align="right"><small>Kerja Tanah:</small></td> <td align="left">
<small><?php echo $tanah ?></small>
</td> </tr>

<tr> <td align="right"><small>Kerja Bekalan Air:</small></td> <td align="left">
<small><?php echo $bekalanair ?></small>
</td> </tr>

<tr> <td align="right"><small>Kerja Pembetungan:</small></td> <td align="left">
<small><?php echo $pembetungan ?></small>
</td> </tr>

<tr> <td align="right"><small>Kerja Jalan:</small></td> <td align="left">
<small><?php echo $jalan ?></small>
</td> </tr>

<tr align="center"> <td colspan="2">
<input type="submit" name="Submit" value="Simpan Pindaan"> 
<input type="button" name="Button" value="Pinda" onClick="history.back();"> 
<input type="button" name="Button" value="Batal Pindaan" onClick="location='<?php echo $fileName.'?event=Pinda'; ?>'"> 
<br/><font color="gray"> <i><small>Pendaftar id<small>[<?php echo $_SESSION['kp_s'] ?>]</small></small></i></font> 
 
<input name="start" type="hidden" id="start" value="<?php echo $start ?>"> 
<input name="end" type="hidden" id="end" value="<?php echo $end ?>"> 
<input name="id" type="hidden" id="id" value="<?php echo $id ?>"> 

<input name="id_daftar" type="hidden" id="id_daftar" value="<?php echo $_SESSION['daftar_id'] ?>">

<input name="OIC"	type="hidden" id="OIC"	value="<?php echo $OIC ?>">
<input name="luaran"	type="hidden" id="luaran"	value="<?php echo $luaran ?>">
<input name="tanah"	type="hidden" id="tanah"	value="<?php echo $tanah ?>">
<input name="bekalanair"	type="hidden" id="bekalanair"	value="<?php echo $bekalanair ?>">
<input name="pembetungan"	type="hidden" id="pembetungan"	value="<?php echo $pembetungan ?>">
<input name="jalan"	type="hidden" id="jalan"		value="<?php echo $jalan ?>">

<input name="username" type="hidden" id="username" value="<?php echo $_SESSION['username'] ?>">
<input name="kp_s" type="hidden" id="kp_s" value="<?php echo $_SESSION['kp_s'] ?>">
</td> </tr> 
</table> </form>

<?php } 
if ($Submit=="Simpan Pindaan") 
{ $menu=1;
$Bilangan=$end;
//$catatan = htmlspecialchars($Vcatatan,ENT_QUOTES);
//$keputusan = htmlspecialchars($Vkeputusan,ENT_QUOTES);
//$pereka = htmlspecialchars($Vpereka,ENT_QUOTES);
//$nomgertak = htmlspecialchars($Vnomgertak,ENT_QUOTES);
//$isu = htmlspecialchars($Visu,ENT_QUOTES);
//$tajuk = htmlspecialchars($Vtajuk,ENT_QUOTES);

//$id_daftar = $Vid_daftar;
//$peratus = $Vperatus;
$startDate=$start;

//$username = $Vusername;
//$kp_s = $kp_s;

//-----------------------------------------


$sql="UPDATE butiran_sivil SET 
id_daftar='$id_daftar',OIC='$OIC',luaran='$luaran',tanah='$tanah',bekalanair='$bekalanair', 
pembetungan='$pembetungan',jalan='$jalan',
username='$username',kp_s='$kp_s',startDate='$startDate' WHERE id='$id';";

$result=mysql_query($sql);
unset ( $_SESSION['order'] );
$_SESSION['order'] = $OIC;
echo "<center>Telah dikemaskini. Masuk sesi baru jika klik 'semak'.</center><br>";
	ob_end_clean(); // Delete the buffer.		
	header ("Location:  http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/projek_sivil.php?event=Pinda");
	exit();}

if ($menu!=1) 
{ $count=mysql_query("SELECT COUNT(*) FROM butiran_sivil WHERE id_daftar = '{$_SESSION['daftar_id']}'");$count=mysql_fetch_array($count);
$count=$count[0];echo "<div align=\"center\">--JUMLAH DATA:<b>$count</b>--PROJEK NO:<b>{$_SESSION['daftar_id']}</b>--</div><br>";} 
?>

<!--a href="http://www.EasilySimpleCalendar.com/" target="_blank"><span class="style8">
&copy;2004 Easily Simple Calendar 4.8</span></a-->
<br> 
<?php // Include the HTML footer file.
include_once ('html/footer.htm');
?>

