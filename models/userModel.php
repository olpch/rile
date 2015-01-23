<?php
class UserModel extends Model{

	public function __construct(){
			parent::__construct('users');
	}
	
	public function all($numidex = false){
		$c = 'SELECT i.* FROM invoices i';
		$res = $this->_db->query($c);
		if ($numidex){
			return $res->fetchAll(PDO::FETCH_NUM);
		}else{
			return $res->fetchAll(PDO::FETCH_ASSOC);
		}
	}

	public function details($invoice){
		$c  = 'SELECT d.*, i.* FROM invoice_details d, invoices i ';
		$c .= 'WHERE d.invoice_id = i.id and i.id = '.$invoice;
		$res = $this->_db->query($c);
		return $res->fetchAll(PDO::FETCH_ASSOC);
	}

	public function find($invoice){
		$c  = 'SELECT i.* FROM invoices i WHERE i.id = '.$invoice;
		$res = $this->_db->query($c);
		return $res->fetch(PDO::FETCH_ASSOC);
	}

	public function userfree($uid, $email){
		$c  = "SELECT u.uid, u.email FROM users u WHERE u.uid LIKE :uid OR UPPER(u.email) LIKE UPPER(:email)";
		$query = $this->_db->prepare($c);
		$query->execute(array(':uid' => $uid, ':email' => $email));
		$res = $query->fetch();
		return $res;
	}

	public function create($uid, $first, $last, $password, $email){
		$c  = 'INSERT INTO users';
		$c .= '(id, uid, first_name, last_name, email, opsw, olvl, created) ';
		$c .= "values(null, :uid, :first_name, :last_name, :email, :password, 1, now())";
		$res = $this->_db->prepare($c)->execute(
			array(
				':uid' => $uid,
				':first_name' => $first,
				':last_name' => $last,
				':email' => $email,
				':password' => Hash::get('sha1', $password, HASH_KEY)			
			)
		);
		return $res;
	}

	public function signin($key, $opsw){
		$hash = Hash::get('sha1', $opsw, HASH_KEY);
		$c  = 'SELECT u.id, u.uid, u.level, u.first_name, u.last_name FROM users u ';
		$c .= "WHERE ( u.uid LIKE :key "; 
		$c .= "OR UPPER(u.email) LIKE UPPER(:key) ) ";
		$c .= "AND opsw like :opsw";
		$query = $this->_db->prepare($c);
		$query->execute(array(':key' => $key,':opsw' => $hash));
		$res = $query->fetch();
		return $res;
	}
}