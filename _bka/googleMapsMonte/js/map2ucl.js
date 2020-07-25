function load () {
	
	var map = document.getElementById("map");
	
		var sidebar = document.getElementById('sidebar');
		sidebar.innerHTML = '';
		var bounds = new GLatLngBounds();		

	
	if (GBrowserIsCompatible() || !GBrowserIsCompatible()) {
	
		var bilprojek = 1;
		var gmap = new GMap2(map);
//		gmap.setMapType(G_SATELLITE_MAP);
		gmap.addControl( new GLargeMapControl() );
		gmap.addControl( new GMapTypeControl()) ;
		gmap.addMapType(G_PHYSICAL_MAP);
		gmap.setMapType(G_PHYSICAL_MAP);		
		gmap.addControl( new GOverviewMapControl(new GSize(100,100)) );		
		gmap.setCenter ( new GLatLng(4.105369,102.238770), 7 );

//
		function makeIcon (ukkptnp) {
var iconOptions = {};

iconOptions.primaryColor = "#FF0000";
      if (ukkptnp == 'pt') { iconOptions.primaryColor = "#48D1CC"; }
      if (ukkptnp == 'ki') { iconOptions.primaryColor = "#FF0000"; }
      if (ukkptnp == 'ke') { iconOptions.primaryColor = "#008000"; }
      if (ukkptnp == 'ba') { iconOptions.primaryColor = "#0000FF"; }	  
iconOptions.strokeColor = "#000000";
iconOptions.label = ukkptnp;
iconOptions.labelColor = "#ffffff";
iconOptions.addStar = false;
iconOptions.starPrimaryColor = "#FFFF00";
iconOptions.starStrokeColor = "#0000FF";
var icon = MapIconMaker.createLabeledMarkerIcon(iconOptions);

			return icon;
		}	
		
		function formatTabOne (input) {		
			var html 	 = "<div class=\"bubble\">";
			html 		+= "<h4>KEM. PELANGGAN : " + input.kementerian + "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SILING : RM" + input.siling + "</h4>";
			html		+= "<p>"
			if(input.tajukProj != null) {
				html 	+= "<span style=\"background-color: #FFFACD;\">TAJUK PROJEK : " + input.tajukProj + "</span><br />";
			}				
			if(input.lokasi != null) {
				html 	+= "LOKASI : " + input.point + "<br />";
			}
			if(input.hopt != null) {
				html 	+= "HOPT : " + input.hopt + "<br />";
			}			
			html		+= " " + input.photoA + "</p></div>";					
			return html;			
		}
		
		function formatTabTwo (input) {
			var html 	 = "<div class=\"bubble\">";
			html 		+= "<h4>Kaedah : " + input.kaedahR + "</h4>";
			html		+= "<p>"
			if(input.skop != null) {
				html 	+= "Skop : " + input.skop + "<br />";
			}		
			if(input.perekaORperunding != null) {
				html 	+= "Pereka : " + input.pereka + "<br />";
			}
			if(input.penyemakORice != null) {
				html 	+= "Penyemak : " + input.penyemak + "<br />";
			}	
			if(input.kppk != null) {
				html 	+= "HODT/PPK : " + input.kppk + "<br />";
			}
			if(input.statusReka != null) {
				html 	+= "Kemajuan : <br />" ;
					        for (var i = 0; i < input.statusReka.length; i++) {
				html 	+= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" + 
							input.statusReka[i] + "<br />";
				}			
			}
			
			
			html 		+= "</p></div>";					
			return html;			
		}
////
		function formatTabThree (input) {
			var html 	 = "<div class=\"bubble\">";
			html 		+= "<h4>Kaedah : " + input.kaedahT + "</h4>";
			html		+= "<p>"
			if(input.ttdORpranego != null) {
				html 	+= "TTD or PraNego : " + input.ttdORpranego + "<br />";
			}		
			if(input.iklanORnego != null) {
				html 	+= "Iklan or Nego : " + input.iklanORnego + "<br />";
			}
			if(input.tutupT != null) {
				html 	+= "Tutup Tender : " + input.tutupT + "<br />";
			}
			if(input.kontraktor != null) {
				html 	+= "Kontraktor : " + input.kontraktor + "<br />";
			}
			if(input.kosKontrak != null) {
				html 	+= "Kos Kontrak: " + input.kosK + "<br />";
			}
			if(input.tempohKontrak != null) {
				html 	+= "Tempoh Kontrak : " + input.tempohK + "<br />";
			}
			if(input.LA != null) {
				html 	+= "LA : " + input.LA + "<br />";
			}
			html 		+= "<br /> " + input.photoB + "</p></div>";					
			return html;			
		}
		
		function formatTabFour (input) {
			var html 	 = "<div class=\"bubble\">";
			html 		+= "<h4>S.O. : " + input.SO + "</h4>";
			html		+= "<p>"
			if(input.RE != null) {
				html 	+= "RE : " + input.RE + "<br />";
			}				
			if(input.statusBina != null) {
				html 	+= "Kemajuan : <br />" ;
					        for (var i = 0; i < input.statusBina.length; i++) {
				html 	+= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" + 
							input.statusBina[i] + "<br />";
				}			
			}

			html 		+= "</p></div>";					
			return html;			
		}		
		
////		
		
					
	    function createMarker(input) {
			var marker = new GMarker(input.point, makeIcon(input.kppk) );
			var name = input.kppk + "#" + input.tajukProj;
			var sidebarEntry = createSidebarEntry(name, marker);
         	sidebar.appendChild(sidebarEntry);
         	bounds.extend(input.point);

			
			var tabs_array	= [ new GInfoWindowTab("Perancangan", formatTabOne(input) ),
			 					new GInfoWindowTab("Rekabentuk", formatTabTwo(input) ),
								new GInfoWindowTab("Perolehan", formatTabThree(input) ),
			 					new GInfoWindowTab("Pembinaan", formatTabFour(input) ) ];	
			GEvent.addListener(marker, "click", function() {

								marker.openInfoWindowTabsHtml(tabs_array);
								gmap.setCenter ( input.point, 15 );

			});
			return marker;
		}
		
		

	    function createMarkerPG(input) {
			var latlng = input.nglatlng;
			var polyG = new GPolygon(latlng, input.scolor, input.sweight, input.sopacity, input.fcolor, input.fopacity,{clickable: true} );
    GEvent.addListener(polyG,'mouseover',function()
		{
		polyG.setStrokeStyle({opacity:0.5});
		polyG.setStrokeStyle({weight:5});
		polyG.setStrokeStyle({color:"#fff"});
		
		polyG.setFillStyle({opacity:0.1});
		}
	);

     GEvent.addListener(polyG,'mouseout',function()
		{
		polyG.setStrokeStyle({color:input.scolor});		
		polyG.setStrokeStyle({weight:input.sweight});
		polyG.setStrokeStyle({opacity:input.sopacity});
		
		polyG.setFillStyle({opacity:input.fopacity});
		}
	);
			
			GEvent.addListener(polyG, "click", function(latlng) {
				gmap.openInfoWindow(latlng, "<div class=\"polybub\"><h4>" + input.mylabel  + "</h4><p>StrokeColor : " + input.scolor + " <br/>Opacity : " + input.fopacity + "</p></div>");		
			});
		return polyG;
		}		

    function createSidebarEntry(name, marker) {
      var div = document.createElement('div');
	  var unit = name.split("#");
	  var theunit = unit[0];
	  var theprojek = unit[1];
	  var bil = bilprojek++;
		
      var html = bil + '&nbsp;&nbsp;' + '' + theprojek + ''  ; 
      div.innerHTML = html;
      div.style.cursor = 'pointer';
      div.style.marginBottom = '5px'; 
      GEvent.addDomListener(div, 'click', function() {
        GEvent.trigger(marker, 'click');
      });
      GEvent.addDomListener(div, 'mouseover', function() {
        div.style.backgroundColor = '#F6C100';
		marker.setImage("http://sohmod/_bka/googleMapsMonte/images/hl.png");
      });
      GEvent.addDomListener(div, 'mouseout', function() {
        div.style.backgroundColor = '#fff';
      if (theunit == 'pt') { marker.setImage("http://sohmod/_bka/googleMapsMonte/images/pt.png"); }
      if (theunit == 'ki') { marker.setImage("http://sohmod/_bka/googleMapsMonte/images/ki.png"); }
      if (theunit == 'ke') { marker.setImage("http://sohmod/_bka/googleMapsMonte/images/ke.png"); }
      if (theunit == 'ba') { marker.setImage("http://sohmod/_bka/googleMapsMonte/images/ba.png"); }			
		
		
      });
      return div;
    }
			
//  ground overlay
	    function createLayout(input) {

var pointNE = input.pointN;	
var pointSW = input.pointS;
var layout = new GGroundOverlay(input.iSusunatur, new GLatLngBounds(pointSW, pointNE));
			return layout;
		}	
			

		
		function parseJson (doc) {
						
			var jsonData = eval("(" + doc + ")")
			
	        for (var j = 0; j < jsonData.polygons.length; j++) {
				var polyG = createMarkerPG(jsonData.polygons[j]);
				gmap.addOverlay(polyG);
			}	

	        for (var k = 0; k < jsonData.layouts.length; k++) {
				var layout = createLayout(jsonData.layouts[k]);
				gmap.addOverlay(layout);
			}
					
	        for (var i = 0; i < jsonData.markers.length; i++) {
				var marker = createMarker(jsonData.markers[i]);
				gmap.addOverlay(marker);
			}			

		}     	
		// -----------------------------
	
	
		
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