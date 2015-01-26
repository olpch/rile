<?php
class configModel extends Model{

	public function __construct(){
			parent::__construct('config');
	}
	
	public function all($numidex = false){
		$c  = 'SELECT i.id, i.name, i.state, i.tag';
		$c .= 'FROM  itemi';
		$res = $this->_db->query($c);
		return $res->fetchAll(PDO::FETCH_ASSOC);
	}

	public function conventions(){
		$c  = 'SELECT c.c_id, c.c_nombre FROM  convenios c ORDER BY c.c_nombre';
		$res = $this->_db->query($c);
		return $res->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function programs(){
		$c  = 'SELECT p.p_id, p.p_nombre FROM  programas p ORDER BY p.p_nombre';
		$res = $this->_db->query($c);
		return $res->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function modules(){
		$c  = 'SELECT m.mod_cod, m.mod_tip, m.mod_des, m.mod_pre FROM  modulos m ORDER BY m.mod_des';
		$res = $this->_db->query($c);
		return $res->fetchAll(PDO::FETCH_ASSOC);
	}
}