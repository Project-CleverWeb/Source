<?php
/*******START CLEVERWEB COMMENTS*******/

/**
 * This file and it author have been added to the 'credits.txt'
 * file. CleverWeb claims no ownership nor original works for
 * this file and its contents.
 *
 * In compliance with the GNU license mentioned below a changelog
 * has bee added in these comments, documenting any changes to
 * the original work.
 *
 * ChangeLog for this file:
 *   '$browscap' now '=' to 'cw_path."core/general/php_browscap.ini"'
 *     NOTE: file now dependent on CleverWeb core
 *   Moved included instuctions to browser_detect_ins.txt
 *   Renamed all functions to start with 'mt_'
 */

/*******STOP CLEVERWEB COMMENTS*******/

/*
Plugin Name: PHP Browser Detection
Plugin URI: http://martythornley.com/downloads/php-browser-info
Description: Use PHP to detect browsers for conditional CSS or to detect mobile phones.
Version: 2.1
Author: Marty Thornley
Author URI: http://martythornley.com
*/

/*  Copyright 2009  Marty Thornley  (email : marty@martythornley.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/* CREDITS

	'php_browser_detection_browscap.ini' is the 'lite_php_browscap.ini' from php_browscap.ini - http://browsers.garykeith.com/downloads.asp

*/



function mt_php_browser_info(){
	$agent = $_SERVER['HTTP_USER_AGENT'];
	
	$x = dirname(__FILE__); 
	$browscap = cw_path."core/general/php_browscap.ini";
	if(!is_file(realpath($browscap)))
		return array('error'=>'No browscap ini file founded.');
	$agent=$agent?$agent:$_SERVER['HTTP_USER_AGENT'];
	$yu=array();
	$q_s=array("#\.#","#\*#","#\?#");
	$q_r=array("\.",".*",".?");
	
	if (version_compare(PHP_VERSION, '5.3.0') >= 0) {
        $brows = parse_ini_file(realpath($browscap), true, INI_SCANNER_RAW);
	}else{
		$brows = parse_ini_file(realpath($browscap),true);
	}

	foreach($brows as $k=>$t){
	  if(fnmatch($k,$agent)){
	  $yu['browser_name_pattern']=$k;
	  $pat=preg_replace($q_s,$q_r,$k);
	  $yu['browser_name_regex']=strtolower("^$pat$");
	    foreach($brows as $g=>$r){
	      if($t['Parent']==$g){
	        foreach($brows as $a=>$b){
	          if($r['Parent']==$a){
	            $yu=array_merge($yu,$b,$r,$t);
	            foreach($yu as $d=>$z){
	              $l=strtolower($d);
	              $hu[$l]=$z;
	            }
	          }
	        }
	      }
	    }
	    break;
	  }
	}
	return $hu;
}

// GET BROWSER INFO **********************************************************

function mt_get_browser_name() {
	
	$browserInfo = mt_php_browser_info();
	
	if (mt_is_firefox() ):
		return 'Firefox';
	elseif (mt_is_safari()) :
		return 'Safari';
	elseif (mt_is_opera()) :
		return 'Opera';		
	elseif (mt_is_chrome()) :
		return 'Chrome';	
	elseif (mt_is_IE()) :
		return 'The Root of all Evil';
	elseif (mt_is_ipad()) :
		return 'iPad';
	elseif (mt_is_ipod()) :
		return 'iPod';
	elseif (mt_is_iphone()) :
		return 'iPhone';
	else :
		return 'Unknown Browser: ' . $browserInfo['browser'] . ' - Version: ' .mt_get_browser_version();
	endif;
}

function mt_get_browser_version() {
	$browserInfo = mt_php_browser_info();
	return $browserInfo['version'];
}

// BROWSERS **********************************************************

function mt_is_firefox ($version=''){
	$browserInfo = mt_php_browser_info();
	if(isset($browserInfo['browser']) && $browserInfo['browser']=='Firefox') {
		if ($version == '') :
			return true;
		elseif ($browserInfo['majorver'] == $version ) :
			return true;
		else :
			return false;
		endif;
	} else {
		return false;	
	}	
}

function mt_is_safari ($version=''){
	$browserInfo = mt_php_browser_info();
	if(isset($browserInfo['browser']) && $browserInfo['browser']=='Safari') {
		if ($version == '') :
			return true;
		elseif ($browserInfo['majorver'] == $version ) :
			return true;
		else :
			return false;
		endif;
	} else {
		return false;	
	}
}

function mt_is_chrome ($version=''){
	$browserInfo = mt_php_browser_info();
	if(isset($browserInfo['browser']) && $browserInfo['browser']=='Chrome') {
		if ($version == '') :
			return true;
		elseif ($browserInfo['majorver'] == $version ) :
			return true;
		else :
			return false;
		endif;
	} else {
		return false;	
	}
}

function mt_is_opera ($version=''){
	$browserInfo = mt_php_browser_info();
	if(isset($browserInfo['browser']) && $browserInfo['browser']=='Opera') {
		if ($version == '') :
			return true;
		elseif ($browserInfo['majorver'] == $version ) :
			return true;
		else :
			return false;
		endif;
	} else {
		return false;	
	}	
}

function mt_is_IE ($version=''){
	$browserInfo = mt_php_browser_info();
	if(isset($browserInfo['browser']) && $browserInfo['browser']=='IE') {
		if ($version == '') :
			return true;
		elseif ($browserInfo['majorver'] == $version ) :
			return true;
		else :
			return false;
		endif;
	} else {
		return false;	
	}
}

// MOBILE / IPHONE / IPAD **********************************************************

function mt_is_mobile (){
	$browserInfo = mt_php_browser_info();
	if(isset($browserInfo['ismobiledevice']) && $browserInfo['ismobiledevice']==1)
		return true;
	return false;	
}

function mt_is_iphone ($version=''){
	$browserInfo = mt_php_browser_info();
	if( ( isset($browserInfo['browser']) && $browserInfo['browser']=='iPhone' ) || strpos( $_SERVER['HTTP_USER_AGENT'] , 'iPhone') ) {
		if ($version == '') :
			return true;
		elseif ($browserInfo['majorver'] == $version ) :
			return true;
		else :
			return false;
		endif;
	} else {
		return false;	
	}
}

function mt_is_ipad ($version=''){
	$browserInfo = mt_php_browser_info();
	if ( preg_match("/iPad/", $browserInfo['browser_name_pattern'], $matches) || strpos( $_SERVER['HTTP_USER_AGENT'] , 'iPad') ) {
		if ($version == '') :
			return true;
		elseif ($browserInfo['majorver'] == $version ) :
			return true;
		else :
			return false;
		endif;
	} else {
		return false;	
	}	
}

function mt_is_ipod (){
	$browserInfo = mt_php_browser_info();
	if (preg_match("/iPod/", $browserInfo['browser_name_pattern'], $matches)) {
		if ($version == '') :
			return true;
		elseif ($browserInfo['majorver'] == $version ) :
			return true;
		else :
			return false;
		endif;
	} else {
		return false;	
	}	
}

// TEST FOR FEATURES ****************************************************

function mt_browser_supports_javascript() {
	$browserInfo = mt_php_browser_info();
	if(isset($browserInfo['javascript']) && $browserInfo['javascript']=='1')
		return true;
	return false;		
}

function mt_browser_supports_cookies() {
	$browserInfo = mt_php_browser_info();
	if(isset($browserInfo['cookies']) && $browserInfo['cookies']=='1')
		return true;
	return false;		
}

function mt_browser_supports_css() {
	$browserInfo = mt_php_browser_info();
	if(isset($browserInfo['supportscss']) && $browserInfo['supportscss']=='1')
		return true;
	return false;		
}

// IE VERSIONS **********************************************************

function mt_is_IE6 (){
	$browserInfo = mt_php_browser_info();
	if(isset($browserInfo['browser']) && $browserInfo['browser']=='IE' && $browserInfo['majorver'] == '6')
		return true;
	return false;	
}

function mt_is_IE7 (){
	$browserInfo = mt_php_browser_info();
	if(isset($browserInfo['browser']) && $browserInfo['browser']=='IE' && $browserInfo['majorver'] == '7')
		return true;
	return false;	
}

function mt_is_lt_IE6 (){
	$browserInfo = mt_php_browser_info();
	if(isset($browserInfo['browser']) && $browserInfo['browser']=='IE' && (int)$browserInfo['majorver'] < 6)
		return true;
	return false;	
}

function mt_is_lt_IE7 (){
	$browserInfo = mt_php_browser_info();
	if(isset($browserInfo['browser']) && $browserInfo['browser']=='IE' && (int)$browserInfo['majorver'] < 7)
		return true;
	return false;	
}

function mt_is_lt_IE8 (){
	$browserInfo = mt_php_browser_info();
	if(isset($browserInfo['browser']) && $browserInfo['browser']=='IE' && (int)$browserInfo['majorver'] < 8)
		return true;
	return false;	
}

?>