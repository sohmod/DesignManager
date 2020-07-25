<?php
/*
 * Created on 14-Apr-2007 by Kaitlin Duck Sherwood
 * This stores info that is specific to each of the configurations where
 * I develop/run.
 */
 
 // TODO someday I should make getters for all the interesting variables,
 //      and/or make all of these static methods
 
 Class PerHostData {

  
  function PerHostData()
  {
    
    $host_name = "tmp";
   
    $this->mapeteria_url = "http://maps.webfoot.com/mapeteria";
 
    if ("puddle" == $host_name)
    {
      $this->url_base = "http://localhost/tmp/polygons";
      $this->filesystem_base = "/var/www/tmp/polygons";
      $this->sidebar = "../sidebar.html";
      $this->google_key = "ABQIAAAALsbrXkNBZjolp78Clt0BSRT2yXp_ZAY8_ufC3CFXhHIE1NvwkxTHuiFsXtjHEVKYg28edtODf0UYEw";
      return;
    }
 
    if ("tmp" == $host_name)
    {
      $this->url_base = "http://tmp.webfoot.com/polygons";
      $this->filesystem_base = "/home/ducky/tmp.webfoot.com/polygons";
      $this->sidebar = "/home/ducky/maps.webfoot.com/sidebar.html";
      $this->google_key = "ABQIAAAALsbrXkNBZjolp78Clt0BSRR8p52BpBdb1QVC-hp_COh_Wy8aQhRrfwALzVc8RQZidw9QaNqDfW2-Zg";
      return;
    }
 
    if ("maps" == $host_name)
    {
      $this->url_base = "http://maps.webfoot.com/mapeteria";
      $this->filesystem_base = "/home/ducky/maps.webfoot.com/mapeteria";
      $this->sidebar = "../sidebar.html";
      $this->google_key = "ABQIAAAALsbrXkNBZjolp78Clt0BSRQ9P4bVv84hkkOaE0Tf-CNn3-0cwxRMYCBtcuLioN1dD848yn52eTqhZA";
      return;
    }
 
    else
    {
      echo "Uh-oh, I don't know where I am!!";
      exit(0);
    }
    
  }
  
  function &get_instance() {
    static $me;

    if (is_object($me) == true) 
    {
     return $me;
    }

    $me = new PerHostData;
    return $me;
  }




}

 
 
?>
