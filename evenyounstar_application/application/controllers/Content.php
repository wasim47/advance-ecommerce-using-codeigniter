<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Index_model');
		date_default_timezone_set('Asia/Dhaka');
     	$this->load->library('email');
		$this->load->helper('form');
		$this->load->helper('url');
	}
	function index()
	{
		$slug=urldecode($this->uri->segment(2));
		$data['title'] = "Butikbd.com | Bangladesh Largest Online Boutiques Market";
		$data['bannerslider']	= $this->Index_model->getDataById('banner','status','1','b_id','desc',10);
		$data['search_kewwords']	= $this->Index_model->search_kewwords();
		$data['menu']	= $this->Index_model->getDataById('menu','root_id',0,'m_id','asc','');
		$data['hotdeals']	= $this->Index_model->getDataById('product','hot_deals',1,'product_id','desc',8);
		$data['tshirtsproduct']	= $this->Index_model->getNotIdData('product','','','','','product_id','desc',4);
		$data['topbutikshop']	= $this->Index_model->getNotIdData('boutiqueshop','','','','','username','asc','14');
		$data['topbutikshopImg']	= $this->Index_model->getDataById('boutiqueshop','active','1','user_id','desc','20');
		$data['allbutikshop']	= $this->Index_model->getDataById('boutiqueshop','active','1','user_id','desc','20');
		$data['butikshoplist']	= $this->Index_model->getNotIdData('boutiqueshop','','','','','username','asc',4);
		$data['footermenu']	= $this->Index_model->getAllMenu();
		$data['slider']				= $this->Index_model->get_newSrrival();
		$data['sponcer']		= $this->Index_model->getDataById('sponcer','','','sequence','asc','');
		$data['articledetails']	= $this->Index_model->getOneItemTable('article_manage','menu_title',$slug,'a_id','desc',1);
		
		if($slug=='contact-us'){
			$data['main_content']="frontend/contact_view";
		}
		else{
			$data['main_content']="frontend/article_details";
		}
        $this->load->view('template', $data);
	}
	
}

?>
