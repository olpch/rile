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
		$c  = 'SELECT u.u_id id, u.u_usuario usuario, u.u_tipo_id tipo, u.u_level level, u.u_nombres nombres, u.u_apellidos apellidos, u.u_mail email ';
		$c .= 'FROM usuarios u ';
		$c .= "WHERE ( u.u_usuario LIKE :key "; 
		$c .= "OR UPPER(u.u_mail) LIKE UPPER(:key) ) ";
		$c .= "AND u.u_password like :opsw";
		$query = $this->_db->prepare($c);
		$query->execute(array(':key' => $key,':opsw' => $hash));
		$res = $query->fetch();
		// echo '<br/>Pass => ['.$key.']['.$opsw.']['.$c.']';
		// echo '<br/><pre>';
		// print_r($res);
		// echo '<pre>';
		// 	die();
		return $res;
	}
}