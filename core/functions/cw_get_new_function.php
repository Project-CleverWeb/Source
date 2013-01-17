<?php
// Gets a functions file if it does not exist
// Will continue if file isnt found
function CW_Get_New_Function($function_name){
  $file_location = cw_path."userfunctions/php/".$function_name.".php";
  if (file_exists($file_location)){
    include_once($file_location);}
  else { 
    if(CW_Is_Null($function_name)===false){
      echo "[Could not find function \"".$function_name."\"]";
	}
	else{
      echo "[Function is null]";
	}
  }
};
?>