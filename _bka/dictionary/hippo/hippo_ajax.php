<?php
/* hippo_ajax class by DavidLanz
/******************************************************************************
**  File        :  hippo_ajax.php                                            **
**  Class name  :  hippo_ajax                                                **
**  Author      :  DavidLanz (davidlanz@gmail.com)                           **
**                                                                           **
**  Description :  This class is provide Ajax POST/GET link in the web page  **
**                 and seperate index/PHP exec/JavaScript in 3 files.        **
**                                                                           **
**  Date          :  16/06/2006                                              **
**  Last Modified :  09/10/2006                                              **
**                                                                           **
**  PHP Version   :  4.x/5.x                                                 **
******************************************************************************/
echo '<script language=JavaScript src=hippo_ajax.js></script>';

class hippo_ajax
{
  var $err_str;
  
  /* Constructor */
  function hippo_ajax()
  {
    $this->init();
  }
  
  function init()
  {
    return true;
  }
  
  function trimStr($str)
  {
    return trim($str);
  }
  
  /*
  $id: identifier for hippo_ajax_exec.php
  $prefix: Link Name
  $urlProcess: location of hippo_ajax_exec.php
  $targetDiv: effect DIV Layer
  */
  function add_get_link($id, $prefix, $urlProcess, $targetDiv, $ifLoading=false)
  {
    if($id=='' || $urlProcess=='' || $targetDiv=='')
    {
      $this->err_str = 'add_get_link() method must need valid variables.';
      return false;
    }
    else
    {
      $urlProcess = $this->trimStr($urlProcess);
      $targetDiv = $this->trimStr($targetDiv);
      $aryTmp = split('\?', $urlProcess);
      $aryParse[$id][0]=$aryTmp[1];
      $urlProcess = $aryTmp[0].'?idParse='.$id.'&'.$aryTmp[1];
      return '<a href=javascript:getData(\''.$urlProcess.'\',\''.$targetDiv.'\',\''.$ifLoading.'\')>'.$prefix.'</a>';
    }
  }
  
  function add_post_link($id, $prefix, $urlProcess, $targetDiv, $ifLoading=false)
  {
     if($id=='' || $urlProcess=='' || $targetDiv=='')
    {
      $this->err_str = 'add_post_link() method must need valid variables.';
      return false;
    }
    else
    {
      $urlProcess = $this->trimStr($urlProcess);
      $targetDiv = $this->trimStr($targetDiv);
      $aryTmp = split('\?', $urlProcess);
      $aryParse[$id][0]=$aryTmp[1];
      $urlProcess = $aryTmp[0].'?&idParse='.$id.'&'.$aryTmp[1];
      return '<a href=javascript:postData(\''.$urlProcess.'\',\''.$targetDiv.'\',\''.$ifLoading.'\')>'.$prefix.'</a>';
    }
  }
  
  function show_error()
  {
    return $this->err_str;
  } 
}

?>