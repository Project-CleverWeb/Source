<?php
$_locations=array();

$_locations[]="";

foreach($_locations as $place){
  if(file_exists($place)){
    require_once($place);
  }
}
?>