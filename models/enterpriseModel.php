<?php
class EnterpriseModel extends Model{

	public function __construct(){
			parent::__construct('enterprises');
	}
	
	public function all($numidex = false){
		$c  = 'SELECT e_id, e_nit, e_razon_social, e_direccion, e_telefono, e_contacto, e_mail, e_obser, e_estado FROM empresas';
		$res = $this->_db->query($c);
		if ($numidex){
			return $res->fetchAll(PDO::FETCH_NUM);
		}else{
			return $res->fetchAll(PDO::FETCH_ASSOC);
		}
	}

	public function find($std){
		$c  = 'SELECT std.e_id, ';
		$c .= 'CONCAT_WS(" ", std.e_apellido1, std.e_apellido2, std.e_nombre2, std.e_nombre1) nombre, ';
		$c .= 'std.e_telefono telefono, std.e_celular celular, std.e_mail mail, std.e_identificacion ';
		$c .= 'FROM estudiantes std ';
		$c .= 'WHERE std.e_id = '.$std;
		$res = $this->_db->query($c);
		return $res->fetch(PDO::FETCH_ASSOC);
	}


		public function create($params){
		$c  = 'INSERT INTO users';
		$c .= '(id, e_nit, e_razon_social, e_direccion, e_telefono, e_contacto, e_email, e_clave, e_obser, e_estado) ';
		$c .= "values(null, :uid, :name, :direccion, :telefono, :contacto, :email, :opsw, '', 1";
		$res = $this->_db->prepare($c)->execute(
			array(
				':uid' => $params['emp_nit'],
				':name' => $params['emp_name'],
				':direccion' => $params['emp_address'],
				':telefono' => $params['emp_phone'],
				':contacto' => $params['emp_name'],
				':email' => $params['emp_mail'],
				':opsw' => $params['emp_nit'],
			)
		);
		return $res;
	}

}