<?php
Class Index_model extends CI_Model
{
	
	
	function getAllMenu(){
			  
		  $this->db->where('boutiqueshop','Butikbd');
		  $this->db->where('root_id',0);
		  $this->db->order_by('m_id','asc');
		  $query = $this->db->get('menu');
		  return $query;
     }
	  function menu_exist($key,$boutique)
		{
			$this->db->where('menu_name',$key);
			$this->db->where('boutiqueshop',$boutique);
			$query = $this->db->get('menu');
			return $query;
		}
	  function category_exist($key,$boutique)
		{
			$this->db->where('cat_name',$key);
			$this->db->where('boutiqueshop',$boutique);
			$query = $this->db->get('category');
			return $query;
		}
		function subcategory_exist($key,$boutique,$catid)
		{
			$this->db->where('sub_cat_name',$key);
			$this->db->where('boutiqueshop',$boutique);
			$this->db->where('cat_id',$catid);
			$query = $this->db->get('sub_category');
			return $query;
		}
		function allemail($start,$limit)
		{
			$this->db->where('email !=', '');
			$this->db->order_by('id','asc');
			$this->db->limit($start,$limit);
			$query = $this->db->get('emailmarketing');
			return $query;
		}
		
	 
	 function getAllSearchItem($table,$keyword,$from,$to,$orderid,$order)
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
		  $query = $this->db->get($table);
		  return $query;
	  }	
	 function get_memberLogin($usr, $pwd)
     {
		 $reader =    $this->db->get_where('boutiqueshop', array('email'=> $usr, 'password'=>sha1($pwd)));
		 return $reader->row_array();
     }
		

// Menu 		
function getDataById($table,$colId,$id,$orderId,$order,$limit) 
	{
			if($colId!=""){
				$this->db->where($colId, $id);
			}
	   		$this->db->order_by($orderId, $order);
			if($limit!=""){
				$this->db->limit($limit);
			}
	   		$result=$this->db->get($table);
		    return $result;
	}
		

	function getAllDistrict($table,$colVal,$colVal,$group,$orderId,$order) 
	{
		if($colVal!=""){
			$this->db->where($colVal,$colVal);
		}
		$this->db->group_by($group);
		$this->db->order_by($orderId,$order);
		$result=$this->db->get($table);
		return $result;
	}
	
	function getArticleDataById($table,$colId,$id,$colId2,$id2,$orderId,$order,$limit) 
	{
				if($colId!=""){
				$this->db->where($colId, $id);
				}
			 if($colId2!=""){
				$this->db->where($colId2, $id2);
				}
	   		 $this->db->order_by($orderId, $order);
	   		 $result=$this->db->get($table);
		    return $result;
	}
	
	
	
	
	


function get_newSrrival() 
	{
		$result=$this->db
			->order_by('product_id', 'desc')
			->limit('20')
		    ->get('product');
		    return $result->result();
	}
	 function checkUserTemplate($table,$colum,$data)
	  {
		  $this->db->where($colum, $data);
		  $query = $this->db->get($table);
		  return $query;
	  }
	
	function get_subcategory() 
	{
	  $result=$this->db
	  		->where('status', '1')
			->order_by('sequence', 'asc')
		    ->get('sub_category');
		    return $result->result();
	}
	
	function save_subscriber($save)
	{
			$this->db->insert('subscriber', $save);
			return $this->db->insert_id();
	}
	function check_ajax($email)
	{
			$query = "select * from subscriber where email = '$email'";
			$results = mysql_query($query);
			$row= mysql_fetch_array($results);
			$row['email'];
			$row['id'];
			if($row['email']) // not available
			{
				echo '<div id="Error"  style="color:#ff0000; font-weight:bold; font-size:11px;">Invalid Email</div>';
				echo '<script>document.getElementById("search").value="";</script>';
			}
			else
			{
				echo '<div id="Success"  style="color:#006600; font-weight:bold; font-size:11px;">Valid Email</div>';
			}
	}
	function get_menu() 
	{
	  $result=$this->db
	  		->where('status', '1')
			->order_by('cid', 'asc')
		    ->get('category');
		    return $result->result();
	}
	
	function get_article($menu_id)
	{
		$result=$this->db
			->where('category ', $menu_id)
			->order_by('a_id ', 'desc')
		    ->get('article_manage');
		    return $result->row_array();
	}
	
	/*function save($save)
	{
			if($save['keywords']!=""){
				$this->db->insert('search_keywords', $save);
			}
			
			$result=$this->db
			->order_by('key_id', 'desc')
			->limit(1)
		    ->get('search_keywords');
		    return $result->result();
			
			//return $this->db->insert_id();
	}
	*/
	function search_kewwords()
	{
			$result=$this->db
			->order_by('key_id', 'desc')
			->limit(10)
		    ->get('search_keywords');
		    return $result->result();
	}
	
	



///////////// New Model////////////////
/////////////////////////////////////////Common for all/////////////////////////////////////////////////////////	

function bestSellingProduce() 
	{
		$this->db->select('p.*');
		$this->db->from('product p');
		$this->db->join('orders_products or','or.product_id=p.product_id','left');
		$this->db->order_by('product_id', 'desc');
		$this->db->limit('12');
		$result=$this->db->get();
		return $result;
	}



function product_galleryCount($url1,$url2,$url3,$pricefrom,$priceto,$prosize,$procolor,$boutiqueId) 
	{
		$this->db->select('*');
		$this->db->from('product');
		if($boutiqueId!="" || $boutiqueId!=0){
			$this->db->where('boutiqueshop', $boutiqueId);
		}
		if($url3!="" && !is_numeric($url3)){
			$this->db->where('cat_id', $url1);
			$this->db->where('scat_id', $url2);
			$this->db->where('lcat_id', $url3);
		}
		elseif($url2!="" && !is_numeric($url2)){
			$this->db->where('cat_id', $url1);
			$this->db->where('scat_id', $url2);
		}
		elseif($url1!="" && !is_numeric($url1)){
			$this->db->where('cat_id', $url1);
		}
		
		if($pricefrom!="" && $priceto!=""){
			$this->db->where("price BETWEEN $pricefrom AND $priceto");
		}
		if($prosize!=""){
			$this->db->like("size",$prosize);
		}
		if($procolor!=""){
			$this->db->like("color",$procolor);
		}
		$this->db->order_by('product_id', 'desc');
		$result=$this->db->get();
		return $result;
	}	
	
function product_gallery($url1,$url2,$url3,$sortval,$sorttype,$pricefrom,$priceto,$prosize,$procolor,$boutiqueId,$start,$limit) 
	{
		$this->db->select('*');
		$this->db->from('product');
		if($boutiqueId!="" || $boutiqueId!=0){
			$this->db->where('boutiqueshop', $boutiqueId);
		}
		if($url3!="" && !is_numeric($url3)){
			$this->db->where('cat_id', $url1);
			$this->db->where('scat_id', $url2);
			$this->db->where('lcat_id', $url3);
		}
		elseif($url2!="" && !is_numeric($url2)){
			$this->db->where('cat_id', $url1);
			$this->db->where('scat_id', $url2);
		}
		elseif($url1!="" && !is_numeric($url1)){
			$this->db->where('cat_id', $url1);
		}
		
		if($pricefrom!="" && $priceto!=""){
			$this->db->where("price BETWEEN $pricefrom AND $priceto");
		}
		if($prosize!=""){
			$this->db->like("size",$prosize);
		}
		if($procolor!=""){
			$this->db->like("color",$procolor);
		}
		if($sortval!=""){
			$this->db->order_by($sortval,$sorttype);
		}
		else{
			$this->db->order_by('product_id', 'desc');
		}
		$this->db->limit($start,$limit);
		$result=$this->db->get();
		return $result;
	}	

function searchdata($keyword,$category,$boutiqueshop) 
	{
		
		$this->db->select('*');
		$this->db->from('product');
		
		if($keyword!="" && $boutiqueshop=="" && $category==""){
			$this->db->like('product_name', $keyword);
			//$this->db->or_like('details', $keyword);
		}
		elseif($keyword!="" && $category!="" && $boutiqueshop==""){
			$this->db->where('cat_id', $category);
			$this->db->like('product_name', $keyword);
		}
		elseif($keyword!="" && $category!="" && $boutiqueshop!=""){
			$this->db->where('cat_id', $category);
			$this->db->where('boutiqueshop', $boutiqueshop);
			$this->db->like('product_name', $keyword);
		}
		
		elseif($category!="" && $keyword=="" && $boutiqueshop==""){
			$this->db->where('cat_id', $category);
		}
		elseif($category!="" && $keyword!="" && $boutiqueshop==""){
			$this->db->where('cat_id', $category);
			$this->db->like('product_name', $keyword);
		}
		
		elseif($boutiqueshop!="" && $keyword=="" && $category==""){
			$this->db->where('boutiqueshop', $boutiqueshop);
		}
		elseif($boutiqueshop!="" && $keyword!="" && $category==""){
			$this->db->where('boutiqueshop', $boutiqueshop);
			$this->db->like('product_name', $keyword);
		}
		else{
			$searc_hdataque=$this->db->query("select * from search_keywords order by key_id desc limit 10");	
			$proName=array();		
			foreach($searc_hdataque->result() as $val){
					$proName[]= $val->keywords;
					
			}
			$this->db->like('product_name', $proName[0]);
			$this->db->or_like('product_name', $proName[1]);
			$this->db->or_like('product_name', $proName[2]);
			$this->db->or_like('product_name', $proName[3]);
			$this->db->or_like('product_name', $proName[4]);
			$this->db->or_like('product_name', $proName[5]);
			$this->db->or_like('product_name', $proName[6]);
			$this->db->or_like('product_name', $proName[7]);
			$this->db->or_like('product_name', $proName[8]);
			$this->db->or_like('product_name', $proName[9]);
		}
		$this->db->order_by('product_id', 'desc');
		//$this->db->limit('12');
		$result=$this->db->get();
		return $result;
	}
	
		
function getSearch0Data($table,$colId,$id,$colId2,$id2,$colId3,$id3,$orderId,$order,$limit) 
	{
	  		 $this->db->where($colId, $id);
			 if($colId2!=""){
				$this->db->where($colId2, $id2);
				}
				 if($colId3!=""){
				$this->db->where($colId3, $id3);
				}
	   		 $this->db->order_by($orderId, $order);
	   		 $result=$this->db->get($table);
		    return $result;
	}
	
	
	
	
	
	
	
	
	
	function getDataByIdArray($table,$colId,$id,$orderId,$order,$limit) 
	{
			if($id!=""){
				$this->db->where_in($colId, $id);
			}
	   		$this->db->order_by($orderId, $order);
			if($limit!=""){
				$this->db->limit($limit);
			}
	   		$result=$this->db->get($table);
		    return $result;
	}
	
	
	function getNotIdData($table,$colId,$id,$colId1,$id1,$orderId,$order,$limit) 
	{
			if($colId!=""){
				$this->db->where($colId.' !=', $id);
			}
			if($colId1!=""){
				$this->db->where_not_in($colId1, $id1);
			}
			//$this->db->where('gift_wrap', NULL);
	   		$this->db->order_by($orderId, $order);
			if($limit!=""){
				$this->db->limit($limit);
			}
	   		$result=$this->db->get($table);
		    return $result;
	}
	
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
			  
			  if($colum!=""){
				  $this->db->where($colum,$id);
			  }
			  if($status!=""){
				  $this->db->where($statusColum,$status);
			  }
			  $this->db->order_by($orderId,$order);
			 $query = $this->db->get($table);
		return $query;
}

function get_vedio($start,$limit)
	{
		$result=$this->db
			->order_by('photo_album_id', 'desc')
			->limit($start,$limit)
		    ->get('vedio_gallery');
		    return $result->result();
	}
	


/////////////////////////////////////////Hospital Area/////////////////////////////////////////////////////////
	public function record_count($count_id) {
		$this->db->select('product_id');
		$this->db->from('product');
		if($count_id!='list'){
				if (preg_match('/_/', $count_id)) {
				list($country,$city)=explode('_',$count_id);
				$countId = $city;
				$this->db->where('scat_id',$countId);
				} 
				else {
					$countId = $count_id;
					$this->db->where('cat_id',$countId);
				}
			}
			
		$num_results = $this->db->count_all_results();
		return $num_results;
    }


public function record_countGallery($table) {
		$this->db->select('*');
		$this->db->from($table);
		$num_results = $this->db->count_all_results();
		return $num_results;
    }
	
function get_hospitalList($count_id,$start,$limit)
	{
			$this->db->where('status', '1');
			if($count_id!='list'){
				if (preg_match('/_/', $count_id)) {
				list($country,$city)=explode('_',$count_id);
				$countId = $city;
				$this->db->where('scat_id',$countId);
				} 
				else {
					$countId = $count_id;
					$this->db->where('cat_id',$countId);
				}
			}
			$this->db->order_by('product_id', 'desc');
			$this->db->limit($start,$limit);
			$result=$this->db ->get('product');
		    return $result->result();
	}


	function get_hospitalDetails($table,$columID,$matchId)
	{
		$result=$this->db
			->where($columID,$matchId)
		    ->get($table);
		    return $result->row_array();
	}
	
/////////////////////////////////////////All Insert, Update, Select, Delete and login Area/////////////////////////////////////////////////////////
	
	function get_AdminLogin($usr, $pwd)
     {
		     $reader =    $this->db->get_where('users', array('email'=> $usr, 'password'=>sha1($pwd), 'active'=> 1));
			 return $reader->row_array();
     }
	 
	 
	function get_userLogin($usr,$pwd,$usertype)
     {
		if ($usertype=='customer')
		{
		     $customer =  $this->db->get_where('customer', array('email'=> $usr, 'password'=>sha1($pwd), 'active'=> 1));
			 return $customer->row_array();
		}
		elseif ($usertype=='boutiqueshop')
		{
		     $boutiqueshop = $this->db->get_where('boutiqueshop', array('email'=> $usr, 'password'=>sha1($pwd), 'active'=> 1));
			 return $boutiqueshop->row_array();
		}
     }
	 
	 
	 function getLastInsertedId($table,$orderId)
     {
		$query = $this->db
						->order_by($orderId,'desc')
						->limit(1)
						->get($table);
		return $query->row_array();
     }






/////////////////////////////////////////All Insert, Update, Select, Delete and login Area/////////////////////////////////////////////////////////
	
/*----- Insert Table and Get ID -------- */
	
	function inertTable($table, $insertData){
		if($this->db->insert($table, $insertData)):
			return $this->db->insert_id();
		else:
			return false;
		endif;
	}

	 
	function update_table($table, $colid,$idval, $uvalue){
		$this->db->where($colid,$idval);
		$dbquery = $this->db->update($table, $uvalue); 
		if($dbquery)
			return true;
		else
			return false;
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
	 function checkOldPass($table,$old_password,$cid)
		{
			$this->db->where('email', $this->session->userdata('userAccessMail'));
			$this->db->where('user_id', $cid);
			$this->db->where('password', $old_password);
			$query = $this->db->get($table);
			return $query;
			/*if($query->num_rows() > 0)
				return 1;
			else
				return 0;*/
		}
		
public function productrecord_count() {
    	return $this->db->count_all("product");
    }
function get_product($field_name) 
	{
		$this->db->select('*');
		if($field_name!=""){
			$this->db->like('product_name', $field_name);
		}
		$this->db->order_by('product_id', 'desc');
		$query= $this->db->get('product');
		return $query->result();	  
			  
	}

 function update_status($table,$status,$id)
	{
		 $save=array('status'=>$status);
			$this->db->where('order_id', $id);
			$this->db->update($table, $save);
			return false;
	}
	
	
function update_inventory($update)
	{
		$this->db->where('product_id', $update['product_id']);
		$this->db->update('inventory', $update);
		return false;
	}
	
/*----- Delete Table Row -------- */
	function deletetable_row($tablename, $tableidname, $tableidvalue){
		if($this->db->where($tableidname, $tableidvalue)->delete($tablename)) return true;
		return false;
	}
	
	function get_approve($approve_val,$table,$id,$status)
	{
	   $setval = array(
		   $status => 1,
		);
		$array=join(',',$approve_val);
		$this->db->where($id.' IN ('.$array.')',NULL, FALSE);
		$this->db->update($table, $setval);
		return false;
	}
	
	function get_deapprove($approve_val,$table,$id,$status)
	{
		 $setval = array(
		   $status => 0,
		);
		$array=join(',',$approve_val);
		$this->db->where($id.' IN ('.$array.')',NULL, FALSE);
		$this->db->update($table, $setval);
		return false;
	}
	
	
	function get_category_approve($approve_val,$table)
	{
	   $setval = array(
		   'active' => 1,
		);
		$array=join(',',$approve_val);
		$this->db->where('user_id IN ('.$array.')',NULL, FALSE);
		$this->db->update($table, $setval);
		//return false;
	}
	
	function get_category_deapprove($deapprove_val,$table)
	{
		$setval = array(
               'active' => 0,
         );
		$array=join(',',$deapprove_val);
		$this->db->where('user_id IN ('.$array.')',NULL, FALSE);
		$this->db->update($table, $setval);
		return false;
	}
	
	function wishlistProductSave($save)
	{
			$this->db->insert('customer_wishlist', $save);
			return $this->db->insert_id();
	}

}

?>