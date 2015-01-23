<?php
class InvoiceModel extends Model{

	public function __construct(){
		parent::__construct('invoices');
	}
	public function all($numidex = false){
		$c = 'SELECT i.id, i.created, i.createdby, i.customer, i.total, i.state FROM invoices i';
		$query = $this->_db->prepare($c);
		$query->execute();
		if ($numidex){
			return $query->fetchAll(PDO::FETCH_NUM);
		}else{
			return $query->fetchAll(PDO::FETCH_ASSOC);
		}
	}

	public function details($invoice){
		$c  = 'SELECT d.item, d.name, d.cant, d.sell FROM invoice_details d, invoices i ';
		$c .= 'WHERE d.invoice = i.id and i.id = '.$invoice;
		$query = $this->_db->prepare($c);
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public function find($invoice){
		$c  = 'SELECT i.* FROM invoices i WHERE i.id = '.$invoice;
		$res = $this->_db->query($c);
		return $res->fetch(PDO::FETCH_ASSOC);
	}

}