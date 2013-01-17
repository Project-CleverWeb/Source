<?php


class DefaultController extends ControllerPrime {

	public function __construct($model){
		parent::__construct($model);
	}
	
	
	/**	Public Methods **/
	public function index(){
		$this->set('title','Welcome');
	}
	public function contact(){
		$this->set('title','Contact US');
		$this->Template->view = 'contact';
		if(POST){
			$requiredFields = (strlen($_POST['name']) > 0 && strlen($_POST['email']) > 5 && strlen($_POST['message']) > 10);
			if($requiredFields){
				$this->set('name', $_POST['name']);
				$this->set('email', $_POST['email']);
				$this->set('message',$_POST['email']);
				$this->Template->action = 'thankyou';
			}else{
				$this->set('message',$this->errorMsg('** All Fields are required **'));
			}
		}
	}
	public function progress(){
		$this->set('title','Progress');
		$this->Template->view = 'progress';
	}
	public function design(){
		$this->set('title','Progect Design');
		$this->Template->view = 'design';
	}
	public function error($num='404'){
		// 2BCompleted - Error Headers
		echo '<h1>' . $num . ' Error</h1>';
		$this->Template->render = false;
	}
}