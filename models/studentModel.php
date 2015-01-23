<?php
class StudentModel extends Model{

	public function __construct(){
			parent::__construct('students');
	}
	
	public function all($numidex = false){
		$c  = 'SELECT std.e_id, std.e_identificacion, ';
		$c .= 'CONCAT_WS(" ", std.e_apellido1, std.e_apellido2, std.e_nombre2, std.e_nombre1) nombre, ';
		$c .= 'std.e_genero, std.e_fecha_fin, std.asp_arc, std.asp_apt, convenios.c_nombre convenio, ';
		$c .= 'programas.p_nombre programa ';
		$c .= 'FROM estudiantes std ';
		$c .= 'INNER JOIN convenios ON (std.e_c_id = convenios.c_id) ';
		$c .= 'INNER JOIN programas ON (std.e_p_id = programas.p_id)';
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