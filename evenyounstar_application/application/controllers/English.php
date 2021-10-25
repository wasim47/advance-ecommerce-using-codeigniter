<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class English extends CI_Controller {

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
		$data['title'] = "Comming Soon...";
		$data['allbutikshop']	= $this->Index_model->getDataById('boutiqueshop','active','1','user_id','desc','20');
		$data['footermenu']	= $this->Index_model->getAllMenu();
		$data['main_content']="frontend/english";
        $this->load->view('template', $data);
	}
	
	
}

?>
