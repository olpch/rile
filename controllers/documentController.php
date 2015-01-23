<?php
class documentController extends Controller{

	public function __construct(){
		parent::__construct();
		$this->invoices = $this->loadModel('invoice');
	}

	public function index(){
		
		$response = $this->invoices->all();

		$this->toRender();
	}

	public function show($invoice){
		$response = $this->invoices->find($invoice);
		toResponse('200', $response);
	}

}