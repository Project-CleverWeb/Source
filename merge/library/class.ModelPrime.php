<?php


class ModelPrime extends Prime {
	protected $_conn;
	

	/**	Magic Methods	**/
	public function __construct(){
		
		parent::__construct();
	}
	public function __destruct(){
	
		parent::__destruct();
	}
	
	/**	Protected Methods	**/
	
	/**	Public Methods	**/
	public function connect($host,$user,$pass,$dbname){
		if(!is_resource($this->_conn)){
			$this->_conn = mysql_connect($host, $user, $pass) or $this->_func_err('connect','Cannot Connect to MySQL Server.<br>Reason: ' . mysql_error($this->_conn));
			if($this->_conn){
				mysql_select_db($dbname, $this->_conn) or $this->_func_err('connect','Cannot Select MySQL Database.<br>Reason: ' . mysql_error($this->_conn));
			}
			return $this->_conn;
		}
	}
	
	/**	Public Static Methods	**/

}