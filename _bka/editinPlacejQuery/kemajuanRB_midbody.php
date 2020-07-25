echo '<tr><td bgcolor="#FFFFFF" height="40" width="200" style="align:left;padding-left: 20px;font-size:14px">NoFailHOPT </td>';
for ($j=1;$j<=$bilcol;$j++){ 
$chk='NoFailHOPT'.$j.'-'.$chk_id;
	$result=mysql_query("SELECT new_value FROM perancangan where id='$chk'") or die ('Error performing query');
    while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$NoFailHOPT  = $row['new_value'];	}
if (empty($NoFailHOPT) && $j==1){$NoFailHOPT = 'dateempty'; }
if (empty($NoFailHOPT) && $j==2){$NoFailHOPT = 'textempty'; }
echo '<td bgcolor="#FFFFFF" width="' . $j*150 . '"  style="align:center;padding-left: 10px;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;font-size:12px">
<span id="NoFailHOPT'.$j.'-'.$chk_id.'">'.$NoFailHOPT.'</span></td>';
$NoFailHOPT = '';
} echo '</tr>';

echo '<tr><td bgcolor="#FFFFFF" height="40" width="200" style="align:left;padding-left: 20px;font-size:14px">Kementerian </td>';
for ($j=1;$j<=$bilcol;$j++){ 
$chk='kementerian'.$j.'-'.$chk_id;
	$result=mysql_query("SELECT new_value FROM perancangan where id='$chk'") or die ('Error performing query');
    while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$kementerian  = $row['new_value'];	}
if (empty($kementerian) && $j==1){$kementerian = 'dateempty'; }
if (empty($kementerian) && $j==2){$kementerian = 'textempty'; }
echo '<td bgcolor="#FFFFFF" width="' . $j*150 . '"  style="align:center;padding-left: 10px;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;font-size:12px">
<span id="kementerian'.$j.'-'.$chk_id.'">'.$kementerian.'</span></td>';
$kementerian = '';
} echo '</tr>';

echo '<tr><td bgcolor="#FFFFFF" height="40" width="200" style="align:left;padding-left: 20px;font-size:14px">Siling </td>';
for ($j=1;$j<=$bilcol;$j++){ 
$chk='siling'.$j.'-'.$chk_id;
	$result=mysql_query("SELECT new_value FROM perancangan where id='$chk'") or die ('Error performing query');
    while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$siling  = $row['new_value'];	}
if (empty($siling) && $j==1){$siling = 'dateempty'; }
if (empty($siling) && $j==2){$siling = 'textempty'; }
echo '<td bgcolor="#FFFFFF" width="' . $j*150 . '"  style="align:center;padding-left: 10px;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;font-size:12px">
<span id="siling'.$j.'-'.$chk_id.'">'.$siling.'</span></td>';
$siling = '';
} echo '</tr>';

echo '<tr><td bgcolor="#FFFFFF" height="40" width="200" style="align:left;padding-left: 20px;font-size:14px">Tajuk Projek </td>';
for ($j=1;$j<=$bilcol;$j++){ 
$chk='tajukProj'.$j.'-'.$chk_id;
	$result=mysql_query("SELECT new_value FROM perancangan where id='$chk'") or die ('Error performing query');
    while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$tajukProj  = $row['new_value'];	}
if (empty($tajukProj) && $j==1){$tajukProj = 'dateempty'; }
if (empty($tajukProj) && $j==2){$tajukProj = 'textempty'; }
echo '<td bgcolor="#FFFFFF" width="' . $j*150 . '"  style="align:center;padding-left: 10px;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;font-size:12px">
<span id="tajukProj'.$j.'-'.$chk_id.'">'.$tajukProj.'</span></td>';
$tajukProj = '';
} echo '</tr>';

echo '<tr><td bgcolor="#FFFFFF" height="40" width="200" style="align:left;padding-left: 20px;font-size:14px">HOPT </td>';
for ($j=1;$j<=$bilcol;$j++){ 
$chk='hopt'.$j.'-'.$chk_id;
	$result=mysql_query("SELECT new_value FROM perancangan where id='$chk'") or die ('Error performing query');
    while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$hopt  = $row['new_value'];	}
if (empty($hopt) && $j==1){$hopt = 'dateempty'; }
if (empty($hopt) && $j==2){$hopt = 'textempty'; }
echo '<td bgcolor="#FFFFFF" width="' . $j*150 . '"  style="align:center;padding-left: 10px;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;font-size:12px">
<span id="hopt'.$j.'-'.$chk_id.'">'.$hopt.'</span></td>';
$hopt = '';
} echo '</tr>';

echo '<tr><td bgcolor="#FFFFFF" height="40" width="200" style="align:left;padding-left: 20px;font-size:14px">Senibina </td>';
for ($j=1;$j<=$bilcol;$j++){ 
$chk='Senibina'.$j.'-'.$chk_id;
	$result=mysql_query("SELECT new_value FROM perancangan where id='$chk'") or die ('Error performing query');
    while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$Senibina  = $row['new_value'];	}
if (empty($Senibina) && $j==1){$Senibina = 'dateempty'; }
if (empty($Senibina) && $j==2){$Senibina = 'textempty'; }
echo '<td bgcolor="#FFFFFF" width="' . $j*150 . '"  style="align:center;padding-left: 10px;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;font-size:12px">
<span id="Senibina'.$j.'-'.$chk_id.'">'.$Senibina.'</span></td>';
$Senibina = '';
} echo '</tr>';

echo '<tr><td bgcolor="#FFFFFF" height="40" width="200" style="align:left;padding-left: 20px;font-size:14px">Struktur </td>';
for ($j=1;$j<=$bilcol;$j++){ 
$chk='Struktur'.$j.'-'.$chk_id;
	$result=mysql_query("SELECT new_value FROM perancangan where id='$chk'") or die ('Error performing query');
    while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$Struktur  = $row['new_value'];	}
if (empty($Struktur) && $j==1){$Struktur = 'dateempty'; }
if (empty($Struktur) && $j==2){$Struktur = 'textempty'; }
echo '<td bgcolor="#FFFFFF" width="' . $j*150 . '"  style="align:center;padding-left: 10px;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;font-size:12px">
<span id="Struktur'.$j.'-'.$chk_id.'">'.$Struktur.'</span></td>';
$Struktur = '';
} echo '</tr>';

echo '<tr><td bgcolor="#FFFFFF" height="40" width="200" style="align:left;padding-left: 20px;font-size:14px"> Mekanikal </td>';
for ($j=1;$j<=$bilcol;$j++){ 
$chk='Mekanikal'.$j.'-'.$chk_id;
	$result=mysql_query("SELECT new_value FROM perancangan where id='$chk'") or die ('Error performing query');
    while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$Mekanikal  = $row['new_value'];	}
if (empty($Mekanikal) && $j==1){$Mekanikal = 'dateempty'; }
if (empty($Mekanikal) && $j==2){$Mekanikal = 'textempty'; }
echo '<td bgcolor="#FFFFFF" width="' . $j*150 . '"  style="align:center;padding-left: 10px;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;font-size:12px">
<span id="Mekanikal'.$j.'-'.$chk_id.'">'.$Mekanikal.'</span></td>';
$Mekanikal = '';
} echo '</tr>';

echo '<tr><td bgcolor="#FFFFFF" height="40" width="200" style="align:left;padding-left: 20px;font-size:14px">Elektrikal </td>';
for ($j=1;$j<=$bilcol;$j++){ 
$chk='Elektrikal'.$j.'-'.$chk_id;
	$result=mysql_query("SELECT new_value FROM perancangan where id='$chk'") or die ('Error performing query');
    while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$Elektrikal  = $row['new_value'];	}
if (empty($Elektrikal) && $j==1){$Elektrikal = 'dateempty'; }
if (empty($Elektrikal) && $j==2){$Elektrikal = 'textempty'; }
echo '<td bgcolor="#FFFFFF" width="' . $j*150 . '"  style="align:center;padding-left: 10px;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;font-size:12px">
<span id="Elektrikal'.$j.'-'.$chk_id.'">'.$Elektrikal.'</span></td>';
$Elektrikal = '';
} echo '</tr>';

echo '<tr><td bgcolor="#FFFFFF" height="40" width="200" style="align:left;padding-left: 20px;font-size:14px">Ukur Bahan </td>';
for ($j=1;$j<=$bilcol;$j++){ 
$chk='UkurBahan'.$j.'-'.$chk_id;
	$result=mysql_query("SELECT new_value FROM perancangan where id='$chk'") or die ('Error performing query');
    while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$UkurBahan  = $row['new_value'];	}
if (empty($UkurBahan) && $j==1){$UkurBahan = 'dateempty'; }
if (empty($UkurBahan) && $j==2){$UkurBahan = 'textempty'; }
echo '<td bgcolor="#FFFFFF" width="' . $j*150 . '"  style="align:center;padding-left: 10px;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;font-size:12px">
<span id="UkurBahan'.$j.'-'.$chk_id.'">'.$UkurBahan.'</span></td>';
$UkurBahan = '';
} echo '</tr>';

echo '<tr><td bgcolor="#FFFFFF" height="40" width="200" style="align:left;padding-left: 20px;font-size:14px">Catatan </td>';
for ($j=1;$j<=$bilcol;$j++){ 
$chk='Catatan'.$j.'-'.$chk_id;
	$result=mysql_query("SELECT new_value FROM perancangan where id='$chk'") or die ('Error performing query');
    while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$Catatan  = $row['new_value'];	}
if (empty($Catatan) && $j==1){$Catatan = 'dateempty'; }
if (empty($Catatan) && $j==2){$Catatan = 'textempty'; }
echo '<td bgcolor="#FFFFFF" width="' . $j*150 . '"  style="align:center;padding-left: 10px;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;font-size:12px">
<span id="Catatan'.$j.'-'.$chk_id.'">'.$Catatan.'</span></td>';
$Catatan = '';
} echo '</tr>';
