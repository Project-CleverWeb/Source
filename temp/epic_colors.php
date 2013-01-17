<?php
class epic {
  function randColor() {
    $characters = "0123456789ABCDEF";
    while($count<6){
      $color .= $characters[mt_rand(0,15)];
      $count++;
    }
    return $color;
  }
  
  function randChar(){
    $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    return $chars[mt_rand(0,35)];
  }
  
  function epicColors($repeat){
    $repeat++;
    while($count<$repeat){
      echo '<span style="color:#'.self::randColor().'; background:#'.self::randColor().'">&nbsp;'.self::randChar().PHP_EOL.'    </span>';
      $count++;
    }
  }
}
?><!DOCTYPE html>
<html>
  <head>
    <title>EPIC COLORS!</title>
  </head>
<body>
  <div style="font-size:20px; width:100%; font-family:Courier New, monospace">
    <?php echo (isset($_GET['num']) ? epic::epicColors($_GET['num']) : epic::epicColors(10000)); ?>
  
  </div>
</body>
</html>