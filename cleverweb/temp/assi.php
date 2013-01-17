<?php

/**
 * Assignment
 * -----------------
 * This page is the registation and login page. The page forwards POST
 * data to the mock API and fetches the results thru cURL. Using the 
 * results, it determines what to show on the page.
 * 
 * I did take some extra time to organize the page and add a "Raw Output"
 * section.
 */


// not needed for assignment, but makes it a bit easier on me.
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
  
  // All destroy functions are not finished.
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
  protected function helper($clear=FALSE){
    static $count;
    if($clear===TRUE){
      $count = 0;
      return $count;
    }
    else{
      return $count++;
    } 
  }
  public function output_spacing($spacing=NULL){
    static $count;
    if(!isset($count)$$){
      $count = 2;
    }
    if(is_int($spacing)){
      $count=$spacing;
    }
    else{
      return str_repeat(" ", $count);
    }
  }
  public function stroutput($source=NULL,$clear_on_print=FALSE){
    $spacing = self::output_spacing();
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
        $valindent = str_repeat($spacing,self::indentnum()+1);
        $indent = str_repeat($spacing,self::indentnum());
        if(!self::helper()==0){
          $addme = "[".$key."] => ";
        }
        if(is_array($value)){
          $return .= $PHP_EOL.$indent.$addme."Array {".PHP_EOL;
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
            $return .= $valindent."[".$subkey."] => ".$type;
            if(!is_null($subvalue)){
              $return .= " { ";
              self::indentnum(2);
              $recursive = TRUE;
              $r_test = self::stroutput($subvalue);
              if(strlen($r_test)>((self::indentnum()*strlen($spacing))+1)){
                $return .= $r_test;
              }
              $recursive = FALSE;
              self::indentnum(-2);
              $return .= PHP_EOL.$valindent."}";
            }
            $return .= PHP_EOL;
          }
          $return .= $indent."}";
        }
        elseif(is_bool($value)){
          if($value===TRUE){
            $value = "TRUE";
          }
          else{
            $value = "FALSE";
          }
          $return .= $PHP_EOL.$indent.$addme."Boolean {".PHP_EOL.$valindent.$value.PHP_EOL.$indent."}";
        }
        elseif(is_null($value)){
          $thistype = gettype($value);
          $thistype[0] = strtoupper($thistype[0]);
          $return .= $PHP_EOL.$indent.$addme.$thistype;
        }
        elseif(is_object($value)||is_resource($value)){
          if(is_object($value)){
            $value = get_class($value);
            $thistype = "Class";
          }
          elseif(is_resource($value)){
            $thistype = "Resource";
          }
          $return .= $PHP_EOL.$indent.$addme.$thistype." {".PHP_EOL.$valindent.$value.PHP_EOL.$indent."}";
        }
        else{
          $thistype = gettype($value);
          $thistype[0] = strtoupper($thistype[0]);
          $return .= $PHP_EOL.$indent.$addme.$thistype." {".PHP_EOL.$valindent.$value.PHP_EOL.$indent."}";
        }
      }
      self::helper(TRUE);
    }
    else{
      $valindent = str_repeat($spacing,self::indentnum()+1);
      $indent = str_repeat($spacing,self::indentnum());
      $return .= PHP_EOL.$indent.$echo;
    }
    if($clear_on_print==TRUE){
      return self::input(NULL,TRUE);
    }
    return $return;
  }
  public function output($source=NULL,$clear_on_print=FALSE){
    $spacing = self::output_spacing();
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
        $valindent = str_repeat($spacing,self::indentnum()+1);
        $indent = str_repeat($spacing,self::indentnum());
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
              $r_test = self::stroutput($subvalue);
              if(strlen($r_test)>((self::indentnum()*strlen($spacing))+1)){
                echo self::stroutput($subvalue);
              }
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
      self::helper(TRUE);
    }
    else{
      $valindent = str_repeat($spacing,self::indentnum()+1);
      $indent = str_repeat($spacing,self::indentnum());
      echo PHP_EOL.$indent.$echo;
    }
    if($clear_on_print==TRUE){
      return self::input(NULL,TRUE);
    }
  }
}
// END not needed section


// easy access to sanitation and validation
class validators {
  public function filter_formdata($filter,$data){
    $filter = strtolower($filter);
    switch ($filter) {
      case 'email':
        $return = strtolower(filter_var($data,FILTER_SANITIZE_EMAIL));
        break;
      case 'string':
        $return = filter_var($data,FILTER_SANITIZE_STRING,array('flags' => FILTER_FLAG_ENCODE_HIGH));
        break;
      case 'int':
        $return = filter_var($data,FILTER_SANITIZE_NUMBER_INT);
        break;
      case 'url':
        $return = filter_var($data,FILTER_SANITIZE_URL);
        break;
      case 'special':
        $return = filter_var($data,FILTER_SANITIZE_SPECIAL_CHARS,array('flags' => FILTER_FLAG_ENCODE_HIGH));
        break;
      case 'encoded':
        $return = filter_var($data,FILTER_SANITIZE_ENCODED,array('flags' => FILTER_FLAG_ENCODE_HIGH));
        break;
      default:
        $return = htmlspecialchars($data, ENT_QUOTES);
        break;
    }
    return $return;
  }
  
  public function email($email){
    if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',$email))
      return true;
    else 
      return false;
  }
  public function password($pass){
	/**
	 * Password Valdator
	 *
	 * must have 1+ capital letter(s)
	 * must have 1+ lowercase letter(s)
	 * must range betweeen 8-16 characters
	 * must contain no special characters
	 */
    if (ctype_alnum($pass)&&preg_match('/(?=^.{8,16}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/',$pass))
      return true;
    else 
      return false;
  }
  public function username($username){
    if (preg_match('/^[a-z\d_]{6,20}$/i',$username))
      return true;
    else 
      return false;
  }
  public function url($url){
    if (preg_match('/^(http|https):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i',$url))
      return true;
    else 
      return false;
  }
}

// Class to connect to and check the API
class mock_api{
  public function check($formdata){
    $verify = new validators;
    // only validating if the person is registering
    if($formdata['type']=='rform'){
      switch (FALSE) {
        case $verify->email($formdata['email']):
          return 'Failure';
        case $verify->password($formdata['password']):
          return 'Failure';
        case $verify->username($formdata['username']):
          return 'Failure';
        case $verify->url($formdata['website']):
          if(strlen($formdata['website'])>0){
            return 'Failure';
          }
        default:
          return self::response($formdata);
      }
    }
    else{
      return self::response($formdata);
    }
  }
  
  // connects to, and returns API response.
  private function response($formdata){
    $forminfo = 'type='.$formdata['type'].'&';
    $forminfo .= 'email='.$formdata['email'].'&';
    $forminfo .= 'fname='.$formdata['firstname'].'&';
    $forminfo .= 'lname='.$formdata['lastname'].'&';
    $forminfo .= 'usern='.$formdata['username'].'&';
    $forminfo .= 'pass='.$formdata['password'].'&';
    $forminfo .= 'web='.$formdata['website'];
    
    $ch = curl_init();    
    curl_setopt($ch,CURLOPT_URL,'projectcleverweb.com/emp_network/mock_api.php');  
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,5); 
    curl_setopt($ch, CURLOPT_POST,1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$forminfo);
    $response = curl_exec($ch);  
    curl_close($ch);
    
    return $response;
  }
}

/**
 * Usage
 */

// declare classes
$verify = new validators;
$print_r = new strprint_r;
$api = new mock_api;

// organizing into 1 variable
$formdata['firstname'] = $verify->filter_formdata('string', $_REQUEST['fname']);
$formdata['lastname'] = $verify->filter_formdata('string', $_REQUEST['lname']);
$formdata['email'] = $verify->filter_formdata('email', $_REQUEST['email']);
$formdata['password'] = $verify->filter_formdata('string', $_REQUEST['pass']);
$formdata['username'] = $verify->filter_formdata('string', $_REQUEST['usern']);
$formdata['website'] = $verify->filter_formdata('string', $_REQUEST['web']);
$formdata['type'] = $verify->filter_formdata('string', $_REQUEST['type']);

// Getting response
$response = $api->check($formdata);

?>
<html>
  <head>
    <title>Assignment</title>
  </head>
  <style type="text/css">
    body{
      padding-top: 30px;
    }
    div,table{
      width: 70%;
      margin-left: 15%;
      border: solid 1px;
      margin-top: 5px;
      background-color: #ccc;
      padding: 2px;
    }
    td{
      border: solid 1px;
      background-color: #ccc;
    }
    table{
      border: none;
      padding: 20px;
      background-color: transparent;
    }
    .attempts{
      margin-left: 50px;
    }
    
  </style>
  <body>
    <?php
    // if login/registration successfull
    if($response=='TRUE'||$response=='Success'){
      echo
    '<div class="success">
      showing member area';
    // if registering, say so
    if($response=='Success'){
      echo ', and the registration was successful!';
    }
    echo
    '<br />
      <a href="./assi.php">logout</a>
    </div>';
    }
    
    // if login fails
    elseif($response=='FALSE'){
      echo
    '<div class="l-fail">
      <b>Please try again.</b><br />
      Username: Sven<br />
      Password: Testing123
    </div>';
    }
    
    // if registration fails
    elseif($response=='Failure'){
      echo
    '<div class="r-fail">
      <b>Invalid registration information, please try again.</b>
    </div>';
    }
    
    // if any nothing has been done or there has been a failure show the form
    if($response=='FALSE'||$response=='Failure'||$response=='Nothing'){
      echo
    '<table class="form"><tr><td>
      <h3 style="padding-left: 15px">Registration Form</h3>
      <form class="form" name="form" method="POST" style="padding:25px; width:100%">          
        <b>Name:</b> <span style="color:red">*</span><br />
        <input type="text" name="fname" size="20" placeholder="First Name" maxlength="25" width="50%" style="border: solid 1px">
        <input type="text" name="lname" size="20" placeholder="Last Name" maxlength="25" width="50%" style="border: solid 1px">
        <br /><br />
        <b>Email:</b> <span style="color:red">*</span><br />
        <input type="email" name="email" placeholder="user@example.com" size="30" maxlength="35" style="border: solid 1px"><br /><br />
        <b>Username:</b> <span style="color:red">*</span><br />
        <input type="text" name="usern" placeholder="awesome_person123" size="30" maxlength="25" style="border: solid 1px"><br /><br />
        <b>Password:</b> <span style="color:red">*</span><br />
        <input type="password" name="pass" placeholder="Secret123" size="30" maxlength="16" style="border: solid 1px"><br /><br />
        <b>Website:</b><br />
        <input type="text" name="web" placeholder="http://example.com" size="30" maxlength="50" style="border: solid 1px"><br /><br />
        <input type="hidden" name="type" value="rform" />
        <input type="submit" value="Submit" />
      </form>
      
      </td>
      <td>
      
      <h3 style="padding-left: 15px">Login Form</h3>
      <form class="form" name="l-form" method="POST" style="padding:25px; width:100%">
        <b>Username:</b> <span style="color:red">*</span><br />
        <input type="text" name="usern" placeholder="awesome_person123" size="30" maxlength="25" style="border: solid 1px"><br /><br />
        <b>Password:</b> <span style="color:red">*</span><br />
        <input type="password" name="pass" placeholder="Secret123" size="30" maxlength="16" style="border: solid 1px"><br /><br />
        <input type="hidden" name="type" value="lform" />
        <input type="submit" value="Submit" />
      </form>';
    }
    ?>
      
      </tr></table>
    <div class="print_r">
      <h3 style="padding-left: 15px">Raw Output</h3>
      $api->check($formdata) =<br />
      <?php
      // printing result from mock API
        $print_r->add($api->check($formdata)); // adding data
        $print_r->output_spacing(12); // adjusting so the HTML is easier to read
        echo str_replace("\n","<br />\n",str_replace(" ","&nbsp;",$print_r->stroutput()))."</span>"; // convert to HTML and print
      ?>
    </div>
  </body>
</html>