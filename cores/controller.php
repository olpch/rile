<?php
abstract class Controller {

  protected $_view;

  public function __construct($name = 'index', $view = 'index') {
    $this->_name = $name;
    $this->_view = new View($name, $view);
    //$this->lang = languaje::get('es_co');
    //$this->_view->lang = $this->lang;
    //$this->_view->parent = $this;
  }

  abstract public function index();

   protected function loadModel($modelo) {
    $modelo = $modelo . 'Model';
    $rutaModelo = ROOT . 'models' . DS . $modelo . '.php';
    if (is_readable($rutaModelo)) {
        require_once $rutaModelo;
        $modelo = new $modelo;
        return $modelo;
    } else {
        throw new Exception('No se encuentra el modelo '. $modelo);
    }
  }

  function toRender($vista = 'index', $type = false) {
    /*$pathfile = ROOT.'views'.DS.$this->_name.DS.$vista;*/
    $pathfile = ROOT.'views'.DS.'layout'.DS.$vista;
    if(!$type){
      $this->_currentView = ROOT.'views'.DS.$this->_name.DS.$vista;
      header('Content-type: text/html');
       if (is_readable($pathfile.'.phtml')) {
        include_once $pathfile.'.phtml';
      } 
      else {
        throw new Exception('Error de vista[' . $pathfile.'.phtml]');
      }
        // http_response_code($status_code);
        // header('Content-type: application/json');
        // echo json_encode($response);
    }
    die();
  }

  function toRenderPartial($vista = 'index', $controller = false) {
    if (!$controller){
      $controller = $this->_name;
    }
    include_once VIEWS_PATH . $controller . DS . $vista . '.phtml';
  }

  public function renderContent(){
    echo '<br/>Cuerpo del la vista ['.$this->_currentView.']';
  }

  function getJS($js){
    echo '<script type="text/javascript" src="'.BASE_URL.'assets/js/'.$js.'.js"></script>';
  }

  function getCSS($css){
    echo '<link rel="stylesheet" type="text/css" href="'.BASE_URL.'assets/css/'.$css.'.css">';
  }

  function getFavicon(){
    echo '<link rel="shortcut icon" type="image/x-icon" href="'.BASE_URL.'assets/img/favicon.ico" />';
  }

  function googleFont($font){
    echo '<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family='.$font.'">';
  }

  function getPOST($key){
    if( isset($_POST[$key]) )
      echo $_POST[$key];
  }

  function redirectTo($path = ''){
    header('location:' . BASE_URL .$path);
  }

  function showpre($val, $die = false){
    echo '<br/><pre>';
    print_r($val);
    echo '<pre>';
    if($die)
      die();
  }

 } //end Controller