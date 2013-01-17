<?php
class file_explorer{
  public function start($dir=FALSE){
    if($dir===FALSE){
      $dir = __DIR__;
    }
	static $return;
	$return = self::builddir($dir);
    $listarray = scandir($dir);
    foreach($listarray as $item){
	  if($item==='.'||$item==='..'){
	  }
      elseif(is_dir($item)){
	    $return[$item]['type']='dir';
	    $return[$item]['name']=$item;
	    $return[$item]['path']=$dir;
	    $return[$item]['fullpath']=$dir."/".$item;
	    if(stripos($dir,'pubic_html')){
          $return[$item]['thispath']=strstr(stristr($dir."/".$item,'public_html'),'/');
	    }
		sleep(1);
		self::start($dir);
	  }
	  elseif(is_file($item)){
	    $return[$item]['type']='file';
	    $return[$item]['items']=1;
	    $return[$item]['name']=$item;
	    $return[$item]['path']=$dir;
      }
	  else{
	  }
    }
    return $return;
  }
  public function builddir($dir){
    $s=explode('/',$dir);
	$num = 0;
	// 150 file levels deep
	// needs to be revised if possible
	$return
	  [$s[++$num]][$s[++$num]]
	  =array();
	return $return;
  }
  public function filelist(){
  
  }
}
  
$hello = new file_explorer;
print_r($hello->start());

?>