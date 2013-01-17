<?php


class Prime {
	protected	$_debug;
	protected	$_error_msgs = Array();
	protected	$_error_count = 0;
	protected	$_className;
	
	/**	Magic Methods	**/
	public function __construct(){
		$this->_debug = (defined('DEBUG'))? DEBUG : false;
		$this->_className = get_class();
	}
	public function __destruct(){
		if($this->_error_count > 0){
			$this->_log_errors();
		}
	}
	
	/**	Protected Methods	**/
	protected function _err($m){
		$this->_error_count++;
		$this->_error_msgs[] = $m;
		if($this->_debug){
			echo $m;
			exit;
		}
		return false;
	}
	protected function _func_err($fn,$m){
		return $this->_err('[' . $this->_className . '::' . $fn . '() ERROR] ' . $m);
	}
	protected function _log_errors(){
		$str = implode(EOL, $this->_error_msgs);
		try {
			$fh = fopen(ROOT . DS . 'tmp' . DS . 'logs' . DS . $this->_className . '_errors.log', 'a');
			fwrite($fh, $str);
			fclose($fh);
		
		} catch (Exception $e){
			if($this->_debug){
				echo 'Error Log Write Failed!<br />Message: ' . $e->getMessage() . '<br />Class [' . $this->_className . '] Errors: <br>' . $str;
			}
		}
	}
	protected function _msg($t,$m='',$type='good'){
		if(!isset($m{0})){
			$m = $t;
			$t = 'Message';
		}
		return '<div class="' . $type . 'Msg">
			<h3>' . $t . '</h3>
			<p>' . $m . '</p>
		</div>';
	}
	
	/**	Public Methods	**/
	public function errorMsg($t,$m=''){
		if(!isset($m{0})){
			$m = $t;
			$t = 'Error';
		}
		return $this->_msg($t,$m,'error');
	}
	public function goodMsg($t,$m=''){
		return $this->_msg($t,$m,'good');
	}
}