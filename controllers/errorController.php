<?php
class errorController extends Controller{

	public function __construct($name, $action){
		parent::__construct($name, $action);
	}

	public function index(){
		$this->_view->renderContent();
	}

	public function code404(){
		$this->_view->renderContent();
	}
}