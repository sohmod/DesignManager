<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>epoly</title>

    <?php
    require('class/GoogleMapAPI.class.epoly.php');
    require('js/states.php');

    $map = new GoogleMapAPI('map');
    // setup database for geocode caching
    //$map->setDSN("ajax://ajaxuser:practical@localhost/GEOCODES");
    // enter YOUR Google Map Key
    $map->setAPIKey('ABQIAAAACezl5OES8dMDmq_DvDePXxR1DJfR2IAi0TSZmrrsgSOYoGgsxBTxN5RDergBZIkIAfmbeWXNM3zdtg');

    // create some map markers
    $map->addMarkerByAddress('621 N 48th St 6 Lincoln NE 68502','PJ Pizza','<b>PJ Pizza</b>');
    //$map->addMarkerByAddress('826 P St Lincoln NE 68502','Old Chicago','<b>Old Chicago</b>');
    //$map->addMarkerByAddress('3457 Holdrege St Lincoln NE 68502','Valentino^s','<b>Valentino^s</b>');
	//    $map->addPolyLineByAddress(
    //        '3457 Holdrege St Lincoln NE 68502',
    //       '826 P St Lincoln NE 68502','#FF0000',5,50);
        //$map->addPolyLineByCoords(-96.67,40.8279,102.231120,6.083813,'#008800',5,50);
    $map->addMarkerByAddress('Wakaf Che Yeh','Kota Bharu Kelantan','<b>wkf che yeh</b>');
		
        $map->addMarkerByCoords(102.231120,6.083813,'Kg Kota','<font color="green" size="5em"><b>بِسْمِ اللهِ الرَّحْمنِ الرَّحِيمِ</b></font>');
	
        $map->addMarkerByCoords(101.577755,3.168794,'Kota Damansara','<font color="green" size="5em"><b>بِسْمِ اللهِ الرَّحْمنِ الرَّحِيمِ</b></font>');
//	ff0000	ff0088	0088ff	88ff00	00ff88	00ff88	ff8800	ffff00	ff00ff	00ffff
//	000088	0000ff	FF0000	008800	00ff00	880000	

        $map->addPolyGonByCoords($WA,"#88ff00", 0, 0.5, "#88ff00", 0.3,'A0');	
        $map->addPolyGonByCoords($OR,"#ff0088", 0, 0.5, "#ff0088", 0.3,'A1');	
        $map->addPolyGonByCoords($CA,"#0088ff", 0, 0.5, "#0088ff", 0.3,'A2');	
        $map->addPolyGonByCoords($ID,"#ff00ff", 0, 0.5, "#ff00ff", 0.3,'A3');	
        $map->addPolyGonByCoords($NV,"#ffff00", 0, 0.5, "#ffff00", 0.3,'A4');	
/*        $map->addPolyGonByCoords($MT,"#00ffff", 0, 0.5, "#00ffff", 0.3,);	
        $map->addPolyGonByCoords($TX,"#000088", 0, 0.5, "#000088", 0.3,);	
        $map->addPolyGonByCoords($ND,"#0000ff", 0, 0.5, "#0000ff", 0.3,);	
        $map->addPolyGonByCoords($MN,"#ff0000", 0, 0.5, "#ff0000", 0.3,);	
        $map->addPolyGonByCoords($SD,"#008800", 0, 0.5, "#008800", 0.3,);	
        $map->addPolyGonByCoords($LA,"#00ff00", 0, 0.5, "#00ff00", 0.3,);	
        $map->addPolyGonByCoords($AZ,"#880000", 0, 0.5, "#880000", 0.3,);	*/
	
    ?>


	  
	  
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
	<table border="1">
    <tr><td>
    <?php $map->printMap(); ?>
    </td><td>
    <?php $map->printSidebar(); ?>
    </td></tr>
	</table>

	
 
    </body>
    </html>
