<?php
/*
 * Created on 29-Apr-2007 by Kaitlin Duck Sherwood
 */
 
 // This class is basically a data structure to keep track of
 // warnings.  It is not very exciting.
class WarningsList
{
  function WarningsList()
  {
    $this->warningsList = array();
  }
  
  function add_warning($aWarning)
  {
    array_push($this->warningsList, $aWarning);
  }

  
  function pop_warning()
  {
    $warning = array_pop($this->warningsList);
    return $warning;
  }
  
    
  // This tacks an additional string onto the end of the last warning.
  function append_warning($aWarning)
  {
    $warning = $this->pop_warning();
    $warning .= $aWarning;
    $this->add_warning($warning);
  }
  
  
  function as_html_string()
  {
    log3("starting WarningsList->as_html_string()<p>\n");
    $warnings = "";
    if($this->warningsList == null)
    {
      return;
    }
    
    foreach ($this->warningsList as $warning)
    {
      $warnings .= $warning."<br>\n";
    }
    return $warnings;
  }
}

function testWarningsList()
{
  echo "testing WarningsList<p>\n";
  include 'DuckUnit.php';
  include 'duckUtils.php';
  $testor = new DuckUnit();  
  
  $warnings = new WarningsList();
  $warnings->add_warning("a");
  $warnings->add_warning("bb bb");
  $warnings->add_warning("cc cc");
  $warnings->add_warning("d");
  $warnings->add_warning("e");
  $warnings->add_warning("f");
  
  $testor->expect_true($warnings->pop_warning() == "f");  
  $testor->expect_true($warnings->pop_warning() == "e");
  $testor->expect_true($warnings->pop_warning() == "d");
  $testor->expect_true($warnings->pop_warning() == "cc cc");
  $testor->expect_true($warnings->as_html_string() == "a<br>\nbb bb<br>\n");
  
  $warnings->add_warning("yy");
  $warnings->append_warning("zzzz");
  $testor->expect_true($warnings->pop_warning() == "yyzzzz");
  $warnings->add_warning("mm mm mm ");
  $warnings->append_warning("nn");
  $testor->expect_true($warnings->pop_warning() == "mm mm mm nn");

  echo $testor->warnings_as_html_string();
}

// testWarningsList();
?>
