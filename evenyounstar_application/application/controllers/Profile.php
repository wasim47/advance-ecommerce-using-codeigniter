<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Index_model');
		date_default_timezone_set('Asia/Dhaka');
     	$this->load->library('email');
		$this->load->library('cart');
	}

	function customer()
  	{
		
		if(!$this->session->userdata('userAccessMail') || $this->session->userdata('userAccessType')!='customer') redirect('index');
		$segment = $this->uri->segment(3);
		$data['title'] = $this->session->userdata('userAccessName');
		$userAccessType = $this->session->userdata('userAccessType');
		$userMail = $this->session->userdata('userAccessMail');
		$userName = $this->session->userdata('userAccessName');
		$user_id = $this->session->userdata('userAccessId');
		$data['search_kewwords']	= $this->Index_model->search_kewwords();
		
		$data['menu']	= $this->Index_model->getDataById('menu','root_id',0,'m_id','asc','');
		$data['allbutikshop']	= $this->Index_model->getNotIdData('boutiqueshop','','','','','username','asc','');
		$data['totaldistrict']= $this->Index_model->getAllDistrict('bangladesh','','','district','district','asc');
		$data['footermenu']	= $this->Index_model->getAllMenu();
		
			$data['userProfile']	= $this->Index_model->getOneItemTable('customer','user_id',$user_id,'user_id','desc');
			$data['shippingInfo']	= $this->Index_model->getOneItemTable('shipping_address','customer_id',$user_id,'customer_id','desc');
			$data['userOrder']	= $this->Index_model->getDataById('orders','customer_id',$user_id,'order_id','desc','');
			if($data['userOrder']->num_rows() > 0){
				foreach($data['userOrder']->result() as $ord){
				$oid[] = $ord->order_id;
				}
				$data['orderProduct']	= $this->Index_model->getDataByIdArray('orders_products','order_id',$oid,'id','desc','');
					foreach($data['orderProduct']->result() as $ordPro){
					$proId[] = $ordPro->product_id;
				}
				$data['orderproductList']	= $this->Index_model->getDataByIdArray('product','product_id',$proId,'product_id','desc','');
			}
			
		if($this->input->post('editProfile') && $this->input->post('editProfile')!=""){
				$save['username']	= $this->input->post('username');
				$save['email']	    = $this->input->post('email');
				$save['mobile']	    = $this->input->post('mobile');
				$save['country']	= "Bangladesh";
				$save['city']	    = $this->input->post('district');
				$save['thana']	    = $this->input->post('thana');
				$save['gender']	    = $this->input->post('gender');
				$save['address']	= $this->input->post('address');
				
				$this->Index_model->update_table('customer','user_id',$user_id,$save);
				$this->session->set_flashdata('successMsg', '<h3 class="alert alert-success">Successfully Updated </h3>');
				redirect('profile/customer/updateprofile', 'refresh');
		}
		elseif($this->input->post('passwordChange')){
			$data['title'] = 'Error! Password Change';

			$this->form_validation->set_rules('oldpassword', 'Old Password', 'trim|required');
			$this->form_validation->set_rules('newPass', 'New Password', 'trim|required|matches[confirmpassword]');
			$this->form_validation->set_rules('confirmpassword', 'Password Confirmation', 'required');
			$old_password = sha1($this->input->post('oldpassword'));
			$queryCheck = $this->Index_model->checkOldPass('customer',$old_password,$user_id);
			if($queryCheck->num_rows() > 0 ){
				if($this->form_validation->run() != false){
					$password =sha1($this->input->post('newPass'));
					$passwordHints =$this->input->post('newPass');
					$dataUpdate = array(
						'password'		=> $password,
						'passwordHints'	=> $passwordHints,
						'modify_date'	=> date('Y-m-d H:i:s')
					);
					
					$query = $this->Index_model->updateTable('customer','user_id',$user_id,$dataUpdate);
					if($query){
						$this->session->set_flashdata('globalMsg', '<h3 class="alert alert-success">Password Change Successfully </h3>');
						//redirect('profile/customer/changepassword', 'refresh');
					}
				}
			}
			else{
				$this->session->set_flashdata('globalMsg', '<dh3iv class="alert alert-danger">Old Password not match </h3>');
				//redirect('profile/customer/changepassword', 'refresh');
			}
		}	
			
			
			
		if($segment=='updateprofile'){
			$data['main_content']="frontend/customer/updateprofile";
		}
		elseif($segment=='changepassword'){
			$data['main_content']="frontend/customer/changepassword";
		}
		elseif($segment=='productlist'){
			$data['main_content']="frontend/customer/productlist";
		}
		elseif($segment=='orderhistory'){
			$data['main_content']="frontend/customer/orderHistory";
		}
		elseif($segment=='shippingaddress'){
			$data['main_content']="frontend/customer/shippingaddress";
		}
		else{
			$data['main_content']="frontend/customer/userProfile";
		}
		
		$this->load->view('template', $data);
	} 
	
	function boutiqueshop()
  	{
		
		if(!$this->session->userdata('userAccessMail') || $this->session->userdata('userAccessType')!='Enterprise') redirect('index');
		$segment = $this->uri->segment(3);
		$data['title'] = $this->session->userdata('userAccessName');
		$userAccessType = $this->session->userdata('userAccessType');
		$userMail = $this->session->userdata('userAccessMail');
		$userName = $this->session->userdata('userAccessName');
		$data['search_kewwords']	= $this->Index_model->search_kewwords();
		$user_id = $this->session->userdata('userAccessId');
		$data['footermenu']	= $this->Index_model->getDataById('menu','menu_type','About Listify','sequence','desc','');
		$data['footermenu1']	= $this->Index_model->getDataById('menu','menu_type','Stay Connected','sequence','desc','');
		$data['enterpriseData']	= $this->Index_model->checkUserTemplate('enterprise','user_id',$user_id);
		$data['productList']	= $this->Index_model->getDataById('product','enterprise',$user_id,'product_id','desc','');
		
		if($segment=='productlist'){
			$data['main_content']="frontend/enterprise/book_list";
		}
		elseif($segment=='profile'){
			$data['main_content']="frontend/enterprise/updateInfo";
		}
		else{
			$data['main_content']="frontend/enterprise/userProfile";
		}
		$this->load->view('template', $data);
	} 

}

?>
