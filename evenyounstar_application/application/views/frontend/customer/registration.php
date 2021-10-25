<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.js"></script>
<link href="<?php echo base_url()?>assets/css/front/us_style.css" rel="stylesheet" type="text/css" />

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
   function checkUsername(){
		var email_val = $("#username").val();
		//alert(email_val);
		if(email_val.length>0){
		var filter = /^[a-zA-Z0-9-_]+$/;
		if(filter.test(email_val)){
				$('#loading').show();
				var jsonurl = "<?php echo base_url('registration/email_check')?>?username="+email_val;
				$.ajaxSetup({
					cache: false
				});
				$.ajax({
					   type: "GET",
					   url: jsonurl,
					   dataType: 'json',
					   data: {},
					   success: function(data) {
						  $('#loading').hide();
						  $('#message').html(data.message).show().delay(10000).fadeOut();
						  $('.errorColor').css({ 'color':  data.color});
					   }
				});
		}
		else{
		 alert('\t\tInvalid user name ! You can`t use any special character and Dot.\n Username pattern should be Alphabet or Alphanumeric or dash or Underscore');	
		 document.getElementById('username').value="";
		 document.getElementById('username').select();
		}
		}
		else{
		 alert('User name can not be empty!\n Please Input a valid Username');	
			}
			return false;
   }
</script>

		<div class="container">
			<div class="row middlecontainer">
				<div class="col-sm-3">
					<?php $this->load->view("frontend/product_category.php");?>
				</div>
				
				<div class="col-sm-9">
               	 <div class="form-group">        
                   <h3>Customer Registration</h3>
                </div>
					<div style="margin:10px 0px; padding:0; width:100%; float:left">
		   <?php echo form_open_multipart('', array('class'=>'form-horizontal','name'=>'form1','id'=>'form1')); ?>
            		<input type="hidden" name="store_id" value="bipsorglive@ssl" />
                    <input type="hidden" name="success_url" value="<?php echo base_url();?>checkout/success_full?massage=successfull" />
                    <input type="hidden" name="fail_url" value="<?php echo base_url();?>checkout/success_full?massage=fail" />
                    <input type="hidden" name="cancel_url" value="<?php echo base_url();?>checkout/success_full?massage=cancel" />
               <div id="registration_form">
                 
               	 <div class="form-group">        
                    <label class="control-label col-sm-3">Title <span style="color:#ff0000">*</span></label>
                       <label class="control-label">Mr. &nbsp;</label><input type="radio" name="gender" value="Mr."  />&nbsp;&nbsp;&nbsp;
					  <label class="control-label">MS. &nbsp;</label><input type="radio" name="gender" value="MS."  />             
                    </div>
                
                
                <div class="form-group">        
                    <label class="control-label col-sm-3">Customer Name <span style="color:#ff0000">*</span></label>
                      <input name="memberName" id="memberName" type="text"  class="form-control col-sm-7" style="width:70%"  required="required" value="<?php echo set_value('memberName'); ?>" placeholder="Customer Name"/>
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
                        <select name="thana" id="thana" class="form-control" style="width:70%" >
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
                </div>
                
                
                <div class="form-group">        
                     <input type="reset" name="registerpayLater" class="btn btn-primary" value="Cancel"/>
                      <input type="submit" name="registerpayNow" class="btn btn-primary" style="background:#066" value="Submit"/>
                </div>
                
           <?php echo form_close(); ?> 
           </div>
				</div>
			</div>
		</div>
