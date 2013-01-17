<?php
/*
This Page will contain all the core HOOKS and not the actual core elements. Things will be hooked in as they are needed to save on loading time. This page however WILL contain some basic core functions, cookie handlers, session handlers and variables.
*/

/*
USER NOTES
-----------------------
NOTE 1:
Edit this file at your own risk!(supply redownload link)
*/

/**
 * Compat for vars
 */
if(!isset($_SERVER)){
  $_SERVER=$HTTP_SERVER_VARS;
}
if(!isset($_GET)){
  $_GET=$HTTP_GET_VARS;
}
if(!isset($_POST)){
  $_POST=$HTTP_POST_VARS;
}
if(!isset($_FILES)){
  $_FILES=$HTTP_POST_FILES;
}



/**
 * Error Handler
 */
require_once("error.php");
function cw_randerror($all=NULL){
  $errors = array(
    "Something was here, but I don't know where it went.",
	"An error happened when I produced this error.",
	"Are you sure you want to breath?",
	"Congrats you're pregnant!",
	"It's OK... This is an error.",
	"It's been a while since the last error, here is a free one.",
	"We haven't detected a keyboard, press any key to continue.",
	"You need a social life, get a tan and get some friends.",
	"Someday you will get another error message just like this.",
	"(I am speechless)",
	"We have detected that you have an operating system, you should remove it.",
	"Well.... you messed up.",
	"ERROR: There was no error.",
	"Press ALT and F4 until you get a hint (your browser may crash).",
	"I don't think that your computer is on.",
	"It's gone.... LIKE MAGIC!!!",
	"your mom",
	"Check back here in about 10,000 years. I'll be done then.",
	"This is not a good message.",
	"You TV seems lonely.",
	"oops!",
	"At least one other person has seen this message.",
	"Get up, run until you get followed by a news channel.... or you break a leg.",
	"You have been looking at you computer to long... so your seeing this error instead of something else.",
	"Tip:",
	"Find the triangle-shaped key on your keyboard.",
	"That's what she said.",
	"Press the back-button to see the next page.",
	"FAIL",
	"ERROR: Please install the English language on your computer.",
	"Please activate your copy of Norton Virus Downloader.",
	"Do you know where you children are?",
	"There is not enough time to tell you the time, so we gave you this error at an unknown time. Also my name is Kat and I am a 12 year school girl, that really really likes the color yellow.",
	"ERROR: You are trying to do something.... stop it!",
	"You need to install Microsoft Paint on a Mac in order to continue.",
	"I detect good feelings aimed at iPhones. PROCLAIM ANDROID AS RULER OVER ALL PHONES IN ORDER TO CONTINUE.",
	"ERROR: NOT MY FAULT!",
	"Do these pants make me look fat?",
	"Fix this error by smashing your screen with a hammer.",
	"I found an untitled book, I am now reading the title.",
	// meme
	"The sum of the universe is 42",
	"IT'S OVER 9000!",
	"Oh it's you, I thought I smelled body glitter.",
	"I'm gonna call you Big Green.",
	"Must have been made out of something weak, like paper mache...or Raditz.",
	"Holy black on a Popo!",
	"But Vegeta... Trix are for kids.",
	"Quack",
	"Are you a Yoshi?"
	
  );
  if(stristr($all,"all")){
    return $errors;
  }
  $num = 0;
  foreach($errors as $nothing){
    $num++;
  }
  $msg = $errors[mt_rand(0,$num)];
  return $msg;
}


/**
 * Configure
 */
// Grabs users config file and starts MySQL.
if(!function_exists("cw_path")){
  require_once("config.php");
}
if(file_exists(cw_path."core/general/mobile_detect.php")){
  require_once(cw_path."core/general/mobile_detect.php");
}
if(file_exists(cw_path."core/general/browser_detect.php")){
  require_once(cw_path."core/general/browser_detect.php");
}
if(file_exists(cw_path."core/general/bots.php")){
  require_once(cw_path."core/general/bots.php");
}
if(file_exists(cw_path."core/general/trackvars.php")){
  require_once(cw_path."core/general/trackvars.php");
}
// headers sent after determining the device/browser
if(file_exists(cw_path."core/general/headers.php")){
  require_once(cw_path."core/general/headers.php");
}



/**
 * Googlebot and Friends
 */
class cw_bot{
  
  private function name($bool=NULL){
    // Is it Google?
	function googlebot() {
      if(stristr($_SERVER["HTTP_USER_AGENT"],"googlebot")){
        return true;
	  }
	  else{
        return false;
	  }
    }
    
	// This figures out which bot
	// Returns either the bots name or "false"
	if(stristr($_SERVER["HTTP_USER_AGENT"],"bot")){
      if(googlebot()==true){
	    if($bool=="bool"){
	      return true;
	    }
        return "googlebot";
      }
	  else {
	    if($bool=="bool"){
	      return true;
	    }
	    $bot=1;
	  }
    }
    else{
      if(stristr($_SERVER["HTTP_USER_AGENT"],"yahoo")){
	    return "yahoo";
	  }
	  // For a user-agent only I can produce. Useless to anyone outside of CleverWeb.
	  elseif(stristr($_SERVER["HTTP_USER_AGENT"],"cleverweb")){
	    if($bool=="bool"){
		  // any user with this should not be given special permissions.
	      return false;
	    }
	    return "cleverweb";
      }
	  elseif($bot==1){
	    if($bool=="bool"){
	      return true;
	    }
	    return "bot";
      }
	  else{
	    return false;
	  }
    }
  }
  
  private function type(){
    // is mobile?
  }
  
  // Time to get the results in a clean array
  private function bot_array($bot_name,$bot_type){
    if($bot_name==false){
	  return array(
	    'name' => false,
		'type' => false
	  );
	}
	if(!$bot_type=="mobile"){
	  $bot_type = "desktop";
	}
	return array(
	  'name' => $bot_name,
	  'type' => $bot_type
	);
  }
  
  // Now return the results
  private function bot($bot_array){
    // return
  }
}



/**
 * Cookies
 */
// not yet built



/**
 * Functions
 */
// Only functions that are used on all or nearly all pages should be listed here
$_CW["core_function_list"] = array(
// Each item listed here MUST have a matching file in ./core/functions
  "cw_get_functions","cw_page_title","cw_link","cw_get_new_function",
  "cw_get_new_functions","cw_date","cw_get_all_functions","cw_use_theme",
  "cw_define_security","cw_rot47"
);



// Checks to see if a value is greater than null
function CW_Is_Null($string){
  if($string>NULL){
    return false;
  }
  else{
    return true;
  }
};


// Checks if a sting is an array. [faster than is_array()]
function CW_Is_Array($string){
  if ( (array) $string !== $string ) { 
    return false; 
} else { 
    return true; 
} 
};

// Gets a functions file if it does not exist
// Will abort if file isnt found
function CW_Get_Function($function_name){
  strtolower($function_name);
  if (function_exists("$function_name")){
    // Do Nothing
  }
  else{
	$file_location = cw_path."core/functions/".$function_name.".php";
    if (file_exists($file_location)){
      include_once($file_location);}
    else {
      echo "Could not find function file named \"".$function_name."\"<br />\nPage Aborted";die;}
  }
};

// Checks for all needed functions
// Will abort page if ANY funtion is not found
function CW_Functions_Check ($Functions_Array){
  if(!cw_is_array($Functions_Array)){
    die("Invalid Array supplied in \"cw_get_functions\"");
  }
  foreach ($Functions_Array as $Function){
    if(function_exists("$Function")){
      // Do Nothing
    }
    else{
      CW_Get_Function("$Function");
    }
  }
}


// Gets all core functions
if(isset($_CW["core_function_list"])){
  CW_Functions_Check ($_CW["core_function_list"]);
}
// Gets user functions if the file exists.
if(file_exists(cw_path."admin/function_list.php")){
  include_once(cw_path."admin/function_list.php");
}

/**
 * Hooks
 */
echo
str_repeat("\n",50).
CW_ROT47("kP\\\\\n   000 0                00      00    0    \n  ^ 00M M00000 00000 0 0- -    ^ ^000M M00 \n M W00M ^ \\0X ' ^ \\0X V0M- -^-^ ^^ \\0X V0 -\n  -000M0-000M-0^-000M0M   -0^-0^ -000M0]00^\n\n                       ^^ p55] rC62E6] s@?6]\n\\\\m\n\n");

// Will fetch data from settings file, theme.php, URI and cookies for auth, page construction, etc.
// The idea here is to use a bunch of "if" functions to prevent loading of un-needed code.
// All/most if's should call and activate function files and not actual code groups.

// Gets the theme file
CW_Use_Theme($_CW["use_theme"]);


/*
End of File Vars
------------------------
*/



define(cw_core,true,true);


if(!$_CW["error"]->check()==true){
  require(cw_path."docs/error.php");
  die;
}
?>