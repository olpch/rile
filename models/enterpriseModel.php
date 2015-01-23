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

}