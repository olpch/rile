<?php
class notifyController extends Controller{

	public function __construct($name, $action){
		parent::__construct($name, $action);
		//$this->categories = $this->loadModel('notify');
	}

	public function index(){
		//Session::access(1);
		//$this->_view->allCategories = $this->categories->all();
		$this->_view->renderView();
	}

}