<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class products extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Index_model');
		date_default_timezone_set('Asia/Dhaka');
     	$this->load->library('email');
		$this->load->library('cart');
		$this->load->library('pagination');
	}
	
	function index($producturl)
	{
		$product_id=urldecode($producturl);
		//$data['category']		= $this->Index_model->getDataById('category','status','1','sequence','asc','');
		$data['menu']	= $this->Index_model->getDataById('menu','root_id',0,'m_id','asc','');
		$data['allbutikshop']	= $this->Index_model->getNotIdData('boutiqueshop','','','','','user_id','desc','');
		$data['productdetails']	= $this->Index_model->getDataById('product','slug',$product_id,'','',1);
		$data['search_kewwords']	= $this->Index_model->search_kewwords();
		foreach($data['productdetails']->result() as $details);
		 	    $relsCat=$details->scat_id;
				$relCat=$details->cat_id;
				$proId=$details->product_id;

        $data['inventoryproduct']	= $this->Index_model->getOneItemTable('inventory','product_id',$proId,'inventory_id','desc');
		$data['prodctreview']	= $this->Index_model->getDataById('product_rating','pro_id',$proId,'id','desc','');
				
		$data['relatedproducts']	= $this->Index_model->getDataById('product','scat_id',$relsCat,'product_id','desc',8);
		$data['likeproducts']	= $this->Index_model->getDataById('product','cat_id',$relCat,'product_id','desc',8);
		$data['discountproduct']	= $this->Index_model->getNotIdData('product','discount',NULL,'','','product_id','desc','5');
		$data['bestselling']	= $this->Index_model->getNotIdData('product','discount',NULL,'','','product_id','desc','4');
		
		$data['footermenu']	= $this->Index_model->getAllMenu();
		$data['title'] = $product_id;
		if($product_id!='gallery'){
			$data['product_id'] = $product_id;
			foreach($data['productdetails']->result() as $proDetails){
				$sponcer = $proDetails->sponcer;
				$sponId=explode(',',$sponcer);
				//print_r( $sponId);
			}
			
			//print_r( $sponcer);
			$data['sponcer']		= $this->Index_model->getDataByIdArray('sponcer','sponcer_id',$sponId,'sequence','asc','');
			
			foreach($data['productdetails']->result() as $upvalue);
			$readCount=$upvalue->read_count;
			if($readCount!=0){
				$rval=$readCount + 1;
			}
			else{
				$rval=1;
			}
			$updatedata=array('read_count'=>$rval);
			$this->Index_model->update_table('product','product_id',$product_id,$updatedata);
			$data['main_content']="frontend/product_details";
			$this->load->view('template_details', $data);
			//$this->load->view('frontend/product_details', $data);
		}
		else{
			$this->gallery();
		}
	}
	function access($access)
	{
		if($access=="review"){
			$this->rating_submit();
		}
		elseif($access=="sendtofriend"){
			$this->sendToFriends();
		}
	}
	function rating_submit()
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
			 $this->session->set_flashdata('globalMsg', '<div class="alert alert-danger text-center">Faild to rating this book</div>');
			redirect('products/'.$slug, '');
		}
	}
	
	function gallery()
	{
		$data['footermenu']	= $this->Index_model->getAllMenu();
		$data['search_kewwords']	= $this->Index_model->search_kewwords();
		$cat=urldecode($this->uri->segment(3));
		$scat=urldecode($this->uri->segment(4));
		$lcat=urldecode($this->uri->segment(5));
		if($lcat!="" && !is_numeric($lcat)){
			$slug=urldecode($lcat);
			$seg=6;
			$url1=$cat;
			$url2=$scat;
			$url3=$lcat;
			$url=$url1.' | '.$url2.' | '.$url3;
			$burl=base_url('products/gallery/'.$url);
		}
		elseif($scat!="" && !is_numeric($scat)){
			$slug=urldecode($scat);
			$seg=5;
			$url1=$cat;
			$url2=urldecode($scat);
			$url3='';
			$url=$url1.' | '.$url2;
			$burl=base_url('products/gallery/'.$url);
		}
		elseif($cat!="" && !is_numeric($cat)){
			$slug=urldecode($cat);
			$seg=4;
			$url1=urldecode($cat);
			$url2='';
			$url3='';
			$url=$url1;
			$burl=base_url('products/gallery/'.$url);
		}
		else{
			$seg=3;
			$burl=base_url('products/gallery/');
			$url='Peoduct Gallery';
		}
		
		$sortby=$this->input->post('sortby');
		if($sortby=='name_asc'){
			$sorttype='asc';
			$sortval='product_name';
		}
		elseif($sortby=='name_desc'){
			$sorttype='desc';
			$sortval='product_name';
		}
		elseif($sortby=='price_asc'){
			$sorttype='asc';
			$sortval='price';
		}
		elseif($sortby=='price_desc'){
			$sorttype='desc';
			$sortval='price';
		}
		
		$pagelimit=$this->input->post('pagelimit');
		if($pagelimit!=""){
			$data['plimit']=$pagelimit;
		}
		else{
			$data['plimit']=16;
		}
		$pricefrom=$this->input->post('fromprice');
		$priceto=$this->input->post('toprice');
		$prosize=$this->input->post('prosize');
		$procolor=$this->input->post('procolor');
		$boutiqueId=$this->input->post('brandid');
		list($fs,$fprice)=explode(' ',$pricefrom);
		list($ts,$tprice)=explode(' ',$priceto);
		//$url=urldecode($slug);
		$exp=explode('-',$url);
		$imp=implode(' ',$exp);
		$data['title']=$imp;
		$data['slug']=$slug;
		$data['categorytitle']=$cat;
		$data['subcategories']	= $this->Index_model->getDataById('sub_category','cat_id',$cat,'scid','asc','');
		$data['topsearch']	= $this->Index_model->getDataById('search_keywords','','','key_id','desc','10');
		
		$data['menu']	= $this->Index_model->getDataById('menu','root_id',0,'m_id','asc','');
		$data['allbutikshop']	= $this->Index_model->getNotIdData('boutiqueshop','','','','','user_id','desc','');
		$data['allsize']	= $this->Index_model->getDataById('size','','','size_id','asc','');
		$data['allcolor']	= $this->Index_model->getDataById('color','','','color_id','asc','');
		$data['getAllProduct']	= $this->Index_model->product_galleryCount($url1,$url2,$url3,$fprice,$tprice,$prosize,$procolor,$boutiqueId);
		
		$config = array();
		$page = ($this->uri->segment($seg)) ? $this->uri->segment($seg) : 0;
        $config['base_url'] = $burl;
		$config['total_rows'] = $data['getAllProduct']->num_rows();
		$config['num_links'] = $data['getAllProduct']->num_rows();
      	$config['per_page'] = $data['plimit'];
		$config['uri_segment'] =$seg;
		
        $config['cur_tag_open'] = '&nbsp;<a class="active">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $this->pagination->initialize($config);
		$data['pagination']= $this->pagination->create_links();
		$data['pageSl'] = $page;	
		
	$data['productgallery']	= $this->Index_model->product_gallery($url1,$url2,$url3,$sortval,$sorttype,$fprice,$tprice,$prosize,$procolor,$boutiqueId,$config['per_page'],$page);
		$data['advertisement']	= $this->Index_model->getDataById('advertisement','status','1','b_id','desc',3);
		$data['main_content']="frontend/product_gallery";
        $this->load->view('template', $data);
	}
	
function sendToFriends()
	{
			$username = $this->input->post('username');
			$yourmail = $this->input->post('yourmail');
			$receivername = $this->input->post('receivername');
			$friendmail = $this->input->post('friendmail');
			$productid = $this->input->post('productid');
			$productname = $this->input->post('productname');
			$qty = $this->input->post('qty');
			$price = $this->input->post('price');
			$mainimage = $this->input->post('prophoto');
			$slug = $this->input->post('slug');
			
			$insertTranstion=array(
					'sendername'=>$username,
					'sendermail'=>$yourmail,
					'receivername 	'=>$receivername,
					'receivermail'=>$friendmail,
					'pro_id'=>$productid,
					'datetime'=>date('Y-m-d h:i:s'),
					'date'=>date('Y-m-d')
					);
			$this->Index_model->inertTable('sendtofriend', $insertTranstion);
			
			$tomaila=$friendmail;
			$frommaila=$yourmail;
			$subjecta=$username." want to share butikbd products with you";
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
			  <td width='37%' height='134' valign='top'><img src='".base_url('uploads/images/product/main_img/'.$mainimage)."' /></td>
			  <td width='3%' valign='top'>
              <h3 style='padding:2px; margin:0'>&nbsp;</h3></td>
			  <td width='60%' valign='top'><h3 style='padding:2px; margin:0'>$productname</h3>
                <h4 style='padding:2px; margin:0'>$qty</h4>
              <h2 style='color:#FAC010;padding:2px; margin:0'>$price</h2></td>
		    </tr>
            <tr>
			  <td width='37%' height='30' valign='top' colspan='3' align='center'>For more Information <a href='".base_url('products/'.$slug)."'>Click Here</a></td>
		    </tr>
			</table></td>
			</tr>
			</table>";
		
			$this->email->from($frommaila, $username);
			$this->email->to($tomaila);
			$this->email->subject($subjecta);
			$this->email->message($email_bodya);
			$this->email->send();
			$this->session->set_flashdata('sendmailsuccess', '<div class="alert alert-success" style=" background:#fff; color:green">Successfully Sent</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
}

?>
