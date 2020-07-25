<?php
  include "PerHostData.php";
  include "duckUtils.php";


  $this->per_host_data = PerHostData::get_instance();
  $url_base = $this->per_host_data->url_base;
  $url = "$url_base/makeColouredKml.php?".$_SERVER["QUERY_STRING"];


  if (!$url)
  {
    echo "<h1>Error</h1>\n";
    echo "uh-oh, the url wasn't specified.<p>\n";
    exit(0);
  }

  // Make the URL safe 
  $url = make_string_url_safe($url);

  $title = htmlentities(get_query_variable("title"));
  $year = htmlentities(get_query_variable("year"));
  $source = htmlentities(get_query_variable("source"));
  $min = htmlentities(get_query_variable("min"));
  $max = htmlentities(get_query_variable("max"));


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" 
      xmlns:v="urn:schemas-microsoft-com:vml">
  <head>
<?php
    $google_key = $this->per_host_data->google_key;
    echo "<script src=\"http://maps.google.com/maps?file=api&v=2.80&key=$google_key\" type=\"text/javascript\"></script>"; 
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"http://maps.webfoot.com/maps1.css\" />";
?>

    <style type="text/css">
    v\:* {
      behavior:url(#default#VML);
    }
    </style>
    <script type="text/javascript"> 
<?php
    echo "<title>$title</title>\n"
?>
   
    var map;

<?php
  echo "    var geoXml = new GGeoXml(\"$url\");\n";
?>

function toggleGeoXML(geoXml) {
  if (checked) {
    map.removeOverlay(geoXml);  
  }
  else
  {
    map.addOverlay(geoXml);
  }
}

function onLoad() {
  if (GBrowserIsCompatible()) {
    map = new GMap2(document.getElementById("map")); 
    map.addControl(new GLargeMapControl());
    map.setCenter(new GLatLng(45,-100), 3);
    map.enableDoubleClickZoom();
    map.addControl(new GLargeMapControl());
    map.addOverlay(geoXml);
  }
} 

</script>

  </head>

  <body onload="onLoad()">
    <div id="banner" class="bannerBackground" style="position:absolute;top:10px;width:95%">
    <table border="0" width="96%">
    <td class="fg" align="left"><a class="fg" href="/index.html">World Wide Webfoot Maps home</a></td>
    <td class="fg" align="center"><a class="fg" href="credits.php">Credits</a></td>
    <td class="fg" align="right"><a class="fg" href="faq.php">FAQ</a></td>
    </table>
    </div>

    <div id="map" style="position:absolute;top:60px;width:550px;height:400px;float:left;border:1px solid black;"></div>
    </div>

    <div id="checkbox" style="position:absolute;top:480px;left:50px;width:400px">
    <input type="checkbox" name="overlay" value="overlay"
        onclick="this.checked ? map.addOverlay(geoXml) : map.removeOverlay(geoXml);"
        checked>
<?php
    echo "Show <i>$title</i> map overlay<br>\n";
?>

    </div>

   <!-- information about this particular map -->
   <div style="position:absolute;top:35px;left:570px;padding:8px">

<?php

   echo "    <H1>$title</H1>\n";
   echo "    <h2>Data from the year $year</h2>\n";
   echo "    Data from $source\n";
   echo "    <p>\n";
   if(is_null($min) || ($min == ""))
   {
      $min = "the minimum value";
   }
   if(is_null($max) || ($max == ""))
   {
      $max = "the maximum value";
   }
   echo "    Totally white corresponds to a data value of $min;\n".
        " totally red corresponds to a data value of $max.<p />  ".
        "Areas without data are either blue or transparent.<p />\n";
   echo "Click on the blue markers to get more information about how the ".
        "map was created or where the data came from.<p />";
   echo "See the <a href=\"$url\">KML</a> for this map</a><p>";
   echo "<b>If the map shows up but not the data, the most likely cause is that it couldn't find your CSV file.";
?>
    <p>
   </div>


    <br clear="all"/>
    <br/>
  </body>
</html>


