<?php
/*
 * Created on 30-Apr-2007 by Kaitlin Duck Sherwood
 */
 

// class LinearColorMapping ======================
// has a pretty stupid mapping; it does a linear gradation
// that lops off the top and bottom of the range.
// Other possibilities: log mapping; different base colors
// blue for negative and red for positive values, etc.
// in: $value  the attribute value that we want a color for
//     $min  the minimum value of all attributes
//     $max  the maximum value of all attributes

class LinearColorMapping // extends ColorMappingInterface
{
  function LinearColorMapping($min_cutoff, $max_cutoff, $min, $max)
  {

      // if the cutoffs aren't specified, use the min/max of the data
      if(("" == $min_cutoff) || is_null($min_cutoff))
      {
        $this->min_cutoff = $min;
      } else 
      {
         $this->min_cutoff = $min_cutoff;
      }
  
      if(("" == $max_cutoff) || is_null($max_cutoff))
      {
       $this->max_cutoff = $max;
      } else 
      {
         $this->max_cutoff = $max_cutoff;
      }
      
      if($min_cutoff == $max_cutoff)
      {
        $this->min_cutoff = $min;
        $this->max_cutoff = $max;
      }
   
  }



  // method value_to_color_with_base_color ======================
  // in: $value  the attribute value that we want a color for
  //     $min  the minimum cutoff
  //     $max  the maximum cutoff
  //     $color the base color to use: currently the *name* as a string
  // out: a color in hex ABGR space -- alpha/blue/green/red.
  function value_to_color_with_base_color($value, $min, $max, $color)
  {
    $range = $max - $min;
    // echo "range is $range, min is $min, max is $max\n";
   
    if($range == 0)
    {
      print_html_error("Uh-oh.. the min and the max are the same.  This is bad. ".
        "I can't figure out how to assign colors if there is no variation.'");
    }
    
    // TODO I'm too tired to get the math right, so I'm just doing 
    //      switch statement for now based on the character 
    //      value $color of "red", "green", and "blue".  Instead,
    //      I really should be taking in a hex ABGR value.
    switch($color)
    {
      case "red": $base_color = "0000ff"; break;
      case "green": $base_color = "00ff00"; break;
      case "blue": $base_color = "ff0000"; break;
      default: print_html_error("Uh-oh, an internal error happened.  I don't know what to do with color $color");
    }
    


    if($value > $max)
    {
      return "ee".$base_color; // full color
    }

    if ($value < $min)
    {
      return "eeffffff";  // full white
    }

    $hex_whiteness = $this->percentage_to_inverted_hex_string($this->get_percent_of_range($value, $min, $max));

    switch($color)
    {
      case "red": $color = "ee".$hex_whiteness.$hex_whiteness."ff"; break;
      case "green": $color = "ee".$hex_whiteness."ff".$hex_whiteness; break;
      case "blue": $color = "eeff".$hex_whiteness.$hex_whiteness; break;
    }
    
    log3("value: $value, colorness $colorness, hex $hexColorness<p>\n");
    return $color;

  }
  

  // method decimal_to_hex_string =======================
  // input: $decimalValue is a number between 0 and 255
  // output: $hex_string is a hex representation of $decimalValue, 00-ff
  function decimal_to_hex_string($decimalValue)
  {
    $hex_string = sprintf("%02x", $decimalValue);
    return $hex_string;
  }
  
  // method percentage_to_decimal =======================
  // input: $percentage is a value between 0 and 1
  // output: the percentage of 255
  function percentage_to_decimal($percentage)
  {
    return (int)(255*$percentage);
  }
 
  // method percentage_to_inverted_hex_string =======================  
  // converts from a percentage to a hex string, with 0.0 -> ff
  // and 1.0 -> 00.
  // in: $percentage is between 0 and 1
  // out: value between 00 and FF
  function percentage_to_inverted_hex_string($percentage)
  {
    $colorness = $this->percentage_to_decimal($percentage);
    $whiteness = $this->inverted_color($colorness);

    $hex_whiteness = $this->decimal_to_hex_string($whiteness);

    return $hex_whiteness;
  }
  
  // method inverted_color =======================  
  // in: $decimal value is between 0 and 255
  // out: value between 00 and FF
  function inverted_color($decimalValue)
  {
    return 255 - $decimalValue;
  }
  
  // method value_to_color =======================  
  // in: $value: an attribute value
  // out: an ABGR-space hex color
  function value_to_color ($value)
  {
    return $this->value_to_color_with_base_color($value, $this->min_cutoff, $this->max_cutoff, "red");
  }

  // method get_percent_of_range =======================  
  // in: $value: an attribute value
  //     $min: minimum cutoff
  //     $max: maximum cutoff
  // out: an ABGR-space hex color
  function get_percent_of_range($value, $min, $max)
  {
    $percentage = ($value - $min) / ($max - $min);
    return $percentage;
  }
  

  function get_min()
  {
    return $this->min_cutoff;
  }
  
  function get_max()
  {
    return $this->max_cutoff;
  }
  

  
}


function test_get_percent_of_range()
{
  
  // include 'DuckUnit.php';
  
  $testor = new DuckUnit();  
  $min = 0;
  $max = 100;
  $colorMapping = new LinearColorMapping(null, null, $min, $max);

  
  $testor->expect_true($colorMapping->get_percent_of_range(50, $min, $max) == .5); 
  $testor->expect_true($colorMapping->get_percent_of_range(40, $min, $max) == .4); 
  $testor->expect_true($colorMapping->get_percent_of_range(100, $min, $max) == 1.0); 
  $testor->expect_true($colorMapping->get_percent_of_range(0, $min, $max) == 0); 
 
  
  echo $testor->warnings_as_html_string();
  return $testor->did_pass_all_tests();
  
}

function test_decimal_to_hex_string()
{
  
  // include 'DuckUnit.php';
  
  $testor = new DuckUnit();  
  $min = 0;
  $max = 100;
  $colorMapping = new LinearColorMapping(null, null, $min, $max);

  
  $testor->expect_true($colorMapping->decimal_to_hex_string(0) == "00"); 
  $testor->expect_true($colorMapping->decimal_to_hex_string(10) == "0a"); 
  $testor->expect_true($colorMapping->decimal_to_hex_string(255) == "ff"); 
    
  echo $testor->warnings_as_html_string();
  return $testor->did_pass_all_tests();
  
}

function test_percentage_to_inverted_hex_string()
{
  
  // include 'DuckUnit.php';
  
  $testor = new DuckUnit();  
  $min = 0;
  $max = 100;
  $colorMapping = new LinearColorMapping(null, null, $min, $max);

  
  $testor->expect_true($colorMapping->percentage_to_inverted_hex_string(1.0) == "00"); 
  $testor->expect_true($colorMapping->percentage_to_inverted_hex_string(0.5) == "80"); 
  $testor->expect_true($colorMapping->percentage_to_inverted_hex_string(0.0) == "ff"); 
    
  echo $testor->warnings_as_html_string();
  return $testor->did_pass_all_tests();
  
}

function test_value_to_color()
{
  
  // include 'DuckUnit.php';
  
  $testor = new DuckUnit();  
  $min = 0;
  $max = 100;
  $colorMapping = new LinearColorMapping(null, null, $min, $max);

  $testor->expect_true($colorMapping->value_to_color(0) == "eeffffff");
  $testor->expect_true($colorMapping->value_to_color(100) == "ee0000ff");
  $testor->expect_true($colorMapping->value_to_color(50) == "ee8080ff");
  $testor->expect_true($colorMapping->value_to_color(200) == "ee0000ff");
  $testor->expect_true($colorMapping->value_to_color(-20000) == "eeffffff");
  $testor->expect_true($colorMapping->value_to_color("blort") == "eeffffff");

     
  echo $testor->warnings_as_html_string();
  return $testor->did_pass_all_tests();
  
}

function test_value_to_color2()
{
  
  // include 'DuckUnit.php';
  
  $testor = new DuckUnit();  
  
  $il = 12831970;
  $tx = 23507783;
  $ca = 36457549;
  $wy = 00515004;
  
  $min = 2*1000*1000;
  $max = 20*1000*1000;
  // $min = $wy;
  // $max = $ca;
  $colorMapping = new LinearColorMapping(null, null, $min, $max);

  $testor->expect_true($colorMapping->value_to_color(0) == "eeffffff");
  $testor->expect_true($colorMapping->value_to_color(23507783) == "ee0000ff");
  $testor->expect_true($colorMapping->value_to_color(12831970) == "ee6666ff");
  $testor->expect_true($colorMapping->value_to_color(170500) == "eeffffff");
  $testor->expect_true($colorMapping->value_to_color(200) == "eeffffff");
  $testor->expect_true($colorMapping->value_to_color(-20000) == "eeffffff");
  $testor->expect_true($colorMapping->value_to_color("blort") == "eeffffff");

  foreach (array($ca, $tx, $il, $wy) as $province)
  {
    echo "$province -> ";
    echo $colorMapping->value_to_color($province);
    echo "<br>\n";
  }
  
  /*
  // densities -- a quick check 
  $nj = 386.24;
  $ri = 266.77;
  $ct = 244.1184;
  $ca = 85.990869637003;
  $wi = 32.74;
  $ak = 0;
  $colorMapping = new LinearColorMapping(null, null, 0, 200);
    
  foreach (array($nj, $ri, $ct, $ca, $wi, $ak) as $province)
  {
    echo "$province -> ";
    echo $colorMapping->value_to_color($province);
    echo "<br>\n";
  }
  */
     
  echo $testor->warnings_as_html_string();
  return $testor->did_pass_all_tests();
  
}

function test_all()
{
  include 'DuckUnit.php';
  include 'PerHostData.php';  // to get debug messages
  include 'duckUtils.php';    // to get debug messages
  
  $allTestor = new DuckUnit();  
  
  $allTestor->expect_true(test_value_to_color());
  $allTestor->expect_true(test_value_to_color2());
  $allTestor->expect_true(test_get_percent_of_range());
  $allTestor->expect_true(test_decimal_to_hex_string());
  $allTestor->expect_true(test_percentage_to_inverted_hex_string());


  
  echo "<p>-------------------- OVERALL RESULTS --------------------------<br>";
  echo $allTestor->warnings_as_html_string();
  return $allTestor->did_pass_all_tests();
}

// test_all();
?>
