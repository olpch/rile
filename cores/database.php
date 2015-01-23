<?php
	class Database extends PDO{
		 
		 public function __construct(){
		 	$dns = 'mysql:dbname=' . DB_NAME.';host='.DB_HOST;
		 	try{
				parent::__construct($dns,DB_USER, DB_PASS,
					array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . DB_CHAR)
				);
			}catch(Exception $e){
				//header('location:' . BASE_URL . 'error/database/'.$e->getCode());
				echo 'Error en la base de datos';
				echo '<br/>' . $e;
				exit;
			}
		}

		public function isValidApiKey($apikey){
			$query = $this->query('SELECT id FROM users WHERE api_key = "'. $apikey.'"');
			if($query->rowCount() < 1){
				return false;
			}
			return true;
		}
	} 