<?php
class contractController extends Controller{

	public function __construct($name, $action){
		parent::__construct($name, $action);
		$this->contracts = $this->loadModel('contract');
		// $this->_view->mnuTab = 'Stock';
	}

	public function index(){
		// Session::access(1);
		$this->_view->contracts = $this->contracts->all();
		$this->_view->renderContent();

		// echo '<pre>';
		// print_r($this->_view->students);
		// echo '<pre>';
		die();
	}

	public function show(){
		// Session::access(1);
		//$this->_view->contracts = $this->contracts->all();
		$this->_view->renderContent();
	}

	public function index2(){
		// Session::access(1);
		$this->_view->contracts = $this->contracts->all();
		echo '<pre>';
		print_r($this->_view->contracts);
		echo '<pre>';
		die();
	}
}