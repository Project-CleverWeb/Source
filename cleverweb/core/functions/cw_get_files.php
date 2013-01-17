<?php
// Gets A list of directories and lists each
// PHP 4,5
CW_Get_functions(array("scandir"));
function CW_Get_Files($dir=NULL){
  if($dir==NULL){
    $list = scandir(".");
  }
  else{
    $list = scandir($dir);
  }
  foreach($list as $file){
    if(strstr($file,".")===false||$file == "."||$file == ".."||$file == ".htaccess"||$file == ".htpasswd"){}
	else{
	  echo $file." \n";  
	}
  }
}
?>