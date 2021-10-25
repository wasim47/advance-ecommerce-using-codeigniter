<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ouradminmanage extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Index_model');
		$this->load->model('Membership_model');
		date_default_timezone_set('Asia/Dhaka');
     	$this->load->library('email');
		$this->load->library('cart');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->library('pagination');
		$this->load->helper('security');
	}
	function index()
	{
		if($this->session->userdata('AdminAccessMail')) redirect("ouradminmanage/dashboard");
		$data['title']="Butikbd.com | Bangladesh Largest Online Butik Market";
        $this->load->view('admin/index',$data);
	}

/////////////////////// Admin Part ////////////////////////////////	 
	
	function dashboard()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$data['title']="Dashboard Butikbd | Bangladesh Paint Manufacturer’s Association";
		$data['main_content']="admin/dashboard";
        $this->load->view('admin_template',$data);
	}
	function admin_list()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$data['title']="Article List Butikbd | Bangladesh Paint Manufacturer’s Association";
		$data['admin_list'] = $this->Index_model->getTable('users','id','desc');
		$data['main_content']="admin/administration/admin_list";
        $this->load->view('admin_template',$data);
	} 
	
	function admin_registration()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$data['title']="Admin Registration | Butikbd";
		$userId=$this->uri->segment(3);
		$data['adminUpdate'] = $this->Index_model->getAllItemTable('users','id',$userId,'','','id','desc');
		
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			if($userId!=''){
				$original_value = $this->db->query("SELECT email FROM users WHERE id = ".$userId)->row()->email;
				if($this->input->post('email') != $original_value) {
				   $is_unique =  '|is_unique[users.email]';
				} else {
				   $is_unique =  '';
				}
		}
		else{
			$is_unique =  '|is_unique[users.email]';	
		}
			$this->form_validation->set_rules('username', 'User Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Login Email', 'trim|required'.$is_unique);
			$this->form_validation->set_rules('password', 'Password', 'trim|required|matches[confirmpassword]');
			$this->form_validation->set_rules('confirmpassword', 'Password Confirmation', 'required');
			
			if($this->form_validation->run() != false){
				$save['username']	    = $this->input->post('username');
				$save['contactno']	    = $this->input->post('contactno');
				$save['admin_type']	    = $this->input->post('admintype');
				$save['email']	    	= $this->input->post('email');
				$save['password']	    = sha1($this->input->post('password'));
				$save['pass_hints']	    = $this->input->post('password');
				$save['created_on']	    = date('Y-m-d');
				$save['active']	    	= 1;
				
				if($this->input->post('user_id')!=""){
					$user_id=$this->input->post('user_id');
					$this->Index_model->update_table('users','id',$user_id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('users', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('ouradminmanage/admin_list', 'refresh');
				
				
			}
			else{
				$data['main_content']="admin/administration/admin_registration";
        		$this->load->view('admin_template', $data);
				}
		}
		$data['main_content']="admin/administration/admin_registration";
        $this->load->view('admin_template', $data);
	}


	public function userLogin()
     {
          $username = $this->input->post("username");
  		  $password = $this->input->post("password");
          $this->form_validation->set_rules("username", "Email", "trim|required|min_length[6]|valid_email");
          $this->form_validation->set_rules("password", "Password", "trim|required");

          if ($this->form_validation->run() == FALSE)
          {
              redirect('ouradminmanage');
          }
          else
          {
                    $usr_result = $this->Index_model->get_AdminLogin($username, $password);
                    if ($usr_result > 0) //active user record is present
                    {
					  $sessiondata = array(
						'AdminAccessMail'=>$username,
						'AdminAccessName'=> $usr_result['username'],
						'AdminType'=> $usr_result['admin_type'],
						'AdminAccessPermission'=> $usr_result['admin_access'],
						'AdminAccessId' => $usr_result['id'],
						'password' => TRUE
					   );
						$this->session->set_userdata($sessiondata);
						redirect("ouradminmanage/dashboard/");
                    }
                    else
                    {
                     $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center" style="padding:7px; margin-bottom:5px">Invalid Email and password!</div>');
                     redirect('ouradminmanage');
                    }
          }
     }
	 
    function logout()
  	{
	  $sessiondata = array(
				'AdminAccessMail'=>'',
				'AdminAccessName'=> '',
				'AdminType'=> '',
				'AdminAccessPermission'=> '',
				'AdminAccessId' => '',
				'password' => FALSE
		 );
	$this->session->unset_userdata($sessiondata);
	$this->session->sess_destroy();
    redirect('ouradminmanage', 'refresh');
  }
  	
	
	
	
	
	////////////// Customer Part/////////////////////////////////////////////////////////
	function customer_list()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$data['title']="customer List | Butikbd";
		$details=$this->uri->segment(3);
		$data['customer_list'] = $this->Index_model->getTable('customer','user_id','desc');
		if($details!=''){
			$mid=$this->uri->segment(4);
			$data['customerDetails'] = $this->Index_model->getAllItemTable('customer','user_id',$mid,'','','user_id','desc');
			$data['main_content']="admin/customer/customerDetails";
		}
		else{
			$data['main_content']="admin/customer/customer_list";
		}
		$this->load->view('admin_template',$data);
	} 
	
	function customer_registration()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$mid=$this->uri->segment(3);
		$data['countryAll']= $this->Index_model->getDataById('countryall','parent_id','22','name','asc','');
		$data['customerUpdate'] = $this->Index_model->getAllItemTable('customer','user_id',$mid,'','','user_id','desc');
		//print_r($data['customerUpdate']);
		$data['title']="Customer Registration | Butikbd";
		
		
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			if($mid){
				$this->form_validation->set_rules('email', 'Email', 'trim|required');
				$this->form_validation->set_rules('mobile', 'Mobile No', 'trim|required');
			}
			else{
				$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[customer.email]');
				$this->form_validation->set_rules('mobile', 'Mobile No', 'trim|required|is_unique[customer.mobile]');
			}
			
			$this->form_validation->set_rules('customerName', 'customer Name', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('city', 'city', 'trim|required');
			
			if($this->form_validation->run() != false){
				
				$save['username']	    = $this->input->post('gender').' '.$this->input->post('customerName');
				$save['mobile']	    = $this->input->post('mobile');
				$save['address']	    = $this->input->post('address');
				$save['country']	    = "Bangladesh";
				$save['city']	    = $this->input->post('city');
				$save['email']	    = $this->input->post('email');
				$save['password']	    = sha1($this->input->post('password'));
				$save['passwordHints']	    = $this->input->post('password');
				$save['created_date']	    = date('Y-m-d');
				
				
				if($this->input->post('customer_id')!=""){
					$customer_id=$this->input->post('customer_id');
					$this->Index_model->update_table('customer','user_id',$customer_id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('customer', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				
				redirect('ouradminmanage/customer_list', 'refresh');
			}
		}
		$data['main_content']="admin/customer/customer_action";
        $this->load->view('admin_template', $data);
	}
	
	



/////////////////////// menu ////////////////////////////////	 
	function menu_list()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$data['title']="Menu List | Butikbd";
		$data['menu_list'] = $this->Index_model->getTable('menu','m_id','desc');
		$data['main_content']="admin/menu/menu_list";
        $this->load->view('admin_template',$data);
	} 
	 
	 
	function menu_registration()
	{
		
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$artiId=$this->uri->segment(3);
		$data['menuUpdate'] = $this->Index_model->getAllItemTable('menu','m_id',$artiId,'','','m_id','desc');
		$data['root_menu'] = $this->Index_model->getAllItemTable('menu','root_id',0,'boutiqueshop','Butikbd','menu_name','asc');
		$data['boutiqueshop']		= $this->Index_model->getDataById('boutiqueshop','','','username','asc','');
		$bouid=$this->input->post('boutiqueshop');
		if(!$artiId){
			$data['title']="menu Registration | Butikbd";
			//$this->form_validation->set_rules('menu_name', 'menu name', 'trim|required|is_unique[menu.menu_name]');
			$this->form_validation->set_rules('m_name', 'menu name', 'callback_menu_check['.$bouid.']');
		}
		else{
			$data['title']="menu Update | Butikbd";
			$this->form_validation->set_rules('m_name', 'menu name', 'trim|required');
		}
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			if($this->form_validation->run() != false){
			$expval=explode(' ',$this->input->post('m_name'));
			$impval=implode('-',$expval);
				$save['menu_name']	    = addslashes($this->input->post('m_name'));
				$save['slug']	    =  $impval;
				$save['root_id']	    = $this->input->post('root_id');
				$save['boutiqueshop']	    = $this->input->post('boutiqueshop');
				$save['sroot_id']	    = $this->input->post('sroot_id');
				$save['page_structure']	    = $this->input->post('page_structure');
				$save['date']	    = date('Y-m-d');
				
				if($this->input->post('m_id')!=""){
					$m_id=$this->input->post('m_id');
					$this->Index_model->update_table('menu','m_id',$m_id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('menu', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('ouradminmanage/menu_list', 'refresh');
			}
			else{
				$data['main_content']="admin/menu/menu_action";
        		$this->load->view('admin_template', $data);
				}
		}
		$data['main_content']="admin/menu/menu_action";
        $this->load->view('admin_template', $data);
	}
	
	
	//'.base_url("ouradminmanage/ajaxData?sroot_id='+this.value+'").'
	function ajaxData()
	{
		if($this->input->get('root_id')!=""){
			$rid=$this->input->get('root_id');
			$url="'".base_url()."ouradminmanage/ajaxData?sroot_id='+this.value+''";
			$sroot_menu = $this->Index_model->getAllItemTable('menu','root_id',$rid,'','','menu_name','asc');
			$svar='<select name="sroot_id" class="form-control" style="width:60%;" onChange="getSubMenu('.$url.')">
								<option value="">Sub Menu</option>';
								 foreach($sroot_menu->result() as $rootmenu):
									$svar .= '<option value="'.$rootmenu->m_id.'">'.$rootmenu->menu_name.'</option>';
								endforeach;
							$svar .= '</select>';
			echo $svar;
		}
		elseif($this->input->get('sroot_id')!=""){
			$rid=$this->input->get('sroot_id');
			$sroot_menu = $this->Index_model->getAllItemTable('menu','sroot_id',$rid,'','','menu_name','asc');
			$svar='<select name="lroot_id" class="form-control" style="width:60%;">
								<option value="">Last Menu</option>';
								 foreach($sroot_menu->result() as $rootmenu):
									$svar .= '<option value="'.$rootmenu->m_id.'">'.$rootmenu->menu_name.'</option>';
								endforeach;
							$svar .= '</select>';
			echo $svar;
		}
	}


public function menu_check($str,$boutique)
	{
		$value = $this->Index_model->menu_exist($str,$boutique);		
		if ($value->num_rows() > 0)
		{
			$this->form_validation->set_message('m_name', 'The %s already exist');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	
	
	
	/////////////////////// article ////////////////////////////////	 
	function article_list()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$data['title']="Article List | Butikbd";
		$data['article_list'] = $this->Index_model->getTable('article_manage','a_id','desc');
		$data['main_content']="admin/article/article_list";
        $this->load->view('admin_template',$data);
	} 
	 
	 
	 
	function article_registration()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$data['root_menu'] = $this->Index_model->getAllItemTable('menu','','','','','menu_name','asc');
		$data['boutiqueshop']		= $this->Index_model->getDataById('boutiqueshop','','','username','asc','');
		$artiId=$this->uri->segment(3);
		if(!$artiId){
			$data['title']="Article Registration | Butikbd";
		}
		else{
			$data['title']="Article Update | Butikbd";
		}
		$data['articleUpdate'] = $this->Index_model->getAllItemTable('article_manage','a_id',$artiId,'','','a_id','desc');
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			$this->form_validation->set_rules('headline', 'Article Headline', 'trim|required');
			$this->form_validation->set_rules('details', 'Article Details', 'trim|required');
			
			if($this->form_validation->run() != false){
				$save['menu_title']	    = $this->input->post('root_id');
				$save['boutiqueshop']	    = $this->input->post('boutiqueshop');
				$save['headline']	    = $this->input->post('headline');
				$save['details']	    	= $this->input->post('details');
				$save['date']	    = date('Y-m-d');
				
				if($this->input->post('a_id')!=""){
					$a_id=$this->input->post('a_id');
					$this->Index_model->update_table('article_manage','a_id',$a_id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('article_manage', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('ouradminmanage/article_list', 'refresh');
			}
			else{
				$data['main_content']="admin/article/article_action";
        		$this->load->view('admin_template', $data);
				}
		}
		else{
				$data['main_content']="admin/article/article_action";
        		$this->load->view('admin_template', $data);
				}
	}
	
	/////////////////////// feature ////////////////////////////////	 
	function feature_list()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$data['title']="feature List | Butikbd";
		$data['feature_list'] = $this->Index_model->getTable('feature_manage','a_id','desc');
		$data['main_content']="admin/feature/feature_list";
        $this->load->view('admin_template',$data);
	} 
	 
	 
	 
	function feature_registration()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$data['root_menu'] = $this->Index_model->getAllItemTable('menu','','','','','menu_name','asc');
		$data['boutiqueshop']		= $this->Index_model->getDataById('boutiqueshop','','','username','asc','');
		$artiId=$this->uri->segment(3);
		if(!$artiId){
			$data['title']="feature Registration | Butikbd";
		}
		else{
			$data['title']="feature Update | Butikbd";
		}
		$data['featureUpdate'] = $this->Index_model->getAllItemTable('feature_manage','a_id',$artiId,'','','a_id','desc');
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			$this->form_validation->set_rules('headline', 'feature Headline', 'trim|required');
			$this->form_validation->set_rules('details', 'feature Details', 'trim|required');
			
			if($this->form_validation->run() != false){
				$save['menu_title']	    = $this->input->post('root_id');
				$save['headline']	    = $this->input->post('headline');
				$save['details']	    	= $this->input->post('details');
				$save['date']	    = date('Y-m-d');
				
				if($this->input->post('a_id')!=""){
					$a_id=$this->input->post('a_id');
					$this->Index_model->update_table('feature_manage','a_id',$a_id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('feature_manage', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('ouradminmanage/feature_list', 'refresh');
			}
			else{
				$data['main_content']="admin/feature/feature_action";
        		$this->load->view('admin_template', $data);
				}
		}
		else{
				$data['main_content']="admin/feature/feature_action";
        		$this->load->view('admin_template', $data);
				}
	}
	
/////////////////////// Category ////////////////////////////////	 
	function category_list()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$data['title']="Category List | Butikbd";
		$data['category_list'] = $this->Index_model->getTable('category','cid','desc');
		$data['main_content']="admin/product_category/category_list";
        $this->load->view('admin_template',$data);
	} 
	 
	 
	function category_registration()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$artiId=$this->uri->segment(3);
		$bouid=$this->input->post('boutiqueshop');
		$data['boutiqueshop']		= $this->Index_model->getDataById('boutiqueshop','','','username','asc','');
		$data['categoryUpdate'] = $this->Index_model->getAllItemTable('category','cid',$artiId,'','','cid','desc');
		if(!$artiId){
			$data['title']="category Registration | Butikbd";
			$this->form_validation->set_rules('category_name', 'category name', 'callback_category_check['.$bouid.']');
		}
		else{
			$data['title']="category Update | Butikbd";
			$this->form_validation->set_rules('category_name', 'category name', 'trim|required');
		}
		
		
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			if($this->form_validation->run() != false){
				
				$config['allowed_types'] = '*';
				$config['remove_spaces'] = true;
				$config['max_size'] = '1000000';
				$config['upload_path'] = './uploads/images/product_category/category/';
				$config['charset'] = "UTF-8";
				$new_name = "Banner_".time();
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
					if (isset($_FILES['catImage']['name']))
					{
						if($this->upload->do_upload('catImage')){
							$upload_data	= $this->upload->data();
							$save['image']	= $upload_data['file_name'];
						}
						else{
							$upload_data	= $this->input->post('stillimage');
							$save['image']	= $upload_data;	
						}
					}	
				
				
				$expval=explode(' ',$this->input->post('category_name'));
				$impval=implode('-',$expval);
				$save['boutiqueshop']	    = $bouid;
				$save['cat_name']	    = addslashes($this->input->post('category_name'));
				$save['caegory_title']	    = addslashes($impval);
				$save['short_desc']	    = addslashes($this->input->post('short_desc'));
				$save['create_date']	    = date('Y-m-d');
				$save['status']	    = $this->input->post('status');
				
				if($this->input->post('cid')!=""){
					$cid=$this->input->post('cid');
					$this->Index_model->update_table('category','cid',$cid,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('category', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('ouradminmanage/category_list', 'refresh');
			}
			else{
				$data['main_content']="admin/product_category/category_action";
        		$this->load->view('admin_template', $data);
				}
		}
		else{
			$data['main_content']="admin/product_category/category_action";
			$this->load->view('admin_template', $data);
		}
	}
	

	public function category_check($str,$boutique)
	{
		$value = $this->Index_model->category_exist($str,$boutique);		
		if ($value->num_rows() > 0)
		{
			$this->form_validation->set_message('username_check', 'The %s already exist');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

/////////////////////// sub_category ////////////////////////////////	 
	function sub_category_list()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$data['title']="sub_category List | Butikbd";
		$data['sub_category_list'] = $this->Index_model->getTable('sub_category','scid','desc');
		$data['main_content']="admin/product_category/sub_category_list";
        $this->load->view('admin_template',$data);
	} 
	 
	 
	function sub_category_registration()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$artiId=$this->uri->segment(3);
		$bouid=$this->input->post('boutiqueshop');
		$cate=$this->input->post('category');
		$data['boutiqueshop']		= $this->Index_model->getDataById('boutiqueshop','','','username','asc','');
		$data['sub_categoryUpdate'] = $this->Index_model->getAllItemTable('sub_category','scid',$artiId,'','','scid','desc');
		$data['category_list'] = $this->Index_model->getTable('category','cid','desc');
		if(!$artiId){
			$data['title']="sub_category Registration | Butikbd";
			//$this->form_validation->set_rules('sub_category_name', 'sub_category name', 'trim|required|is_unique[sub_category.sub_cat_name]');
			$this->form_validation->set_rules('sub_category_name', 'Sub Category name', 'callback_subcategory_check['.$bouid.','.$cate.']');
		}
		else{
			$data['title']="sub_category Update | Butikbd";
			$this->form_validation->set_rules('sub_category_name', 'sub_category name', 'trim|required');
		}
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			if($this->form_validation->run() != false){
				
				$config['allowed_types'] = '*';
				$config['remove_spaces'] = true;
				$config['max_size'] = '1000000';
				$config['upload_path'] = './uploads/images/product_category/sub_category/';
				$config['charset'] = "UTF-8";
				$new_name = "Banner_".time();
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
					if (isset($_FILES['catImage']['name']))
					{
						if($this->upload->do_upload('catImage')){
							$upload_data	= $this->upload->data();
							$save['image']	= $upload_data['file_name'];
						}
						else{
							$upload_data	= $this->input->post('stillimage');
							$save['image']	= $upload_data;	
						}
					}	
				
				
				$expval=explode(' ',$this->input->post('sub_category_name'));
				$impval=implode('-',$expval);
				$save['boutiqueshop']	    = $bouid;
				$save['cat_id']	    = $cate;
				$save['sub_cat_name']	    = addslashes($this->input->post('sub_category_name'));
				$save['sub_cat_title']	    = addslashes($impval);
				$save['short_desc']	    = addslashes($this->input->post('short_desc'));
				$save['create_date']	    = date('Y-m-d');
				$save['status']	    = $this->input->post('status');
				
				if($this->input->post('scid')!=""){
					$scid=$this->input->post('scid');
					$this->Index_model->update_table('sub_category','scid',$scid,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('sub_category', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('ouradminmanage/sub_category_list', 'refresh');
			}
			else{
				$data['main_content']="admin/product_category/sub_category_action";
        		$this->load->view('admin_template', $data);
				}
		}
		$data['main_content']="admin/product_category/sub_category_action";
        $this->load->view('admin_template', $data);
	}

	public function subcategory_check($str,$boutique,$catid)
	{
		$value = $this->Index_model->subcategory_exist($str,$boutique,$catid);		
		if ($value->num_rows() > 0)
		{
			$this->form_validation->set_message('subcategory_check', 'The %s already exist');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	/////////////////////// last_category ////////////////////////////////	 
	function last_category_list()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$data['title']="last_category List | Butikbd";
		$data['last_category_list'] = $this->Index_model->getTable('last_category','id','desc');
		$data['main_content']="admin/product_category/last_category_list";
        $this->load->view('admin_template',$data);
	} 
	 
	 
	function last_category_registration()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$artiId=$this->uri->segment(3);
		$bouid=$this->input->post('boutiqueshop');
		$cate=$this->input->post('cat_id');
		$scate=$this->input->post('subcat_id');
		$data['boutiqueshop']		= $this->Index_model->getDataById('boutiqueshop','','','username','asc','');
		$data['last_categoryUpdate'] = $this->Index_model->getAllItemTable('last_category','id',$artiId,'','','id','desc');
		$data['allcategory']		= $this->Index_model->getDataById('category','','','cat_name','asc','');
		if(!$artiId){
			$data['title']="last_category Registration | Butikbd";
			//$this->form_validation->set_rules('last_category_name', 'last_category name', 'trim|required|is_unique[last_category.lastcat_name]');
			$this->form_validation->set_rules('last_category_name', 'last_category name', 'trim|required');
		}
		else{
			$data['title']="last_category Update | Butikbd";
			$this->form_validation->set_rules('last_category_name', 'last_category name', 'trim|required');
		}
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			if($this->form_validation->run() != false){
				
				$config['allowed_types'] = '*';
				$config['remove_spaces'] = true;
				$config['max_size'] = '1000000';
				$config['upload_path'] = './uploads/images/product_category/last_category/';
				$config['charset'] = "UTF-8";
				$new_name = "Banner_".time();
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
					if (isset($_FILES['catImage']['name']))
					{
						if($this->upload->do_upload('catImage')){
							$upload_data	= $this->upload->data();
							$save['image']	= $upload_data['file_name'];
						}
						else{
							$upload_data	= $this->input->post('stillimage');
							$save['image']	= $upload_data;	
						}
					}	
				
				$save['boutiqueshop']	    = $bouid;
				$save['cat_id']	    = $cate;
				$save['subcat_id']	    = $scate;
				$expval=explode(' ',$this->input->post('last_category_name'));
				$impval=implode('-',$expval);
				$save['lastcat_name']	    = addslashes($this->input->post('last_category_name'));
				$save['last_cat_title']	    = addslashes($impval);
				$save['short_desc']	    = addslashes($this->input->post('short_desc'));
				$save['create_date']	    = date('Y-m-d');
				$save['status']	    = $this->input->post('status');
				
				if($this->input->post('id')!=""){
					$id=$this->input->post('id');
					$this->Index_model->update_table('last_category','id',$id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('last_category', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('ouradminmanage/last_category_list', 'refresh');
			}
			else{
				$data['main_content']="admin/product_category/last_category_action";
        		$this->load->view('admin_template', $data);
				}
		}
		$data['main_content']="admin/product_category/last_category_action";
        $this->load->view('admin_template', $data);
	}
	
	
	
	function ajaxCatData()
	{
		if($this->input->get('root_id')!=""){
			$rid=$this->input->get('root_id');
			$url="'".base_url()."ouradminmanage/ajaxData?sroot_id='+this.value+''";
			$sroot_category = $this->Index_model->getAllItemTable('category','root_id',$rid,'','','category_name','asc');
			$svar='<select name="sroot_id" class="form-control" style="width:60%;" onChange="getSubcategory('.$url.')">
								<option value="">Sub category</option>';
								 foreach($sroot_category->result() as $rootcategory):
									$svar .= '<option value="'.$rootcategory->cid.'">'.$rootcategory->category_name.'</option>';
								endforeach;
							$svar .= '</select>';
			echo $svar;
		}
		elseif($this->input->get('sroot_id')!=""){
			$rid=$this->input->get('sroot_id');
			$sroot_category = $this->Index_model->getAllItemTable('category','sroot_id',$rid,'','','category_name','asc');
			$svar='<select name="lroot_id" class="form-control" style="width:60%;">
								<option value="">Last category</option>';
								 foreach($sroot_category->result() as $rootcategory):
									$svar .= '<option value="'.$rootcategory->cid.'">'.$rootcategory->category_name.'</option>';
								endforeach;
							$svar .= '</select>';
			echo $svar;
		}
	}




	
	/////////////////////// banner ////////////////////////////////	 
	function banner_list()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$data['title']="banner List | Butikbd";
		$data['banner_list'] = $this->Index_model->getTable('banner','b_id','desc');
		$data['main_content']="admin/banner/banner_list";
        $this->load->view('admin_template',$data);
	} 
	 
	 
	 
	function banner_registration()
	{
	
	if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
	$data['boutiqueshop']		= $this->Index_model->getDataById('boutiqueshop','','','username','asc','');	
		$artiId=$this->uri->segment(3);
		if(!$artiId){
			$data['title']="Banner Registration | Butikbd";
		}
		else{
			$data['title']="Banner Update | Butikbd";
		}
		$data['bannerUpdate'] = $this->Index_model->getAllItemTable('banner','b_id',$artiId,'','','b_id','desc');
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			$this->form_validation->set_rules('banner_name', 'banner name', 'trim|required');
			$this->form_validation->set_rules('boutiqueshop', 'Boutiqueshop', 'trim|required');
			
			if($this->form_validation->run() != false){
				
			$config['allowed_types'] = '*';
			$config['remove_spaces'] = true;
			$config['max_size'] = '1000000';
			$config['upload_path'] = './uploads/images/banner/';
			$config['charset'] = "UTF-8";
			$new_name = "Banner_".time();
			$config['file_name'] = $new_name;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
				if (isset($_FILES['bannerPhoto']['name']))
				{
					if($this->upload->do_upload('bannerPhoto')){
						$upload_data	= $this->upload->data();
						$save['image']	= $upload_data['file_name'];
					}
					else{
						$upload_data	= $this->input->post('stillimg');
						$save['image']	= $upload_data;	
					}
				}	
				
				$save['boutiqueshop']	    = $this->input->post('boutiqueshop');
				$save['bg_color']	    = $this->input->post('bg_color');
				$save['banner_name']	    = $this->input->post('banner_name');
				$save['subtitle']	    = $this->input->post('subtitle');
				$save['date']	    = date('Y-m-d');
				
				if($this->input->post('b_id')!=""){
					$b_id=$this->input->post('b_id');
					$this->Index_model->update_table('banner','b_id',$b_id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('banner', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('ouradminmanage/banner_list', 'refresh');
			}
			else{
				$data['main_content']="admin/banner/banner_action";
        		$this->load->view('admin_template', $data);
				}
		}
		$data['main_content']="admin/banner/banner_action";
        $this->load->view('admin_template', $data);
	}


/////////////////////// advertisement ////////////////////////////////	 
	function advertisement_list()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$data['title']="advertisement List | Butikbd";
		$data['advertisement_list'] = $this->Index_model->getTable('advertisement','b_id','desc');
		$data['main_content']="admin/advertisement/advertisement_list";
        $this->load->view('admin_template',$data);
	} 
	 
	 
	 
	function advertisement_registration()
	{
		
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$artiId=$this->uri->segment(3);
		if(!$artiId){
			$data['title']="advertisement Registration | Butikbd";
		}
		else{
			$data['title']="advertisement Update | Butikbd";
		}
		$data['advertisementUpdate'] = $this->Index_model->getAllItemTable('advertisement','b_id',$artiId,'','','b_id','desc');
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			$this->form_validation->set_rules('advertisement_name', 'advertisement name', 'trim|required');
			
			if($this->form_validation->run() != false){
				$config['allowed_types'] = '*';
				$config['remove_spaces'] = true;
				$config['max_size'] = '1000000';
				$config['upload_path'] = './uploads/images/advertisement/';
				$config['charset'] = "UTF-8";
				$new_name = "Advertisement_".time();
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
					if (isset($_FILES['ad_photo']['name']))
					{
						if($this->upload->do_upload('ad_photo')){
							$upload_data	= $this->upload->data();
							$save['image']	= $upload_data['file_name'];
						}
						else{
							$upload_data	= "";
							$save['image']	= $upload_data;	
						}
					}	
				
				$save['advertisement_name']	    = $this->input->post('advertisement_name');
				$save['date']	    = date('Y-m-d');
				
				if($this->input->post('b_id')!=""){
					$b_id=$this->input->post('b_id');
					$this->Index_model->update_table('advertisement','b_id',$b_id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('advertisement', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('ouradminmanage/advertisement_list', 'refresh');
			}
			else{
				$data['main_content']="admin/advertisement/advertisement_action";
        		$this->load->view('admin_template', $data);
				}
		}
		$data['main_content']="admin/advertisement/advertisement_action";
        $this->load->view('admin_template', $data);
	}
	
	
	
	/////////////////////// Events ////////////////////////////////	 
	function events_list()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$data['title']="events List | Butikbd";
		$data['events_list'] = $this->Index_model->getTable('events','m_id','desc');
		$data['main_content']="admin/events/events_list";
        $this->load->view('admin_template',$data);
	} 
	 
	 
	 
	function events_registration()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$artiId=$this->uri->segment(3);
		
		$data['eventsUpdate'] = $this->Index_model->getAllItemTable('events','m_id',$artiId,'','','m_id','desc');
		if(!$artiId){
			$data['title']="Events Registration | Butikbd";
			$this->form_validation->set_rules('events_name', 'events name', 'trim|required|is_unique[events.events_name]');
		}
		else{
			$data['title']="Events Update | Butikbd";
			$this->form_validation->set_rules('events_name', 'events name', 'trim|required');
		}
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			if($this->form_validation->run() != false){
				$config['allowed_types'] = '*';
				$config['remove_spaces'] = true;
				$config['max_size'] = '1000000';
				$config['upload_path'] = './uploads/images/event/';
				$config['charset'] = "UTF-8";
				$new_name = "Advertisement_".time();
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
					if (isset($_FILES['ad_photo']['name']))
					{
						if($this->upload->do_upload('ad_photo')){
							$upload_data	= $this->upload->data();
							$save['image']	= $upload_data['file_name'];
						}
						else{
							$upload_data	= "";
							$save['image']	= $upload_data;	
						}
					}
					
					
			$expval=explode(' ',$this->input->post('events_name'));
			$impval=implode('-',$expval);
				$save['events_name']	    = addslashes($this->input->post('events_name'));
				$save['events_details']	    = addslashes($this->input->post('details'));
				$save['slug']	    = addslashes(strtolower($impval));
				$save['upcomming_id	']	    = $this->input->post('upcomming_id	');
				$save['latest_id']	    = $this->input->post('latest_id');
				$save['date']	    = date('Y-m-d');
				
				if($this->input->post('m_id')!=""){
					$m_id=$this->input->post('m_id');
					$this->Index_model->update_table('events','m_id',$m_id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('events', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('ouradminmanage/events_list', 'refresh');
			}
			else{
				$data['main_content']="admin/events/events_action";
        		$this->load->view('admin_template', $data);
				}
		}
		$data['main_content']="admin/events/events_action";
        $this->load->view('admin_template', $data);
	}
	
	
	/////////////////////// Boutique shop  ////////////////////////////////	 
	function boutique_list()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$data['title']="Boutique Shop List | Butikbd";
		$data['boutiqueshoplist'] = $this->Index_model->getTable('boutiqueshop','user_id','desc');
		$data['main_content']="admin/boutique/boutique_list";
        $this->load->view('admin_template',$data);
	} 
	 
	 
	 
	function boutique_registration()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$artiId=$this->uri->segment(3);
		$data['title']="New Boutique Shop | Butikbd";
		if($artiId!=''){
		$original_value = $this->db->query("SELECT urlname FROM boutiqueshop WHERE user_id = ".$artiId)->row()->urlname;
			if($this->input->post('urlname') != $original_value) {
			   $is_unique =  '|is_unique[boutiqueshop.urlname]';
			} else {
			   $is_unique =  '';
			}
		}
		else{
			$is_unique =  '|is_unique[boutiqueshop.urlname]';	
		}
		
		$this->form_validation->set_rules('urlname','Url Name','required|trim|regex_match[/^[A-Za-z0-9_]+$/]'.$is_unique);

		$data['boutiqueUpdate'] = $this->Index_model->getAllItemTable('boutiqueshop','user_id',$artiId,'','','user_id','desc');
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			
		$this->form_validation->set_rules('boutiqueshop_name','Boutiqueshop Name','required|trim');
		if($this->form_validation->run() != false){
			$config['allowed_types'] = '*';
			$config['remove_spaces'] = true;
			$config['max_size'] = '1000000';
			$config['upload_path'] = './uploads/images/boutiqueshop/';
			$config['charset'] = "UTF-8";
			$new_name = "boutiqueshop_".time();
			$config['file_name'] = $new_name;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (isset($_FILES['companyLogo']['name']))
			{
			if($this->upload->do_upload('companyLogo')){
					$upload_data	= $this->upload->data();
					$save['photo']	= $upload_data['file_name'];
				}
				else{
					$upload_data	= $this->input->post('stillImg');
					$save['photo']	= $upload_data;	
				}
			}
			
			$urlname=ucfirst($this->input->post('urlname'));
			$urlname=ucfirst($this->input->post('urlname'));
			$shopname=$this->input->post('boutiqueshop_name');
			$ownername=$this->input->post('owner');
			$contct=$this->input->post('mobile');
			
			$save['urlname']	    = $this->input->post('urlname');
			$save['username']	    = $this->input->post('boutiqueshop_name');
			$save['telephone']	    = $this->input->post('telephone');
			$save['mobile']	    = $this->input->post('mobile');
			$save['address']	    = $this->input->post('address');
			$save['website']	    = $this->input->post('website');
			$save['email']	    = $this->input->post('email');
			$save['password']	    = sha1($this->input->post('password'));
			$save['passwordHints']	    = $this->input->post('password');
			$save['ownername']	    = $this->input->post('owner');
			$save['date']	    = date('Y-m-d');
			$save['active']	    = 0;
			
			
				
				if($this->input->post('boutiqueshop_id')!=""){
					$b_id=$this->input->post('boutiqueshop_id');
					$query = $this->Index_model->update_table('boutiqueshop','user_id',$b_id,$save);
					$s='Updated';
				}
				else{
					$save['urlname']	    = $this->input->post('urlname');
					$save['password']	    = sha1($this->input->post('password'));
					$save['passwordHints']	    = $this->input->post('password');
					$query = $this->Index_model->inertTable('boutiqueshop', $save);
					$s='Inserted';
					}
				if($query){	
						$copyfile=APPPATH."controllers/Boutique.php";
						$newfile=APPPATH."controllers/".$urlname.".php";
							
						$file_data = "<?php defined('BASEPATH') OR exit('No direct script access allowed');
				
				class ".$urlname." extends CI_Controller { ";
						$file_data .= file_get_contents($copyfile);
						file_put_contents($newfile, $file_data);
							
						if($this->input->post('reg_status')!=""){
							$reg_status=$this->input->post('reg_status');
							$payDetails = array(
								'type'		=> 'boutiqueshop',
								'reg_id'	=> $query,
								'reg_status'	=> $reg_status,
								'price'		=> $this->input->post('price'),
								'methode'	=> $this->input->post('pmathod'),
								'accountid'	=> $this->input->post('trnasitionId'),
								'joiningdate'=> date('Y-m-d'),
								//'expdate'	=> date('Y-m-d', strtotime('+1 years')),
							);
							$this->Index_model->inertTable('registrationdetails',$payDetails);
						}
					
					$email=$this->input->post('email');
					//$password=$this->input->post('password');
							$tomaila=$email;
							$frommaila="info@butikbd.com";
							$subjecta="Thank ".$this->input->post('boutiqueshop_name')." for registration with butikbd.com";
							$config = array (
										  'mailtype' => 'html',
										  'charset'  => 'utf-8',
										  'priority' => '1'
										   );
							$this->email->initialize($config);
							$this->email->set_newline('\r\n');
							$email_bodya ="
							<table width='100%' border='0' cellpadding='0' align='center' cellspacing='0' style='border:5px solid #F7C11D; border-radius:13px;'>
							<tr style='background-color:#fff'>
							<th width='26%' height='93' align='center'> 
							<img src='".base_url('assets/images/front/butikbdlogo.png')."' />
							<th colspan='2' align='left'></th>
							</tr>
                            
                            <tr>
							<td colspan='3' align='left' valign='top'>
                            	<table width='100%' border='0' cellpadding='0' cellspacing='0' style='color:#fff;font-size:18px; background:#F7C11D'>
                                  	<tr>
                                        <td width='37%' height='43'>Store Name</td>
                                        <td width='3%'><strong>:</strong></td>
                                        <td width='60%'>$shopname</td>
                                    </tr>
                                    <tr>
                                        <td width='37%' height='43'>Owner Name</td>
                                        <td width='3%'><strong>:</strong></td>
                                        <td width='60%'>$ownername</td>
                                    </tr>
                                    <tr>
                                        <td width='37%' height='43'>Contact</td>
                                        <td width='3%'><strong>:</strong></td>
                                        <td width='60%'>$contct</td>
                                    </tr>
                                    <tr>
                                        <td width='37%' height='43'>Account Status</td>
                                        <td width='3%'><strong>:</strong></td>
                                        <td width='60%'>$reg_status</td>
                                    </tr>
                                    
                                       <tr>
                                      <td height='49' colspan='3' align='center'>
                                        <strong>Your shop will be create within 24 hours.<br>If you have any query please contact butikbd.com
                                                Support Team by email: info@butikbd.com or mobile : +880673215210</strong></td>
                                      </tr>
                                       <tr>
                                      <td colspan='3'>&nbsp;</td>
                                      </tr>
                            		
                                </table>
                            </td>
							</tr> 
							
							</table>";
						
							//$this->email->initialize($config);
							$this->email->from($frommaila, 'butikbd.com');
							$this->email->to($tomaila);
							//$this->email->bcc();
							$this->email->subject($subjecta);
							$this->email->message($email_bodya);
							$this->email->send();


							$tomail="info@butikbd.com,wasim.html@gmail.com";
							$frommail=$email;
							$subject="New Boutique shop request fro ".$this->input->post('boutiqueshop_name');
							$config = array (
										  'mailtype' => 'html',
										  'charset'  => 'utf-8',
										  'priority' => '1'
										   );
							$this->email->initialize($config);
							$this->email->set_newline('\r\n');
							$email_body ="
							<table width='100%' border='0' cellpadding='0' align='center' cellspacing='0' style='border:5px solid #F7C11D; border-radius:13px;'>
							<tr style='background-color:#fff'>
							<th width='26%' height='93' align='center'> 
							<img src='".base_url('assets/images/front/butikbdlogo.png')."' />
							<th colspan='2' align='left'></th>
							</tr>
                            
                            <tr>
							<td colspan='3' align='left' valign='top'>
                            	<table width='100%' border='0' cellpadding='0' cellspacing='0' style='color:#fff;font-size:18px; background:#F7C11D'>
                                  	<tr>
                                        <td width='37%' height='43'>Store Name</td>
                                        <td width='3%'><strong>:</strong></td>
                                        <td width='60%'>$shopname</td>
                                    </tr>
                                    <tr>
                                        <td width='37%' height='43'>Owner Name</td>
                                        <td width='3%'><strong>:</strong></td>
                                        <td width='60%'>$ownername</td>
                                    </tr>
                                    <tr>
                                        <td width='37%' height='43'>Contact</td>
                                        <td width='3%'><strong>:</strong></td>
                                        <td width='60%'>$contct</td>
                                    </tr>
                                    <tr>
                                        <td width='37%' height='43'>Account Status</td>
                                        <td width='3%'><strong>:</strong></td>
                                        <td width='60%'>$reg_status</td>
                                    </tr>
                                       <tr>
                                      <td colspan='3'>&nbsp;</td>
                                      </tr>
                            		
                                </table>
                            </td>
							</tr> 
							
							</table>";
						
							//$this->email->initialize($config);
							$this->email->from($frommail, 'butikbd.com');
							$this->email->to($tomail);
							//$this->email->bcc();
							$this->email->subject($subject);
							$this->email->message($email_body);
							$this->email->send();
							
							
					
						$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
						redirect('ouradminmanage/boutique_list', 'refresh');
					//}
				}
			}
			else{
				$data['main_content']="admin/boutique/boutique_action";
        		$this->load->view('admin_template', $data);
				}
		}
		else{
			$data['main_content']="admin/boutique/boutique_action";
			$this->load->view('admin_template', $data);
		}
	}
	
	/////////////////////// agent  ////////////////////////////////	 
	function agent_list()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$data['title']="agent List | Butikbd";
		$data['agentlist'] = $this->Index_model->getTable('agent','user_id','desc');
		$data['main_content']="admin/agent/agent_list";
        $this->load->view('admin_template',$data);
	} 
	 
	 
	 
	function agent_registration()
	{
		$artiId=$this->uri->segment(3);
		if(!$artiId){
			$data['title']="New agent Shop | Butikbd";
		}
		else{
			$data['title']="Update agent Shop | Butikbd";
		$this->form_validation->set_rules('urlname','Url Name','required|trim|regex_match[/^[A-Za-z0-9_]+$/]|is_unique[agent.urlname]');
		}
		$data['agentUpdate'] = $this->Index_model->getAllItemTable('agent','user_id',$artiId,'','','user_id','desc');
		$data['division_list']= $this->Index_model->getDataById('divisions','','','name','asc','');
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			
		$this->form_validation->set_rules('agent_name','agent Name','required|trim');
		if($this->form_validation->run() != false){
			$config['allowed_types'] = '*';
			$config['remove_spaces'] = true;
			$config['max_size'] = '1000000';
			$config['upload_path'] = './uploads/images/agent/';
			$config['charset'] = "UTF-8";
			$new_name = "agent_".time();
			$config['file_name'] = $new_name;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (isset($_FILES['companyLogo']['name']))
			{
			if($this->upload->do_upload('companyLogo')){
					$upload_data	= $this->upload->data();
					$save['photo']	= $upload_data['file_name'];
				}
				else{
					$upload_data	= $this->input->post('stillImg');
					$save['photo']	= $upload_data;	
				}
			}
			
			$save['username']	    = $this->input->post('agent_name');
			$save['division']	    = $this->input->post('telephone');
			$save['district']	    = $this->input->post('fax');
			$save['location']	    = $this->input->post('website');
			$save['mobile']	    = $this->input->post('mobile');
			$save['address']	    = $this->input->post('address');
			$save['email']	    = $this->input->post('email');
			$save['editorName']	    = $this->input->post('editor');
			$save['date']	    = date('Y-m-d');
			$save['password']	    = sha1($this->input->post('password'));
			$save['passwordHints']	    = $this->input->post('password');
			
			  if($this->input->post('agent_id')!=""){
				  $b_id=$this->input->post('agent_id');
				  $this->Index_model->update_table('agent','user_id',$b_id,$save);
				  $s='Updated';
			  }
			  else{
				  $query = $this->Index_model->inertTable('agent', $save);
				  $s='Inserted';
				  }
			  $this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
			  redirect('ouradminmanage/agent_list', 'refresh');
			}
			else{
				$data['main_content']="admin/agent/agent_action";
        		$this->load->view('admin_template', $data);
				}
		}
		else{
			$data['main_content']="admin/agent/agent_action";
			$this->load->view('admin_template', $data);
		}
	}
	
	
	/////////////////////// size ////////////////////////////////	 
	function size_list()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$data['title']="size List | Butikbd";
		$data['size_list'] = $this->Index_model->getTable('size','size_id','desc');
		$data['main_content']="admin/size/size_list";
        $this->load->view('admin_template',$data);
	} 
	 
	 
	function size_registration()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$artiId=$this->uri->segment(3);
		$data['sizeUpdate'] = $this->Index_model->getAllItemTable('size','size_id',$artiId,'','','size_id','desc');
		$data['category_list'] = $this->Index_model->getTable('category','cid','desc');
		$data['title']="size Update | Butikbd";
		$this->form_validation->set_rules('size_name', 'size name', 'trim|required');
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			if($this->form_validation->run() != false){
				
				$save['size']		= $this->input->post('size_name');
				$catname_explode = explode(" ", $save['size']);
				$slug=implode("-" ,$catname_explode);
				$save['size_title']	= $slug; 
				$save['status']	= $this->input->post('status');
				$save['cat_id']	= $this->input->post('category');
				$save['create_date']		= date('Y-m-d');
				
				if($this->input->post('size_id')!=""){
					$size_id=$this->input->post('size_id');
					$this->Index_model->update_table('size','size_id',$size_id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('size', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('ouradminmanage/size_list', 'refresh');
			}
			else{
				$data['main_content']="admin/product_category/size_action";
        		$this->load->view('admin_template', $data);
				}
		}
		$data['main_content']="admin/size/size_action";
        $this->load->view('admin_template', $data);
	}
	
	/////////////////////// Product Gallery ////////////////////////////////	 
	function product_list()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$data['title']="Product List | Butikbd.com";
		$data['product_list'] = $this->Index_model->getTable('product','product_id','desc');
		$data['main_content']="admin/product/product_list";
        $this->load->view('admin_template',$data);
	} 
	 
	 
	 
	function product_registration()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$artiId=$this->uri->segment(3);
		if(!$artiId){
			$data['title']="Product Insert | Butikbd.com";
		}
		else{
			$data['title']="Product Update | Butikbd.com";
		}
		$data['productUpdate'] = $this->Index_model->getAllItemTable('product','product_id',$artiId,'','','product_id','desc');
		$data['sponcer']		= $this->Index_model->getDataById('sponcer','','','sponcer_id','desc','');
		$data['boutiqueshop']		= $this->Index_model->getDataById('boutiqueshop','','','username','asc','');
		$data['allcategory']		= $this->Index_model->getDataById('category','','','cat_name','asc','');
		if($this->input->post('registration') && $this->input->post('registration')!=""){
		if($artiId!=""){
			$this->form_validation->set_rules('pro_code', 'Product Code', 'trim|required');
			$this->form_validation->set_rules('pro_name', 'Product Name', 'trim|required');
		}
		else{
			$this->form_validation->set_rules('pro_code', 'Product Code', 'trim|required|is_unique[product.pro_code]');
			$this->form_validation->set_rules('pro_name', 'Product Name', 'trim|required|is_unique[product.product_name]');
		}
		
		$this->form_validation->set_rules('cat_id', 'Category', 'trim|required');
		$this->form_validation->set_rules('pro_price', 'Price', 'trim|required');
		$this->form_validation->set_rules('quantity',  'Quantity', 'trim|required');
		if ($this->form_validation->run() != FALSE){
			ini_set( 'memory_limit', '200M' );
			ini_set('max_input_time', 3600);  
			ini_set('max_execution_time', 3600);

			$config['allowed_types'] = '*';
			$config['remove_spaces'] = true;
			$config['upload_path'] = './uploads/images/product/main_img/';
			$config['charset'] = "UTF-8";
			$new_name = "butikbd_".time();
			$config['file_name'] = $new_name;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			if (isset($_FILES['main_images']['name']))
			{
			if($this->upload->do_upload('main_images')){
					$upload_data	= $this->upload->data();
					$save['main_image']	= $upload_data['file_name'];
					$this->_CreatePageThumbnail($upload_data['file_name'], $config['upload_path'],150,200);			
					$save['thumb'] = $upload_data['raw_name']. '_thumb' .$upload_data['file_ext'];
				}
				else{
					$upload_data	= $this->input->post('mainImg');
					$save['thumb']=$this->input->post('thumbImg');
					$save['main_image']	= $upload_data;	
				}
			}	
			
			$config2['allowed_types'] = '*';
			$config2['remove_spaces'] = true;
			$config2['max_size'] = '1000000';
			$config2['upload_path'] = './uploads/images/product/photo1/';
			$config2['charset'] = "UTF-8";
			$new_name2 = "Butikbd_".time();
			$config2['file_name'] = $new_name2;
			$this->load->library('upload', $config2);
			$this->upload->initialize($config2);
			
			if (isset($_FILES['photo1']['name']))
			{
			if($this->upload->do_upload('photo1')){
					$upload_data	= $this->upload->data();
					$save['photo1']	= $upload_data['file_name'];
				}
				else{
					$upload_data	= $this->input->post('photo1');
					$save['photo1']	= $upload_data;	
				}
			}
			
			$config3['allowed_types'] = '*';
			$config3['remove_spaces'] = true;
			$config3['max_size'] = '1000000';
			$config3['upload_path'] = './uploads/images/product/photo2/';
			$config3['charset'] = "UTF-8";
			$new_name3 = "Butikbd_".time();
			$config3['file_name'] = $new_name3;
			$this->load->library('upload', $config3);
			$this->upload->initialize($config3);
			
			if (isset($_FILES['photo2']['name']))
			{
			if($this->upload->do_upload('photo2')){
					$upload_data	= $this->upload->data();
					$save['photo2']	= $upload_data['file_name'];
				}
				else{
					$upload_data	= $this->input->post('photo2');
					$save['photo2']	= $upload_data;	
				}
			}
			
			
			$config4['allowed_types'] = '*';
			$config3['remove_spaces'] = true;
			$config3['max_size'] = '1000000';
			$config3['upload_path'] = './uploads/images/product/photo3/';
			$config3['charset'] = "UTF-8";
			$new_name3 = "Butikbd_".time();
			$config3['file_name'] = $new_name3;
			$this->load->library('upload', $config3);
			$this->upload->initialize($config3);
			
			if (isset($_FILES['photo2']['name']))
			{
			if($this->upload->do_upload('photo2')){
					$upload_data	= $this->upload->data();
					$save['photo3']	= $upload_data['file_name'];
				}
				else{
					$upload_data	= $this->input->post('photo2');
					$save['photo3']	= $upload_data;	
				}
			}	
			
		    $pro_size = $this->input->post('pro_size');
			if($pro_size!=""){
				$proSize=join(',', $pro_size);
			}
			else{
				$proSize="";
			}
			$pro_color = $this->input->post('pro_color');
			if($pro_color!=""){
				$procolor=join(',', $pro_color);
			}
			else{
				$procolor="";
			}
				
		  if($this->input->post('sponcer')!=""){
			  $sponcerValue=implode(",", $this->input->post('sponcer'));
		  }
		  else{
			  $sponcerValue='';
		  }
					
			    $save['boutiqueshop']		= $this->input->post('boutiqueshop');
				$save['product_name']	    = addslashes($this->input->post('pro_name'));
				$proTitle = explode(' ',$this->input->post('pro_name'));
				$proUrl = implode("-",$proTitle);
				$save['slug']		= str_replace('/', '', strtolower($proUrl));
				$save['pro_code']		= $this->input->post('pro_code');
				$save['cat_id']	    = $this->input->post('cat_id');
				$save['scat_id']	    = $this->input->post('subcat_id');
				$save['lcat_id']	    = $this->input->post('lastcat_id');
				$save['hot_deals']	    = $this->input->post('hot_deals');
				$save['sponcer']	    = $sponcerValue;
				$save['size']	    = $proSize;
				$save['color']	    = $procolor;
				$save['details']	    = addslashes($this->input->post('full_description'));
				$save['price']	    = $this->input->post('pro_price');
				$save['market_price']	    = $this->input->post('market_price');
				$save['shipment']	    = $this->input->post('shipment');
				$save['qty']	    = $this->input->post('quantity');
				$save['home_delivery']	    = $this->input->post('home_delivery');
				$save['gift_wrap']	    = $this->input->post('gift_wrap');
				
				$save['seo_title']		= $this->input->post('seo_title');
				$save['keyword']	    = $this->input->post('keyword');
				$save['seo_details']	= $this->input->post('meta_details');
				$save['status']		=    $this->input->post('status');
				
				
				if($this->input->post('product_id')!=""){
					$b_id=$this->input->post('product_id');
					$query = $this->Index_model->update_table('product','product_id',$b_id,$save);
					$productInfo= $this->Index_model->getDataById('inventory','product_id',$b_id,'inventory_id','desc','');
						$data_array=array(
								'product_id'=>$b_id,
								'product_code'=>$this->input->post('pro_code'),
								'quantity'=>$this->input->post('quantity')
							);
						if($productInfo->num_rows() > 0){
							foreach($productInfo->result() as $val);
							$this->Index_model->update_table('inventory','product_id',$b_id,$data_array);
						}
						else{
							$this->Index_model->inertTable('inventory', $data_array);	
						}
					$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully Updated</h2>');
					redirect('ouradminmanage/product_list', 'refresh');
				}
				else{
					$query = $this->Index_model->inertTable('product', $save);
					$data_array=array(
						'product_id'=>$query,
						'product_code'=>$this->input->post('pro_code'),
						'quantity'=>$this->input->post('quantity')
					);
					$this->Index_model->inertTable('inventory', $data_array);
					$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Failed to Inserted</h2>');
					redirect('ouradminmanage/product_list', 'refresh');
				}
				
			}
			else{
				$data['main_content']="admin/product/product_action";
        		$this->load->view('admin_template', $data);
				}
		}
		else{
			$data['main_content']="admin/product/product_action";
			$this->load->view('admin_template', $data);
		}
	}
	
	
	function ajaxMenu()
	{
		if($this->input->get('menu_id')!=""){
			$rid=$this->input->get('menu_id');
			$sroot_menu = $this->Index_model->getAllItemTable('menu','boutiqueshop',$rid,'','','menu_name','asc');
			$svar='<select name="root_id" id="root_id" class="form-control">
								<option value="">Menu</option>';
								 foreach($sroot_menu->result() as $rootmenu):
									$svar .= '<option value="'.$rootmenu->slug.'">'.$rootmenu->menu_name.'</option>';
								endforeach;
							$svar .= '</select>';
			echo $svar;
		}
	}
	
	
	function ajaxCategory()
	{
		if($this->input->get('cat_id')!=""){
			$rid=$this->input->get('cat_id');
			$url="'".base_url()."ouradminmanage/ajaxCategory?subcat_id='+this.value+''";
			$sroot_menu = $this->Index_model->getAllItemTable('sub_category','cat_id',$rid,'','','sub_cat_name','asc');
			$svar='<select name="subcat_id" id="subcat_id" class="form-control" onChange="getSubCategory('.$url.')">
								<option value="">Sub Category</option>';
								 foreach($sroot_menu->result() as $rootmenu):
									$svar .= '<option value="'.$rootmenu->sub_cat_title.'">'.$rootmenu->sub_cat_name.'</option>';
								endforeach;
							$svar .= '</select>';
			echo $svar;
		}
		elseif($this->input->get('subcat_id')!=""){
			$rid=$this->input->get('subcat_id');
			$sroot_menu = $this->Index_model->getAllItemTable('last_category','subcat_id',$rid,'','','lastcat_name','asc');
			$svar='<select name="lastcat_id" id="lastcat_id" class="form-control">
								<option value="">Last Category</option>';
								 foreach($sroot_menu->result() as $rootmenu):
									$svar .= '<option value="'.$rootmenu->last_cat_title.'">'.$rootmenu->lastcat_name.'</option>';
								endforeach;
							$svar .= '</select>';
			echo $svar;
		}
	}
	
	function ajaxCategorySize()
	{
		//if($this->input->get('cat_id')!="" && $this->input->get('size')=="size"){
			$cat_id=$this->input->get('cat_id');
			$catSize = $this->Index_model->getAllItemTable('size','cat_id',$cat_id,'','','size','asc');
			$svar='<select name="pro_size[]" id="size_id" class="form-control"  multiple="multiple" style="min-height:150px">
					  <option value="">Product Size</option>';
					   foreach($catSize->result() as $sizeval):
						  $svar .= '<option value="'.$sizeval->size.'">'.$sizeval->size.'</option>';
					  endforeach;
				$svar .= '</select>';
			echo $svar;
		//}
	}
	
	/////////////////////// photogallery ////////////////////////////////	 
	function photogallery_list()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$data['title']="photogallery List | Butikbd";
		$data['photogallery_list'] = $this->Index_model->getTable('photogallery','b_id','desc');
		$data['main_content']="admin/photogallery/photogallery_list";
        $this->load->view('admin_template',$data);
	} 
	 
	 
	 
	function photogallery_registration()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$artiId=$this->uri->segment(3);
		if(!$artiId){
			$data['title']="photogallery Registration | Butikbd";
		}
		else{
			$data['title']="photogallery Update | Butikbd";
		}
		$data['photogalleryUpdate'] = $this->Index_model->getAllItemTable('photogallery','b_id',$artiId,'','','b_id','desc');
		$data['gallery_menu'] = $this->Index_model->getAllItemTable('menu','page_structure','gallery','','','menu_name','asc');
		
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			$this->form_validation->set_rules('photogallery_name', 'photogallery name', 'trim|required');
			$this->form_validation->set_rules('category', 'Gallery Menu', 'trim|required');
			
			if($this->form_validation->run() != false){
				
			$config['allowed_types'] = '*';
			$config['remove_spaces'] = true;
			$config['max_size'] = '1000000';
			$config['upload_path'] = './uploads/images/photogallery/';
			$config['charset'] = "UTF-8";
			$new_name = "photogallery_".time();
			$config['file_name'] = $new_name;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
				if (isset($_FILES['photogalleryPhoto']['name']))
				{
					if($this->upload->do_upload('photogalleryPhoto')){
						$upload_data	= $this->upload->data();
						$save['image']	= $upload_data['file_name'];
					}
					else{
						$upload_data	= "";
						$save['image']	= $upload_data;	
					}
				}	
				
				$save['photogallery_name']	    = $this->input->post('photogallery_name');
				$save['category']	    = $this->input->post('category');
				$save['date']	    = date('Y-m-d');
				
				if($this->input->post('b_id')!=""){
					$b_id=$this->input->post('b_id');
					$this->Index_model->update_table('photogallery','b_id',$b_id,$save);
					$s='Updated';
				}
				else{
					$query = $this->Index_model->inertTable('photogallery', $save);
					$s='Inserted';
					}
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('ouradminmanage/photogallery_list', 'refresh');
			}
			else{
				$data['main_content']="admin/photogallery/photogallery_action";
        		$this->load->view('admin_template', $data);
				}
		}
		$data['main_content']="admin/photogallery/photogallery_action";
        $this->load->view('admin_template', $data);
	}
	
	
	
	function sequenceManage()
	{
		$tbl=$this->input->get('tbl');
		$tid=$this->input->get('tid');
		$seqence=$this->input->get('sequence');
		$id=$this->input->get('id');
		
		$query = $this->db->query("select * from ".$tbl." where sequence='".$seqence."'");
			foreach($query->result() as $row);
			$sequenceVal=$row->sequence;
			$nid=$row->$tid;
			
			if($seqence!=$sequenceVal){
				$update=$this->db->query("update ".$tbl." set sequence='".$seqence."' where ".$tid."='".$id."'");
			}
			else{
				$query1 = "select * from ".$tbl." where ".$tid."='".$id."'";
				$results1 = $this->db->query($query1);
				foreach($results1->result() as $row1);
				$sequenceVal1=$row1->sequence;
				$nid1=$row1->$tid;
			
				$update=$this->db->query("update ".$tbl." set sequence='".$sequenceVal1."' where ".$tid."='".$nid."'");
				$update1=$this->db->query("update ".$tbl." set sequence='".$seqence."' where ".$tid."='".$id."'");
			}
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	

///////////  All  Reports///////////////////////

function order_list()
	 {
		 if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$data['title']="Butikbd.com | Customer Order List";
		$data['main_content']="admin/order/order_list";
	    $this->load->view('admin_template', $data);
	}
/*	
	function customers()
	 {
			$data['error'] = $this->session->flashdata('error');
			$data['main_content']="sales/customers";
			$this->load->view('deshboard_templete', $data);
	}
	function reports($reportType)
	 {
	 if(!$reportType) redirect(base_url('error'));
	 
		if($reportType=='hardproduct'){
			$data['main_content']="sales/report/hardproduct";
		}
		elseif($reportType=='eproduct'){
			$data['main_content']="sales/report/eproduct";
		}
		$this->load->view('deshboard_templete', $data);
	}	
	
	function coupon()
	 {

			$data['error'] = $this->session->flashdata('error');
			$data['main_content']="coupon/coupon_list";
			$this->load->view('deshboard_templete', $data);
	}*/
	
	function view_order($order_id)
	 {
		 if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
			$data['order_q']= $this->Index_model->getDataById('orders','order_id',$order_id,'order_id','desc','1');
			foreach($data['order_q']->result() as $rowq);
 			$customer_id=$rowq->customer_id;
			$data['customerQ']= $this->Index_model->getDataById('customer','user_id',$customer_id,'user_id','desc','1');
			$data['shipping']= $this->Index_model->getDataById('shipping_address','customer_id',$customer_id,'shipping_id','desc','1');
			$data['payment']= $this->Index_model->getDataById('payment_info','customer_id',$customer_id,'pay_id','desc','1');
			
			$data['order_id']=$order_id;
			$data['title']="Butikbd.com | Customer Order Details";
			$data['main_content']="admin/order/view_order";
			$this->load->view('admin_template', $data);
	}
	
	function new_invoice($order_id){
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		if($this->input->post('invoiceCreate')!=""){
			$insertTranstion=array(
					'cust_id'=>$this->input->post('cust_id'),
					'ship_id'=>$this->input->post('ship_id'),
					'pay_id'=>$this->input->post('payId'),
					'order_num'=>$this->input->post('orderNumber'),
					'order_id'=>$this->input->post('order_id'),
					'create_date'=>date('Y-m-d h:i:s'),
					'date'=>date('Y-m-d')
					);
			$query = $this->Index_model->inertTable('invoice', $insertTranstion);
			redirect('ouradminmanage/invoice/'.$query);
		}
		else{
			 $this->session->set_flashdata('failedMsg', '<div class="alert alert-danger text-center">Failed To insert</div>');
			 redirect('ouradminmanage/view_order/'.$order_id, 'refresh');	
		}
			
	}
	
	function invoice($inpoiceId)
	 {
		 if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		 	if(!$inpoiceId) redirect('error');
		 	$data['invoiceData']= $this->Index_model->getDataById('invoice','inv_id',$inpoiceId,'inv_id','desc','1');
			foreach($data['invoiceData']->result() as $invoiceData);
			$order_id = $invoiceData->order_id;
		 	$data['order_id']=$order_id;
			$data['inv_id']=$inpoiceId;
			$data['title']="Butikbd.com | Customer Order Details";
			$data['order_q']= $this->Index_model->getDataById('orders','order_id',$order_id,'order_id','desc','1');
			foreach($data['order_q']->result() as $rowq);
 			$customer_id=$rowq->customer_id;
			$data['customerQ']= $this->Index_model->getDataById('customer','user_id',$customer_id,'user_id','desc','1');
			$data['shipping']= $this->Index_model->getDataById('shipping_address','customer_id',$customer_id,'shipping_id','desc','1');
			$data['payment']= $this->Index_model->getDataById('payment_info','customer_id',$customer_id,'pay_id','desc','1');
			
			if($this->input->get('status') && $this->input->get('status')!=""){
				$this->load->view('admin/order/invoice_print', $data);
			}
			else{
				$data['main_content']="admin/order/invoice";
				$this->load->view('admin_template', $data);
			}
	}
	
	
	function inventory()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$data['title']="Butikbd.com | Inventory Management";
		$field_name= $this->input->post('field_name');
		$data['productlist']		= $this->Index_model->get_product($field_name);
		$data['main_content']="admin/order/inventory";
        $this->load->view('admin_template', $data);
		
    }
	function inventory_history($pid)
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$data['title']="Butikbd.com | Inventory History";
		$data['pid']= $pid;
		$data['main_content']="admin/order/inventory_history";
        $this->load->view('admin_template', $data);
    }
	function update_inventory()
	{	
	if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$update['product_id']=$this->input->post('product_id');
		
			$query = $this->db->query("select * from inventory where product_id ='".$update['product_id']."'");
			if($query->num_rows() > 0){
				foreach($query->result() as $row);
				$qty = $row->quantity; 
			}
			else{
				$qty=0;	
			}	
		$add = $this->input->post('add');
		$minus = $this->input->post('minus');
		$return = $this->input->post('return');
		
			if(isset($add) && $add=='Add'){
				$update['increase']=$this->input->post('pluse_qty');
				$update['increase_note']=$this->input->post('pluse_note');
				$update['quantity']=$qty + $this->input->post('pluse_qty');
				$update['increase_date']=date('Y-m-d');
			}
			elseif(isset($minus) && $minus=='Minus'){
				$update['decrease']=$this->input->post('minus_qty');
				$update['decrease_note']=$this->input->post('minus_note');
				$update['quantity']=$qty - $this->input->post('minus_qty');
				$update['decrease_date']=date('Y-m-d');
			}
			elseif(isset($return) && $return=='Return'){
				$update['return_qty']=$this->input->post('return_qty');
				$update['return_notes']=$this->input->post('return_notes');
				$update['quantity']=$qty + $this->input->post('return_qty');
				$update['return_date']=date('Y-m-d');
			}
		$this->Index_model->update_inventory($update); 
		redirect('ouradminmanage/inventory', '');
	}
	
	function update_status()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$status=$this->input->get('status');
		$view_order=$this->input->get('view_order');
		$table=$this->input->get('table');
		$id=$this->input->get('id');
		$this->Index_model->update_status($table,$status,$id); 
		redirect($_SERVER['HTTP_REFERER'],'refresh');
		/*if(isset($view_order)){  
			?>
           eh <script>
            window.history.back();
            </script>
           <?php
		}
		else{
			redirect('dashboard/orders', '');
		}*/
	}
	
	
	
	function approve()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$approve_val[]=$this->input->get('approve_val');
		$tablename=$this->input->get('tablename');
		$id=$this->input->get('id');
		$status=$this->input->get('status');
		$this->Index_model->get_approve($approve_val,$tablename,$id,$status);   
		redirect($_SERVER['HTTP_REFERER'],'refresh');
	}
	
	function deapprove()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$approve_val[]=$this->input->get('approve_val');
		$tablename=$this->input->get('tablename');
		$id=$this->input->get('id');
		$status=$this->input->get('status');
		$this->Index_model->get_deapprove($approve_val,$tablename,$id,$status);   
		redirect($_SERVER['HTTP_REFERER'],'refresh');
	}
	
	function deapprovedCategory()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$deapprove_val[]=$this->input->get('deapprove_val');
		$this->Index_model->get_category_deapprove($deapprove_val,'boutiqueshop');   
		redirect($_SERVER['HTTP_REFERER'],'refresh');
	}
	
		
	function approvedBoutique()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$approve_val[]=$this->input->get('approve_val');
		$this->Index_model->get_category_approve($approve_val,'boutiqueshop');   
		redirect($_SERVER['HTTP_REFERER'],'refresh');
	}
	
	
	function deapprovedBoutique()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$deapprove_val[]=$this->input->get('deapprove_val');
		$this->Index_model->get_category_deapprove($deapprove_val,'boutiqueshop');   
		redirect($_SERVER['HTTP_REFERER'],'refresh');
	}
	
	function approved()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$approve_val[]=$this->input->get('approve_val');
		$this->Index_model->get_category_approve($approve_val,'customer');   
		redirect($_SERVER['HTTP_REFERER'],'refresh');
	}
	
	
	function deapproved()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$deapprove_val[]=$this->input->get('deapprove_val');
		$this->Index_model->get_category_deapprove($deapprove_val,'customer');   
		redirect($_SERVER['HTTP_REFERER'],'refresh');
	}
	
	
	
	
	
	///////////  Membership Information ///////////////////////

	function membership()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$url=$this->uri->segment(3);
		$memId=$this->uri->segment(4);
		
		$data['title'] = 'Membership';
		$data['boutiqueshop'] = $this->Membership_model->getTable('boutiqueshop','	username','asc');
		$data['memberUpdate'] = $this->Membership_model->getOneItemTable('membership','id',$memId,'id','desc');
		
		
		$config['base_url'] = base_url('ouradminmanage/membership');
        $config["per_page"] = 20;
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$total_row = $this->Membership_model->record_count('membership');
        $config["total_rows"] = $total_row;
        $config['num_links'] = $total_row;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
		$config["uri_segment"] = 3;
        $this->pagination->initialize($config);
		$data['pagination']= $this->pagination->create_links();
		$data['pageSl'] = $page;
		
		$keyword = $this->input->post_get('keyword');
		if($this->input->post_get('toDate')!=""){
			$fromDate = $this->input->post_get('fromDate');
			$toDate = $this->input->post_get('toDate');
			$conFromDate=date("Y-m-d", strtotime($fromDate));
			$conToDate=date("Y-m-d", strtotime($toDate));
		}
		else{
			$conFromDate="";
			$conToDate="";
			}
		$data['memberList'] = $this->Membership_model->getAllSearchItem('membership',$keyword,$conFromDate,$conToDate,'id','desc',
		$config["per_page"],$page);
		
			if(isset($url) && $url=='newmember'){
				$data['main_content']="admin/membership/create_member";
			}
			elseif(isset($url) && $url=='editmember'){
				$data['main_content']="admin/membership/update_member";
			}
			else{				
			$data['main_content']="admin/membership/member_list";
			}
		$this->load->view('admin_template', $data);
	}
	
	
	
	
	function membership_action()
	{
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$data['title'] = 'Membership';
		$data['boutiqueshop'] = $this->Membership_model->getTable('boutiqueshop','	username','asc');
		$mid = $this->input->post('mid');
		
				$this->form_validation->set_rules('memberName', 'Member Name', 'trim|required');
				if($mid!=''){
					$this->form_validation->set_rules('member_id', 'member Id', 'trim|required');
				}
				else{
					$this->form_validation->set_rules('member_id', 'member Id', 'trim|required|is_unique[membership.member_id]');
				}
				$this->form_validation->set_rules('member_type', 'Member Type', 'trim|required');
				$this->form_validation->set_rules('memberFee', 'Member Fee', 'trim|required');
				if($this->form_validation->run() != false){
					$memberdata=array(
						'member_id'=>$this->input->post('member_id'),
						'memberName'=>$this->input->post('memberName'),
						'member_type'=>$this->input->post('member_type'),
						'from_date'=>$this->input->post('joinDate'),
						'to_date'=>$this->input->post('expDate'),
						'price'=>$this->input->post('memberFee'),
						'trial_duration'=>$this->input->post('membertrialtime'),
						'gallery'=>$this->input->post('pictureGallery'),
						'bannerslider'=>$this->input->post('publication'),
						'product_quota'=>$this->input->post('product_quota'),
						'templates'=>$this->input->post('templates'),
						'receiveBy'=>$this->input->post('recBy'),
						'payBy'=>$this->input->post('payBy'),
						);
						
						
						if(isset($mid) && $mid!=''){
							$query = $this->Membership_model->updateTable('membership','id',$mid, $memberdata);
						}
						else{
							$query = $this->Membership_model->inertTable('membership', $memberdata);	
						}	
					
					if($query){
						$this->session->set_flashdata('successMsg', '<p class="alert alert-success">Successfully Member Created</p>');
						redirect('Ouradminmanage/membership');
					}
				}
				else{
					if(isset($mid) && $mid!=''){
							$data['memberUpdate'] = $this->Membership_model->getOneItemTable('membership','id',$memId,'id','desc');
							$data['main_content']="admin/membership/update_member";
							$this->load->view('admin_template', $data);
						}
						else{
							$data['main_content']="admin/membership/create_member";
							$this->load->view('admin_template', $data);
						}	
				}
	}
	
	
	
	public function email_check()
    {
        if($this->input->is_ajax_request()){
			$username = $this->input->get('email');
			if(!$this->form_validation->is_unique($username, 'membership.email')) {
				$this->output->set_content_type('application/json')->set_output(json_encode(
				array('message' => 'This Email address is already Exist, Please Choose another one', 'color'=>'red')));
			}
			else{
				$this->output->set_content_type('application/json')->set_output(json_encode(
				array('message' => 'This Email address is Aavailable', 'color'=>'green')));
				}
		}
	}
	



	public function memberTrash($mid){
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$this->Membership_model->deletetable_row('membership', 'id', $mid);
		redirect('membership');
	}
	
	
	
	
	public function membershipRenew(){
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$url=$this->uri->segment(3);
		$memId=$this->uri->segment(4);
		$data['title'] = 'Membership';
		$data['boutiqueshop'] = $this->Membership_model->getTable('boutiqueshop','	username','asc');
		$config['base_url'] = base_url('ouradminmanage/membershipRenew/');
        $config["per_page"] = 30;
		$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		$total_row = $this->Index_model->record_count('payment_history');
        $config["total_rows"] = $total_row;
        $config['num_links'] = $total_row;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
		$config["uri_segment"] = 3;
        $this->pagination->initialize($config);
		$data['pagination']= $this->pagination->create_links();
		$data['pageSl'] = $page;
		
		$keyword = $this->input->post_get('keyword');
		if($this->input->post_get('toDate')!=""){
			$fromDate = $this->input->post_get('fromDate');
			$toDate = $this->input->post_get('toDate');
			$conFromDate=date("Y-m-d", strtotime($fromDate));
			$conToDate=date("Y-m-d", strtotime($toDate));
		}
		else{
			$conFromDate="";
			$conToDate="";
			}
		$data['memberList'] = $this->Index_model->getAllSearchItem('member_renew',$keyword,$conFromDate,$conToDate,'id','desc');
		$data['memberUpdate'] = $this->Index_model->getOneItemTable('member_renew','id',$memId,'id','desc');
		
		if(isset($url) && $url!=''){
			if($this->input->post('save')){
				$this->form_validation->set_rules('memberName', 'Member Name', 'trim|required');
				$this->form_validation->set_rules('doctorId', 'Doctors Id', 'trim|required');	
				$this->form_validation->set_rules('member_type', 'Member Type', 'trim|required');
				$this->form_validation->set_rules('memberFee', 'Member Fee', 'trim|required');
				if($this->form_validation->run() != false){
					$memberdata=array(
						'doc_id'=>$this->input->post('doctorId'),
						'memberName'=>$this->input->post('memberName'),
						'member_type'=>$this->input->post('member_type'),
						'from_date'=>$this->input->post('joinDate'),
						'to_date'=>$this->input->post('expDate'),
						'price'=>$this->input->post('memberFee'),
						'pmathod'=>$this->input->post('pmathod'),
						'transitionId'=>$this->input->post('transitionId'),
						'receiveBy'=>$this->input->post('receiveBy')
						);
					if(isset($url) && $url=='new'){
						$query = $this->Index_model->inertTable('member_renew', $memberdata);
					}
					elseif(isset($url) && $url=='edit'){
						$mid=$this->input->post('member_id');
						$query = $this->Index_model->updateTable('member_renew','id',$mid, $memberdata);	
					}	
					
					
					if($query){
						$this->session->set_flashdata('successMsg', '<p class="alert alert-success">Successfully Member Created</p>');
						redirect('ouradminmanage/membershipRenew');
					}
				}
			}
			if(isset($url) && $url=='new'){
				$data['main_content']="admin/membership/renew/create_member";
			}
			elseif(isset($url) && $url=='edit'){
				$data['main_content']="admin/membership/renew/update_member";
			}
			elseif(isset($url) && $url=='memberPrint'){
				$data['title']= 'Membership renew Print';
				$data['main_content']="admin/membership/renew/memberPrint";
			}
			else{
			$data['main_content']="admin/membership/renew/member_list";
		    }
		}
		else{
			$data['main_content']="admin/membership/renew/member_list";
		}
		$this->load->view('admin_template', $data);
	}
	
	
	public function memberRenewTrash($mid){
		if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$this->Index_model->deletetable_row('member_renew', 'id', $mid);
		redirect('ouradminmanage/membershipRenew');
	}
	
	
	
	function _CreatePageThumbnail($filename, $dir,$w,$h) {
        $config['image_library']    = "gd2";      
        $config['source_image']     = $dir.$filename; 
		$config['new_image']		= $dir.'thumnail';
        $config['create_thumb']     = TRUE;      
        $config['maintain_ratio']   = TRUE;      
        $config['width'] = $w;      
        $config['height'] = $h;
        $this->load->library('image_lib',$config);
        if(!$this->image_lib->resize()):
            echo $this->image_lib->display_errors();
       	endif;   
    }
		
///////////  All  Delete///////////////////////
public function deleteData($tableName,$colId){
	if(!$this->session->userdata('AdminAccessMail')) redirect("ouradminmanage");
		$cID = $this->input->get('deleteId');
		$this->Index_model->deletetable_row($tableName, $colId, $cID);
	}

}

?>
