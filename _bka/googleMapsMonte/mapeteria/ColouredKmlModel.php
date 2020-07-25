<?php
/*
 * Created on 9-Apr-2007 by Kaitlin Duck Sherwood
 * This takes a CSV file and produces a KML with countries or provinces
 * colored appropriately.
 */
 

// There are two classes with similar names: KmlWriter and ColouredKmlModel.
// ColouredKmlModel is sort of like the *model* with KmlWriter being
// more like the *view*.  ColouredKmlModel keeps track of all the data 
// and makes decisions about WHAT to show, while KmlWriter keeps track
// of HOW to show it.  In theory.
// TODO Make it so in practice.
// TODO Someday I'm going to want to only
//      print out the territories that have been seen.  (or print out
//      dummy style info for territories that have not been seen).
//      How does that affect the division of labour?
// TODO -- maybe the names of the stub files should be in here too?


// TODO I wonder if I can send back a multipart MIME type,
// so that I send back a KML file AND a HTML status message
// Or do I maybe just fork off the KML into a different javascript
// page or something like that?  (Sourceforge does it..)

// NOTE I removed Antarctica from the countries geometry.  
// It's big and people aren't going to ask for it often.



class ColouredKmlModel
{
  
  function ColouredKmlModel()
  {

    $this->request = new MapRequest();
    $this->per_host_data = PerHostData::get_instance();
    $this->url_base = $this->per_host_data->url_base;
    
    // TODO At some point, I should parse the KML to see if there
    // are errors and tell the user what errors there are.
    // Right here would be one fine place to do so.
    
    // Am I generating a KML only, or am I also
    // putting it on a map?  If I'm doing a map,
    // I need to pass off to the code that generates the
    // HTML frame for the map, which will then call this
    // program AGAIN to generate the KML file.  
    // This is a little kludgy, but it works.
    if(preg_match('/Google Maps/',$this->request->submit))
    {
      $this->redirect_to_overlay();
    }
    
    $this->validator = new CsvValidator($this->request->year, null);

    
  }

  // function redirect_to_overlay ======================
  // This redirects the browser to ask for the HTML/Javascript,
  // with this KML as the overlay element.  
  // in: nothing
  // out: nothing
  // SIDE EFFECTS: redirects to the JavaScript/HTML for the Google Maps version
  function redirect_to_overlay()
  {
    $qstring = preg_replace('/submit=[^\&]*$/','',$_SERVER["QUERY_STRING"]);
    $res = $this->request->resolution; // purely convenience
    $qstring = preg_replace('/resolution=[^\&]*/',"resolution=$res",$qstring);

    $uri = "$this->url_base/overlayKmlOnMap.php?".$qstring;
    header("Location: $uri");
    exit(0);
  }
 
  // function get_numerator_array ======================
  // Fetches the numerator the user asked for, and 
  // stuffs it (via $this->validator->parse) into a 
  // hash with the territory id as the key and the attribute 
  // as the value.
  // in: nothing
  // out: numerators in an array whose key is the territory id
  //      and the value is the attribute value for that territory.
  function get_numerator_array()
  {
    if (!$this->request->url)
    {
      print_html_error("uh-oh, the url wasn\'t specified.<p>\n");
    } 
    
    $entire_body = fetch_url($this->request->url);
    log2("entire numerator body of $this->request->url is:<p> $entire_body\n");

    $numerators = $this->validator->parse($entire_body);

    log3("is_provinces is".false_or_null($this->validator->is_provinces));
    log3("there are ".sizeof($numerators)." lines in the numerator file");
    
    return $numerators;

  }
  
  // function get_denominator_array ======================
  // This function figures out which denominator is appropriate
  // based on the denominator selector -- none, area, or population.
  // in: nothing
  // out: numerators in an array whose key is the territory id
  //      and the value is the appropriate divisor for that territory.
  function get_denominator_array()
  {

    if("1" == $this->request->denominator)
    {
      return null;
    }
    else
    {
      $denominator_url = $this->get_denominator_url($this->request->denominator, $this->validator->is_provinces);
      log3("denominatorUrl is $denominator_url");
    
      $body = fetch_url($denominator_url);
      log3("body is $body");
    
      $denominators = $this->validator->parse($body);
      log3("there are ".sizeof($denominators)." lines in the denominator file");
      return $denominators;

    }
    // we should not reach this line
    print_html_error("Uh-oh, we got to a line that we shouldn't have gotten to in the method get_denominator_array.");
  }
  
  
  // function write_kml_end ======================
  // Write the last pieces of a KML file
  // in: nothing
  // out: numerators in an array whose key is the territory id
  //      and the value is the appropriate divisor for that territory.
  function write_kml_end($kmlWriter, $values, $minRatio, $maxRatio)
  {

    $kmlWriter->write_style_information($values);
    $kmlWriter->write_about_the_user_data($minRatio, $maxRatio); 
    $kmlWriter->write_about_denominator_data();
    $kmlWriter->write_about_the_service();
    $kmlWriter->write_geometry();
    $kmlWriter->write_kml_closer();
  }
 

  // function write_kml_end ======================
  // Write out all kinds of useful information for debugging into the KML
  // in: nothing
  // out: nothing
  // SIDE EFFECTS: debug information printed to stdout
  function write_debug_info($numerators, $denominators, $values, $min_ratio, $max_ratio, $request)
  {
    list ($min_numerator, $max_numerator) = get_min_max_of_array($numerators, 0);
    
    list ($min_denominator, $max_denominator) = get_min_max_of_array($denominators, 0);
    
    echo "    <debug>\n";
    echo "\tdenominators[us_ca] is ".$denominators["us_ca"]."\n";
    echo "\tnumerators[us_ca] is ".$numerators["us_ca"]."\n";
    echo "\tratio[us_ca] is ".$values["us_ca"]."\n";
    echo "\tdenominators[us_ca] is ".$denominators["us_ca"]."\n";
    echo "\tnumerators[us_ca] is ".$numerators["us_ca"]."\n";
    echo "\tratio[us] is ".$values["us_ca"]."\n";
    echo "\tThe minimum numerator value in this dataset is $min_numerator;\n"; 
    echo "\tthe maximum numerator value in this dataset is $max_numerator.\n";
    echo "\tThe minimum denominator value in this dataset is $min_denominator;\n"; 
    echo "\tthe maximum denominator value in this dataset is $max_denominator.\n";
    echo "\tThe minimum ratio in this dataset is $min_ratio;\n"; 
    echo "\tthe maximum ratio in this dataset is $max_ratio.\n";
    echo "\tThe min cutoff specified was $request->min_cutoff\n";
    echo "\tthe max cutoff specified was $request->max_cutoff\n";
    echo "\tThis is a {$request->resolution} resolution KML file.\n";
    echo "    </debug>\n";
  }
  
  // function zero_length_error_message ======================
  // in: nothing
  // out: error message as a string
  function zero_length_error_message()
  {
    $error_string = "Uh-oh, there wasn't any data to map.  This could be because:".
                    "<ul><li>the <a href=\"{$this->request->url}\">data file</a> you provided has problems</li>".
                    "<li>the data file used for the <a href=\"".
                    $this->get_denominator_url().
                    "\">denominator</a> has problems (not as likely, since that's been tested heavily)</li>".
                    "<li>the data file you provided and the denominator don't have the same territories in them (like a data file for the US".
                    "and a denominator for Canada)</li></ul>.";
    return $error_string;               
  }
  
  // function get_denominator_url ======================
  // in: nothing
  // out: the appropriate URL for the denominator of this request
  function get_denominator_url()
  {
    log3("denominator is $this->request->denominator, is_provinces is $this->validator->is_provinces");
    if($this->validator->is_provinces)
    {
      return $this->get_provinces_denominator_url($this->request->denominator);
    } else
    {
      return $this->get_countries_denominator_url($this->request->denominator);
    }
  }
   
  // function get_provinces_denominator_url ======================
  // Gets the appropriate URL for a denominator given that we are looking
  // at provinces and not countries.
  // in: nothing
  // out: the appropriate URL for the denominator of this request
  function get_provinces_denominator_url()
  {
      
      log2("======== get_provinces_denominator_url ========\n");
      $url_base = $this->per_host_data->url_base;

      log2("denominator is ");
      if("P" == $this->request->denominator)
      {
        // source: US census bureau 2006 via wikipedia
        log2("P is denom");
        return "$url_base/denominators/provincePopulations2006.csv";
      }
  
    if("A" == $this->request->denominator)
    {
      log2("A is denom");
      // source: US census bureau 2000 via wikipedia
      return "$url_base/denominators/provinceSqKm2000.csv";
    }
    else
    {
      print_html_error("Uh-oh, I don't understand which denominator I'm supposed to use.");
    }
  
      // we should not reach here
      echo "We should not reach here!\n";
      return null;
  }
  
  // function get_countries_denominator_url ======================
  // Gets the appropriate URL for a denominator given that we are looking
  // at countries and not provinces.
  // in: nothing
  // out: the appropriate URL for the denominator of this request
  function get_countries_denominator_url()
  {

      log2("======= get_countries_denominator_url ========");
      $url_base = $this->per_host_data->url_base;

      $denom_string = "denominator is ".
                      $this->request->denominator;
      log2($denom_string);

      if("P" == $this->request->denominator)
      {
        // source: EarthTrends for population2006.csv
        return "$url_base/denominators/countryPopulation2006.csv";

      }
      else 
      {
        if("A" == $this->request->denominator)
        {
          // source: CIA world factbook 2006
          return "$url_base/denominators/countrySqKm2006.csv";

        }
        else
        {
          print_html_error("Uh-oh, I don't understand which denominator I'm supposed to use.");
        }
      }
  }
    
}

function testColouredKmlModel()
{

  // This is the main code
  include "PerHostData.php";
  include "duckUtils.php";
  include "MapRequest.php"; 
  include "KmlWriter.php"; 
  include "CsvValidator.php";  
  include "TerritoryValidator.php"; 
  include "Territory.php"; 
  include "WarningsList.php";
  include "LinearColourMapping.php"; 
  include "DuckUnit.php";


  $testor = new DuckUnit();
  

  $model = new ColouredKmlModel();
  $model->request->make_dummy_request(); 

  $url_base = $model->per_host_data->url_base;

  // get a country numerator and denominator array -------------------------
  // note that make_dummy_request denominator type is "P"
  $model->request->url = "$url_base/numerators/countryPaperConsumption2005.csv";
  $denominators = $model->get_denominator_array();
  $numerators = $model->get_numerator_array();
    
  $testor->expect_true($denominators["ca"] == 32566000);
  $testor->expect_true($numerators["ca"] == 241.94);

  // "A" denominator
  $model->request->denominator = "A";
  $denominators = $model->get_denominator_array();
  $numerators = $model->get_numerator_array();
  
  $testor->expect_true($denominators["ao"] == 1246700);
  $testor->expect_true($numerators["ao"] == 1.16);
  
  // "1" denominator
  $model->request->denominator = "1";
  $denominators = $model->get_denominator_array();
  $numerators = $model->get_numerator_array();
  
  $testor->expect_false($denominators);
  $testor->expect_true($numerators["us"] == 297.05);


  // get a province numerator and denominator ------------
  $model->validator->is_provinces = true;
  // $model->is_provinces = true;
  $model->request->url = "$url_base/numerators/provinceMedianAge2000-2001.csv";

  // "P" denominator
  $model->request->denominator = "P";
  $numerators = $model->get_numerator_array();
  $denominators = $model->get_denominator_array();
  
  $testor->expect_true($numerators["us_wy"] == 36.2);
  $testor->expect_true($denominators["us_wy"] == 515004);
  
  // "A" denominator
  $model->request->denominator = "A";

  $numerators = $model->get_numerator_array();
  $denominators = $model->get_denominator_array();

  $testor->expect_true($numerators["us_ut"] == 27.1);
  $testor->expect_true($denominators["us_ut"] == 219887);
  
  
  // "1" denominator
  $model->request->denominator = "1";
  $numerators = $model->get_numerator_array();
  $denominators = $model->get_denominator_array();
  
  $testor->expect_true($numerators["ca_nu"] == 22.5);
  $testor->expect_false($denominators);


  echo $testor->warnings_as_html_string();
  echo "<p>\n";  
 
}

  
// $LOG_THRESHOLD = 0;
// testColouredKmlModel();

?>
