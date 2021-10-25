
<script type="text/javascript">
function dateCount(mtype){
			var memberPrice
			var today = new Date();
			var dd = today.getDate();
			var mm = today.getMonth()+1; //January is 0!
			var yyyy = today.getFullYear();
			if(dd<10) {
				dd='0'+dd
			} 
			
			if(mm<10) {
				mm='0'+mm
			}
			
			document.getElementById('joinDate').value = yyyy+'-'+mm+'-'+dd;
			
			if(mtype=="1 Year"){
				yyyy =+ parseInt(yyyy) + 1;
				memberPrice = 700;
				document.getElementById('membertrialtime').style.display='none';
			}
			else if(mtype=="2 Year"){
				yyyy =+ parseInt(yyyy) + 2;
				memberPrice = 1200;
				document.getElementById('membertrialtime').style.display='none';
			}
			else if(mtype=="5 Year"){
				yyyy =+ parseInt(yyyy) + 5;
				memberPrice = 3000;
				document.getElementById('membertrialtime').style.display='none';
			}
			else if(mtype=="trial"){
				memberPrice = 'Free Trial';
				document.getElementById('membertrialtime').style.display='inline';
			}
			today = yyyy+'-'+mm+'-'+dd;
		
			if(mtype!="Life Time"){
				document.getElementById('expDate').value = today;
				document.getElementById('memberFee').value = memberPrice;	
			}
			else{
				document.getElementById('expDate').value = mtype;
				document.getElementById('memberFee').value = 10000;
			}
}

function memberId(mid){
		document.getElementById('member_id').value=mid;
}
</script>
<!--<script type="text/javascript">
   function checkUsername(){
		var email_val = $("#email").val();
		if(email_val.length>0){
		var filter = /^[a-zA-Z0-9-_.]+$/;
		if(filter.test(email_val)){
				$('#loading').show();
				var jsonurl = "<?php echo base_url('Membership/email_check')?>?email="+email_val;
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
		 alert('\t\tInvalid Email ! You can`t use any special character.\n Email pattern should be Alphabet or Alphanumeric or dash or Underscore');	
		 document.getElementById('email').value="";
		 document.getElementById('email').select();
		}
		}
		else{
		 alert('User name can not be empty!\n Please Input a valid Email');	
			}
			return false;
   }
   
   function transitionid(inputtxt)  
    {  
	  var phoneno = /^\d{11}$/;  
      if(inputtxt.value.match(phoneno))  
         {  
		  return true;
         }  
       else
         {  
           alert("Not a valid Phone Number. Just input your phone number");
		   inputtxt.value="";
		   return true;
         }  
    } 
</script>-->
<div class="right_col" role="main">
  <div>
     <div class="page-title">
                        <div class="title_left">
                            <h3>New Membership</h3>
                        </div>
                        
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">




    





                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2> Membership Form</h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                <?php echo form_open_multipart('ouradminmanage/membership_action', 'class="form-horizontal form-label-left"');?>
                                   <div id="registration_form">	
                                  	  <div class="panel-group" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                 <h4 class="panel-title">
                                                   Boutique Shop Information </h4>
                                                 </a>
                                            </div>
                                            
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="panel-body">
  
  
  
  
  													 <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Member Name 
                                                        <span style="color:#ff0000">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="hidden" id="member_id" name="member_id" value="<?php echo set_value('member_id'); ?>" />
                    <?php echo form_error('member_id', '<p style="color:#ff0000;margin:0;">','</p>'); ?>
                      <select name="memberName" id="memberName" class="form-control col-md-7 col-xs-12" onchange="memberId(this.value);">
                          <option value="">Member Name</option>
                          <?php
                             foreach($boutiqueshop->result() as $boutiRow){
                             $bouId=$boutiRow->urlname;
                             $shopname=$boutiRow->username;
                          ?>
                              <option value="<?php echo $bouId; ?>"><?php echo $shopname; ?></option>
                          <?php
                          }
                          ?>
                      </select>
                      <?php echo form_error('memberName', '<p style="color:#ff0000;margin:0;">','</p>'); ?>
                    </div>								
                </div>
                
                
                
                
                
  														<div class="form-group">
                                                                 <label class="control-label col-md-3 col-sm-3 col-xs-12">Membership Duration<span style="color:#ff0000">*</span></label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                         <select name="member_type"  class="form-control col-md-7 col-xs-12" onchange="dateCount(this.value)" required>
                                                                      <option value="">Membership Duration</option>
                                                                      <option value="trial">Free Trial</option>
                                                                      <option value="1 Year">1 Year</option>
                                                                      <option value="2 Year">2 year</option>
                                                                      <option value="5 Year">5 year</option>
                                                                      <option value="Life Time">Life Time</option>
                                                                  </select>
                                                                  <?php echo form_error('member_type', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                                </div>								
                                                            </div>		
                                                 			 <div class="form-group">
                                                                 <label class="control-label col-md-3 col-sm-3 col-xs-12">Joining Date</label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                  <input type="text" name="joinDate" id="joinDate" class="form-control col-md-7 col-xs-12"  value="<?php echo set_value('joinDate'); ?>" readonly="readonly">
                                                                </div>								
                                                            </div>
                                                             <div class="form-group">
                                                                 <label class="control-label col-md-3 col-sm-3 col-xs-12">Expiration Date</label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                  <input type="text" name="expDate" id="expDate"  class="form-control col-md-7 col-xs-12"  value="<?php echo set_value('expDate'); ?>" readonly="readonly">
                                                                </div>								
                                                            </div>
                                                             <div class="form-group">
                                                                 <label class="control-label col-md-3 col-sm-3 col-xs-12">Membership Fee<span style="color:#ff0000">*</span></label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                  <input type="text" name="memberFee" id="memberFee"  class="form-control col-md-7 col-xs-12"  value="<?php echo set_value('memberFee'); ?>" placeholder="Membership Fee">
                                                                  
                                                                  
                                                                  <?php echo form_error('memberFee', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                                </div>								
                                                            </div>
                                                            
                                                            
                                                            <div class="form-group" id="membertrialtime" style="display:none">
                                                                 <label class="control-label col-md-3 col-sm-3 col-xs-12">Trial Duration<span style="color:#ff0000">*</span></label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                  
                                                                  <input type="text" name="membertrialtime" class="form-control col-md-7 col-xs-12"  value="<?php echo set_value('membertrialtime'); ?>" placeholder="Trial Duration" style="margin-bottom:10px;">
                                                                  
                                                                </div>								
                                                            </div>	
                                                            
                                                            <div class="form-group">
                                                                 <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Quota<span style="color:#ff0000">*</span></label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                  <input type="text" name="product_quota" id="product_quota"  class="form-control col-md-7 col-xs-12"  value="<?php echo set_value('product_quota'); ?>" placeholder="Product Quota">
                                                                  <?php echo form_error('product_quota', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                                </div>								
                                                            </div>
                                                             <div class="form-group">
                                                                 <label class="control-label col-md-3 col-sm-3 col-xs-12"> Picture Gallery</label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                  <select name="pictureGallery" class="form-control">
                                                                      <option value="Enable">Enable</option>
                                                                      <option value="Disable">Disable</option>
                                                                  </select>
                                                                </div>								
                                                            </div>
                                                             <div class="form-group">
                                                                 <label class="control-label col-md-3 col-sm-3 col-xs-12"> Banner Slider</label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                  <select name="publication" class="form-control">
                                                                      <option value="Enable">Enable</option>
                                                                      <option value="Disable">Disable</option>
                                                                  </select>
                                                               </div>								
                                                            </div>		
                                                 			 <div class="form-group">
                                                                 <label class="control-label col-md-3 col-sm-3 col-xs-12"> Total Templates</label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                               <select name="templates" class="form-control">
                                                                       <option value="1">1</option>
                                                                       <option value="5">5</option>
                                                                       <option value="10">10</option>
                                                                      <option value="20">20</option>
                                                                  </select>
                                                                </div>								
                                                            </div>
                                                             <div class="form-group">
                                                                 <label class="control-label col-md-3 col-sm-3 col-xs-12">Payment Method </label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                  <select name="pmathod" class="form-control col-md-7 col-xs-12" >
                                                                      <option value="bKash">bKash</option>
                                                                      <option value="cash">Cash</option>
                                                                      <option value="Credit Card">Credit Card</option>
                                                                  </select>
                                                                </div>								
                                                            </div>
                                                             <div class="form-group">
                                                                 <label class="control-label col-md-3 col-sm-3 col-xs-12"> Transition Id </label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                   <input type="text" name="trnasitionId" id="trnasitionId" onchange="transitionid(document.registrationForm.trnasitionId);" onblur="transitionid(document.registrationForm.trnasitionId)"  class="form-control col-md-7 col-xs-12" >
                                                                </div>								
                                                            </div>
                                                            <div class="form-group">
                                                                 <label class="control-label col-md-3 col-sm-3 col-xs-12"> Payment By  </label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                  <input type="text" name="payBy"class="form-control col-md-7 col-xs-12" >
                                                                </div>								
                                                            </div>
                                                             
                                                             <div class="form-group">
                                                                 <label class="control-label col-md-3 col-sm-3 col-xs-12"> Receive By  </label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                  <select name="recBy" class="form-control col-md-7 col-xs-12" >
                                                                     <option value="MD Wasim">MD Wasim</option>
                                                                  </select>
                                                                </div>								
                                                            </div>
                                                            </div>
                                            </div>
                                        </div>
                                        
                               	     </div>
                                   </div> 
                                    
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <input type="reset" class="btn btn-primary" value="Reset">
                                            <input type="submit" name="registration" class="btn btn-success" value="Submit">
                                        </div>
                                    </div>
                               <?php echo form_close();?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('.date-picker').daterangepicker({
                                singleDatePicker: true,
                                calender_style: "picker_4"
                            }, function (start, end, label) {
                                console.log(start.toISOString(), end.toISOString(), label);
                            });
                        });
                    </script>

                </div>
               