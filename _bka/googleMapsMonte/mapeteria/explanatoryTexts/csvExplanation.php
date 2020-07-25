<?php
/*
 * Created on 22-Apr-2007 by Kaitlin Duck Sherwood
 * This page explains what the format of the CSV needs to be.  This
 * will need to reflect countries and departments at some point.w
 * 
 */
 ?>
 
 <html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
  <link rel="stylesheet" href="http://maps.webfoot.com/maps1.css"></link
  <title>Format of data file</title>
</head>
<div style="padding:30px">
<H1>Format of data file</H1>
    To use Mapeteria, you need to give data in the form of a CSV (comma-separated) file that specify the territory
    and the numeric value corresponding to that territory.
    <p>
    Each territory's information should be on one line, with fields as follows:
    <ul>
    <li>The first field should be the <a href="http://en.wikipedia.org/wiki/ISO_3166-1_alpha-2">ISO 3166-1 alpha-2 (i.e. two letter) country code</a>.
    Right now, that means "us" for the USA, "ca" for Canada, or 
    "fr" for France.  </li>
    <li>The second field, you need to use the ISO 3166-2 code for the state/province.
        Fortunately, that's not as intimidating as it sounds: in the US and Canada
        it is just the postal codes.  For French d&eacute;partements, use the two-digit
        number for the department.
      <ul>
        <li><a href="http://en.wikipedia.org/wiki/ISO_3166-2:US">US state codes</a></li>
        <li><a href="http://en.wikipedia.org/wiki/ISO_3166-2:CA">Canadian province/territory codes</a></li>
        <li><a href="http://en.wikipedia.org/wiki/ISO_3166-2:FR">France d&eacute;partement codes</a> 
       </ul>
    <li>The last field should be an integer or fixed-point number corresponding to some
    data value (for example, the median age of the state or province).</li>
    </ul>
    Note that you can have quote marks if you want, but you don't need them.  
    Countries and provinces are case-insensitive.
    <p>
    Note also that European number/separator format is recognized.
    
    <h2>Example</h2>
    It should look something like this:
    <pre>
	   us,ca,1734.8
	   us,or,324.2
	   us,wa,442.3
	   us,in,759.2
	   us,il,533.5
	   .
	   .
	   .
	   (etc)
    </pre>
    or
    <pre>
	   "us","ca",1734.8
	   "us","or",324.2
	   "us","wa",442.3
	   "us","in",759.2
	   "us","il",533.5
	   .
	   .
	   .
	   (etc)
    </pre>
        or
    <pre>
	   "fr";"01";1 734,8
	   "fr";"25";324,2
	   "fr";"54";442,3
	   "fr";"04";759,2
	   "fr";"08";533,5
	   .
	   .
	   .
	   (etc)
    </pre>
    </div>

  </body>
</html>
