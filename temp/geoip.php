<?php
$ip = $_SERVER['REMOTE_ADDR']; // settings

$ch = curl_init(); //start
curl_setopt($ch,CURLOPT_URL,'www.maxmind.com/geoip/city_isp_org/'.$ip.'?demo=1');  // where
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  //what
curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,3); // when
$array_of_win = get_object_vars(json_decode(curl_exec($ch)));  // decode
curl_close($ch); // save power

echo '<pre>'; // setup
print_r($array_of_win); // win
?>