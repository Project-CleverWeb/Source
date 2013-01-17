<?php
/**
 * Description: Random Color Generator v1
 * Produces a string of hexdecimal color.
 * -----END DESCRIPTION-----
 */
function cw_randcolor($pound_sign=NULL) {
  $length = 6;
  $characters = "0123456789ABCDEF";
  // this part is done oddly due to it will otherwise error.
  // it kept being one char place short randomly however not consistantly.
  for ($count = 1; ; $count++) {
    if (strlen($color)==$length) {
      break;
    }
    $color .= $characters[mt_rand(0, strlen($characters))];
  }
  if(!$pound_sign==false){
    $color = "#".$color;
  }
  return $color;
}
?>