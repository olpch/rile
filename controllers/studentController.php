<?php
class studentController extends Controller{

	public function __construct($name, $action){
		parent::__construct($name, $action);
		$this->students = $this->loadModel('student');
		// $this->_view->mnuTab = 'Stock';
	}

	public function index(){
		// Session::access(1);
		$this->_view->students = $this->students->all();
		$this->_view->renderContent();

		// echo '<pre>';
		// print_r($this->_view->students);
		// echo '<pre>';
		die();
	}

	public function index2(){
		// Session::access(1);
		$this->_view->students = $this->students->all();
		echo '<pre>';
		print_r($this->_view->students);
		echo '<pre>';
		die();
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