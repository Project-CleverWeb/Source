<?php

/**
 * Initialize
 * 
 * @idea = start up files and constants
 */

require_once $_CW->preinit['path'].DS.'ints.php';
class cleverweb implements versions {
	// may or may not be used in the future
}


// begin
session_start();

switch($_CW->preinit['debug_level']){
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
	$_CW->preinit['debug_level']=1;
		error_reporting(0);
}
define("CW_DEBUG_LEVEL",$_CW->preinit['debug_level'],TRUE);

class init implements versions{
	
	// init lists
	protected $folders;
	protected $plugins;
	protected $sets;
	protected $classes;
	protected $functions;
	
	
	
	
	public function __construct() {
		
	}
	public function __destruct() {
		// error check?
	}
	
	public function settings($options=FALSE){
		// this will changed
		global $_CW;
		return $_CW->preinit;
	}
	
	public function set_loadset($name, $options=FALSE){
		// determine if the area being accessed is and admin area or otherwise
	}
	
	// will be moved into its own class in another file
	public function group_perms(){
		// place holder until user management is availible
		// checks what perms current user group has.
		return array(
			'admin'=>true,
			'moderate'=>true,
			'developer'=>true,
			'post'=>true,
			'create_pages'=>false,
			// view-errors; 0 = none, 1 = cw/user
			'view_errors'=>2
		);
	}
	
	/**
	 * Scopes
	 */
	// this will be limited to this class only
	private function chng_scope($name=FALSE, $current=FALSE){
		// return bool OR if asking for current scope: string
		static $cur_scope;
		if(empty($cur_scope)){
			$cur_scope = 'INTERNAL';
		}
		if($current==TRUE){
			return $cur_scope;
		}
		elseif($name===FALSE && $current===FALSE){
			$cur_scope = 'INTERNAL';
			return TRUE;
		}
		elseif($name){
			$cur_scope = strtoupper((string) $name);
			return TRUE;
		}
		return FALSE; // 
	}
	public function scope(){
		// should return string
		return $this->chng_scope(FALSE,TRUE);
	}
	private function chng_subscope($name=FALSE, $current=FALSE){
		// return bool OR if asking for current subscope: string
		static $cur_subscope;
		if(empty($cur_subscope)){
			$cur_subscope = $this->scope().'-INTERNAL'; // switch to correct perms
		}
		if($current==TRUE){
			return $cur_subscope;
		}
		elseif($name===FALSE && $current===FALSE){
			$cur_subscope = $this->scope().'-INTERNAL';
			return TRUE;
		}
		elseif($name){
			$cur_subscope = $this->scope().'-'.strtoupper((string) $name);
			return TRUE;
		}
		return FALSE;
	}
	public function subscope(){
		// should return string
		return $this->chng_subscope(FALSE,TRUE);
	}
	
	/**
	 * CW internal only
	 */
	// add
	public function add_folder($name,$path,$options=NULL){
		// folders can have config.php
		
	}
	public function add_function($name,$options=NULL){
		
	}
	public function add_plugin($name,$options=NULL){
		// cannot start before some core systems
	}
	public function add_class($name,$options=NULL){
		
	}
	public function add_set($name,$options=NULL){
		
	}
	// remove
	public function remove_folder($name,$key=FALSE){
		
	}
	public function remove_function($name,$key=FALSE){
		
	}
	public function remove_plugin($name,$key=FALSE){
		
	}
	public function remove_class($name,$key=FALSE){
		
	}
	public function remove_set($name,$key=FALSE){
		
	}
	
	/**
	 * Library
	 */
	public function add_lib($name,$options=NULL){
		
	}
	public function add_lib_set($name,$options=NULL){
		
	}
	public function remove_lib($name,$options=NULL){
		
	}
	public function remove_lib_set($name,$options=NULL){
		
	}
	
	/**
	 * Plugins
	 */
	public function plugin_add_folder($name,$path,$options=NULL){
		
	}
	public function plugin_add_function($name,$options=NULL){
		
	}
	public function plugin_add_dependency($name,$options=NULL){
		// checks if dep is active, if not attempt to activate; return bool
	}
	public function plugin_add_class($name,$options=NULL){
		
	}
	public function plugin_add_set($name,$options=NULL){
		
	}
	public function plugin_remove_folder($path,$key=FALSE){
		
	}
	public function plugin_remove_function($name,$key=FALSE){
		
	}
	public function plugin_remove_dependency($name,$key=FALSE){
		
	}
	public function plugin_remove_class($name,$key=FALSE){
		
	}
	public function plugin_remove_set($name,$key=FALSE){
		
	}
	
	/**
	 * Theme
	 */
	public function theme_add_folder($name,$path,$options=NULL){
		
	}
	public function theme_add_function($name,$options=NULL){
		
	}
	public function theme_add_dependency($name,$options=NULL){
		
	}
	public function theme_add_class($name,$options=NULL){
		
	}
	public function theme_remove_folder($name,$key=FALSE){
		
	}
	public function theme_remove_function($name,$key=FALSE){
		
	}
	public function theme_remove_dependency($name,$key=FALSE){
		
	}
	public function theme_remove_class($name,$key=FALSE){
		
	}
	
	/**
	 * Loaders
	 */
	protected function load_internals(){
		$this->chng_scope();
		static $loaded;
		if($loaded===TRUE){
			return FALSE; // [comeback] silent error for attempting to load twice?
		}
		// load paths from arrays;
	}
	protected function load_libs(){
		static $loaded;
		if($loaded===TRUE){
			return FALSE; // [comeback] silent error for attempting to load twice?
		}
		$this->chng_scope('LIBS'); // limit perms
		// load paths from arrays;
		$this->chng_scope(); // return control of internals
	}
	protected function load_plugins(){
		static $loaded;
		if($loaded===TRUE){
			return FALSE; // [comeback] silent error for attempting to load twice?
		}
		$this->chng_scope('PLUGINS'); // limit perms
		// load paths from arrays;
		$this->chng_scope(); // return control of internals
	}
	protected function load_theme(){
		static $loaded;
		if($loaded===TRUE){
			return FALSE; // [comeback] silent error for attempting to load twice?
		}
		$this->chng_scope('THEME'); // limit perms
		// send arrays to theme handler
		$this->chng_scope(); // return control of internals
	}
	
}

/**
 * Start init.
 */
$_CW->init = new init;
$_CW->init->add_folder('/this/path');






?>
