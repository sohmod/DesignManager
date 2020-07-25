<?php
  /* Requires */
  require('hippo_ajax_func.php');
  
  /* Parsing idParse */
  $idParse=$_GET['idParse'];
  if(isset($idParse))
  {
    switch($idParse)
    {
      case 'link1':
        echo $_GET['test1'];
        break;
      case 'link2':
        echo $_GET['test2'];
        break;
      default:
        break;
    }
  }
?>
