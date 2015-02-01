<?php

class AlertModel extends Model{

	public function __construct(){
			parent::__construct('categories');
	}
	
	public function all($numidex = false){
		$c  = 'SELECT ic.id, ic.name, ic.state, ic.tag FROM item_category ic';
		$query = $this->_db->prepare($c);
		$query->execute();

		return $query->fetchAll();
	}

	public function sesenta(){
		$c  = 'SELECT contratos.co_fecha_ini, contratos.co_fecha_fin, estudiantes.e_identificacion, ';
		$c .= 'CONCAT_WS(" ", estudiantes.e_apellido1, estudiantes.e_apellido2, estudiantes.e_nombre2, estudiantes.e_nombre1) estudiante, ';
		$c .= 'programas.p_nombre, empresas.e_razon_social, tipo_contrato.tpc_nom ';
		$c .= 'FROM contratos ';
		$c .= 'INNER JOIN estudiantes ON (contratos.co_e_id = estudiantes.e_id and estudiantes.asp_ciu_s=1 and estudiantes.e_estado="3") ';
		$c .= 'INNER JOIN programas ON (programas.p_id = estudiantes.e_p_id) ';
		$c .= 'INNER JOIN tipo_contrato ON (contratos.co_tipo_contrato = tipo_contrato.tpc_id) ';
		$c .= 'INNER JOIN empresas ON (contratos.co_emp_id = empresas.e_id) ';
		$query = $this->_db->prepare($c);
		$query->execute();
		return $query->fetchAll();
	}

	public function lectiva(){
		$c  = 'SELECT e_id, e_identificacion, p_nombre, c_nombre, e_fecha_fin, ';
		$c .= 'CONCAT_WS(" ", e_apellido1, e_apellido2, e_nombre2, e_nombre1) estudiante ';
		$c .= 'FROM estudiantes ';
		$c .= 'inner join programas p on (p.p_id=e_p_id) ';
		$c .= 'inner join convenios c on (c.c_id=e_c_id)';
		$c .= 'WHERE e_fecha_fin > "2014-12-31"';
		$query = $this->_db->prepare($c);
		$query->execute();
		return $query->fetchAll();
	}

	public function productiva(){
		$c  = 'select contratos.co_e_id, contratos.co_tipo_contrato, contratos.co_fecha_ini, contratos.co_fecha_fin, ';
		$c .= 'estudiantes.e_identificacion, empresas.e_razon_social, tipo_contrato.tpc_nom, ';
		$c .= 'CONCAT_WS(" ", estudiantes.e_apellido1, estudiantes.e_apellido2, estudiantes.e_nombre2, estudiantes.e_nombre1) estudiante ';
		$c .= 'FROM contratos ';
		$c .= 'INNER JOIN estudiantes ON (contratos.co_e_id=estudiantes.e_id and estudiantes.asp_ciu_s=1 and estudiantes.e_estado=3) ';
		$c .= 'INNER JOIN tipo_contrato ON (contratos.co_tipo_contrato=tipo_contrato.tpc_id) ';
		$c .= 'INNER JOIN empresas ON (contratos.co_emp_id=empresas.e_id) ORDER BY contratos.co_fecha_fin';
		$query = $this->_db->prepare($c);
		$query->execute();
		return $query->fetchAll();
	}

	public function entrevistados(){
		$c  = 'SELECT estudiantes.e_identificacion, programas.p_nombre, empresas.e_razon_social, seleccionados.sel_obser, motivos.mot_nom, ';
		$c .= 'CONCAT_WS(" ", estudiantes.e_apellido1, estudiantes.e_apellido2, estudiantes.e_nombre2, estudiantes.e_nombre1) estudiante ';
		$c .= 'FROM seleccionados ';
		$c .= 'INNER JOIN estudiantes ON (estudiantes.e_id=seleccionados.sel_e_id) ';
		$c .= 'INNER JOIN programas ON (estudiantes.e_p_id=programas.p_id ) ';
		$c .= 'INNER JOIN solicitudes ON (solicitudes.s_id=seleccionados.sel_s_id) ';
		$c .= 'INNER JOIN empresas ON (empresas.e_id=solicitudes.s_e_id ) ';
		$c .= 'INNER JOIN motivos ON (motivos.mot_id=seleccionados.sel_mot_id) ';
		$c .= 'ORDER BY seleccionados.sel_id desc ';
		$query = $this->_db->prepare($c);
		$query->execute();
		return $query->fetchAll();
	}

	public function vencida(){
		$hoy = date("Y-m-d");
		$fch = strtotime('-1 month', strtotime($hoy));
		$fecha = date ( 'Y-m-j', $fch);
		$c  = 'SELECT e.e_id,e.e_identificacion, em.e_razon_social,tc.tpc_nom,c.co_fecha_ini,c.co_fecha_fin, ';
		$c .= 'CONCAT_WS(" ", e.e_apellido1, e.e_apellido2, e.e_nombre2, e.e_nombre1) estudiante ';
		$c .= 'FROM estudiantes e, contratos c, empresas em, tipo_contrato tc  ';
		$c .= 'WHERE e.e_id = c.co_e_id AND em.e_id = c.co_emp_id  ';
		$c .= 'AND c.co_tipo_contrato = tc.tpc_id  ';
		$c .= "AND c.co_fecha_fin >= '$fecha' ";
	    $c .= "AND c.co_fecha_fin <= '$hoy' ";
		$query = $this->_db->prepare($c);
		$query->execute();
		return $query->fetchAll();
	}
}
