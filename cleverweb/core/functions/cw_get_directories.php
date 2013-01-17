<?php
// Gets A list of directories and lists each
// PHP 4,5
CW_Get_functions(array("scandir"));
function CW_Get_Directories($dir=NULL){
  if($dir==NULL){
    $list = scandir(".");
  }
  else{
    $list = scandir($dir);
  }
  foreach($list as $dir){
    if(strstr($dir,".")===false){
	  echo $dir." \n";
	}
  }
}
?>