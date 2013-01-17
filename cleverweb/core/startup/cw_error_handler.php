<?php



class strprint_r{
  public function __construct() {
    if(isset($input)){
      self::add($input,$id);
    }
  }
  
  protected function input($input=NULL,$clear=FALSE,$id=NULL){
    static $return;
    if(isset($input)){
      $return[] = $input;
      return TRUE;
    }
    elseif($clear==TRUE&&isset($id)){
      if(isset($return[$id])){
        unset($return[$id]);
        return TRUE;
      }
      return FALSE;
    }
    elseif($clear==TRUE){
      unset($return);
      return TRUE;
    }
    else{
      return $return;
    }
  }

  public function add($input,$id=NULL){
    return self::input($input);
  }
  public function subtract($id){
    return self::input(NULL,TRUE,$id);
  }
  public function clear(){
    return self::input(NULL,TRUE);
  }
  
  protected function destroy($needle=NULL,$resource=NULL){
    if((!isset($resource))&&isset($needle)){
      foreach($resource as $key=>$value){
        if(is_array($value)){
          
        }
        elseif((!is_object($value))&&(!is_resource($value))){
          
        }
        elseif(is_bool($value)){
          
        }
        else{
          if(strpos($haystack,$value)){
            unset($resource[$key]);
          }
        }
      }
    }
    elseif((!isset($needle))&&isset($resource)){
      
    }
    else{
      // error
    }
    
    
  }

  public function strdestroy($needle,$reverse=FALSE){
    if($reverse==TRUE){
      
    }
    else{
      
    }
  }
  public function stridestroy($needle,$reverse=FALSE){
    if($reverse==TRUE){
      
    }
    else{
      
    }
  }
  
  protected function indentnum($num=0){
    static $indent;
    $indent = ($indent+($num));
    return $indent;
  }
  protected function helper(){
    static $count;
    return $count++;
  }
  public function output($source=NULL,$clear_on_print=FALSE){
    static $recursive;
    if($recursive===TRUE){
      $PHP_EOL = PHP_EOL;
    }
    else{
      $PHP_EOL = "";
    }
    if(isset($source)){
      $echo = $source;
    }
    else{
      $echo = self::input();
    }
    if(is_array($echo)){
      foreach($echo as $key => $value){
        $valindent = str_repeat("   ",self::indentnum()+1);
        $indent = str_repeat("   ",self::indentnum());
        if(!self::helper()==0){
          $addme = "[".$key."] => ";
        }
        if(is_array($value)){
          echo $PHP_EOL.$indent.$addme."Array {".PHP_EOL;
          foreach($value as $subkey => $subvalue){
            if(is_array($subvalue)){
              $type = "Array";
              $line = PHP_EOL;
            }
            elseif(is_bool($subvalue)){
              $type = "Boolean";
              if($subvalue===TRUE){
                $subvalue = "TRUE";
              }
              else{
                $subvalue = "FALSE";
              }
            }
            elseif(is_object($subvalue)||is_resource($subvalue)){
              if(is_object($subvalue)){
                $subvalue = get_class($subvalue);
                $type = "Class";
              }
              else{
                $type = "Resource";
              }
            }
            else{
              $type = gettype($subvalue);
              $type[0] = strtoupper($type[0]);
            }
            echo $valindent."[".$subkey."] => ".$type;
            if(!is_null($subvalue)){
              echo " { ";
              self::indentnum(2);
              $recursive = TRUE;
              self::output($subvalue);
              $recursive = FALSE;
              self::indentnum(-2);
              echo PHP_EOL.$valindent."}";
            }
            echo PHP_EOL;
          }
          echo $indent."}";
        }
        elseif(is_bool($value)){
          if($value===TRUE){
            $value = "TRUE";
          }
          else{
            $value = "FALSE";
          }
          echo $PHP_EOL.$indent.$addme."Boolean {".PHP_EOL.$valindent.$value.PHP_EOL.$indent."}";
        }
        elseif(is_null($value)){
          $thistype = gettype($value);
          $thistype[0] = strtoupper($thistype[0]);
          echo $PHP_EOL.$indent.$addme.$thistype;
        }
        elseif(is_object($value)||is_resource($value)){
          if(is_object($value)){
            $value = get_class($value);
            $thistype = "Class";
          }
          elseif(is_resource($value)){
            $thistype = "Resource";
          }
          echo $PHP_EOL.$indent.$addme.$thistype." {".PHP_EOL.$valindent.$value.PHP_EOL.$indent."}";
        }
        else{
          $thistype = gettype($value);
          $thistype[0] = strtoupper($thistype[0]);
          echo $PHP_EOL.$indent.$addme.$thistype." {".PHP_EOL.$valindent.$value.PHP_EOL.$indent."}";
        }
      }
    }
    else{
      $valindent = str_repeat("   ",self::indentnum()+1);
      $indent = str_repeat("   ",self::indentnum());
      echo PHP_EOL.$indent.$echo;
    }
    if($clear_on_print==TRUE){
      return self::input(NULL,TRUE);
    }
  }
}



class error_handle {
  public function __construct() {
    
  }
  public function __destruct() {
    global $_CW;
    if(self::catch_interror()){
      exit(
        "Fatal Error inside error handler\n".
        "Printing Error:\n\n".
        print_r(self::catch_interror()).
        "\nExiting..."
      );
    }
    if(self::catch_interror(true)&&$_CW['settings']['silent_errors']==true){
      
        echo "Fatal Error inside error handler\n";
        echo "Printing Error:\n\n";
        print_r(self::catch_interror(true));
        echo "\nExiting...";
      exit();
    }
  }

  // Internal Error Handling
  protected function log_interror($error=NULL){
    static $return;
    if(isset($error)){
      $return[] = $error;
    }
    else{
      return $return;
    }
  }
  protected function log_silent_interror($error=NULL){
    static $return;
    if(isset($error)){
      $return[] = $error;
    }
    else{
      return $return;
    }
  }
  protected function catch_interror($return_silent=NULL){
    $return = FALSE;
    if($return_silent==TRUE){
      if(self::log_silent_error()){
        $return['silent'] = self::log_silent_interror();
      }
    }
    if(self::log_interror()){
      $return['normal'] = self::log_interror();
    }
    return $return;
  }
  public function log_interror_tofile($return_silent=NULL){
    // stuff
  }
  
  // User Error Handling
  public function user_error($type){
    self::log_interror("hi");
  }
  
  // Plugin Error Handling
  public function plugin_error($type){
    // stuff
  }
  
  // Theme Error Handling
  public function theme_error($type){
    // stuff
  }

  // Var Error Handling
  public function var_check($type,$input){
    // stuff
  }
  
  // PHP Error Handling
  public function php_error($errno, $errstr, $errfile, $errline, $errcontext){
    // stuff
  }

  // CleverWeb Error Handling
  public function cw_error($type){
    // stuff
  }
  
}


$print_r = new strprint_r;
$print_r->add(FALSE);
$print_r->output();

?>