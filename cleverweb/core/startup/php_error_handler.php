<?php
function cw_throw_php_error ($errno, $errstr, $errfile, $errline, $errcontext){
  $handle = new error_handle;
  $handle->php_error($errno, $errstr, $errfile, $errline, $errcontext);
}
set_error_handler('cw_throw_php_error');
?>