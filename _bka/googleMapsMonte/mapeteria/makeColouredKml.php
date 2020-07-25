<?php
/*
 * Created on 9-Apr-2007 by Kaitlin Duck Sherwood
 * This takes a CSV file and produces a KML with countries or provinces
 * colored appropriately.
 */
 
// TODO Whoa!  I could put the map right on the same page as the form!
// That would mean that I wouldn't have to do quite as kludgy fiddling
// to make the form.  Maybe.

// TODO I wonder if I can send back a multipart MIME type,
// so that I send back a KML file AND a HTML status message
// Or do I maybe just fork off the KML into a different javascript
// page or something like that?  (Sourceforge does it..)

// NOTE I removed Antarctica from the countries geometry.  
// It's big and people aren't going to ask for it often.


  include "PerHostData.php";
  include "duckUtils.php";
  include "MapRequest.php"; 
  include "KmlWriter.php"; 
  include "CsvValidator.php";  
  include "TerritoryValidator.php"; 
  include "Territory.php"; 
  include "WarningsList.php";
  include "LinearColourMapping.php"; 
  include "ColouredKmlModel.php";
  
  $model = new ColouredKmlModel();
  
  $numerators = $model->get_numerator_array();         
  // Note that a local copy of countries_seen_list must be used, 
  // since it gets reset when the denominator is read.
  $countries_seen_list = $model->validator->countries_seen_list;

  if($model->request->denominator == "1")
  {
    $values = $numerators;
    $denominators = array(1);
  } else
  {
    $denominators = $model->get_denominator_array();
    $values = array_of_ratios($numerators, $denominators);
  }


  // TODO figure out what to do with warnings!
  $warnings_list = $model->validator->warnings_list->as_html_string();  

    
  if(0 == sizeof($values))
  {                  
    print_html_error($this->zero_length_error_message);
  }

  list ($min_ratio, $max_ratio) = get_min_max_of_array($values);
  $color_mapper = new LinearColorMapping($model->request->min_cutoff, $model->request->max_cutoff, $min_ratio, $max_ratio);
  
  $kmlWriter = new KmlWriter($model->validator->is_provinces, $model->request, $color_mapper, $countries_seen_list);
  $kmlWriter->write_kml_header($debug);

  $model->write_debug_info($numerators, $denominators, $values, $min_ratio, $max_ratio, $model->request);
  $model->write_kml_end($kmlWriter, $values, $min_ratio, $max_ratio);

?>

  

  


