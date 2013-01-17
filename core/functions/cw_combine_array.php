<?php
// Adds to the end of an array. either can be a string or an array.
// Can put 2 strings into a new array
function CW_Combine_Array($array,$string){
  if(CW_Is_Null($array)===false){
    if(CW_Is_Null($string)===false){
      if(CW_Is_Array($array)===false){
	    $array = array("$array");
	  }
	  if(CW_Is_Array($string)===false){
	    $string = array("$string");
	  }
	  foreach ($string as $add_item){
	    $array[] = $add_item;
	  }
	  return $array;
    }
	else{echo "[ERROR: Missing String/Array in CW_Add_To_Array()]";}
  }
  else{echo "[ERROR: Missing String/Array in CW_Add_To_Array()]";}
}
?>