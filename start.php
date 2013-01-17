<?php
// This page simply checks for errors then if none exist starts CleverWeb.
// The error check is best done through the URI so that no cookies are needed.
// Wont allow error pages to be called manually unless CW clears it.


// find set.php
$temp['dir'] = __DIR__;
$temp['find'] = stripos($temp['dir'],'public_html/');
if(!$temp['find']==FALSE){
  $temp['count'] = 0;
  while($temp['count']<$temp['find']){
    $temp['paths']['root'] .= $temp['dir'][$temp['count']++];
  }
  $temp['paths']['public_html'] = $temp['paths']['root'].'public_html/';
  $temp['paths']['cleverweb'] = $temp['dir'].'/';
  $temp['find'] = stripos($temp['paths']['cleverweb'],'cleverweb/');
  if(!$temp['find']==FALSE){
    $temp['count'] = 0;
    while($temp['count']<$temp['find']){
      $temp['paths']['cw_root'] .= $temp['dir'][$temp['count']++];
    }
  }
  else{
    $temp['find'] = stripos($temp['dir'],dirname($_SERVER['PHP_SELF']));
    $temp['count'] = 0;
    while($temp['count']<$temp['find']){
      $temp['paths']['cw_root'] .= $temp['dir'][$temp['count']++];
    }
    $temp['paths']['cw_root'] .= '/';
  }
  foreach($temp['paths'] as $temp['foreach']){
    if(file_exists($temp['foreach'].'set.php')){
      $temp['paths']['config'] = $temp['foreach'].'set.php';
      break;
    }
    if(file_exists($temp['foreach'].'config.php')){
      $temp['paths']['config'] = $temp['foreach'].'config.php';
      break;
    }
  }
  if(!strlen($temp['paths']['config'])>0){
    // error
    foreach($temp['paths'] as $temp['key']=>$temp['foreach']){
      if(!$temp['foreach']===FALSE){
        $exit .= $temp['key']." => ".$temp['foreach'].PHP_EOL;
      }
    }
    exit(
      "Could not find config file under filenames 'set.php' OR 'config.php' in:".PHP_EOL.
      $exit.PHP_EOL."Please make sure you have not deleted/renamed this file."
    );
  }
  else{
    require_once($temp['paths']['config']);
    $_CW['paths'] = $temp['paths'];
    unset($temp);
  }
}
else{
  // error
  exit('$_CW[\'path\'] must be set, cannot find folder named "public_html"');
}


// set path to CleverWeb
if(strtolower($_CW['path'])=='default'){
  $_CW['path'] = __DIR__;
}

/**
 * Calls a known class into action
 * 
 * This function/variable calls known CleverWeb classes if they
 * have not been loaded yet. Classes that have already been
 * loaded are ignored (function will still return true). Any
 * classes that aren't known by the CleverWeb core, result in
 * the function returning FALSE.
 * 
 * @param String $class_name Name of the class you want to
 * attempt to call.
 * @return Bool Returns TRUE if all classes are successfully
 * called. Returns FALSE otherwise.
 */
function cw_get_class($class_name){
  
}


// get error handler
if(file_exists('./core/startup/php_error_handler.php')&&!$_CW['settings']['php_error_handler']==FALSE){
  require_once('./core/startup/php_error_handler.php');
}
elseif($_CW['settings']['php_error_handler']==FALSE){
}
else{
  exit('The PHP Error Handler (php_error_handler.php) was not found in: '.$_CW['path'].'core/startup/');
}
if(file_exists('./core/startup/cw_error_handler.php')){
  require_once('./core/startup/cw_error_handler.php');
}
else{
  exit('The CleverWeb Error Handler (cw_error_handler.php) was not found in: '.$_CW['path'].'core/startup/');
}

// fetch session management
if(file_exists('./core/startup/session_manager.php')){
  require_once('./core/startup/session_manager.php');
}
else{
  exit('The Session Manager file (session_manager.php) was not found in: '.$_CW['path'].'core/startup/');
}





// start init
if(file_exists('./init.php')){
  require_once('./init.php');
}
else{
  exit('The Initialization file (init.php) was not found in: '.$_CW['path']);
}














/***Magic Starts Here***/
if(!isset($_COOKIE[ini_get('session.name')])){
  session_start();
}

$_CW["errors"]=$_GET["err"];
$_CW["err_status"] = $_SERVER["REDIRECT_STATUS"];
if(isset($_CW["error"])){
  if($_CW["error"]->cw_err_check()){
    $_CW["err_status"]="cw_errored";
  }
}
if(!$_CW["errors"]||$_CW["err_status"]==200){ // 200 means "no server errors"
  /**
   * Under Construction?
   */
  $_CW["under_construction"]=true;
  if($_CW["under_construction"]==true){
    if(!$_CW["uc_exclude"]==true){
      include($_CW["path"]."docs/under_construction.php");
      die;
    }
  }
  if(file_exists("config.php")){ 
    require_once("config.php");
	require_once("./cleverweb/core2.php");
  }
  elseif(file_exists("./../../config.php")){ 
    require_once("./../../config.php");
	require_once("./../core2.php");
  }
}
// if availible it will use the core so that a more advanced error page may be displayed.
elseif(file_exists("./cleverweb/core2.php")){ 
  require_once("./cleverweb/core2.php");
  if(file_exists(cw_path."docs/error.php")){
    require_once(cw_path."docs/error.php");
  }
  die;
}
elseif(file_exists("./cleverweb/docs/error.php")){
  require_once("./cleverweb/docs/error.php");
  die;
}
else{
  echo "No error document found!<br />Additionally there was an error resulting in the error code: ".$_CW["errors"];
  die;
}

?>