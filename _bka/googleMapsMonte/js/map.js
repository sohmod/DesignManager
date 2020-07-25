    //<![CDATA[
// netmag
function load () {
var map = document.getElementById("map");
if (GBrowserIsCompatible() || !GBrowserIsCompatible()) {
var gmap = new GMap2(map);
gmap.addControl( new GSmallMapControl() );
gmap.addControl( new GMapTypeControl()) ;
gmap.addControl( new GOverviewMapControl(new GSize(100,100)) );
gmap.setCenter( new GLatLng(54.7,-4), 5 );
GDownloadUrl("js/points.json", function(data, responseCode) {
parseJson(data);
});


function createMarker(input) {
//var marker = new GMarker(input.point);
var marker = new GMarker(input.point, makeIcon(input.markerImage) );

var tabs_array = [ new GInfoWindowTab("Tab1", "Tab 1 Information"),
new GInfoWindowTab("Tab2", "Tab 2 Information") ];
//
GEvent.addListener(marker, "click", function() {
//marker.openInfoWindowHtml( input.homeTeam + " vs. " + input.awayTeam );
marker.openInfoWindowHtml( formatWindow(input) );
});
return marker;
}

function parseJson (doc) {
var jsonData = eval("(" + doc + ")");
for (var i = 0; i < jsonData.markers.length; i++) {
var marker = createMarker(jsonData.markers[i]);
gmap.addOverlay(marker);
}
}



function formatWindow (input) {
var html = "<div class=\"bubble\">";
html += "<h1>" + input.homeTeam + " vs. " + input.awayTeam + "</h1>";
html += "<p>" + input.information + "</p>";
html += "<p>";
if(input.fixture != null) {
html += "<strong>Kick-off:</strong> " + input.fixture + "<br />";
}
/* Some more formatting */
html += "</p></div>";
return html;
}

function makeIcon (image) {
var icon = new GIcon();
icon.image = image;
icon.shadow = "images/shadow50.png";
icon.iconSize = new GSize(16, 16);
icon.shadowSize = new GSize(24, 16);
icon.iconAnchor = new GPoint(8, 16);
icon.infoShadowAnchor = new GPoint(0, 0);
icon.infoWindowAnchor = new GPoint(8, 1);
return icon;
}






} else {
alert("Sorry, your browser cannot handle the true power of Google Maps");
}
}

window.onload = load;
window.onunload = GUnload;


    //]]>