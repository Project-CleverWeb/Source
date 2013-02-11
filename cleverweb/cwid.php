<?php
/**
 * In addition to forwarding to a fake 404 (if this file is directly accessed)
 * this file identifies this directory as the core of cleverweb, playing a key
 * role in making sure that CW starts correctly.
 * 
 * MOVING THIS FILE WILL CAUSE CW TO FAIL!!!
 */

// make sure this file isn't being accessed directly from browser
if(isset($_CW) && function_exists('_define')){
	_define('CW_CORE_EXISTS',TRUE);
	$_CW->preinit['path'] = __DIR__;
	return;
}
else{
	// point to error page (not yet defined [comeback])
}