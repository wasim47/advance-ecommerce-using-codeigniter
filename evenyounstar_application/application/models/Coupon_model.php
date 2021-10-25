<?php
Class coupon_model extends CI_Model
{
	
	function get_coupon($field_name) 
	{
		if($field_name!=""){
			    $query = $this
				->db
				->where('coupon_code', $field_name)
				->order_by('coupon_id', 'desc')
				//->limit($limit, $start)
				->get('coupon');
				$row = $query->result();		
				return $row;
				}
				else{
				  $this->db->order_by('coupon_id', 'desc');
				 // $this->db->limit($limit, $start);
					$query = $this->db->get("coupon");
					 
					if ($query->num_rows() > 0) {
					foreach ($query->result() as $row) {
					$data[] = $row;
					}
					return $data;
					}
					return false;
				}	  
			  
	}
	
	function get_category_approve($approve_val)
	{
	   $setval = array(
		   'status' => 1,
		);
		//$array_val[]=$approve_val;
		//$array=join($array_val,'');
		//$this->db->where_in('cid', $array);
		$this->db->where('coupon_id', $approve_val);
		$this->db->update('coupon', $setval);
		return false;
	}
	
	function get_category_deapprove($deapprove_val)
	{
		$setval = array(
               'status' => 0,
         );
		$this->db->where('coupon_id', $deapprove_val);
		$this->db->update('coupon', $setval);
		return false;
	}
	
	
	function get_coupon_update($id)
	{
		/*$this->db
			 ->where('id', $id);
			  $result	= $this->db->get('coupon');
			  $result	= $result->result();
			  return $result;*/
		$query = $this
				->db
				->select('*')
				->where('coupon_id', $id)
				->limit(1)
				->get('coupon');
		$row = $query->row_array();		
		return $row;
	}
	
	
	function save($save)
	{
			$this->db->insert('coupon', $save);
			return $this->db->insert_id();
			

	}
	
	function update($save)
	{
			$this->db->where('coupon_id', $save['coupon_id']);
			$this->db->update('coupon', $save);
			return false;
	}
	
	function delete_coupon($bid)
	{
		//delete the page
		//$this->db->where('coupon_id', $id);
		$array=join(',',$bid);
		$this->db->where('coupon_id IN ('.$array.')',NULL, FALSE);
		$this->db->delete('coupon');
	
	}
	

}