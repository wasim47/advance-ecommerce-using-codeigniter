<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Emailsend extends CI_Controller {

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
		$config = array();
		$page = ($this->uri->segment($seg)) ? $this->uri->segment($seg) : 0;
		$totalrow=$this->Index_model->allemail('','');
        $config['base_url'] = $burl;
		$config['total_rows'] = $totalrow->num_rows();
		$config['num_links'] = $totalrow->num_rows();
      	$config['per_page'] = 20;
		$config['uri_segment'] =$seg;
		
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $this->pagination->initialize($config);
		$data['pagination']= $this->pagination->create_links();
		$data['pageSl'] = $page;	
		
		$data['allemail']	= $this->Index_model->allemail($config['per_page'],$page);
        $this->load->view('frontend/emailsend',$data);
	}
  
  function sendmail()
	{
			$usemail=$this->input->post('usermail');
			$tomaila=$usemail;
			$frommaila="info@butikbd.com";
			$subjecta="Offer for a Free E-commerce websites";
			$config = array (
						  'mailtype' => 'html',
						  'charset'  => 'utf-8',
						  'priority' => '1'
						   );
			$this->email->initialize($config);
			$this->email->set_newline('\r\n');
			$email_bodya ="
			<div style='border:1px solid #FFC20E; padding:10px;'>
<table width='100%' border='0'>
	<tr>
    	<td width='20%'><img src='http://butikbd.com/assets/images/front/butikbdlogo.png' /></td>
        <td width='80%' style='font-family:SolaimanLipi; font-size:35px;'>স্বপ্ন আপনার বাস্তবায়নের দায়িত্ব আমাদের</td>
    </tr>
    <tr><td height='33' colspan='2'>&nbsp;</td></tr>
  <tr>
        <td width='80%' colspan='2' style='font-family:SolaimanLipi; font-size:20px;'>
        	Online Business করতে আগ্রহী ?<br />
            যোগ্যতাসম্পন্ন হয়েও কিছু করতে পারছেন না ?<br />
            Online - এ কোন Shop খুলতে চাচ্ছেন ?<br />
            কোন বুটিক শপ খুলতে চাচ্ছেন ?<br />
            আপনার বুটিক শপ আছে কিন্তু Online - এ শপ খুলতে পারছেন না ? <br /><br />
            
            তাহলে আর দেরি কেন আজই যোগাযোগ করুন আমাদের সাথে।<br />
            আপনার স্বপ্ন পুরনের দায়িত্ব আমাদের।<br />
            butikbd.com দিচ্ছে আপনাকে আপনার স্বপ্ন পুরনের এক সুবর্ণ সুযোগ।<br />
            butikbd.com দিচ্ছে আপনাকে একটি পরিপূর্ণ E-commerce Solution শুধু তাই নই তারই সাথে আপনি পাচ্ছেন একটি Simple Inventory Software যেখানে আপনি আপনার পছন্দমত Product Upload kore আপনার ব্যবসা বৃদ্ধি করতে পারবেন ।<br />
            আপনি কেন আপনার Online marketing - এর চিন্তা করবেন, আপনার সেই দায়িত্ব ও আমাদের ।<br />
            আপনার Product বেশি পরিমাণে বিক্রয়ের লক্ষে আপনার Online Marketing করবে butikbd.com.<br />
            সাথে থাকছে আরও অনেক অনেক সুবিধা।<br />
			বাংলাদেশের এই প্রথম বিশাল বুটিক সমাহার যেখানে আপনি হতে পারেন বাংলাদেশের অন্যতম Brand.<br />
            <strong>আমরা আপনার নিজস্ব Brand - এর নিশ্চয়তা দিচ্ছি।</strong><br /><br />
            
            আরও বিস্তারিত জানতে ও রেজিস্ট্রেশান করতে যোগাযোগ করুনঃ-<br />
            <strong>মোবাইলঃ-  ০১৯২২০০২৩৮১,  ০১৬৭৬৬৬৯২৩৯, ০১৬৭৩২১৫২১০

<br />
            ই-মেইলঃ-  info@butikbd.com, waism.html@gmail.com</strong>
        </td>
    </tr>
</table>
</div>";
		
			$this->email->from($frommaila, 'Butikbd.com');
			$this->email->to($tomaila);
			$this->email->subject($subjecta);
			$this->email->message($email_bodya);
			$this->email->send();
			$this->session->set_flashdata('globalMsg', '<div class="alert alert-success">Mail send Successfully</div>');
			redirect('emailsend');
			}
	}

?>
