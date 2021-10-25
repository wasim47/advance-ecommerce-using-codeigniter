<?php defined('BASEPATH') OR exit('No direct script access allowed');

class membership extends CI_Controller { 

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->helper('url');
		$this->load->model('Membership_model');
		$this->load->model('Index_model');
		if (!$this->session->userdata('adminUser_id'))
		{
			redirect('usermanage/login', 'refresh');
		}
	}

	//redirect if needed, otherwise display the user list
	function index()
	{
		$url=$this->uri->segment(3);
		$memId=$this->uri->segment(2);
		$data['title'] = 'Membership';
		$data['userdata'] = $this->Membership_model->getTable('users','	username','asc');
		
		$config['base_url'] = base_url('membership/index');
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
		$data['memberList'] = $this->Membership_model->getAllSearchItem('membership',$keyword,$conFromDate,$conToDate,'id','desc',$config["per_page"],$page);
		$data['memberUpdate'] = $this->Membership_model->getOneItemTable('membership','id',$memId,'id','desc');
		
			if($this->input->post('save')){
				$this->form_validation->set_rules('memberName', 'Member Name', 'trim|required');
				if($url=='new'){
					$this->form_validation->set_rules('docEmail', 'Email Address', 'is_unique[membership.email]');
					$this->form_validation->set_rules('doctorId', 'Doctors Id', 'trim|required|is_unique[membership.doc_id]');
				}
				else{
					$this->form_validation->set_rules('docEmail', 'Email Address', 'trim|required');
					$this->form_validation->set_rules('doctorId', 'Doctors Id', 'trim|required');	
				}
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
						'gallery'=>$this->input->post('pictureGallery'),
						'publication'=>$this->input->post('publication'),
						'templates'=>$this->input->post('templates'),
						'email'=>$this->input->post('docEmail'),
						'visitingcard'=>$this->input->post('visitingCard'),
						'invitation'=>$this->input->post('invitation'),
						'crest'=>$this->input->post('crest')
						);
					if(isset($url) && $url=='new'){
						$query = $this->Membership_model->inertTable('membership', $memberdata);
					}
					elseif(isset($url) && $url=='edit'){
						$mid=$this->input->post('member_id');
						$query = $this->Membership_model->updateTable('membership','id',$mid, $memberdata);	
					}	
					
					
					if($query){
						$this->session->set_flashdata('successMsg', '<p class="alert alert-success">Successfully Member Created</p>');
						redirect('membership');
					}
				}
			}
			if(isset($url) && $url=='new'){
				$data['main_content']="membership/create_member";
			}
			elseif(isset($url) && $url=='edit'){
				$data['main_content']="membership/update_member";
			}
			else{
				$data['main_content']="membership/member_list";
			}
		$this->load->view('deshboard_templete', $data);
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
		$this->Membership_model->deletetable_row('membership', 'id', $mid);
		redirect('membership');
	}
	
	
	
	
	
	public function renew(){
		$url=$this->uri->segment(3);
		$memId=$this->uri->segment(2);
		$data['title'] = 'Membership';
		$data['userdata'] = $this->Membership_model->getTable('users','	username','asc');
		$config['base_url'] = base_url('membership/renew/');
        $config["per_page"] = 30;
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$total_row = $this->Membership_model->record_count('member_renew');
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
		$data['memberList'] = $this->Membership_model->getAllSearchItem('member_renew',$keyword,$conFromDate,$conToDate,'id','desc',$config["per_page"],$page);
		$data['memberUpdate'] = $this->Membership_model->getOneItemTable('member_renew','id',$memId,'id','desc');
		
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
						$query = $this->Membership_model->inertTable('member_renew', $memberdata);
					}
					elseif(isset($url) && $url=='edit'){
						$mid=$this->input->post('member_id');
						$query = $this->Membership_model->updateTable('member_renew','id',$mid, $memberdata);	
					}	
					
					
					if($query){
						$this->session->set_flashdata('successMsg', '<p class="alert alert-success">Successfully Member Created</p>');
						redirect('membership/renew');
					}
				}
			}
			
			if(isset($url) && $url=='new'){
				$data['main_content']="membership/renew/create_member";
			}
			elseif(isset($url) && $url=='edit'){
				$data['main_content']="membership/renew/update_member";
			}
			else{
				$data['main_content']="membership/renew/member_list";
			}
			$this->load->view('deshboard_templete', $data);
		
	}
	
	
	public function memberRenewTrash($mid){
		$this->Membership_model->deletetable_row('member_renew', 'id', $mid);
		redirect('membership/renew');
	}

	public function GetUserName(){
        $keyword=$this->input->get('keyword');
        $data=$this->cmodel->GetRowDocCust('author','username',$keyword);        
        echo json_encode($data);
    }
	
	public function getMemberList(){
        $keyword=$this->input->get('keyword');
        $data=$this->Membership_model->GetRowDocCust('membership','memberName',$keyword);        
        echo json_encode($data);
    }
}
