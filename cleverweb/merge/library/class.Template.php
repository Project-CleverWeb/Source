<?php


class Template extends Prime {
	protected	$_vars = Array();
	protected $_template_data;
	
	public $action = 'index';
	public $view = 'index';
	public $render = true;

	/**	Magic Methods	**/
	public function __construct(){
		$this->_vars['page_description'] = PAGE_DESCRIPTION;
		$this->_vars['page_keywords'] = PAGE_KEYWORDS;
		$this->_vars['page_lang'] = PAGE_LANG;
		$this->_vars['page_subject'] = PAGE_SUBJECT;
		$this->_vars['page_robots'] = PAGE_ROBOTS;
		$this->_vars['page_googlebot'] = PAGE_GOOGLEBOT;
		$this->_vars['page_no_email_collection'] = PAGE_NO_EMAIL_COLLECTION;
		$this->_vars['page_revisit_after'] = PAGE_REVISIT_AFTER;
		$this->_vars['title'] = SITE_NAME_SHORT;
		$this->_vars['theme'] = 'default';
		$this->_vars['message'] = '';
		parent::__construct();
	}
	public function __destruct(){
		if($this->render){
			$this->render();
		}
		parent::__destruct();
	}
	
	/**	Protected Methods	**/
	protected function _get_template_data(){
		extract($this->_vars);
		
		// Header
		if(file_exists(ROOT . DS . 'applications' . DS . APPLICATION . DS . 'views' . DS . 'header.php')){
			require_once(ROOT . DS . 'applications' . DS . APPLICATION . DS . 'views' . DS . 'header.php');
		}else if(file_exists(ROOT . DS . 'applications' . DS . 'Default' . DS . 'views' . DS . 'header.php')){
			require_once(ROOT . DS . 'applications' . DS . 'Default' . DS . 'views' . DS . 'header.php');
		}
		$this->_template_data .= isset($template)? $template : '';
		unset($template);
		
		// Body
		if(file_exists(ROOT . DS . 'applications' . DS . APPLICATION . DS . 'views' . DS . $this->view . DS . $this->action . '.php')){
			require_once(ROOT . DS . 'applications' . DS . APPLICATION . DS . 'views' . DS . $this->view . DS . $this->action . '.php');
			$this->_template_data .= $template;
			unset($template);
		}else{
			error_404();
		}
		
		// Footer
		if(file_exists(ROOT . DS . 'applications' . DS . APPLICATION . DS . 'views' . DS . 'footer.php')){
			require_once(ROOT . DS . 'applications' . DS . APPLICATION . DS . 'views' . DS . 'footer.php');
		}else if(file_exists(ROOT . DS . 'applications' . DS . 'Default' . DS . 'views' . DS . 'footer.php')){
			require_once(ROOT . DS . 'applications' . DS . 'Default' . DS . 'views' . DS . 'footer.php');
		}
		$this->_template_data .= (isset($template))? $template : '';
	}
	
	/**	Public Methods	**/
	public function set($n,$v){
		$this->_vars[$n] = $v;
	}
	public function render(){
		$this->_get_template_data();
		echo $this->_template_data;
	}
	/**	Public Static Methods	**/

}