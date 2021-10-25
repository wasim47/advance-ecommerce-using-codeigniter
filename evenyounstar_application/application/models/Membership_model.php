<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Membership_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
/*----- Insert Table and Get ID -------- */
	
	function inertTable($table, $data){
		if($this->db->insert($table, $data)):
			return $this->db->insert_id();
		else:
			return false;
		endif;
	}
/*----- Delete Table Row -------- */
	function deletetable_row($tablename, $tableidname, $tableidvalue){
		if($this->db->where($tableidname, $tableidvalue)->delete($tablename)) return true;
		return false;
	}	
	
	
	
	
/*----- Find table data with id and Oreder one and all -------- */






function getTable($table,$column,$order){
		$query =   $this->db
						->order_by($column, $order)
						->get($table);
		return $query;	
	}

function getOneItemTable($table,$tableColum,$userColum,$orderId,$order){
		$query =   $this->db
						->order_by($orderId, $order)
						->where($tableColum,$userColum)
						->get($table);
		return $query->row_array();	
	}
// Display All data with id
function getAllItemTable($table,$colum,$id,$statusColum,$status,$orderId,$order){
					if($id!=""){
						$this->db->where($colum,$id);
					}
					if($status!=""){
						$this->db->where($statusColum,$status);
					}
					$this->db->order_by($orderId,$order);
   		   $query = $this->db->get($table);
		//return $query->result();
		return $query;
}



 public function record_count($table) {
        return $this->db->count_all($table);
    }
public function GetRowDocCust($table,$colum,$keyword) {        
        $this->db->order_by('user_id', 'DESC');
        $this->db->like($colum, $keyword);
        return $this->db->get($table)->result_array();
    }

function updateTable($tablename, $tableprimary_idname,$tableprimary_idvalue, $updated_array){
		$modified_date = time();
		$this->db->where($tableprimary_idname,$tableprimary_idvalue);
		$dbquery = $this->db->update($tablename, $updated_array); 

		if($dbquery)
			return true;
		else
			return false;
	}
	function getAllSearchItem($table,$keyword,$from,$to,$orderid,$order,$start,$limit)
	  {
		  if($from=="" && $to!=""){
				 $this->db->where('from_date', $to); 
			}
			elseif($from!="" && $to!=""){
				 $this->db->where('from_date >=', $from);
				 $this->db->where('from_date <=', $to); 
			}
					 
		  if($keyword!=""){
			  	if($keyword=="today"){
					$this->db->where('from_date', date('Y-m-d'));
				}
				else{
				  $this->db->like('memberName',$keyword);
				  $this->db->or_like('member_type',$keyword);
				}
		   }
		  $this->db->order_by($orderid,$order);
		   $this->db->limit($start,$limit);
		  $query = $this->db->get($table);
		 
		  return $query;
	  }	
}