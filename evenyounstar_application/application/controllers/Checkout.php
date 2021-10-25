<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkout extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Checkout_model');
		$this->load->model('Index_model');
	}
    function index()
	{
		if($this->session->userdata('userAccessMail')) redirect('checkout/ordersubmitted');
		$data['title'] = "Checkout : butikbd.com";
		$data['menu']	= $this->Index_model->getDataById('menu','root_id',0,'m_id','asc','');
		$data['footermenu']	= $this->Index_model->getAllMenu();
		$data['allbutikshop']	= $this->Index_model->getDataById('boutiqueshop','active','1','user_id','desc','20');
			$data['totaldistrict']= $this->Index_model->getAllDistrict('bangladesh','','','district','district','asc');
			$data['search_kewwords']	= $this->Index_model->search_kewwords();
			if ($cart = $this->cart->contents()){
				if($this->input->post('registerpayNow')){
					$save['username']	    = $this->input->post('memberName');
					//$save['zipcode']	    = $this->input->post('zipcode');
					$save['mobile']	    = $this->input->post('mobile');
					$save['address']	    = $this->input->post('address');
					$save['gender']	    = $this->input->post('gender');
					$save['country']	    = "Bangladesh";
					$save['city']	    = $this->input->post('city');
					$save['thana']	    = $this->input->post('thana');
					$save['email']	    = $this->input->post('email');
					$save['password']	    = sha1($this->input->post('password'));
					$save['passwordHints']	    = $this->input->post('password');
					$save['created_date']	    = date('Y-m-d');
					$save['active']	    = 1;
					$query = $this->Index_model->inertTable('customer', $save);
					
					if($this->input->post('shippingcheck')!=1){
						$shipinfo['customer_id']	    = $query;
						$shipinfo['name']	    = $this->input->post('memberName');
						$shipinfo['contact']	    = $this->input->post('mobile');
						$shipinfo['address']	    = $this->input->post('address');
						$shipinfo['locality']	    = $this->input->post('thana');
						$shipinfo['country']	    = "Bangladesh";
						$shipinfo['city']	    = $this->input->post('city');
						$shipinfo['date']	    = date('Y-m-d');
						$shipId = $this->Index_model->inertTable('shipping_address', $shipinfo);	
					}
					else{
						$shipinfo['customer_id']	    = $query;
						$shipinfo['name']	    = $this->input->post('shipName');
						$shipinfo['contact']	    = $this->input->post('shipmobile');
						$shipinfo['address']	    = $this->input->post('shipaddress');
						$shipinfo['locality']	    = $this->input->post('shiplocality');
						$shipinfo['country']	    = "Bangladesh";
						$shipinfo['city']	    = $this->input->post('shipcity');
						$shipinfo['date']	    = date('Y-m-d');
						$shipId = $this->Index_model->inertTable('shipping_address', $shipinfo);	
					}	
					
					$payinfo['customer_id']	    = $query;
					$payinfo['pay_method']	    = $this->input->post('paymentMethod');
					$payinfo['date']	    = date('Y-m-d');
					$payId = $this->Index_model->inertTable('payment_info', $payinfo);
				
					$order['customer_id']		= $query;
					$order['order_number']		= $this->input->post('order_number');
					$order['total_price']		= $this->input->post('total_price');
					$order['boutiqueshop']		= $this->input->post('boutiqueshop');
					$order['status']	= "Pending"; 
					$order['order_time']	= date('Y-m-d H:i:s');
					$order['date']	= date('Y-m-d');
					$orderId = $this->Index_model->inertTable('orders', $order);
					
					$totalprice=$this->input->post('total_price');
					$productId = $this->input->post('productId');
					$array=explode(',', $productId);
					$count = count($array);
					$check_id = $query;
					$emailmsg='';
					$emailmsg .="
						<table width='95%' border='0' cellpadding='0' align='center' cellspacing='0' style=' 
							border:2px solid #FFC20F; border-radius:13px; padding-left:20px;'>
							<tr style='background-color:#fff'>
							<th width='26%' height='79' align='center'> 
							<img src='".base_url('assets/images/front/butikbdlogo.png')."' />
							<th colspan='2' align='left'></th>
							</tr>
							<tr>
							<th height='37' colspan='3' align='left'>
                            <div style='font-size:22px; color:#333; text-decoration:none;'>
                            	Thank you $customername for purchasing our Products
                            </div>
                            <div style='font-size:18px; color:#333; text-decoration:none; padding:10px; text-align:center'>
                            	Your Order Details
                            </div>
                            </th>
							</tr>
					";
					for($i=0; $i<=$count; $i++){
						$product_id[] = $this->input->post('product_id'.$i);
						$shipment[] = $this->input->post('shipment'.$i);
						$qty[] = $this->input->post('qty'.$i);
						$unit_price[] = $this->input->post('unit_price'.$i);
						$total_price[] = $this->input->post('sub_total'.$i);
						$date = date('Y-m-d');
					}
					
					for($j=1; $j<=$count; $j++){
						$pro_name = $this->input->post('pro_name'.$j);
						$proQty = $this->input->post('qty'.$j);
						$proprice = $this->input->post('unit_price'.$j);
						$subtotalprice = $this->input->post('sub_total'.$j);
						$main_image=$this->input->post('mainimg'.$j);
						$pro_code=$this->input->post('pro_code'.$j);
						$boutiqueshopid[] = $this->input->post('boutiqueshop'.$i);

						$customername=$save['username'];
						$password=$save['passwordHints'];
						$tomail=$save['email'];
						$emailmsg .="
							<tr>
							<td height='137' colspan='3' align='right' valign='top'  style='border:1px solid #FFC20F; padding:10px'>
							<table width='100%' border='0' cellspacing='0' cellpadding='0'>
							<tr>
							<td width='37%' height='31'><strong>Product Name</strong></td>
							<td width='3%'><strong>:</strong></td>
							<td width='60%'>$pro_name</td>
							</tr>
							<tr>
							<td height='29'><strong>Product Photo</strong></td>
							<td><strong>:</strong></td>
							<td><img src='".base_url('uploads/images/product/main_img/'.$main_image)."'  width='100' height='150'/></td>
							</tr>
                            <tr>
							<td height='29'><strong>Product Code</strong></td>
							<td><strong>:</strong></td>
							<td>$pro_code</td>
							</tr>
                            <tr>
							<td height='29'><strong>Product Price</strong></td>
							<td><strong>:</strong></td>
							<td>$proprice</td>
							</tr>
                            <tr>
							<td height='29'><strong>Product Quantity</strong></td>
							<td><strong>:</strong></td>
							<td>$proQty</td>
							</tr>
							<tr>
							<td height='29'><strong>Total Price</strong></td>
							<td><strong>:</strong></td>
							<td>$subtotalprice</td>
							</tr>
							<tr>
							  <td colspan='3'>&nbsp;</td>
							  </tr>
							</table></td>
							</tr>
						";
					}
					$emailmsg .="
						<tr>
							<td height='29'><strong>Grand Total Price</strong></td>
							<td><strong>:</strong></td>
							<td>$totalprice</td>
						</tr>
						<tr>
							<th height='37' colspan='3' align='left'>
                            <div style='font-size:18px; color:#333; text-decoration:none; padding:10px; text-align:center'>
                            	Login Information
                            </div>
                            </th>
							</tr>
							<tr>
							<td height='137' colspan='3' align='right' valign='top'>
							<table width='100%' border='0' cellspacing='0' cellpadding='0'>
							<tr>
							<td width='37%' height='31'><strong>Email</strong></td>
							<td width='3%'><strong>:</strong></td>
							<td width='60%'>$tomail</td>
							</tr>
							<tr>
							<td height='29'><strong>Password</strong></td>
							<td><strong>:</strong></td>
							<td>$password</td>
							</tr>
							
							<tr>
							  <td height='38' colspan='3'>
                   						<h3 style='text-align:center'>Our Support Team Contact : support@butikbd.com or mobile : +8801676669239</h3></td>
							  </tr>
							<tr>
							  <td colspan='3'>&nbsp;</td>
							  </tr>
							</table></td>
							</tr>
							</table>
					";
				    $this->Checkout_model->save($save,$orderId,$productId,$boutiqueshopid,$shipment,$check_id,$product_id,$qty,$unit_price,$total_price,$date);
				    $sessiondata = array(
						  'userAccessMail'=>$save['email'],
						  'userAccessType'=>'customer',
						  'userAccessName'=> $save['username'],
						  'userAccessId' => $save['user_id'],
						  'password' => TRUE
						 );
						$this->session->set_userdata($sessiondata);
						$frommail="info@butikbd.com";
						 $subject="New Order Request Submitted from ".$customername;
						 $config = array (
								  'mailtype' => 'html',
								  'charset'  => 'utf-8',
								  'priority' => '1'
								   );
						$this->email->initialize($config);
						$this->email->set_newline('\r\n');
						$email_body = $emailmsg;
					
					//$this->email->initialize($config);
					$this->email->from($frommail, 'butikbd.com');
					$this->email->to($tomail);
					//$this->email->bcc();
					$this->email->subject($subject);
					$this->email->message($email_body);
					$this->email->send();
					
					  $tomail1="wasim.html@gmail.com";
					  $frommail1=$save['email'];
					  $subject1="New Order Request Submitted from".$save['username'];
					  $config = array (
								  'mailtype' => 'html',
								  'charset'  => 'utf-8',
								  'priority' => '1'
								   );
							  $this->email->initialize($config);
					  $this->email->set_newline('\r\n');
					  $email_body1 = $emailmsg;
				  
				  //$this->email->initialize($config);
				  $this->email->from($frommail1, 'butikbd.com');
				  $this->email->to($tomail1);
				  //$this->email->bcc();
				  $this->email->subject($subject1);
				  $this->email->message($email_body1);
				  $this->email->send();
				   //redirect('checkout/payment_confirm', 'refresh');
					$data['main_content']="frontend/payment_confirm";
     				$this->load->view('template', $data);
				}
				else{
					$data['countryAll']= $this->Index_model->getDataById('countryall','parent_id','22','name','asc','');
					$data['main_content']="frontend/checkout";
					$this->load->view('template', $data);
					}
		 		}
			else{
				redirect('index');
				}
	}
	
	 function login()
	{
		$data['title'] = "Checkout Login : Butikbd.com";
		$data['menu']	= $this->Index_model->getDataById('menu','root_id',0,'m_id','asc','');
		$data['footermenu']	= $this->Index_model->getAllMenu();
		$data['allbutikshop']	= $this->Index_model->getDataById('boutiqueshop','active','1','user_id','desc','20');
		$data['search_kewwords']	= $this->Index_model->search_kewwords();
				if($this->input->post('userlogin')){
					  $usertype = 'customer';
					  $username = $this->input->post("email");
					  $password = $this->input->post("password");
					  $usr_result = $this->Index_model->get_userLogin($username, $password,$usertype);
					  if ($usr_result > 0) //active user record is present
					  {
						$sessiondata = array(
						  'userAccessMail'=>$username,
						  'userAccessType'=>$usertype,
						  'userAccessName'=> $usr_result['username'],
						  'userAccessId' => $usr_result['user_id'],
						  'password' => TRUE
						 );
				  	  $this->session->set_userdata($sessiondata);
					  redirect("checkout/ordersubmitted");
			 		 }
					 else
					  {
						$this->session->set_flashdata('invalidmsg', '<div class="alert alert-danger text-center" style="padding:7px; margin-bottom:5px; color:red">Invalid Email and password!</div>');
						  redirect('checkout');
					  }
				}	
	 	}
	
	 function ordersubmitted()
	 {
		if(!$this->session->userdata('userAccessMail')) redirect('checkout');
		$data['title'] = "Order Checkout : butikbd.com";
		$data['menu']	= $this->Index_model->getDataById('menu','root_id',0,'m_id','asc','');
		$data['search_kewwords']	= $this->Index_model->search_kewwords();
		$data['allbutikshop']	= $this->Index_model->getDataById('boutiqueshop','active','1','user_id','desc','20');
		$custId=$this->session->userdata('userAccessId');
		$data['userinformation']	= $this->Index_model->getOneItemTable('customer','user_id',$custId,'user_id','desc',1);
		$data['shipQuery'] = $this->Index_model->getAllItemTable('shipping_address','customer_id',$custId,'','','shipping_id','desc');
		$data['footermenu']	= $this->Index_model->getAllMenu();
		$data['totaldistrict']= $this->Index_model->getAllDistrict('bangladesh','','','district','district','asc');
			if($this->input->post('registerpayNow')){

					$shipinfo['customer_id']	= $custId;
					$shipinfo['name']	        = $this->input->post('shipName');
					$shipinfo['contact']	    = $this->input->post('shipmobile');
					$shipinfo['address']	    = $this->input->post('shipaddress');
					$shipinfo['locality']	    = $this->input->post('shiplocality');
					$shipinfo['country']	    = "Bangladesh";
					$shipinfo['city']	    = $this->input->post('shipcity');
					$shipinfo['date']	    = date('Y-m-d');
					if($data['shipQuery']->num_rows() > 0){
						foreach($data['shipQuery']->result() as $shipVal);
						$shippingId=$shipVal->shipping_id;
						$query = $this->Index_model->updateTable('shipping_address','shipping_id',$shippingId, $shipinfo);
					}
					else{
						$shipId = $this->Index_model->inertTable('shipping_address', $shipinfo);
					}
					
					
					$payinfo['customer_id']	    = $this->session->userdata('userAccessId');
					$payinfo['pay_method']	    = $this->input->post('paymentMethod');
					$payinfo['date']	    = date('Y-m-d');
					$payId = $this->Index_model->inertTable('payment_info', $payinfo);
				
					$order['customer_id']		= $this->session->userdata('userAccessId');
					$order['boutiqueshop']		= $this->input->post('boutiqueshop');
					$order['order_number']		= $this->input->post('order_number');
					$order['total_price']		= $this->input->post('total_price');
					$order['status']	= "Pending"; 
					$order['order_time']	= date('Y-m-d H:i:s');
					$order['date']	= date('Y-m-d');
					$orderId = $this->Index_model->inertTable('orders', $order);
					
					$productId = $this->input->post('productId');
					$array=explode(',', $productId);
					$count = count($array);
					$check_id = $this->session->userdata('userAccessId');
						
						
					$totalprice=$this->input->post('total_price');
					$emailmsg='';
					$emailmsg .="
						<table width='95%' border='0' cellpadding='0' align='center' cellspacing='0' style=' 
							border:2px solid #FFC20F; border-radius:13px; padding-left:20px;'>
							<tr style='background-color:#fff'>
							<th width='26%' height='79' align='center'> 
							<img src='".base_url('assets/images/front/butikbdlogo.png')."' />
							<th colspan='2' align='left'></th>
							</tr>
							<tr>
							<th height='37' colspan='3' align='left'>
                            <div style='font-size:22px; color:#333; text-decoration:none;'>
                            	Thank you $customername for purchasing our Products
                            </div>
                            <div style='font-size:18px; color:#333; text-decoration:none; padding:10px; text-align:center'>
                            	Your Order Details
                            </div>
                            </th>
							</tr>
					";
					for($i=0; $i<=$count; $i++){
						$product_id[] = $this->input->post('product_id'.$i);
						$shipment[] = $this->input->post('shipment'.$i);
						$qty[] = $this->input->post('qty'.$i);
						$unit_price[] = $this->input->post('unit_price'.$i);
						$total_price[] = $this->input->post('sub_total'.$i);
						$boutiqueshopid[] = $this->input->post('boutiqueshop'.$i);
						$date = date('Y-m-d');
					}
					
					for($j=1; $j<=$count; $j++){
						$pro_name = $this->input->post('pro_name'.$j);
						$proQty = $this->input->post('qty'.$j);
						$proprice = $this->input->post('unit_price'.$j);
						$subtotalprice = $this->input->post('sub_total'.$j);
						$main_image=$this->input->post('mainimg'.$j);
						$pro_code=$this->input->post('pro_code'.$j);
						$customername=$this->session->userdata('userAccessName');
						$tomail=$this->session->userdata('userAccessMail');
						$emailmsg .="
							<tr>
							<td height='137' colspan='3' align='right' valign='top'>
							<table width='100%' border='0' cellspacing='0' cellpadding='0'>
							<tr>
							<td width='37%' height='31'><strong>Product Name</strong></td>
							<td width='3%'><strong>:</strong></td>
							<td width='60%'>$pro_name</td>
							</tr>
							<tr>
							<td height='29'><strong>Product Photo</strong></td>
							<td><strong>:</strong></td>
							<td><img src='".base_url('uploads/images/product/main_img/'.$main_image)."'  width='100' height='150'/></td>
							</tr>
                            <tr>
							<td height='29'><strong>Product Code</strong></td>
							<td><strong>:</strong></td>
							<td>$pro_code</td>
							</tr>
                            <tr>
							<td height='29'><strong>Product Price</strong></td>
							<td><strong>:</strong></td>
							<td>$proprice</td>
							</tr>
                            <tr>
							<td height='29'><strong>Product Quantity</strong></td>
							<td><strong>:</strong></td>
							<td>$proQty</td>
							</tr>
							<tr>
							<td height='29'><strong>Total Price</strong></td>
							<td><strong>:</strong></td>
							<td>$subtotalprice</td>
							</tr>
							<tr>
							  <td colspan='3'>&nbsp;</td>
							  </tr>
							</table></td>
							</tr>
						";
					}
					$emailmsg .="
						<tr>
							<td height='29'><strong>Grand Total Price</strong></td>
							<td><strong>:</strong></td>
							<td>$totalprice</td>
						</tr>
							
							<tr>
							  <td height='38' colspan='3'>
                   						<h3 style='text-align:center'>Our Support Team Contact : support@butikbd.com or mobile : +8801676669239</h3></td>
							  </tr>
							<tr>
							  <td colspan='3'>&nbsp;</td>
							  </tr>
							</table></td>
							</tr>
							</table>
					";
				    $this->Checkout_model->save($save,$orderId,$productId,$boutiqueshopid,$shipment,$check_id,$product_id,$qty,$unit_price,$total_price,$date);
						 $frommail="info@butikbd.com";
						 $subject="New Order Request Submitted from ".$customername;
						 $config = array (
								  'mailtype' => 'html',
								  'charset'  => 'utf-8',
								  'priority' => '1'
								   );
						$this->email->initialize($config);
						$this->email->set_newline('\r\n');
						$email_body = $emailmsg;
					
					//$this->email->initialize($config);
					$this->email->from($frommail, 'butikbd.com');
					$this->email->to($tomail);
					//$this->email->bcc();
					$this->email->subject($subject);
					$this->email->message($email_body);
					$this->email->send();
					
					  $tomail1="wasim.html@gmail.com";
					  $frommail1=$this->session->userdata('userAccessMail');
					  $subject1="New Order Request Submitted from ".$customername;
					  $config = array (
								  'mailtype' => 'html',
								  'charset'  => 'utf-8',
								  'priority' => '1'
								   );
							  $this->email->initialize($config);
					  $this->email->set_newline('\r\n');
					  $email_body1 =$emailmsg;
				  
				  //$this->email->initialize($config);
				  $this->email->from($frommail1, $customername);
				  $this->email->to($tomail1);
				  //$this->email->bcc();
				  $this->email->subject($subject1);
				  $this->email->message($email_body1);
				  $this->email->send();
				  //redirect('checkout/payment_confirm', 'refresh');
					$data['main_content']="frontend/payment_confirm";
     				$this->load->view('template', $data);
					//}
				}
				else{
					$data['countryAll']= $this->Index_model->getDataById('countryall','parent_id','22','name','asc','');
					$data['main_content']="frontend/checkoutLoginUser";
					$this->load->view('template', $data);
				}
	}
	
	function payment_confirm()
	{
		$data['title'] = "Payment Confirm : butikbd.com";
		$data['footermenu']	= $this->Index_model->getAllMenu();
		$data['allbutikshop']	= $this->Index_model->getDataById('boutiqueshop','active','1','user_id','desc','20');
		$data['search_kewwords']	= $this->Index_model->search_kewwords();
		$data['menu']	= $this->Index_model->getDataById('menu','root_id',0,'m_id','asc','');
		$data['main_content']="frontend/payment_confirm";
     	$this->load->view('template', $data);
	}
	
}

?>
