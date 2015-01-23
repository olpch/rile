<?php 

	class Session{
		public static function init(){
			session_start();
		}
		
		public static function destroy($key = false){
			if($key){
				if(is_array($key)){
					for($i = 0; $i < count($key); $i++){
						if(isset($_SESSION[$key[$i]])){
							unset($_SESSION[$key[$i]]);
						}
					}
				}else{
					if(isset($_SESSION[$key])){
						unset($_SESSION[$key]);
					}
				}
			}else{
				session_destroy();
			}
		}
		
		public static function set($key, $value){
			if(!empty($key)){
				$_SESSION[$key] = $value;
			}
		}
		
		public static function get($key){
			if(isset($_SESSION[$key])){
				return $_SESSION[$key];
			}
		}

		public static function access($level = 0){
			if(!Session::authenticated()){
				header('location:' . BASE_URL .'login');
				exit;
			}
			Session::time();
			if( $level > Session::get('level') ){
				header('location:' . BASE_URL .'error/code5050');
				exit;
			}
		}
		
		public static function getLevel($level){
			$levels['Olee']   = 6;
			$levels['Root']   = 5;
			$levels['Support']= 4;
			$levels['Admin']  = 3;
			$levels['Special']= 2;
			$levels['User']   = 1;
			$levels['Basic']  = 0;
			if (!array_key_exists($level, $levels)){
				throw new Exception('['.$level.'] Error de Acceso.');
			}else{
				return $levels[$level];
			}
		}

		public static function accesoEstricto(array $level, $notAdmin = false){
			if(!Session::authenticated()){
				header('location: '.BASE_URL.'error/code5050');
				exit;
			}
			Session::tiempo();
			if($notAdmin == false){
				if(Session::get('level') == 'Admin'){
					return;
				}
			}
			if(count($level)){
				if(in_array(Session::get('level'), $level)){
					return;
				}
			}
			header('location: '.BASE_URL.'error/code5050');
		}

		public static function accesoViewEstricto(array $level, $notAdmin = false){
			if(!Session::authenticated()){
				return false;
			}
			if($notAdmin == false){
				if(Session::get('level') == 'Admin'){
					return true;
				}
			}
			if(count($level)){
				if(in_array(Session::get('level'), $level)){
					return true;
				}
			}
			return false;
		}

		public static function authenticated(){
			return Session::get('authenticated');
		}

		public static function register($value){
			Session::set('authenticated', $value);
		}

		public static function time(){
			if(!Session::get('time') || !defined('SESSION_TIME')){
				throw new Exception("Tiempo de session no definido [".!Session::get('time')."] [".SESSION_TIME."]");	
			}	

			if(SESSION_TIME == 0){
				return;
			}

			if( (time() - Session::get('time')) > (SESSION_TIME * 60) ){
				Session::destroy();
				header('location:'.BASE_URL.'error/code8080');
			}else{
				Session::set('time', time());
			}
		}

	} // fin de la clase Session

?>