<?php
// grabbed from php site and modified.
if(function_exists("scandir")===false){
  function scandir($dir){
    $dh  = opendir($dir);
    while (false !== ($filename = readdir($dh))) {
      $files[] = $filename;
    }
    sort($files);
  }
}
?>