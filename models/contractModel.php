<?php
class ContractModel extends Model{

	public function __construct(){
			parent::__construct('contract');
	}
	
	public function all($numidex = false){
		$c  = 'SELECT std.e_id, std.e_identificacion, ';
		$c .= 'CONCAT_WS(" ", std.e_apellido1, std.e_apellido2, std.e_nombre2, std.e_nombre1) estudiante, std.e_pro, ';
		$c .= 'contratos.co_id, contratos.co_n_contrato id_contrato, contratos.co_cargo, programas.p_nombre programa, ';
		$c .= 'contratos.co_fecha_ini, contratos.co_fecha_fin, contratos.co_jefe, contratos.co_correo, ';
		$c .= 'contratos.co_celular, contratos.co_sueldo, contratos.co_ruta, tipo_contrato.tpc_nom tipo_contrato, ';
		$c .= 'empresas.e_razon_social razon_social, convenios.c_nombre convenio ';
		$c .= 'FROM estudiantes std ';
		$c .= 'INNER JOIN convenios ON (convenios.c_id = std.e_c_id) ';
		$c .= 'INNER JOIN contratos ON (std.e_id = contratos.co_e_id) ';
		$c .= 'inner join programas on (std.e_p_id = programas.p_id) ';
		$c .= 'INNER JOIN tipo_contrato ON (tipo_contrato.tpc_id = contratos.co_tipo_contrato) ';
		$c .= 'INNER JOIN empresas ON (empresas.e_id = contratos.co_emp_id) ';

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

	public function students(){
		$c  = 'SELECT std.e_id id, std.e_identificacion identificacion, programas.p_nombre programa, ';
		$c .= 'CONCAT_WS(" ", std.e_apellido1, std.e_apellido2, std.e_nombre2, std.e_nombre1) nombre ';
		$c .= 'FROM estudiantes std ';
		$c .= 'INNER JOIN convenios ON (std.e_c_id = convenios.c_id) ';
		$c .= 'INNER JOIN programas ON (std.e_p_id = programas.p_id) ';
		$c .= 'ORDER BY  programas.p_nombre asc, nombre asc ';
		$res = $this->_db->query($c);
		return $res->fetchAll(PDO::FETCH_ASSOC);
	}

	public function enterprises(){
		$c  = 'SELECT e_id id, e_nit nit, e_razon_social nombre FROM empresas ORDER BY e_razon_social';
		$res = $this->_db->query($c);
		return $res->fetchAll(PDO::FETCH_ASSOC);
	}
}