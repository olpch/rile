<?php
class ContractModel extends Model{

	public function __construct(){
			parent::__construct('contract');
	}
	
	public function all($numidex = false){
		$c  = 'SELECT std.e_id, std.e_identificacion, ';
		$c .= 'CONCAT_WS(" ", std.e_apellido1, std.e_apellido2, std.e_nombre2, std.e_nombre1) estudiante, std.e_pro,  ';
		$c .= 'contratos.co_id, contratos.co_n_contrato id_contrato, contratos.co_cargo, tipo_contrato.tpc_nom tipo_contrato, contratos.co_estado,';
		$c .= 'contratos.co_fecha_ini, empresas.e_razon_social razon_social, convenios.c_nombre convenio, programas.p_nombre programa ';
		$c .= 'FROM  contratos ';
		$c .= 'INNER JOIN estudiantes std ON (std.e_id = contratos.co_e_id)  ';
		$c .= 'inner join programas ON (std.e_p_id = programas.p_id) ';
		$c .= 'INNER JOIN convenios ON (convenios.c_id = std.e_c_id)  ';
		$c .= 'INNER JOIN empresas ON (empresas.e_id = contratos.co_emp_id) ';
		$c .= 'INNER JOIN tipo_contrato ON (tipo_contrato.tpc_id = contratos.co_tipo_contrato) ';
		$res = $this->_db->query($c);
		if ($numidex){
			return $res->fetchAll(PDO::FETCH_NUM);
		}else{
			return $res->fetchAll(PDO::FETCH_ASSOC);
		}
	}

	public function find($std){
		$c  = 'SELECT std.e_id, std.e_identificacion, ';
		$c .= 'CONCAT_WS(" ", std.e_apellido1, std.e_apellido2, std.e_nombre2, std.e_nombre1) estudiante, std.e_pro, ';
		$c .= 'contratos.co_id, contratos.co_n_contrato id_contrato, contratos.co_cargo, programas.p_nombre programa, ';
		$c .= 'contratos.co_fecha_ini, contratos.co_fecha_fin, contratos.co_jefe, contratos.co_correo, contratos.co_eps, contratos.co_arl, contratos.co_aux,';
		$c .= 'contratos.co_celular, contratos.co_sueldo, contratos.co_o_ing, contratos.co_ruta, contratos.co_tipo_contrato, ';
		$c .= 'tipo_contrato.tpc_nom tipo_contrato, empresas.e_razon_social razon_social, convenios.c_nombre convenio ';
		$c .= 'FROM estudiantes std ';
		$c .= 'INNER JOIN convenios ON (convenios.c_id = std.e_c_id) ';
		$c .= 'INNER JOIN contratos ON (std.e_id = contratos.co_e_id) ';
		$c .= 'inner join programas on (std.e_p_id = programas.p_id) ';
		$c .= 'INNER JOIN tipo_contrato ON (tipo_contrato.tpc_id = contratos.co_tipo_contrato) ';
		$c .= 'INNER JOIN empresas ON (empresas.e_id = contratos.co_emp_id) ';
		$c .= 'WHERE contratos.co_id = '.$std;
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
	
	public function types(){
		$c  = 'SELECT t.tpc_id id, t.tpc_nom nombre FROM tipo_contrato t';
		$res = $this->_db->query($c);
		return $res->fetchAll(PDO::FETCH_ASSOC);
	}

	public function newo($datos){

		$c1= "SELECT sel_s_id FROM seleccionados WHERE sel_e_id = '".$datos['e_id']."' limit 1";
		$res = $this->_db->query($c1);
		$solicitud = $res->fetch(PDO::FETCH_ASSOC);


		$c2 = "UPDATE estudiantes SET e_estado = '3' WHERE e_id='{$datos["e_id"]}'";
		$res = $this->_db->query($c2);
		$res->fetch(PDO::FETCH_ASSOC);

		$c3 = "UPDATE solicitudes SET s_estado = '1' WHERE s_id='{".$solicitud[0]."}'";
		$res = $this->_db->query($c3);
		$res->fetch(PDO::FETCH_ASSOC);

		$diferencia = strtotime(str_replace('/', '-', $datos['fecha_fin'])) - strtotime(str_replace('/', '-', $datos['fecha_ini']));
 		$meses = floor($diferencia/2592000);
		$c  = 'INSERT INTO contratos (co_id, co_tipo_contrato, co_n_contrato, co_e_id, co_emp_id, co_cargo, ';
		$c .= 'co_fecha_ini, co_fecha_fin, co_meses, co_jefe, co_correo, co_celular, co_sueldo, co_o_ing, ';
		$c .= 'co_eps, co_arl, co_aux, co_estado, co_mot_id, co_ruta, co_obser, cod_usu) ';
		$c .= 'VALUES (null, :tpc, :nct, :estudiante, :empresa, :cargo, :fch_ini, :fch_fnl, :meses, :jefe, ';
		$c .= ':email, :phone, :sueldo, :otros, :eps, :arl, :aux, 0, null , null, null, null)';
		$res = $this->_db->prepare($c)->execute(
			array(
				':nct' => $datos["numc"],
				':tpc' => $datos["tp_id"],
				':estudiante' => $datos["e_id"],
				':empresa' => $datos["emp_id"],
				':cargo' => $datos["cargo"],
				'fch_ini' => $datos['fecha_ini'],
				'fch_fnl' => $datos['fecha_fin'],
				':meses' => $meses,
				':jefe' => $datos["jefe"],
				':email' => $datos["correo"],
				':phone' => $datos["celular"],
				':sueldo' => $datos["sueldo"],
				':otros' => $datos["o_ing"],
				':eps' => $datos["eps"],
				':arl' => $datos["arl"],
				':aux' => $datos["aux"]
			)
		);
		if (isset($_FILES) and !empty($_FILES)){
			foreach ($_FILES as $key) {
				if($key['error'] == UPLOAD_ERR_OK ){
					$nombre = $key['name'];
					$temporal = $key['tmp_name'];
					$tamano= ($key['size'] / 1000)."Kb";
					$ruta = "contratos/" . $n_contrato . "_" . $nombre;
					if(file_exists($ruta)) { 
						unlink($ruta);
					}
					if(move_uploaded_file($temporal, $ruta)){
					}
				}else{

				}
			}
		}else{

		}
		return $res;
	}

	public function anular($id){
		$c = 'UPDATE contratos SET co_estado = ? WHERE co_id = ?';
		$res = $this->_db->prepare($c)->execute( array(3,$id) );
	}

	public function update($datos){

		$diferencia = strtotime(str_replace('/', '-', $datos['fecha_fin'])) - strtotime(str_replace('/', '-', $datos['fecha_ini']));
 		$meses = floor($diferencia/2592000);
		$c  = 'UPDATE contratos ';
		$c .= 'SET co_tipo_contrato=?, co_cargo=?, co_fecha_ini=?, co_fecha_fin=?, co_meses=?, ';
		$c .= 'co_jefe=?, co_correo=?, co_celular=?, co_sueldo=?, co_o_ing=?, co_eps=?, co_arl=?, co_aux=? ';
		$c .= 'WHERE co_id =?';
		$res = $this->_db->prepare($c)->execute(
			array(
				$datos["tp_id"],
				$datos["cargo"],
				$datos['fecha_ini'],
				$datos['fecha_fin'],
				$meses,
				$datos["jefe"],
				$datos["correo"],
				$datos["celular"],
				$datos["sueldo"],
				$datos["o_ing"],
				$datos["eps"],
				$datos["arl"],
				$datos["aux"],
				$datos["co_id"]
			)
		);
		if (isset($_FILES) and !empty($_FILES)){
			foreach ($_FILES as $key) {
				if($key['error'] == UPLOAD_ERR_OK ){
					$nombre = $key['name'];
					$temporal = $key['tmp_name'];
					$tamano= ($key['size'] / 1000)."Kb";
					$ruta = "contratos/" . $n_contrato . "_" . $nombre;
					if(file_exists($ruta)) { 
						unlink($ruta);
					}
					if(move_uploaded_file($temporal, $ruta)){
					}
				}else{

				}
			}
		}else{

		}
		return $res;
	}
}