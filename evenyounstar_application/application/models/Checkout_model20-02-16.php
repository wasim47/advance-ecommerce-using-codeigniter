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
						$tomail=$save['email'];
						$frommail="info@butikbd.com";
						 $subject="New Order Request Submitted from".$save['username'];
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
							  <td colspan='3'>Thank you for purchasing our Products.<br />
                   						Our Support Team Contact : support@butikbd.com or mobile : +8801922002381</td>
							  </tr>
							<tr>
							  <td colspan='3'>&nbsp;</td>
							  </tr>
							</table></td>
							</tr>
							</table>";
					
					//$this->email->initialize($config);
					$this->email->from($frommail, 'butikbd.com');
					$this->email->to($tomail);
					//$this->email->bcc();
					$this->email->subject($subject);
					$this->email->message($email_body);
					$this->email->send();
					
					  $tomail1="info@butikbd.com,wasim@butikbd.com,ashfaq@butikbd.com,tamanna@butikbd.com";
					  $frommail1=$save['email'];
					  $subject1="New Order Request Submitted from".$save['username'];
					  $this->email->set_newline('\r\n');
					  $email_body1 ="
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
							<td colspan='3'>Thank you for purchasing our Products.</td>
							</tr>
						  <tr>
							<td colspan='3'>&nbsp;</td>
							</tr>
						  </table></td>
						  </tr>
						  </table>";
				  
				  //$this->email->initialize($config);
				  $this->email->from($frommail1, 'butikbd.com');
				  $this->email->to($tomail1);
				  //$this->email->bcc();
				  $this->email->subject($subject1);
				  $this->email->message($email_body1);
				  $this->email->send();
					
				}
				else{
					return false;
				}

			
	}
}