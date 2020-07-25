<?php

include("data/setup.inc");
$check = $_REQUEST['check'];
$pass = $_REQUEST['pass'];
$user = $_REQUEST['user'];
if ($check == "admin" && $pass == $password && $user == $username) {
showsetup();
} elseif (($check == "admin") && ($pass != $password || $user != $username)) {
adminerror();
} elseif ($check == "yes") {
write($_REQUEST);
} else {
admin();
}

function write($_REQUEST) {
 $show = strtolower($_REQUEST['show']);
 $refshow = strtolower($_REQUEST['refshow']);
 $ldec = strtolower($_REQUEST['ldec']);
 $hcolor = strtolower($_REQUEST['hcolor']);
 $lcolor = strtolower($_REQUEST['lcolor']);
 $font_family = strtolower($_REQUEST['font_family']);
 $font_size = strtolower($_REQUEST['font_size']);
 $color = strtolower($_REQUEST['color']);
 $font_style = strtolower($_REQUEST['font_style']);
 $font_weight = strtolower($_REQUEST['font_weight']);
 $letter_spacing = strtolower($_REQUEST['letter_spacing']);
 $admin = strtolower($_REQUEST['admin']);
 $username = strtolower($_REQUEST['username']);
 $password = strtolower($_REQUEST['password']);
 $fp = fopen("data/setup.inc", "wb") or die ("The File \"data/setup.inc\" does not exist");
 flock( $fp, 2);
 fputs ($fp, "<?php\n\$show = \"$show\";\n\$refshow = \"$refshow\";\n\$ldec = \"$ldec\";\n\$lcolor = \"$lcolor\";\n\$hcolor = \"$hcolor\";\n\$font_family = \"$font_family\";\n\$font_size = \"$font_size\";\n\$color = \"$color\";\n\$font_style = \"$font_style\";\n\$font_weight = \"$font_weight\";\n\$letter_spacing = \"$letter_spacing\";\n\$admin = \"$admin\";\n\$username = \"$username\";\n\$password = \"$password\";\n?>");
 flock( $fp, 1);
 fclose ($fp);
 include("data/setup.inc");
 ?>
 <html>
 <head>
 <style type="text/css">
 .headline {
  color: <?php echo $hcolor;?>;
  font-family: <?php echo $font_family;?>;
  font-size: <?php echo $font_size;?>px;
  font-style: <?php echo $font_style;?>;
  font-weight: bold;
  letter-spacing: <?php echo $letter_spacing;?>px;
 }
 </style>
  <title>PHPstat Setup</title>
 </head>
 <body>
  <img src="data/setup.gif" alt="" width="273" height="38" border="0"><p>
  <div class="headline">Setup has been updated</div>
  <p>
  <META HTTP-EQUIV="REFRESH" CONTENT="1; URL=index.php">
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
 color : <?php echo $color;?>;
 }
 .headline {
 font-family : <?php echo $font_family;?>;
 font-size : <?php echo $font_size;?>px;
 font-style : <?php echo $font_style;?>;
 font-weight : bold;
 letter-spacing : <?php echo $letter_spacing;?>px;
 color : <?php echo $color;?>;
 }
 -->
 </style>
 <title>PHPstat Error - 401</title>
 </head>
 <body>
 <img src="data/error.gif" alt="" width="273" height="38" border="0"><br><br><br><br>
 <div class="headline">Wrong password and/or username!</div><p>
 <META HTTP-EQUIV="REFRESH" CONTENT="1; URL=setup.php">
 </body>
 </html>
 <?php 
} 

function showsetup() {
include("data/setup.inc");
?>
 <html>
 <head>
 <style type="text/css">
 .regtext {
 	font-family : <?php echo $font_family;?>;
 	font-size : <?php echo $font_size;?>px;
 	font-style : <?php echo $font_style;?>;
 	font-weight : <?php echo $font_weight;?>;
 	letter-spacing : <?php echo $letter_spacing;?>px;
 	color : #<?php echo $color;?>;
 }
 .box {
    color: <?php echo $color;?>;
    font-family: <?php echo $font_family;?>;
    font-size: <?php echo $font_size;?>px;
    font-style: <?php echo $font_style;?>;
 	font-weight: <?php echo $font_weight;?>;
 	letter-spacing: <?php echo $letter_spacing;?>px;
 }
 .headline {
    color: <?php echo $hcolor;?>;
    font-family: <?php echo $font_family;?>;
    font-size: <?php echo $font_size;?>px;
    font-style: <?php echo $font_style;?>;
 	font-weight: bold;
 	letter-spacing: <?php echo $letter_spacing;?>px;
 }
 .link {
 	font-family : <?php echo $font_family;?>;
 	font-size : <?php echo $font_size;?>px;
 	font-style : <?php echo $font_style;?>;
 	letter-spacing : <?php echo $letter_spacing;?>px;
 	color : #<?php echo $lcolor;?>;
 	text-decoration : <?php echo $ldec;?>;
 }
 </style>
 <title>PHPstat Setup</title>
 </head>
 <body>
  <img src="data/setup.gif" alt="" border="0"><p>
  <table border="0" cellspacing="2" cellpadding="2">
  <tr><td><br><div class="headline">Go to:</div></td></tr>
  <tr><td><a class="link" href="#show">Layout Settings</a></td></tr>
  <tr><td><a class="link" href="#css">CSS</a></td></tr>
  <tr><td><a class="link" href="#password">Administrator Settings</a></td></tr>
  <tr><td><br></td></tr>
  </table>
  <form method=post action="setup.php">
  <input type="hidden" name="check" value="yes">
  <a name=show></a>
  <table>
  <tr><td>
  <div class="headline">Layout Settings:</div>
  </td></tr>
  <tr><td>
  <div class="regtext">- Show stats as hits or percent:</div>
  </td></tr>
  <tr><td>
  <select name="show" size="1" class="box">
  <option<?php if ($show=="hits") {echo " SELECTED";}?>>Hits
  <option<?php if ($show=="percent") {echo " SELECTED";}?>>Percent
  </select>
  </td></tr>
  <tr><td>
  <div class="regtext">- Number of reference to show:</div>
  </td></tr>
  <tr><td>
  <select name="refshow" size="1" class="box">
  <option<?php if ($refshow=="all") {echo " SELECTED";}?>>All
  <option<?php if ($refshow=="5") {echo " SELECTED";}?>>5
  <option<?php if ($refshow=="10") {echo " SELECTED";}?>>10
  <option<?php if ($refshow=="15") {echo " SELECTED";}?>>15
  <option<?php if ($refshow=="20") {echo " SELECTED";}?>>20
  <option<?php if ($refshow=="30") {echo " SELECTED";}?>>30
  <option<?php if ($refshow=="40") {echo " SELECTED";}?>>40
  <option<?php if ($refshow=="50") {echo " SELECTED";}?>>50
  <option<?php if ($refshow=="100") {echo " SELECTED";}?>>100
  <option<?php if ($refshow=="200") {echo " SELECTED";}?>>200
  </select>
  </td></tr>
  </table>
  <a name=css></a>
  <table>
  <tr><td>
  <br><div class="headline">CSS:</div>
  </td></tr><tr><td>
  <div class="regtext">- Link decoration:</div>
  </td></tr><tr><td>
  <select class="box" size="1" name="ldec">
  <option<?php if ($ldec=="none") {echo " SELECTED";}?>>None
  <option<?php if ($ldec=="underline") {echo " SELECTED";}?>>Underline
  <option<?php if ($ldec=="overline") {echo " SELECTED";}?>>Overline
  <option<?php if ($ldec=="line-through") {echo " SELECTED";}?>>Line-through
  <option<?php if ($ldec=="blink") {echo " SELECTED";}?>>Blink
  </select>
  </td></tr><tr><td>
  <div class="regtext">- Link color (in hex - e.g. 3f3f3f):</div>
  </td></tr><tr><td>
  <input class="box" type="text" name="lcolor" value="<?php echo $lcolor;?>" size="20">
  </td></tr><tr><td>
  <div class="regtext">- Headline color (in hex - e.g. 3f3f3f):</div>
  </td></tr><tr><td>
  <input class="box" type="text" name="hcolor" value="<?php echo $hcolor;?>" size="20">
  </td></tr><tr><td>
  <div class="regtext">- Font family:</div>
  </td></tr><tr><td>
  <select class="box" size="1" name="font_family">
  <option<?php if ($font_family=="verdana, geneva, arial, helvetica, sans-serif") {echo " SELECTED";}?>>Verdana, Geneva, Arial, Helvetica, Sans-serif
  <option<?php if ($font_family=="arial, helvetica, sans-serif") {echo " SELECTED";}?>>Arial, Helvetica, Sans-serif
  <option<?php if ($font_family=="times new roman, times, serif") {echo " SELECTED";}?>>Times New Roman, Times, Serif
  <option<?php if ($font_family=="ms sans serif, geneva, sans-serif") {echo " SELECTED";}?>>MS Sans Serif, Geneva, Sans-serif
  <option<?php if ($font_family=="courier new, courier, monospace") {echo " SELECTED";}?>>Courier New, Courier, Monospace
  </select>
  </td></tr><tr><td>
  <div class="regtext">- Font size (in pixels):</div>
  </td></tr><tr><td>
  <select class="box" size="1" name="font_size">
  <option<?php if ($font_size=="5") {echo " SELECTED";}?>>5
  <option<?php if ($font_size=="6") {echo " SELECTED";}?>>6
  <option<?php if ($font_size=="7") {echo " SELECTED";}?>>7
  <option<?php if ($font_size=="8") {echo " SELECTED";}?>>8
  <option<?php if ($font_size=="9") {echo " SELECTED";}?>>9
  <option<?php if ($font_size=="10") {echo " SELECTED";}?>>10
  <option<?php if ($font_size=="11") {echo " SELECTED";}?>>11
  <option<?php if ($font_size=="12") {echo " SELECTED";}?>>12
  <option<?php if ($font_size=="13") {echo " SELECTED";}?>>13
  <option<?php if ($font_size=="14") {echo " SELECTED";}?>>14
  <option<?php if ($font_size=="15") {echo " SELECTED";}?>>15
  <option<?php if ($font_size=="16") {echo " SELECTED";}?>>16
  <option<?php if ($font_size=="17") {echo " SELECTED";}?>>17
  <option<?php if ($font_size=="18") {echo " SELECTED";}?>>18
  <option<?php if ($font_size=="19") {echo " SELECTED";}?>>19
  <option<?php if ($font_size=="20") {echo " SELECTED";}?>>20
  </select>
  </td></tr><tr><td>
  <div class="regtext">- Font Color (in hex - e.g. 3f3f3f):</div>
  </td></tr><tr><td>
  <input class="box" type="text" name="color" value="<?php echo $color;?>" size="20">
  </td></tr><tr><td>
  <div class="regtext">- Font style:</div>
  </td></tr><tr><td>
  <select class="box" size="1" name="font_style">
  <option<?php if ($font_style=="normal") {echo " SELECTED";}?>>Normal
  <option<?php if ($font_style=="italic") {echo " SELECTED";}?>>Italic
  <option<?php if ($font_style=="oblique") {echo " SELECTED";}?>>Oblique
  </select>
  </td></tr><tr><td>
  <div class="regtext">- Font weight:</div>
  </td></tr><tr><td>
  <select class="box" size="1" name="font_weight">
  <option<?php if ($font_weight=="normal") {echo " SELECTED";}?>>Normal
  <option<?php if ($font_weight=="bolder") {echo " SELECTED";}?>>Bolder
  <option<?php if ($font_weight=="bold") {echo " SELECTED";}?>>Bold
  <option<?php if ($font_weight=="lighter") {echo " SELECTED";}?>>Lighter
  <option<?php if ($font_weight=="200") {echo " SELECTED";}?>>200
  <option<?php if ($font_weight=="300") {echo " SELECTED";}?>>300
  <option<?php if ($font_weight=="400") {echo " SELECTED";}?>>400
  <option<?php if ($font_weight=="500") {echo " SELECTED";}?>>500
  <option<?php if ($font_weight=="600") {echo " SELECTED";}?>>600
  <option<?php if ($font_weight=="700") {echo " SELECTED";}?>>700
  <option<?php if ($font_weight=="800") {echo " SELECTED";}?>>800
  <option<?php if ($font_weight=="900") {echo " SELECTED";}?>>900
  </select>
  </td></tr><tr><td>
  <div class="regtext">- Letter spacing (in pixels):</div>
  </td></tr><tr><td>
  <select class="box" size="1" name="letter_spacing">
  <option<?php if ($letter_spacing=="0") {echo " SELECTED";}?>>0
  <option<?php if ($letter_spacing=="1") {echo " SELECTED";}?>>1
  <option<?php if ($letter_spacing=="2") {echo " SELECTED";}?>>2
  <option<?php if ($letter_spacing=="3") {echo " SELECTED";}?>>3
  </select>
  </td></tr>
  </table>
  <a name=password></a>
  <table>
  <tr><td>
  <br><div class="headline">Administrator Settings</div>
  </td></tr>
  <tr><td>
  <div class="regtext">- Password protection:</div>
  </td></tr><tr><td>
  <select class="box" size="1" name="admin">
  <option<?php if ($admin=="yes") {echo " SELECTED";}?>>Yes
  <option<?php if ($admin=="no") {echo " SELECTED";}?>>No
  </select>
  </td></tr><tr><td>
  <div class="regtext">- Username:</div>
  </td></tr><tr><td>
  <input class="box" type="text" name="username" value="<?php echo $username;?>" size="20">
  </td></tr><tr><td>
  <div class="regtext">- Password:</div>
  </td></tr><tr><td>
  <input class="box" type="text" name="password" value="<?php echo $password;?>" size="20">
  </td></tr><tr><td>
  <br>
  <input class="regtext" type="submit" name="Send" value="Send" style="border: 1px solid #3f3f3f;">
  </td></tr></table>
  </form>
  </body>
  </html> 
 <?php 
}

function admin() { 
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
  color : <?php echo $color;?>;
  }
 .headline {
  font-family : <?php echo $font_family;?>;
  font-size : <?php echo $font_size;?>px;
  font-style : <?php echo $font_style;?>;
  font-weight : bold;
  letter-spacing : <?php echo $letter_spacing;?>px;
  color : <?php echo $color;?>;
  }
 -->
 </style>
 </head>
 <body>
 <table cellspacing="2" cellpadding="2" border="0">
 <tr>
 <td>
 <img src="data/admin.gif" alt="" border="0"><p>
 <form action="setup.php">
 <input type="hidden" name="check" value="admin">
 <div class="regtext">Username:</div>
 <input type="text" name="user" size="25" style="border: 1px solid #3f3f3f; font-family: <?php echo $font_family;?>; font-size: <?php echo $font_size;?>px; color: <?php echo $color;?>;"><p>
 <div class="regtext">Password:</div>
 <input type="password" name="pass" size="25" style="border: 1px solid #3f3f3f; font-family: <?php echo $font_family;?>; font-size: <?php echo $font_size;?>px; color: <?php echo $color;?>;"><p>
 <input type="submit" name="Send" value="Send" style="border: 1px solid #3f3f3f;">
 </form>
 </td>
 </tr>
 </table>
 </body>
 </html>
 <?php 
}
?>
