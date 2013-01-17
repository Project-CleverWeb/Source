<?php

/**
 * Mobile Detect
 * @license    http://www.opensource.org/licenses/mit-license.php The MIT License
 */
class Mobile_Detect
{

	protected $accept;
	protected $userAgent;
	protected $isMobile = false;
	protected $isAndroid = null;
	protected $isAndroidtablet = null;
	protected $isIphone = null;
	protected $isIpad = null;
	protected $isBlackberry = null;
	protected $isOpera = null;
	protected $isPalm = null;
	protected $isWindows = null;
	protected $isWindowsphone = null;
	protected $isGeneric = null;
	protected $devices = array(
		"android" => "android.*mobile",
		"androidtablet" => "android(?!.*mobile)",
		"blackberry" => "blackberry",
		"blackberrytablet" => "rim tablet os",
		"iphone" => "(iphone|ipod)",
		"ipad" => "(ipad)",
		"palm" => "(avantgo|blazer|elaine|hiptop|palm|plucker|xiino)",
		"windows" => "windows ce; (iemobile|ppc|smartphone)",
		"windowsphone" => "windows phone os",
		"generic" => "(kindle|mobile|mmp|midp|o2|pda|pocket|psp|symbian|smartphone|treo|up.browser|up.link|vodafone|wap|opera mini)"
	);

	public function __construct()
	{
		$this->userAgent = $_SERVER['HTTP_USER_AGENT'];
		$this->accept = $_SERVER['HTTP_ACCEPT'];

		if (isset($_SERVER['HTTP_X_WAP_PROFILE']) || isset($_SERVER['HTTP_PROFILE'])) {
			$this->isMobile = true;
		} elseif (strpos($this->accept, 'text/vnd.wap.wml') > 0 || strpos($this->accept, 'application/vnd.wap.xhtml+xml') > 0) {
			$this->isMobile = true;
		} else {
			foreach ($this->devices as $device => $regexp) {
				if ($this->isDevice($device)) {
					$this->isMobile = true;
				}
			}
		}
	}

	/**
	 * Overloads isAndroid() | isAndroidtablet() | isIphone() | isIpad() | isBlackberry() | isBlackberrytablet() | isPalm() | isWindowsphone() | isWindows() | isGeneric() through isDevice()
	 *
	 * @param string $name
	 * @param array $arguments
	 * @return bool
	 */
	public function __call($name, $arguments)
	{
		$device = substr($name, 2);
		if ($name == "is" . ucfirst($device) && array_key_exists(strtolower($device), $this->devices)) {
			return $this->isDevice($device);
		} else {
			trigger_error("Method $name not defined", E_USER_WARNING);
		}
	}

	/**
	 * Returns true if any type of mobile device detected, including special ones
	 * @return bool
	 */
	public function isMobile()
	{
		return $this->isMobile;
	}

	protected function isDevice($device)
	{
		$var = "is" . ucfirst($device);
		$return = $this->$var === null ? (bool) preg_match("/" . $this->devices[strtolower($device)] . "/i", $this->userAgent) : $this->$var;
		if ($device != 'generic' && $return == true) {
			$this->isGeneric = false;
		}

		return $return;
	}

}

/* @end license */

/*
This area determines whether the device browsing the site is a
known type of mobile device, using the google code above. See
original code at http://code.google.com/p/php-mobile-detect/
*/

function CW_Is_Mobile($Device_Type=NULL){
  $detect = new Mobile_Detect();
  if($Device_Type==NULL){
    if($detect->isAndroid()){
      return "android";
    }
	if($detect->isAndroidtablet()){
      return "androidtablet";
    }
	if($detect->isIphone()){
      return "iphone";
    }
	if($detect->isIpad()){
      return "ipad";
    }
	if($detect->isBlackberry()){
      return "blackberry";
    }
	if($detect->isBlackberrytablet()){
      return "blackberrytablet";
    }
	if($detect->isPalm()){
      return "palm";
    }
	if($detect->isWindowsphone()){
      return "windowsphone";
    }
	if($detect->isWindows()){
      return "windows";
    }
	if($detect->isGeneric()){
      return "generic";
    }
	  return false;
  }
  elseif(stristr($Device_Type,"bool")){
    if($detect->isMobile()==true){
	  return true;
	}
	else{
	  return false;
	}
  }
  else{
	if(stristr($Device_Type,"androidtablet")){
	  if($detect->isAndroidtablet()) return true;
	  return false;
	}
	elseif(stristr($Device_Type,"android")){
	  if($detect->isAndroid()) return true;
	  return false;
	}
	elseif(stristr($Device_Type,"iphone")){
	  if($detect->isIphone()) return true;
	  return false;
	}
	elseif(stristr($Device_Type,"ipad")){
	  if($detect->isIpad()) return true;
	  return false;
	}
	elseif(stristr($Device_Type,"blackberrytablet")){
	  if($detect->isBlackberrytablet()) return true;
	  return false;
	}
	elseif(stristr($Device_Type,"blackberry")){
	  if($detect->isBlackberry()) return true;
	  return false;
	}
	elseif(stristr($Device_Type,"palm")){
	  if($detect->isPalm()) return true;
	  return false;
	}
	elseif(stristr($Device_Type,"windowsphone")){
	  if($detect->isWindowsphone()) return true;
	  return false;
	}
	elseif(stristr($Device_Type,"windows")){
	  if($detect->isWindows()) return true;
	  return false;
	}
	elseif(stristr($Device_Type,"generic")){
	  if($detect->isGeneric()) return true;
	  return false;
	}
	else{return false;}
  }
}

define(cw_is_mobile,CW_Is_Mobile(),TRUE);
