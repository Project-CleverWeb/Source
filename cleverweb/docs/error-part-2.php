<?php

/*
This page should not rely on anything but it self. All we did is define the errors and let .htaccess tell the page which error.
*/

if(!$_SERVER["REDIRECT_STATUS"]==200){
  $_CW["err_status"] = $_SERVER["REDIRECT_STATUS"];
}
elseif(isset($_CW["errors"])){
  $err_code = $_CW["errors"];
}
elseif($_CW["error"]->check()){
  $err_code = "cw_int";
}
else{
  $err_code = $_CW["err_status"];
}


if($err_code=="cw_int"){  
  $_CW["error"]->message();
  die;
}
elseif($err_code==301){
  $msg = "Sorry, this page has permanently moved.";
  $tip = "It is best to tell an administrator at this site about the page so that they can put in a redirect page. But this error can often mean that an entire site has moved, so it may be better to search for the page you are looking for on the web.";
}
elseif($err_code==302){
  $msg = "Sorry, this page was temporaraly moved. Please check back later.";
  $tip = "It would be a good idea to check back for this page later in the day or tomorrow. This page is likely undergoing minor construction";
}
elseif($err_code==400){
  $msg = "Errored Request!";
  $tip = "Make sure that you have spelled everything correctly in the web address. does \"".$_SERVER['HTTP_HOST']."\" look right to you?";
}
elseif($err_code==401){
  $msg = "Authorization Required!";
}
elseif($err_code==403){
  $msg = "Page is forbidden!";
}
elseif($err_code==405){
  $msg = "This method is not allowed.";
}
elseif($err_code==408){
  $msg = "Sorry, your request timed out.";
}
elseif($err_code==415){
  $msg = "This type of media is not supported!";
}
elseif($err_code==500){
  $msg = "Sorry, we had an internal error. Please contact this sites owner OR if unavailable, email report@projcleverweb.com and we will try to let them know.<br /><br />Please include \"".$_SERVER['HTTP_HOST']."\" in your email!";
}
elseif($err_code==501){
  $msg = "The server does not support the requested method.";
}
elseif($err_code==502){
  $msg = "Sorry, this is a bad gateway.";
}
elseif($err_code==503){
  $msg = "Sorry, the server may be overloaded or undergoing maintenance, try again in a moment or at a later time.";
}
elseif($err_code==504){
  $msg = "Sorry, the gateway timed out. You may want to try again, or visit another part of this site.";
}
elseif($err_code==505){
  $msg = "Sorry, your HTTP request was either not supported or rejected.";
}
else{
  $err_code = 404;
  $msg = "Sorry, the page you were looking for was not found";
  $tip = "Try refreshing the page or searching the site for the page you are looking for. Also check to make sure that the spelling in the web address is correct.";
}





function errormsg($error_code,$error_msg=NULL){
  if($error_code == "tip"){
    echo $error_msg;
  }
  else{
    echo "Error Code: ".$error_code."<br />";
    echo $error_msg;
  }
}
?>
<html>
<body style="background-color:#000000">
<center>
<div style="margin-top:25px; text-align:center; background-color:#000000; width:540px; border:solid #000 30px">\
<font style="color:#ffffff; font-family:Arial, Helvetica, sans-serif">
<?php
if($_CW["error"]->check()){
echo<<<failboat


<div style="width:506; height:295; border:solid #FFF 3px; text-align:center; margin-left:18px">
<img src="http://projcleverweb.com/cleverweb/docs/failboat.jpg" width="500" height="289" style="text-align:center; border:solid #000 3px" />
</div>
<h1>Error Code: $err_code </h1>
<b>$msg.</b><br />
failboat;
  errormsg("tip",$tip);
}
?>

</font>
</div>
</center>
</body>
</html>
<?php
require_once($_CW["path"]."finish.php");
?>