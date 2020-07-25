<?php
// Test CVS

require_once 'Excel/reader.php';


// ExcelFile($filename, $encoding);
$data = new Spreadsheet_Excel_Reader();


// Set output Encoding.
$data->setOutputEncoding('CP1251');

/***
* if you want you can change 'iconv' to mb_convert_encoding:
* $data->setUTFEncoder('mb');
*
**/

/***
* By default rows & cols indeces start with 1
* For change initial index use:
* $data->setRowColOffset(0);
*
**/



/***
*  Some function for formatting output.
* $data->setDefaultFormat('%.2f');
* setDefaultFormat - set format for columns with unknown formatting
*
* $data->setColumnFormat(4, '%.3f');
* setColumnFormat - set format for column (apply only to number fields)
*
**/

$data->read('bkaongooglemap.xls');

/*


 $data->sheets[0]['numRows'] - count rows
 $data->sheets[0]['numCols'] - count columns
 $data->sheets[0]['cells'][$i][$j] - data from $i-row $j-column

 $data->sheets[0]['cellsInfo'][$i][$j] - extended info about cell
    
    $data->sheets[0]['cellsInfo'][$i][$j]['type'] = "date" | "number" | "unknown"
        if 'type' == "unknown" - use 'raw' value, because  cell contain value with format '0.00';
    $data->sheets[0]['cellsInfo'][$i][$j]['raw'] = value if cell without format 
    $data->sheets[0]['cellsInfo'][$i][$j]['colspan'] 
    $data->sheets[0]['cellsInfo'][$i][$j]['rowspan'] 
*/

error_reporting(E_ALL ^ E_NOTICE);
$marker0 = '{<br/>"markers":&nbsp;[<br/>';
$marker1 = '';

for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
$marker1 .=  "{<br/>\"point\":new GLatLng(".$data->sheets[0]['cells'][$i][2].",".$data->sheets[0]['cells'][$i][3]."),<br/>".
			"\"kementerian\":\"".$data->sheets[0]['cells'][$i][4]."\",<br/>".
			"\"siling\":\"".$data->sheets[0]['cells'][$i][5]."\",<br/>".
			"\"tajukProj\":\"".$data->sheets[0]['cells'][$i][6]."\",<br/>".
			"\"lokasi\":\"".$data->sheets[0]['cells'][$i][7]."\",<br/>".
			"\"hopt\":\"".$data->sheets[0]['cells'][$i][8]."\",<br/>".
			"\"photoA\":\"&lt;img src=\"./images/".$data->sheets[0]['cells'][$i][9]."\" width=\"150\" height=\"100\" alt=\"photoA\" /&gt;\",<br/>".
			
			"\"kaedahR\":\"".$data->sheets[1]['cells'][$i][2]."\",<br/>".
			"\"skop\":\"".$data->sheets[1]['cells'][$i][3]."\",<br/>".
			"\"pereka\":\"".$data->sheets[1]['cells'][$i][4]."\",<br/>".
			"\"penyemak\":\"".$data->sheets[1]['cells'][$i][5]."\",<br/>".
			"\"kppk\":\"".$data->sheets[1]['cells'][$i][6]."\",<br/>".
			"\"BiLukisan\":\"".$data->sheets[1]['cells'][$i][7]."\",<br/>".
		
			"\"statusReka\":[ <br/>";
for ($k = 3; $k <= $data->sheets[2]['numCols']; $k++) {			
if ($data->sheets[2]['cells'][$i][$k] != '') { $marker1 .= "&nbsp;&nbsp;&nbsp;\"".$data->sheets[2]['cells'][$i][$k]."\",<br/>";}
}			
$marker1 .= "&nbsp;&nbsp;&nbsp;\"fin\"],<br/>";
/*			
$marker1 .= 			"&nbsp;&nbsp;&nbsp;\"".$data->sheets[2]['cells'][$i][3]."\",<br/>".
			"&nbsp;&nbsp;&nbsp;\"".$data->sheets[2]['cells'][$i][4]."\",<br/>".
			"&nbsp;&nbsp;&nbsp;\"".$data->sheets[2]['cells'][$i][5]."\",<br/>".
			"&nbsp;&nbsp;&nbsp;\"".$data->sheets[2]['cells'][$i][6]."\",<br/>".
			"&nbsp;&nbsp;&nbsp;\"".$data->sheets[2]['cells'][$i][7]."\",<br/>".
			"&nbsp;&nbsp;&nbsp;\"".$data->sheets[2]['cells'][$i][8]."\",<br/>".
			"&nbsp;&nbsp;&nbsp;\"".$data->sheets[2]['cells'][$i][9]."\",<br/>".
			"&nbsp;&nbsp;&nbsp;\"".$data->sheets[2]['cells'][$i][10]."\",<br/>".
			"&nbsp;&nbsp;&nbsp;\"".$data->sheets[2]['cells'][$i][11]."\",<br/>".
			"&nbsp;&nbsp;&nbsp;\"".$data->sheets[2]['cells'][$i][12]."\",<br/>".
			"&nbsp;&nbsp;&nbsp;\"".$data->sheets[2]['cells'][$i][13]."\"],<br/>";*/
			
$marker1 .= 			"\"kaedahT\":\"".$data->sheets[3]['cells'][$i][2]."\",<br/>".
			"\"ttdORpranego\":\"".$data->sheets[3]['cells'][$i][3]."\",<br/>".
			"\"iklanORnego\":\"".$data->sheets[3]['cells'][$i][4]."\",<br/>".
			"\"tutupT\":\"".$data->sheets[3]['cells'][$i][5]."\",<br/>".
			"\"kontraktor\":\"".$data->sheets[3]['cells'][$i][6]."\",<br/>".
			"\"kosK\":\"".$data->sheets[3]['cells'][$i][7]."\",<br/>".
			"\"tempohK\":\"".$data->sheets[3]['cells'][$i][8]."\",<br/>".
			"\"LA\":\"".$data->sheets[3]['cells'][$i][9]."\",<br/>".			
			"\"photoB\":\"&lt;img src=\"./images/".$data->sheets[3]['cells'][$i][10]."\" width=\"150\" height=\"100\" alt=\"photoB\" /&gt;\",<br/>".
			
			"\"SO\":\"".$data->sheets[4]['cells'][$i][2]."\",<br/>".
			"\"RE\":\"".$data->sheets[4]['cells'][$i][3]."\",<br/>".
			"\"statusBina\":[ <br/>";
for ($j = 5; $j <= $data->sheets[4]['numCols']; $j++) {			
if ($data->sheets[4]['cells'][$i][$j] != '') { $marker1 .= "&nbsp;&nbsp;&nbsp;\"".$data->sheets[4]['cells'][$i][$j]."\",<br/>";}
}
if ($i == $data->sheets[0]['numRows']) { $marker1 .= "&nbsp;&nbsp;&nbsp;\"fin\"]<br/>&nbsp;}<br/>";}
else{$marker1 .= "&nbsp;&nbsp;&nbsp;\"fin\"]<br/>&nbsp;},<br/>";}

}
echo $marker0;
	echo $marker1;
		echo '&nbsp;]&nbsp;&nbsp;}';


//print_r($data);
//print_r($data->formatRecords);
?>
