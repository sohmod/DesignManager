<?php

$njawatanOIC = array (
0=>'PENGARAH', 

1=>'KPPK(BA)',
2=>'KPPK(BA1)',
3=>'KPPK(BA2)',
4=>'KPPK(BA3)',

5=>'KPPK(KKPnPT)',
6=>'KPPK(Ksih)',
7=>'KPPK(Ksel)',
8=>'KPPK(PT)');


$kpOIC = array (
'123456-78-9000',

'640212-01-5729',
'640212-01-5729',
'731008-01-6709',
'731008-01-6709',

'580307-03-5341',
'630325-01-5045',
'611121-03-5422',
'600619-10-6239');

$OIC2kp = array_combine($njawatanOIC, $kpOIC);
	
	
$kp2OIC = array (
0=>'123456-78-9000',

1=>'640212-01-5729',
2=>'640212-01-5729',
3=>'731008-01-6709',
4=>'731008-01-6709',

5=>'580307-03-5341',
6=>'630325-01-5045',
7=>'611121-03-5422',
8=>'600619-10-6239');

$njawatan2OIC = array (
'PENGARAH',

'KPPK(BA)',
'KPPK(BA1)',
'KPPK(BA2)',
'KPPK(BA3)',

'KPPK(KKPnPT)',
'KPPK(Ksih)',
'KPPK(Ksel)',
'KPPK(PT)');
	
$kp2OIC = array_combine($kp2OIC, $njawatan2OIC);
	
?>	