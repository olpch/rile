<?php
class coreController extends Controller{

	public function __construct($name, $action){
		parent::__construct($name, $action);
	}

	public function index(){
	}

	public function dashboard(){
		//Session::access(1);
		$this->_view->mnuTab = 'Dashboard';
		//$this->_view->renderView();
		$this->_view->renderContent();
	}
}