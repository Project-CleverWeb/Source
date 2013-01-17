
<?php
class cw_error{
  // defines the error within the function
  public function msg($type=NULL,$function=NULL,$msg=NULL){
	if($type==NULL&&$function==NULL&&$msg==NULL){
	  echo "Error Function Misconfigured! You Must Select an Error Type";
	  die;
	}
	if(strlen($msg)>0){
	  $msg = "<font style='color:#0000ff'>Message</font>: ".$msg;
	  $valid = true;
	}
	$types = array(
	  "bool","invalid","num",
	  "alphanum","letters","char"
	);
	foreach($types as $err){
	  if(stristr($type,$err)){
	    $valid=true;
	  }
	}
	if(!$valid==true){
	  define(cw_err_check, false);
	  echo "Error Function Misconfigured!";
	}
	else{
	  define(cw_error,true,true);
	  define(cw_err_check,true,true);
    }
	if($msg==NULL){
	  $msg="A variable in the function \"<font style='color:#0000ff'>".$function."</font>\" ";
	  if($function==""){
	    $msg="A variable ";
	  }
	  elseif(stristr($type,"bool")){
	    $msg.="should be <font style='color:#d11a1a'>TRUE</font> or <font style='color:#d11a1a'>FALSE</font> but is not";
	  }
	  elseif(stristr($type,"invalid")){
	    $msg.="is <font style='color:#d11a1a'>INVALID</font>";
	  }
	  elseif(stristr($type,"alphanum")){
	    $msg.="should ONLY contain <font style='color:#d11a1a'>LETTERS</font> and <font style='color:#d11a1a'>NUMBERS</font>";
	  }
	  elseif(stristr($type,"num")){
	    $msg.="should ONLY contain <font style='color:#d11a1a'>NUMBERS</font>";
	  }
	  elseif(stristr($type,"letters")){
	    $msg.="should ONLY contain <font style='color:#d11a1a'>LETTERS</font>";
	  }
	  elseif(stristr($type,"char")){
	    $msg.="contains <font style='color:#d11a1a'>INVALID CHARACTERS</font>";
	  }
	  $msg.="!";
	}
	global $_CW;
    $_CW["internal_errors"][]=$msg;
  }
 
  // Validate the error
  public function check(){
    if(cw_err_check==true&&cw_error==true){
      define(cw_err_status,true,true);
	  return true;
	}
  }
  
  // Display The Error
  public function message(){
	global $_CW;
	if(!$this->check()==true){
	  return;
	}
	if(!cw_is_array($_CW["internal_errors"])){
	  $_CW["internal_errors"] = array("Value supplied for errors was not an array!");
	}
	$count = 0;
	echo "<br />\n\r";
	echo "<br />\n\r";
	echo "<br />\n\r";
	echo "<strong>CleverWeb Internal Errors:</strong> <br />\n\r";
    foreach($_CW["internal_errors"] as $error){
	  $count++;
	  echo '[<strong>'.$count.'</strong>] '.$error."<br />\n\r";
	}
	echo "<br />\n\r";
	echo "<br />\n\r";
  }
}

$_CW["error"] = new cw_error;

?>