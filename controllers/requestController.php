<?php
class requestController extends Controller{

	public function __construct($name, $action){
		parent::__construct($name, $action);
		$this->requests = $this->loadModel('request');
	}

	public function index(){
		// Session::access(1);
		$this->_view->requests = $this->requests->all();
		$this->_view->renderContent();
	}

	public function create(){
		// Session::access(1);
		$this->_view->requests = $this->requests->all();
		$this->_view->renderContent();
	}

	public function show($id){
		// Session::access(1);
		$this->_view->student = $this->students->find($id);
		/*echo '<pre>';
		print_r($this->_view->student);
		echo '<pre>';
		die();*/
		$this->_view->renderContent();
	}
	public function edit($id){
		// Session::access(1);
		$this->_view->student = $this->students->find($id);
		$this->_view->renderContent();
	}

	public function test($id){
		// Session::access(1);
		//$this->_view->student = $this->students->find($id);
		$this->_view->renderContent();
	}
}