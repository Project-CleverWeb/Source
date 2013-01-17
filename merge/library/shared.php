<?php
/** Set Dafault Timezone (_base_config.php)**/
date_default_timezone_set(TIMEZONE);

/** Start Sessions **/
session_start();

/** Check if environment is development and display errors accordingly **/

function setReporting(){
	error_reporting(E_ALL);
	if( ENVIRONMENT === 'Development'){
		ini_set('display_errors','On');
	}else{
		ini_set('display_errors','Off');
		ini_set('log_errors','On');
		ini_set('error_log',ROOT . DS . 'tmp' . DS . 'logs' . DS . 'errors_-_' . str_replace(' ','_', TODAY) . '.log');
	}
}

/** Check For Magic Quotes and remove if necessary **/
function stripSlashesRecursive($v){
	return (is_array($v)? array_map('stripSlashesRecursive', $v) : stripslashes($v));
}

function removeMagicQuotes(){
	if(get_magic_quotes_gpc()){
		$_GET = stripSlashesRecursive($_GET);
		$_POST = stripSlashesRecursive($_POST);
		$_COOKIE = stripSlashesRecursive($_COOKIE);
	}
}


/** Check For Register Globals and Disable **/

function unregisterGlobals(){
	if(ini_get('register_globals')){
		$a = Array('_SESSION','_POST','_GET','_COOKIE','_REQUEST','_SERVER','_ENV','_FILES');
		foreach($a as $v){
			foreach($GLOBALS[$v] as $k=>$var){
				if($var === $GLOBALS[$k]){
					unset($GLOBALS[$k]);
				}
			}
		}
	}
}

/** Custom Error Handling Function **/
function customError($error_level,$error_message,$error_file,$error_line,$error_context){
	$__errorMeanings = Array(
		'2' => Array('E_WARNING','Non-fatal run-time errors. Execution of the script is not halted'),
		'8' => Array('E_NOTICE','Run-time notices. The script found something that might be an error, but could also happen when running a script normally'),
		'256' => Array('E_USER_ERROR','Fatal user-generated error. This is like an E_ERROR set by the programmer using the PHP function trigger_error()'),
		'512' => Array('E_USER_WARNING','Non-fatal user-generated warning. This is like an E_WARNING set by the programmer using the PHP function trigger_error()'),
		'1024' => Array('E_USER_NOTICE','User-generated notice. This is like an E_NOTICE set by the programmer using the PHP function trigger_error()'),
		'2048' => Array('E_STRICT','Runtime Notice'),
		'4096' => Array('E_RECOVERABLE_ERROR','Catchable fatal error. This is like an E_ERROR but can be caught by a user defined handle (see also set_error_handler())'),
		'8191' => Array('E_ALL','All errors and warnings, except level E_STRICT (E_STRICT will be part of E_ALL as of PHP 6.0)')
	);
	$_meaning = $__errorMeanings[$error_level];
	
	if((int)$error_level > 0){ 
		echo '<h1>Error</h1>' . PHP_EOL;
		echo 'Level: <span style="font-family: Arial;font-size: 16px;">' . $_meaning[0] . '</span><br><span style="font-family: Arial;font-size: 10px;">' . $_meaning[1] . '</span><br><br>' . PHP_EOL;
		echo 'Message: <span style="font-family: Arial;font-size: 16px;">' . $error_message . '</span><br><br>' . PHP_EOL;
		echo 'File: <span style="font-family: Arial;font-size: 16px;">' . $error_file . '</span><br><br>' . PHP_EOL;
		echo 'Line: <span style="font-family: Arial;font-size: 16px;">' . $error_line . '</span><br><br>' . PHP_EOL;
		echo 'Context: <span style="font-family: Arial;font-size: 16px;">' . $error_context . '</span><br><br>' . PHP_EOL;
		echo '<hr>' . PHP_EOL;
		echo '<span style="font-size: 11px;font-family: Arial;font-variant: italic;">Custom Error Message</span> <a href="Javascript: history.go(-1);">Go Back</a><br><br><hr>';
	}
}

/** Autoload Any Classes that are required **/
function __autoload($className){
	if(file_exists(LIB . DS . 'class.' . $className . '.php')){
		require_once(LIB . DS . 'class.' . $className . '.php');
	}else if(file_exists(LIB . DS . '3rdParty' . DS . 'class.' . $className . '.php')){
		require_once(LIB . DS . '3rdParty' . DS . 'class.' . $className . '.php');
	}else if(file_exists(ROOT . DS . 'applications' . DS . APPLICATION . DS . 'class.' . $className . '.php')){
		require_once(ROOT . DS . 'applications' . DS . APPLICATION . DS . 'class.' . $className . '.php');
	}else if(file_exists(ROOT . DS . 'applications' . DS . APPLICATION . DS . 'models' . DS .'class.' . $className . '.php')){
		require_once(ROOT . DS . 'applications' . DS . APPLICATION . DS . 'models' . DS . 'class.' . $className . '.php');
	}else{
		trigger_error('Cannot locate Class "' . $className . '"', E_USER_ERROR);
	}
}





/** Set Custom Error Handling Function **/
set_error_handler("customError");
setReporting();
removeMagicQuotes();
unregisterGlobals();
