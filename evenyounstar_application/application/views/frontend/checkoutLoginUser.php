<script>
function clear_cart() {
	var result = confirm('Are you sure want to clear all Shopping?');
	
	if(result) {
		window.location = "<?php echo base_url(); ?>cart/remove/all";
	}else{
		return false; // cancel button
	}
}
$(document).ready(function(){
	/*$('#shippingcheck').click(function(){
		if($('#shippingcheck').checked){
			$('#shippingArea').slideDown('slow');
		}
		else{
			$('#shippingArea').slideUp('slow');	
		}
			
	});*/
	
	$('#shippingcheck').click(function () {
   	 $("#shippingArea").toggle(this.checked);
	});
	
	
});
</script>
<script type="text/javascript">
function paymentImage(val){
	if(val=='bKash'){
		document.getElementById('bkashCon').style.display='block';
	}
	else if(val=='Cash on Delivery'){
		document.getElementById('bkashCon').style.display='none';
	}
}

</script>
<?php
if($shipQuery->num_rows() > 0){
foreach($shipQuery->result() as $shipVal);
	$shipname = $shipVal->name;
	$shipemail = $shipVal->email;
	$shipmobile = $shipVal->contact;
	$shipzipcode = $shipVal->zipcode;
	$shipcity = $shipVal->city;
	$shiplocality = $shipVal->locality;
	$shipaddress = $shipVal->address;
}
else{
	$shipname = '';
	$shipemail = '';
	$shipzipcode = '';
	$shipcity = '';
	$shiplocality = '';
	$shipaddress = '';
	$shipmobile="";
}
?>
<section id="cart_items">
		<div class="container">
        <div class="row middlecontainer">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="col-sm-12" style="background:#F7F5EE; padding:10px; text-align:center">
            	<div class="col-sm-3">&nbsp;</div>
                <div class="col-sm-2"><label><input type="radio" name="regisType" id="userlogin" value="Login"> Have a Account ?</label></div>
            	<div class="col-sm-2"><label><input type="radio" name="regisType" id="newregister" value="Register"> Create New Account</label></div>
                <div class="col-sm-2"><a href="javascript:void()" onclick="clear_cart();"><i class="fa fa-times"></i>Cancel</a></div>
               
			</div>
            
            
            <?php echo form_open_multipart('checkout/ordersubmitted', array('class'=>'form-horizontal','name'=>'form1','id'=>'form1')); ?>
            <div class="col-sm-12" style="margin-top:20px;">
				<div class="row">
                    <div class="col-sm-8">
						<div class="bill-to">
							<p>Shipping Information</p>
							<div style="margin:10px 0px; padding:0; width:100%; float:left">
               <div id="registration_form">
               	 <div class="form-group">        
                    <label class="control-label col-sm-3">Receiver Name </label>
                      <input name="shipName" id="shipName" type="text"  class="form-control col-sm-7" style="width:70%" value="<?php echo $shipname; ?>" placeholder="Receiver Name"/>
                    <?php echo form_error('shipName', '<p style="color:#ff0000;margin:0;">','</p>'); ?>
                </div>
               
                <div class="form-group">        
                    <label class="control-label col-sm-3">Mobile</label>
                       <input name="shipmobile" id="shipmobile" type="text"  class="form-control col-sm-7" style="width:70%"  value="<?php echo $shipmobile; ?>" placeholder="Mobile No."/>
                     <?php echo form_error('shipmobile', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                </div>
                
                
                <div class="form-group">  
                <label class="control-label col-sm-3">District</label>      
                        <select name="shipcity" id="shipcity" class="form-control col-sm-7" style="width:70%" >
                             <option value="<?php echo $shipcity;?>" style="text-transform:capitalize"><?php echo $shipcity;?></option>
                              <?php
                                    foreach($countryAll->result() as $row){
									$country_name=$row->name;
									$country_id=$row->location_id;
                                    ?>
                                    <option value="<?php echo $country_id; ?>"><?php echo ucfirst($country_name); ?></option>
                                    <?php
                                    }
                                    ?>
                        </select>
                         <?php echo form_error('shipcity', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                </div>
                <div class="form-group">        
                    <label class="control-label col-sm-3">Area</label>
                       <input name="shiplocality" id="locality" type="text"  class="form-control col-sm-7" style="width:70%" 
                                         value="<?php echo $shiplocality;?>" placeholder="Area"/>
                </div>
                
                <div class="form-group">        
                    <label class="control-label col-sm-3">Address</label>
                       <textarea name="shipaddress" rows="6" cols="40"  class="form-control col-sm-7" style="width:70%" placeholder="Mailing Address"><?php echo $shipaddress;?></textarea>
                </div>
                
                </div>
                
                
                
                
                
                
                
           </div>
						</div>
					</div>
                    <div class="col-sm-4"><?php include('checkoutTrolly.php');?></div>
									
				</div>
			</div>
           <div class="col-sm-12" style="margin-top:20px; text-align:center">
           		   <div class="form-group">
                        <label class="control-label col-sm-3">bKash Payment</label>
                        <input type="radio" name="paymentMethod"  class="col-sm-1" required value="bKash" id="bkash_mathod"  onclick="paymentImage(this.value);" >
                        
                       <label class="control-label col-sm-3">Cash on Delivery</label>
                        <input type="radio" name="paymentMethod" required  class="col-sm-1" value="Cash on Delivery"  onclick="paymentImage(this.value);" >
                   </div>
                   <div style="width:100%; margin:auto; float:left; text-align:left; display:none" id="bkashCon">
                       <strong>Dear valuable customer,</strong><br />
                      You have to make the bKash payment on our official bKash number 0168205718
                      Thanks for registration as a enterprise at digibook.com.bd <br />
                      Once the payment is confirmed and clear by bKash then inform us about this transaction.<br />
                      Plese input here your <strong>Valid Transition ID</strong> after payment 
                      <input type="text" name="trnasitionId" id="trnasitionId" 
                      style="width:200px; margin:0 0 10px 5px; border:1px solid #999" />
                      <input type="hidden" name="price" id="price" style="width:200px; margin-left:5px" value="3000" />
                                </div>
                   <div class="form-group">        
                         <input type="reset" name="registerpayLater" class="btn btn-primary" value="Cancel"/>
                          <input type="submit" name="registerpayNow" class="btn btn-primary" style="background:#066" value="Submit"/>
                    </div>
           </div>
           <?php
            $order_q=$this->db->query("select * from orders order by order_id desc limit 1");
			if($order_q->num_rows() > 0){
				foreach($order_q->result() as $ord);
				$orderN=$ord->order_number;
					$orderNum=$orderN+1;
			}
			else{
				$orderNum=1111;
			}
            ?>
            <input type="hidden" name="order_number" value="<?php echo $orderNum;?>" />
            <input type="hidden" name="total_price" value="<?php echo $grandTotalPrice;?>" />
         <?php echo form_close();?>   
</div>
		</div>
	</section>