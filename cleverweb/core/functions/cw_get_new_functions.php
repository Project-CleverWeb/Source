<?php
// Checks for all requested functions
// Will report each funtion that is not found
// If null then returns "value is null"
function CW_Get_New_Functions ($Functions){
  if(CW_Is_Null($Functions)===true){
    return "Value in CW_Get_New_Functions() is null";
  }
  else{
    if(CW_Is_Array($Functions)===true){	
      foreach ($Functions as $Function){
        if(function_exists("$Function")){
          // Do Nothing
        }
        else{
          CW_Get_New_Function("$Function");
        }
      }
    }
    else{
      CW_Get_New_Function("$Functions");
    }
  }
}
?>