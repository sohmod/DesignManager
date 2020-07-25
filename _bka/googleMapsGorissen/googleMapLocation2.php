<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns:v="urn:schemas-microsoft-com:vml" xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1"><!-- Original script taken from: http://conversationswithmyself.com/googleMapDemo.html -->


	
		<style type="text/css">
		<!--
		h1 {
			font-family:sans-serif;
			color:blue;
			text-align: center;
			font-size:120%;
		}

		.tekst {
			font-family:sans-serif;
			color:blue;
			font-size:100%;
		}

		.smalltekst {
			font-family:sans-serif;
			color:black;
			font-size:100%;
		}
		-->	
		</style>
<style type="text/css">@media print{.gmnoprint{display:none}}@media screen{.gmnoscreen{display:none}}</style>
		
<script src="js/maps" type="text/javascript"> </script><script src="js/main.js" type="text/javascript"></script>
<script src="js/mod_jslinker.js" charset="UTF-8" type="text/javascript"></script>
<script src="js/mod_api_gcmod_dragmod_controls_api.js" charset="UTF-8" type="text/javascript"></script>		
		
    	<!--script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAACnoXrRu8Q1KftdJvyBfDPhTxI8GK4v1nc8AJws-18XdgOaX-ShQKx5mETcot1_hneBb4PBibEijDig" type="text/javascript"></script>
<script src="http://maps.google.com/maps?file=api&v=2&key=ABQIAAAAjU0EJWnWPMv7oQ-jjS7dYxTPZYElJSBeBUeMSX5xXgq6lLjHthSAk20WnZ_iuuzhMt60X_ukms-AUg" type="text/javascript"></script-->
			
<title>Google Maps Latitude, Longitude Popup</title>

</head>
	
<body onload="load()">
		<b>Google Maps Latitude, Longitude Popup</b><br>
		<div id="map" style="width: 600px; height: 400px; position: relative; background-color: rgb(229, 227, 223);"></div>

		<div id="geo" style="position: absolute; left: 820px; top: 100px;" class="tekst">
		<form name="setLatLon" action="googleMapLocation2.php">
			<b>* Coordinates:</b><br>
			<table>
				<tbody><tr><td>* Lat:</td><td><input name="lat" id="frmLat" type="text"></td></tr>
				<tr><td>* Lon:</td><td><input name="lon" id="frmLon" type="text"></td></tr>
			</tbody></table>
			<input name="setLatLon" value="Set" type="submit"><br>
		</form><br>
        <b>* Flickr tags:</b><br>
		<textarea id="geocode" cols="22" rows="3"></textarea><br>
		<br>
        <b>* RoboGEO tags:</b><br>
		<textarea id="geocodeRoboGEO" cols="22" rows="2"></textarea><br>
		
		* <a href="http://www.multimap.com/map/browse.cgi?scale=10000&amp;icon=x&amp;lat=5.000000&amp;lon=101.000000" target="_blank" id="multimap">Show location on Multimap</a><br>
		* <a href="http://www.gorissen.info/Pierre/maps/googleMapLocation.php?lat=5.000000&amp;lon=101.000000" id="maplink">Permanent Link</a><br><br>
		<script type="text/javascript">
		<!--
		google_ad_client = "pub-1588116269263536";
		google_alternate_color = "FFFFFF";
		google_ad_width = 234;
		google_ad_height = 60;
		google_ad_format = "234x60_as";
		google_ad_type = "text";
		//2006-09-30: Map
		google_ad_channel ="0993881556";
		google_color_border = "DDDDDD";
		google_color_bg = "DDDDDD";
		google_color_link = "0000FF";
		google_color_text = "333333";
		google_color_url = "333333";
		//-->
		</script>
		<script type="text/javascript" src="images/show_ads.gif"></script>
		
	</div>
	
	<div id="status" style="width: 300px;position: relative;" class="smalltekst"></div>
	<div style="width: 600px;" class="smalltekst">
		
			<p><i>Address lookup has been removed because it violated the ToS of Google Maps.</i></p>
		
		Based on code taken from <a href="http://conversationswithmyself.com/googleMapDemo.html">this website</a> and <a href="http://www.evolt.org/article/Javascript_to_Parse_URLs_in_the_Browser/17/14435/?format=print">this website</a>.<br>
All other errors are caused by code written by <a href="http://www.gorissen.info/Pierre/">Pierre Gorissen</a>.<br>
	</div>
    <script type="text/javascript">
    //<![CDATA[

	var baseLink = "googleMapLocation2.php";   //   "http://www.gorissen.info/Pierre/maps/googleMapLocation2.php";
	var multimapBaseLink = "http://www.multimap.com/map/browse.cgi?scale=10000&icon=x";
	var geocoder = new GClientGeocoder();
	var setLat = 6.084826;
	var setLon = 102.231045;   

	// argItems code taken from 
	// http://www.evolt.org/article/Javascript_to_Parse_URLs_in_the_Browser/17/14435/?format=print
	function argItems (theArgName) {
		sArgs = location.search.slice(1).split('&');
    		r = '';
    		for (var i = 0; i < sArgs.length; i++) {
        		if (sArgs[i].slice(0,sArgs[i].indexOf('=')) == theArgName) {
            			r = sArgs[i].slice(sArgs[i].indexOf('=')+1);
            			break;
        		}
    		}
    	return (r.length > 0 ? unescape(r).split(',') : '')
	}
	
	
	function getCoordForAddress(response) {
	
		if (!response || response.Status.code != 200) {
	        alert("Sorry, we were unable to geocode that address\n\n Sorry, dat adres bestaat blijkbaar niet!");
	    } else {
			place = response.Placemark[0];
			setLat = place.Point.coordinates[1];
			setLon = place.Point.coordinates[0];
			setLat = setLat.toFixed(6);
			setLon = setLon.toFixed(6);
			document.getElementById("frmLat").value = setLat;
			document.getElementById("frmLon").value = setLon;
		}
		placeMarker(setLat, setLon)
    }
	
	
	function placeMarker(setLat, setLon) {
	
		var message = "geotagged geo:lat=" + setLat + " geo:lon=" + setLon + " "; 
		document.getElementById("geocode").value = message;
		var messageRoboGEO = setLat + ";" + setLon + " "; 
		document.getElementById("geocodeRoboGEO").value = messageRoboGEO;
	  
		document.getElementById("geocode").focus();
		document.getElementById("geocode").select();

		document.getElementById("maplink").href = baseLink + "?lat=" + setLat + "&lon=" + setLon ;
		document.getElementById("multimap").href = multimapBaseLink + "&lat=" + setLat + "&lon=" + setLon ;
		document.getElementById("frmLat").value = setLat;
		document.getElementById("frmLon").value = setLon;
	  
		var map = new GMap(document.getElementById("map"), {draggableCursor: 'crosshair'});
		
		map.addControl(new GLargeMapControl()); // added
		map.addControl(new GMapTypeControl()); // added
		map.centerAndZoom(new GPoint(setLon, setLat), 16);
		
var pointCenter = new GLatLng(5.430000,102.210000);
//var map = new GMap2(document.getElementById("map"));
map.setCenter(pointCenter, 9);	


//var pointNE = new GLatLng(6.966144,104.039912 );	
//var pointSW = new GLatLng(1.17103,99.574047 );
//var groundOverlay = new GGroundOverlay("boundary/malaysiaT.png", new GLatLngBounds(pointSW, pointNE));
//map.addOverlay(groundOverlay);
//var pointNE0 = new GLatLng(7.0966144,104.939912 );	
//var pointSW0 = new GLatLng(6.966144,104.539912 );
//var groundOverlay = new GGroundOverlay("boundary/malaysia_merge3.png", new GLatLngBounds(pointSW0, pointNE0));
//map.addOverlay(groundOverlay);


		
		var point = new GPoint(setLon, setLat);
		var marker = new GMarker(point);
		
		map.addOverlay(marker);

		GEvent.addListener(map, 'click', function(overlay, point) {
			if (overlay) {
				map.removeOverlay(overlay);
			} else if (point) {
				map.recenterOrPanToLatLng(point);
				var marker = new GMarker(point);
				map.addOverlay(marker);
				var matchll = /\(([-.\d]*), ([-.\d]*)/.exec( point );
				if ( matchll ) { 
					var lat = parseFloat( matchll[1] );
					var lon = parseFloat( matchll[2] );
					lat = lat.toFixed(6);
					lon = lon.toFixed(6);
					var message = "geotagged geo:lat=" + lat + " geo:lon=" + lon + " "; 
					var messageRoboGEO =  lat + ";" + lon + " "; 

				} else { 
					var message = "<b>Error extracting info from</b>:" + point + ""; 
					var messagRoboGEO = message;
				}

				marker.openInfoWindowHtml(message);
				document.getElementById("geocode").value = message;
				document.getElementById("geocodeRoboGEO").value = messageRoboGEO;
				document.getElementById("geocodeRoboGEO").focus();
				document.getElementById("geocodeRoboGEO").select();				

				document.getElementById("maplink").href = baseLink + "?lat=" + lat + "&lon=" + lon ;
				document.getElementById("multimap").href = multimapBaseLink + "&lat=" + lat + "&lon=" + lon ;
				document.getElementById("frmLat").value = lat;
				document.getElementById("frmLon").value = lon;
				
				//GLog.write("new GLatLng(" + lat + "," + lon + "), ");
				wrt2Glog(lat,lon);
			}
		});
	}

	function findAddress() {
		myAddress = document.getElementById("address").value;
		geocoder.getLocations(myAddress, getCoordForAddress);
	
	}


	if (argItems("lat") == '' || argItems("lon") == '') {
		placeMarker(setLat, setLon);
    } else {
		var setLat = parseFloat( argItems("lat") );
		var setLon = parseFloat( argItems("lon") );
		setLat = setLat.toFixed(6);
	    setLon = setLon.toFixed(6);
		placeMarker(setLat, setLon);
    }

function wrt2Glog(klat,klon) {
					GLog.write(" new GLatLng(" + klat + "," + klon + "), ");
}
	
	
	
	
	
    //]]>
    </script>
<!-- Start twatch code -->
<script type="text/javascript"><!--
//<![CDATA[
document.write('<scr'+'ipt type="text/javascript" src="/Pierre/twatch/jslogger.php?ref='+( document["referrer"]==null?'':escape(document.referrer))+'&pg='+escape(window.location)+'&cparams=true"></scr'+'ipt>');
//]]>
//--></script><script type="text/javascript" src="gorissenGMap_files/jslogger.php"></script>
<!-- End twatch code -->

  </body></html>