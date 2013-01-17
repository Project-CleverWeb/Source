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

//require_once("network.php");
if(isset($_SESSION['failed'])){
  sleep(3); 
}








interface knowledge{
  /**
   * Unchanging Attributes
   */
  
  // version related
  const cw_version = "0";
  const cw_subversion = "01";
  const cw_versionname = "Pre-Alpha";
  const poweredby = "CleverWeb v0.01 :: Pre-Alpha";
}
class prodigy implements knowledge {
  protected	$_debug;
  protected	$_maintenance;
  public static $_error_count = 0;
  protected	$_classname;
	
  /***Magic Methods***/
  public function __construct($action=NULL,$var1=NULL,$var2=NULL,$var3=NULL,$var4=NULL,$var5=NULL){
	$this->_debug = (defined('DEBUG'))? DEBUG : 0; 
	$this->_maintenance = (defined('MAINTENANCE'))? MAINTENANCE : 0;
    $this->_classname = get_class();
	if($this->_debug){
	  error_reporting(E_ALL);
	  if ($this->_debug==2){
	   error_reporting(E_STRICT);
	  }
	}
	$action = strtolower($action);
	if($action=="err"||$action=="error"){
	  $this->_err($var1,$var2,$var3,$var4,"tracelevelup");
	}
	elseif($action=="trace"){
	  $this->_trace($var1);
	}
  }
  public function __destruct(){
  }
  
  /***Functions***/
  public function _define($name,$value,$debug=NULL){
    if(defined($name)){
      $this->_err("invalid");
    }
    else{
      if((defined('ENVIRONMENT')&&constant('ENVIRONMENT')==='Production')||is_null($debug)){
        define($name,$value);
      }
	  else{
        define($name,$debug);
      }
    }
  }
  
  public function _trace($lev=2){
	$trace = debug_backtrace();
	$info['file']=$trace[$lev]['file'];
    $info['line']=$trace[$lev]['line'];
    $info['class']=$trace[$lev]['class'];
	$info['func']=$trace[$lev]['function'];
	$info['args']=$trace[$lev]['args'];
	if($trace[$lev]['args']==array()){
	  $info['args']=NULL;
	}
    return $info;
  }
  public function handle_login() {
    if($uid = user::check_password($_REQUEST['email'], $_REQUEST['password'])) {
      session_destroy();
      return self::authenticate_user($uid);
    }
    else{
     $_SESSION['failed'] = 1;
     return self::login_failed();
    }
  }
  public function _err($type=NULL,$msg=NULL,$option=NULL,$silent=NULL,$tracelevelup=NULL){
    global $_CW; // required for magic
	$this->_error_count++;
	$vertype=strtolower($type);
	$msg = htmlentities($msg);
    $types = array("bool","invalid","num","alphanum","letters","char","fnf","nofile","empty");
	$offtypes = array("fnf","nofile");
	foreach($types as $err){
	  if($vertype==$err){
	    $valid=true;
		break;
	  }
	}
	foreach($offtypes as $offtype){
	  if($type==$offtype){
	    $othertype=true;
		break;
	  }
	}
	$tracelev = 2;
	if($tracelevelup=="tracelevelup"){
	  $tracelev++;
	}
	$trace=$this->_trace($tracelev);
	if($type=="fnf"||$type=="nofile"){
	  $tracelev++;
	  $trace=$this->_trace($tracelev);
	  if(!strlen($trace['file'])>0){
		$tracelev--;
	    $trace=$this->_trace($tracelev);
		if(!strlen($trace['file'])>0){
		  $tracelev--;
	      $trace=$this->_trace($tracelev);
	    }
	  }
	}
	$line=$trace['line'];
	$func=$trace['func'];
	$class=$trace['class'];
	$args=$trace['args'];
	$file=$trace['file'];
	if($silent=="silent"){}
	if(strlen($msg)>0){
	  $msg = "<div class=\"_errmsg_msg\"><strong>Message:</strong> <font class=\"_errmsg_highlight\">".$msg."</font>";
	  $type="msg";
	}
	else{
	  if(!$valid==true){
		$_CW['_silent_errors'][]="blank or invalid error type \"".$type."\" ignored in:<br />".
		"File: ".$file."<br />".
		"Line :".$line."<br />".
		"Class: ".$class."<br />".
		"Function: ".$func;
	    return;
	  }
	  $msg="<div class=\"_errmsg_err\"><strong>Error:</strong> A variable ";
	}
	if($type=="bool"){
	  $msg.="should be <font class=\"_errmsg_highlight\">TRUE</font> or <font class=\"_errmsg_highlight\">FALSE</font> but is not.</div>".PHP_EOL;
	}
	elseif($type=="invalid"){
	  $msg.="is <font class=\"_errmsg_highlight\">INVALID</font>.</div>".PHP_EOL;
	}
	elseif($type=="empty"){
	  $msg.="contains <font class=\"_errmsg_highlight\">INSUFFICIENT DATA</font>.</div>".PHP_EOL;
	}
	elseif($type=="alphanum"){
	  $msg.="should ONLY contain <font class=\"_errmsg_highlight\">LETTERS</font> and <font class=\"_errmsg_highlight\">NUMBERS</font>.</div>".PHP_EOL;
	}
	elseif($type=="num"){
	  $msg.="should ONLY contain <font class=\"_errmsg_highlight\">NUMBERS</font>.</div>".PHP_EOL;
	}
	elseif($type=="letters"){
	  $msg.="should ONLY contain <font class=\"_errmsg_highlight\">LETTERS</font>.</div>".PHP_EOL;
	}
	elseif($type=="char"){
	  $msg.="contains <font class=\"_errmsg_highlight\">INVALID CHARACTERS</font>.</div>".PHP_EOL;
	}
	elseif($type=="msg"){
	  $msg.= "</div>".PHP_EOL;
	}
	elseif($type=="fnf"||$type=="nofile"){
	  $msg = "<strong>Error:</strong> File not found at \"<font class=\"_errmsg_highlight\">".$extra1."</font>\"".PHP_EOL;
	}
	else{
      die("Unknown error type, CRITICAL INTERNAL ERROR. ".PHP_EOL."killing script...");
	}
	$msg.="<div class=\"_errmsg_msgline\"><strong>File:</strong> <font class=\"_errmsg_funfile\">".$file."</font></div>".PHP_EOL;
	$msg.="<div class=\"_errmsg_msgline\"><strong>Line:</strong> <font class=\"_errmsg_funcline\">".$line."</font></div>".PHP_EOL;
	if(!$class==NULL){
      $msg.="<div class=\"_errmsg_msgline\"><strong>Class:</strong> <font class=\"_errmsg_funcclass\">".$class."</font></div>".PHP_EOL;
	}
	$msg.="<div class=\"_errmsg_msgline\"><strong>Function:</strong> <font class=\"_errmsg_funcname\">".$func."</font></div>".PHP_EOL;
	if(is_array($args)){
      $msg.="<div><strong>Variables</strong></div>".PHP_EOL;
	  $subtempcount = 0;
	  foreach($args as $key=>$value){
		$key = htmlentities($key);
		if(is_array($value)){
	      $tempstr = "<strong>Array (</strong>";
		  foreach($value as $subkey=>$subvalue){
			$subkey = htmlentities($subkey);
			if(is_array($subvalue)){
			  $subvalue = "<strong>Array</strong>";
			}
			else{
			  $subvalue = htmlentities($subvalue);
			}
			$tempstr.=" [".$subkey."] => ".$subvalue." ";
		  }
		  $value = $tempstr."<strong>)</strong>";
	      unset($tempstr);
		}
		else{
		  $value = htmlentities($value);
		}
		$subtempcount++;
	    $msg.="  <div style=\"margin-left:20px\"  class=\"_errmsg_msgline _errmsg_funcarg\"><strong>#".$subtempcount."&nbsp;&nbsp;&nbsp;</strong> [".$key."] => ".$value."</div>".PHP_EOL;
	  }
	}
    $_CW["internal_errors"][]=$msg;
	
	
    return true;
  }
  
  public function _report_errors(){
	global $_CW;
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'.PHP_EOL;
	echo "<html><head>".PHP_EOL;
	echo "<title>This is an error page</title>".PHP_EOL;
	echo '</head>'.PHP_EOL;
	$thiiiis=<<<this
<style>
._errmsg_even{
  background-color:#dddddd;
  padding:7px;
}
._errmsg_highlight{
  color:#ff0000;
}
._errmsg_msgline{
  padding-left:15px;
}
._errmsg_msg{
  color:#0000ff
}
</style>
this;
	echo '<body style="margin-left:25%; width:50%; border:solid 1px #000000; padding:25px; margin-top:40px; margin-bottom:170px">'.PHP_EOL;
	echo "<center><h1><strong>CleverWeb Internal Errors</strong></h1></center>".PHP_EOL;
	if(!is_array($_CW["internal_errors"])){
	  $_CW["internal_errors"] = array("[PARSE ERROR]"=>"Value supplied for errors was not an array!");
	}
	foreach($_CW["internal_errors"] as $key=>$value){
	  // errors out completely if parse error is called.
	  // also allows for custom parse errors.
	  if($key==="[PARSE ERROR]"){
	    die("[PARSE ERROR] => ".$value);
	  }
	}
	$temp_count = 0;
    foreach($_CW["internal_errors"] as $key=>$error){
	  $temp_count++;
	  if($temp_count==round($temp_count/2)*2){
	    $even = "_even";
	  }
	  else{
		$even = "";
	  }
	  echo '<div class="_errmsg'.$even.'"><strong>Error #'.$temp_count.' :: '.$key.'</strong><br />'
	  .$error."</div>".PHP_EOL."<br />".PHP_EOL."<br />".PHP_EOL;
	}
	unset($temp_count);
	if($this->_debug){
	  if(is_array($_CW['_silent_errors'])){
	    echo "<center><h1><strong>CleverWeb Silent Errors</strong></h1></center>".PHP_EOL;
	    foreach($_CW['_silent_errors'] as $key => $value){
		  $key = htmlentities($key);
		  $value = htmlentities($value);
	      echo "[".$key."] => ".$value."<br /><br />".PHP_EOL;
	    }
	  }
	}
	echo '</body></html>';
  }
}
$_CW['prodigy']=new prodigy;




class Session extends prodigy {
  const SESSION_STARTED = TRUE;
  const SESSION_NOT_STARTED = FALSE;
  // The state of the session
  private $sessionState = self::SESSION_NOT_STARTED;
  // THE only instance of the class
  private static $instance;
    
  public function __construct(){
    parent::__construct();
  }
  private function __destruct(){
    parent::__destruct();
  }
    
  /**
   * Returns THE instance of 'Session'.
   * The session is automatically initialized if it wasn't.
   *    
   * @return  object
   */
    
  public static function getInstance(){
    if(!isset(self::$instance)){
      self::$instance = new self;
    }
    self::$instance->startSession();
    return self::$instance;
  }
 
  /**
   * (Re)starts the session.
   *    
   * @return  bool  (TRUE if the session has been initialized, else FALSE.)
   */
    
  public function startSession(){
    if($this->sessionState == self::SESSION_NOT_STARTED){
      $this->sessionState = session_start();
    }
    return $this->sessionState;
  }
    
  /**
   * Stores datas in the session.
   * 
   * @Example $instance->foo = 'bar';
   *    
   * @param  name  (name of the data)
   * @param  value  (your data)
   * @return  bool (TRUE on success or FALSE on failure)
   */
    
  public function __set($name,$value){
    return ($_SESSION[$name] = $value) or false;
  }
    
  /**
   * Gets datas from the session.
   * Example: echo $instance->foo;
   *    
   * @param    name  (name of the data to get)
   * @return    mixed  (data stored in session or FALSE if empty)
   */

  public function __get($name){
    if (isset($_SESSION[$name]))
      return $_SESSION[$name];
	else
	  parent::_err("empty",NULL,NULL,TRUE);
	  return false;
  }

  public function __isset($name){
    return isset($_SESSION[$name]);
  }

  public function __unset($name){
    unset($_SESSION[$name]);
  }

  /**
   * Destroys the current session.
   *    
   * @return  bool  (TRUE is session has been deleted, else FALSE.)
   */

  public function destroy(){
    if ( $this->sessionState == self::SESSION_STARTED ){
      $this->sessionState = !session_destroy();
      unset( $_SESSION );
      return !$this->sessionState;
    } 
    return FALSE;
  }
}



























class validators extends prodigy implements knowledge{
  function __construct(){
    parent::__construct();
  }
  public function __destruct(){
    parent::__destruct();
  }
  function email($email){
    if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',$email))
      return true;
    else 
      return false;
  }
  function password($pass){
	/**
	 * Password Valdator
	 *
	 * must have 1+ capital letter(s)
	 * must have 1+ lowercase letter(s)
	 * must range betweeen 8-16 characters
	 * must contain no special characters
	 */
    if (ctype_alnum($pass)&&preg_match('/(?=^.{8,16}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/',$pass))
      return true;
    else 
      return false;
  }
  function username($username){
    if (preg_match('/^[a-z\d_]{6,20}$/i',$username))
      return true;
    else 
      return false;
  }
  function us_phone($phone){
    if (preg_match('/\(?\d{3}\)?[-\s.]?\d{3}[-\s.]\d{4}/x',$phone))
      return true;
    else 
      return false;
  }
  function ip($ip){
    if (preg_match('/^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]).){3}([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/',$ip))
      return true;
    else 
      return false;
  }
  function zipcode($zipcode){
    if (preg_match("/^([0-9]{5})(-[0-9]{4})?$/i",$zipcode))
      return true;
    else 
      return false;
  }
  function ssn($ssn){
    if (preg_match('/^[\d]{3}-[\d]{2}-[\d]{4}$/',$ssn))
      return true;
    else 
      return false;
  }
  function credit_card($cardnum){
    if (preg_match('/^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6011[0-9]{12}|3(?:0[0-5]|[68][0-9])[0-9]{11}|3[47][0-9]{13})$/',$cardnum))
      return true;
    else 
      return false;
  }
  function url($url){
    if (preg_match('/^(http|https):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i',$url))
      return true;
    else 
      return false;
  }
}


class user extends prodigy implements knowledge{
  function __construct(){
    parent::__construct();
  }
  public function __destruct(){
    parent::__destruct();
  }
  public function check_password($email,$pass){
	if(!valdators::email($email)){
	  return false;
	}
	if(!valdators::password($pass)){
	  return false;
	}
	
	// mysql
  }
  public function handle_login() { // borrowed function - needs to be extended and reshaped
    if($uid = $this->check_password(htmlentities($_REQUEST['email']), htmlentities($_REQUEST['password']))) {
      session_destroy();
      return $this->authenticate_user($uid);
    }
    else{
     $_SESSION['failed'] = 1;
     return self::login_failed();
    }
  }
}
$_CW;

class recaptcha extends prodigy implements knowledge{
  function __construct(){
    parent::__construct();
  }
  public function __destruct(){
    parent::__destruct();
  }
  public function keys($private,$public){
    parent::_define(recaptcha_private_key,$private);
	parent::_define(recaptcha_public_key,$public);
  }
  public function form($loc){
    require_once($_CW['path'].'/docs/recaptcha/recaptchalib.php');
	$recaptcha = "
	
	";
  }
}




function _require_once($loc=NULL){
  $orgloc=$loc;
  if(!strlen($loc)>0){
    new prodigy("err","empty");
	return;
  }
  else{
	if($loc[0]=="."&&$loc[1]=="/"){
	  $loc[0]="";
	}
	if($loc[0]=="/"){
	  $loc[0]="";
	}
    $loc=pathinfo(dirname(__FILE__).$slash.$loc);
	$loc=$loc['dirname']."/".$loc['basename'];
	global $_CW;
	if(!is_array($_CW['_inc_once_used_array'])){
	  $_CW['_inc_once_used_array'] = array();
	}
    foreach($_CW['_inc_once_used_array'] as $used_loc){
	  if($used_loc==$loc){
		return;
      }
	}
	$_CW['_inc_once_used_array'][]=$loc;
  }
  if(is_array($_CW["internal_errors"])){
    if(!file_exists($loc)){
	  new prodigy("err","fnf",NULL,$loc);
	}
	return;
  }
  if(!@include_once($orgloc))new prodigy("err","fnf",NULL,$orgloc);
}



function check_url($url)  {  
  $ch = curl_init();     
  curl_setopt($ch,CURLOPT_URL,$url);
  curl_setopt($ch,CURLOPT_VERBOSE,0);
  curl_setopt($ch,CURLOPT_HEADER,1);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
  curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,3);  
  $data = curl_exec($ch);  
  curl_close($ch);  
  $return = "unknown";
  if(strlen($data)==0){
    $return = false;
  }
  if(strlen($data)>500){
    $return = "low";
  }
  if(strlen($data)>5000){
    $return = "med";
  }
  if(strlen($data)>10000){
    $return = "high";
  }
  if(strlen($data)>15000){
    $return = true;
  }
  return $return;
}
function cw_send_headers($add_headers=NULL){
  header('X-Server: Server camouflaged as '.$_SERVER['SERVER_SOFTWARE']);
  header('X-Powered-By: CleverWeb OS');
  header('Transfer-Encoding: encoded, switched');
  header('X-Frame-Options: deny');
  header('X-Runtime: false');
  header('X-Version: false');
  header('X-AspNet-Version: false');
  header('DNT: 1');
  header('X-Do-Not-Track: 1');
  header('Retry-After: 10');
}






/**
 * Configure
 */
// Grabs users config file and starts MySQL.
if(!function_exists("cw_path")){
  _require_once("config.php");
}
if(file_exists(cw_path."core/general/mobile_detect.php")){
  _require_once(cw_path."core/general/mobile_detect.php");
}
if(file_exists(cw_path."core/general/browser_detect.php")){
  _require_once(cw_path."core/general/browser_detect.php");
}
if(file_exists(cw_path."core/general/bots.php")){
  _require_once(cw_path."core/general/bots.php");
}
if(file_exists(cw_path."core/general/trackvars.php")){
  _require_once(cw_path."core/general/trackvars.php");
}
// headers sent after determining the device/browser
if(file_exists(cw_path."core/general/headers.php")){
  _require_once(cw_path."core/general/headers.php");
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





// Gets user functions if the file exists.
if(file_exists(cw_path."admin/function_list.php")){
  include_once(cw_path."admin/function_list.php");
}

/**
 * Hooks
 */
echo
str_repeat("\n",50);
/*
CW_ROT47("kP\\\\\n   000 0                ".
"00      00    0    \n  ^ 00M M00000 00000".
" 0 0- -    ^ ^000M M00 \n M W00M ^ \\0X '".
" ^ \\0X V0M- -^-^ ^^ \\0X V0 -\n  -000M0-".
"000M-0^-000M0M   -0^-0^ -000M0]00^\n\n   ".
"                    ^^ p55] rC62E6] s@?6]".
"\n\\\\m\n\n");
*/

// Will fetch data from settings file, theme.php, URI and cookies for auth, page construction, etc.
// The idea here is to use a bunch of "if" functions to prevent loading of un-needed code.
// All/most if's should call and activate function files and not actual code groups.

// Gets the theme file
//CW_Use_Theme($_CW["use_theme"]);


/*
End of File Vars
------------------------
*/



define(cw_core,true,true);



?>