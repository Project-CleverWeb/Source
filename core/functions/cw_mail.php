<?php
function cw_mail($from,$to,$subject=NULL,$message=NULL,$reply_to=NULL,$cc=NULL,$bcc=NULL){
  // support for multi emails comming soon!
  // edit for display name!
  if($subject==NULL){
    $subject = 'No Subject';
  }
  if($message==NULL){
    $message = '[No Body]';
  }
  if($reply_to==NULL){
    $reply_to = $from;
  }
  if(strstr($from,'<')){
    preg_match('/<(.*)>/',$from,$return);
	$return = $return[1];
  }
  else{
    $return = $from;
  }
  $headers  = 'MIME-Version: 1.0'.PHP_EOL;
  $headers .= 'Content-type: text/html; charset=iso-8859-1'.PHP_EOL;
  $headers .= 'Return-Path: '.$return.PHP_EOL;
  $headers .= 'From: '.$from.PHP_EOL;
  $headers .= 'Reply-To: '.$return.PHP_EOL;
  $headers .= 'X-Mailer: CleverWeb-Mailer/Pre-Alpha'.PHP_EOL;
  $headers .= 'User-Agent: CleverWeb Webmail for '.$_SERVER['HTTP_HOST'].PHP_EOL;
  if(is_array($cc)){
	$headers .= "Cc: ";
    foreach($cc as $person){
      $headers .= $person.",";
	}
	$headers .= PHP_EOL;
  }
  if(is_array($Bcc)){
	$headers .= "Bcc: ";
    foreach($Bcc as $person){
      $headers .= $person.",";
	}
	$headers .= PHP_EOL;
  }
  // Returns TRUE if the mail was successfully accepted for delivery, FALSE otherwise.
  return mail($to, $subject, $message, $headers, '-f'.$return.' O DeliveryMode=b');
}
?>