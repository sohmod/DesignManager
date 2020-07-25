// Subclassed filled VML/SVG GPolygon if you want it unfilled - use BDCCPolyline
//
// Free for any use
//
// Bill Chadwick May 2007
//
// Adds 
//  click, mouseover and mouseout events
//  tooltip
//  dot or dash styling for stroke
//  dynamic setting of stroke colour, opacity, weight and dash style and fill color and opacity

var BDCCPolygonId;//counter for unique DOM Ids

// Constructor params exactly as GPolygon then a tooltip and dash which must be one of "dot" or "dash" or "solid"

function BDCCPolygon(points, strokeColor, strokeWeight, strokeOpacity, fillColor, fillOpacity, tooltip, dash) {	
    
    this.tooltip = tooltip;
    this.dash = (dash != null) ? dash : "solid";
    this.strokeColor = strokeColor;
    this.strokeWeight = strokeWeight;
    this.strokeOpacity = strokeOpacity;
    this.fillColor = fillColor;
    this.fillOpacity = fillOpacity;
    
    //make a unique DOM id for this polyline
    if(BDCCPolygonId == null)
        BDCCPolygonId = 0;
    else
        BDCCPolygonId += 1;
    this.domid = "BDCCPolygonId" + BDCCPolygonId.toString();
    
    this.usesVml = (navigator.userAgent.indexOf("MSIE") != -1);
    
    GPolygon.call(this,points,strokeColor,strokeWeight,strokeOpacity,fillColor,fillOpacity,{"clickable":false});//call super class constructor 
}
BDCCPolygon.prototype = new GPolygon(new Array(new GLatLng(0,0)));//subclass from GPolygon

// According to the GMap docs, GPolygon implements the GOverlay interface
// That is it implements the functions initialize, remove, copy and redraw
// Here we add to GPolygon's own implementation of these functions
//

BDCCPolygon.prototype.initialize = function(map) {
    GPolygon.prototype.initialize.call(this,map); //super class
    //Initialise cant be used to cache the SVG path node or its parent svg node as both are recreated in redraw
    //For VML the shape node is recreated in redraw and all shapes have a common parent      
    this.map = map;  
}

BDCCPolygon.prototype.remove = function() {
    GPolygon.prototype.remove.call(this); //super class
}

BDCCPolygon.prototype.copy = function(map) {
    return new BDCCPolygon(this.points,this.strokeColor,this.strokeWeight,this.strokeOpacity,this.fillColor,this.fillOpacity,this.tooltip,this.dash);
}

BDCCPolygon.prototype.redraw = function(force) {
   
   GPolygon.prototype.redraw.call(this,force); //super class
   var dom = null;
   var i = 1;
   var prnt;
   if(this.usesVml){
        try{        
            var shps = document.getElementsByTagName("shape"); 
	  	    i = shps.length-1;
	  	    
	        //You could omit parent node checking if you only have one map per document
	  	    //Doing so will give a performance improvement	  	    
	  	    this.map.getPane(G_MAP_MAP_PANE).parentNode.id = "Cntnr" + this.domid;
        	while((dom == null) && (i >= 0)){
		
                dom = shps[i];//assume ours is the most recently added by the superclass redraw
                prnt = dom.parentNode;
			    while(prnt != null){
                    if (prnt.id == "Cntnr" + this.domid)
                        break;
                    else
                        prnt = prnt.parentNode; 
                }
                if(prnt == null){
                    i -= 1;
				    dom = null;
			    }
                else
                    break;
        	}
            if(dom != null){
            
                //we found our vml node
                if(this.tooltip != null){
                    dom.style.cursor = "help";//to show mouseover 
                    dom.title = this.tooltip;
                }
                dom.id = this.domid;//assign unique DOM id so we can modify attributes later   
            }
        }
        catch (ex)
        {
		    if(BDCCPolygonId == 0)
			    alert("The designer of this Google Maps web page has attempted to use VML graphics without including the necessary header material.");
        }
   }
   else{
        var shps = document.getElementsByTagName("path"); 
	    i = shps.length-1;

	    //You could omit parent node checking if you only have one map per document
	  	//Doing so will give a performance improvement	  	    
        this.map.getPane(G_MAP_MAP_PANE).parentNode.setAttribute("id","Cntnr" + this.domid);
        while((dom == null) && (i >= 0)){
		
            dom = shps[i];//assume ours is the most recently added by the superclass redraw
            prnt = dom.parentNode;
		    while(prnt != null){
                if (prnt.id == "Cntnr" + this.domid)
                    break;
                else
                    prnt = prnt.parentNode; 
            }
            if(prnt == null){
                i -= 1;
		        dom = null;
		    }
            else
                break;
        }

        if(dom != null){        
            //we found our svg node
            if(this.tooltip != null){
                dom.style.cursor = "help";//to show mouseover 
                dom.setAttribute("title",this.tooltip);
            }
            dom.setAttribute("id",this.domid);//assign unique DOM id so we can modify attributes later
        }
   }

   if(this.dredraw)
       window.clearTimeout(this.dredraw); 

   if(dom != null){

       //set up the appearance of our polygon
       this.setStrokeColor(this.strokeColor);
       this.setStrokeDash(this.dash);
       this.setStrokeOpacity(this.strokeOpacity);
       this.setStrokeWeight(this.strokeWeight);
       this.setFillColor(this.fillColor);
       this.setFillOpacity(this.fillOpacity);
       
       //set up event handlers
       var cclick = GEvent.callback(this,this.onClick);
       var cover = GEvent.callback(this,this.onOver);
       var cout = GEvent.callback(this,this.onOut);

       GEvent.clearInstanceListeners(dom);//safety 
       GEvent.addDomListener(dom,"click",function(event){cclick();});
       GEvent.addDomListener(dom,"mouseover",function(){cover();});
       GEvent.addDomListener(dom,"mouseout",function(){cout();});
   
   }
   else {
        //we could not paint because GMaps has not done its drawing yet, try a bit later
        var credraw = GEvent.callback(this,this.redraw);
        this.dredraw = window.setTimeout(function(force){credraw(true);},200); //the true here is vital
   }
   
   
}

//event handlers
BDCCPolygon.prototype.onClick = function(){
    GEvent.trigger(this,"click");
}
BDCCPolygon.prototype.onOver = function(){
    GEvent.trigger(this,"mouseover");
}
BDCCPolygon.prototype.onOut = function(){
    GEvent.trigger(this,"mouseout");
}

//once the shape has been drawn, we can modify it with these setX functions;

BDCCPolygon.prototype.setStrokeColor = function(color) {
    this.strokeColor = color;
    var dom = document.getElementById(this.domid); 
    if(!dom)
        return;
    if(this.usesVml){
        dom.stroke.color = this.strokeColor;
    }
    else{
        dom.setAttribute("stroke",this.strokeColor);
    }
}
BDCCPolygon.prototype.getStrokeColor = function() {
    return this.strokeColor;
}
BDCCPolygon.prototype.setStrokeDash = function(dash) {
    this.dash = dash;
    var dom = document.getElementById(this.domid); 
    if(!dom)
        return;
    if(this.usesVml){
        if(this.dash == "dash")
            dom.stroke.dashstyle = "dash";       
        else if (this.dash == "dot")
            dom.stroke.dashstyle = "dot";    
        else 
            dom.stroke.dashstyle = "";    
    }
    else{
        if(this.dash == "dash")
            dom.setAttribute("stroke-dasharray","10,10");
        else if (this.dash == "dot")
            dom.setAttribute("stroke-dasharray","3,17");
        else
            dom.setAttribute("stroke-dasharray","none");
    }
}
BDCCPolygon.prototype.getStrokeDash = function() {
    return this.dash;
}
BDCCPolygon.prototype.setStrokeWeight = function(weight) {
    this.strokeWeight = weight;
    var dom = document.getElementById(this.domid); 
    if(!dom)
        return;
    if(this.usesVml){
        dom.stroke.weight = this.strokeWeight.toString()+"px";   
    }
    else{
        dom.setAttribute("stroke-width",this.strokeWeight.toString()+"px");
    }
}
BDCCPolygon.prototype.getStrokeWeight = function() {
    return this.strokeWeight;
}
BDCCPolygon.prototype.setStrokeOpacity = function(opacity) {
    this.strokeOpacity = opacity;
    var dom = document.getElementById(this.domid); 
    if(!dom)
        return;
    if(this.usesVml){
        dom.stroke.opacity = this.strokeOpacity;
    }
    else{
        dom.setAttribute("stroke-opacity",this.strokeOpacity);
    }
}
BDCCPolygon.prototype.getStrokeOpacity = function() {
    return this.strokeOpacity;
}
BDCCPolygon.prototype.setFillColor = function(color) {
    this.fillColor = color;
    var dom = document.getElementById(this.domid); 
    if(!dom)
        return;
    if(this.usesVml){
        dom.fill.color = this.fillColor;
    }
    else{
        dom.setAttribute("fill",this.fillColor);
    }
}
BDCCPolygon.prototype.getFillColor = function() {
    return this.fillColor;
}
BDCCPolygon.prototype.setFillOpacity = function(opacity) {
    this.fillOpacity = opacity;
    var dom = document.getElementById(this.domid); 
    if(!dom)
        return;
    if(this.usesVml){
        dom.fill.opacity = this.fillOpacity;
    }
    else{
        dom.setAttribute("fill-opacity",this.fillOpacity);
    }
}
BDCCPolygon.prototype.getFillOpacity = function() {
    return this.fillOpacity;
}

