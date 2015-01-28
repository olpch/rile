<?php

class CategoryModel extends Model{

	public function __construct(){
			parent::__construct('categories');
	}
	
	public function all($numidex = false){
		$c  = 'SELECT ic.id, ic.name, ic.state, ic.tag FROM item_category ic';
		$query = $this->_db->prepare($c);
		$query->execute();

		return $query->fetchAll();
	}

	public function lectiva(){
		$c  = 'SELECT e_id, e_identificacion, e_apellido1, e_apellido2, e_nombre1, e_nombre2, p_nombre, c_nombre, e_fecha_fin ';
		$c .= 'from estudiantes $c .= '
		$c .= 'inner join programas p on (p.p_id=e_p_id) ';
		$c .= 'inner join convenios c on (c.c_id=e_c_id)';
		$query = $this->_db->prepare($c);
		$query->execute();
		return $query->fetchAll();
	}
}
