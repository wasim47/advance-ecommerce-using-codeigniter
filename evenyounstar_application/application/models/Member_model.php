<?php
Class member_model extends CI_Model
{
	
	function get_member($field_name) 
	{
		//echo $field_name;
		$query=$this->db->query("SELECT * FROM member WHERE username LIKE '%$field_name' || '$field_name%' || '%$field_name%' ORDER BY user_id desc");
		return $query->result();	  
			  
	}
	
	
	function get_category_approve($approve_val)
	{
	   $setval = array(
		   'active' => 1,
		);
		$array=join(',',$approve_val);
		$this->db->where('user_id IN ('.$array.')',NULL, FALSE);
		$this->db->update('member', $setval);
		//return false;
	}
	
	function get_category_deapprove($deapprove_val)
	{
		$setval = array(
               'active' => 0,
         );
		$array=join(',',$deapprove_val);
		$this->db->where('user_id IN ('.$array.')',NULL, FALSE);
		$this->db->update('member', $setval);
		return false;
	}
	
	
	
	function get_member_update($id)
	{
		/*$this->db
			 ->where('id', $id);
			  $result	= $this->db->get('member');
			  $result	= $result->result();
			  return $result;*/
		$query = $this
				->db
				->select('*')
				->where('user_id', $id)
				->limit(1)
				->get('member');
		$row = $query->row_array();		
		return $row;
	}
	
	
	function save($save)
	{
			$this->db->insert('member', $save);
			return $this->db->insert_id();
			

	}
	
	function update($save)
	{
			$this->db->where('user_id', $save['user_id']);
			$this->db->update('member', $save);
			return false;
	}
	
	function delete_member($brid)
	{
		//delete the page
		//$this->db->where('user_id', $brid);
		$array=join(',',$brid);
		$this->db->where('user_id IN ('.$array.')',NULL, FALSE);
		$this->db->delete('member');
	
	}
	

}