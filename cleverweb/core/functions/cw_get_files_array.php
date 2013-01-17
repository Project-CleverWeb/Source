<?php
// Gets A list of files and puts it into a array
// Ignores "." ".." ".htpasswd" and ".htaccess"
// PHP 4,5
CW_Get_functions(array("scandir"));
function CW_Get_Files_Array($dir=NULL){
  if($dir==NULL){
    $list = scandir(".");
  }
  else{
    $list = scandir($dir);
  }
  foreach($list as $file){
    if(strstr($file,".")===false||$file == "."||$file == ".."||$file == ".htaccess"||$file == ".htpasswd"){}
	else{
	  $output[] = $file;  
	}
  }
  return $output;
}
?>