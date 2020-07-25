<?php
/*
 * Created on 26-Apr-2007 by Kaitlin Duck Sherwood
 * 
 * This is really just a data structure to hold information about what the 
 * user requested, with occasional overrides to deal with unspecified fields.
 */
class MapRequest
{


   
  function MapRequest()
  {
    $this->resolution = get_query_variable('resolution');
    $this->submit = get_query_variable('submit');
    $this->url = get_query_variable('url');
    $this->title = get_query_variable('title');
    $this->source = get_query_variable('source');
    $this->year = get_query_variable('year');
    $this->denominator = get_query_variable('denominator');
    $this->min_cutoff = get_query_variable('min');
    $this->max_cutoff = get_query_variable('max');
    
    if(($this->resolution != 'default') && (!empty($this->resolution)))
    {
      // somebody set the resolution, go for it
      return;
    }

    if(preg_match('/Google.Maps/',$this->submit))
    {
      $this->set_for_google_maps();
    } else
    {
      $this->set_for_google_earth();
    }
    if (!$this->resolution == 'hires')
    {
      $this->resolution = 'lowres';
    } 
    
    if(($this->resolution == 'default') || empty($this->resolution))
    {
      $this->resolution = 'lowres';
    }

    if (!(($this->resolution == "hires") || ($this->resolution == "lowres")))
    {
      print_html_error("Uh-oh.. I don't know what a resolution of \"$this->resolution\" means.");
      exit(0);
    }
  }
  
  function set_for_google_earth()
  {
    $this->resolution = 'hires';
    $this->for_earth = true;
  }
  
  function set_for_google_maps()
  {
    if(empty($this->resolution))
    {  
      $this->resolution = 'lowres';
    } 
    
    $this->for_earth = false;
  }
  
  function is_for_earth()
  {
    return $this->for_earth;
  }
  
  
  function print_self()
  {
    echo "submit: ".$this->submit;echo "\n<p>\n";
    echo "url: ".$this->url;echo "\n<p>\n";
    echo "title: ".$this->title;echo "\n<p>\n";
    echo "source: ".$this->source;echo "\n<p>\n";
    echo "year: ".$this->year;echo "\n<p>\n";
    echo "denominator: ".$this->denominator;echo "\n<p>\n";
    echo "min_cutoff: ".$this->min_cutoff;echo "\n<p>\n";
    echo "max_cutoff: ".$this->max_cutoff;echo "\n<p>\n";
     echo "resolution: ".$this->resolution; echo "\n<p>\n";
    

  }
  
  // This is a stub useful for testing.
  function make_dummy_request()
  {
    $this->url = "http://maps.webfoot.com/mapeteria/numerators/provindeUniversityDegrees2001.csv";
    $this->title = "Title test";
    $this->source = "various locations (test)";
    $this->year = 2007;
    $this->denominator = "P";
    $this->resolution = "lowres";
  }
}
?>
