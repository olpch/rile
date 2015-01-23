<?php
	class Model{

		protected $_db;
		protected $_name_class;

		public function __construct($name) {
			$this->_name_class = $name;
			$this->_db = new Database();	
		}

		public function newId(){
			$c = "SELECT LAST_INSERT_ID(i.id)+1 FROM $this->_name_class i ORDER BY i.id DESC LIMIT 1";
			$query = $this->_db->prepare($c);
			$query->execute();
			return $query->fetch(PDO::FETCH_NUM)[0];
		}

	}