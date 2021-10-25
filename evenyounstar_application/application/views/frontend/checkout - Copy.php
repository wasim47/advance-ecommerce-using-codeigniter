<script>
function clear_cart() {
	var result = confirm('Are you sure want to clear all Shopping?');
	
	if(result) {
		window.location = "<?php echo base_url(); ?>cart/remove/all";
	}else{
		return false; // cancel button
	}
}


</script>
<script>
function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		return xmlhttp;
	}
	
	function getCity(strURL) {		
		var req = getXMLHTTP();
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('citydiv').innerHTML=req.responseText;
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
	}
	
		
</script>
<script type="text/javascript">
$(document).ready(function(){
		$('#userlogin').click(function(){
				$('#checkShipLogInfo').css('display','inline');	
				$('#checkShipRegInfo').css('display','none');	
		});
		$('#newregister').click(function(){
				$('#checkShipRegInfo').css('display','inline');	
				$('#checkShipLogInfo').css('display','none');	
		});
	
$(document).ready(function(){
		$('#shippingcheck').click(function () {
   		 $("#shippingArea").toggle(this.checked);
		});
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
<!--
<script type="text/javascript">
$(document).ready(function(){
	var bikash = document.getElementById('bikash');
	var credit_debit = document.getElementById('credit_debit');
	var payLater = document.getElementById('payLater');
	var payNow = document.getElementById('payNow');
		
		payLater.onclick = function(){
			document.getElementById("form1").action = '<?php echo base_url('registration/enterprise');?>';
			document.form1.submit();
		}
		
		payNow.onclick = function(){
			if(bikash.checked){
				var tranId = document.getElementById('trnasitionId').value;
				if(tranId!=""){
					document.getElementById("form1").action = '<?php echo base_url('registration/enterprise');?>';
					document.form1.submit();
				}
				else{
					alert("Please Input your Transition ID");
					}
			}
		else if(credit_debit.checked){
			document.getElementById("form1").action = 'https://www.sslcommerz.com.bd/process/index.php';
			document.form1.submit();
		}
		  else{
			 alert("Plese check one mathod");
			 return false;
		  }	
	}
});

</script>
-->
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
            
            
            
            
            <?php echo form_open('checkout/login', array('class'=>'form-horizontal','name'=>'form1','id'=>'form1')); ?>
            <?php if($this->session->flashdata('invalidmsg')){
					$cls='style="margin-top:20px; display:none"';
				}
				else{
					$cls='style="margin-top:20px;"';	
				}
				?>
            <div class="col-sm-12" <?php echo $cls;?> id="checkShipLogInfo">
				<div class="row">
					<div class="col-sm-6 col-lg-offset-1">
						<div class="bill-to">
							<p>Login Information</p>
							<div style="margin:10px 0px; padding:0; width:100%; float:left">
                           <div id="registration_form">
                             
                           
                            <div class="form-group">        
                                <?php echo $this->session->flashdata('invalidmsg');?>
                            </div>
                            <div class="form-group">        
                                <label class="control-label col-sm-3">Email <span style="color:#ff0000">*</span></label>
                              <input name="email" id="email" type="email"  class="form-control col-sm-7" style="width:70%"  required="required" 
                                                    value="<?php echo set_value('email'); ?>" placeholder="Email Address"/>
                                <?php echo form_error('email', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                            </div>
                            <div class="form-group">        
                                <label class="control-label col-sm-3">Password <span style="color:#ff0000">*</span></label>
                              <input name="password" class="form-control col-sm-7" style="width:70%"  type="password"  required="required"
                                                     value="<?php echo set_value('password'); ?>" placeholder="Password : xxxxxxxx"/>
                                                    <?php echo form_error('password', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                            </div>
                             <div class="form-group pull-right">        
                                  <input type="submit" name="userlogin" class="btn btn-primary" style="background:#066" value="Submit"/>
                            </div>
                            </div>
                
           </div>
						</div>
					</div>
                    <div class="col-sm-4"><?php include('checkoutTrolly.php');?></div>
				</div>
			</div>
            
			<?php echo form_close();?>
            
            
            
            
            <?php echo form_open_multipart('checkout/index', array('class'=>'form-horizontal','name'=>'form1','id'=>'form1')); ?>
            <div class="col-sm-12" style="margin-top:20px; display:none" id="checkShipRegInfo">
				<div class="row">
					<div class="col-sm-8">
						<div class="bill-to">
							<p>Customer Information</p>
							<div style="margin:10px 0px; padding:0; width:100%; float:left">
		   
                           <div id="registration_form">
                            <div class="form-group">
                           <div class="col-sm-3"></div>
                           <div class="col-sm-8">  
                           	 <div class="col-sm-2">    
                                <label class="control-label">Mr.</label>
                                <input type="radio" name="gender" value="Mr."  />
                            </div>
                            <div class="col-sm-2"> 
                             <label class="control-label">MS.</label>
                            <input type="radio" name="gender" value="MS."  />
                            </div>
                            
                            </div>
                        </div>
                             <div class="form-group">        
                                <label class="control-label col-sm-3">Full Name <span style="color:#ff0000">*</span></label>
                                  <input name="memberName" id="memberName" type="text"  class="form-control col-sm-7" style="width:70%"  required="required" value="<?php echo set_value('memberName'); ?>" placeholder="member Name"/>
                                <?php echo form_error('memberName', '<p style="color:#ff0000;margin:0;">','</p>'); ?>
                            </div>
                            
                            <div class="form-group">        
                                <label class="control-label col-sm-3">Mobile <span style="color:#ff0000">*</span></label>
                                   <input name="mobile" id="mobile" type="text"  class="form-control col-sm-7" style="width:70%"  required="required"
                                                     value="<?php echo set_value('mobile'); ?>" placeholder="Mobile No."/>
                                 <?php echo form_error('mobile', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                            </div>
                            
                            
                              
                <div class="form-group">        
                           
                         
                         
                    <label class="control-label col-sm-3">District </label>
                      <select name="district" id="district"  class="form-control col-sm-7" style="width:70%" 
                                       onChange="getCity('<?php echo base_url();?>registration/ajaxData?root_id='+this.value);">
                                   
                                    <option value="">Select Your District</option>
                                    <?php
                                    foreach($totaldistrict->result() as $row){
									$country_name=$row->district;
                                    ?>
                                    <option value="<?php echo $country_name; ?>"><?php echo ucfirst($country_name); ?></option>
                                    <?php
                                    }
                                    ?>
                                    </select>
                                    <?php echo form_error('country', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                </div>
                <div class="form-group">  
                <label class="control-label col-sm-3">Thana </label>      
                    <div id="citydiv">
                        <select name="thana" id="thana" class="form-control col-sm-7" style="width:70%" >
                             <option value="" style="text-transform:capitalize">Please Select Your Thana</option>
                        </select>
                         <?php echo form_error('city', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                        </div>
                </div>
                            
                            
                            
                            <div class="form-group">        
                                <label class="control-label col-sm-3">Address</label>
                                   <textarea name="address" rows="6" cols="40"  class="form-control col-sm-7" style="width:70%" placeholder="Mailing Address"></textarea>
                            </div>
                            
                           
                           
                           
                           
                            <div class="form-group">        
                                <label class="control-label col-sm-3">Email <span style="color:#ff0000">*</span></label>
                              <input name="email" id="email" type="email"  class="form-control col-sm-7" style="width:70%"  required="required" 
                                                    value="<?php echo set_value('email'); ?>" placeholder="Email Address"/>
                                <?php echo form_error('email', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                            </div>
                            <div class="form-group">        
                                <label class="control-label col-sm-3">Password <span style="color:#ff0000">*</span></label>
                              <input name="password" id="password" class="form-control col-sm-7" style="width:70%"  type="password"  required="required"
                                                     value="<?php echo set_value('password'); ?>" placeholder="Password : xxxxxxxx"/>
                                                    <?php echo form_error('password', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                            </div>
                            <div class="form-group">        
                                <label class="control-label col-sm-5">Different Shipping Address</label>
                              <input type="checkbox" name="shippingcheck" id="shippingcheck" value="1" style="margin-top:10px"  />
                                <?php echo form_error('email', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                            </div>
                            </div>
                
           </div>
						</div>
					</div>
                    <div class="col-sm-4"><?php include('checkoutTrolly.php');?></div>
                    <div class="col-sm-8" id="shippingArea" style="display:none">
						<div class="bill-to">
							<p>Shipping Information</p>
							<div style="margin:10px 0px; padding:0; width:100%; float:left">
               <div id="registration_form">
               	 <div class="form-group">        
                    <label class="control-label col-sm-3">Receiver Name </label>
                      <input name="shipName" id="shipName" type="text"  class="form-control col-sm-7" style="width:70%" value="<?php echo set_value('shipName'); ?>" placeholder="Receiver Name"/>
                    <?php echo form_error('shipName', '<p style="color:#ff0000;margin:0;">','</p>'); ?>
                </div>
               
                <div class="form-group">        
                    <label class="control-label col-sm-3">Mobile </label>
                       <input name="shipmobile" id="shipmobile" type="text"  class="form-control col-sm-7" style="width:70%" value="<?php echo set_value('mobile'); ?>" placeholder="Mobile No."/>
                     <?php echo form_error('shipmobile', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                </div>
                
                
                <div class="form-group">  
                <label class="control-label col-sm-3">District</label>      
                        <select name="shipcity" id="shipcity" class="form-control col-sm-7" style="width:70%" >
                             <option value="" style="text-transform:capitalize">District</option>
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
                    <label class="control-label col-sm-3">Area </label>
                       <input name="shiplocality" id="locality" type="text"  class="form-control col-sm-7" style="width:70%" 
                                         value="<?php echo set_value('locality'); ?>" placeholder="Area"/>
                </div>
                
                <div class="form-group">        
                    <label class="control-label col-sm-3">Address</label>
                       <textarea name="shipaddress" rows="6" cols="40"  class="form-control col-sm-7" style="width:70%" placeholder="Mailing Address"></textarea>
                </div>
                
                </div>
                
                
              
                
           </div>
						</div>
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
                      You have to make the bKash payment on our official bKash number 01922002381
                      Thanks for registration as a customer at butikbd.com <br />
                      Once the payment is confirmed and clear by bKash then inform us about this transaction.<br />
                      Plese input here your <strong>Valid Transition ID</strong> after payment 
                      <input type="text" name="trnasitionId" id="trnasitionId" 
                      style="width:200px; margin:0 0 10px 5px; border:1px solid #999" />
                      <input type="hidden" name="price" id="price" style="width:200px; margin-left:5px" value="<?php echo $grandTotalPrice;?>" />
                                </div>
                   
           </div>
         		<div class="col-sm-12" style="margin-top:20px; text-align:center">
           		<div class="form-group">        
                     <input type="reset" name="registerpayLater" class="btn btn-primary" value="Cancel"/>
                      <input type="submit" name="registerpayNow" class="btn btn-primary" style="background:#066" value="Submit"/>
                </div>
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