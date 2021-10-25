<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

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
		$data['title'] = "Eve & Youngstar | The Largest Online eCommerce Market in Bangladesh";
		$data['bannerslider']	= $this->Index_model->getDataById('banner','status','1','b_id','desc',10);
		$data['menu']	= $this->Index_model->getAllMenu();
		$data['topcategory']	= $this->Index_model->getDataById('category','status','1','cid','asc','6');
		
		
		$data['hotdeals']	= $this->Index_model->getDataById('product','hot_deals',1,'product_id','desc',8);
		$data['bestsellproduct']	= $this->Index_model->getNotIdData('product','','','','','product_id','desc',12);
		$data['topproduct']	= $this->Index_model->getNotIdData('product','','','','','product_id','asc',12);
		$data['newproduct']	= $this->Index_model->getNotIdData('product','','','','','product_name','asc',12);
		$data['featuredwproduct']	= $this->Index_model->getNotIdData('product','','','','','pro_code','desc',12);
		
		
		$data['footermenu']	= $this->Index_model->getAllMenu();
		$data['search_kewwords']	= $this->Index_model->search_kewwords();
		$data['slider']				= $this->Index_model->get_newSrrival();
		$data['sponcer']		= $this->Index_model->getDataById('sponcer','','','sequence','asc','');
		$data['main_content']="frontend/index";
        $this->load->view('template', $data);
	}
	
	function video()
	{
        $this->load->view('frontend/video');
	}
	
	function search_data()
	{
		$keyword=$this->input->post('keyword');
		$category=$this->input->post('pro_category');
		$boutiqueshop=$this->input->post('boutiqueshop');
		$data['search_kewwords']	= $this->Index_model->search_kewwords();
		if($keyword!=""){
				$save=array(
					'keywords'=>$keyword,
					'date'=>date('Y-m-d')
				);
				$query = $this->Index_model->inertTable('search_keywords', $save);
		}

		
		$data['slug'] =ucfirst($keyword);
		$data['title'] = $keyword." | Butikbd.com";
		$data['menu']	= $this->Index_model->getDataById('menu','root_id',0,'m_id','asc','');
		$data['topsearch']	= $this->Index_model->getDataById('search_keywords','','','key_id','desc','10');
		$data['footermenu']	= $this->Index_model->getAllMenu();
		$data['allbutikshop']	= $this->Index_model->getNotIdData('boutiqueshop','','','','','user_id','desc','');
		$data['allsize']	= $this->Index_model->getDataById('size','','','size_id','asc','');
		$data['allcolor']	= $this->Index_model->getDataById('color','','','color_id','asc','');
		
		$data['productgallery']	= $this->Index_model->searchdata($keyword,$category,$boutiqueshop);
		$data['main_content']="frontend/product_search";
        $this->load->view('template', $data);
	}
	

/*function article($slug)
	{
		$data['title'] = $slug." | Article | Butikbd.com";
		$url=urldecode($slug);
		$data['boutiqueshop']		= $this->Index_model->getDataById('boutiqueshop','active','1','username','asc','');
		$data['footermenu']	= $this->Index_model->getAllMenu();
		$data['articledetails']	= $this->Index_model->getOneItemTable('article_manage','cat_id',$url,'a_id','desc',1);
		$data['main_content']="frontend/article_details";
        $this->load->view('template', $data);
	}
	function details_slider()
	{
		$data['product_id'] = $this->input->get('product_id');
        $this->load->view('frontend/product_slider', $data);
	}*/

	public function userLogin()
     {
		  $data['title'] =  "User Login | Butikbd.com";
	 	  $usertype = $this->input->post('usertype');
          $username = $this->input->post("email");
  		  $password = $this->input->post("password");
          $this->form_validation->set_rules("email", "Email", "trim|required|min_length[6]|valid_email");
          $this->form_validation->set_rules("password", "Password", "trim|required");
		  $this->form_validation->set_rules("usertype", "User Type", "trim|required");

          if ($this->form_validation->run() == FALSE)
          {
              redirect('index');
          }
          else
          {
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
				  redirect("profile/".$usertype);
			  }
			  else
			  {
				$this->session->set_flashdata('invalidmsg', '<div class="alert alert-danger text-center" style="padding:7px; margin-bottom:5px; color:red">Invalid Email and password!</div>');
				  redirect('index');
			  }
		 }
     }
	 
	 
	
    function logout()
  	{
	  $sessiondata = array(
				'userAccessMail'=>'',
				'userAccessType'=>'',
				'userAccessName'=> '',
				'userAccessId' => '',
				'password' => FALSE
		 );
	$this->session->unset_userdata($sessiondata);
	$this->session->sess_destroy();
    redirect('index', 'refresh');
  }
  
  /*function rating_submit()
	{
		$slug=$this->input->post('slug');
		$save['pro_id']	    = $this->input->post('pro_id');
		$save['username']	    = $this->input->post('username');
		$save['email']	    = $this->input->post('email');
		$save['ratval']	    = $this->input->post('ratingVal');
		$save['review']	    = $this->input->post('review');
		$save['date']		= date('Y-m-d');
		
		$query = $this->Index_model->inertTable('product_rating', $save);
		if($query){
			$this->session->set_flashdata('globalMsg', '<div class="alert alert-success">Rating Submitted</div>');
			redirect('products/'.$slug, '');
		}
		else{
			 $this->session->set_flashdata('globalMsg', '<div class="alert alert-danger text-center">Faild to rating this product</div>');
			redirect('products/'.$slug, '');
		}
	}*/
  
  
  function subscription()
	{
		 $this->form_validation->set_rules("subcribe", "Email Address", "trim|required|is_unique[subcribe.email]");
          if ($this->form_validation->run() == FALSE)
          {
		 	 $this->session->set_flashdata('globalMsg', '<div class="alert alert-danger" style=" background:#fff; color:green">Subscription Failed</div>');
			  redirect($_SERVER['HTTP_REFERER']);	
		 }
		else{
			$email = $this->input->post('subcribe');
			$promotion = array(
					  'email'		 => $email,
					  'date'	 => date('Y-m-d')
				  );
			$query = $this->Index_model->inertTable('subcribe',$promotion);
			if($query){
			$this->session->set_flashdata('globalMsg', '<div class="alert alert-success" style=" background:#fff; color:green">Successfully Subscription</div>');
			$tomaila=$email.', wasim.html@gmail.com';
			$frommaila="info@butikbd.com";
			$subjecta="Thank You for Subscription";
			$config = array (
						  'mailtype' => 'html',
						  'charset'  => 'utf-8',
						  'priority' => '1'
						   );
			$this->email->initialize($config);
			$this->email->set_newline('\r\n');
			$email_bodya ="
			<table width='95%' border='0' cellpadding='0' align='center' cellspacing='0' style=' 
			border:2px solid #FC0; border-radius:13px; padding-left:20px;'>
			<tr style='background-color:#fff'>
			<th width='26%' height='79' align='center'> 
			<img src='".base_url('assets/images/front/butikbdlogo.png')."' />
			<th colspan='2' align='left'></th>
			</tr>
			<tr>
			<th height='25' colspan='3' align='left' 
				style='font-size:22px; color:#333; text-decoration:none;'>&nbsp;</th>
			</tr>
			<tr>
			<td height='137' colspan='3' align='right' valign='top'>
			<table width='100%' border='0' cellspacing='0' cellpadding='0'>
			<tr>
			  <td width='100%' height='44'  align='center'><h2>Thank you for Subscription</h2></td>
			  </tr>
			<tr>
			  <td>You will get all latest collections & offers from butikbd.com</td>
			  </tr>
			</table></td>
			</tr>
			</table>";
		
			$this->email->from($frommaila, 'butikbd.com');
			$this->email->to($tomaila);
			$this->email->subject($subjecta);
			$this->email->message($email_bodya);
			$this->email->send();
			redirect('index');
			}
		}
	}
	
	
	function wishlistProduct($productId)
	{
		if(!$this->session->userdata('userAccessId')){
			redirect('index', '');
		}
		else{
			$customerId=$this->session->userdata('userAccessId');
			$wishlistquery = $this->Index_model->getAllItemTable('customer_wishlist','customer_id',$customerId,'product_id',$productId,'wid','desc');
			if($wishlistquery->num_rows() == 0){
				$save=array('customer_id'=>$customerId, 'product_id'=>$productId,'date'=>date('Y-m-d'));
				$this->Index_model->wishlistProductSave($save);
			}
			redirect('index', '');
		}
	}
	
	function removeWishlistProduct()
	{
		$wid=$this->input->get('wid');
		$this->Index_model->deletetable_row('customer_wishlist', 'wid',$wid);
		redirect('index', '');
	}
	
}

?>
