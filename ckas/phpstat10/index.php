<?php
include("data/setup.inc");
   if ($_REQUEST['type'] == "delete" && $_REQUEST['check'] == NULL) {
     deleteform();
   } elseif (($_REQUEST['type'] == "delete" && $_REQUEST['check'] == "yes") && ($_REQUEST['pass'] != $password || $_REQUEST['user'] != $username)) {
     deleteerror();
   } elseif ($_REQUEST['type'] == "delete" && $_REQUEST['check'] == "yes" && $_REQUEST['pass'] == $password && $_REQUEST['user'] == $username) {
	 deletefile();
   } elseif (($admin == "yes" && $_REQUEST['check'] == "yes") && ($_REQUEST['pass'] != $password || $_REQUEST['user'] != $username)) {
     adminerror();
   } elseif ($admin == "yes" && $_REQUEST['check'] == NULL) {
     adminform();
   } elseif ($admin == "yes" && $_REQUEST['check'] == "yes" && $_REQUEST['pass'] == $password && $_REQUEST['user'] == $username) {
     $temp1=read("browser");
	 $temp2=read("screen");
	 $temp6=read("color");
	 $temp3=read("os");
	 $temp4=read("stat");
	 $temp5=read("lang");
	 $temp7=read("js");
	 scprint($temp1, $temp2, $temp3, $temp4, $temp5, $temp6, $temp7);
   } else {
     $temp1=read("browser");
	 $temp2=read("screen");
	 $temp6=read("color");
	 $temp3=read("os");
	 $temp4=read("stat");
	 $temp5=read("lang");
	 $temp7=read("js");
	 scprint($temp1, $temp2, $temp3, $temp4, $temp5, $temp6, $temp7);
   }

function read($read) {
 include("data/setup.inc");
  if ($read == "browser") {
  $filename = "data/browser.dat";
 $line1 = file($filename);
      $line1 = split("<new>", $line1[0]);
      $browserlist['Internet Explorer 3'] = $line1[0];
      $browserlist['Internet Explorer 4'] = $line1[1];
      $browserlist['Internet Explorer 5'] = $line1[2];
      $browserlist['Internet Explorer 6'] = $line1[3];
      $browserlist['Internet Explorer (Other versions)'] = $line1[4];
      $browserlist['Netscape 4'] = $line1[5];
      $browserlist['Netscape 5/6'] = $line1[6];
      $browserlist['Opera'] = $line1[7];
      $browserlist['Lynx'] = $line1[8];
      $browserlist['Konqueror'] = $line1[9];
      $browserlist['Other'] = $line1[10];
 return $browserlist;
}
if ($read == "stat") {
  $filename = "data/stats.dat";
  $line1 = file($filename);
      $line1 = split("<new>", $line1[0]);
     $statlist[adate] = $line1[0];
     $statlist[sadate] = $line1[1];
     $statlist[hits] = $line1[2];
     $statlist[unique] = $line1[3];
     $statlist[ip] = $line1[4];
     $statlist[referer] = $line1[5];
	return $statlist;
}
if ($read == "screen") {
 $filename = "data/screen.dat";
 $line1 = file($filename);
      $line1 = split("<new>", $line1[0]);
     $screenlist['640x480'] = $line1[5];
     $screenlist['720x480'] = $line1[6];
     $screenlist['800x600'] = $line1[7];
     $screenlist['848x480'] = $line1[8];
     $screenlist['1024x768'] = $line1[9];
     $screenlist['1152x864'] = $line1[10];
	 $screenlist['1280x960'] = $line1[11];
     $screenlist['1280x1024'] = $line1[12];
     $screenlist['1400x1050'] = $line1[13];
     $screenlist['1600x1200'] = $line1[14];
     $screenlist['Other'] = $line1[15];
 return $screenlist;
}
if ($read == "color") {
 $filename = "data/screen.dat";
 $line1 = file($filename);
      $line1 = split("<new>", $line1[0]);
     $colorlist['256 Colors'] = $line1[0];
     $colorlist['High Color - 16 bit'] = $line1[1];
     $colorlist['True Color - 24 bit'] = $line1[2];
     $colorlist['True Color - 32 bit'] = $line1[3];
     $colorlist['Other'] = $line1[4];
  return $colorlist;
}
if ($read == "js") {
 $filename = "data/js.dat";
 $line1 = file($filename);
      $line1 = split("<new>", $line1[0]);
     $jslist['On'] = $line1[0];
     $jslist['Off'] = $line1[1];
  return $jslist;
}
if ($read == "os") {
 $filename = "data/os.dat";
 $line1 = file($filename);
      $line1 = split("<new>", $line1[0]);
     $oslist['Windows 95'] = $line1[0];
     $oslist['Windows 3.1'] = $line1[1];
     $oslist['Windows 98'] = $line1[2];
     $oslist['Windows ME'] = $line1[3];
     $oslist['Windows NT'] = $line1[4];
     $oslist['Windows 2000'] = $line1[5];
     $oslist['Windows XP'] = $line1[6];
     $oslist['Linux'] = $line1[7];
     $oslist['Unix'] = $line1[8];
     $oslist['Mac'] = $line1[9];
     $oslist['Windows 3.1/95'] = $line1[10];
     $oslist['Windows 95/NT'] = $line1[11];
     $oslist['Other'] = $line1[12];
 return $oslist;
}
if ($read == "lang") {
 $filename = "data/lang.dat";
   $line1 = file($filename);
      $line1 = split("<p>", $line1[0]);
      $la['United Kingdom academic institutions'] = $line1[0];
      $la['Andorra'] = $line1[1];
      $la['United Arab Emirates'] = $line1[2];
      $la['Afghanistan'] = $line1[3];
      $la['Antigua and Barbuda'] = $line1[4];
      $la['Anguilla'] = $line1[5];
      $la['Albania'] = $line1[6];
      $la['Armenia'] = $line1[7];
      $la['Netherlands Antilles'] = $line1[8];
      $la['Angola'] = $line1[9];
      $la['Antarctica'] = $line1[10];
      $la['Argentina'] = $line1[11];
      $la['American Samoa'] = $line1[12];
      $la['Austria'] = $line1[13];
      $la['Australia'] = $line1[14];
      $la['Aruba'] = $line1[15];
      $la['Azerbaijan'] = $line1[16];
      $la['Bosnia and Herzegovina'] = $line1[17];
      $la['Barbados'] = $line1[18];
      $la['Bangladesh'] = $line1[19];
      $la['Belgium'] = $line1[20];
      $la['Burkina Faso'] = $line1[21];
      $la['Bulgaria'] = $line1[22];
      $la['Bahrain'] = $line1[23];
      $la['Burundi'] = $line1[24];
      $la['Benin'] = $line1[25];
      $la['Bermuda'] = $line1[26];
	  $la['Brunei Darussalam'] = $line1[27];
      $la['Bolivia'] = $line1[28];
	  $la['Brazil'] = $line1[29];
	  $la['Bahamas'] = $line1[30];
	  $la['Bhutan'] = $line1[31];
	  $la['Bouvet Island'] = $line1[32];
	  $la['Botswana'] = $line1[33];
	  $la['Belarus'] = $line1[34];
	  $la['Belize'] = $line1[35];
	  $la['Canada'] = $line1[36];
	  $la['Cocos (Keeling) Islands'] = $line1[37];
	  $la['Central African Republic'] = $line1[38];
	  $la['Congo'] = $line1[39];
	  $la['Switzerland'] = $line1[40];
	  $la['Cote d`Ivoire (Ivory Coast)'] = $line1[41];
	  $la['Cook Islands'] = $line1[42];
	  $la['Chile'] = $line1[43];
	  $la['Cameroon'] = $line1[44];
	  $la['China'] = $line1[45];
	  $la['Colombia'] = $line1[46];
	  $la['US Commercial'] = $line1[47];
	  $la['Costa Rica'] = $line1[48];
	  $la['Czechoslovakia (former)'] = $line1[49];
	  $la['Cuba'] = $line1[50];
	  $la['Cape Verde'] = $line1[51];
	  $la['Christmas Island'] = $line1[52]; 
	  $la['Cyprus'] = $line1[53];
	  $la['Czech Republic'] = $line1[54];
	  $la['Germany'] = $line1[55];
	  $la['Djibouti'] = $line1[56];
	  $la['Denmark'] = $line1[57];
	  $la['Dominica'] = $line1[58];
      $la['Dominican Republic'] = $line1[59];
      $la['Algeria'] = $line1[60];
      $la['Ecuador'] = $line1[61];
      $la['US Educational'] = $line1[62];
      $la['Estonia'] = $line1[63];
      $la['Egypt'] = $line1[64];
      $la['Western Sahara'] = $line1[65];
      $la['Eritrea'] = $line1[66];
      $la['Spain'] = $line1[67];
      $la['Ethiopia'] = $line1[68];
      $la['Finland'] = $line1[69];
      $la['Fiji'] = $line1[70];
      $la['Falkland Islands (Malvinas)'] = $line1[71];
      $la['Micronesia'] = $line1[72];
      $la['Faroe Islands'] = $line1[73];
      $la['France'] = $line1[74];
      $la['France (Metropolitan)'] = $line1[75];
      $la['Gabon'] = $line1[76];
      $la['Great Britain (UK)'] = $line1[77];
      $la['Grenada'] = $line1[78];
      $la['Georgia'] = $line1[79];
      $la['French Guiana'] = $line1[80];
      $la['Ghana'] = $line1[81];
      $la['Gibraltar'] = $line1[82];
      $la['Greenland'] = $line1[83];
      $la['Gambia'] = $line1[84];
      $la['Guinea'] = $line1[85];
      $la['US Government'] = $line1[86];
      $la['Guadaloupe'] = $line1[87];
      $la['Equatorial Guinea'] = $line1[88];
      $la['Greece'] = $line1[89];
      $la['South Georgia and South Sandwich Islands'] = $line1[90];
      $la['Guatemala'] = $line1[91];
      $la['Guam'] = $line1[92];
      $la['Guinea-Bissau'] = $line1[93];
      $la['Guyana'] = $line1[94];
      $la['Hong Kong'] = $line1[95];
      $la['Heard and McDonald Islands'] = $line1[96];
      $la['Honduras'] = $line1[97];
      $la['Croatia (Hrvatska)'] = $line1[98];
      $la['Haiti'] = $line1[99];
      $la['Hungary'] = $line1[100];
      $la['Iceland'] = $line1[101];
      $la['Indonesia'] = $line1[102];
      $la['Ireland'] = $line1[103];
      $la['Israel'] = $line1[104];
      $la['India'] = $line1[105];
      $la['British Indian Ocean Territory'] = $line1[106];
      $la['Iraq'] = $line1[107];
      $la['Iran'] = $line1[108];
      $la['Italy'] = $line1[109];
      $la['Jamaica'] = $line1[110];
      $la['Jordan'] = $line1[111];
      $la['Japan'] = $line1[112];
      $la['Kenya'] = $line1[113];
      $la['Kyrgyzstan'] = $line1[114];
      $la['Cambodia'] = $line1[115];
      $la['Kiribati'] = $line1[116];
      $la['Comoros'] = $line1[117];
      $la['Saint Kitts and Nevis'] = $line1[118];
      $la['Korea (North)'] = $line1[119];
      $la['Korea (South)'] = $line1[120];
      $la['Kuwait'] = $line1[121];
      $la['Cayman Islands'] = $line1[122];
      $la['Kazakhstan'] = $line1[123];
      $la['Laos'] = $line1[124];
      $la['Lebanon'] = $line1[125];
      $la['Saint Lucia'] = $line1[126];
      $la['Liechtenstein'] = $line1[127];
      $la['Sri Lanka'] = $line1[128];
      $la['Liberia'] = $line1[129];
      $la['Lesotho'] = $line1[130];
      $la['Lithuania'] = $line1[131];
      $la['Luxembourg'] = $line1[132];
      $la['Latvia'] = $line1[133];
      $la['Libya'] = $line1[134];
      $la['Morocco'] = $line1[135];
      $la['Monaco'] = $line1[136];
      $la['Moldova'] = $line1[137];
      $la['Madagascar'] = $line1[138];
      $la['Marshall Islands'] = $line1[139];
      $la['US Military'] = $line1[140];
      $la['Macedonia'] = $line1[141];
      $la['Mali'] = $line1[142];
      $la['Mynamar'] = $line1[143];
      $la['Mongolia'] = $line1[144];
      $la['Macau'] = $line1[145];
      $la['Northern Mariana Islands'] = $line1[146];
      $la['Martinique'] = $line1[147];
      $la['Mauritania'] = $line1[148];
      $la['Montserrat'] = $line1[149];
      $la['Malta'] = $line1[150];
      $la['Mauritius'] = $line1[151];
      $la['Maldives'] = $line1[152];
      $la['Malawi'] = $line1[153];
      $la['Mexico'] = $line1[154];
      $la['Malaysia'] = $line1[155];
      $la['Mozambique'] = $line1[156];
      $la['Namibia'] = $line1[157];
      $la['New Caledonia'] = $line1[158];
      $la['Niger'] = $line1[159];
      $la['US network'] = $line1[160];
      $la['Norfolk Island'] = $line1[161];
      $la['Nigeria'] = $line1[162];
      $la['Nicaragua'] = $line1[163];
      $la['Netherlands'] = $line1[164];
      $la['Norway'] = $line1[165];
      $la['Nepal'] = $line1[166];
      $la['Nauru'] = $line1[167];
      $la['Neutral Zone'] = $line1[168];
      $la['Niue'] = $line1[169];
      $la['New Zealand (Aotearoa)'] = $line1[170];
      $la['Oman'] = $line1[171];
      $la['US Non-Profit Organization'] = $line1[172];
      $la['Panama'] = $line1[173];
      $la['Peru'] = $line1[174];
      $la['French Polynesia'] = $line1[175];
      $la['Papua New Guinea'] = $line1[176];
      $la['Philippines'] = $line1[177];
      $la['Pakistan'] = $line1[178];
      $la['Poland'] = $line1[179];
      $la['Saint Pierre and Miquelon'] = $line1[180];
      $la['Pitcairn'] = $line1[181];
      $la['Puerto Rico'] = $line1[182];
      $la['Portugal'] = $line1[183];
      $la['Palau'] = $line1[184];
      $la['Paraguay'] = $line1[185];
      $la['Qatar'] = $line1[186];
      $la['Reunion'] = $line1[187];
      $la['Romania'] = $line1[188];
      $la['Russian Federation'] = $line1[189];
      $la['Rwanda'] = $line1[190];
      $la['Saudi Arabia'] = $line1[191];
      $la['Solomon Islands'] = $line1[192];
      $la['Seychelles'] = $line1[193];
      $la['Sudan'] = $line1[194];
      $la['Sweden'] = $line1[195];
      $la['Singapore'] = $line1[196];
      $la['Saint Helena'] = $line1[197];
      $la['Slovenia'] = $line1[198];
      $la['Svalbard and Jan Mayen Islands'] = $line1[199];
      $la['Slovak Republic'] = $line1[200];
      $la['Sierra Leone'] = $line1[201];
      $la['San Marino'] = $line1[202];
      $la['Senegal'] = $line1[203];
      $la['Somalia'] = $line1[204];
      $la['Suriname'] = $line1[205];
      $la['Sao Tome and Principe'] = $line1[206];
      $la['USSR (former)'] = $line1[207];
      $la['El Salvador'] = $line1[208];
      $la['Syria'] = $line1[209];
      $la['Swaziland'] = $line1[210];
      $la['Turks and Caicos Islands'] = $line1[211];
      $la['Chad'] = $line1[212];
      $la['French Southern Territories'] = $line1[213];
      $la['Togo'] = $line1[214];
      $la['Thailand'] = $line1[215];
      $la['Tajikistan'] = $line1[216];
      $la['Tokelau'] = $line1[217];
      $la['Turkmenistan'] = $line1[218];
      $la['Tunisia'] = $line1[219];
      $la['Tonga'] = $line1[220];
      $la['East Timor'] = $line1[221];
      $la['Turkey'] = $line1[222];
      $la['Trinidad and Tobago'] = $line1[223];
      $la['Tuvalu'] = $line1[224];
      $la['Taiwan'] = $line1[225];
      $la['Tanzania'] = $line1[226];
      $la['Ukraine'] = $line1[227];
      $la['Uganda'] = $line1[228];
      $la['United Kingdom'] = $line1[229];
      $la['US Minor Outlying Islands'] = $line1[230];
      $la['United States'] = $line1[231];
      $la['Uruguay'] = $line1[232];
      $la['Uzbekistan'] = $line1[233];
      $la['Vatican City State'] = $line1[234];
      $la['Saint Vincent and the Grenadines'] = $line1[235];
      $la['Venezuela'] = $line1[236];
      $la['Virgin Islands (British)'] = $line1[237];
      $la['Virgin Islands (US)'] = $line1[238];
      $la['Viet Nam'] = $line1[239];
      $la['Vanuatu'] = $line1[240];
      $la['Wallis and Futuna Islands'] = $line1[241];
      $la['Samoa'] = $line1[242];
      $la['Yemen'] = $line1[243];
      $la['Mayotte'] = $line1[244];
      $la['Yugoslavia'] = $line1[245];
      $la['South Africa'] = $line1[246];
      $la['Zambia'] = $line1[247];
      $la['Zaire'] = $line1[248];
      $la['Zimbabwe'] = $line1[249];
      $la['Other countries'] = $line1[250];
      return $la;
	 }
 
}

function scprint($browserlist, $screenlist, $oslist, $statlist, $la, $colorlist, $jslist) {
 include("data/setup.inc");
?>
 <html>
 <head>
 <style type="text/css"> <!--
 .regtext {
 	font-family : <?php echo $font_family;?>;
 	font-size : <?php echo $font_size;?>px;
 	font-style : <?php echo $font_style;?>;
 	font-weight : <?php echo $font_weight;?>;
 	letter-spacing : <?php echo $letter_spacing;?>px;
 	color : #<?php echo $color;?>;
 }
 .headline {
 	font-family : <?php echo $font_family;?>;
 	font-size : <?php echo $font_size;?>px;
 	font-style : <?php echo $font_style;?>;
 	font-weight : bold;
 	letter-spacing : <?php echo $letter_spacing;?>px;
 	color : #<?php echo $hcolor;?>;
 }
 .link {
 	font-family : <?php echo $font_family;?>;
 	font-size : <?php echo $font_size;?>px;
 	font-style : <?php echo $font_style;?>;
 	letter-spacing : <?php echo $letter_spacing;?>px;
 	color : #<?php echo $lcolor;?>;
 	text-decoration : <?php echo $ldec;?>;
 }
 table {
    margin-left: 4px;
 }
 -->
</style>
  <title>PHPstat ver. 1.0 - Web Statistics</title>
 </head>
 <body>
 <img src="data/logo.gif" alt="" width="273" height="38" border="0"><br><br>
 <table border="0" cellspacing="2" cellpadding="2">
 <tr><td><br><div class="headline">Go to:</div></td></tr>
 <tr><td><a class="link" href="#hits">Hits</a></td></tr>
 <tr><td><a class="link" href="#browser">Browser</a></td></tr>
 <tr><td><a class="link" href="#js">Javascript</a></td></tr>
 <tr><td><a class="link" href="#color">Color Depth</a></td></tr>
 <tr><td><a class="link" href="#screen">Screen Area</a></td></tr>
 <tr><td><a class="link" href="#os">Operating System</a></td></tr>
 <tr><td><a class="link" href="#country">Country</a></td></tr>
 <tr><td><a class="link" href="#reference">Reference</a></td></tr>
 <tr><td><a class="link" href="#settings">Settings</a></td></tr>
 <tr><td><br></td></tr>
 </table>
 <a name=hits></a>
 <table>
 <tr><td><br><div class="headline">Hits:</div></td></tr>
 <tr><td><div class="regtext">Start date: <?php echo $statlist[sadate];?></div></td></tr>
 <tr><td><div class="regtext">Hits: <?php echo $statlist[hits];?></div></td></tr>
 <tr><td><div class="regtext">Unique hits: <?php echo $statlist[unique];?></div></td></tr>
 </table>
 <a name=browser></a>
 <table>
 <tr><td><br><div class="headline">Browser: </div></td></tr>
 <?php 
 $all = array_sum($browserlist); 
  foreach($browserlist as $k => $v) {
   if ($v != 0 && $show == "percent") {
    $v = (100 / $all * $v);
    $v = round($v, 2);
	?>
    <tr><td><div class="regtext"><?php echo "$k: $v%";?><br></div></td></tr>
   <?php 
   }
   elseif($v != 0 && $show == "hits"){
   ?>
    <tr><td><div class="regtext"><?php echo "$k: $v";?><br></div></td></tr>
   <?php 
   }
  }
  ?>
    </table>
 <a name=js></a>
<table>
 <tr><td><br><div class="headline">Javascript: </div></td></tr>
 <?php 
 $all = array_sum($jslist); 
  foreach($jslist as $k => $v) {
   if ($v != 0 && $show == "percent") {
    $v = (100 / $all * $v);
    $v = round($v, 2);
	?>
    <tr><td><div class="regtext"><?php echo "$k: $v%";?><br></div></td></tr>
   <?php 
   }
   elseif($v != 0 && $show == "hits"){
   ?>
    <tr><td><div class="regtext"><?php echo "$k: $v";?><br></div></td></tr>
   <?php 
   }
  }
  ?>
   </table>
   <a name=color></a>
   <table>
   <tr><td><br><div class="headline">Color depth: </div></td></tr>
  <?php 
 $all = array_sum($colorlist); 
  foreach($colorlist as $k => $v) {
    if ($v != 0 && $show == "percent") {
     $v = (100 / $all * $v);
     $v = round($v, 2);
      ?>
	  <tr><td><div class="regtext"><?php echo "$k: $v%";?><br></div></td></tr>
     <?php 
	}
   elseif($v != 0 && $show == "hits") {
   ?>
    <tr><td><div class="regtext"><?php echo "$k: $v";?><br></div></td></tr>
   <?php 
   }
  }
  ?>
   </table>
   <a name=screen></a>
   <table>
   <tr><td><br><div class="headline">Screen area: </div></td></tr>
  <?php 
 $all = array_sum($screenlist); 
  foreach($screenlist as $k => $v) {
   if ($v != 0 && $show == "percent") {
    $v = (100 / $all * $v);
    $v = round($v, 2);
	 ?>
	  <tr><td><div class="regtext"><?php echo "$k: $v%";?><br></div></td></tr>
     <?php 
   }
   elseif($v != 0 && $show == "hits") {
    ?>
    <tr><td><div class="regtext"><?php echo "$k: $v";?><br></div></td></tr>
    <?php 
   }
  }
 ?>
  </table>
  <a name=os></a>
  <table>
  <tr><td><br><div class="headline">Operating System:</div></td></tr>
 <?php 
 $all = array_sum($oslist); 
  foreach($oslist as $k => $v) {
   if ($v != 0 && $show == "percent") {
    $v = (100 / $all * $v);
    $v = round($v, 2);
	?>
     <tr><td><div class="regtext"><?php echo "$k: $v%";?><br></div></td></tr>
    <?php 
   }
   elseif($v != 0 && $show == "hits"){
   ?>
    <tr><td><div class="regtext"><?php echo "$k: $v";?><br></div></td></tr>
   <?php 
   }
  }
 ?>
  </table>
  <a name=country></a>
  <table>
  <tr><td><br><div class="headline">Country: </div></td></tr>
 <?php 
 $all = array_sum($la); 
  foreach($la as $k => $v) {
   if ($v != 0 && $show == "percent") {
    $v = (100 / $all * $v);
    $v = round($v, 2);
	?>
     <tr><td><div class="regtext"><?php echo "$k: $v%";?><br></div></td></tr>
    <?php 
   }
   elseif($v != 0 && $show == "hits"){
    ?>
    <tr><td><div class="regtext"><?php echo "$k: $v";?><br></div></td></tr>
    <?php 
   }
  }
  ?>
   </table>
   <a name=reference></a>
   <table>
   <tr><td><br><div class="headline">Reference: </div></td></tr>
  <?php 
 $refsplit = split("<refnew>", $statlist[referer]);
  if ($refshow == "all") {
   for ($i=0; $i<count($refsplit); $i++) {
   ?>
    <tr><td><a class="link" href="<?php echo $refsplit[$i];?>"><?php echo $refsplit[$i];?></a></td></tr>
   <?php 
   }
  } else {
   $refshow = $refshow + 1;
   $nr2=count($refsplit);
   $nr3=max(0,count($refsplit)-$refshow);
    for ($i=$nr3; $i<$nr2; $i++) {
    ?>
     <tr><td><a class="link" href="<?php echo $refsplit[$i];?>"><?php echo $refsplit[$i];?></a></td></tr>
    <?php 
	}
   }	
  ?>
  </table>
  <a name=settings></a>
  <table>
  <tr><td><br><div class="headline">Settings:</div></td></tr>
  <tr><td><a class="link" href="index.php?type=delete">Reset stats</a></td></tr>
  <tr><td><a class="link" href="setup.php">PHPstat setup</a></td></tr>
  </table>
  </body>
  </html>
 <?php 
}

function deletefile() {
 include("data/setup.inc");
 ?>
 <html>
 <head>
 <style type="text/css">
 <!--
 .regtext {
 font-family : <?php echo $font_family;?>;
 font-size : <?php echo $font_size;?>px;
 font-style : <?php echo $font_style;?>;
 font-weight : <?php echo $font_weight;?>;
 letter-spacing : <?php echo $letter_spacing;?>px;
 color : #<?php echo $color;?>;
 }
 .headline {
 font-family : <?php echo $font_family;?>;
 font-size : <?php echo $font_size;?>px;
 font-style : <?php echo $font_style;?>;
 font-weight : bold;
 letter-spacing : <?php echo $letter_spacing;?>px;
 color : #<?php echo $hcolor;?>;
 }
 -->
 </style>
 </head>
 <body>
 <?php 
 $date=date("j/n Y");
 $fp = fopen("data/stats.dat", "wb") or die ("The file \"$filename\" does not exist");
 flock( $fp, 2);
 fputs ($fp, "$date<new>$date<new>0<new>0<new><new><new>\n");
 flock( $fp, 1);
 fclose ($fp);
 $fp = fopen("data/os.dat", "wb") or die ("The file \"$filename\" does not exist");
 flock( $fp, 2);
 fputs ($fp, "0<new>0<new>0<new>0<new>0<new>0<new>0<new>0<new>0<new>0<new>0<new>0<new>0<new>\n");
 flock( $fp, 1);
 fclose ($fp);
 $fp = fopen("data/browser.dat", "wb") or die ("The file \"$filename\" does not exist");
 flock( $fp, 2);
 fputs ($fp, "0<new>0<new>0<new>0<new>0<new>0<new>0<new>0<new>0<new>0<new>0<new>\n");
 flock( $fp, 1);
 fclose ($fp);
 $fp = fopen("data/screen.dat", "wb") or die ("The file \"$filename\" does not exist");
 flock( $fp, 2);
 fputs ($fp, "0<new>0<new>0<new>0<new>0<new>0<new>0<new>0<new>0<new>0<new>0<new>0<new>0<new>0<new>0<new>0<new>\n");
 flock( $fp, 1);
 fclose ($fp);
 $fp = fopen("data/lang.dat", "wb") or die ("The file \"$filename\" does not exist");
 flock( $fp, 2);
 fputs ($fp, "0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>0<p>\n");
 flock( $fp, 1);
 fclose ($fp);
$fp = fopen("data/js.dat", "wb") or die ("The file \"$filename\" does not exist");
 flock( $fp, 2);
 fputs ($fp, "0<new>0<new>\n");
 flock( $fp, 1);
 fclose ($fp);
 ?>
 <img src="data/logo.gif" width="273" height="38" border="0"><p>
  <div class="headline">Stats has been reset</div>
  <META HTTP-EQUIV="REFRESH" CONTENT="1; URL=index.php<?php if ($admin=="yes") {echo "?check=yes&user=$username&pass=$password";}?>">
 </body>
 </html>
 <?php 
}

function adminerror() {
 include("data/setup.inc");
 ?>
 <html>
 <head>
 <style type="text/css">
 <!--
 .regtext {
 font-family : <?php echo $font_family;?>;
 font-size : <?php echo $font_size;?>px;
 font-style : <?php echo $font_style;?>;
 font-weight : <?php echo $font_weight;?>;
 letter-spacing : <?php echo $letter_spacing;?>px;
 color : #<?php echo $color;?>;
 }
 .headline {
 font-family : <?php echo $font_family;?>;
 font-size : <?php echo $font_size;?>px;
 font-style : <?php echo $font_style;?>;
 font-weight : bold;
 letter-spacing : <?php echo $letter_spacing;?>px;
 color : #<?php echo $hcolor;?>;
 }
 -->
 </style>
 <title>PHPstat Error - 401</title>
 </head>
 <body>
 <img src="data/error.gif" alt="" width="273" height="38" border="0"><p>
 <div class="headline">Wrong password and/or username!</div><p>
 <META HTTP-EQUIV="REFRESH" CONTENT="1; URL=index.php">
 </body>
 </html>
 <?php 
}

function deleteerror() {
 include("data/setup.inc");
 ?>
 <html>
 <head>
 <style type="text/css">
 <!--
 .regtext {
 font-family : <?php echo $font_family;?>;
 font-size : <?php echo $font_size;?>px;
 font-style : <?php echo $font_style;?>;
 font-weight : <?php echo $font_weight;?>;
 letter-spacing : <?php echo $letter_spacing;?>px;
 color : #<?php echo $color;?>;
 }
 .headline {
 font-family : <?php echo $font_family;?>;
 font-size : <?php echo $font_size;?>px;
 font-style : <?php echo $font_style;?>;
 font-weight : bold;
 letter-spacing : <?php echo $letter_spacing;?>px;
 color : #<?php echo $hcolor;?>;
 }
 -->
 </style>
 <title>PHPstat Error - 401</title>
 </head>
 <body>
 <img src="data/error.gif" alt="" width="273" height="38" border="0"><p>
 <div class="headline">Wrong password and/or username!</div><p>
 <META HTTP-EQUIV="REFRESH" CONTENT="1; URL=index.php?type=delete">
 </body>
 </html>
 <?php 
}

function deleteform() {
include("data/setup.inc");
?>
 <html>
 <head>
 <style type="text/css">
 <!--
 .regtext {
 font-family : <?php echo $font_family;?>;
 font-size : <?php echo $font_size;?>px;
 font-style : <?php echo $font_style;?>;
 font-weight : <?php echo $font_weight;?>;
 letter-spacing : <?php echo $letter_spacing;?>px;
 color : #<?php echo $color;?>;
 }
 .headline {
 font-family : <?php echo $font_family;?>;
 font-size : <?php echo $font_size;?>px;
 font-style : <?php echo $font_style;?>;
 font-weight : bold;
 letter-spacing : <?php echo $letter_spacing;?>px;
 color : #<?php echo $hcolor;?>;
 }
 -->
 </style>
  <title>PHPstat Admin</title>
 </head>
 <body>
 <table cellspacing="2" cellpadding="2" border="0">
 <tr>
 <td>
 <img src="data/admin.gif" alt="" border="0"><p>
 <form action="index.php">
 <input type="hidden" name="check" value="yes">
 <input type="hidden" name="type" value="delete">
 <div class="regtext">Username:</div>
 <input type="text" name="user" size="25" style="border: 1px solid #3f3f3f; font-family: <?php echo $font_family;?>; font-size: <?php echo $font_size;?>px; color: #<?php echo $color;?>;"><p>
 <div class="regtext">Password:</div>
 <input type="password" name="pass" size="25" style="border: 1px solid #3f3f3f; font-family: <?php echo $font_family;?>; font-size: <?php echo $font_size;?>px; color: #<?php echo $color;?>;"><p>
 <input type="submit" name="Send" value="Send" style="border: 1px solid #3f3f3f; font-family: <?php echo $font_family;?>; font-size: <?php echo $font_size;?>px; color: #<?php echo $color;?>;">
 </form>
 </td>
 </tr>
 </table>
 </body>
 </html>
 <?php 
}

function adminform() {
 include("data/setup.inc");
?>
 <html>
 <head>
 <style type="text/css">
 <!--
 .regtext {
 font-family : <?php echo $font_family;?>;
 font-size : <?php echo $font_size;?>px;
 font-style : <?php echo $font_style;?>;
 font-weight : <?php echo $font_weight;?>;
 letter-spacing : <?php echo $letter_spacing;?>px;
 color : #<?php echo $color;?>;
 }
 .headline {
 font-family : <?php echo $font_family;?>;
 font-size : <?php echo $font_size;?>px;
 font-style : <?php echo $font_style;?>;
 font-weight : bold;
 letter-spacing : <?php echo $letter_spacing;?>px;
 color : #<?php echo $hcolor;?>;
 }
 -->
 </style>
  <title>PHPstat Admin</title>
 </head>
 <body>
 <table cellspacing="2" cellpadding="2" border="0">
 <tr>
 <td>
 <img src="data/admin.gif" alt="" border="0"><p>
 <form action="index.php">
 <input type="hidden" name="check" value="yes">
 <div class="regtext">Username:</div>
 <input type="text" name="user" size="25" style="border: 1px solid #3f3f3f; font-family: <?php echo $font_family;?>; font-size: <?php echo $font_size;?>px; color: #<?php echo $color;?>;"><p>
 <div class="regtext">Password:</div>
 <input type="password" name="pass" size="25" style="border: 1px solid #3f3f3f; font-family: <?php echo $font_family;?>; font-size: <?php echo $font_size;?>px; color: #<?php echo $color;?>;"><p>
 <input type="submit" name="Send" value="Send" style="border: 1px solid #3f3f3f; font-family: <?php echo $font_family;?>; font-size: <?php echo $font_size;?>px; color: #<?php echo $color;?>;">
 </form>
 </td>
 </tr>
 </table>
 </body>
 </html>
 <?php 
}
?>
