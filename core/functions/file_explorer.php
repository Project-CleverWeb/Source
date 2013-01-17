<?php

function file_explorer($dir=FALSE){
  if($dir===FALSE){
    $dir = __DIR__;
  }
  $listarray = scandir($dir);
  $count[$dir]=count($listarray);
  foreach($listarray as $item){
	if($item==='.'||$item==='..'){
	}
    elseif(is_dir($item)){
	  $return[$dir."/".$item]['type']='dir';
	  $return[$dir."/".$item]['items']=$count[$dir];
	  $return[$dir."/".$item]['name']=$item;
	  $return[$dir."/".$item]['path']=$dir;
	  $return[$dir."/".$item]['fullpath']=$dir."/".$item;
	  if(stripos('pubic_html')){
        $return[$dir."/".$item]['thispath']=$dir."/".$item;
	  }
	  file_explorer($dir."/".$item);
	}
	elseif(is_file($item)){
	  $return[$dir."/".$item]['type']='file';
	  $return[$dir."/".$item]['items']=1;
	  $return[$dir."/".$item]['name']=$item;
	  $return[$dir."/".$item]['path']=$dir;
	}
	else{
	  
	}
  }
  return $return;
}
print_r(file_explorer(__dir__.'/../'));
?>