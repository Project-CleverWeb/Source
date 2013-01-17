<?php
cw_get_function("cw_get_ext");
function cw_filename($file_path=NULL){
  if($file_path==NULL){
    $file_path = basename($_SERVER['PHP_SELF']);
  }
  if(strstr($file_path,"?")==true){
    $query = strstr($file_path,"?");
	$file_path = str_replace($query,"",$file_path);
  }
  $ext = ".".cw_get_ext($file_path);
  return basename($file_path,$ext);
}
?>