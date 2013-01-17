<?php
// Works like date() except has a default
function CW_Date($custom=NULL){
 if($custom==NULL){
   return date("n/j/Y"); // The Date [MM/DD/YYYY]
 }
 else{
   return date($custom); // Changes the date type
 }
}
?>