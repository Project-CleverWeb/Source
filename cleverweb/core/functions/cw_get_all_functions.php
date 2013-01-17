<?php
CW_Get_Functions(array("cw_get_files_array","cw_is_value"));
function CW_Get_All_Functions(){
  $list = CW_Get_Files_Array(cw_path."core/functions");
  foreach($list as $file){
    $function = str_replace(".php","",$file);
	if(strstr($function,".")===false){
	  if(CW_Is_Value($function)===true){
	    $function_list[] = $function;
	  }
	}
  }
  CW_Get_Functions($function_list);
}
?>