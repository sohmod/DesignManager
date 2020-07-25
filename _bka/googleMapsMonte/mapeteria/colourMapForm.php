<?php
/*
 * Created on 9-Apr-2007 by Kaitlin Duck Sherwood
 * This generates a form for collecting information about what
 * the user wants their map to look like.
 */
 
?>

<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
  <link rel="stylesheet" href="http://webfoot.com/blog.css"></link>
  <script language="JavaScript">
    function csvExplanation() 
    {
      var csvExplanation=window.open('explanatoryTexts/csvExplanation.php','format of data file','left=20,top=20,width=600,height=600,toolbar=1,resizable=1,scrollbars=1');
    }
    function yearJustification() 
    {
      var yearJustification=window.open('explanatoryTexts/yearJustification.php','why give the year?','left=20,top=20,width=500,height=500,toolbar=1,resizable=1,scrollbars=1');
    }
    function colourMappingExplanation() 
    {
      var colourMappingExplanation=window.open('explanatoryTexts/colourMappingExplanation.php','why give the cutoffs?','left=20,top=20,width=600,height=600,toolbar=1,resizable=1,scrollbars=1');
    }
    function resolutionExplanation() 
    {
      var resolutionExplanation=window.open('explanatoryTexts/resolutionExplanation.php','why give the cutoffs?','left=20,top=20,width=600,height=600,toolbar=1,resizable=1,scrollbars=1');
    }
    //-->
  </script>
  
  <title>Webfoot's Mapeteria: Map Colouring</title>
</head>
<body bgcolour="#ffffff" />
<?php
  include "PerHostData.php";

  // TODO make static methods in PerHostData for interesting
  //      values...
  $per_host_data = PerHostData::get_instance();
  $sidebar = $per_host_data->sidebar;
  include $sidebar;
  $url_base = $per_host_data->url_base;
  
?>


<div class="content">
  <h1>Webfoot's Mapeteria</h1>
  <hr>
  Want to make a choropleth thematic map 
  (i.e. coloured based on your data) for Canadian provinces, U.S. states, or French 
  d&eacute;partements?  
  This is the right place.  
<?php
  $url = htmlentities("$url_base/numerators/provinceMedianIncome2005.csv");
  echo "(Here's <a href=\"./overlayKmlOnMap.php?url=$url&denominator=1&min=33000&max=60000&title=US+and+Canadian+Median+Income+in+US+dollars&source=Census+Bureau+and+Stats+Canada&year=2005&resolution=lowres\">an example</a>.)";
?> 
  <p>
  Give me a comma-separated-values (CSV) version of your spreadsheet, 
  where the first column is the country code, the second is the province/
  state/d&eacute;partements, and the third column is the data value, 
  then give me a few pieces of information on how it should be displayed, 
  and I will give you a map!  
  

  <p />

  <h2>CSV file</h2>
  <form action="makeColouredKml.php" method="GET">
    The first thing I need is your actual data -- a file that says
    what territory has what value.  
    <a href="javascript:csvExplanation()">Get more detailed instructions on what the format needs to be.</a>
    
    <p>

    <span class="attn">What is the URL of your CSV file?</span> <input type="text" size="80" name="url"><br/>
    <p />
    
    <h2>Divisors</h2>
    If you have aggregate data for a state (like number of basketball teams in a state), 
    but would really rather see colours based on per capita basis or on a per area basis (like
    number of basketball teams per capita or number of basketball teams per square kilometer), 
    you can do that here!
    <p>
    <span class="attn">What do you want your data divided by?</span><br>
    <ul>
       <input type="radio" name="denominator" value="1" CHECKED>1 (no division)<br>
       <input type="radio" name="denominator" value="P">total population (from the
       <a href="http://simple.wikipedia.org/wiki/List_of_U.S._states_by_population">U.S. 
       Census Bureau via Wikipedia</a>)<br>
       <input type="radio" name="denominator" value="A">square kilometers 
       (from the <a href="http://simple.wikipedia.org/wiki/List_of_U.S._states_by_area">U.S. 
       Census Bureau via Wikipedia</a>)<br>
       </ul>

    <h2>Colour mapping</h2>
    
    If you don't specify a min and max cutoff, Mapeteria will colour the 
    territory with the maximum data value bright red and the territory with
    the minimum data value completely white.  You can specify where "full red"
    and "full white" are.  
    <a href="javascript:colourMappingExplanation()">Get a more 
    detailed explanation.</a>
    <p>
    <span class="attn">What value do you want to correspond to the minimum colour value?</span>: <input type="text" name="min"><p/>
    <span class="attn">What value do you want to correspond to the maximum colour value?</span>: <input type="text" name="max"><p/>

    <h2>Descriptive text (optional)</h2>
    It is a good idea to embed some description of your data in the file, so that you can remember
    (and others can tell) what this map is of and where the data came from.
    <p>
    <span class="attn">What is the title of this map?</span>: <input type="text" name="title" size="80"><p/>
    <span class="attn">Where did your data come from?</span>: <textarea name="source" cols="80" rows="6"></textarea><p/>
    <p>

    <!-- yes, yes, I should allow other time periods -->

    <p>
    <span class="attn">What year is your data from?</span>: <input type="text" name="year" size="4"><br />
    <a href="javascript:yearJustification()">Why should you give the year?</a>
    <p>

    <h2>Hi-res or low-res?</h2>
    <input type="radio" name="resolution" value="hires">High resolution</input><br />
    <input type="radio" name="resolution" value="lowres">Low resolution</input><br />
    <input type="radio" name="resolution" value="default" checked>Beats me.  You decide.</input>
    <p />
    <a href="javascript:resolutionExplanation()">How do you choose the resolution?</a>

    <span class="attn"><h2>Known Issues</h2></span>
    <h3>Google Earth</h3>
    <span class="attn"><b>In some (most?) configurations, downloading the KML won't
    launch Google Earth.</b></span> If you have Google Earth installed and everything
    configured right, Google Earth should launch with this overlay.  Unfortunately, it
    seems rare for everything to be configured just exactly precisely correctly.
    You might have to save this file on your
    local hard drive, then open the file from Google Earth.
    <P>
    <span class="attn"><b>On Linux, the KML overlays (sometimes?) show up as pure white on 
    Google Earth.</b></span>  If you know why, I'd appreciate the help.
    <P>
    <h3>Google Maps</h3>
    <P>
    <span class="attn"><b>The display can be slow on Google Maps, especially 
    the first time.</b></span>  Google seems to do some caching of the maps, so if you
    look at the map twice in quick succession, if should be faster.
    <P>
    <span class="attn"><b>The French hires KML seems to overwhelm Google Maps.</b></span>  If you want
    hires, look at it on Google Earth.  If you want Google Maps, use
    lowres or default.
    <p>
    <span class="attn"><b>I don't have good error notification yet.</b></span>
    I have the code to do lots of error detection, but I haven't figured out yet
    how to get that information to you.  In particular, if Mapeteria can't find
    your CSV file, all you see is that the map shows up but not the data.
    <p>
    
    <p><input type="submit" name="submit" value="Give me a  KML file!">
    <input type="submit" name="submit" value="Show it on Google Maps!">
    </p>

    <p>
    <hr>
    See the <a href="faq.php">FAQ</a> and <a href="credits.php">credits</a>.<p>
    <hr>
    <h2>Examples</h2>
    <p>
    You can try this:<p>
<?php
    echo "URL: <tt>$url_base/numerators/provinceMedianAge2000-2001.csv</tt><br>\n";
?>
    Denominator: <tt>1</tt><br>
    Min colour value: <tt>22</tt><br>
    Max colour value: <tt>40</tt><br>
    Title: <tt>US and Canadian Median age</tt><br>
    Source: <tt><a href="http://www.census.gov/prod/2001pubs/c2kbr01-12.pdf">U.S. Census Bureau</a> and <a href="http://www.statcan.ca/Daily/English/061026/d061026b.htm">Stats Canada</a></tt><br>
<?php
    $url = htmlentities("$url_base/numerators/provinceMedianAge2000-2001.csv");
    echo "Show <a href=\"./makeColouredKml.php?url=$url&denominator=1&min=22&max=40&title=US+and+Canadian+median+age&source=Census+Bureau+and+Stats+Canada&year=2001&resolution=hires\">KML</a> or\n";
    echo "<a href=\"./overlayKmlOnMap.php?url=$url&denominator=1&min=22&max=40&title=US+and+Canadian+median+age&source=Census+Bureau+and+Stats+Canada&year=2001&resolution=lowres\">Google Maps</a>";
?>    <p>
    
    Or this:<p>
<?php
    echo "URL: <tt>$url_base/numerators/provinceMedianIncome2005.csv</tt><br>\n";
?>
    Divisor: <tt>1</tt><br>
    Min colour value: <tt>33000</tt><br>
    Max colour value: <tt>60000</tt><br>
    Title: <tt>US and Canadian Median income in US dollars</tt><br>
    Source: <tt><a href="http://www.census.gov/hhes/www/income/histinc/h08a.html">U.S. 
    Census Bureau</A> and <a href="http://www.statcan.ca/Daily/English/060330/d060330a.htm">Stats 
    Canada</a></tt><br>
    Year: <tt>2006</tt><br>
 <?php
    $url = htmlentities("$url_base/numerators/provinceMedianIncome2005.csv");
    echo "Show <a href=\"./makeColouredKml.php?url=$url&denominator=1&min=33000&max=60000&title=US+and+Canadian+Median+Income+in+US+dollars&source=Census+Bureau+and+Stats+Canada&year=2005&resolution=hires\">KML</a> or\n";
    echo "<a href=\"./overlayKmlOnMap.php?url=$url&denominator=1&min=33000&max=60000&title=US+and+Canadian+Median+Income+in+US+dollars&source=Census+Bureau+and+Stats+Canada&year=2005&resolution=lowres\">Google Maps</a>";
?>   
    <p>
    
    Or this:<p>
<?php
    echo "URL: <tt>$url_base/numerators/usStateRepresentation.csv</tt><br>\n";
?>
    Divisor: <tt>P</tt><br>
    Min colour value: <tt>0</tt><br>
    Max colour value: <tt>.0000003</tt><br>
    Title: <tt>US State legislators per capita</tt><br>
    Source: <tt>National Conference of State Legislators, http://www.ncsl.org/programs/legismgt/elect/cnstprst.htm</tt><br>
    Year: <tt>2007</tt><br>
 <?php
    $url = htmlentities("$url_base/numerators/usStateRepresentation.csv");
    echo "Show <a href=\"./makeColouredKml.php?url=$url&denominator=P&title=US+State+legislators+per+capita&source=National+Conference+of+State+Legislators&year=2007&resolution=hires\">KML</a> or\n";
    echo "<a href=\"./overlayKmlOnMap.php?url=$url&denominator=P&title=US+State+legislators+per+capita&source=National+Conference+of+State+Legislators&year=2007&resolution=lowres\">Google Maps</a>";
?>   
    <p>
    
        Or this:<p>
<?php
    echo "URL: <tt>$url_base/numerators/usStateResidentialElectricityPrices2006.csv</tt><br>\n";
?>
    Divisor: <tt>1</tt><br>
    Min colour value: <tt>6</tt><br>
    Max colour value: <tt>23</tt><br>
    Title: <tt>US average residential energy prices in cents per kilowatt-hour</tt><br>
    Source: <tt>Energy Information Administration, as reported by The Public Policy Institute of New York State, http://www.ppinys.org/reports/jtf/electricprices.html</tt><br>
    Year: <tt>2006</tt><br>
 <?php
    $url = htmlentities("$url_base/numerators/usStateResidentialElectricityPrices2006.csv");
    echo "Show <a href=\"./makeColouredKml.php?url=$url&denominator=1&min=6&max=23&title=US+average+residential+energy+prices+in+cents+per+kilowatt+hour&source=Energy+Information+Administration&year=2006&resolution=hires\">KML</a> or\n";
    echo "<a href=\"./overlayKmlOnMap.php?url=$url&denominator=1&min=6&max=23&title=US+average+residential+energy+prices+in+cents+per+kilowatt+hour&source=Energy+Information+Administration&year=2006&resolution=lowres\">Google Maps</a>";
?>   
    <p>
    
    <!-- Yes, the density really does go from 0 to 380 per square km. -->
    Or this:<p>
<?php
    echo "URL: <tt>$url_base/denominators/usStatePopulations2006.csv</tt><br>\n";
?>
    Divisor: <tt>Area</tt><br>
    Min colour value: <tt>0</tt><br>
    Max colour value: <tt>350</tt><br>
    Title: <tt>Population density</tt><br>
    Source: <tt>U.S. Census Bureau via Wikipedia</tt><br>
    Year: <tt>2006</tt><br>
<?php
    $url = htmlentities("$url_base/denominators/usStatePopulations2006.csv");
    echo "Show <a href=\"./makeColouredKml.php?url=$url&denominator=A&min=0&max=350&title=US+Population+Density&source=CensusBureau&year=2006&resolution=hires\">KML</a> or\n";
    echo "<a href=\"./overlayKmlOnMap.php?url=$url&denominator=A&min=0&max=350&title=US+Population+Density&source=CensusBureau&year=2006&resolution=lowres\">Google Maps</a>";
?>
    <p>
     Or this:<p>
     
<?php
    echo "URL: <tt>$url_base/numerators/frMilkProduction1997.csv</tt><br>\n";
?>
    Divisor: <tt>1</tt><br>
    Min colour value: <tt>0</tt><br>
    Max colour value: <tt>1415510</tt><br>
    Title: <tt>French Milk production (kiloliters)</tt><br>
    Source: <tt>http://www.ac-nantes.fr:8080/peda/disc/histgeo/ouTICE/wingeo/departem.htm</tt><br>
    Year: <tt>1997</tt><br>
<?php
    $url = htmlentities("$url_base/numerators/frMilkProduction1997.csv");
    echo "Show <a href=\"./makeColouredKml.php?url=$url&denominator=1&min=0&max=1415510&title=French+Milk+Production+in+kiloliters&source=http%3A%2F%2Fwww.ac-nantes.fr%3A8080%2Fpeda%2Fdisc%2Fhistgeo%2FouTICE%2Fwingeo%2Fdepartem.htm&year=1997&resolution=hires\">KML</a> or\n";
    echo      "<a href=\"./overlayKmlOnMap.php?url=$url&denominator=1&min=0&max=1415510&title=French+Milk+Production+in+kiloliters&source=http%3A%2F%2Fwww.ac-nantes.fr%3A8080%2Fpeda%2Fdisc%2Fhistgeo%2FouTICE%2Fwingeo%2Fdepartem.htm&year=1997&resolution=lowres\">Google Maps</a>";
    echo " (Note: you'll need to recenter on France.)";
?>    
    
     <p>
     Or this:<p>
     
<?php
    echo "URL: <tt>$url_base/numerators/frGrapeProduction1997.csv</tt><br>\n";
?>
    Divisor: <tt>Population</tt><br>
    Min colour value: <tt>0</tt><br>
    Max colour value: <tt>2100</tt><br>
    Title: <tt>French Grape production per capita (kg/person)</tt><br>
    Source: <tt>http://www.ac-nantes.fr:8080/peda/disc/histgeo/ouTICE/wingeo/departem.htm</tt><br>
    Year: <tt>1997</tt><br>
<?php
    $url = htmlentities("$url_base/numerators/frGrapeProduction1997.csv");
    echo "Show <a href=\"./makeColouredKml.php?url=$url&denominator=P&min=0&max=2100&title=French+Grape+Production+in+kg+per+person&source=http%3A%2F%2Fwww.ac-nantes.fr%3A8080%2Fpeda%2Fdisc%2Fhistgeo%2FouTICE%2Fwingeo%2Fdepartem.htm&year=1997&resolution=hires\">KML</a> or\n";
    echo      "<a href=\"./overlayKmlOnMap.php?url=$url&denominator=P&min=0&max=2100&title=French+Grape+Production+in+kg+per+person&source=http%3A%2F%2Fwww.ac-nantes.fr%3A8080%2Fpeda%2Fdisc%2Fhistgeo%2FouTICE%2Fwingeo%2Fdepartem.htm&year=1997&resolution=lowres\">Google Maps</a>";
    echo " (Note: you'll need to recenter on France.)";
?>    
    
        
    
    
    
    
<?php
// TODO should have some country examples ready to go for when
//      countries are ready to come online...
?>
   
  </form>
  </div>  <!-- end content -->

</body>
</html>
