<script>
function clear_cart() {
	var result = confirm('Are you sure want to clear all bookings?');
	
	if(result) {
		window.location = "<?php echo base_url(); ?>cart/remove/all";
	}else{
		return false; // cancel button
	}
}
</script>
<section id="cart_items">
<div class="container">
			<div class="breadcrumbs" style="padding:0px; margin:0px;">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
         </div>
<?php 
 if ($cart = $this->cart->contents()){
if($this->session->userdata('memberMail'))
        {
        $url='checkout/insert_product';
        }
        else{
        $url='checkout/form';
        }
   echo form_open_multipart($url, array('class'=>'form-horizontal','role'=>'form'));?>
		<div class="container">
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
		<?php
        $grand_total = 0; $i = 1;
        //echo form_open('cart/update_cart');
        foreach ($cart as $item):
        echo form_hidden('cart['. $item['id'] .'][id]', $item['id']);
		echo form_hidden('cart['. $item['id'] .'][rowid]', $item['rowid']);
		echo form_hidden('cart['. $item['id'] .'][name]', $item['name']);
		echo form_hidden('cart['. $item['id'] .'][price]', $item['price']);
		echo form_hidden('cart['. $item['id'] .'][qty]', $item['qty']);
		$grand_total = $grand_total + $item['subtotal'];
		$productAllId[] = $item['id'];
		$qty[] = $item['qty'];
		$unitPrice[] = $item['price'];
		$subtotal[] = $item['subtotal'];
		$shippment_val = $item['options']['shipment'];
		$shippment_total_val[] = $shippment_val;
		
		$pro_id=$item['id'];
		 $result=$this->db->query("select * from product where product_id='$pro_id'");
		 $resPro=$result->result();
		 foreach($resPro as $pro);
		 $product_id=$pro->product_id;
		 $main_image=$pro->main_image;
		 $pro_code=$pro->pro_code;	
	?>       
						<tr>
							<td class="cart_product">
								<a href="<?php echo base_url();?>index/product_details/<?php echo $product_id;?>">
                          <img src="<?php echo base_url()?>uploads/images/product/main_img/<?php echo $main_image;?>" alt="<?php echo $item['name'];?>" style="width:60px; height:60px;"/>
                        </a>
							</td>
							<td class="cart_description">
								<h4><a href=""><?php echo $item['name'];?></a></h4>
								<p>Product ID: <?php echo $pro_code;?></p>
							</td>
							<td class="cart_price">
								<p><?php echo 'BDT '.$item['price'].' Tk';?></p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href=""> + </a>
                                    <?php echo form_input('cart['. $item['id'] .'][qty]', $item['qty'], 'maxlength="5" size="1" class="cart_quantity_input" style="text-align: center;border:none"'); ?>
									<a class="cart_quantity_down" href=""> - </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price"><?php echo 'BDT '.$item['subtotal'].' TK';?></p>
							</td>
							<td class="cart_delete">
                                <a class="cart_quantity_delete" href="<?php echo base_url('cart/remove/'.$item['rowid']); ?>" style="cursor:pointer; overflow:hidden; text-decoration:none"><i class="fa fa-times"></i></a>
							</td>
						</tr>
            <input type="hidden" value="<?php echo $item['id'];?>" name="product_id<?php echo $i;?>" />
            <input type="hidden" value="<?php echo $item['qty'];?>" name="qty<?php echo $i;?>" />
            <input type="hidden" value="<?php echo $item['price'];?>" name="unit_price<?php echo $i;?>" />
            <input type="hidden" value="<?php echo $item['subtotal'];?>" name="sub_total<?php echo $i;?>" />
            <input type="hidden" value="<?php echo $shippment_val;?>" name="shipment<?php echo $i;?>" />
       		<?php   endforeach; ?>
                            
						
					</tbody>
				</table>
			</div>
		<?php
        $pro_array = join(',', $productAllId);
        if($shippment_val!=""){
            $total_shipment = array_sum($shippment_total_val).' TK';
            }
            else{
                $total_shipment = "Free";
            }
            $grandTotalPrice = $grand_total+$total_shipment;
        ?>
        <input type="hidden" value="<?php echo $pro_array;?>" name="productId" />
		</div>
        <section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span><?php echo number_format($grand_total,2); ?></span></li>
							<li>Eco Tax <span>$2</span></li>
							<li>Shipping Cost <span><?php echo $total_shipment;?></span></li>
							<li>Total <span><?php echo number_format($grandTotalPrice,2);?></span></li>
						</ul>
							<a class="btn btn-default update" onClick="clear_cart()">Cencel Shopping</a>
                            <button type="submit" class="btn btn-default check_out">Check Out</button>
					</div>
				</div>
			</div>
		</div>
	</section>
 <?php
 echo form_close();
 }
 else{
echo '<div class="main" style="float:left; text-align:center"><h2 style="padding:60px; color:red;">Your Shopping Cart Is Empty</h2></div>';
}
?>
</section>
