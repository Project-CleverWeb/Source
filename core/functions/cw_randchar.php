<?php
/**
 * Description: Random Character Generator (Alpha-Numeric) v2.1
 * Produces a string of random characters.
 * Produces up to 2000 random chars. an will convert a
 * non-numerical string into a rand string of equal length.
 * Has a variable to allow spaces as an option(default is false).
 * -----END DESCRIPTION-----
 * Published under GNU Public License Version 3 for:
 * CleverWeb (aka "Project CleverWeb" or "(The) CleverWeb Project")
 *
 * Visit http://projcleverweb.com for project details.
 * Visit http://www.gnu.org/licenses/gpl-3.0.html for license details.
 *
 * CleverWeb exclusively allows:
 * Any note(s) declared by a "//" or any declared "description(s)" are 
 * optional includes to this script and can be removed without
 * replacement or changelog without violating the license.
 * Removal of this notice or any license information is not allowed,
 * without compliace to the license.
 * Custom fucntions produced by CleverWeb are included as Intelletual
 * objects.
 */
function cw_randchar($length=NULL,$case=NULL,$spaces=NULL) {
  // Removes "," chars if it is a number
  if(!is_numeric($length)){
    $temp_length = $length;
    if(strstr($length,",")){
      $length = preg_replace("/[,]*/","",$length);
      if(!is_numeric($length)){
        $length = strlen($temp_length);
      }
    }
    elseif(!is_numeric($length)){
      $length = strlen($length);
    }
  }
  if($length==NULL||$length==0){
    // Best password length
    $length = 8;
  }
  // 2000 seems enough?
  if($length>2000){
    $length = 2000;
  }
  // numbers done twice so their % chance stays the same
  $characters = "0123456789abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  $length = ceil($length);
  if(stristr($case,"lower")){
    $characters = "0123456789abcdefghijklmnopqrstuvwxyz";
    $case = true;
  }
  if(stristr($case,"upper")){
    $characters = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $case = true;
  }
  if($spaces==true){
    // 8 spaces to make it seem more like encrypted words
    $characters .= "        ";
    if(!$case==true){
      // 8 more if both capital and lower-case letters
      $characters .= "        ";
    }
  }
  if(!is_bool($spaces)){
    // return error msg
    /**
     * NOTE: the error class, function and/or message is not published
     * in this function but is respectfully included as part of this
     * function as an "intellectual" object under CleverWeb's license.
     */
  }
  // this part is done oddly due to it will otherwise error.
  // it kept being one char place short randomly however not consistantly.
  for ($count = 1; ; $count++) {
    if (strlen($string)==$length) {
      break;
    }
    $string .= $characters[mt_rand(0, strlen($characters))];
  }
  return $string;
}
?>