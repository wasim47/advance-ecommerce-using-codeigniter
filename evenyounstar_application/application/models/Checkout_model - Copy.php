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
	
	
	
	function save($save,$orderId,$productId,$shipment,$check_id,$product_id,$qty,$unit_price,$total_price,$date)
	{
			$array=explode(',', $productId);
			$count = count($array);
			for($i=1; $i<=$count; $i++){
		$this->db->query("insert into check_product_info values('','','".$check_id."','".$product_id[$i]."','".$qty[$i]."','','".$shipment[$i]."','".$unit_price[$i]."','".$total_price[$i]."','".$date."')");
				
		$queryIn=$this->db->query("insert into orders_products values('','','".$orderId."','".$product_id[$i]."','".$qty[$i]."','".$shipment[$i]."','".$unit_price[$i]."','".$total_price[$i]."','".$date."')");
		
		$queryInv = $this->db->query("select * from inventory where product_id='".$product_id[$i]."'");
		foreach($queryInv->result() as $invData);
			$invPro = $invData->product_id;
			$invQty = $invData->quantity;
			$updateQty = $invQty-$qty[$i];
			$this->db->query("update inventory set quantity = '".$updateQty."' where product_id='".$invPro."'");
		}
			
			
				if($queryIn)
				{
					$sessiondata = array(
						  'userAccessMail'=>$save['email'],
						  'userAccessType'=>'customer',
						  'userAccessName'=> $save['username'],
						  'userAccessId' => $save['user_id'],
						  'password' => TRUE
						 );
					$this->session->set_userdata($sessiondata);
					
					$tomail=$email;
						$frommail="wasim.html@gmail.com";
						$subject="Thanks for Checkout this Product";
						$this->email->set_newline('\r\n');
						$email_body ="
						<table width='95%' border='0' cellpadding='0' align='center' cellspacing='0' style=' 
							border:2px solid #f00; border-radius:13px; padding-left:20px;'>
							<tr style='background-color:#fff'>
							<th width='26%' height='79' align='center'> 
							<img src='".base_url('assets/images/front/butikbdlogo.png')."' />
							<th colspan='2' align='left'></th>
							</tr>
							<tr>
							<th height='37' colspan='3' align='left' 
								style='font-size:22px; color:#333; text-decoration:none;'>Login Information</th>
							</tr>
							<tr>
							<td height='137' colspan='3' align='right' valign='top'>
							<table width='100%' border='0' cellspacing='0' cellpadding='0'>
							<tr>
							<td width='37%' height='31'><strong>Email</strong></td>
							<td width='3%'><strong>:</strong></td>
							<td width='60%'>$email</td>
							</tr>
							<tr>
							<td height='29'><strong>Password</strong></td>
							<td><strong>:</strong></td>
							<td>$password</td>
							</tr>
							
							<tr>
							  <td colspan='3'> You can update your profile. For more help please contact butikbd.com.<br />
                   						Our Support Team Contact : support@butikbd.com or mobile : +8801922002381</td>
							  </tr>
							<tr>
							  <td colspan='3'>&nbsp;</td>
							  </tr>
							</table></td>
							</tr>
							</table>";
					
					//$this->email->initialize($config);
					$this->email->from($frommail, 'BD Dealer');
					$this->email->to($tomail);
					//$this->email->bcc();
					$this->email->subject($subject);
					$this->email->message($email_body);
					$this->email->send();
					
				}
				else{
					return false;
				}

			
	}
	
	
	function save_register($save)
	{
			$this->db->insert('checkout', $save);
			//return $this->db->insert_id();
					/*$tomail=$email;
						$frommail="wasim.html@gmail.com";
						$subject="Thanks for Checkout this Product";
						$this->email->set_newline('\r\n');
						$email_body ="
						<table width='100%' border='0' cellpadding='0' align='center' cellspacing='0' style=' 
						border:2px solid #f00; border-radius:13px; padding-left:20px;'>
						<tr style='background-color:#fff'>
						<th width='26%' height='79' align='center'> 
						<img src='http://winuxsoftbd.com/bddealer/assets/images/front/logo.png' /> </th>
						<th colspan='2' align='left'></th>
						</tr>
						<tr>
						<th height='37' colspan='3' align='left' 
							style='font-size:22px; color:#333; text-decoration:none;'>Your Personal Information</th>
						</tr>
						<tr>
						<td height='137' colspan='3' align='right' valign='top'>
						<table width='100%' border='0' cellspacing='0' cellpadding='0'>
						<tr>
						<td width='37%' height='26'><strong>Customer Name</strong></td>
						<td width='3%'><strong>:</strong></td>
						<td width='60%'>$name</td>
						</tr>
						<tr>
						<td height='24'><strong>Email</strong></td>
						<td><strong>:</strong></td>
						<td>$email</td>
						</tr>
						<tr>
						<td height='24'><strong>Contact Number</strong></td>
						<td><strong>:</strong></td>
						<td>$contact</td>
						</tr>
						<tr>
						<td height='25'><strong>Address</strong></td>
						<td><strong>:</strong></td>
						<td>$address</td>
						</tr>
						<tr>
						<td colspan='3'>&nbsp;</td>
						</tr>
						</table></td>
						</tr>
						</table>";
					
					//$this->email->initialize($config);
					$this->email->from($frommail, 'BD Dealer');
					$this->email->to($tomail);
					//$this->email->bcc();
					$this->email->subject($subject);
					$this->email->message($email_body);
					$this->email->send();*/
					redirect('index/index', 'refresh');
	}
	
	
	function update($save)
	{
			$this->db->where('check_id', $save['check_id']);
			$this->db->update('checkout', $save);
			return false;
	}
	
	function shipping_save($save,$order,$shipment,$productId,$product_id,$qty,$unit_price,$subtotal,$date)
	{
			/*$this->db->insert('shipping_address', $save);
			return $this->db->insert_id();*/
			$this->db->insert('orders', $order);
			$this->db->insert('shipping_address', $save);
			
			$query = $this
				->db
				->select('*')
				->order_by('order_id','desc')
				->limit(1)
				->get('orders');
			  $row = $query->result();
			  	
			  foreach($row as $order){
				  $order_id = $order->order_id;
			  }	
			  
			$array=explode(',', $productId);
			$count = count($array);
			for($i=1; $i<=$count; $i++){
		$queryIn="insert into orders_products values('','".$order_id."','".$product_id[$i]."','".$qty[$i]."','".$shipment[$i]."','".$unit_price[$i]."','".$subtotal[$i]."','".$date."')";
				mysql_query($queryIn);
			}

			return $this->db->insert_id();
	}
	
	function shipping_update($save)
	{
			$this->db->where('shipping_id', $save['shipping_id']);
			$this->db->update('shipping_address', $save);
			return false;
	}
	
	function payment_save($save,$order,$shipment,$productId,$product_id,$qty,$unit_price,$subtotal,$date)
	{
			
			$this->db->insert('orders', $order);
			$this->db->insert('payment_info', $save);
			
			$query = $this
				->db
				->select('*')
				->order_by('order_id','desc')
				->limit(1)
				->get('orders');
			  $row = $query->result();
			  	
			  foreach($row as $order){
				  $order_id = $order->order_id;
			  }	
			  
			$array=explode(',', $productId);
			$count = count($array);
			for($i=1; $i<=$count; $i++){
		$queryIn="insert into orders_products values('','".$order_id."','".$product_id[$i]."','".$qty[$i]."','".$shipment[$i]."','".$unit_price[$i]."','".$subtotal[$i]."','".$date."')";
				mysql_query($queryIn);
			}

			return $this->db->insert_id();
	}
	/*function delete_logo($id)
	{
		//delete the page
		$this->db->where('logo_id', $id);
		$this->db->delete('logo');
	
	}*/
	

}