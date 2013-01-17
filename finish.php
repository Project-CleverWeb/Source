<?php
/**
 * This page clears all the loose data
 */

unset($_CW["mysql_conn"]);

function cw_clear_array($array=NULL,$randerror=NULL){
  $replace = "";
  if(!isset($array)){
    return;
  }
  if(!is_array($array)){
    cw_error();
  }
  foreach($array as $key => $value){
    $array[$key] = $replace;
  }
}
cw_clear_array($_CW,true);
cw_clear_array($_SERVER,true);
cw_clear_array($_GET,true);
cw_clear_array($_POST,true);
cw_clear_array($_FILES,true);
cw_clear_array($_REQUEST,true);
cw_clear_array($_SESSION,true);
cw_clear_array($_ENV,true);
cw_clear_array($_COOKIE,true);

// kill everything
die;

?>

hey look im invisible!

