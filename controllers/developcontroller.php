<?php
class developController extends Controller{

	public function __construct($name, $action){
		parent::__construct($name, $action);
	}

	public function index(){;}

	public function routes(){
		global $routes;

		echo '<table style="width: 100%;" border="1">';
		echo '<thead><tr><th style="width: 90px;"> HTTP Verb</th>';
		echo '<th>Path</th><th>controller#Action</th></tr></thead><tbody>';
		foreach ($routes->rlist() as $route) {
			echo '<tr>';
			echo '<td style="width: 90px;"> '. $route->method() . '</td><td>';
			echo $route->expr() . '</td><td>' . '</td>';
			echo '</tr>';
		}
		echo '</tbody></table>';
		echo '<br/><h1 style="background: #000; color: #fff; padding: 2px 15px;">Fin del API - Blackcore</h1>';
		die();
	}


	public function test(){
		$this->_view->mnuTab = 'invoices';
		$this->_view->renderView();
	}
}