<?php


class ControllerPrime extends Prime {
	public $Model;
	public $Template;

	/**	Magic Methods	**/
	public function __construct($model){
		$this->Model = new $model();
		$this->Template = new Template();
		parent::__construct();
	}
	public function __destruct(){
		parent::__destruct();
	}
	
	/**	Protected Methods	**/
	
	/**	Public Methods	**/
	public function set($n,$v){
		$this->Template->set($n, $v);
	}
	/**	Public Static Methods	**/

}