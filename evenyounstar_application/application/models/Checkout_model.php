<?php
Class checkout_model extends CI_Model
{
	
	function login($email, $password)
	{
		$this -> db -> select('*');
		$this -> db -> from('checkout');
		$this -> db -> where('email = ' . "'" . $email . "'"); 
		$this -> db -> where('password = ' . "'" . $password . "'"); 
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		return $query->result();

	}
	
	function get_logo_update($id)
	{
		/*$this->db
			 ->where('id', $id);
			  $result	= $this->db->get('logo');
			  $result	= $result->result();
			  return $result;*/
		$query = $this
				->db
				->select('*')
				->where('logo_id', $id)
				->limit(1)
				->get('logo');
		$row = $query->row_array();		
		return $row;
	}
	
	
	function product_insert($productId,$size,$shipment,$check_id,$product_id,$qty,$unit_price,$total_price,$date)
	{
			$array=explode(',', $productId);
			$count = count($array);
			for($i=1; $i<=$count; $i++){
		$queryIn="insert into check_product_info values('','".$check_id."','".$product_id[$i]."','".$qty[$i]."','".$size[$i]."','".$shipment[$i]."','".$unit_price[$i]."','".$total_price[$i]."','".$date."')";
				mysql_query($queryIn);
			}
	}
	
	
	
	function save($save,$orderId,$productId,$boutiqueshopid,$shipment,$check_id,$product_id,$qty,$unit_price,$total_price,$date)
	{
			$array=explode(',', $productId);
			$count = count($array);
			for($i=1; $i<=$count; $i++){
		$this->db->query("insert into check_product_info values('','".$boutiqueshopid[$i]."','".$check_id."','".$product_id[$i]."','".$qty[$i]."','','".$shipment[$i]."','".$unit_price[$i]."','".$total_price[$i]."','".$date."')");
				
		$queryIn=$this->db->query("insert into orders_products values('','".$boutiqueshopid[$i]."','".$orderId."','".$product_id[$i]."','".$qty[$i]."','".$shipment[$i]."','".$unit_price[$i]."','".$total_price[$i]."','".$date."')");
		
			$queryInv = $this->db->query("select * from inventory where product_id='".$product_id[$i]."'");
			foreach($queryInv->result() as $invData);
			$invPro = $invData->product_id;
			$invQty = $invData->quantity;
			$updateQty = $invQty-$qty[$i];
			$this->db->query("update inventory set quantity = '".$updateQty."' where product_id='".$invPro."'");
		}
	}
}