<?php
class enterpriseController extends Controller{

	public function __construct($name, $action){
		parent::__construct($name, $action);
		$this->enterprises = $this->loadModel('enterprise');
		// $this->_view->mnuTab = 'Stock';
	}

	public function index(){
		// Session::access(1);
		$this->_view->enterprises = $this->enterprises->all();
		$this->_view->renderContent();
		die();
	}
	
	public function edit($id){
		// Session::access(1);
		//$this->_view->enterprises = $this->enterprises->all();
		$this->_view->renderContent();
		die();
	}

	public function index2(){
		// Session::access(1);
		$this->_view->enterprises = $this->enterprises->all();
		echo '<pre>';
		print_r($this->_view->enterprises);
		echo '<pre>';
		die();
	}

	public function create(){
		// echo '<pre>';
		// print_r($_POST);
		// echo '<pre>';
		header('Content-Type: application/json');
		echo json_encode($_POST);
		die();	
	}

	public function update(){
		echo '<pre>';
		print_r($_POST);
		echo '<pre>';
		die();	
	}

}