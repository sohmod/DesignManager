<?php
   // Edit upload location here
   $destination_path = getcwd().DIRECTORY_SEPARATOR;  //

   $result = 0;
   if ($_POST['acode']=="5314917"){
   $target_path = $destination_path . "container_upload/" .basename( $_FILES['myfile']['name']);}

   if(@move_uploaded_file($_FILES['myfile']['tmp_name'], $target_path) ) {
      $result = 1;
   }
   
   sleep(1);
?>

<script language="javascript" type="text/javascript">window.top.window.stopUpload(<?php echo $result; ?>);</script>   
