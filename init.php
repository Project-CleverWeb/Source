<?php

/**
 * Initialize
 * 
 * @idea = start up files and constants
 */

// begin
session_start();
$_CW['session']['vars'] = $_SESSION;
$_CW['path']['main'] = __DIR__."/";


interface knowledge{
  // version related
  const cw_fullname = "Project CleverWeb";
  const cw_name = "CleverWeb";
  const cw_version = "0";
  const cw_subversion = "01";
  const cw_versionname = "Pre-Alpha";
  const poweredby = "Powered by: Project CleverWeb - v0.01 (Pre-Alpha)";
}

switch($_CW['debug_level']){
  case 0: // No error reporting from PHP or CleverWeb (not recommended)
  case 1: // Only CleverWeb errors are shown, but they are only shown to admins. (production enviroment recommended)
    error_reporting(0);
    break;
  case 2: // both CleverWeb & PHP errors are shown, but they are only shown to admins. (maintenance enviroment recommended)
  case 3: // Both CleverWeb & PHP errors are shown to everyone, including visitors. (debug enviroment recommended)
  case 4: // Same as 'level 3' but now shows CleverWeb's silent errors
    error_reporting(6135);
    break;
  case 5: // Shows all possible errors from CleverWeb and PHP to everyone (not recommended)
    error_reporting(-1);
    break;
  default: // same as "level 1'
	$_CW['debug_level']=1;
    error_reporting(0);
}
define("CW_DEBUG_LEVEL",$_CW['debug_level'],TRUE);

class init implements knowledge{
  protected $default_options = array(
    'single_debug_level'=>FALSE,
    'debug_level'=>1,
    'import_level'=>0
  );
  
  public function __construct() {
    // auto init (all defaults/first run)
  }
  public function __destruct() {
    // error check?
    // load list
  }
  
  private function _cw(){
    global $_CW;return $_CW;
  }

  public function settings($options=NULL){
    // fetch settings
  }
  public function user_perms(){
    // place holder until user management is availible
    // checks what perms current user has.
    return array(
      'admin'=>true,
      'moderate'=>true,
      'developer'=>true,
      'post'=>true,
      'create_pages'=>false,
      // view-errors; 0 = none, 1 = cw/user, 2 = all
      'view_errors'=>2
    );
  }


  
  public function _folder($path,$options=NULL){
    $_CW = self::_cw();
    if(!$debug_level_max){
			$debug_level_min = $debug_level_max;
		}
    
  }
  public function _function($name,$options=NULL){
    
  }
  public function _plugin($name,$options=NULL){
    // cannot start before some core systems
  }
  public function _class($name,$options=NULL){
    
  }
  public function _set($name,$options=NULL){
    
  }
	
	/**
	 * Library
	 */
	public function lib($name,$options=NULL){
		
  }
  public function lib_set($name,$options=NULL){
    
  }
	
	/**
	 * Plugins
	 */
	public function plugin_folder($path,$options=NULL){
		
  }
  public function plugin_function($name,$options=NULL){
    
  }
  public function plugin_dependency($name,$options=NULL){
		// checks if dep is active, if not attempt to activate; return bool
  }
  public function plugin_class($name,$options=NULL){
    
  }
  public function plugin_set($name,$options=NULL){
    
  }
	
	/**
	 * Theme
	 */
	public function theme_folder($path,$options=NULL){
		
  }
  public function theme_function($name,$options=NULL){
    
  }
  public function theme_dependency($name,$options=NULL){
		// checks if dep is active, if not attempt to activate; return bool
  }
  public function theme_class($name,$options=NULL){
    
  }
  
  private function load(){
    
  }
  
}

$_CW['init'] = new cw_initialize;
$_CW['class']['get']('cw_initialize');

/**
 * Path List
 */





/**
 * List
 */

$_CW['init']->file("here");






$debug = $_CW['init'];
print_r($debug->_cw());





?>
