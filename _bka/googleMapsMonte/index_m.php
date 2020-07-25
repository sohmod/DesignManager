    <?php
    require('class/GoogleMapAPI.class.php');

    $map = new GoogleMapAPI('map');
    // setup database for geocode caching
    //$map->setDSN('mysql://ajaxuser:practical@localhost/GEOCODES');
    // enter YOUR Google Map Key
    $map->setAPIKey('ABQIAAAACezl5OES8dMDmq_DvDePXxR1DJfR2IAi0TSZmrrsgSOYoGgsxBTxN5RDergBZIkIAfmbeWXNM3zdtg');

    // create some map markers
    $map->addMarkerByAddress('621 N 48th St 6 Lincoln NE 68502','PJ Pizza','<b>PJ Pizza</b>');
    $map->addMarkerByAddress('826 P St Lincoln NE 68502','Old Chicago','<b>Old Chicago</b>');
    $map->addMarkerByAddress('3457 Holdrege St Lincoln NE 68502','Valentino^s','<b>Valentino^s</b>');
	    $map->addPolyLineByAddress(
            '3457 Holdrege St Lincoln NE 68502',
            '826 P St Lincoln NE 68502','#FF0000',5,50);
        $map->addPolyLineByCoords(-96.67,40.8279,-96.7095,40.8149,'#008800',5,50);
        $map->addMarkerByCoords(102.231120,6.083813,'Kg Kota','<font color="green" size="5em"><b>بِسْمِ اللهِ الرَّحْمنِ الرَّحِيمِ</b></font>');
	
    ?>

    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
    <head>

	<script src="js/epoly.js" type="text/javascript"></script>
	  
	  
    <?php $map->printHeaderJS(); ?>
    <?php $map->printMapJS(); ?>
    <!-- necessary for google maps polyline drawing in IE -->
    <style type="text/css">
      v\:* {
        behavior:url(#default#VML);
      }
    </style>
    </head>
    <body onload="onLoad()">
    <table border=1>
    <tr><td>
    <?php $map->printMap(); ?>
    </td><td>
    <?php $map->printSidebar(); ?>
    </td></tr>
    </table>
    </body>
    </html>
