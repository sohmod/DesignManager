<?php
/*
 * Created on 26-Apr-2007 by Kaitlin Duck Sherwood
 */

// TODO consider making the info sections into pretty 
// metadata URL, as per http://earth.google.fr/kml/kml_tags_21.html#metadata

// The following snippet might be useful someday; it 
// outputs an outline instead of a polygon.
// echo "    <LineStyle>\r\n";
// echo "      <color>7f000000</color>\r\n";
// echo "      <width>2</width>\r\n";
// echo "    </LineStyle>\r\n";

class KmlWriter
{

  function KmlWriter($trueIfProvinces, $aRequest, $color_mapper, $countries_seen_list)
  {
    $this->is_provinces = $trueIfProvinces;
    $this->request = $aRequest;
    $this->color_mapper = $color_mapper;
    $this->countries_seen_list = $countries_seen_list;
  }
  

  // method write_style_information ===============
  // in: hash, with territory ID as key and attribute as value
  // out: nothing
  // SIDE EFFECT: writes style information for all territories
  //              in the keys of $values
  function write_style_information($values)
  {

    foreach ($values as $country_province => $value)
    {
      echo "  <Style id=\"$country_province\">\r\n";
      
      echo "    <PolyStyle>\r\n";
      echo "      <color>";
      echo $this->color_mapper->value_to_color($value);
      echo "</color>\r\n";
      log3("<foo>top: $numerators[$country_province] bot: $denominators[$country_province]");
      log3("val: $values[$country_province]</foo>\n");
      echo "   </PolyStyle>\r\n";
      echo "  </Style>\r\n";
    }
  }

  // method write_about_the_user_data ===============
  // TODO: Some of this should go into ColouredKmlModel.
  // TODO: Think about whether there is a better way to pass
  //       around minRatio and maxRatio.
  // in: minimum and maximum ratios (i.e. min and max values mapped)
  // out: nothing
  // SIDE EFFECT: writes human-readable metadata about the
  //              data that is plotted.  
  function write_about_the_user_data($minRatio, $maxRatio)
  {
    echo "  <Placemark>\n";
    echo "  <name>About this data</name>\n";
    echo "    <visibility>1</visibility>\n";
    echo "    <description><![CDATA[This map represents {$this->request->title}";

    $denominator = $this->request->denominator; // convenience
    if($denominator != 1)
    {
      if("P" == $denominator)
      {
        echo ", divided by the total population";
      }
      if("A" == $denominator)
      {
        echo ", divided by the area in square kilometers";
      }
    }
    echo ".<p />\n";
    echo "The data has a range from $minRatio to $maxRatio.\n";
    if( ($minRatio == $this->color_mapper->get_min()) && ($maxRatio == $this->color_mapper->get_max()) )
    {
    echo "    On this map, full white corresponds to the minimum value; \n" .
         "    full red corresponds to the maximum value.<p />\n";
    } else
    {
    echo "    On this map, full white corresponds to a value of {$this->request->min_cutoff}; ".
         "    full red corresponds to a value of {$this->request->max_cutoff}.\n<p />";
    }
      
  echo "The <a href=\"".$this->request->url."\">raw data</a> came from {$this->request->year} data from {$this->request->source}.\n";
  }
  
  
  // method write_about_denominator_data ===============
  // in: nothing
  // out: nothing
  // SIDE EFFECT: writes human-readable metadata about the
  //              normalizing data.  
  function write_about_denominator_data()
  {

   
  if("A" == $request->denominator)
  {
    if($this->is_provinces)
        {
      write_about_province_area_data();
        } else
        {
      write_about_country_area_data();
        }
  }
  if("P" == $request->denominator)
  {

        if($this->is_provinces)
        {
      write_about_province_population_data();
        } else
        {
      write_about_country_population_data();
        }
  }

    echo "   ]]></description>\n";
    echo "<styleUrl>#pinStyle</styleUrl>\n";
    echo "<Point>\n";
    echo "  <coordinates>-133.000,25.000</coordinates>\n";
    echo "</Point>\n";
    echo "</Placemark>\n\n";
  }
  
  // private
  // method write_about_country_area_data ===============
  // TODO: This should go into ColouredKmlModel. 
  // in: nothing
  // out: nothing
  // SIDE EFFECT: writes human-readable metadata about the
  //              country area data.  
  function write_about_country_area_data()
  {
  echo "The area data came from the \n".
  "<a href=\"https://www.cia.gov/cia/publications/factbook/rankorder/2147rank.html\">CIA ".
   "World Factbook 2005</a>, \n";
  }
  
  // private 
  // method write_about_province_area_data ===============
  // TODO: This should go into ColouredKmlModel. 
  // in: nothing
  // out: nothing
  // SIDE EFFECT: writes human-readable metadata about the
  //              province area data.  
  function write_about_province_area_data()
  {
  echo "The area data came from total area information (land plus water) from:<ul>\n";
  if(in_array("us", $this->countries_seen_list))
  {
    echo "<li><a href=\"http://en.wikipedia.org/wiki/List_of_U.S._states_by_area\">U.S. ".
         "Census Bureau 2000 information</a> \n".
         "(with 2005 updates for Michigan and 2001 updates for Wyoming).</li>\n";
  }
  
    if(in_array("ca", $this->countries_seen_list))
  {
    echo "<li><a href=\"http://www40.statcan.ca/l01/cst01/phys01.htm\">Stats " .
         "Canada information</a> from 2005.</li>\n";
  }
  
  if(in_array("fr", $this->countries_seen_list))
  {
    echo "<li><a href=\"http://www.insee.fr/fr/ffc/chifcle_fiche.asp?ref_id=NATTEF01209&tab_id=204\">Insee " .
         "data from 1999.</li>\n";
  }
  }
  
  // private 
  // method write_about_country_population_data ===============
  // TODO: This should go into ColouredKmlModel. 
  // in: nothing
  // out: nothing
  // SIDE EFFECT: writes human-readable metadata about the
  //              country population data. 
  function write_about_country_population_data()
  {
  echo "The population data came from the \n".
  "<a href=\"https://www.cia.gov/cia/publications/factbook/rankorder/2119rank.html\">CIA ".
  "World Factbook 2005</a>, \n";
  }
  
  // private 
  // method write_about_province_population_data ===============
  // TODO: This should go into ColouredKmlModel. 
  // in: nothing
  // out: nothing
  // SIDE EFFECT: writes human-readable metadata about the
  //              province population data. 
  function write_about_province_population_data()
  {
    echo "The total population data came from <ul>";
    if(in_array("us", $this->countries_seen_list))
    {
      echo "<li><a href=\"http://en.wikipedia.org/wiki/U.S._state\">U.S. ".
       "Census Bureau 2006 information</a></li> \n";
    }
    if(in_array("ca", $this->countries_seen_list))
    {
    echo "<li><a href=\"http://www.statcan.ca/Daily/English/070329/d070329b.htm\">Stats ".
         "Canada information</a> from 2006.</li>\n";
    }
    if(in_array("fr", $this->countries_seen_list))
    {
    echo "<li><a href=\"http://www.insee.fr/fr/ffc/chifcle_fiche.asp?ref_id=NATTEF01209&tab_id=204\">Insee ".
         "data</a> from 2005.</li>\n";
    }
    echo "</ul>";
  }
  
  // private 
  // method write_about_province_geometry ===============
  // TODO: This should go into ColouredKmlModel. 
  // in: nothing
  // out: nothing
  // SIDE EFFECT: writes human-readable metadata about the
  //              province geometry data. 
  function write_about_province_geometry()
  {
    if(in_array("us", $this->countries_seen_list))
    {
    echo "    The U.S. state boundary information came from a KML file of \n".
         "    <a href=\"http://maps.google.com/maps/ms?ie=UTF8&hl=en&t=k&om=1&msid=103763259662194171141.000001119b4ce1e8e0f76&msa=0\">U.S.\n". 
         "    States 2004 electoral votes</a> generated by Kevin Khaw.<p>\n";
    }
    
    if(in_array("ca", $this->countries_seen_list))
    {
    echo "    The Canadian province boundaries were hand-drawn by Kaitlin Duck Sherwood.<p>\n";
    }
    
    if(in_array("fr", $this->countries_seen_list))
    {
    echo "    The French department boundaries came from many places: contours from GeoFla (http://www.ign.fr), ";
    echo "    Conversion from Lambert II+ and WGS84 by Convers (http://vtopo.free.fr), \n";
    echo "    Reduction of points for the lowres version done by Kaitlin Duck Sherwood, using an adaptation of the Douglas-Peucker algorithms \n";
      echo "    program that John Coryat adapted from a program written by Stephen Lime. \n";
      echo "    If you redistribute or adapt this KML file, you must preserve the attributions above.\n";
    }
    echo "</ul>";
  
  }
  
  // private 
  // method write_about_country_geometry ===============
  // TODO: This should go into ColouredKmlModel. 
  // in: nothing
  // out: nothing
  // SIDE EFFECT: writes human-readable metadata about the
  //              country geometry data. 
  function write_about_country_geometry()
  {
  echo "    The country boundaries came from KML generated by ".
         "    <a href=\"http://www.mi-perm.ru/gis/programs/kmler\">KMLer</a>".
         "    by Valery Hronusov and Michael Barsky.";
  }
  

 
  // public 
  // method write_about_the_service ===============
  // TODO: Maybe this should go into ColouredKmlModel?
  // in: nothing
  // out: nothing
  // SIDE EFFECT: writes human-readable metadata about the
  //              Mapeteria service. 
  function write_about_the_service()
  {
    echo "<Placemark>\n";
    echo "  <name>How this map was made</name>\n";
    echo "  <visibility>1</visibility>\n";
    echo "  <description><![CDATA[\n";
    echo "    This map was made with the \n";
    echo "    <a href=\"http://maps.webfoot.com/\">Mapeteria</a>\n";
    echo "    map colouring service.  Mapeteria was developed by\n";
    echo "    <a href=\"http://webfoot.com/ducky.home.html\">Kaitlin Duck Sherwood</a>.<p>\n\n";

    if($this->is_provinces)
  {
    $this->write_about_province_geometry();
  } else
  {
    $this->write_about_country_geometry();
  }

    echo "      ]]></description>\n";
    echo "  <styleUrl>#pinStyle</styleUrl>\n";
    echo "  <Point>\n";
    echo "    <coordinates>-133.000,35.000</coordinates>\n";
    echo "  </Point>\n";
    echo "</Placemark>\n\n";
  }
  

  
  
  // public 
  // method write_geometry ===============
  // in: nothing
  // out: nothing
  // SIDE EFFECT: writes out the polygons for all the countries or provinces
  function write_geometry()
  {
    
    if ($this->is_provinces)
    {
      foreach ($this->countries_seen_list as $country)
      {
        // TODO Maybe the name of the file should go into ColouredKmlModel
        include "kmlStubs/{$country}.{$this->request->resolution}.kmlStub";
      }
    } else
    {
      // TODO Maybe the name of the file should go into ColouredKmlModel
      include "kmlStubs/Countries.{$this->request->resolution}.kmlStub";
    }
    

  }
  
  // ============================ 
  // method write_kml_header
  // Prints the magic HTTP headers to make the browser understand that
  // it is getting a KML file and not HTML (or something else).
  // Note that this has to get called AFTER all error handling, alas.
  // in: $debug -- a global set in PerHostData.php
  // out: nothing
  // SIDE EFFECT: writes HTTP headers to stdout
  function write_kml_header($debug)
  {
    if($this->is_provinces){
      $fileName = "colouredProvinces.kml";
    } else 
    {
      $fileName = "colouredCountries.kml";
    }
  
    if($debug)
    {
      header("Content-Type: text/plain; charset=utf8");  // for debugging
    }
    else
    {
      header("Content-Type: application/vnd.google-earth.kml+xml; charset=utf8");
      header("Content-Disposition: attachment; filename=\"$fileName\"");
    }
    echo '<?xml version="1.0" encoding="UTF-8" ?>';
    echo "\n";
    echo '<kml xmlns="http://earth.google.com/kml/2.0">';
    echo "\n<Document>\n";
  }


  // public 
  // function write_kml_header ==============================
  // in: nothing
  // out: nothing
  // SIDE EFFECT: writes the last little bit of the KML file to stdout
  function write_kml_closer()
  {
    echo "</Document>\n";
    echo "</kml>\n";
  }
  
}


function test_kml_writer()
{
  include 'PerHostData.php';
  include 'duckUtils.php';
  include 'MapRequest.php';
  include "LinearColourMapping.php";
  $request = new MapRequest();
  $request->resolution = "hires";
  print_plain_text_header();
  $foo = (new KmlWriter(true, $request, new LinearColorMapping(0, 320, 10, 80), array("us")));
  $foo->write_geometry(array("fr", "us"));
}

// test_kml_writer();

?>
