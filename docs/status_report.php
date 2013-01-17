<?php

if($verified==true){

$to      = 'ceo@projcleverweb.com';
$subject = 'Weekly Report';
$message = 'This is a test of cron jobs: '.date("n/j/Y")." - ".date("g:i a");
$headers = 'From: noreply@projcleverweb.com' . "\r\n" .
    'Reply-To: noreply@projcleverweb.com' . "\r\n" .
    'X-Mailer: CleverWeb-Mailer/pre-alpha';

mail($to, $subject, $message, $headers);
echo "to: ".$to."<br />";
echo "subject: ".$subject."<br />";
echo "message: ".$message."<br /><br />";
echo "headers: ".$headers;
}
else{
echo "invalid command";
}

?>