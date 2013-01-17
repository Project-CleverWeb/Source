<?php
cw_get_function("cw_get_ext");
cw_get_function("cw_filename");
function cw_filepath($file_string=NULL){
  if($file_string==NULL){
    $file_string = $_SERVER['DOCUMENT_ROOT'].$_SERVER['REQUEST_URI'];
  }
  if(strstr($file_string,"?")==true){
    $query = strstr($file_string,"?");
	$file_string = str_replace($query,"",$file_string);
  }
  $file_path = str_replace(cw_filename().".".cw_get_ext(),"",$file_string);
  return $file_path;
}
?>