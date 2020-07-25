<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
  <link rel="stylesheet" href="http://webfoot.com/blog.css"></link
  <title>Webfoot's Map Coloring Credits</title>
</head>
<body bgcolor="#ffffff" />
<?php
  // This barely needs to be PHP -- it's PHP *only* so I can use a sidebar.
  include '../sidebar.html';
?>


<div class="content">
  <h1>Webfoot's Map Coloring Credits</h1>
  <hr>
  <ul>
  <li>I got U.S. state boundaries from an 
  <a href="http://maps.google.com/maps/ms?ie=UTF8&hl=en&om=1&z=3&msid=103763259662194171141.000001119b4ce1e8e0f76&msa=0">electoral 
  votes map</a> by Kevin Khaw, which
  I massaged into KML and combined with a bit of PHP.</li>
  <li>I drew the Canadian province borders by hand with 
  <a href="http://googleblog.blogspot.com/2007/04/map-making-so-easy-caveman-could-do-it.html">Google MyMaps</a>.
  </li>
  <li>The French boundaries have an extensive geneology:  
  <ul>
    <li>Contours from GeoFla (http://www.ign.fr)</li>
    <li>Conversion from Lambert II+ and WGS84 by Convers (http://vtopo.free.fr)</li>
    <li>Alexandre DUBOIS (Zakapatul) pointed me at 
        <a href="http://bbs.keyhole.com/ubb/showthreaded.php/Cat/0/Number/156106/page/0/vc/1">the original KML file</a>.</li>
    <li>AleX also helped answer some questions about French localization.</li>
    <li>To make the low-resolution French d&eacute;partement boundaries, I adapted an implementation of the Douglas-Peucker algorithms
          that <a href="http://maps.huge.info">John Coryat</a> adapted from a program written by Stephen Lime.</li>
  </ul>
  
  
  <li>Naturally, I wouldn't have been able to do this without the efforts
  of the Google Geo team -- making the Google Maps API, developing
  KML, and documenting them both well.</li>
  <li>While the folks on the Google Maps mailing list haven't been directly useful on
  the maps coloring projet (yet), the help they gave me when I was getting
  started was really really helpful. For this project, just knowing that 
  they were there to call upon meant that I felt confident tackling this
  project.</li>
  <li>The <a href="http://mapki.com">Mapki</a> site is extremely useful.
  I assume I used something from there on this project, but I don't remember
  what.</li>
  </ul>
  <!-- I got a KML with country outlines from Valery Hronusov and Michael Barsky. -->

   
  </form>
  </div>  <!-- end content -->

</body>
</html>
