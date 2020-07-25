<?php 
$page_title = 'Status projek';
include_once ('html/header.htm');
// Welcome the user (by name if they are logged in).
if (isset($_SESSION['first_name'])) { 

echo "&nbsp;&nbsp;<i> log: {$_SESSION['first_name']} </i> </small></center></fieldset>";
}
else
{ echo "</small></center></fieldset>"; }

require ("inc/projek_status_cfg.php");
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
				
		//		header ("Location:  http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/projek_status.php?event=Pinda");

		//		exit();

			}
		
$db=@mysql_connect($dbHost,$dbUserLogin,$dbPassword) or $error=(mysql_error()."<br>");
@mysql_select_db($dbName,$db) or $error.=(mysql_error());

if ($error) {
echo "<font color=red>> There was an error connecting to the mySQL database.</font><br><br>";
echo "Please check the database settings in the 'projek_status_cfg.php' file and try again.<br><br>";
echo "The error was reported as:<br>$error";exit;}
?>
<!------------------------------new date format--------------------------->
<script type="text/javascript" src="jasoncalendar/calendarDateInput.js"></script>


 <!--title> Konsol Status Projek </title-->
 <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1">
 <style type="text/css">
 a:link { text-decoration:none ; font-size:12px; font-weight:normal }
 a:visited { text-decoration:none ; font-size:12px; font-weight:normal }
 a:hover { text-decoration:underline ; font-size:12px; font-weight:normal }
 body { font-family:Verdana,Arial,Helvetica,sans-serif;font-size:12px; } 
//background: white url(../bground/spekgray.gif);// no-repeat top right; 
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
Konsol <b>Status</b> Projek <?php echo '<b>'.$_SESSION['daftar_id'].'</b>';?> Bhg. Kej. Awam.
</table>

<fieldset> <small> <center>
<?php $count=mysql_query("SELECT COUNT(*) FROM status_projek WHERE id_daftar ='{$_SESSION['daftar_id']}'");$count=mysql_fetch_array($count);
$count =$count[0];
if ( $count==0 )
{ echo '<a href="'.$fileName.'?event=add">Input Pertama</a>'; } ?>

<a href="<?php echo "$fileName?event=Pinda";?>"><img src="img/favicon.ico" border="0" margin-top="-50" alt="status java duke!"> 
Semak,Pinda,Status Baru</a>
</center> </small> </fieldset>
<fieldset> <small> <center>
<a href="<?php echo "projek_daftar.php?event=Pinda";?>">Daftar</a> |
<a href="<?php echo "projek_Dplan.php?event=Pinda";?>">D-Plan</a> |
<a href="<?php echo "projek_Perunding.php?event=Pinda";?>">Perunding</a> |
<a href="<?php echo "projek_butiran.php?event=Pinda";?>">Butiran</a> |
<a href="<?php echo "projek_sivil.php?event=Pinda";?>">Kerja sivil</a> |
<!--a href="<?php echo "projek_status.php?event=Pinda";?>"-->Status<!--/a--> |
<a href="<?php echo "projek_senarai.php?order={$_SESSION['ppk']}";?>">Senarai</a> |
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
$lawat=$_REQUEST["lawat"]; //jadual date
$end=$_REQUEST["end"];
$eventLength=$_REQUEST["eventLength"];
$id=$_REQUEST["id"]; //idx
$eid=$_REQUEST["eid"];
$del=$_REQUEST["del"];

$sketch_proposal =$_REQUEST["sketch_proposal"];
$Tender_doc =$_REQUEST["Tender_doc"];
$Design_report =$_REQUEST["Design_report"];
$OIC =$_REQUEST["OIC"];
$progress =$_REQUEST["progress"];
$survey_work =$_REQUEST["survey_work"];
$SI_work =$_REQUEST["SI_work"];
$LAcquire =$_REQUEST["LAcquire"];
$k_luar =$_REQUEST["k_luar"];
$k_tanah =$_REQUEST["k_tanah"];
$k_air =$_REQUEST["k_air"];
$k_najis =$_REQUEST["k_najis"];
$k_jalan =$_REQUEST["k_jalan"];
$analisa =$_REQUEST["analisa"]; 
$rekabentuk =$_REQUEST["rekabentuk"]; 
$lukisan =$_REQUEST["lukisan"]; 
$Bill_Q =$_REQUEST["Bill_Q"]; 
$catatan =$_REQUEST["catatan"];
$username =$_REQUEST["username"];
$id_daftar =$_REQUEST["id_daftar"]; 
$tenderEval =$_REQUEST["tenderEval"];
$bilPetender =$_REQUEST["bilPetender"];
$startEval =$_REQUEST["startEval"];
$complEval =$_REQUEST["complEval"];

$sketch_proposalEV =$_REQUEST["sketch_proposalEV"];
$Tender_docEV =$_REQUEST["Tender_docEV"];
$Design_reportEV =$_REQUEST["Design_reportEV"];
$OICEV =$_REQUEST["OICEV"];
$progressEV =$_REQUEST["progressEV"];
$survey_workEV =$_REQUEST["survey_workEV"];
$SI_workEV =$_REQUEST["SI_workEV"];
$LAcquireEV=$_REQUEST["LAcquireEV"];
$k_luarEV =$_REQUEST["k_luarEV"];
$k_tanahEV =$_REQUEST["k_tanahEV"];
$k_airEV =$_REQUEST["k_airEV"];
$k_najisEV =$_REQUEST["k_najisEV"];
$k_jalanEV =$_REQUEST["k_jalanEV"];
$analisaEV=$_REQUEST["analisaEV"]; 
$rekabentukEV =$_REQUEST["rekabentukEV"]; 
$lukisanEV =$_REQUEST["lukisanEV"]; 
$Bill_QEV =$_REQUEST["Bill_QEV"]; 
$catatanEV =$_REQUEST["catatanEV"];
$usernameEV =$_REQUEST["usernameEV"];
$id_daftarEV =$_REQUEST["id_daftarEV"]; 
$tenderEvalEV =$_REQUEST["tenderEvalEV"];
$bilPetenderEV =$_REQUEST["bilPetenderEV"];
//$startEval =$_REQUEST["startEval"];
//$complEval =$_REQUEST["complEval"];

$Vsketch_proposal =$_REQUEST["Vsketch_proposal"];
$VTender_doc =$_REQUEST["VTender_doc"];
$VDesign_report =$_REQUEST["VDesign_report"];
$VOIC =$_REQUEST["VOIC"];
$Vprogress =$_REQUEST["Vprogress"];
$Vsurvey_work =$_REQUEST["Vsurvey_work"];
$VSI_work =$_REQUEST["VSI_work"];
$VLAcquire =$_REQUEST["VLAcquire"];
$Vk_luar =$_REQUEST["Vk_luar"];
$Vk_tanah =$_REQUEST["Vk_tanah"];
$Vk_air =$_REQUEST["Vk_air"];
$Vk_najis =$_REQUEST["Vk_najis"];
$Vk_jalan =$_REQUEST["Vk_jalan"];
$Vanalisa =$_REQUEST["Vanalisa"]; 
$Vrekabentuk =$_REQUEST["Vrekabentuk"]; 
$Vlukisan =$_REQUEST["Vlukisan"]; 
$VBill_Q =$_REQUEST["VBill_Q"]; 
$Vcatatan =$_REQUEST["Vcatatan"];
$Vusername =$_REQUEST["Vusername"];
$Vid_daftar =$_REQUEST["Vid_daftar"]; 
$VtenderEval =$_REQUEST["VtenderEval"];
$VbilPetender =$_REQUEST["VbilPetender"];
//$startEval =$_REQUEST["startEval"];
//$complEval =$_REQUEST["complEval"];

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


if ( $Submit=="Tambah Data" ) { 
$menu=1;
if (!isset($_SESSION['first_name'])) 
{die ("<center>Data tidak lengkap atau anda tidak LOGIN. <br/>Sila cuba lagi.</center>");} 

$end= $eventLength;
$Vid_daftar = $id_daftarEV;
$OICEV = $_SESSION['ppk'];  // htmlspecialchars(stripslashes($VOIC),ENT_QUOTES);


$VOIC = $OICEV;
$startDate = $start;
$lawatDate = $lawat;
$startEvalDate = $startEval;
$complEvalDate = $complEval;
//$tenderEvalTrueFalse = trim($tenderEvalEV);
$bilPetender = $bilPetenderEV;
$tenderEval = $tenderEvalEV;
//if ($tenderEvalTrueFalse == '') {$tenderEval = 'false';}

//echo $tenderEval.'--tenderEval';

$Vprogress = $progressEV;
$Vsketch_proposal =$sketch_proposalEV;
$VTender_doc = $Tender_docEV;
$VDesign_report = $Design_reportEV;

$Vsurvey_work = $survey_workEV;
$VSI_work = $SI_workEV;
$VLAcquire=$LAcquireEV;
$Vanalisa=$analisaEV; 
$Vrekabentuk =$rekabentukEV; 
$Vlukisan =$lukisanEV; 
$VBill_Q =$Bill_QEV; 
$Vcatatan = $catatanEV;
$Vusername = $usernameEV;
$Vkp_s = $kp_sEV;

$Vk_luar = $k_luarEV;
$Vk_tanah = $k_tanahEV;
$Vk_air = $k_airEV;
$Vk_najis = $k_najisEV;
$Vk_jalan = $k_jalanEV;

//if ($dateFormat==1) { $startDate=date("m-d-Y",$start);$Bilangan=$end;}
//if ($dateFormat==2) { $startDate=date("d-m-Y",$start);$Bilangan=$end;} 
//if ($dateFormat==2) { $startDate=date("Y-m-d",$start);$Bilangan=$end;} 
$id_daftar = $Vid_daftar;
$OIC = $VOIC;
$progress = $Vprogress;
$sketch_proposal =$Vsketch_proposal;
$Tender_doc = $VTender_doc;
$Design_report = $VDesign_report;

$survey_work = $Vsurvey_work;
$SI_work = $VSI_work;
$LAcquire=$VLAcquire;
$analisa=$Vanalisa; 
$rekabentuk =$Vrekabentuk; 
$lukisan =$Vlukisan; 
$Bill_Q =$VBill_Q;
$catatan = htmlspecialchars(stripslashes($Vcatatan),ENT_QUOTES);

$username = $_SESSION['username'];
$kp_s = $_SESSION['kp_s'];
$id_daftar = $_SESSION['daftar_id'];

$k_luar = $Vk_luar;
$k_tanah = $Vk_tanah;
$k_air = $Vk_air;
$k_najis = $Vk_najis;
$k_jalan = $Vk_jalan;

?> 
<!-------------------butiran status------------------------->
<?php // Make sure the username is available.
		$query = "SELECT startDate FROM status_projek WHERE id_daftar= {$_SESSION['daftar_id']} AND startDate= '$startDate'";		
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

<form name="form2" method="post" action="<?php echo $fileName ?>">
<div align="center"> 

<table width="800" border="1" align="center" cellpadding="1" cellspacing="0" bordercolor= "#FDFECF" bgcolor= "#EBEEF5">

<tr align="center"> <td colspan="4">
<small>TAJUK PROJEK:</small><br/><font color="darkgreen" size="4em" >
<?php echo $_SESSION['tajuk'].'</font><br/><font color="darkkhaki" size="1em">'.$_SESSION['mod_kerja'].'</font>';?> 
</td></tr>

<tr> <td width="200" align="right"><small>Tarikh Laporan:</small></td> 
<td width="600" align="left" class="style2" colspan="3"> 
<small><?php echo $startDate.'--->lawaTapak'.$lawatDate.'--->tenderEval'.$tenderEval ?></small>
</td> </tr> 

<tr> <td align="right"><small>Peg. t/jawab:</small></td> <td align="left" colspan="3"> 
<small><?php echo $OIC ?></small>
</td> </tr> 

<tr> <td align="right" width="200" ><small>Kerja ukur:</small></td> <td align="left" width="200" >
<small><?php echo $survey_work ?></small>
</td>
<td align="right" width="200" ><small><?php echo $progress ?></small></td> <td align="left" width="200" >
<small>:Status semasa</small>
</td> </tr>

<tr> <td align="right"><small>Siasatan tanah:</small></td> <td align="left">
<small><?php echo $SI_work ?></small>
</td>
<td align="right"><small><?php echo $sketch_proposal ?></small></td> <td align="left"> 
<small>:TAHAP KEMAJUAN</small>
</td> </tr> 

<tr> <td align="right"><small>Pengambilan tanah:</small></td> <td align="left">
<small><?php echo $LAcquire ?></small>
</td>
<td align="right"><small><?php echo $analisa ?></small></td> <td align="left">
<small>:Analisa</small>
</td> </tr>

<tr> <td align="right"><small>kerja luaran :</small></td> <td align="left">
<small><?php echo $k_luar ?></small>
</td>
<td align="right"><small><?php echo $rekabentuk ?></small></td> <td align="left"> 
<small>:Rekabentuk</small>
</td> </tr> 

<tr> <td align="right"><small>kerja tanah :</small></td> <td align="left">
<small><?php echo $k_tanah ?></small>
</td>
<td align="right"><small><?php echo $lukisan ?></small></td> <td align="left"> 
<small>:Lukisan</small>
</td> </tr> 

<tr> <td align="right"><small>kerja bekalan air :</small></td> <td align="left">
<small><?php echo $k_air ?></small>
</td>
<td align="right"><small><?php echo $Bill_Q ?></small></td> <td align="left">
<small>:Bill_Q </small>
</td> </tr>

<tr> <td align="right"><small>kerja pembetongan :</small></td> <td align="left">
<small><?php echo $k_najis ?></small>
</td>
<td align="right"><small><?php echo $Tender_doc ?></small></td> <td align="left">
<small>:Tender_doc</small>
</td> </tr>

<tr> <td align="right"><small>kerja jalan :</small></td> <td align="left">
<small><?php echo $k_jalan ?></small>
</td>
<td align="right"><small><?php echo $Design_report ?></small></td> <td align="left">
<small>:Design_report</small>
</td> </tr>

<tr> <td align="right"><small>Arahan Penilaian Tender:</small></td> <td align="left">
<small><?php echo 'Jangka trk:?'.$tenderEval ?></small>
</td>
<td align="right"><small><?php echo $bilPetender ?></small></td> <td align="left">
<small>:bilPetender</small>
</td> </tr>

<tr> <td align="right"><small>startEvalDate :</small></td> <td align="left">
<small><?php echo $startEvalDate ?></small>
</td>
<td align="right"><small><?php echo $complEvalDate ?></small></td> <td align="left">
<small>:complEvalDate</small>
</td> </tr>

<tr> <td align="right"><small>Catatan :</small></td> <td align="left" colspan="3">
<small><?php echo 'mynota:' .$catatan ?></small>

<tr align="center"> <td colspan="4"><input type="submit" name="Submit" value="Simpan Data"> 
<input type="button" name="Button" value="Pinda" onClick="history.back();">
<input type="button" name="Button" value="Batal Tambah" onClick="location='<?php echo $fileName ?>'"> 
<br/><font color="gray"><small>
Username:<?php echo $_SESSION['username'] ?> &nbsp;&nbsp;<i>
Pendaftar id<small>[<?php echo $_SESSION['kp_s']; ?>]</i></small></font>

<input name="id_daftar" type="hidden" id="id_daftar" value="<?php echo $id_daftar ?>"> 
<input name="OIC" type="hidden" id="OIC" value="<?php echo $OIC ?>"> 
<input name="start" type="hidden" id="start" value="<?php echo $start ?>">
<input name="lawat" type="hidden" id="lawat" value="<?php echo $lawat ?>">
<input name="startEval" type="hidden" id="startEval" value="<?php echo $startEval ?>"> 
<input name="complEval" type="hidden" id="complEval" value="<?php echo $complEval ?>">
<input name="bilPetender" type="hidden" id="bilPetender" value="<?php echo $bilPetender ?>">
<input name="tenderEval" type="hidden" id="tenderEval" value="<?php echo $tenderEval ?>">


<input name="progress" type="hidden" id="progress" value="<?php echo $progress ?>"> 
<input name="sketch_proposal" type="hidden" id="sketch_proposal" value="<?php echo $sketch_proposal ?>"> 
<input name="Tender_doc" type="hidden" id="Tender_doc" value="<?php echo $Tender_doc ?>"> 
<input name="Design_report" type="hidden" id="Design_report" value="<?php echo $Design_report ?>">

<input name="survey_work" type="hidden" id="survey_work" value="<?php echo $survey_work ?>">
<input name="SI_work" type="hidden" id="SI_work" value="<?php echo $SI_work ?>">
<input name="LAcquire" type="hidden" id="LAcquire" value="<?php echo $LAcquire ?>">

<input name="k_luar" type="hidden" id="k_luar" value="<?php echo $k_luar ?>">
<input name="k_tanah" type="hidden" id="k_tanah" value="<?php echo $k_tanah ?>">
<input name="k_air" type="hidden" id="k_air" value="<?php echo $k_air ?>">
<input name="k_najis" type="hidden" id="k_najis" value="<?php echo $k_najis ?>">
<input name="k_jalan" type="hidden" id="k_jalan" value="<?php echo $k_jalan ?>">

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
$Bilangan=$end;
//$Bilangan=$eventlength;
$startDate = $start;
$lawatDate = $lawat;

//$siapDate = date("Y-m-d",$start0);


if (isset($_SESSION['first_name']))
if (isset($_SESSION['daftar_id']))
 
{$sql="INSERT INTO status_projek (id_daftar,OIC,startDate,progress,survey_work,SI_work,LAcquire,sketch_proposal,
analisa,rekabentuk,lukisan,Bill_Q,Tender_doc,Design_report,catatan,username,kp_s,regist_date,
k_luar,k_tanah,k_air,k_najis,k_jalan,lawatDate,tenderEval,bilPetender,startEvalDate,complEvalDate) VALUES 
('$id_daftar','$OIC','$startDate','$progress','$survey_work','$SI_work','$LAcquire','$sketch_proposal', 
'$analisa','$rekabentuk','$lukisan','$Bill_Q','$Tender_doc','$Design_report','$catatan','$username','$kp_s',NOW(),
'$k_luar','$k_tanah','$k_air','$k_najis','$k_jalan','$lawatDate','$tenderEval','$bilPetender','$startEval','$complEval')";

$result=mysql_query($sql); 
if (!$result) {
die('<center>Data tidak dikemaskini :  ' . mysql_error().'<br/><font color="gray"><small>Input error</small></font>');}
	else 
		{
		ob_end_clean(); // Delete the buffer.		
		header ("Location:  http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/projek_status.php?event=Pinda");
		exit();

		echo "<center>Data telah diupload </center><br>";}}
else 
{echo "<center>Anda perlu pilih satu projek untuk set status!</center>";}
else 
{echo "<center>PPK saja!</center>";}}




if ($event=="add") 
if (!isset($_SESSION['first_name'])) {die ("<center>Anda tidak LOGIN !</center>");} 
else
{ $menu=1;
?>
<form name="form1" method="post" action="<?php echo $fileName ?>">
<!--   div align="center"   --> 
<table width="800" border="1" align="center" cellpadding="1" cellspacing="0" bordercolor="#FDFECF" bgcolor= "#EBEEF5" > 
 
<tr align="center"> <td></td><td colspan="2">
<small>TAJUK PROJEK:</small><br/><font color="darkgreen" size="4em" >
<?php echo $_SESSION['tajuk'].'</font><br/><font color="darkkhaki" size="1em">'.$_SESSION['mod_kerja'].'</font>';?> 
</td><td></td></tr>

<tr> <td width="200" align="right"><small>TARIKH LAPORAN:</small> </td> 
<td width="200" align="left"> <small>
<!--------------------------------New date format----------------------------------------->

<script> DateInput( 'start', true, 'YYYY-MM-DD')</script>
<!--------------------------------New date format----------------------------------------->
<td width="200" align="right"><small>LAWAT TAPAK:</small>
<td width="200" align="left"> <small>

<script> DateInput( 'lawat', false, 'YYYY-MM-DD')</script>

<!--------------------------------New date format----------------------------------------->
</small></td> </tr> 

<?php
if ($event=="add") 
{ $menu=1;
$count=mysql_query("SELECT COUNT(*) FROM status_projek WHERE kp_s ='$kp_s'");$count=mysql_fetch_array($count);
$count =$count[0];
$Bilangan=$count+1;}
?>

<tr><td align="right" width="200" ><small>
OVERALL PROGRESS:
</td> <td align="left" width="200" >
<select name="progressEV" id="progressEV">
<?php 
$Vprogresstxt = array (0=>'0',
1 => '5',2 => '10',3 => '15',4 => '20',5 => '25',
6 => '30',7 => '35',8 => '40',9 => '45',10 => '50',
11 => '55',12 => '60',13 => '65',14 => '70',15 => '75',
16 => '80',17 => '85',18 => '90',19 => '95',20 => '100');
$Vprogresstxt_STAGE = array (0=>'Plantikan HODT',1=>'NS',2=>'TOR',3=>'Lawat Tapak',4=>'Ulas CTK',5=>'Rv. Konsep R/B',6=>'Rv. Pincian R/B',7=>'Luk/doc Tender',8=>'Pnilaian Teknikal',9=>'Iklan',10=>'Tender',11=>'Nego',12=>'Pnilaian Tender',13=>'Varifikasi Luk.',14=>'Validasi Pbinaan',15=>'K.I.V.',16=>'PENYERAHAN');

for ($Vpr=0; $Vpr<=20; $Vpr++ ) 
{ echo "<option>$Vprogresstxt[$Vpr]</option>\n";} ?></select>
%</small>
<td align="right" width="200" bgcolor="#FDFECF" bordercolor="#EBEEF5" >
<small>TAHAP KEMAJUAN:</small> 
</td> <td align="left" width="200" bgcolor="#FDFECF" bordercolor="#EBEEF5" >
<select name="sketch_proposalEV" id="sketch_proposalEV">
<?php 
for ($Vsketch_proposal=0; $Vsketch_proposal<=16; $Vsketch_proposal++) 
{ echo "<option>$Vprogresstxt_STAGE[$Vsketch_proposal]</option>\n";} ?></select>
%</small></td></tr>

<tr><td align="right" ><small>
KERJA UKUR:</small>
</td> <td align="left" width="200" >
<select name="survey_workEV" id="survey_workEV">
<?php $Vsurvey_worktxt = array (0=>'TIADA',1=>'PENYEDIAAN',2=>'PERMOHONAN',3=>'SEMPURNA');
for ($Vs=0; $Vs<=3; $Vs++) 
{ echo "<option>$Vsurvey_worktxt[$Vs]</option>\n";} ?></select>
</small>
<td align="right" width="200" >
<small>SIASATAN TANAH:</small>
</td> <td align="left" width="200" >
<select name="SI_workEV" id="SI_workEV">
<?php $VSI_worktxt = array (0=>'TIADA',1=>'PENYEDIAAN',2=>'PERMOHONAN',3=>'SEMPURNA');
for ($VSI=0; $VSI<=3; $VSI++) 
{ echo "<option>$VSI_worktxt[$VSI]</option>\n";} ?></select>
</small></td></tr>

<tr> <td align="right"><small>
PENGAMBILAN TANAH:</small>
</td> <td align="left" width="200" >
<select name="LAcquireEV" id="LAcquireEV">
<?php $VLAcquiretxt = array (0=>'TIADA',1=>'PENYEDIAAN',2=>'PERMOHONAN',3=>'SEMPURNA');
for ($VLA=0; $VLA<=3; $VLA++) 
{ echo "<option>$VLAcquiretxt[$VLA]</option>\n";} ?></select>
</small>
<td align="right" width="200" >
<small>KERJA LUARAN:</small>
</td> <td align="left" width="200" >
<select name="k_luarEV" id="k_luarEV">
<?php $VLAcquiretxt = 
array (0=>'BELUM',1=>'PENYEDIAAN',2=>'SEMPURNA',3=>'TIADA');
for ($VLA=0; $VLA<=3; $VLA++) 
{ echo "<option>$VLAcquiretxt[$VLA]</option>\n";} ?></select>
</small></td></tr>

<tr> <td align="right"><small>
KERJA TANAH:</small>
</td> <td align="left" width="200" >
<select name="k_tanahEV" id="k_tanahEV">
<?php $VLAcquiretxt = 
array (0=>'BELUM',1=>'PENYEDIAAN',2=>'SEMPURNA',3=>'TIADA');
for ($VLA=0; $VLA<=3; $VLA++) 
{ echo "<option>$VLAcquiretxt[$VLA]</option>\n";} ?></select>
</small>
<td align="right" width="200" >
<small>KERJA BEKALAN AIR:</small>
</td> <td align="left" width="200" >
<select name="k_airEV" id="k_airEV">
<?php $VLAcquiretxt = 
array (0=>'BELUM',1=>'PENYEDIAAN',2=>'SEMPURNA',3=>'TIADA');
for ($VLA=0; $VLA<=3; $VLA++) 
{ echo "<option>$VLAcquiretxt[$VLA]</option>\n";} ?></select>
</small></td></tr>

<tr> <td align="right"><small>
KERJA PEMBETUNGAN:</small>
</td> <td align="left" width="200" >
<select name="k_najisEV" id="k_najisEV">
<?php $VLAcquiretxt = 
array (0=>'BELUM',1=>'PENYEDIAAN',2=>'SEMPURNA',3=>'TIADA');
for ($VLA=0; $VLA<=3; $VLA++) 
{ echo "<option>$VLAcquiretxt[$VLA]</option>\n";} ?></select>
</small>
<td align="right" width="200" >
<small>KERJA JALAN:</small>
</td> <td align="left" width="200" >
<select name="k_jalanEV" id="k_jalanEV">
<?php $VLAcquiretxt = 
array (0=>'BELUM',1=>'PENYEDIAAN',2=>'SEMPURNA',3=>'TIADA');
for ($VLA=0; $VLA<=3; $VLA++) 
{ echo "<option>$VLAcquiretxt[$VLA]</option>\n";} ?></select>
</small></td></tr>

<tr><td align="right"><small>ANALISIS:</td><td align="left" colspan="3" >
<select name="analisaEV" id="analisaEV">
<?php for ($Vanalisa=0; $Vanalisa<=20; $Vanalisa++) 
{ echo "<option>$Vprogresstxt[$Vanalisa]</option>\n";} ?></select>
</small><b>%</b>

<small> <font style="margin-left:50px"> REKABENTUK: </font>
<select name="rekabentukEV" id="rekabentukEV">
<?php for ($Vrekabentuk=0; $Vrekabentuk<=20; $Vrekabentuk++) 
{ echo "<option>$Vprogresstxt[$Vrekabentuk]</option>\n";} ?></select>
</small><b>%</b>

<small><font style="margin-left:50px">LUKISAN:</font>
<select name="lukisanEV" id="lukisanEV">
<?php for ($Vlukisan=0; $Vlukisan<=20; $Vlukisan++) 
{ echo "<option>$Vprogresstxt[$Vlukisan]</option>\n";} ?></select>
</small><b>%</b></td></tr>

<tr><td align="right"><small>Bill_quantity:</td><td align="left" colspan="3" >
<select name="Bill_QEV" id="Bill_QEV">
<?php for ($VBill_Q=0; $VBill_Q<=20; $VBill_Q++) 
{ echo "<option>$Vprogresstxt[$VBill_Q]</option>\n";} ?></select>
</small><b>%</b>

<small> <font style="margin-left:55px"> Tender_doc:</font>
<select name="Tender_docEV" id="Tender_docEV">
<?php for ($VTender_doc=0; $VTender_doc<=20; $VTender_doc++) 
{ echo "<option>$Vprogresstxt[$VTender_doc]</option>\n";} ?></select>
</small><b>%</b>

<small> <font style="margin-left:20px"> Design_report:</font>
<select name="Design_reportEV" id="Design_reportEV">
<?php for ($VSI=0; $VSI<=20; $VSI++) 
{ echo "<option>$Vprogresstxt[$VSI]</option>\n";} ?></select>
</small><b>%</b> </td></tr>


<tr> <td align="right"><small>Catatan<br/>Status/<br/>Laporan Mesyuarat:</td><td colspan="3" >
<div><textarea name="catatanEV" cols="90" rows="4" id="catatanEV"></textarea></div>
</small></td></tr>

<tr> <td align="right" bgcolor="#FDFECF" bordercolor="#EBEEF5" ><small>Penilaian Tender:
<input name="tenderEvalEV" type="checkbox" id="tenderEvalEV" value="true"> 
</td>
<td align="left" bgcolor="#FDFECF" bordercolor="#EBEEF5" ><small>Mula:
<!--------------------------------New date format----------------------------------------->
<script> DateInput( 'startEval' , false, 'YYYY-MM-DD')</script>
</td>
<td align="left" bgcolor="#FDFECF" bordercolor="#EBEEF5" ><small>Siap: 
<!--------------------------------New date format----------------------------------------->
<script> DateInput( 'complEval' , false, 'YYYY-MM-DD')</script>
</td>
<td align="left" bgcolor="#FDFECF" bordercolor="#EBEEF5" ><small>Bil masuk tender:
<input name="bilPetenderEV" type="text" id="bilPetenderEV" value="<?php echo '00' ?>"> 
</td>
</tr >

<!----------------->

<tr align="center"> <td colspan="4" >
<input type="submit" name="Submit" value="Tambah Data"> 
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

<?php } 
if ($event=="Pinda")
if (!isset($_SESSION['first_name'])) {echo '<center>Sila pilih satu projek dari SENARAI dan anda mesti LOGIN</center>';}
else
{$menu=1;$result=mysql_query("SELECT * FROM status_projek WHERE id_daftar = {$_SESSION['daftar_id']} ORDER BY startDate DESC",$db);
//$myrow=mysql_fetch_array($result);
$myrow=mysql_fetch_assoc($result);
//echo $kp_s;
if (!$myrow) {echo '<center> Belum ada status diupload.<br/>Klik Input.</center>';} 
else


////////////////////////////////
//if ($myrow)
{  ?> 
<!--br/--> 
<table width="800" border="1" align="center" cellpadding="1" cellspacing="0" bordercolor="#E4E4E4"> 
<tr bgcolor="#EBEEF5">

<td width="800" align="center" colspan = "5" bgcolor="#FDFECF" bordercolor="#EBEEF5" >
<small>TAJUK PROJEK:</small><br/><font color="darkgreen" size="4em" >
<?php echo $_SESSION['tajuk'].'</font><br/><font color="darkkhaki" size="1em">'.$_SESSION['mod_kerja'].'</font>';?> 
</td></tr> 


<?php $Bilangan = 1;
////  do start /////
do { 
if ($dateFormat==1) 
{ 
$myrow=mysql_data_seek($result,2);

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
$end= $eventLength;     $end = $Bilangan;//
//$Vid_daftar =$myrow[id_daftar];
$VOIC = $myrow[OIC];
$startDate = $myrow[startDate];
$lawatDate = $myrow[lawatDate];
$startEvalDate = $myrow[startEvalDate];
$complEvalDate = $myrow[complEvalDate];
$tenderEval = $myrow[tenderEval];
$bilPetender = $myrow[bilPetender];


$Vprogress = $myrow[progress];
$Vsketch_proposal = $myrow[sketch_proposal];
$VTender_doc = $myrow[Tender_doc];
$VDesign_report = $myrow[Design_report];

$Vsurvey_work = $myrow[survey_work];
$VSI_work = $myrow[SI_work];
$VLAcquire = $myrow[LAcquire];

$Vk_luar = $myrow[k_luar];
$Vk_tanah = $myrow[k_tanah];
$Vk_air = $myrow[k_air];
$Vk_najis = $myrow[k_najis];
$Vk_jalan = $myrow[k_jalan];

$Vanalisa = $myrow[analisa];
$Vrekabentuk = $myrow[rekabentuk]; 
$Vlukisan =$myrow[lukisan]; 
$VBill_Q =$myrow[Bill_Q]; 
$Vcatatan = $myrow[catatan];
//$Vusername = $myrow[username];
//$Vkp_s =$myrow[kp_s];

//if ($dateFormat==1) { $startDate=date("m-d-Y",$start);$Bilangan=$end;}
//if ($dateFormat==2) { $startDate=date("d-m-Y",$start);$Bilangan=$end;} 
//if ($dateFormat==2) { $startDate=date("Y-m-d",$start);$Bilangan=$end;} 

//$id_daftar = $Vid_daftar; //$id_daftar = $_SESSION['daftar_id'];
$OIC = $_SESSION['ppk'];  // htmlspecialchars(stripslashes($VOIC),ENT_QUOTES);
$progress = htmlspecialchars(stripslashes( $Vprogress),ENT_QUOTES) ;
$sketch_proposal = htmlspecialchars(stripslashes( $Vsketch_proposal),ENT_QUOTES) ;
$Tender_doc = htmlspecialchars(stripslashes( $VTender_doc),ENT_QUOTES) ;
$Design_report = htmlspecialchars(stripslashes( $VDesign_report),ENT_QUOTES) ;

$survey_work = $Vsurvey_work;
$SI_work = $VSI_work;
$LAcquire= $VLAcquire;
$analisa= htmlspecialchars(stripslashes( $Vanalisa),ENT_QUOTES) ; 
$rekabentuk = htmlspecialchars(stripslashes( $Vrekabentuk),ENT_QUOTES) ; 
$lukisan = htmlspecialchars(stripslashes( $Vlukisan),ENT_QUOTES) ; 
$Bill_Q = htmlspecialchars(stripslashes( $VBill_Q),ENT_QUOTES) ;
$catatan = $Vcatatan;

$k_luar = $Vk_luar;
$k_tanah = $Vk_tanah;
$k_air = $Vk_air;
$k_najis = $Vk_najis;
$k_jalan = $Vk_jalan;

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

                     FROM Dplan_projek WHERE id_daftar = {$_SESSION['daftar_id']}",$db);
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

<tr> <td width="175" align="right"><small>Mula Rekabentuk: </small></td> 
<td width="150" align="left" class="style2"> 
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

<td align="center" bgcolor="#FDFECF" width="150" ><a href="<?php echo $fileName ?>?eid=<?php 
echo $myrow[id] ?>"> <font color="#000000" size="1em">TARIKH LAPORAN:<br/><?php echo $startDate ?></font>
<img src="img/favicon.ico" border="0" margin-top="-50"></a></td> 

<td align="right" width="150" >
<?php echo 
'</b>&nbsp;<small> <small> '.$d.'-'.$m.'-'.$y.'</small> </td>
<td align="left" width="175" ><small>:perlu siap </small> </td> </tr> '; ?>

<tr> 
<td align="center"  > 1:PERKARA </td> <td align="center" > 2:STATUS </td> <td align="center" > 3:%SEBENAR </td> <td align="center" > 4:%JADUAL </td> <td align="center" > 5:PERKARA </td> </tr> 

<tr> 
<td align="right"  > <font color="darkgreen" size="1em"> Kerja ukur </font> </td> <td > <font color="coral" size="1em"><?php echo $survey_work ?></font>  </td> <td align="right" ><font color="coral" size="2em"> <?php echo $calc_overall ?></font>    </td> <td > <?php echo $d_overall ?>   </td> <td ><font color="darkgreen" size="1em">  Keseluruhan </font> </td> </tr> 

<tr> 
<td align="right"  > <font color="darkgreen" size="1em">Siasatan tanah</font> </td> <td ><font color="coral" size="1em"><?php echo $SI_work ?></font> </td> <td align="right" bgcolor="#FDFECF" bordercolor="#EBEEF5" ><font color="coral" size="2em"> <?php echo $sketch_proposal ?></font>    </td> <td bgcolor="#FDFECF" bordercolor="#EBEEF5" > <?php echo '------------'.$d_sketch.'-----------' ?>   </td> <td bgcolor="#FDFECF" bordercolor="#EBEEF5" ><font color="darkgreen" size="2em">  TAHAP KEMAJUAN </font>  </td> </tr> 

<tr> 
<td align="right"  > <font color="darkgreen" size="1em">Pengambilan tanah</font> </td> <td ><font color="coral" size="1em"><?php echo $LAcquire ?></font> </td> <td align="right" ><font color="coral" size="2em"> <?php echo $analisa ?></font>    </td> <td > <?php echo $d_anal ?>   </td> <td ><font color="darkgreen" size="1em">  Analisa </font>  </td> </tr> 

<tr> 
<td align="right"  > <font color="darkgreen" size="1em">Kerja Luar</font> </td> <td ><font color="coral" size="1em"><?php echo $k_luar ?></font> </td> <td align="right" > <font color="coral" size="2em"><?php echo $rekabentuk ?></font>    </td> <td > <?php echo $d_reka ?>   </td> <td ><font color="darkgreen" size="1em">  Rekabentuk </font>  </td> </tr> 

<tr> 
<td align="right"  > <font color="darkgreen" size="1em">Kerja tanah</font> </td> <td ><font color="coral" size="1em"><?php echo $k_tanah ?></font> </td> <td align="right" > <font color="coral" size="2em"><?php echo $lukisan ?></font>    </td> <td > <?php echo $d_lukis ?>   </td> <td ><font color="darkgreen" size="1em">  Lukisan </font>  </td> </tr> 
										
										
<tr> 
<td align="right"  > <font color="darkgreen" size="1em">Kerja bekalan air</font> </td> <td ><font color="coral" size="1em"><?php echo $k_air ?></font> </td> <td align="right" ><font color="coral" size="2em"> <?php echo $Bill_Q ?> </font>  </td> <td > <?php echo $d_bill ?>   </td> <td ><font color="darkgreen" size="1em">  Bill Q </font>  </td> </tr> 

<tr> 
<td align="right"  > <font color="darkgreen" size="1em">Kerja pembetungan</font> </td> <td ><font color="coral" size="1em"><?php echo $k_najis ?></font> </td> <td align="right" ><font color="coral" size="2em"> <?php echo $Tender_doc ?></font>   </td> <td > <?php echo $d_tender ?>   </td> <td ><font color="darkgreen" size="1em">  Tender doc </font>  </td> </tr> 

<tr> 
<td align="right"  > <font color="darkgreen" size="1em">Kerja jalan</font> </td> <td ><font color="coral" size="1em"><?php echo $k_jalan ?></font> </td> <td align="right" > <font color="coral" size="2em"> <?php echo $Design_report ?> </font>  </td> <td > <?php echo $d_report ?>   </td> <td ><font color="darkgreen" size="1em">  Design report </font>  </td> </tr> 

<tr> 
<td align="right"  > <font color="darkgreen" size="1em"> Pernilaian tender</font> </td> <td ><font color="coral" size="1em"> <?php echo $tenderEval ?>   </font> </td> <td align="center" ><font color="coral" size="1em"> ~ </font> </td> <td align="right" ><font color="coral" size="1em"> <?php echo $bilPetender ?> </font> </td> <td ><font color="darkgreen" size="1em">  Bil. tender </font>  </td> </tr> 

<tr> 
<td align="right" > <font color="darkgreen" size="1em"> Mula nilai </font> </td> <td ><font color="coral" size="1em"> <?php echo $startEvalDate ?>   </font> </td> <td align="center" > <font color="coral" size="1em">   <?php echo $OIC ?> </font> </td> <td align="right" ><font color="coral" size="1em"> <?php echo $complEvalDate ?>  </font> </td> <td > <font color="darkgreen" size="1em"> Siap nilai </font>  </td> </tr> 

<tr> 
<td align="left" colspan="5"> <font color="darkgreen" size="1em">  <?php echo 'Catatan Status:  '.$startDate.'</font> <br/> <font color="gray" size="2em">  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>'.$catatan.'</i><br/><small><i>stk'.$_SESSION['ppk'].'</i></small>'; ?> </font> </td></tr> 


</tr> 
<tr><td colspan="5" bordercolor="white" bgcolor= "#EBEEF5" >&nbsp;</td></tr>
<?php } 

while ($myrow=mysql_fetch_array($result));
?>
</table>
<?php } } 




//// do end  /////


if ($eid) 
{ $menu=1;$result=mysql_query("SELECT * FROM status_projek WHERE id='$eid'",$db);
$myrow=mysql_fetch_array($result);
$dates=explode("-",$myrow[startDate]);?> 
<?php //$dates0=explode("-",$myrow[siapDate]);?> 
<!-------------------------------NO.2------------------------------------------>

<form name="form1" method="post" action="<?php echo $fileName ?>">

<table width="800" border="1" align="center" cellpadding="1" cellspacing="0" bordercolor="#FDFECF" bgcolor= "#EBEEF5" > 
 
<tr align="center"><td colspan="4" width="800" >
<small>TAJUK PROJEK:</small><br/><font color="darkgreen" size="4em" >
<?php echo $_SESSION['tajuk'].'</font><br/><font color="darkkhaki" size="1em">'.$_SESSION['mod_kerja'].'</font>';?> 
</td></tr>

<tr> <td width="200" align="right"><small>TARIKH LAPORAN:</small> </td> 
<td width="200" align="left"> <small>
<!--------------------------------New date format----------------------------------------->

<script> DateInput( 'start', true, 'YYYY-MM-DD'<?php if ($myrow[startDate]=='0000-00-00'){echo '';}else
echo ",'".$myrow[startDate]."'" ;?>)
</script>
<!--------------------------------New date format----------------------------------------->
<td width="200" align="right"><small>LAWAT TAPAK:</small>
<td width="200" align="left"> <small>

<script> DateInput( 'lawat', false, 'YYYY-MM-DD'<?php if ($myrow[lawatDate]=='0000-00-00'){echo '';}else
echo ",'".$myrow[lawatDate]."'" ;?>)
</script>

<!--------------------------------New date format----------------------------------------->
</small></td> </tr> 

<?php
if ($event=="add") 
{ $menu=1;
$count=mysql_query("SELECT COUNT(*) FROM status_projek WHERE kp_s ='$kp_s'");$count=mysql_fetch_array($count);
$count =$count[0];
$Bilangan=$count+1;}
?>

<?php 
$Vprogresstxt = array (0=>'0',
1 => '5',2 => '10',3 => '15',4 => '20',5 => '25',
6 => '30',7 => '35',8 => '40',9 => '45',10 => '50',
11 => '55',12 => '60',13 => '65',14 => '70',15 => '75',
16 => '80',17 => '85',18 => '90',19 => '95',20 => '100');
$Vprogresstxt_STAGE = array (0=>'Plantikan HODT',1=>'NS',2=>'TOR',3=>'Lawat Tapak',4=>'Ulas CTK',5=>'Rv. Konsep R/B',6=>'Rv. Pincian R/B',7=>'Luk/doc Tender',8=>'Pnilaian Teknikal',9=>'Iklan',10=>'Tender',11=>'Nego',12=>'Pnilaian Tender',13=>'Varifikasi Luk.',14=>'Validasi Pbinaan',15=>'K.I.V.',16=>'PENYERAHAN');

$VpermohonanTXT = array (0=>'TIADA',1=>'PENYEDIAAN',2=>'PERMOHONAN',3=>'SEMPURNA');
$VbelumTXT = array (0=>'BELUM',1=>'PENYEDIAAN',2=>'SEMPURNA',3=>'TIADA');
?>
<tr><td align="right" width="200" ><small>
OVERALL PROGRESS:</small> 
</td> <td align="left" width="200" >
<select name="progressEV" id="progressEV">
<?php 
$VprogressEV=$myrow[progress];
$progressEV=$VprogressEV;
for ($VSI=0; $VSI<=20; $VSI++) 
{ echo "<option";
if ($Vprogresstxt[$VSI]==$progressEV){ echo " SELECTED";} 
echo ">$Vprogresstxt[$VSI]</option>\n";} ?></select>
</td>

<td align="right" width="200" bgcolor="#FDFECF" bordercolor="#EBEEF5" ><small> 
TAHAP KEMAJUAN:</small> 
</td> <td align="left" width="200" bgcolor="#FDFECF" bordercolor="#EBEEF5" >
<select name="sketch_proposalEV" id="sketch_proposalEV">
<?php 
$Vsketch_proposalEV=$myrow[sketch_proposal];
$sketch_proposalEV=$Vsketch_proposalEV;
for ($VSI=0; $VSI<=16; $VSI++) 
{ echo "<option";
if ($Vprogresstxt_STAGE[$VSI]==$sketch_proposalEV){ echo " SELECTED";} 
echo ">$Vprogresstxt_STAGE[$VSI]</option>\n";} ?></select>
</td></tr>

<tr><td align="right" > <small>
KERJA UKUR:</small>
</td> <td align="left" width="200" >
<select name="survey_workEV" id="survey_workEV">
<?php 
$Vsurvey_workEV=$myrow[survey_work];
$survey_workEV=$Vsurvey_workEV;
for ($VLA=0; $VLA<=3; $VLA++) 
{ echo "<option";
if ($VpermohonanTXT[$VLA]==$survey_workEV){ echo " SELECTED";} 
echo ">$VpermohonanTXT[$VLA]</option>\n";} ?></select>

<td align="right" width="200" ><small> 
SIASATAN TANAH:</small> 
</td> <td align="left" width="200" >
<select name="SI_workEV" id="SI_workEV">
<?php 
$VSI_workEV=$myrow[SI_work];
$SI_workEV=$VSI_workEV;
for ($VLA=0; $VLA<=3; $VLA++) 
{ echo "<option";
if ($VpermohonanTXT[$VLA]==$SI_workEV){ echo " SELECTED";} 
echo ">$VpermohonanTXT[$VLA]</option>\n";} ?></select>
</td></tr>

<tr> <td align="right"><small>
PENGAMBILAN TANAH:</small>
</td> <td align="left" width="200" >
<select name="LAcquireEV" id="LAcquireEV">
<?php 
$VLAcquireEV=$myrow[LAcquire];
$LAcquireEV=$VLAcquireEV;
for ($VLA=0; $VLA<=3; $VLA++) 
{ echo "<option";
if ($VpermohonanTXT[$VLA]==$LAcquireEV){ echo " SELECTED";} 
echo ">$VpermohonanTXT[$VLA]</option>\n";} ?></select>

<td align="right" width="200" ><small>
KERJA LUARAN:</small>
</td> <td align="left" width="200" >
<select name="k_luarEV" id="k_luarEV">
<?php 
$Vk_luarEV=$myrow[k_luar];
$k_luarEV=$Vk_luarEV;
for ($VLA=0; $VLA<=3; $VLA++) 
{ echo "<option";
if ($VbelumTXT[$VLA]==$k_luarEV){ echo " SELECTED";} 
echo ">$VbelumTXT[$VLA]</option>\n";} ?></select>
</td></tr>


<tr> <td align="right"><small>
KERJA TANAH:</small>
</td> <td align="left" width="200" >
<select name="k_tanahEV" id="k_tanahEV">
<?php 
$Vk_tanahEV=$myrow[k_tanah];
$k_tanahEV=$Vk_tanahEV;
for ($VLA=0; $VLA<=3; $VLA++) 
{ echo "<option";
if ($VbelumTXT[$VLA]==$k_tanahEV){ echo " SELECTED";} 
echo ">$VbelumTXT[$VLA]</option>\n";} ?></select>

<td align="right" width="200" ><small> 
KERJA BEKALAN AIR:</small> 
</td> <td align="left" width="200" >
<select name="k_airEV" id="k_airEV">
<?php 
$Vk_airEV=$myrow[k_air];
$k_airEV=$Vk_airEV;
for ($VLA=0; $VLA<=3; $VLA++) 
{ echo "<option";
if ($VbelumTXT[$VLA]==$k_airEV){ echo " SELECTED";} 
echo ">$VbelumTXT[$VLA]</option>\n";} ?></select>
</td></tr>


<tr> <td align="right"><small>
KERJA PEMBETUNGAN:</small> 
</td> <td align="left" width="200" >
<select name="k_najisEV" id="k_najisEV">
<?php 
$Vk_najisEV=$myrow[k_najis];
$k_najisEV=$Vk_najisEV;
for ($VLA=0; $VLA<=3; $VLA++) 
{ echo "<option";
if ($VbelumTXT[$VLA]==$k_najisEV){ echo " SELECTED";} 
echo ">$VbelumTXT[$VLA]</option>\n";} ?></select>

<td align="right" width="200" ><small> 
KERJA JALAN:</small> 
</td> <td align="left" width="200" >
<select name="k_jalanEV" id="k_jalanEV">
<?php 
$Vk_jalanEV=$myrow[k_jalan];
$k_jalanEV=$Vk_jalanEV;
for ($VLA=0; $VLA<=3; $VLA++) 
{ echo "<option";
if ($VbelumTXT[$VLA]==$k_jalanEV){ echo " SELECTED";} 
echo ">$VbelumTXT[$VLA]</option>\n";} ?></select>
</td></tr>




<tr><td align="right"><small>ANALISIS:</td><td align="left" colspan="3" >
<select name="analisaEV" id="analisaEV">
<?php 
$VanalisaEV=$myrow[analisa];
$analisaEV=$VanalisaEV;
for ($VSI=0; $VSI<=20; $VSI++) 
{ echo "<option";
if ($Vprogresstxt[$VSI]==$analisaEV){ echo " SELECTED";} 
echo ">$Vprogresstxt[$VSI]</option>\n";} ?></select>
</small>%

<small> <font style="margin-left:50px"> REKABENTUK: </font>
<select name="rekabentukEV" id="rekabentukEV">
<?php 
$VrekabentukEV=$myrow[rekabentuk];
$rekabentukEV=$VrekabentukEV;
for ($VSI=0; $VSI<=20; $VSI++) 
{ echo "<option";
if ($Vprogresstxt[$VSI]==$rekabentukEV){ echo " SELECTED";} 
echo ">$Vprogresstxt[$VSI]</option>\n";} ?></select>
</small>%

<small><font style="margin-left:50px">LUKISAN:</font>
<select name="lukisanEV" id="lukisanEV">
<?php 
$VlukisanEV=$myrow[lukisan];
$lukisanEV=$VlukisanEV;
for ($VSI=0; $VSI<=20; $VSI++) 
{ echo "<option";
if ($Vprogresstxt[$VSI]==$lukisanEV){ echo " SELECTED";} 
echo ">$Vprogresstxt[$VSI]</option>\n";} ?></select>
</small>%
</td></tr>

<tr><td align="right"><small>Bill_quantity:</td><td align="left" colspan="3" >
<select name="Bill_QEV" id="Bill_QEV">
<?php 
$VBill_QEV=$myrow[Bill_Q];
$Bill_QEV=$VBill_QEV;
for ($VSI=0; $VSI<=20; $VSI++) 
{ echo "<option";
if ($Vprogresstxt[$VSI]==$Bill_QEV){ echo " SELECTED";} 
echo ">$Vprogresstxt[$VSI]</option>\n";} ?></select>
</small>%

<small> <font style="margin-left:55px"> Tender_doc:</font>
<select name="Tender_docEV" id="Tender_docEV">
<?php 
$VTender_docEV=$myrow[Tender_doc];
$Tender_docEV=$VTender_docEV;
for ($VSI=0; $VSI<=20; $VSI++) 
{ echo "<option";
if ($Vprogresstxt[$VSI]==$Tender_docEV){ echo " SELECTED";} 
echo ">$Vprogresstxt[$VSI]</option>\n";} ?></select>
</small>%



<small> <font style="margin-left:20px">Design_report:</font>
<select name="Design_reportEV" id="Design_reportEV">
<?php 
$VDesign_report=$myrow[Design_report];
$Design_reportEV=$VDesign_report;
for ($VSI=0; $VSI<=20; $VSI++) 
{ echo "<option";
if ($Vprogresstxt[$VSI]==$Design_reportEV){ echo " SELECTED";} 
echo ">$Vprogresstxt[$VSI]</option>\n";} ?></select>
</small>%</td></tr>

<tr> <td align="right"><small>Catatan<br/>Status/<br/>Laporan Mesyuarat:</td><td colspan="3" >
<div><textarea name="catatanEV" cols="90" rows="8" id="catatanEV"><?php echo $myrow[catatan] ?></textarea></div>
</small></td></tr>

<!--------------------------------------------------------------------------------------------------------------->

<tr align="center">
<td colspan="4"><input type="submit" name="Submit" value="Pinda Data / Status Baru"> 
<input type="button" name="Button" value="Batal Pindaan" onClick="location='<?php echo $fileName.'?event=Pinda';  ?>'">
<br/><font color="gray"><small>
Username:<?php echo $_SESSION['username'] ?> &nbsp;&nbsp;<i>
Pendaftar id<small>[<?php echo $_SESSION['kp_s']; ?>]</i></small></font>

<input name="id" type="hidden" id="id" value="<?php echo $myrow[id] ?>"></td></tr> 
<input name="id_daftar" type="hidden" id="id_daftar" value="<?php echo $myrow[id_daftar] ?>"> 
<!--------------------------------------------------------------------------------------------------------------->

<tr> <td align="right" bgcolor="#FDFECF" ><small>Penilaian Tender:
<?php if ( $myrow[tenderEval] == "true") 
echo "<input type=\"checkbox\" checked name=\"tenderEvalEV\" value=\"true\" />"; 
else echo "<input type=\"checkbox\" name=\"tenderEvalEV\"  value=\"true\" />"; ?></td>

<td align="left" bgcolor="#FDFECF" ><small>Mula:
<script> DateInput( 'startEval' , false, 'YYYY-MM-DD'<?php if ($myrow[startEvalDate]=='0000-00-00'){echo '';}else
echo ",'".$myrow[startEvalDate]."'" ;?>)
</script>
</td>
<td align="left" bgcolor="#FDFECF" ><small>Siap: 
<script> DateInput( 'complEval' , false, 'YYYY-MM-DD'<?php if ($myrow[complEvalDate]=='0000-00-00'){echo '';}else
echo ",'".$myrow[complEvalDate]."'" ;?>)
</script>
</td>

<td align="left" bgcolor="#FDFECF" ><small>Bil msk tender:
<input name="bilPetenderEV" type="text" id="bilPetenderEV" value="<?php echo $myrow[bilPetender] ?>"> 
</td>
</tr >

</table> </form> 




<center>[
<a href="<?php echo "$fileName?del=$myrow[id]";?>" onCLick="return confirmDelete() ;">Padam Data</a>]
<br> <br> </center> 
<?php } 
if ($del) { $menu=1;$delsql="DELETE from status_projek WHERE id='$del';";$delresult=mysql_query($delsql);
echo "<center>The event has been deleted.</center><br>";} 

if ($Submit=="Pinda Data / Status Baru"){ $menu=1;

$startDate= $start; 
$lawatDate = $lawat; 
$startEvalDate = $startEval;
$complEvalDate = $complEval;
$tenderEval = $tenderEvalEV;
$bilPetender = $bilPetenderEV;

$tenderEvalTorF = $tenderEval;
if ( $tenderEvalTorF== '' || $tenderEvalTorF=='false' || $tenderEvalTorF == 0 ) {$tenderEval = 'false' ;}
if ( $tenderEvalTorF=='true' ||  $tenderEvalTorF<> '' || $tenderEvalTorF == 1 ) {$tenderEval = 'true' ;}

//echo $tenderEval.'==tenderEvalEV - filtered';

//if ($dateFormat==1) { $startDate=date("m-d-Y",$start);}  //$Bilangan=$end;} 
//if ($dateFormat==2) { $startDate=date("d-m-Y",$start);}  //$Bilangan=$end;} 

//$id_daftar = $Vid_daftar; //$id_daftar = $_SESSION['daftar_id'];
$OIC = $_SESSION['ppk'];  // htmlspecialchars(stripslashes($OICEV),ENT_QUOTES);
$progress =$progressEV;
$sketch_proposal =$sketch_proposalEV;
$Tender_doc =$Tender_docEV;
$Design_report = $Design_reportEV;

$survey_work =$survey_workEV;
$SI_work = $SI_workEV;
$LAcquire=$LAcquireEV;
$analisa=$analisaEV; 
$rekabentuk =$rekabentukEV; 
$lukisan =$lukisanEV; 
$Bill_Q =$Bill_QEV;
$catatan = htmlspecialchars(stripslashes($catatanEV ),ENT_QUOTES) ;

$k_luar = $k_luarEV;
$k_tanah = $k_tanahEV;
$k_air = $k_airEV;
$k_najis = $k_najisEV;
$k_jalan = $k_jalanEV;

?> 

<form name="form2" method="post" action="<?php echo $fileName ?>">
<table width="800" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#FDFECF" bgcolor="#EBEEF5">
<?php

$startDate=$start;
$lawatDate=$lawat;
$startEvalDate = $startEval;
$complEvalDate = $complEval;

//if ($dateFormat==1) { $format="mm-dd-yyyy";}
//if ($dateFormat==2) { $format="dd-mm-yyyy";}
//$end=$eventLength;
//if ($dateFormat==1) { $startDate=date("m-d-Y",$start);} //$Bilangan=$end;}
//if ($dateFormat==2) { $startDate=date("d-m-Y",$start);} // $Bilangan=$end;} 
?>

<tr align="center"> <td colspan="4">
<small>TAJUK PROJEK:</small><br/><font color="darkgreen" size="4em" >
<?php echo $_SESSION['tajuk'].'</font><br/><font color="darkkhaki" size="1em">'.$_SESSION['mod_kerja'].'</font>';?> 
</td></tr>

<tr> <td width="200" align="right"><small>Tarikh Laporan:</small></td> 
<td width="600" align="left" class="style2" colspan="3"> 
<small><?php echo $startDate ?></small>
</td> </tr> 

<tr> <td align="right"><small>Peg. t/jawab:</small></td> <td align="left" colspan="3"> 
<small><?php echo $OIC ?></small>
</td> </tr> 

<tr> <td align="right" width="200" ><small>Kerja ukur:</small></td> <td align="left" width="200" >
<small><?php echo $survey_work ?></small>
</td>
<td align="right" width="200" ><small><?php echo $progress ?></small></td> <td align="left" width="200" >
<small>:Status semasa</small>
</td> </tr>

<tr> <td align="right"><small>Siasatan tanah:</small></td> <td align="left">
<small><?php echo $SI_work ?></small>
</td>
<td align="right"><small><?php echo $sketch_proposal ?></small></td> <td align="left"> 
<small>:TAHAP KEMAJUAN</small>
</td> </tr> 

<tr> <td align="right"><small>Pengambilan tanah:</small></td> <td align="left">
<small><?php echo $LAcquire ?></small>
</td>
<td align="right"><small><?php echo $analisa ?></small></td> <td align="left">
<small>:Analisa</small>
</td> </tr>

<tr> <td align="right"><small>kerja luaran :</small></td> <td align="left">
<small><?php echo $k_luar ?></small>
</td>
<td align="right"><small><?php echo $rekabentuk ?></small></td> <td align="left"> 
<small>:Rekabentuk</small>
</td> </tr> 

<tr> <td align="right"><small>kerja tanah :</small></td> <td align="left">
<small><?php echo $k_tanah ?></small>
</td>
<td align="right"><small><?php echo $lukisan ?></small></td> <td align="left"> 
<small>:Lukisan</small>
</td> </tr> 

<tr> <td align="right"><small>kerja bekalan air :</small></td> <td align="left">
<small><?php echo $k_air ?></small>
</td>
<td align="right"><small><?php echo $Bill_Q ?></small></td> <td align="left">
<small>:Bill_Q </small>
</td> </tr>

<tr> <td align="right"><small>kerja pembetongan :</small></td> <td align="left">
<small><?php echo $k_najis ?></small>
</td>
<td align="right"><small><?php echo $Tender_doc ?></small></td> <td align="left">
<small>:Tender_doc</small>
</td> </tr>

<tr> <td align="right"><small>kerja jalan :</small></td> <td align="left">
<small><?php echo $k_jalan ?></small>
</td>
<td align="right"><small><?php echo $Design_report ?></small></td> <td align="left">
<small>:Design_report</small>
</td> </tr>

<tr> <td align="right"><small>Arahan Penilaian Tender:</small></td> <td align="left">
<small><?php echo $tenderEval ?></small>
</td>
<td align="right"><small><?php echo $bilPetender ?></small></td> <td align="left">
<small>:bilPetender</small>
</td> </tr>

<tr> <td align="right"><small>startEvalDate :</small></td> <td align="left">
<small><?php echo $startEvalDate ?></small>
</td>
<td align="right"><small><?php echo $complEvalDate ?></small></td> <td align="left">
<small>:complEvalDate</small>
</td> </tr>



<tr> <td align="right"><small>Catatan :</small></td> <td align="left" colspan="3">
<small><?php echo $catatan ?></small>
</td></tr>
<tr align="center"> <td colspan="4">
<input type="submit" name="Submit" value="Simpan Pindaan"> 
<input type="button" name="Button" value="Pinda" onClick="history.back();"> 
<input type="button" name="Button" value="Batal Pindaan" onClick="location='<?php echo $fileName.'?event=Pinda';  ?>'"> 
<input type="submit" name="Submit" value="Status Baru"> 

<br/><font color="gray"> <i><small>Username:<?php echo $_SESSION['username'] ?>
&nbsp;Pendaftar id<small>[<?php echo $_SESSION['kp_s'] ?>]</small></small></i></font> 

<input name="end" type="hidden" id="end" value="<?php echo $end ?>"> 
<input name="id" type="hidden" id="id" value="<?php echo $id ?>"> 

<input name="id_daftar" type="hidden" id="id_daftar" value="<?php echo $_SESSION['daftar_id'] ?>"> 
<input name="OIC" type="hidden" id="OIC" value="<?php echo $OIC ?>"> 
<input name="start" type="hidden" id="start" value="<?php echo $start ?>">
<input name="lawat" type="hidden" id="lawat" value="<?php echo $lawat ?>">
<input name="startEval" type="hidden" id="startEval" value="<?php echo $startEval ?>"> 
<input name="complEval" type="hidden" id="complEval" value="<?php echo $complEval ?>">
<input name="bilPetender" type="hidden" id="bilPetender" value="<?php echo $bilPetender ?>">
<input name="tenderEval" type="hidden" id="tenderEval" value="<?php echo $tenderEval ?>">

<input name="progress" type="hidden" id="progress" value="<?php echo $progress ?>"> 
<input name="sketch_proposal" type="hidden" id="sketch_proposal" value="<?php echo $sketch_proposal ?>"> 
<input name="Tender_doc" type="hidden" id="Tender_doc" value="<?php echo $Tender_doc ?>"> 
<input name="Design_report" type="hidden" id="Design_report" value="<?php echo $Design_report ?>">

<input name="survey_work" type="hidden" id="survey_work" value="<?php echo $survey_work ?>">
<input name="SI_work" type="hidden" id="SI_work" value="<?php echo $SI_work ?>">
<input name="LAcquire" type="hidden" id="LAcquire" value="<?php echo $LAcquire ?>">

<input name="k_luar" type="hidden" id="k_luar" value="<?php echo $k_luar ?>">
<input name="k_tanah" type="hidden" id="k_tanah" value="<?php echo $k_tanah ?>">
<input name="k_air" type="hidden" id="k_air" value="<?php echo $k_air ?>">
<input name="k_najis" type="hidden" id="k_najis" value="<?php echo $k_najis ?>">
<input name="k_jalan" type="hidden" id="k_jalan" value="<?php echo $k_jalan ?>">

<input name="analisa" type="hidden" id="analisa" value="<?php echo $analisa ?>">
<input name="rekabentuk" type="hidden" id="rekabentuk" value="<?php echo $rekabentuk ?>">
<input name="lukisan" type="hidden" id="lukisan" value="<?php echo $lukisan ?>">
<input name="Bill_Q" type="hidden" id="Bill_Q" value="<?php echo $Bill_Q ?>">
<input name="catatan" type="hidden" id="catatan" value="<?php echo $catatan ?>">
<input name="username" type="hidden" id="username" value="<?php echo $_SESSION['username'] ?>">
<input name="kp_s" type="hidden" id="kp_s" value="<?php echo $_SESSION['kp_s'] ?>">

</td></tr> 
</table></form>

<?php } 

if ($Submit=="Status Baru") { $menu=1;
$Bilangan=$end;
//$Bilangan=$eventlength;
$startNew = date("Y-m-d");
$startDate = $startNew;
echo $startDate;
$lawatDate = $lawat;

$blokPengurus = trim($_SESSION['first_name']);

if (isset($_SESSION['first_name']))
if (isset($_SESSION['daftar_id']))
 
{$sql="INSERT INTO status_projek (id_daftar,OIC,startDate,progress,survey_work,SI_work,LAcquire,sketch_proposal,
analisa,rekabentuk,lukisan,Bill_Q,Tender_doc,Design_report,catatan,username,kp_s,regist_date,
k_luar,k_tanah,k_air,k_najis,k_jalan,lawatDate,tenderEval,bilPetender,startEvalDate,complEvalDate) VALUES 
('$id_daftar','$OIC','$startDate','$progress','$survey_work','$SI_work','$LAcquire','$sketch_proposal', 
'$analisa','$rekabentuk','$lukisan','$Bill_Q','$Tender_doc','$Design_report','$catatan','$username','$kp_s',NOW(),
'$k_luar','$k_tanah','$k_air','$k_najis','$k_jalan','$lawatDate','$tenderEval','$bilPetender','$startEval','$complEval')";


$result=mysql_query($sql); 
if (!$result) {
die('<center>Data tidak dikemaskini :  ' . mysql_error().'<br/><font color="gray"><small>Input error</small></font>');}
	else 
		{
		ob_end_clean(); // Delete the buffer.		
		header ("Location:  http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/projek_status.php?event=Pinda");
		exit();

		echo "<center>Data telah diupload </center><br>";}}

else 
{echo "<center>Anda perlu pilih satu projek untuk set status!</center>";}
else 
{echo "<center>PPK saja!</center>";}}




if ($Submit=="Simpan Pindaan") 
{ $menu=1;
$Bilangan=$end;
$startDate=$start;
$lawatDate=$lawat;

//-----------------------------------------

$sql="UPDATE status_projek SET id_daftar='$id_daftar',OIC='$OIC',startDate='$startDate',progress='$progress',
survey_work='$survey_work',SI_work='$SI_work',LAcquire='$LAcquire',sketch_proposal='$sketch_proposal',
analisa='$analisa',rekabentuk='$rekabentuk',lukisan='$lukisan',
Bill_Q='$Bill_Q',Tender_doc='$Tender_doc',Design_report='$Design_report',  
catatan='$catatan',username='$username',kp_s='$kp_s',
k_luar='$k_luar',k_tanah='$k_tanah',k_air='$k_air',k_najis='$k_najis',k_jalan='$k_jalan',lawatDate='$lawatDate', 
tenderEval='$tenderEval',bilPetender='$bilPetender',startEvalDate='$startEval',complEvalDate='$complEval'
WHERE id='$id';";



$result=mysql_query($sql);
echo "<center>Telah dikemaskini. Masuk sesi baru jika klik 'semak'.</center><br>";
	ob_end_clean(); // Delete the buffer.		
	header ("Location:  http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/projek_status.php?event=Pinda");
	exit();}

if ($menu!=1) 
{ $count=mysql_query("SELECT COUNT(*) FROM status_projek WHERE id_daftar = '{$_SESSION['daftar_id']}'");$count=mysql_fetch_array($count);
$count=$count[0];echo "<div align=\"center\">--JUMLAH DATA:<b>$count</b>--PROJEK NO:<b>{$_SESSION['daftar_id']}</b>--</div><br>";} 
?>

<!--a href="http://www.EasilySimpleCalendar.com/" target="_blank"><span class="style8">
&copy;2004 Easily Simple Calendar 4.8</span></a--> 
<br>
<?php // Include the HTML footer file.
include_once ('html/footer.htm');
?>