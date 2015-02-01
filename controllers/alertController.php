<?php
class alertController extends Controller{

	public function __construct($name, $action){
		parent::__construct($name, $action);
		$this->alerts = $this->loadModel('alert');
	}

	public function index(){
		//Session::access(1);
		$this->_view->sesenta       = $this->alerts->sesenta();
		$this->_view->lectivas      = $this->alerts->lectiva();
		$this->_view->vencidas      = $this->alerts->vencida();
		$this->_view->productivas   = $this->alerts->productiva();
		$this->_view->entrevistados = $this->alerts->entrevistados();
		$this->_view->renderContent();
	}


	public function newConvention(){
		
		$this->_view->renderContent();
	}

	public function test(){		
		$this->_view->entrevistados = $this->alerts->entrevistados();
		$this->_view->renderContent();
	}

}