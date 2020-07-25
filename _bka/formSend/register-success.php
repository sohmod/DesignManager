<?php 	
		require_once('auth-kpp.php');

		ob_start();
		session_start();
		require_once('config.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Registration Successful</title>
<link href="demo.css" rel="stylesheet" type="text/css" />

</head>
<body>
<h1>Pendaftaran Berjaya</h1>
<p><a href="../../tna/kursus_senarai.php">Klik di sini</a> untuk lihat senarai kursus/latihan.</p>
<?php
if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
		echo '<ul class="err">';
		foreach($_SESSION['ERRMSG_ARR'] as $msg) {
			echo '<li>',$msg,'</li>'; 
		}
		echo '</ul>';
		unset($_SESSION['ERRMSG_ARR']);
	}




//Connect to mysql db
$conn = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
mysql_select_db(DB_DATABASE,$conn);


$Tajuk = $_SESSION['Tajuk'];
$TrkMula = $_SESSION['TrkMula'];
$TrkTamat = $_SESSION['TrkTamat'];
$Venue = $_SESSION['Venue'];
$Penganjur = $_SESSION['Penganjur'];
$Kos = $_SESSION['Kos'];
$FailRuj = $_SESSION['FailRuj'];
$KodKursus = $_SESSION['KodKursus'];
$username = $_SESSION['username'];
$BilangPeserta = $_SESSION['BilangPeserta'];
$kp_s = $_SESSION['kp_s'];

$tajukVV= '%'.$_SESSION['tajuk'].'%';
$lokasiVV= $_SESSION['lokasi'];
$OICVV= $_SESSION['OIC'];
$KemKlientVV= $_SESSION['KemKlient'];

$chklokasi="SELECT tajuk,lokasi,OIC,KemKlient FROM daftar_projek WHERE lokasi = '$lokasiVV'";
$chkKemKlient="SELECT tajuk,lokasi,OIC,KemKlient FROM daftar_projek WHERE KemKlient = '$KemKlientVV'";
$chkOIC="SELECT tajuk,lokasi,OIC,KemKlient FROM daftar_projek WHERE OIC = '$OICVV'";
$chktajuk="SELECT tajuk,lokasi,OIC,KemKlient FROM daftar_projek WHERE tajuk LIKE '$tajukVV' AND lokasi = '$lokasiVV'";



//, OIC = '$OICVV', KemKlient = '$KemKlientVV'";  // AND tajuk LIKE '$tajukVV'";
$chk_result=mysql_query($chktajuk,$conn); 

while ($row = mysql_fetch_array($chk_result, MYSQL_ASSOC)) {
    echo '<center><table><tr><td col="50" bgcolor="red">'.$row["tajuk"].'</td><td bgcolor="cyan">'.$row["lokasi"].'</td><td bgcolor="lightblue">'.$row["OIC"].'</td><td bgcolor="yellow">'.$row["KemKlient"].'</td></tr></table></center>';
}

$rnm=mysql_num_rows($chk_result);
echo '<center>'.$rnm.' rows</center>';


if (count($_SESSION['ERRMSG_ARR'])==0 && !empty($_SESSION['OIC'])){ 
$sql="INSERT INTO tna_kursus (Tajuk,TrkMula,TrkTamat,Venue,Penganjur,Kos,FailRuj,KodKursus,username,BilangPeserta,kp_s,tarikhDaftar) VALUES ('$Tajuk','$TrkMula','$TrkTamat','$Venue','$Penganjur','$Kos','$FailRuj','$KodKursus','$username','$BilangPeserta','$kp_s',NOW())";
$result=mysql_query($sql,$conn); }



if (!$result && $rnm==0) {
(empty($_SESSION['OIC'])) ? die('<center>Daftar Projek Oleh KPPK sahaja !</center>') :
die('<center>Data tidak didaftarkan :  ' . mysql_error().'<br/><font color="gray"><small>Fail nombor yang diketik telah ada , 
sila pinda nombor fail sediada mengikut turutan <br/>atau guna nom. dummi untuk fail sediada, 
daftar fail baru, <br/>kemudian pinda nombor dummi <i>(fail sediada tadi)</i> ke nom. daftar asal.</small></font>');} 
elseif ($rnm!=0){ 
echo "<center>Skipping Data Input...  duplicate nama projek</center><br>";  }
else {
echo "<center>Satu lagi kursus baru telah didaftarkan untuk bka !</center><br>";  }


//print "<pre>".print_r($_POST, true)."</pre>";


echo '<br/><br/>';
echo	$_SESSION['Tajuk'].'<br/>';
echo	$_SESSION['TrkMula'].'<br/>';
echo    $_SESSION['TrkTamat'].'<br/>';
echo    $_SESSION['Venue'].'<br/>';
echo    $_SESSION['Penganjur'].'<br/>';
echo	$_SESSION['Kos'].'<br/>';
echo	$_SESSION['FailRuj'].'<br/>';
echo	$_SESSION['KodKursus'].'<br/>';
echo	$_SESSION['username'].'<br/>';
echo	$_SESSION['BilangPeserta'].'<br/>';
echo    $_SESSION['kp_s'].'<br/>';	
echo    $_SESSION['tarikhDaftar'].'<br/>';

mysql_free_result($chk_result);
unset(
	$_SESSION['Tajuk'],
	$_SESSION['TrkMula'],
    $_SESSION['TrkTamat'],
    $_SESSION['Venue'],
    $_SESSION['Penganjur'],
	$_SESSION['Kos'],
	$_SESSION['FailRuj'],
	$_SESSION['KodKursus'],
	//$_SESSION['username'],
	$_SESSION['BilangPeserta'],
    //$_SESSION['kp_s'],
    $_SESSION['tarikhDaftar']
);

?>
</body>
</html>
<?php ob_flush();
?>
