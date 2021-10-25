<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Butikbdadmin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Index_model');
		date_default_timezone_set('Asia/Dhaka');
     	$this->load->library('email');
		$this->load->library('cart');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('url');
	}
	
	function index()
	{
		
		if($this->session->userdata('boutuqueAccessMail')) redirect("butikbdadmin/dashboard");
		$data['title']="Admin Panel Butikbd.com | Bangladesh Largest Online Butik Market";
        $this->load->view('boutique_admin/index',$data);
	}


public function userLogin()
     {
          $username = $this->input->post("username");
  		  $password = $this->input->post("password");
          $this->form_validation->set_rules("username", "Email", "trim|required|min_length[6]|valid_email");
          $this->form_validation->set_rules("password", "Password", "trim|required");

          if ($this->form_validation->run() == FALSE)
          {
              redirect('butikbdadmin');
          }
          else
          {
                    $usr_result = $this->Index_model->get_memberLogin($username, $password);
                    if ($usr_result > 0)
                    {
					  $sessiondata = array(
						'boutuqueAccessMail'=>$username,
						'boutuqueAccessName'=> $usr_result['username'],
						'boutuqueUrlName'=> $usr_result['urlname'],
						'boutuqueLogo'=> $usr_result['photo'],
						'boutuqueAccessId' => $usr_result['user_id'],
						'password' => TRUE
					   );
						$this->session->set_userdata($sessiondata);
						redirect("butikbdadmin/dashboard/");
                    }
                    else
                    {
                     $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center" style="padding:7px; margin-bottom:5px">Invalid Email and password!</div>');
                     redirect('butikbdadmin');
                    }
          }
     }
	 
    function logout()
  	{
	  $sessiondata = array(
				'boutuqueAccessMail'=>'',
				'boutuqueAccessName'=> '',
				'boutuqueLogo'=> '',
				'boutuqueUrlName'=> '',
				'boutuqueAccessId' => '',
				'password' => FALSE
		 );
	$this->session->unset_userdata($sessiondata);
	$this->session->sess_destroy();
    redirect('butikbdadmin', 'refresh');
  }
	
	function dashboard()
	{
		if(!$this->session->userdata('boutuqueAccessMail')) redirect("butikbdadmin");
		$data['title']=$this->session->userdata('boutuqueAccessName')." Admin Panel Butikbd.com | Bangladesh Paint Manufacturer’s Association";
		$data['main_content']="boutique_admin/dashboard";
        $this->load->view('boutique_admin_template',$data);
	}
	
	function menu_list()
	{
		if(!$this->session->userdata('boutuqueAccessMail')) redirect("butikbdadmin");
		$data['title']="Menu List | Butikbd";
		$boutiqueId= $this->session->userdata('boutuqueAccessId');
		$data['menu_list'] = $this->Index_model->getAllItemTable('menu','boutiqueshop',$boutiqueId,'','','m_id','desc');
		$data['main_content']="boutique_admin/menu/menu_list";
        $this->load->view('boutique_admin_template',$data);
	} 
	function menu_registration()
	{
		
		$artiId=$this->uri->segment(3);
		$boutiqueId= $this->session->userdata('boutuqueAccessId');
		$data['menuUpdate'] = $this->Index_model->getAllItemTable('menu','m_id',$artiId,'','','m_id','desc');
		$data['root_menu'] = $this->Index_model->getAllItemTable('menu','root_id',0,'','','menu_name','asc');
		if(!$artiId){
			$data['title']="menu Registration | Butikbd";
			$this->form_validation->set_rules('menu_name', 'menu name', 'trim|required|is_unique[menu.menu_name]');
		}
		else{
			$data['title']="menu Update | Butikbd";
			$this->form_validation->set_rules('menu_name', 'menu name', 'trim|required');
		}
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			if($this->form_validation->run() != false){
			$expval=explode(' ',$this->input->post('menu_name'));
			$impval=implode('-',$expval);
				$save['boutiqueshop']	    = $boutiqueId;
				$save['menu_name']	    = addslashes($this->input->post('menu_name'));
				$save['slug']	    = addslashes(strtolower($impval));
				$save['root_id']	    = $this->input->post('root_id');
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
				redirect('butikbdadmin/menu_list', 'refresh');
			}
			else{
				$data['main_content']="boutique_admin/menu/menu_action";
        		$this->load->view('boutique_admin_template', $data);
				}
		}
		$data['main_content']="boutique_admin/menu/menu_action";
        $this->load->view('boutique_admin_template', $data);
	}
	
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

	function category_list()
	{
		if(!$this->session->userdata('boutuqueAccessMail')) redirect("butikbdadmin");
		$boutiqueId= $this->session->userdata('boutuqueAccessId');
		$data['title']="Category List | Butikbd";
		$data['category_list'] = $this->Index_model->getAllItemTable('category','boutiqueshop',$boutiqueId,'','','cid','desc');
		$data['main_content']="boutique_admin/product_category/category_list";
        $this->load->view('boutique_admin_template',$data);
	} 
	 
	 
	function category_registration()
	{
		$artiId=$this->uri->segment(3);
		$boutiqueId= $this->session->userdata('boutuqueAccessId');
		$data['categoryUpdate'] = $this->Index_model->getAllItemTable('category','cid',$artiId,'','','cid','desc');
		if(!$artiId){
			$data['title']="category Registration | Butikbd";
			$this->form_validation->set_rules('category_name', 'category name', 'trim|required|is_unique[category.cat_name]');
		}
		else{
			$data['title']="Category Update | Butikbd";
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
				$save['boutiqueshop']	    = $boutiqueId;
				$save['cat_name']	    = addslashes($this->input->post('category_name'));
				$save['caegory_title']	    = addslashes(strtolower($impval));
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
				redirect('butikbdadmin/category_list', 'refresh');
			}
			else{
				$data['main_content']="boutique_admin/product_category/category_action";
        		$this->load->view('boutique_boutique_admin_template', $data);
				}
		}
		$data['main_content']="boutique_admin/product_category/category_action";
        $this->load->view('boutique_boutique_admin_template', $data);
	}
	function sub_category_list()
	{
		if(!$this->session->userdata('boutuqueAccessMail')) redirect("boutique_butikbdadmin");
		$boutiqueId= $this->session->userdata('boutuqueAccessId');
		$data['title']="sub_category List | Butikbd";
		$data['sub_category_list'] = $this->Index_model->getAllItemTable('sub_category','boutiqueshop',$boutiqueId,'','','scid','desc');
		$data['main_content']="boutique_admin/product_category/sub_category_list";
        $this->load->view('boutique_admin_template',$data);
	} 
	function sub_category_registration()
	{
		$artiId=$this->uri->segment(3);
		$boutiqueId= $this->session->userdata('boutuqueAccessId');
		$data['sub_categoryUpdate'] = $this->Index_model->getAllItemTable('sub_category','scid',$artiId,'','','scid','desc');
		$data['category_list'] = $this->Index_model->getTable('category','cid','desc');
		if(!$artiId){
			$data['title']="sub_category Registration | Butikbd";
			$this->form_validation->set_rules('sub_category_name', 'sub_category name', 'trim|required|is_unique[sub_category.sub_cat_name]');
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
				$config['upload_path'] = './asset/uploads/product_category/sub_category/';
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
				$save['boutiqueshop']	    = $boutiqueId;
				$save['cat_id']	    = $this->input->post('category');
				$save['sub_cat_name']	    = addslashes($this->input->post('sub_category_name'));
				$save['sub_cat_title']	    = addslashes(strtolower($impval));
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
				redirect('butikbdadmin/sub_category_list', 'refresh');
			}
			else{
				$data['main_content']="boutique_admin/product_category/sub_category_action";
        		$this->load->view('boutique_admin_template', $data);
				}
		}
		$data['main_content']="boutique_admin/product_category/sub_category_action";
        $this->load->view('boutique_admin_template', $data);
	}

	function last_category_list()
	{
		if(!$this->session->userdata('boutuqueAccessMail')) redirect("butikbdadmin");
		$boutiqueId= $this->session->userdata('boutuqueAccessId');
		$data['title']="last_category List | Butikbd";
		$data['last_category_list'] = $this->Index_model->getAllItemTable('last_category','boutiqueshop',$boutiqueId,'','','id','desc');
		$data['main_content']="boutique_admin/product_category/last_category_list";
        $this->load->view('boutique_admin_template',$data);
	} 
	 
	function last_category_registration()
	{
		$artiId=$this->uri->segment(3);
		$boutiqueId= $this->session->userdata('boutuqueAccessId');
		$data['last_categoryUpdate'] = $this->Index_model->getAllItemTable('last_category','id',$artiId,'','','id','desc');
		$data['allcategory']		= $this->Index_model->getDataById('category','','','cat_name','asc','');
		if(!$artiId){
			$data['title']="last_category Registration | Butikbd";
			$this->form_validation->set_rules('last_category_name', 'last_category name', 'trim|required|is_unique[last_category.lastcat_name]');
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
				$config['upload_path'] = './asset/uploads/product_category/last_category/';
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
				$save['boutiqueshop']	    = $boutiqueId;
				$save['cat_id']	    = $this->input->post('cat_id');
				$save['subcat_id']	    = $this->input->post('subcat_id');
				$expval=explode(' ',$this->input->post('last_category_name'));
				$impval=implode('-',$expval);
				$save['lastcat_name']	    = addslashes($this->input->post('last_category_name'));
				$save['last_cat_title']	    = addslashes(strtolower($impval));
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
				redirect('butikbdadmin/last_category_list', 'refresh');
			}
			else{
				$data['main_content']="boutique_admin/product_category/last_category_action";
        		$this->load->view('boutique_admin_template', $data);
				}
		}
		$data['main_content']="boutique_admin/product_category/last_category_action";
        $this->load->view('boutique_admin_template', $data);
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

	function article_list()
	{
		if(!$this->session->userdata('boutuqueAccessMail')) redirect("butikbdadmin");
		$boutiqueId= $this->session->userdata('boutuqueAccessId');
		$data['title']="Article List | Butikbd";
		$data['article_list'] = $this->Index_model->getAllItemTable('article_manage','boutiqueshop',$boutiqueId,'','','a_id','desc');
		$data['main_content']="boutique_admin/article/article_list";
        $this->load->view('boutique_admin_template',$data);
	} 
	 
	 
	 
	function article_registration()
	{
		$data['root_menu'] = $this->Index_model->getAllItemTable('menu','','','','','menu_name','asc');
		$artiId=$this->uri->segment(3);
		$boutiqueId= $this->session->userdata('boutuqueAccessId');
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
				$save['boutiqueshop']	    = $boutiqueId;
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
				redirect('butikbdadmin/article_list', 'refresh');
			}
			else{
				$data['main_content']="boutique_admin/article/article_action";
        		$this->load->view('boutique_admin_template', $data);
				}
		}
		$data['main_content']="boutique_admin/article/article_action";
        $this->load->view('boutique_admin_template', $data);
	}
	
	function banner_list()
	{
		if(!$this->session->userdata('boutuqueAccessMail')) redirect("butikbdadmin");
		$boutiqueId= $this->session->userdata('boutuqueAccessId');
		$data['title']="banner List | Butikbd";
		$data['banner_list'] = $this->Index_model->getAllItemTable('banner','boutiqueshop',$boutiqueId,'','','b_id','desc');
		$data['main_content']="boutique_admin/banner/banner_list";
        $this->load->view('boutique_admin_template',$data);
	} 
	 
	 
	 
	function banner_registration()
	{
		
		$artiId=$this->uri->segment(3);
		$boutiqueId= $this->session->userdata('boutuqueAccessId');
		if(!$artiId){
			$data['title']="Banner Registration | Butikbd";
		}
		else{
			$data['title']="Banner Update | Butikbd";
		}
		$data['bannerUpdate'] = $this->Index_model->getAllItemTable('banner','b_id',$artiId,'','','b_id','desc');
		if($this->input->post('registration') && $this->input->post('registration')!=""){
			$this->form_validation->set_rules('banner_name', 'banner name', 'trim|required');
			
			if($this->form_validation->run() != false){
				
			$config['allowed_types'] = '*';
			$config['remove_spaces'] = true;
			$config['max_size'] = '1000000';
			$config['upload_path'] = './asset/uploads/banner/';
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
						$upload_data	= "";
						$save['image']	= $upload_data;	
					}
				}	
				
				$save['banner_name']	    = $this->input->post('banner_name');
				$save['boutiqueshop']	    = $boutiqueId;
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
				redirect('butikbdadmin/banner_list', 'refresh');
			}
			else{
				$data['main_content']="boutique_admin/banner/banner_action";
        		$this->load->view('boutique_admin_template', $data);
				}
		}
		$data['main_content']="boutique_admin/banner/banner_action";
        $this->load->view('boutique_admin_template', $data);
	}


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
			ini_set('upload_max_filesize', '200M');  
			ini_set('post_max_size', '200M');  
			ini_set('max_input_time', 3600);  
			ini_set('max_execution_time', 3600);

			$config['allowed_types'] = '*';
			$config['remove_spaces'] = true;
			$config['max_size'] = '1000000';
			$config['upload_path'] = './uploads/images/product/main_img/';
			$config['charset'] = "UTF-8";
			$new_name = "Butikbd_".time();
			$config['file_name'] = $new_name;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			if (isset($_FILES['main_images']['name']))
			{
			if($this->upload->do_upload('main_images')){
					$upload_data	= $this->upload->data();
					$save['main_image']	= $upload_data['file_name'];
				}
				else{
					$upload_data	= $this->input->post('mainImg');
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
			$svar='<select name="pro_size[]" id="size_id" class="form-control" required  multiple="multiple" style="min-height:150px">
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
		if(!$this->session->userdata('boutuqueAccessMail')) redirect("butikbdadmin");
		$boutiqueId= $this->session->userdata('boutuqueAccessId');
		$data['title']="photogallery List | Butikbd";
		$data['photogallery_list'] = $this->Index_model->getAllItemTable('photogallery','boutiqueshop',$boutiqueId,'','','b_id','desc');
		$data['main_content']="boutique_admin/photogallery/photogallery_list";
        $this->load->view('boutique_admin_template',$data);
	} 
	 
	 
	 
	function photogallery_registration()
	{
		
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
			$config['upload_path'] = './asset/uploads/photogallery/';
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
				$save['boutiqueshop']	    = $boutiqueId;
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
				redirect('butikbdadmin/photogallery_list', 'refresh');
			}
			else{
				$data['main_content']="boutique_admin/photogallery/photogallery_action";
        		$this->load->view('boutique_admin_template', $data);
				}
		}
		$data['main_content']="boutique_admin/photogallery/photogallery_action";
        $this->load->view('boutique_admin_template', $data);
	}
	
  function order_list()
	 {
		$data['title']="Butikbd.com | Customer Order List";
		$boutiqueId= $this->session->userdata('boutuqueAccessId');
		$data['orderList'] = $this->Index_model->getAllItemTable('orders','boutiqueshop',$boutiqueId,'','','order_id','desc');
		$data['main_content']="boutique_admin/order/order_list";
	    $this->load->view('boutique_admin_template', $data);
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
			$data['order_q']= $this->Index_model->getDataById('orders','order_id',$order_id,'order_id','desc','1');
			foreach($data['order_q']->result() as $rowq);
 			$customer_id=$rowq->customer_id;
			$data['customerQ']= $this->Index_model->getDataById('customer','user_id',$customer_id,'user_id','desc','1');
			$data['shipping']= $this->Index_model->getDataById('shipping_address','customer_id',$customer_id,'shipping_id','desc','1');
			$data['payment']= $this->Index_model->getDataById('payment_info','customer_id',$customer_id,'pay_id','desc','1');
			
			$data['order_id']=$order_id;
			$data['title']="Butikbd.com | Customer Order Details";
			$data['main_content']="boutique_admin/order/view_order";
			$this->load->view('boutique_admin_template', $data);
	}
	
	function new_invoice($order_id){
		if($this->input->post('invoiceCreate')!=""){
			$boutiqueId= $this->session->userdata('boutuqueAccessId');
			$insertTranstion=array(
					'cust_id'=>$this->input->post('cust_id'),
					'boutiqueshop'=>$boutiqueId,
					'ship_id'=>$this->input->post('ship_id'),
					'pay_id'=>$this->input->post('payId'),
					'order_num'=>$this->input->post('orderNumber'),
					'order_id'=>$this->input->post('order_id'),
					'create_date'=>date('Y-m-d h:i:s'),
					'date'=>date('Y-m-d')
					);
			$query = $this->Index_model->inertTable('invoice', $insertTranstion);
			redirect('butikbdadmin/invoice/'.$query);
		}
		else{
			 $this->session->set_flashdata('failedMsg', '<div class="alert alert-danger text-center">Failed To insert</div>');
			 redirect('butikbdadmin/view_order/'.$order_id, 'refresh');	
		}
			
	}
	
	function invoice($inpoiceId)
	 {
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
				$data['main_content']="boutique_admin/order/invoice";
				$this->load->view('boutique_admin_template', $data);
			}
	}
	
	
	function inventory()
	{
		$data['title']="Butikbd.com | Inventory Management";
		$boutiqueId= $this->session->userdata('boutuqueAccessId');
		$data['productlist'] = $this->Index_model->getAllItemTable('product','boutiqueshop',$boutiqueId,'','','product_id','desc');
		
		$data['main_content']="boutique_admin/order/inventory";
        $this->load->view('boutique_admin_template', $data);
		
    }
	function inventory_history($pid)
	{
		$data['title']="Butikbd.com | Inventory History";
		$data['pid']= $pid;
		$data['main_content']="boutique_admin/order/inventory_history";
        $this->load->view('boutique_admin_template', $data);
    }
	function update_inventory()
	{	
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
		redirect('butikbdadmin/inventory', '');
	}
	
	function update_status()
	{
		$status=$this->input->get('status');
		$view_order=$this->input->get('view_order');
		$table=$this->input->get('table');
		$id=$this->input->get('id');
		$this->Index_model->update_status($table,$status,$id); 
		redirect($_SERVER['HTTP_REFERER'],'refresh');
	}
		
public function deleteData($tableName,$colId){
		$cID = $this->input->get('deleteId');
		$this->Index_model->deletetable_row($tableName, $colId, $cID);
	}

}

?>
