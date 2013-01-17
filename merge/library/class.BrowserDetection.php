<?php



class BrowserDetection extends Prime {
	protected $_browscap;
	
	public $ua;
	

	/**	Magic Methods	**/
	public function __construct(){
		if(isset($_SESSION['CW']['BrowserDetection'])){
			$this->_pull_session_data();
		}else{
			$this->ua = $_SERVER['HTTP_USER_AGENT'];
			$this->_parse_ua();
		}
		parent::__construct();
	}
	public function __destruct(){
		parent::__destruct();
	}
	
	/**	Protected Methods	**/
	protected function _pull_session_data(){
		// Pulls previously determined data from session variable, and sets to appropriate info
	}
	protected function _parse_ua(){
		
	}
	protected function _load_browscap(){
		if(is_null($this->_browscap)){
			try{
				$this->_browscap = unserialize(file_get_contents( LIB . DS . 'AdditionalFiles' . DS . 'php_browscap.slz' ));
					return true;
				} catch (Exception $e) {
					return $this->_err('Could NOT load Additional File "browscap.slz". ErrorMsg: ' . $e->getMessage());
				}
		}else{
			return true;
		}
	}

}