<?php
 	class Bootstrap{ 		
 		public static function run(Request $request){
 			$controller = $request->getContoller() . 'Controller';
 			$pathController = ROOT . 'controllers' . DS . $controller . '.php';
 			$action = $request->getAction();
        	$args = $request->getParams();
        	if(is_readable($pathController)){
            	require_once $pathController;            	
            	if(is_callable(array($controller, $action))){
                	$action = $request->getAction();
            	}else{
                    $action = 'index';
            	}
                $controller = new $controller($request->getContoller(), $action);
            	if(isset($args)){
                	call_user_func_array(array($controller, $action), array_slice($args, 1));
            	}else{
                	call_user_func(array($controller, $action));
            	}            
	       	}else {
                //header('location:' . BASE_URL . 'error/code404');
                exit;
            }
 		} // fin del metodo run
 	}