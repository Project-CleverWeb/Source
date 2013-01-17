<?php
// Checks if CW themes are used then grabs the needed file.
// Uses the file to construct the page.
function CW_Use_Theme($CW_Use_Theme){
if($CW_Use_Theme=="no"){
  if (file_exists(cw_path."theme/notheme.php")){
    require_once(cw_path."theme/notheme.php");}
  else{echo "File \"notheme.php\" Not Found!<br />\nPage Aborted.";die;}}
else{
  if (file_exists(cw_path."theme/theme.php")){
    require_once(cw_path."theme/theme.php");}
  else{echo "File \"theme.php\" Not Found!<br />\nPage Aborted.";die;}}
}
?>