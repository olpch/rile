<?php
class invoiceController extends Controller{

	public function __construct($name, $action){
		parent::__construct($name, $action);
		$this->invoices = $this->loadModel('invoice');		
		$this->_view->mnuTab = 'Invoices';
	}

	public function index(){
		$this->_view->invoices = $this->invoices->all();
		$this->_view->nombre = 'omar lee es la verga!!';
		$this->_view->renderView();
	}

	public function create(){
		$this->_view->newid  =  $this->invoices->newId();
		$this->_view->details = $this->invoices->details($this->_view->newid-2);
		/*$this->showpre($this->_view->details, true);*/
		$this->_view->renderContent();
	}

	public function destroy(){
		echo '{"messaje": "now 2 destroyed item!!"}';
	}

	public function details($invoice){
		$response = $this->invoices->details($invoice);
		toResponse('200', $response);
	}

	public function show($invoice){
		$response = $this->invoices->find($invoice);
		toResponse('200', $response);
	}

}

