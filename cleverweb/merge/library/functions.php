<?php

function app_exists($appName){
	return (strlen($appName) > 0)? is_dir(ROOT . DS . 'applications' . DS . $appName) : false;
}
function error_404(){
	header('Location: http://' . SITE_URL . 'Error/404');
}
