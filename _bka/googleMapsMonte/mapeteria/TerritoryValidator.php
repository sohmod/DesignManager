<?php

/*
 * Created on 27-Apr-2007 by Kaitlin Duck Sherwood
 * 
 * This checks to see if the territory is valid, i.e. it is a territory
 * that I have geometry for and that is valid/appropriate for this year.
 */
 
  

  // TODO At some point, territories should be checked to see if 
  //      they are valid, i.e. they have to characters AND
  //      those two characters correspond to an actual territory.
 
 class TerritoryValidator
 {
   
   function TerritoryValidator($aYear)
   {
     $this->warningsList = new WarningsList();
     
     // TODO load up the list of countries and provinces from a database?

     if(empty($year))
     {
       $this->year = "2007";
     } else
     {
       $this->year = $aYear;
     }
     

   }

  
  function set_to_validate_countries()
  {
    $this->validatingProvinces = false;
  }
  
  function set_to_validate_provinces()
  {
    $this->validatingProvinces = true;
  }
  
  function set_year($aYear)
  {
    $this->year = $aYear;
  }


  
  // private
  // method is_valid_country =============
  // This takes a Territory object
  // and checks to see that if its country is valid. 
  // in: $aTerritory -- a Territory object, duh
  // out: a boolean telling whether the country is valid or not
  // SIDE EFFECT: Might set a warning.
  function is_valid_country($aTerritory)
  {
  $warning = "";  // you would think this would be local, but maybe not ???
  // if it's got two letters, it's okay for now.
    // TODO At some point, this should check to see if 
    //      the country code has ever been valid (e.g. "xx" should fail) 
    // TODO At some (later) point, it should check to see if
    //      the country code was valid in the specified year.  For
    //      example, "sr" (USSR) is not valid in 2007, but was valid 
    //      in 1963.
    if (preg_match('/^[a-z][a-z]$/', $aTerritory->get_country()))
    {
      return true;
    } else
    {
      $warning = "I don't recognize the country ".$aTerritory->get_country().".";
      $this->warningsList->add_warning($warning);
      return false;
    }
  }
  

  // private
  // method is_valid_province =============
  // This takes a Territory object
  // and checks to see if its province is valid or not.
  // TODO This would probably be better as a static method
  // SIDE EFFECT: Might set a warning.
  function is_valid_province($aTerritory)
  {
    $warning = "";
    // TODO check against the year someday; this is 
    // less important than for countries, as I think 
    // provinces don't change as often as countries.
    // Yes, yes, Canada's Nunavut is new.
    // The changes are smaller, anyway.
    $validCountries = array ("us", "ca", "fr");
    
    $warning = "";
    // is this a country code that looks legit?
    $isOkayCountry = $this->is_valid_country($aTerritory);
    if(!$isOkayCountry) 
    {
      // don't need to add a warning because is_valid_country does that.
      return false;
    }
  
    // is this a province code that looks legit?
    // TODO someday look for this in a list of provinces in a country
    $isOkayProvince = preg_match('/^[a-z0-9][a-z0-9]$/', $aTerritory->get_province());
    if(!$isOkayProvince) // province not recognized
    {
      $warning = "I don't recognize province ".$aTerritory->get_province().
                  " in country ".$aTerritory->get_country().".";
      $this->warningsList->add_warning($warning);
      return false;
    }
  
    $countryHasProvinces = in_array($aTerritory->get_country(), $validCountries);
    if(!$countryHasProvinces)
    {
      $this->warningsList->add_warning("I don't have province/state/department data for the country ".$aTerritory->get_country().".  ");
      return false;
    } 
    
  return true;

  }
  
  // public
  // method is_valid =============
  // This takes a Territory object
  // and checks to see if it is valid or not.
  // TODO This would probably be better as a static method
  // SIDE EFFECT: Might set a warning.
  function is_valid($aTerritory)
  {
    if($this->validatingProvinces)
    {
      if($aTerritory->is_country())
      {
        return false;
      } else 
      {
        return $this->is_valid_province($aTerritory);
      }
    } else
    {
      if($aTerritory->is_province())
      {
        return false;
      }
      return $this->is_valid_country($aTerritory);
    }
  }
  
  function pop_warning()
  {
    return $this->warningsList->pop_warning();
  }
  
  function warnings_as_html_string()
  {
    return $this->warningsList->as_html_string();
  }
}

function test_territory_validator()
{
  include 'Territory.php';
  include 'WarningsList.php';
  include 'DuckUnit.php';
  include 'duckUtils.php';

  $validator = new TerritoryValidator(null);
  $validator->set_to_validate_provinces();
  $validator->set_year = "2007";
  $paris = new Territory("fr", "25");
  $illinois = new Territory("us", "il");
  $yukon = new Territory("ca", "yt");
  $california_sc = new Territory("california", "santa clara");


  $france = new Territory("fr", null);
  $us = new Territory("us", null);
  $germany = new Territory("de", null);
  $longProvince = new Territory("gb", "mooo");
  $noProvinces1 = new Territory("xx", "yy");
  $noProvinces2 = new Territory("uk", "as");
    
  
  $testor = new DuckUnit();
  $testor->expect_true($validator->is_valid($paris));
  $testor->expect_true($validator->is_valid($illinois));
  $testor->expect_true($validator->is_valid($yukon));
  $testor->expect_false($validator->is_valid($california_sc));
  $testor->expect_false($validator->is_valid($longProvince));
  $testor->expect_false($validator->is_valid($noProvinces1));
  $testor->expect_false($validator->is_valid($noProvinces2));  
    
  $validator->set_to_validate_countries();
  $testor->expect_true($validator->is_valid($france));
  $testor->expect_true($validator->is_valid($us));
  $testor->expect_true($validator->is_valid($germany));
  $testor->expect_false($validator->is_valid($california_sc));
  $testor->expect_false($validator->is_valid($paris));

    
    
  echo $testor->warnings_as_html_string();
  echo "<p>\n";  
  echo $validator->warnings_as_html_string();
  
  echo "<p><b>The following tests will not pass until I have more intelligence about political geography.</b><p>\n";
  $testor = new DuckUnit();
    
  $validator = new TerritoryValidator(null);
  $validator->set_to_validate_countries();
  
  // these will incorrectly pass right now
  $futureBad5 = new Territory("us", "yt");
  $futureBad6 = new Territory("ca", "ca");
  $futureBadUssr = new Territory("sr", null);
  
  $testor->expect_false($validator->is_valid($futureBadUssr));  
  $validator->set_to_validate_provinces();

  $testor->expect_false($validator->is_valid($futureBad5));
  $testor->expect_false($validator->is_valid($futureBad6));  

  echo $testor->warnings_as_html_string();
  echo "<p>\n";  
  echo $validator->warnings_as_html_string();

}

// test_territory_validator();

?>
