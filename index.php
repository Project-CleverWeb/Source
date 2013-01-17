<?php
// This file is only for making 

/**
 * Make invisible
 */


echo "<pre>";




if($_SERVER['REQUEST_URI']==$_SERVER['SCRIPT_NAME']){
	// 404
}
else{
	// 403
}


header("HTTP/1.1 500 Internal Server Error");
print_r($_SERVER);


?>