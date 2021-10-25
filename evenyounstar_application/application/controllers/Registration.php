<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registration extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Index_model');
		date_default_timezone_set('Asia/Dhaka');
     	$this->load->library('email');
		$this->load->library('cart');
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));
	}
	
	public function email_check()
    {
        if($this->input->is_ajax_request()){
			$username = $this->input->get('username');
			//$this->form_validation->set_rules('username', 'Username', 'trim|required|regex_match[/^[A-Za-z0-9_]+$/]|is_unique[edoctors.username]');
			if(!$this->form_validation->is_unique($username, 'boutiqueshop.urlname')) {
				$this->output->set_content_type('application/json')->set_output(json_encode(
				array('message' => 'The username is already Exist, Please Choose another one', 'color'=>'red')));
			}
			else{
				$this->output->set_content_type('application/json')->set_output(json_encode(
				array('message' => 'The username Aavailable', 'color'=>'green')));
				}
		}
	}
	function ajaxData()
	{
		if($this->input->get('root_id')!=""){
			$rid=$this->input->get('root_id');
			$sroot_menu = $this->Index_model->getAllItemTable('bangladesh','district',$rid,'','','district','asc');
			$svar='<select name="thana" class="form-control" style="width:70%;">
								<option value="">Select Thana</option>';
								 foreach($sroot_menu->result() as $rootmenu):
									$svar .= '<option value="'.$rootmenu->thana.'">'.$rootmenu->thana.'</option>';
								endforeach;
							$svar .= '</select>';
			echo $svar;
		}
	}
	function customer()
	{
		$data['title'] = 'Member Registration | Butikbd.com';
		$data['footermenu']	= $this->Index_model->getAllMenu();
		$data['menu']	= $this->Index_model->getDataById('menu','root_id',0,'m_id','asc','');
		$data['allbutikshop']	= $this->Index_model->getDataById('boutiqueshop','active','1','user_id','desc','20');
		$data['search_kewwords']	= $this->Index_model->search_kewwords();
		
		$data['totaldistrict']= $this->Index_model->getAllDistrict('bangladesh','','','district','district','asc');
		$data['addScript'] = array('ckeditor'=> base_url('assets/ckeditor/ckeditor.js'));
		if($this->input->post('registerpayLater') || $this->input->post('registerpayNow')){
			$this->form_validation->set_rules('memberName', 'member Name', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[customer.email]');
			$this->form_validation->set_rules('mobile', 'Mobile No', 'trim|required|is_unique[customer.mobile]');
			//$this->form_validation->set_rules('city', 'city', 'trim|required');
			
			if($this->form_validation->run() != false){
				$save['username']	    = $this->input->post('memberName');
				$save['mobile']	    = $this->input->post('mobile');
				$save['address']	    = $this->input->post('address');
				$save['gender']	    = $this->input->post('gender');
				$save['country']	    = "Bangladesh";
				$save['thana']	    = $this->input->post('thana');
				$save['city']	    = $this->input->post('district');
				$save['email']	    = $this->input->post('email');
				$save['password']	    = sha1($this->input->post('password'));
				$save['passwordHints']	    = $this->input->post('password');
				$save['created_date']	    = date('Y-m-d');
				$save['active']	    = 1;
				
				$query = $this->Index_model->inertTable('customer', $save);
				if($query){
					
					$email=$this->input->post('email');
					$password=$this->input->post('password');
							$tomaila=$email;
							$frommaila="info@bitikbd.com";
							$subjecta="Thank ".$this->input->post('memberName')." for registration with Digiproduct.com";
							$config = array (
										  'mailtype' => 'html',
										  'charset'  => 'utf-8',
										  'priority' => '1'
										   );
							$this->email->initialize($config);
							$this->email->set_newline('\r\n');
							$email_bodya ="
							<table width='95%' border='0' cellpadding='0' align='center' cellspacing='0' style=' 
							border:2px solid #f00; border-radius:13px; padding-left:20px;'>
							<tr style='background-color:#fff'>
							<th width='26%' height='79' align='center'> 
							<img src='".base_url('assets/images/front/butikbdlogo.png')."' />
							<th colspan='2' align='left'></th>
							</tr>
							<tr>
							<th height='37' colspan='3' align='left' 
								style='font-size:22px; color:#333; text-decoration:none;'>Login Information</th>
							</tr>
							<tr>
							<td height='137' colspan='3' align='right' valign='top'>
							<table width='100%' border='0' cellspacing='0' cellpadding='0'>
							<tr>
							<td width='37%' height='31'><strong>Email</strong></td>
							<td width='3%'><strong>:</strong></td>
							<td width='60%'>$email</td>
							</tr>
							<tr>
							<td height='29'><strong>Password</strong></td>
							<td><strong>:</strong></td>
							<td>$password</td>
							</tr>
							
							<tr>
							  <td colspan='3'> You can update your profile. For more help please contact butikbd.com.<br />
                   						Our Support Team Contact : support@butikbd.com or mobile : +8801922002381</td>
							  </tr>
							<tr>
							  <td colspan='3'>&nbsp;</td>
							  </tr>
							</table></td>
							</tr>
							</table>";
						
							//$this->email->initialize($config);
							$this->email->from($frommaila, 'butikbd.com');
							$this->email->to($tomaila);
							//$this->email->bcc();
							$this->email->subject($subjecta);
							$this->email->message($email_bodya);
							$this->email->send();
							$this->session->set_userdata('newmemberId',$query);
							redirect('registration/registrationSuccess', '');
				}
			}
		}
		$data['main_content']="frontend/customer/registration";
        $this->load->view('template', $data);
	}
	
	
	
	
	
	function boutiqueshop()
	{
		$data['addScript'] = array('ckeditor'=> base_url('assets/ckeditor/ckeditor.js'));
		$data['title'] = 'boutiqueshop Registration | ';
		$data['footermenu']	= $this->Index_model->getAllMenu();
		$data['menu']	= $this->Index_model->getDataById('menu','root_id',0,'m_id','asc','');
		$data['allbutikshop']	= $this->Index_model->getDataById('boutiqueshop','active','1','user_id','desc','20');
		$data['search_kewwords']	= $this->Index_model->search_kewwords();
		$data['countryAll']= $this->Index_model->getDataById('countryall','parent_id','0','name','asc','');
		
		if($this->input->post('registerpayLater') || $this->input->post('registerpayNow')){
			$this->form_validation->set_rules('boutiqueshop_name', 'Boutique shop Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[boutiqueshop.email]');
			$this->form_validation->set_rules('mobile', 'Mobile No', 'trim|required|is_unique[boutiqueshop.mobile]');
			$this->form_validation->set_rules('urlname','Url Name','required|trim|regex_match[/^[A-Za-z0-9_]+$/]|is_unique[boutiqueshop.urlname]');
			
		if($this->form_validation->run() != false){
			$config['allowed_types'] = '*';
			$config['remove_spaces'] = true;
			$config['max_size'] = '1000000';
			$config['upload_path'] = 'uploads/images/boutiqueshop/';
			$config['charset'] = "UTF-8";
			$new_name = "Banner_".time();
			$config['file_name'] = $new_name;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (isset($_FILES['butikshoplogo']['name']))
			{
				if($this->upload->do_upload('butikshoplogo')){
					$upload_data	= $this->upload->data();
					$save['photo']	= $upload_data['file_name'];
				}
				else{
					$upload_data	= '';
					$save['photo']	= $upload_data;	
				}
			}	
			$urlname=ucfirst($this->input->post('urlname'));
			$shopname=$this->input->post('boutiqueshop_name');
			$ownername=$this->input->post('owner');
			$contct=$this->input->post('mobile');
			
			$save['urlname']	    = $this->input->post('urlname');
			$save['username']	    = $shopname;
			$save['telephone']	    = $this->input->post('telephone');
			$save['mobile']	    = $contct;
			$save['address']	    = $this->input->post('address');
			$save['website']	    = $this->input->post('website');
			$save['email']	    = $this->input->post('email');
			//$save['password']	    = sha1($this->input->post('password'));
			//$save['passwordHints']	    = $this->input->post('password');
			$save['ownername']	    = $ownername;
			$save['date']	    = date('Y-m-d');
			$save['active']	    = 0;
				$query = $this->Index_model->inertTable('boutiqueshop', $save);
				if($query){
				
				$copyfile=APPPATH."controllers/Boutique.php";
				$newfile=APPPATH."controllers/boutiqueshop/".$urlname.".php";
		//copy($copyfile,$newfile);
		$file_data = "<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ".$urlname." extends CI_Controller { ";
		$file_data .= file_get_contents($copyfile);
		file_put_contents($newfile, $file_data);
			
					/*$data = APPPATH.'controllers\Boutique.php';
					if ( ! file_exists(APPPATH.'controllers/boutiqueshop/butikbd.php')){
						if ( ! write_file(APPPATH.'controllers/boutiqueshop/butikbd.php', $data))
						{
							 echo 'Unable to write the file';
						}
						else
						{
							 echo 'File written!';
						}
					}*/
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
							//$this->session->set_userdata('newmemberId',$query);
							redirect('registration/registrationSuccess', '');
				}
			}
			/*else{
				$data['main_content']="frontend/boutiqueshop/registration";
         		$this->load->view('template', $data);
				}*/
		}
		$data['main_content']="frontend/boutiqueshop/registration";
        $this->load->view('template', $data);
	}
	
	
	
	
	
	public function registrationSuccess(){
		$data['title'] = 'Successfully Registration | Butikbd.com';
		$mid=$this->session->userdata('newmemberId');
		$data['footermenu']	= $this->Index_model->getAllMenu();
		$data['menu']	= $this->Index_model->getDataById('menu','root_id',0,'m_id','asc','');
		$data['allbutikshop']	= $this->Index_model->getDataById('boutiqueshop','active','1','user_id','desc','20');
		$data['member'] = $this->Index_model->getOneItemTable('customer','user_id',$mid,'user_id','desc');
		$data['main_content']="frontend/registrationSuccess";
        $this->load->view('template', $data);
	}
	
	
	

}

?>
