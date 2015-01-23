<?php

class ItemModel extends Model{

	public function __construct(){
			parent::__construct();
	}
	
	public function all($numidex = false){
		$c  = 'SELECT i.id, i.name, i.state, i.tag';
		$c .= 'FROM  itemi';
		$res = $this->_db->query($c);
		if ($numidex){
			return $res->fetchAll(PDO::FETCH_NUM);
		}else{
			return $res->fetchAll(PDO::FETCH_ASSOC);
		}
	}

	public function details(){
		
	}
}