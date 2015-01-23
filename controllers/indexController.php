<?php
class indexController extends Controller{

	public function __construct($name, $action){
		parent::__construct($name, $action);
		// $this->invoices = $this->loadModel('invoice');
	}

	public function index(){
		// Session::access(1);
		$this->_view->renderView();	
	}
}