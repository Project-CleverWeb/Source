<?php
class cw_read extends prodigy{
  
  private function rss_read($feed){
    // reads RSS according to w3c standards.
	// excludes cloud tag.
	
	
	return array(
	  "version"   => $version,
	  "lang"      => $language,
	  "posts"     => $posts, //array
	  "title"     => $title,
	  "sitelink"  => $link,
	  "lastupdate"=> $update,
	  "image"     => $image, //array
	  "category"  => $category,
	  "pubdate"   => $published,
	  "textinput" => $input, //array
	  "ttl"       => $ttl,
	  "skipday"   => $skipdays,
	  "skiphours" => $skiphours,
	  "editor"    => $editor,
	  "webmaster" => $webmaster,
	  "generator" => $gen,
	  "copyright" => $copyright,
	  "docs"      => $docs
	);
  }
  
  public function rss($location){
    if(!file_exists($location)){
	  if(!file_exists($_CW["path"].$location)){
	    cw_error();
	    return;
	  }
	  else{
	    $location = $_CW["path"].$location;
	  }
	}
	$handle = fopen($location, "r");
    $feed = fread($handle, filesize($location));
    fclose($handle);
	return $this->rss_read($feed);
  }
  public function rss_url($url){
	$curlint = curl_init();    
    curl_setopt($curlint,CURLOPT_URL,$url);  
    curl_setopt($curlint,CURLOPT_RETURNTRANSFER,1);  
    curl_setopt($curlint,CURLOPT_CONNECTTIMEOUT,5);
	curl_setopt($curlint,CURLOPT_FRESH_CONNECT, 1);
    $feed = curl_exec($curlint);  
    curl_close($curlint); 
	$this->rss_read($feed);
  }
}
$_CW["read"] = new cw_read;

?>