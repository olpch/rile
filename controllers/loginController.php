<?php
class loginController extends Controller{

	public function __construct($name, $action){
		parent::__construct($name, $action);
		$this->current_user = $this->loadModel('user');
	}

	public function index(){
		if(Session::authenticated()){
			header('location: '.BASE_URL.'dashboard');	
		}
		if(isset($_POST['idcc'])){
			$checklogin = $this->current_user->signin($_POST['idcc'], $_POST['opsw']);
			if($checklogin){
				Session::register(true);
				Session::set('level', $checklogin['level']);
				Session::set('User', $checklogin['first_name'].' '. $checklogin['last_name']);
				Session::set('time', time());
				$this->redirectTo('dashboard');
			}else{
				$this->msgError  = "Datos no coinciden, por favor verifique.";
			}
		}
		$this->_view->renderContent();
	}

	public function access(){
		

	}

	public function signup(){
		if(Session::authenticated()){
			$this->redirectTo();
		}
		$res = false;
		if(isset($_POST['idcc'])){
				$uid = $_POST['idcc'];
				$first_name = $_POST['first_name'];
				$last_name = $_POST['last_name'];
				$password = Hash::get('sha1', $_POST['pass'], HASH_KEY);
				$email = $_POST['email'];
				
			if($this->current_user->userfree($uid, $email)){
				$this->msgError  = "El documento de identificacion ".$uid;
				$this->msgError .= ' o la direccion de correo '. $email;
				$this->msgError .= ' ya existen en nuestra base de datos';
				$this->msgError .= ' por favor verifique.';
				$this->toRender('signup');
			}
			else{
				if( $this->current_user->create($uid, $first_name, $last_name, $password, $email) ){
					$this->redirectTo();
				}
				else{
					$this->msgError  = 'Se ha pruducido un error al guardar los datos, por favor intente mas tarde...';
				}
			}	
		}else{
			$this->_view->renderContent();
		}
	}

	public function logout(){
		Session::destroy();
		$this->redirectTo();
	}

}