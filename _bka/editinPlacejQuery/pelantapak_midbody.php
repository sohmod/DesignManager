echo '<tr><td bgcolor="#FFFFFF" height="40" width="200" style="align:left;padding-left: 20px;font-size:14px">imagessa </td>';
for ($j=1;$j<=$bilcol;$j++){ 
$chk='imagessa'.$j.'-'.$chk_id;
	$result=mysql_query("SELECT new_value FROM susunatur where id='$chk'") or die ('Error performing query');
    while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$imagessa  = $row['new_value'];	}
if (empty($imagessa) && $j==1){$imagessa = 'dateempty'; }
if (empty($imagessa) && $j==2){$imagessa = 'textempty'; }
echo '<td bgcolor="#FFFFFF" width="' . $j*150 . '"  style="align:center;padding-left: 10px;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;font-size:12px">
<span id="imagessa'.$j.'-'.$chk_id.'">'.$imagessa.'</span></td>';
$imagessa = '';
} echo '</tr>';

echo '<tr><td bgcolor="#FFFFFF" height="40" width="200" style="align:left;padding-left: 20px;font-size:14px">photoI </td>';
for ($j=1;$j<=$bilcol;$j++){ 
$chk='photoI'.$j.'-'.$chk_id;
	$result=mysql_query("SELECT new_value FROM susunatur where id='$chk'") or die ('Error performing query');
    while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$photoI  = $row['new_value'];	}
if (empty($photoI) && $j==1){$photoI = 'dateempty'; }
if (empty($photoI) && $j==2){$photoI = 'textempty'; }
echo '<td bgcolor="#FFFFFF" width="' . $j*150 . '"  style="align:center;padding-left: 10px;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;font-size:12px">
<span id="photoI'.$j.'-'.$chk_id.'">'.$photoI.'</span></td>';
$photoI = '';
} echo '</tr>';

echo '<tr><td bgcolor="#FFFFFF" height="40" width="200" style="align:left;padding-left: 20px;font-size:14px">photoII </td>';
for ($j=1;$j<=$bilcol;$j++){ 
$chk='photoII'.$j.'-'.$chk_id;
	$result=mysql_query("SELECT new_value FROM susunatur where id='$chk'") or die ('Error performing query');
    while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$photoII  = $row['new_value'];	}
if (empty($photoII) && $j==1){$photoII = 'dateempty'; }
if (empty($photoII) && $j==2){$photoII = 'textempty'; }
echo '<td bgcolor="#FFFFFF" width="' . $j*150 . '"  style="align:center;padding-left: 10px;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;font-size:12px">
<span id="photoII'.$j.'-'.$chk_id.'">'.$photoII.'</span></td>';
$photoII = '';
} echo '</tr>';

echo '<tr><td bgcolor="#FFFFFF" height="40" width="200" style="align:left;padding-left: 20px;font-size:14px"> photoIII </td>';
for ($j=1;$j<=$bilcol;$j++){ 
$chk='photoIII'.$j.'-'.$chk_id;
	$result=mysql_query("SELECT new_value FROM susunatur where id='$chk'") or die ('Error performing query');
    while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
$photoIII  = $row['new_value'];	}
if (empty($photoIII) && $j==1){$photoIII = 'dateempty'; }
if (empty($photoIII) && $j==2){$photoIII = 'textempty'; }
echo '<td bgcolor="#FFFFFF" width="' . $j*150 . '"  style="align:center;padding-left: 10px;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;font-size:12px">
<span id="photoIII'.$j.'-'.$chk_id.'">'.$photoIII.'</span></td>';
$photoIII = '';
} echo '</tr>';