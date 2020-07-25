function load () {
	
	var map = document.getElementById("map");
	
	if (GBrowserIsCompatible() || !GBrowserIsCompatible()) {

		var gmap = new GMap2(map);
		gmap.addControl( new GSmallMapControl() );
		gmap.addControl( new GMapTypeControl()) ;
		gmap.addControl( new GOverviewMapControl(new GSize(100,100)) );		
		gmap.setCenter ( new GLatLng(6.266158,100.187073), 8 );

		function makeIcon (image) {
			var icon = new GIcon();
			icon.image = image;
			icon.shadow = "images/shadow_meyda.png";
			icon.iconSize = new GSize(16, 16);
			icon.shadowSize = new GSize(24, 16);
			icon.iconAnchor = new GPoint(8, 16);
			icon.infoShadowAnchor = new GPoint(0, 0);
			icon.infoWindowAnchor = new GPoint(8, 1);	
			return icon;
		}	
		
		function formatTabOne (input) {				
			var html 	 = "<div class=\"bubble\">";
			html 		+= "<h1>" + input.homeTeam + " vs. " + input.awayTeam + "</h1>";			
			html 		+= "<p>" + input.information + "</p>";
			html		+= "</div>";					
			return html;			
		}
		
		function formatTabTwo (input) {
			var html 	 = "<div class=\"bubble\">";
			html 		+= "<h1>" + input.homeTeam + " - " + input.awayTeam + "</h1>";
			html		+= "<p>"
			if(input.fixture != null) {
				html 	+= "<strong>Starts:</strong> " + input.fixture + "<br />";
			}		
			if(input.capacity != null) {
				html 	+= "<strong>Capacity:</strong> " + input.capacity + "<br />";
			}
			if(input.previousScore != null) {
				html 	+= " " + input.previousScore + "<br />";
			}
			if(input.tv != null) {
				html 	+= " " + input.tv + "<br />";
			}
			html 		+= "</p></div>";					
			return html;			
		}
					
	    function createMarker(input) {
			var marker = new GMarker(input.point, makeIcon(input.markerImage) );						
			var tabs_array	= [ new GInfoWindowTab("Preview", formatTabOne(input) ),
			 					new GInfoWindowTab("Information", formatTabTwo(input) ) ];	
			GEvent.addListener(marker, "click", function() {
								marker.openInfoWindowTabsHtml(tabs_array);
			});
			return marker;
		}

	    function createMarkerPG(input) {
			var latlng = input.nglatlng;
			var polyG = new GPolygon(latlng, input.scolor, input.sweight, input.sopacity, input.fcolor, input.fopacity,{clickable: true} );
			GEvent.addListener(polyG, "click", function(latlng) {
				gmap.openInfoWindow(latlng, "<div class=\"polybub\"><h4> بِسْمِ اللهِ الرَّحْمنِ الرَّحِيمِ </h4><p>" + input.mylabel + "</p></div>");		
			});
		return polyG;
		}		

		function parseJson (doc) {
						
			var jsonData = eval("(" + doc + ")")
			
	        for (var j = 0; j < jsonData.polygons.length; j++) {
				var polyG = createMarkerPG(jsonData.polygons[j]);
				gmap.addOverlay(polyG);
			}	
					
	        for (var i = 0; i < jsonData.markers.length; i++) {
				var marker = createMarker(jsonData.markers[i]);
				gmap.addOverlay(marker);
			}			
		}     	
		// -----------------------------
	
	// OFF KEY : ABQIAAAACnoXrRu8Q1KftdJvyBfDPhTxI8GK4v1nc8AJws-18XdgOaX-ShQKx5mETcot1_hneBb4PBibEijDig
		
		// -----------------------------
		GDownloadUrl("js/points2.json", function(data, responseCode) { 
			parseJson(data);
		});
	
	} else {
		alert("Sorry, your browser cannot handle the true power of Google Maps");
	}
}
window.onload = load;
window.onunload = GUnload;