<?php
/*
 * Created on 8-Apr-2007 by Kaitlin Duck Sherwood
 */
 
$GLOBALS["LOG_THRESHOLD"] = 0;
$GLOBALS["debug"] = false;
$GLOBALS["css"] = "http://webfoot.com/blog.css";
if($GLOBALS["debug"])
{
  print_plain_text_header();
}

// String scary characters out of a URL
function make_string_url_safe($aString)
{
  return preg_replace ('/[\\\#;!\"\'\|\]\[{\}\>\<\*]*/', "", $aString);
}
 
// ============================ 
// function get_query_variable
// Return the value of the parameter in the query string/POST data
// that has the name $varName.  Note that when running under Eclipse
// with the PHP extension, I haven't been able to figure out how
// to get the query string, so I'm cheating and using the ENV for
// that variable name.
function get_query_variable($varName)
{
  $value = htmlspecialchars($_REQUEST[$varName]);
  // The following is for debug mode, when using Eclipse
  if (is_null($value))
  {
     $value = htmlspecialchars($_ENV[$varName]);
  }
  return $value;
}

// ============================ 
// function print_html_error does the magic to get an error message
// printed out to a browser instead of embedded in the KML file.
// in: $aString is a string to print out as an error message
// out: nothing
// SIDE EFFECT: error message to stdout; execution halts
function print_html_error($aString)
{
  echo "<h1>Error</h1>\n";
  echo $aString;
  exit(0);
}

// ============================ 
// function fetch_url
//   does the magic to fetch the page at a given URL 
//   (with an implicit check to make sure that it is safe, 
//   thanks to PHP), hande errors, etc.
// in: a URL
// out: the text of the body of the page that is at that URL
function fetch_url($url)
{
  log2("fetching url $url.");
  $ch = curl_init();
  $timeout = 1; // set to zero for no timeout
  curl_setopt ($ch, CURLOPT_URL, $url);
  curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  $contents = curl_exec($ch);

  // TODO
  // TODO
  // TODO
  // TODO Why am I not seeing an error from curl_error when a page
  // TODO isn't found?  It will give an error if the DOMAIN isn't 
  // TODO found, but not if a page is 404.
  // TODO
  // TODO
  if (is_null($contents) || (empty($contents)) || (curl_error($ch)))
  {
    $a = "There was some problem with fetching $url.\n".curl_error($ch);
    print_html_error($a);
  }

  curl_close($ch);
  return $contents;
}



// ============================ 
// function get_min_max_of_array
// Get both the min and max of an array at once.
// in: $anArray  an array 
// out: $minValue, $maxValue  min/max of all the values in $anArray
function get_min_max_of_array($anArray)
{
  $minValue = NULL;
  $maxValue = NULL;
  foreach ($anArray as $value)
  {
    list ($minValue, $maxValue) = min_max($value, $minValue, $maxValue);  
  }
  return array ($minValue, $maxValue);
}
  
// ============================ 
// function min_max
// Get the min and max of previous min/max and a new value
// in: $minValue/$maxValue  old min and max
//     $value    a new value which might replace min or max
// out: $minValue/$maxValue  the new min and max
function min_max($value, $minValue, $maxValue)
{
  {
    // echo "<p>0: value is $value<br>\n";
    if ((is_null($minValue)) && (!is_null($value)))
    {
      $minValue = $value;
      $maxValue = $value;
    }
    else
    {
      $minValue = min($minValue, $value);
      $maxValue = max($maxValue, $value);
    }
  }
  return array ($minValue, $maxValue);
}

// ============================ 
// function array_of_ratios
// in: $topArray, $bottomArray
// out: array where array[i] = topArray[i]/bottomArray[i]
//      for all sensible values of bottomArray[i]
// TODO is there a nice map function that will do this more elegantly?
function array_of_ratios($topArray, $bottomArray)
{
  foreach ($bottomArray as $key => $bottom)
  {
    if(!is_null($topArray[$key]) && ($bottom!= 0))
    {
      log3("top array of $key is ".$topArray[$key]);
      $values[$key] = $topArray[$key] / $bottom;
      // echo "top $key: $topArray[$key], bot: $bottomArray[$key], val: $values[$key]\n";
    }
  }
  if (0 == sizeof($values))
  {
    print_html_error("There were no valid divisors!");
  }
  return $values;
}

// ===============================
// function boolean_to_yes_or_no
// in: $aBoolean
// out: nothing
// SIDE EFFECT: "yes" or "no" will be printed to stdout
// This is mostly something useful for printing debugging output.
// It's nicer than 0 and 1.
function boolean_to_yes_or_no($aBoolean)
{
  if($aBoolean)
  {
    return "yes";
  }
  else
  {
    return "no";
  }
}

// ===============================
// function debug_log prints out $aString if the 
// global $LOG_THRESHOLD is higher than $logLevel.
// This is mostly for debugging, and is almost 
// never called directly.  Rather log1(), log2(),
// and log3() use this function.
// in: $aString, the string to be printed
//     $logLevel, a number that shows at what threshold this
//     should be printed
// out: nothing
// SIDE EFFECT: $aString might get printed to stdout
function debug_log($logLevel, $aString)
{
  global $LOG_THRESHOLD;

  if ($logLevel < $GLOBALS["LOG_THRESHOLD"])
  {
    echo "$aString<br>\n";
  }
}

function log1($aString)
{
  debug_log(1, $aString);
}

function log2($aString)
{
  debug_log(2, $aString);
}

function log3($aString)
{
  debug_log(3, $aString);
}


// ===============================
// function print_plain_text_header() prints out the 
// necessary magic to make the browser recognize the
// subsequent output as text/plain instead of text/html.
// This is only for debugging.
// in: nothing
// out: nothing
// SIDE EFFECT: an HTTP header gets printed to stdout
function print_plain_text_header()
{
  header("Content-Type: text/plain; charset=utf8");  // for debugging
}

// false_or_null is something I was using for testing how PHP worked.
// It might conceivably be useful in the future.
function false_or_null($foo)
{
  if(is_null($foo))
  {
    return "null";
  }
  
  if(empty($foo))
  {
    return "false";
  }
  
  return $foo;
}

function test_false_or_null()
{
  
  $testor = new DuckUnit();  
  $testor->expect_false(false_or_null("") == "null");
  $testor->expect_true(false_or_null(null) == "null");
  $testor->expect_true(false_or_null(false) == "false");
  $testor->expect_true(false_or_null(true) == 1);
  $testor->expect_true(false_or_null(17) == 17);
  
  // This is here purely because I keep forgetting 
  // how to test for empty.
  $testor->expect_true(empty($trhromblemeister));
  $foo = null;
  $testor->expect_true(empty($foo));

  echo $testor->warnings_as_html_string();
  return $testor->did_pass_all_tests();
}

function test_array_of_ratios()
{
  
  $testor = new DuckUnit();  
  $numerator = array(3, 8, 15, 33.3, 1);
  $denominator = array(1, 2, 3, 11.1, 2);
  $ratio = array_of_ratios($numerator, $denominator);
  $testor->expect_true($ratio[0] == 3);
  $testor->expect_true($ratio[1] == 4);
  $testor->expect_true($ratio[2] == 5);
  $testor->expect_true($ratio[3] == 3.0);
  $testor->expect_true($ratio[4] == 0.5);
     
  echo $testor->warnings_as_html_string();
  return $testor->did_pass_all_tests();
}

function test_fetch_url()
{ 
  $testor = new DuckUnit();  
  $url = "http://maps.webfoot.com/mapeteria/testcases/fetch_url.txt";
  $body = fetch_url($url);
  $testor->expect_true($body == "This is a test.");
  
  $url = "http://google.com/this.does.not.exist";
  $body = fetch_url($url);
  echo "The fetch of $url should have failed!\n";
  $testor->expect_false($body == "");
  
  $url = "http://alskdjfalsdjfalskjfdalsj.xx/this.does.not.exist";
  $body = fetch_url($url);
  // The above will die, so we won't get to this line.'
  $testor->expect_true($body == "error blah");
     
  echo $testor->warnings_as_html_string();
  return $testor->did_pass_all_tests();
}

function test_all_duckUtils()
{
  include 'DuckUnit.php';
  print_plain_text_header();
  
  $allTestor = new DuckUnit();  
  $allTestor->expect_true(test_false_or_null()); 
  $allTestor->expect_true(test_array_of_ratios());


  echo "-------------------- OVERALL RESULTS --------------------------\n";
  echo $allTestor->warnings_as_html_string();
  echo "There should be an error in the next test which makes this set of tests abort.\n\n";

  
  $allTestor->expect_true(test_fetch_url());
  
  // We won't get to this line.
  return $allTestor->did_pass_all_tests();
}


// test_all_duckUtils();

?>
