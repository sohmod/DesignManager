<?php
/*
 * Created on 28-Apr-2007 by Kaitlin Duck Sherwood
 * 
 * This class reads in a CSV file, validates it, and puts the data
 * into hash for easy retrieval.
 * 
 */

  

class CsvValidator
{
  // $this->values is an associative array with the territory.as_string as the
  // key and the user attribute as the value.
  // TODO $this->values might not need to be an instance variable
  
  // $this->warnings_list holds information about what went wrong
  // TODO figure out how to get that information back to the user.
  
  // $this->territory_validator is a TerritoryValidator object used to figure out
  // if the territory is valid or not.  

  // $this->is_provinces is true if I've decided that we're looking at provinces,
  // false if I've decided that we're looking at countries.  This will need
  // to become a bit more sophisticated if/when I start using other 
  // boundaries like census tracts or zip codes.
  
  // $this->countries_seen_list is used to figure out which geometries to add for
  // provinces.  (No sense in displaying polygons for France if there
  // is no data for France.)
  
  // TODO Someday I might want to do territories other than countries
  // and first-level administrative divitions.  Instead of a boolean
  // $this->is_provinces, I should have an int $division_level which
  // is 0 for countries, 1 for provinces/states/departments, 2 for
  // ridings/counties.

  
  function CsvValidator($aYear, $trueIfProvincesFalseIfCountries)
  {
    $this->territory_validator = new TerritoryValidator($aYear);
    $this->is_provinces = $trueIfProvincesFalseIfCountries;
    $this->warnings_list = new WarningsList();
    $this->countries_seen_list = null;
    $this->values = null;
    
  }
  
  // ============================ 
  // function parse
  //   parses one big string in $body, interpreting it as a set of 
  //   newline*-delimited records and passing each line off to parse_line()
  // *(Well, okay, NL or CR or CRNL...)
  // in: $body  newline-delimited records, comma-delimited fields
  // out: a hash $values, where the first field is the territory ID and 
  //      the second field is the attribute value for that territory
  function parse($body)
  {

    // Handle all of the "normal" types of line endings.  Blech.
    $body = preg_replace ('/\r\n/', "\n", $body);
    $body = preg_replace ("/\r/", "\n", $body);
    $lines = explode("\n", $body); 

    log3("There are >>".count($lines)." lines in the file<br>\n");
    $line_number = 0;
    $territory = null;
    $warning = null;
    $this->values = null;   // reset
    
    foreach ($lines as $one_line)
    {
      // side effect: parse_line adds to $this->values
      log3("parsing line $line_number: $one_line<br>\n");
      $this->parse_line($one_line, $line_number);
      $line_number++;
    }
    
   
    // TODO This is a fatal error; perhaps there should be
    // a separate list (separate from the warning list, that is)
    // that holds fatal errors.
    if(0 == sizeof($this->values))
    {
      // TODO pass an error code so that I can display the name of the file
      $a = "I couldn't understand the CSV file.  The file needs to ";
      $a = $a."have lines separated with newlines, and each line needs to have ";
      $a = $a."a two-letter country code, then a comma, then a state/province code, then a numeric value, e.g.";
      $a = $a."<br><tt>   us,ca,12</tt><br><tt>   us,il,23</tt><br><tt>   us,or,48</tt><p>";
      $this->add_warning($a);
      return false;
    }
    
    log3("there are ".sizeof($this->values)." records in the CSV file");

    return $this->values;
  }
  
  // ============================ 
  // function parse_line
  //   parses one line in $line, interpreting it as a set of 
  //   comma*-delimited fields. 
  //   It also checks that the keys and values are okay -- 
  //   the keys (country_provinces) should be two-letter 
  //   ISO country codes, lower case, plus the abbreviation for the province.  
  //   The values should be numbers.
  //
  // Note that there is a fair amount of logic devoted to figuring out
  // from the data whether or not the data references countries or 
  // if it references provinces.  I (Ducky) made a conscious decision
  // that I would not require users to say which type of data they 
  // were plotting.
  // 
  // in: $body  comma*-delimited fields
  // out: a hash, where the first field is the territory ID and 
  //      the second field is the attribute value for that territory
  // preconditions: $this->warning must be a valid WarningsList 
  //                $this->territory_validator must be a valid TerritoryValidator
  //                $line_number should be set (no error, but degraded utility)
  //                $aLine must be canonicalized
  // >>>>>>>>>>>>>> SIDE EFFECT: adds to the hash $this->value <<<<<<<<<<<<<<<<<<<<
  // >>>>>>>>>>>>>> SIDE EFFECT: can set $this->is_provinces <<<<<<<<<<<<<<<<<<<<<<
  // >>>>>>>>>>>>>> SIDE EFFECT: can set $this->warning <<<<<<<<<<<<<<<<<<<<<<<<<<<
  // *(Well, or semicolon also, for those places that use commas 
  //   to denote the decimal separator.)  
function parse_line($aLine, $line_number)
{
      
      $line = $this->canonicalize_string($aLine);
   
      $elements = explode(',',$line);
      $column_count = count($elements);


      // There are bunch of ways that the line could be bad; check them all.
      
      if(is_null($line))
      {
        return false;
      }
     
      // skip comment lines
      if($this->is_comment($elements[0]))
      {
      log3("skipping comment line");
      return true;
      }
    
      // skip blank lines
      if (empty($line))
      {
      log3("skipping blank line");
      return true;
      }
    
      // side effect: a warning is generated if !are_countries_provinces_consistent
      // side effect: is_province is set in are_countries_provinces_consistent if null
      if(!$this->are_countries_provinces_consistent($column_count, $this->is_provinces, $line_number))
      {
        log3("inconsistency between $column_count columns and is_provinces= ".false_or_null($this->is_provinces)."<p>\n");
        $this->add_warning("Line $line_number: $column_count columns when expecting a different number");
        return false;
      }

      if(empty($elements[0]))
      {
        log3("Country column is empty");
        $this->add_warning("Line $line_number: no country specified.");
        
        return false;
      }

      if(empty($elements[1]))
      {
        log3("Second column is empty");
        $this->add_warning("Line $line_number: second column is empty.");
        return false;
      }
      
      if($this->is_provinces)
      {
      $territory = new Territory($elements[0], $elements[1]);
      $this->territory_validator->set_to_validate_provinces();
      log3("created territory ".$territory->as_string().".<p>\n");
      } else  
      {
        // no overloading, so must pass null
        $territory = new Territory($elements[0], null);
        $this->territory_validator->set_to_validate_countries();
      }
      
      
    if(!$this->territory_validator->is_valid($territory))
    {
        log3("territory ".$territory->as_string." isn't valid.<p>\n");
        $this->add_warning("Line $line_number: ".$this->territory_validator->pop_warning());
      return false;
    }
    
    
      // Yay!  If we get here, the territory columns look okay!
      // Check for all the ways that the attribute value might be wrong.
      $attribute_value = $elements[$column_count -1];
      if(is_null($attribute_value))
      {
        log3("Attribute column is empty");
        return false;
      }
      
      if(!$this->is_number($attribute_value))
      {
        log3("I don't understand number format of $attribute_value.<p>\n");
        $this->add_warning("Line: $line_number: $attribute_value doesn't look like a number to me.");
        return false;
      }
      
      // Yay!  If we get here, all is happy!  Add the record to the list!
      // (Yes, this is a side effect.)
      $this->values[$territory->as_string()] = $attribute_value;
      log3("values of ".$territory->as_string()." is $attribute_value.<br>\n");
      
      $country = $territory->get_country();
            
      // add the country to $this->countries_seen_list, for future use 
      // in figuring out which geometries to overlay.
      // $this->countries_seen_list needs to be a Set, not a Bag; use a hash as
      // a quick and dirty approximation to a Set.
      // Note that while we only need one of keys and value to be set in 
      // theory, in practice sometimes it is nicer to work with keys, 
      // sometimes values, so might as well set the key AND value to $country.
      $this->countries_seen_list[$country]= $country;   
      
      return true;
    }
  
  // get_countries_seen_list() returns a list of all of the valid countries that are in
  // $values.  Currently, it is probably only interesting when showing provinces.
  // in: nothing
  // out: an array holding all the countries that have been seen  
  function get_countries_seen_list()
  {
    return array_keys($this->countries_seen_list);
  }
  

  
  // Side effect: a warning can be pushed onto the warnings list
  // I pass in $provinces instead of using $this->is_provinces purely 
  // to make this routine easier to test.
  // in: $aColumnCount -- number of columns in a line
  //     $provinces -- true if the user data indicated provinces, false if the
  //                   user data indicated countries.
  //     $aLineNumber -- used to make error messages more helpful
  // out: true if the number of columns in the current line is consistent 
  //      with the past lines... i.e. if I think I'm looking at countries,
  //      do I have two columns?  If I think I'm looking at provinces,
  //      do I have three?  Of course, nothing is ever that simple
  //      (if you want to have helpful error messages, which we do).
  function are_countries_provinces_consistent($aColumnCount, $provinces, $aLineNumber)
  {
    if(($aColumnCount > 3) || ($aColumnCount < 2))
    {
      $this->add_warning("Line $aLineNumber: I don't know how to interpret $aColumnCount columns; I was expecting 2 or 3.");
      return false;
    }
    
    
    if(is_null($provinces))
    {
      log3("setting provinces with column_count of $aColumnCount");
      switch ($aColumnCount) {
        case 2: 
          $this->is_provinces = false;
          return true;
        case 3:
          $this->is_provinces = true;
          log3("is_provinces should be true now<p>\n");
          return true;
        default:
          // shouldn't ever get here
          print_html_error("Uh-oh, this ever shouldn't happen.  ERROR!  Column count is $aColumnCount!\n");
          return false;
      }
    }
    
    
    // check to see if we have the right number of columns
    if((!$provinces) && (3 == $aColumnCount))
    {
      $this->add_warning("Line $aLineNumber: There are three columns (provinces) when I was expecting two (countries).\n");
      return false;
    } 
    
    if (($provinces) && (2 == $aColumnCount))
    {
      $this->add_warning("Line $aLineNumber: There are two columns (countries) when I was expecting three (provinces).\n");
      return false;
    }
    
    return true;
  }
  
  
 // TODO Make this a static method if that
 // is possible in PHP4 without too many contortions.
 // in: a snippet of the input data
 // out: a boolean telling whether that snippet is a comment
 function is_comment($snippet)
 {
   return (preg_match('/#/', $snippet));
 }

  // TODO Make this a static method if that
  // is possible in PHP4 without too many contortions. 
  // in: a snippet of the input data
  // out: whether or not the number is a fixed-point number
  function is_number($snippet)
  {
  return (preg_match('/^-?[0-9]*[\056]?[0-9]*$/',$snippet));
  }

  // TODO Make this a static method if that
  // is possible in PHP4 without too many contortions.
  // in: one line from the input data
  // out: a line in canonical form:
  //      + lowercase
  //      + no spaces
  //      + no quotes
  //      + U.S. / Canadian number and separator format
  //         + decimal points of "." (not ",")
  //         + comma separators (not semicolons)
  //      + two character province designators
  function canonicalize_string($aLine)
  {
      // Get rid of double quote, single quote, and spaces
      $special_chars = array ('"', '\'', ' ');
      $stripped_line = str_replace ($special_chars, '', $aLine);
      
      // Handle CSVs with "comma" number format, e.g.
      // "fr;25;1 234,7"
      if(strpos($stripped_line, ';') > 0)
      {
        $stripped_line = str_replace(',','.',$stripped_line);
        $stripped_line = str_replace(';', ',', $stripped_line);
      }
      
      // strip a trailing comma, e.g. from "a,b,c,"
      $stripped_line = preg_replace('/[;,]\s*$/', '', $stripped_line);

      $stripped_line = strtolower($stripped_line);
      
            
      // French departements are digits, so there is the possibility
      // that someone would leave off a 0.  Fix that.
      if(preg_match('/^fr,[1-9],/', $stripped_line))
      {
        {
          $stripped_line = str_replace('fr,','fr,0',$stripped_line);
        }
      }
      
      log3("Canonicalized string is $stripped_line<p>\n");
      return $stripped_line;
  }
  
  // convenience method only
  function add_warning($message)
  {
    $this->warnings_list->add_warning($message);
  }

  function get_is_provinces()
  {
    return $this->is_provinces;
  }
}

function test_canonicalize_string()
{

  echo "<p>Testing CsvValidator->canonicalize_string<p>\n";

  $testor = new DuckUnit();  
  $parser = new CsvValidator(null, null,null);
  $testor->expect_true($parser->canonicalize_string("   a  ,   b   ,  c   ") == "a,b,c");
  $testor->expect_true($parser->canonicalize_string('"FR", 025, 1345.7') == 'fr,025,1345.7');
    $testor->expect_true($parser->canonicalize_string('FR; 025; 1 345,7') == 'fr,025,1345.7');
  $testor->expect_true($parser->canonicalize_string('\'FR\'; 025; 1 345,7') == 'fr,025,1345.7');
  $testor->expect_true($parser->canonicalize_string('"FR";025;1345,7') == 'fr,025,1345.7');
  $testor->expect_true($parser->canonicalize_string('"FR";025;1345,7') == 'fr,025,1345.7');
  $testor->expect_true($parser->canonicalize_string('"FR",025,1345.7,') == 'fr,025,1345.7');
  $testor->expect_true($parser->canonicalize_string('"FR",1,1345.7,') == 'fr,01,1345.7');
  $testor->expect_false($parser->canonicalize_string('"FR",A,1345.7,') == 'fr,0A,1345.7');
  $testor->expect_false($parser->canonicalize_string('"US",1,1345.7,') == 'us,01,1345.7');
  $testor->expect_false($parser->canonicalize_string('FR, 025, 1 345,7') == 'fr,025,1345.7');
  $testor->expect_true($parser->canonicalize_string("fr;25;1 223,234") == "fr,25,1223.234");
  // the next ones are invalid lines, but that invalidity needs to get caught later
  $testor->expect_true($parser->canonicalize_string('"FR", 025, 1345,7'), 'fr,025,1345,7'); 

  echo $testor->warnings_as_html_string();
  echo $parser->warnings_list->as_html_string();
  return $testor->did_pass_all_tests();
  
}

function test_is_number()
{
  echo "<p>Testing CsvValidator->is_number<p>\n";

  $testor = new DuckUnit();  
  $parser = new CsvValidator(null, null,null);
  $testor->expect_true($parser->is_number("3.14159"));
  $testor->expect_true($parser->is_number("314234"));
  $testor->expect_true($parser->is_number("-314234"));
  $testor->expect_true($parser->is_number("-3.14159"));
  $testor->expect_false($parser->is_number("314,234"));  
  $testor->expect_false($parser->is_number("3,14159"));
  $testor->expect_false($parser->is_number("314 234"));  
  $testor->expect_false($parser->is_number("314 234,7"));  
  $testor->expect_false($parser->is_number("-3,14159"));
  $testor->expect_false($parser->is_number("-314 234"));  
  $testor->expect_false($parser->is_number("-314 234,7")); 

  $testor->expect_true($parser->is_number("1"));
  $testor->expect_true($parser->is_number("55"));
  $testor->expect_true($parser->is_number("-71"));
    $testor->expect_true($parser->is_number("-.71"));
    $testor->expect_true($parser->is_number("-0.71")); 
    
  // $testor->expect_false($parser->is_number("10e6"));
  
  echo $testor->warnings_as_html_string();
  echo $parser->warnings_list->as_html_string();
  return $testor->did_pass_all_tests();
}

function test_is_comment()
{
  echo "<p>Testing CsvValidator->is_comment<p>\n";

  $testor = new DuckUnit();  
  $parser = new CsvValidator(null, null,null);
  $testor->expect_true($parser->is_comment("# asldfkj"));
  $testor->expect_true($parser->is_comment("   # asldfkj"));
  
  $testor->expect_false($parser->is_comment("3.14159"));
  $testor->expect_false($parser->is_comment("fr"));
  
  echo $testor->warnings_as_html_string();
  echo $parser->warnings_list->as_html_string();
  return $testor->did_pass_all_tests();
}

function test_are_countries_provinces_consistent()
{
  echo "<p>Testing CsvValidator->are_countries_provinces_consistent<p>\n";

  $testor = new DuckUnit();  
  $parser = new CsvValidator(null, null,null);
  // are_countries_provinces_consistent($aColumnCount, $is_provinces, $aLineNumber)
  $testor->expect_false($parser->are_countries_provinces_consistent(4, false, 1));
    $testor->expect_true($parser->are_countries_provinces_consistent(3, null, 2));
    $testor->expect_true($parser->are_countries_provinces_consistent(2, null, 25));
  $testor->expect_true($parser->are_countries_provinces_consistent(2, false, 3));
  $testor->expect_true($parser->are_countries_provinces_consistent(3, true, 4));
  $testor->expect_false($parser->are_countries_provinces_consistent(2, true, 5));
  $testor->expect_false($parser->are_countries_provinces_consistent(3, false, 6));

  
  echo $testor->warnings_as_html_string();
  echo $parser->warnings_list->as_html_string();
  return $testor->did_pass_all_tests();
}

function test_parse_line()
{
  echo "Testing province line parsing...<p>\n";

    $provinceTester = new DuckUnit();  
  $provinceParser = new CsvValidator(null, null,null);

  $provinceTester->expect_true($provinceParser->parse_line("fr,25,2.234",0));
  $provinceTester->expect_true($provinceParser->parse_line("fr;25;1 223,234",1));
  $provinceTester->expect_true($provinceParser->parse_line("us,id,2.234",2));
  $provinceTester->expect_true($provinceParser->parse_line("ca,bc,2234",3));
  $provinceTester->expect_false($provinceParser->parse_line("ca,2234",4));
    $provinceTester->expect_true($provinceParser->parse_line("fr,5,2",5));
    $provinceTester->expect_false($provinceParser->parse_line("fr,19,",6));
    $provinceTester->expect_false($provinceParser->parse_line("fr,",7));
    $provinceTester->expect_true($provinceParser->parse_line("",8)); // skip blanks
    $provinceTester->expect_false($provinceParser->parse_line("asdfasdf",9));   
    $provinceTester->expect_true($provinceParser->parse_line("# asdfasdf",9));  // skip comments  
    
    $provinceTester->expect_false($provinceParser->parse_line("xx,yy,2.234",5));
  
  echo $provinceTester->warnings_as_html_string();
  echo $provinceParser->warnings_list->as_html_string();  

  echo "<p>Testing country parsing...<p>\n";
  $countryTester = new DuckUnit();
  $countryParser = new CsvValidator(null, null,null);
  $countryTester->expect_true($countryParser->parse_line("gb,2.234",11));
  $countryTester->expect_false($countryParser->parse_line("us,ca,873",12));
  $countryTester->expect_false($countryParser->parse_line("california,2.234",16));
  // This will be erroneously pass until later..
    echo "Expect 1 failure until I check for valid countries<p>\n";
  $countryTester->expect_false($countryParser->parse_line("xx,2.234",17));
  
  echo $countryTester->warnings_as_html_string();
  echo $countryParser->warnings_list->as_html_string();  

  return ($provinceTester->did_pass_all_tests() && $countryTester->did_pass_all_tests());
}

function test_parse()
{
  echo "<p>Testing CsvValidator->parse<p>\n";
  $testor = new DuckUnit();
  $body = "fr,24,3.4\r\nus,ca,234.5\rca,yt,1.2345\n";

  $parser = new CsvValidator("2007",null);
  $returned_array = $parser->parse($body);

  $testor->expect_true($returned_array["fr_24"] == 3.4);
  $testor->expect_true($returned_array["us_ca"] == 234.5);
  $testor->expect_true($returned_array["ca_yt"] == 1.2345);

  
  echo $testor->warnings_as_html_string();
  echo $parser->warnings_list->as_html_string();
  echo "<p>done with CsvValidator->parse()";
  return $testor->did_pass_all_tests();
}

function test_all_CsvValidator()
{
  include 'DuckUnit.php';
  include 'WarningsList.php';
  include 'TerritoryValidator.php';
  include 'Territory.php';
  include 'PerHostData.php';  // to get debug messages
  include 'duckUtils.php';    // to get debug messages
  
  $allTestor = new DuckUnit();  
  $allTestor->expect_true(test_is_number()); 
  $allTestor->expect_true(test_parse());
  $allTestor->expect_true(test_parse_line());
  $allTestor->expect_true(test_are_countries_provinces_consistent());
  $allTestor->expect_true(test_canonicalize_string());
  $allTestor->expect_true(test_is_comment()); 

  
  echo "<p>-------------------- OVERALL RESULTS --------------------------<br>";
  echo "(expect one failure until I test for valid countries)<br>";
  echo $allTestor->warnings_as_html_string();
  return $allTestor->did_pass_all_tests();
}

// $LOG_THRESHOLD = 7;
// test_all_CsvValidator();



?>
