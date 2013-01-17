<?php
function cw_get_ext($file_path=NULL){
  if($file_path==NULL||$file_path==
  stristr($file_path,str_replace(strstr(
  $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],"?"),"",
  $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']))){
    $file_path = basename($_SERVER['PHP_SELF']);
  }
  if(strstr($file_path,"?")==true){
    $query = strstr($file_path,"?");
	$file_path = str_replace($query,"",$file_path);
  }
  $file_ext = strrchr($file_path, '.');
  $file_ext = str_replace(".","",$file_ext);
  return $file_ext;
}
?>