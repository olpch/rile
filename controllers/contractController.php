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
		$this->_view->types       = $this->contracts->types();
		$this->_view->contract    = $this->contracts->find($id);
		$this->_view->students    = $this->contracts->students();
		$this->_view->enterprises = $this->contracts->enterprises();
		/*echo '<pre>';
		print_r($this->_view->contract);
		echo '<pre>';
		die();*/
		$this->_view->renderContent();
	}

	public function update(){
		$this->contracts->update($_POST);
		echo '1';
	}

	public function create(){
		//Session::access(1);
		$this->_view->types       = $this->contracts->types();
		/*$this->_view->contracts   = $this->contracts->all();*/
		$this->_view->students    = $this->contracts->students();
		$this->_view->enterprises = $this->contracts->enterprises();
/*		echo '<pre>';
		print_r($this->_view->enterprises);
		echo '<pre>';
		die();*/
		$this->_view->renderContent();
	}

	public function newo(){
		$this->contracts->create($_POST);
		echo '1';
	}

	public function disable($id){
		$this->contracts->anular($id);
		echo '1';	
	}

}