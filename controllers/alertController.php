<?php
class alertController extends Controller{

	public function __construct($name, $action){
		parent::__construct($name, $action);
		$this->config = $this->loadModel('config');
	}

	public function index(){
		//Session::access(1);
		// $this->_view->conventions = $this->config->conventions();
		// $this->_view->programs    = $this->config->programs();
		// $this->_view->modules     = $this->config->modules();
		// //$this->_view->renderView();
		$this->_view->renderContent();
	}


	public function newConvention(){
		
		$this->_view->renderContent();
	}

	public function fee(){
		
		$this->_view->renderContent();
	}

}