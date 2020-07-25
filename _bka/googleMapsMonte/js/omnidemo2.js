    //<![CDATA[


var baseIcon = new GIcon();
baseIcon.shadow = "../images/shadow50.png";
baseIcon.iconSize = new GSize(20, 34);
baseIcon.shadowSize = new GSize(37, 34);
baseIcon.iconAnchor = new GPoint(9, 34);
baseIcon.infoWindowAnchor = new GPoint(9, 2);
baseIcon.infoShadowAnchor = new GPoint(18, 25);

// global variables
      var map;
      var request;
      var gmarkers;
      var gmark;

function makeMap(labeler) {
    if (GBrowserIsCompatible()) {
      // resize the map
	gmarkers=labeler;
      var m = document.getElementById("map");
      // create the map
      map = new GMap(document.getElementById("map"));
      map.addControl(new GSmallMapControl());
      map.addControl(new GMapTypeControl());
      getXMLfile(labeler)
	} else {
      alert("your browser does not support Google Maps!");
    }	
}

function getXMLfile(labeler) {
   // Read the data from example.xml
   request = GXmlHttp.create();
	var letter = labeler.substring(0,1);
	var numdist = '02';  //var numdist = labeler.substring(1,4);
   gmarkers=labeler;
// Determine which house and file we are looking for here

	var demox = 'x'
	var senator = 's';
	var usrep = 'h';
	var housemem = 'd'
/*	if ( letter == senator )
	{
	   cure = "/xml/senated" + numdist +'.xml';
	}
	if ( letter == demox )
	{
	cure = "/xml/demo" + numdist +'.xml';
	}
*/
cure = "js/senated" + numdist +'.xml';
// End Determination
// Start XML processing

   request.open("GET", cure, true);
   request.onreadystatechange = processXMLfile;
   request.send(null);
   return false;
}

function clearAll() {
	map.clearOverlays();
}

function processXMLfile() {
  if (request.readyState == 4) {
    if (request.status == 200) {
       var xmlDoc = request.responseXML;
       if (xmlDoc.documentElement) {
          // ========= Now process the polylines ===========
          
          var markers = xmlDoc.documentElement.getElementsByTagName("marker"+gmarkers);
          for (var i = 0; i < markers.length; i++) {
            // Create point relevant data
            var lat = parseFloat(markers[i].getAttribute("lat"));
            var lng = parseFloat(markers[i].getAttribute("lng"));
            var point = new GPoint(lng,lat);

	    // Create line and map relevant data
	    var scale = 7;
	    var scale = markers[i].getAttribute("scale");
	    var koko = parseFloat(scale);
	    var color = markers[i].getAttribute("color");
	    map.centerAndZoom(point, koko);

	    // Added for createMarker function parsing
	    var letter = gmarkers.substring(0,1);
	    var numdist = '02';  //var numdist = gmarkers.substring(1,4);

	    // End for parsing
            var marker = createMarker(point,letter,numdist);

	    // Create Marker
            map.addOverlay(marker);
          }
          var lines = xmlDoc.documentElement.getElementsByTagName(gmarkers);
          // read each line
	var pol = 0
	var pts = [];
          if (lines && lines.length && (lines.length > 0)) {
            for (var a = 0; a < lines.length; a++) {
              // get any line attributes
              var width  = 2;
              // read each point on that line
              var points = lines[a].getElementsByTagName("pt");
              var pol = 0
	      var pts = [];
              for (var i = 0; i < points.length; i++) {

		if (pol > 300) 
			{
			map.addOverlay(new GPolyline(pts,color,width,.7));
			var lastpt = pts[300];
			pts = [];
			pts[0] = lastpt;
			pol=1;
			}
                pts[pol] = new GPoint(parseFloat(points[i].getAttribute("lng")), parseFloat(points[i].getAttribute("lat")));
		pol++;
              }
              map.addOverlay(new GPolyline(pts,color,width,.7));
            }
          }
          // ================================================    
	  // Commented out since this isn't need for this file

//	importXML('/xml/distinfo4.xml', 'names');

//      End removed section

       } else {
          alert("invalid xml file:"+filename);
       }
    } else {
     alert("file not found:"+filename);
    }
  }
}

// ----------------------------------
// createMarker (point, letter, number)
// 
// Creates the marker for the district, using the point coord and the letter and numdist
// to determine the right HTML and image


function createMarker(point, letter, number) {
  // Create a lettered icon for this point using our icon class from above
  var icon = new GIcon(baseIcon);
  var letter = letter;
  var numdist = number;

// 

  icon.image = "http://www.comaps.org/images/marker" + gmarkers + ".png";
  var marker = new GMarker(point, icon);

// transform XML schema to html schema, because I'm lazy and won't fix the xml

  var html = 'District ' + numdist +'<BR>';
  GEvent.addListener(marker, 'click', function() {
	marker.openInfoWindowHtml(html);
  });
  return marker;
}

// ======================================================================
// ======================================================================
// xmlload.js added to omniload.js
// Why?  Because IE is stupid - that's why

var xmlhttp
var common
var idname
var newid
var gmark


// importXML (filename,whereto)
// 
// This reads the global gmarkers from the gmap and to find the correct district
// The filename is one of the distinfo XML files, which contains every districts, so I dont' have to
// go through finding the correct district again
// It will also allow for the data to be shown and hidden as you click on the link

function importXML(filename,whereto)
{
    common = whereto;
    idname = gmarkers;
    var text = document.getElementById(common).innerHTML;
    var blanktext = '';
	if (text == blanktext)
	{		
	var temper = filename;
	request = GXmlHttp.create();
	request.open("GET", filename, true);
	request.onreadystatechange = createTable;
	request.send(null);
	}
	else 
	{
	document.getElementById(common).innerHTML = blanktext;
	}		
}

// createTable ()
// None of these XML loaded files can pass variables, at least in Firefox, so I can't use that.
// But it takes what is now called idname and by element each value.
// The element and its value are placed into a table this time, instead of raw text.
// There is then some modification of the raw data to remove underscores, and translate
// less than and greater than signs into < and > brackets for the HTML.

function createTable()
{
if (request.readyState==4)
  {   // if "OK"
  if (request.status==200)
  {
	var x = request.responseXML.getElementsByTagName(idname);
	var newEl = document.createElement('TABLE');
	newEl.setAttribute('cellPadding',5);
	var tmp = document.createElement('TBODY');
	newEl.appendChild(tmp);
	var repl = /_/gi;
	var row = document.createElement('TR');
	for (j=0;j<x[0].childNodes.length;j++)
	{
		if (x[0].childNodes[j].nodeType != 1) continue;
		var container = document.createElement('TH');
		container.setAttribute('align','left');
		var theData = document.createTextNode(x[0].childNodes[j].nodeName);
		var doom = theData.data;
		theData.data = doom.replace(repl," ");
		container.appendChild(theData);
		row.appendChild(container);
	}
	tmp.appendChild(row);
	var replgt = /&gt;/gi;
	var repllt =/&lt;/gi;
	var greater = '>';
	var lesser = '<';
	for (i=0;i<x.length;i++)
	{
		var row = document.createElement('TR');

		for (j=0;j<x[i].childNodes.length;j++)
		{
			if (x[i].childNodes[j].nodeType != 1) continue;
			var container = document.createElement('TD');
			container.setAttribute('align','left');
			var theData = document.createTextNode(x[i].childNodes[j].firstChild.nodeValue);
			container.appendChild(theData);
			container.innerHTML = theData.nodeValue;
			container.innerHTML = container.innerHTML.replace(repllt,lesser);
			container.innerHTML = container.innerHTML.replace(replgt,greater);
			row.appendChild(container);
		}
		tmp.appendChild(row);
	}
	document.getElementById(common).appendChild(newEl);
  }}
}

// FUNCTIONALITY for Webpage - this allows for the lists on the individual district pages to be hidden and reappear.

function switchit(list)
{
	var listElementStyle=document.getElementById(list).style;
	if (listElementStyle.display=="none")
	{
		listElementStyle.display="block";
	}
	else 
	{
		listElementStyle.display="none";
	}
}

    //]]>