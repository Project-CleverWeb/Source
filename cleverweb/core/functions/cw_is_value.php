<?php
// returns true if $string is anything but NULL, 0, false, true, or is an empty sting.
// arrays not supported
// NOTE: if string only contains "0" then it will return false.
function CW_Is_Value($string){
  if($string>NULL){
    if($string != false){
	  if($string === true){
	    return false;
	  }
	  else{
		if($string != ""){
		  return true;
		}
		else{
		return false;
		}
	  }
	}
	else{
	  return false;
	}
  }
  else{
    return false;
  }
}
?>