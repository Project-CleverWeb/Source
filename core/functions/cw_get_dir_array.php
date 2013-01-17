<?php
// Gets A list of directories and puts it into a array
// PHP 4,5
CW_Get_functions(array("scandir"));
function CW_Get_Dir_Array($dir=NULL){
  if($dir==NULL){
    $list = scandir(".");
  }
  else{
    $list = scandir($dir);
  }
  foreach($list as $dir){
    if(strstr($dir,".")===false){
	  $output[] = $dir;
	}
  }
  return $output;
}
?>