<html>
<head>
<?php
  include ("hippo_ajax.php");
?>
</head>
<body>
<?php
  $fobj = new hippo_ajax();
  
  $dataSource1 ='hippo_ajax_exec.php?test1=David';
  $dataSource2 ='hippo_ajax_exec.php?test2=Lanz';
  
  echo $fobj->add_get_link('link1', 'Ajax GET Method', $dataSource1, 'showDiv1');
  echo '<br>';
  echo $fobj->add_post_link('link2', 'Ajax POST Method', $dataSource2, 'showDiv2');
?>
<div id="showDiv1"></div>
<div id="showDiv2"></div>

</body>
</html>