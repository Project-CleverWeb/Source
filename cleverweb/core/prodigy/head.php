<?
function CW_Gen_Head(){
  // get the cleverweb superglobal and 
  global $_CW;
  $desc = $_CW["head_desc"];
  $keywords = $_CW["head_keywords"];
  $revisit = $_CW["head_revisit"];
  $title = $_CW["site_title"];
  $something = $_CW[""];
  $something = $_CW[""];
  $something = $_CW[""];
  $something = $_CW[""];
  $something = $_CW[""];
}


$_CW["head"] = CW_Gen_Head();
echo $_CW["head"];
?>
