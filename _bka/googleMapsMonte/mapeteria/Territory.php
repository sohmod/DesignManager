<?php
/*
 * Created on 27-Apr-2007 by Kaitlin Duck Sherwood
 * 
 * Territory is either a country or a country/province pair.  Someday
 * there might also be second- or third-level administrative divisions,
 * postal codes, census tracts, etc.
 * 
 * Note that these Territories are NOT validated!  That is done elsewhere
 * because of the overhead required to pull the information out of a db.
 */
 
 
class Territory
{
  
  // NB: method overloading isn't available in PHP4,
  // so must pass something in for the province even
  // when generating a country.
  function Territory($aCountry, $aProvince)
  {
    if(empty($aCountry))
    {
      print_html_error("Uh-oh, country was null.  That shouldn't ever happen!");
    }
    $this->country = $aCountry;
    
    if(!empty($aProvince))
    {
      $this->province = trim($aProvince); 
    }
    
    // TODO convert to iso2 if needed  
    // don't forget the leading zero on French departments 01-09.
  }
  
  // public
  function as_string()
  {
    log3("entering Territory->as_string()<br>\n");
    if($this->is_country())
    {
      return $this->country;
    } else
    {
      return $this->country."_".$this->province;
    }
  }
   
  // public
  function is_country()
  {
    return (empty($this->province) && !empty($this->country));
  }

  // public
  function is_province()
  {
  return !$this->is_country();
  }
  
  // public
  function get_country()
  {
    return $this->country;
  }
  
  // public
  function get_province()
  {
    return $this->province;
  }
}

function test_territory()
{
  include 'DuckUnit.php';
  include 'duckUtils.php';
  print_plain_text_header();

  $testor = new DuckUnit();
  $paris = new Territory("fr", "25");
  $illinois = new Territory("us", "il");
  $yukon = new Territory("ca", "yt");
  $bad1 = new Territory("california", "santa clara");
  $bad2 = new Territory("xx", "yy");
  $bad3 = new Territory("uk", "as");
  $bad4 = new Territory("gb", "mooo");
  $bad5 = new Territory("us", "yt");
  $bad6 = new Territory("ca", "ca");
  
  $france = new Territory("fr", null);
  $spain = new Territory("es", null);
  
  // remember, no validation is done in this class
  $testor->expect_true($paris->is_province());
  $testor->expect_true($illinois->is_province());
  $testor->expect_true($yukon->is_province());
  $testor->expect_true($bad1->is_province());
  $testor->expect_true($bad1->is_province());
  $testor->expect_true($bad2->is_province());
  $testor->expect_true($bad3->is_province());  
  $testor->expect_true($bad4->is_province());
  $testor->expect_true($bad5->is_province());
  $testor->expect_true($bad6->is_province());

  $testor->expect_false($paris->is_country());
  $testor->expect_false($illinois->is_country());
  $testor->expect_false($yukon->is_country());
  $testor->expect_false($bad1->is_country());
  $testor->expect_false($bad1->is_country());
  $testor->expect_false($bad2->is_country());
  $testor->expect_false($bad3->is_country());  
  $testor->expect_false($bad4->is_country());
  $testor->expect_false($bad5->is_country());
  $testor->expect_false($bad6->is_country());
  
  $testor->expect_false($france->is_province());    
  $testor->expect_false($spain->is_province());  
  
  $testor->expect_true($france->is_country());    
  $testor->expect_true($spain->is_country());  
  
  $testor->expect_true($france->as_string() == "fr");
  $testor->expect_true($spain->as_string() == "es");
  $testor->expect_true($paris->as_string() == "fr_25");
  $testor->expect_true($illinois->as_string() == "us_il");
  $testor->expect_true($yukon->as_string() == "ca_yt");
  
  echo $testor->warnings_as_html_string();

}

// test_territory();

?>
