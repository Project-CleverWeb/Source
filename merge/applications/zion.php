<?php

require_once(LIB . DS . 'functions.php');
require_once(CONF . DS . '_base_config.php');
require_once(LIB . DS . 'shared.php');

/** Main Call Function **/

function zion(){
	$url = explode('/', REQUEST_URL);
	// Determine Requested APP
	if(USE_SUBDOMAINS){
		$host = $_SERVER['HTTP_HOST'];
		preg_match('/(www\.)?([^\.]+)\.' . SITE_HOST . '(.*)$/i',$host, $m);
		$rapp = (isset($m[2]) && strlen($m[2]) > 0)? $m[2] : 'Default';
	}else{
		$rapp = array_shift($url);
	}
	$app = ucwords(strtolower($rapp));
	if(!app_exists($app)){
		array_unshift($url, $rapp);
		$app = 'Default';
	}
	d('APPLICATION',$app);
	$controller = $app;
	$model = $controller . 'Model';
	$action = isset($url[0]{0})? strtolower(array_shift($url)) : 'index';
	$props = $url;

	$controller .= 'Controller';
	
	$dispatch = new $controller($model);

	if((bool)method_exists($controller,$action)){
		call_user_func_array(array($dispatch,$action), $props);
	}else{
		error_404();
	}
}

zion();