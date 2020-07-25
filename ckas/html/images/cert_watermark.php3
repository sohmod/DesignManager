<?php

// this example is provided by ecofarm at mullum dot com dot au


// set up array of points for polygon
$values = array(
0 => 40, // x1
1 => 50, // y1
2 => 20, // x2
3 => 240, // y2
4 => 60, // x3
5 => 60, // y3
6 => 240, // x4
7 => 20, // y4
8 => 50, // x5
9 => 40, // y5
10 => 10, // x6
11 => 10, // y6
);
$values2 = array(
0 => 25, // x1
1 => 44, // y1
2 => 144, // x2
3 => 22, // y2
4 => 66, // x3
5 => 66, // y3
6 => 22, // x4
7 => 144, // y4
8 => 44, // x5
9 => 25, // y5
10 => 11, // x6
11 => 11, // y6
);


// create image

$sizesx = 750;
$sizesy = 450;

$im=imagecreatetruecolor($sizesx, $sizesy);
//$im = imagecreate(250, 250);
$back = imagecolorallocate($im, 255, 255, 255);
$border = imagecolorallocate($im, 0, 0, 0);
imagefilledrectangle($im, 0, 0, $sizesx - 1, $sizesy - 1, $back);
imagerectangle($im, 0, 0, $sizesx - 1, $sizesy - 1, $border);

// some colors
$yellow_a = imagecolorallocatealpha($im, 250, 250, 10, 55);
$red_a = imagecolorallocatealpha($im, 255, 0, 0, 30);
$blue_a = imagecolorallocatealpha($im, 0, 0, 255, 30);

//$bg = imagecolorallocate($im, 255, 255, 255);
//$blue = imagecolorallocate($im, 0, 0, 255);
//$tcol = imagecolorallocate($im, 100, 0, 150);
$lembaga_1="LEMBAGALEMBAGALEMBAGALEMBAGALEMBAGALEMBAGALEMBAGALEMBA-1??";
$keputusan_2="KEPUTUSANKEPUTUSANKEPUTUSANKEPUTUSANKEPUTUSANKEPU-2??";
$nama="WAN SOHAIMI BIN WAN MOHAMED AL-WAKAF AL-SHEIKH.";
$alamata="360 KAMPUNG WAKAF HAJI ABDULLAH, KOTA, 50100 KOTA BHARU, KELANTAN, MALAYSIA,";
$alamatb="360 KAMPUNG WAKAF HAJI ABDULLAH, KOTA, 50100 KOTA BHARU, KELANTAN, MALAYSIA,";

$state_a="Adalah disahkan bahawa calon berikut telah menduduki peperiksaan yang";
$state_b="tersebut di atas. Di bawah adalah keputusan yang telah diperolehi olehnya.";
$state_c="-statements-8c";
$state_d="-statements-8d";

imagestring($im, 5, 150, 85, $lembaga_1, $blue_a );
imagestring($im, 5, 170, 100, $keputusan_2, $red_a );
imagestring($im, 5, 20, 130, "PEPERIKSAAN-3", $blue_a );
imagestring($im, 4, 400, 130, "NO FAIL-4", $red_a );
imagestring($im, 4, 70, 145, "JURUSAN-5", $blue_a );
imagestring($im, 4, 400, 145, "TARIKH-6", $red_a );

imagestring($im, 3, 20, 165, $nama, $blue_a );
	imagestring($im, 2, 20, 180, $alamata, $blue_a );
	imagestring($im, 2, 20, 180, $alamatb, $blue_a );
imagerectangle($im, 20-4, 165-2, 20+270, 165+70, $border);



imagestring($im, 1, 370, 170, $state_a, $red_a );
imagestring($im, 1, 370, 180, $state_b, $red_a );
	imagestring($im, 4, 400, 205, $state_c, $red_a );
	imagestring($im, 4, 400, 220, $state_d, $red_a );

$bahagian_i="    I";
$tarikh_i="TARIKH-1";
$perkara_i="   UMUM";
$keputusan_i="KEPUTUSAN-1";
$bahagian_ii="    II";
$tarikh_ii="TARIKH-2";
$perkara_ii="  KHUSUS";
$keputusan_ii="KEPUTUSAN-2";




imagestring($im, 4, 20, 240, "BAHAGIAN", $blue_a );
imagestring($im, 4, 150, 240, "TARIKH", $red_a );
imagestring($im, 4, 300, 240, "PERKARA", $blue_a );
imagestring($im, 4, 520, 240, "KEPUTUSAN", $red_a );

imagestring($im, 4, 20, 265, $bahagian_i, $blue_a );
imagestring($im, 4, 150, 265, $tarikh_i, $red_a );
imagestring($im, 4, 300, 265, $perkara_i, $blue_a );
imagestring($im, 4, 520, 265, $keputusan_i, $red_a );
imagerectangle($im, 20-4, 265-2, 20+84, 265+18, $border);
imagerectangle($im, 150-4, 265-2, 150+84, 265+18, $border);
imagerectangle($im, 300-4, 265-2, 300+84, 265+18, $border);
imagerectangle($im, 420-4, 265-2, 520+200, 265+18, $border);

imagestring($im, 4, 20, 290, $bahagian_ii, $blue_a );
imagestring($im, 4, 150, 290, $tarikh_ii, $red_a );
imagestring($im, 4, 300, 290, $perkara_ii, $blue_a );
imagestring($im, 4, 520, 290, $keputusan_ii, $red_a );
imagerectangle($im, 20-4, 290-2, 20+84, 290+18, $border);
imagerectangle($im, 150-4, 290-2, 150+84, 290+18, $border);
imagerectangle($im, 300-4, 290-2, 300+84, 290+18, $border);
imagerectangle($im, 420-4, 290-2, 520+200, 290+18, $border);

$bahagian_iu=" umum";
$bahagian_iiu=" umum";
$bahagian_ik=" khusus";
$bahagian_iik=" khusus";


imagestring($im, 4, 480, 350, "BAHAGIAN I ", $red_a );
imagestring($im, 4, 620, 350, "BAHAGIAN II", $blue_a );

imagestring($im, 1, 20, 380, "Boleh menduduki semula bahagian berkenaan pada peperiksaan PTK berikutnya.",$blue_a );
imagestring($im, 4, 480, 375, $bahagian_iu, $red_a );
imagestring($im, 4, 620, 375, $bahagian_iiu,  $blue_a );
imagerectangle($im, 480-9, 375-2, 480+95, 375+22, $border);
imagerectangle($im, 620-9, 375-2, 620+95, 375+22, $border);

imagestring($im, 1, 20, 404, "Boleh menduduki semula bahagian berkenaan pada peperiksaan berkenaan",$blue_a );
imagestring($im, 1, 20, 414, "selepas satu tahun atau selepas satu peperiksaan yang mana yang terkemudian.",$blue_a );


imagestring($im, 4, 480, 404, $bahagian_ik, $red_a );
imagestring($im, 4, 620, 404, $bahagian_iik, $blue_a);
imagerectangle($im, 480-9, 404-2, 480+95, 404+22, $border);
imagerectangle($im, 620-9, 404-2, 620+95, 404+22, $border);





// draw a polygon
//imagefilledpolygon($im, $values, 6, $yellow_a );
//imagefilledpolygon($im, $values2, 6, $red_a );
//
//$img_disp = imagecreate(750,450);
//$backcolor = imagecolorallocate($img_disp,0,0,0);
//imagefill($img_disp,0,0,$backcolor);
//$textcolor = imagecolorallocate($img_disp,255,0,0);
$x1 = 750;
$y1 = 0;
$x2 = 0;
$y2 = 0;
$x11 = 0;
$y11 = 0;
$x22 = 750;
$y22 = 0;
while ($i < 30){
$y1 = $y1 + 30;
$x2 = $x2 + 30;
$y11 = $y11 + 30;
$x22 = $x22 - 30;
imageline($im,$x1,$y1,$x2,$y2,$yellow_a );
imageline($im,$x11,$y11,$x22,$y22,$yellow_a );

$i++;}
//
$watermark = imagecreatefrompng('watermark.png');  
$watermark_width = imagesx($watermark);  
$watermark_height = imagesy($watermark);  
$image = imagecreatetruecolor($watermark_width, $watermark_height);
$dest_x = $sizesx/2 - $watermark_width/2 ;  
$dest_y = $sizesy/2 - $watermark_height/2 ;  
imagecopymerge($im, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height, 20);  
//imagecopymerge($im, $img_disp, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height, 20);  



// flush image
header('Content-type: image/png');
imagepng($im);
imagedestroy($im);


?> 
