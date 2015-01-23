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
}