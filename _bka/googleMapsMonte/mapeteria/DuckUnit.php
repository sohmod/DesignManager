<?php
/*
 * Created on 19-Apr-2007 by Kaitlin Duck Sherwood
 * PHPUnit required PHP5, and I'm not emotionally prepared to go to 
 * PHP5 yet.  This is a quick&dirty to give me most of the benefits
 * of PHPUnit.
 */


 class DuckUnit
 {
  
   function DuckUnit()
   {
     $this->pass_count = 0;
     $this->fail_count = 0;
   }
   
   function expect_true($aBoolean)
   {
     if($aBoolean)
     {
       $this->pass_count++;
     }
     else
     {
       $this->fail_count++;
     }

   }
   
   function expect_false($aBoolean)
   {
     if(!$aBoolean)
     {
       $this->pass_count++;
     }
     else
     {
       $this->fail_count++;
     }
   }

   
   function get_pass_count()
   {
     return $this->pass_count;
   }
   
   function get_fail_count()
   {
     return $this->fail_count;
   }

    function did_pass_all_tests()
    {
      return ($this->fail_count == 0);
    }


   function warnings_as_html_string()
   {  
     $retCode = "Pass count is ".$this->pass_count.".<br>\n";
     $retCode .= "Fail count is ".$this->fail_count.".<br>\n";
     if ($this->did_pass_all_tests())
     {
       $retCode .= "REJOICE!  All tests passed!<p>\n";
     } 
     else
     {
       $retCode .= "Alas! ".$this->fail_count." TESTS FAILED!!!!!!!!<p>\n";
     }

     $retCode .= "------------------------------------------------<br>\n";
     return $retCode;
   } 
   
   // TODO make sure isn't used any more, then kill
   function as_string()
    {
      echo "deprecated, use warnings_as_html_string()";
      $this->warnings_as_html_string();
    }
 }
 
 
?>
