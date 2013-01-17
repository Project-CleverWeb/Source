<?php
require_once("./../start.php");
CW_Get_All_Functions();

$firstname = $_REQUEST['firstname'];
$lastname = $_REQUEST['lastname'];
$email = $_REQUEST['email'];
$to = $email;
$subject = "Thanks for subscribing!";
$beta = $_REQUEST['beta'];
$noupdates = $_REQUEST['noupdates'];

if($firstname==""&&$lastname==""){
  $firstname = "Interested";
  $lastname = "User";
}
if($firstname==""){
  $firstname = "persons with the lastname:";
}
if($lastname==""){
  $lastname = "The-person-without-a-last-name";
}

# MAIL BODY
$body = "Dear ".$firstname." ".$lastname.",<br /><br />\n\r\n\r";
$body .= "Thank you for signing up for CleverWeb! From now on you will receive updates for:<br />\n\r";
$body .= "<b>When CleverWeb is officially released";
if($beta==1){
  $body .= "\n\r<br />When CleverWeb is available to beta test";
}
if(!$noupdates==1){
  $body .= "\n\r<br />Project Updates";
}
$body .= "</b><br /><br />\n\n\r\r";
$body .= "";
# add more fields here if required


cw_mail("Nicholas Jordon | Founder of CleverWeb <noreply@projcleverweb.com>",$to,$subject,$body);


// header( "Location: thankyou.php" );
echo $_REQUEST['firstname']."<br />\n\r";
echo $_REQUEST['lastname']."<br />\n\r";
echo $_REQUEST['email']."<br />\n\r";
echo $_REQUEST['beta']."<br />\n\r";
echo $_REQUEST['noupdates']."<br />\n\r";
echo $body;
?>