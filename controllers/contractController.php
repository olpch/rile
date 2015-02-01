<?php
class contractController extends Controller{

	public function __construct($name, $action){
		parent::__construct($name, $action);
		$this->contracts = $this->loadModel('contract');
		$this->students = $this->loadModel('student');
		$this->enterprises = $this->loadModel('enterprise');
		// $this->_view->mnuTab = 'Stock';
	}

	public function index(){
		Session::access(1);
		$this->_view->contracts = $this->contracts->all();
		$this->_view->renderContent();
		die();
	}

	public function show($id){
		// Session::access(1);
		$this->_view->contracts = $this->contracts->find($id);
		$this->_view->renderContent();
	}

	public function create(){
		//Session::access(1);
		$this->_view->contracts   = $this->contracts->all();
		$this->_view->students    = $this->contracts->students();
		$this->_view->enterprises = $this->contracts->enterprises();
/*		echo '<pre>';
		print_r($this->_view->enterprises);
		echo '<pre>';
		die();*/
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