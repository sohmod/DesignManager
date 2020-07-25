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
8=>'KPPK(PT)',
9=>'KPPK(Ksih)',

10=>'PA-BKA',
);


$kpOIC = array (
'123456-78-9000',

'640212-01-5729',
'640212-01-5729',
'731008-01-6709',
'731008-01-6709',

'580307-03-5341',
'600306-02-5278',
'611121-03-5422',
'630425-01-5045', // '600619-10-6239',
'880109-13-6242',

'890207-03-5612', //tasha
);

$OIC2kp = array_combine($njawatanOIC, $kpOIC);
	
	
$kp2OIC = array (
0=>'123456-78-9000',

1=>'640212-01-5729',
2=>'640212-01-5729',
3=>'731008-01-6709',
4=>'731008-01-6709',

5=>'580307-03-5341',
6=>'600306-02-5278',
7=>'611121-03-5422',
8=>'630425-01-5045',  // '600619-10-6239',
9=>'880109-13-6242',

10=>'890207-03-5612', //tasha
);

$njawatan2OIC = array (
'PENGARAH',

'KPPK(BA)',
'KPPK(BA1)',
'KPPK(BA2)',
'KPPK(BA3)',

'KPPK(KKPnPT)',
'KPPK(Ksih)',
'KPPK(Ksel)',
'KPPK(PT)',
'KPPK(Ksih)',

'PA-BKA', //tasha
);
	
$kp2OIC_checked = array_combine($kp2OIC, $njawatan2OIC);
	
?>	
