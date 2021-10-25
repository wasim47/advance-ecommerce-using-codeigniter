<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Features extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Index_model');
		date_default_timezone_set('Asia/Dhaka');
     	$this->load->library('email');
		$this->load->library('cart');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));
		//$this->load->helper('url');
	}
	function index()
	{
		$url=$this->uri->segment(2);
		$data['title'] = $url." Butikbd.com | Bangladesh Largest Online Boutiques Market";
		$data['bannerslider']	= $this->Index_model->getDataById('banner','status','1','b_id','desc',10);
		$data['search_kewwords']	= $this->Index_model->search_kewwords();
		$data['menu']	= $this->Index_model->getDataById('menu','root_id',0,'m_id','asc','');
		$data['tshirtsproduct']	= $this->Index_model->getNotIdData('product','','','','','product_id','desc',4);
		$data['topbutikshop']	= $this->Index_model->getDataById('boutiqueshop','active','1','user_id','desc','14');
		$data['topbutikshopImg']	= $this->Index_model->getDataById('boutiqueshop','active','1','user_id','desc','20');
		$data['allbutikshop']	= $this->Index_model->getDataById('boutiqueshop','active','1','user_id','desc','20');
		$data['footermenu']	= $this->Index_model->getAllMenu();
		$data['slider']				= $this->Index_model->get_newSrrival();
		$data['features_details']	= $this->Index_model->getOneItemTable('feature_manage','menu_title',$url,'a_id','desc',1);
		//$data['main_content']="frontend/features/".$url;
		if($url=='ourpackages'){
			$data['main_content']="frontend/features/ourpackages";
		}
		else{
			$data['main_content']="frontend/features/features";
		}
        $this->load->view('template', $data);
	}
	
	

}

?>
