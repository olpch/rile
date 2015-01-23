<?php

class View {

	private $_controller;
	private $_name;

	public function __construct($cntl = 'index', $name = 'index') {
		$this->_controller = $cntl;
		$this->_name = $name;
	}

	function renderView($layout = 'index', $type = false) {
		$pathfile = ROOT.'views'.DS.'layout'.DS.$layout;
		if(!$type){
			header('Content-type: text/html');
			if (is_readable($pathfile.'.phtml')) {
				include_once $pathfile.'.phtml';
			} 
			else {
				throw new Exception('Error<br/>no se encuentra el layout: [' . $pathfile.'.phtml]');
			}
	        // http_response_code($status_code);
	        // header('Content-type: application/json');
	        // echo json_encode($response);
		}
		die();
	}

	function renderLayout($layout = 'index') {
		$pathfile = ROOT.'views'.DS.'layout'.DS.$layout;
		if (is_readable($pathfile.'.phtml')) {
			include_once $pathfile.'.phtml';
		} 
		else {
			echo '<br/> Error<br/>no se encuentra el layout: [' . $pathfile.'.phtml]<br/>';
		}
	}

	public function renderContent($vista = false){
		$pathfile = ROOT.'views'.DS.$this->_controller.DS;
		$pathfile .= (!$vista) ? $this->_name : $vista;
		/*echo '<br/>['.$pathfile.']';*/
		if (is_readable($pathfile.'.phtml')) {
			include_once $pathfile.'.phtml';
		} 
		else {
			throw new Exception('<br/>no se encuentra la vista: [' . $pathfile.'.phtml]');
		}
   }

	function getJS($js){
		echo '<script type="text/javascript" src="';
		echo BASE_URL.'assets/js/'.$js.'.js"></script>';
	}

	function getCSS($css){
		echo '<link rel="stylesheet" type="text/css" href="';
		echo BASE_URL.'assets/css/'.$css.'.css">';
	}

	function getFavicon(){
		echo '<link rel="shortcut icon" type="image/x-icon" href="';
		echo BASE_URL.'assets/img/favicon.ico" />';
	}

	function googleFont($font){
		echo '<link rel="stylesheet" type="text/css" ';
		echo 'href="http://fonts.googleapis.com/css?family='.$font.'">';
	}

	function getPOST($key){
		if( isset($_POST[$key]) )
			echo $_POST[$key];
	}

	public function limenu($value){
		echo '<li ';
		if (isset($this->mnuTab))
			echo $this->mnuTab == $value ? 'class="active"' : '';
		echo '>';
	}

	function getPath($path = ''){
   	echo BASE_URL .$path;
  }

}