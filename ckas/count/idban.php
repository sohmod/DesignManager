<? 
// create count.txt, embbed the script to your .php file 
?> 
was tracked <? 
$file = fopen("/location/of/count.txt","r+"); 
$counter = fread($file, filesize("/location/of/count.txt")); 
fclose($file); 
$counter +=1; 
$file = fopen("/count/count.txt","w+"); 
fputs($file, $counter); 
fclose($file); 
?> 
<? include("/count/count.txt"); ?> visitors. 
