<?php
/**	
	Constant Definition function 
	$n - constant name
	$p - value (production) 
	$d - value (development) [optional]

	**/
function d($n,$p,$d=NULL){
	if(defined($n)){
		trigger_error('Previously Defined Constant: ' . $n, E_USER_WARNING);
	}else{
		if((defined('ENVIRONMENT') && constant('ENVIRONMENT') === 'Production') || is_null($d)){
			define($n, $p);
		}else{
			define($n, $d);
		}
	}
}


/** Define a Couple Of basic Constants **/
d('DS',DIRECTORY_SEPARATOR, '/'); // Shorter name for the php constant DIRECTORY_SEPARATOR.
d('ROOT', dirname(dirname(__FILE__))); // Folder containing the '/public/' folder
d('LIB', ROOT . DS . 'library'); // Library Folder
d('CONF', ROOT . DS . 'configs'); // Configs Folder
d('EOL', PHP_EOL); // Shorter name for the php constant PHP_EOL (End of line);
d('REQUEST_URL', trim($_GET['url'],'/')); // Get the requested URL for parsing later.
d('REQUEST_METHOD', $_SERVER['REQUEST_METHOD']);
d('POST', (REQUEST_METHOD === 'POST'));
d('GET', (REQUEST_METHOD === 'GET'));


require_once(ROOT . DS . 'applications' . DS . 'zion.php');