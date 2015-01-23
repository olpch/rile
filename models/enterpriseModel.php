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
}