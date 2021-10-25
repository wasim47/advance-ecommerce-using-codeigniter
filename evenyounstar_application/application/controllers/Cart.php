<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Cart_model');
		$this->load->model('Index_model');
		//$this->load->library('cart');
		
	}

	function index()
	{	
		$data['title']	= 'Shopping Cart';
		$data['footermenu']	= $this->Index_model->getDataById('menu','root_id','0','sequence','desc','');
		if (!$this->cart->contents()){
			$this->data['message'] = '<p>Your cart is empty!</p>';
		}else{
			$this->data['message'] = $this->session->flashdata('message');
		}
		$this->session->set_flashdata('cartMsg', '<div class="alert alert-success">Your Item added into Shopping Cart</div>');
		redirect($_SERVER['HTTP_REFERER']);
		/*$data['menu']	= $this->Index_model->getDataById('menu','root_id',0,'m_id','asc','');
		$data['allbutikshop']	= $this->Index_model->getNotIdData('boutiqueshop','','','','','user_id','desc','');
		$data['main_content']="frontend/shopping_cart";
        $this->load->view('template', $data);*/
	}

	function shopping_cart()
	{
		$data['footermenu']	= $this->Index_model->getDataById('menu','root_id','0','sequence','desc','');
		$data['title']	= 'Shopping Cart';
		$data['message']	= '<p>Your cart is empty!</p>';
		$data['menu']	= $this->Index_model->getDataById('menu','root_id',0,'m_id','asc','');
		$data['allbutikshop']	= $this->Index_model->getNotIdData('boutiqueshop','','','','','user_id','desc','');
		//$data['search_kewwords']	= $this->Index_model->search_kewwords();
		$data['main_content']="frontend/shopping_cart";
        $this->load->view('template', $data);
	}
			
	
	function view_trolly()
	{
		$data['footermenu']	= $this->Index_model->getDataById('menu','root_id','0','sequence','desc','');
		$data['page_title']	= 'View Trolly';
		$data['message']	= '<p>Your cart is empty!</p>';
		$this->load->view('frontend/viewTrolly', $data);
	}
	
	function add()
	{
		if($this->input->post('productQuantity')!=""){
			$qty=$this->input->post('productQuantity');	
		}
		else{
			$qty=1;
		}
		$insert_room = array(
			'id'=> $this->input->post('id'),
			'name'=> preg_replace("/'/", '', $this->input->post('name')),
			'price' => $this->input->post('price'),
			'qty' => $qty,
			'options' => array(
					'shipment' => $this->input->post('shipment'))
		     );		
		$this->cart->insert($insert_room);
		redirect('cart');
	}
	
	function remove($rowid) {
		if ($rowid=="all"){
			$this->cart->destroy();
			redirect('index');
		}else{
			$data = array(
				'rowid'   => $rowid,
				'qty'     => 0
			);

			$this->cart->update($data);
			redirect('cart');
		}
		
		
	}	

	function update_cart(){
 		foreach($_POST['cart'] as $id => $cart)
		{			
			$price = $cart['price'];
			$amount = $price * $cart['qty'];
			
			$this->Cart_model->update_cart($cart['rowid'], $cart['qty'], $price, $amount);
		}
		
		redirect('cart');
	}

}