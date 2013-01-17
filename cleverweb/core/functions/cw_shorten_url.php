<?php
// Creates TinyURL URL  
function CW_Shorten_URL($url)  {  
  $ch = curl_init();    
  curl_setopt($ch,CURLOPT_URL,'http://tinyurl.com/api-create.php?url='.$url);  
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  
  curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,5);  
  $data = curl_exec($ch);  
  curl_close($ch);  
  return $data;  
}
?>