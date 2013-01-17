<?php
// Generates page title
function CW_Page_Title($page_url=NULL){
  if($page_url==NULL){
    $page_url = $_SERVER['HTTP_HOST'];
  }
  
  
  return "Project CleverWeb";
}
define("cw_title",CW_Page_Title);
?>