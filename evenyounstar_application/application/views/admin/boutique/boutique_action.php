<?php
if($boutiqueUpdate->num_rows()>0){
	foreach($boutiqueUpdate->result() as $boutiqueshop);
		$boutiqueshop_id=$boutiqueshop->user_id;
		$image=$boutiqueshop->photo;
		$boutiqueshop_name=$boutiqueshop->username;
		$mobile=$boutiqueshop->mobile;
		$ownername=$boutiqueshop->ownername;
		$address=$boutiqueshop->address;
		$telephone=$boutiqueshop->telephone;
		$mobile=$boutiqueshop->mobile;
		$fax=$boutiqueshop->fax;
		$email=$boutiqueshop->email;
		$passwordHints=$boutiqueshop->passwordHints;
		$website=$boutiqueshop->website;
		$urlname=$boutiqueshop->urlname;
}
else{
		$boutiqueshop_id='';
		$image='';
		$boutiqueshop_name='';
		$mobile='';
		$ownername='';
		$address='';
		$telephone='';
		$mobile='';
		$fax='';
		$email='';
		$passwordHints='';
		$website='';
		$urlname='';
}
?>
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
		 alert('\t\t আপনার URL সঠিক নই। আপনার URL নির্বাচনে নিম্নোক্ত নীতিমালা অনুসরণ করুন');	
		 document.getElementById('username').value="";
		 document.getElementById('username').select();
		}
		}
		else{
		 alert('\tআপনার URL খালি রাখতে পারবেন না \n অনুগ্রহ করে আপনার শপ URL টাইপ করুন।');	
			}
			return false;
   }
</script>
<script type="text/javascript">
function paymentImage(val){
	if(val=='bKash'){
		document.getElementById('bkashCon').style.display='block';
		document.getElementById('freetrial').style.display='none';
	}
	else if(val=='Free trial'){
		document.getElementById('bkashCon').style.display='none';
		document.getElementById('freetrial').style.display='block';
	}
}

</script>	
<div class="right_col" role="main">
  <div>
     <div class="page-title">
                        <div class="title_left">
                            <h3>Boutiqueshop Registration Details</h3>
                        </div>
                        
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">




    





                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Boutiqueshop Registraion Form</h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                <?php echo form_open_multipart('', 'class="form-horizontal form-label-left"');?>
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
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"> Shop Name: <font color="#FF0000">&nbsp;*</font></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="boutiqueshop_name" id="boutiqueshop_name" value="<?php echo $boutiqueshop_name;?>" class="form-control col-md-7 col-xs-12" type="text"  required="required"/>
                                    </div>
                              </div>
                              
                              
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"> Shop Address : <font color="#FF0000">&nbsp;*</font></label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                    <textarea name="address" class="form-control ckeditor" rows="6" cols="40"  required="required"><?php echo $address;?></textarea>
                                    </div>
                              </div>
                              
                              
                              
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"> Logo: <font color="#FF0000">&nbsp;*</font> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12"><input type="file" class="form-control col-md-7 col-xs-12" name="companyLogo" id="file"/>
                                   </div>
                              </div>
                                  
                                  <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Telephone: </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input name="telephone" id="telephone" value="<?php echo $telephone;?>" class="form-control col-md-7 col-xs-12"  type="text"/>
                                        </div>
                                  </div>
                                  <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Mobile: </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input name="mobile" id="mobile" type="number" maxlength="15" value="<?php echo $mobile;?>" class="form-control col-md-7 col-xs-12" />
                                        </div>
                                  </div>
                                   
                                  <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Web Address: </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input name="website" id="website" class="form-control col-md-7 col-xs-12" value="<?php echo $website;?>" type="text"/>
                                        </div>
                                  </div>
                                  <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Owner Name: </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input name="editor" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo $ownername;?>"/>
                                        </div>
                                  </div>
                                  
                                   <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Email: </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input name="email" id="email" class="form-control col-md-7 col-xs-12"  value="<?php echo $email;?>" type="email"/>
                                        </div>
                                  </div>
                                  <?php
                                  //if($boutiqueUpdate->num_rows()==0){
								  ?>
                                  <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Url Name: </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input name="urlname" id="username" class="form-control col-md-7 col-xs-12"  style="width:47%; float:left"  type="text"  required="required" onblur="checkUsername()"  
                                        value="<?php echo $urlname;?>" placeholder="Url Name"/>
                                        
                                        <input type="button" onclick="checkUsername()" value="Check Availablity" style="float:left; font-weight:bold; width:auto; padding:5px;" />
                   <div id="message" class="errorColor" style="width:100%; float:left; text-align:left"></div>
                    <span id="loading" style="display:none">
                    <img src="<?php echo base_url(); ?>assets/images/front/loader.gif" alt="Ajax Indicator"  width="30" height="30" /></span> 
                  <small style="line-height:15px; margin-top:5px; float:left; text-align:left; font-size:11px;"> Username is unique. You never can change it after registered.
                  <br />You can't use any special character and Dot.Username pattern should be <strong>Alphabet or Alphanumeric or dash or Underscore</strong></small>
                  
                                        <?php echo form_error('urlname', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                        </div>
                                  </div>
                                  <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Password: </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input name="password" id="password" class="form-control col-md-7 col-xs-12"  type="text" value="<?php echo $passwordHints;?>"  required="required"/>
                                        </div>
                                  </div>
                                  <?php
								  //}
								  ?>
                                   <div class="form-group">
                   <div class="col-sm-7 col-sm-offset-3">
                        <input type="radio" name="reg_status" required value="bKash" id="bkash_mathod"  onclick="paymentImage(this.value);" >&nbsp;
                        বিকাশ&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="reg_status" required  value="Free trial"  onclick="paymentImage(this.value);" >&nbsp;
                        ১৫ দিনের জন্য ফ্রী
                        </div>
                   </div>
                 				   <div class="form-group">
                  	 <div class="col-sm-7 col-sm-offset-3"  style="text-align:left;font-family:SolaimanLipi; display:none" id="freetrial">
                       <strong>প্রিয় গ্রাহক,</strong><br />
                       Butikbd.com এর ফ্রী প্যাকেজ নির্বাচনের জন্য আপনাকে ধন্যবাদ।<br>
                       Butikbd.com এর পক্ষ থেকে আপনি পাচ্ছেন ১৫ দিনের জন্য ফ্রী ব্যবহারের সুবিধা। কোন প্রকার রেজিস্ট্রেশান ফী ব্যতিত আপনি আপনার শপ তৈরি করতে পারেন।<br>
                       আপনার শপের মেয়াদ থাকবে সর্বোচ্চ ১৫ দিন। <br>আপনার শপের মেয়াদ থাকবে
					  <strong> <?php
					   include('bangladate.php');
					   $currentDat=date('Y-m-d', strtotime('+15 days'));
					   $convertedDATE = str_replace($engDATE, $bangDATE, $currentDate);
					   echo $convertedDATE;?></strong> পর্যন্ত<br><br>
                     <center><strong style="font-size:18px;"> Butikbd-র সদস্য হওয়ার জন্য আপনাকে অভিনন্দন </strong></center>
                                </div>
                     <div class="col-sm-7 col-sm-offset-3"  style="text-align:left;font-family:SolaimanLipi; display:none" id="bkashCon">
                       <strong>প্রিয় গ্রাহক,</strong><br />
                      আপনি যদি Butikbd.com এ আপনার শপ তৈরি করতে আগ্রহী থাকেন তবে আপনাকে রেজিস্ট্রেশান ফী হিসেবে Butikbd কর্তৃক নির্ধারিত মুল্য ৭০০ টাকা পরিশোধ করতে হবে.<br />
                      আপনি বিকাশের মাধ্যমে আমাদের কাছে আপনার মুল্য পরিশোধ করতে পারেন<br>
                      আমাদের বিকাশ নাম্বার (Personal) ০১৯২২০০২৩৮১.<br>
                      আপনার মুল্য পরিশোধ করার পর আপনার বিকাশ Transition ID এখানে টাইপ করুন অথবা আমাদের বিকাশ নাম্বারে আপনার নাম সহ Tansition ID SMS করতে পারেন&nbsp;&nbsp;<input type="text" name="trnasitionId" id="trnasitionId" style="width:200px; margin:0 0 10px 5px; border:1px solid #999" />
                      <input type="hidden" name="price" id="price" style="width:200px; margin-left:5px" value="1000" /><br><br>
                     <center><strong style="font-size:18px;"> Butikbd-র সদস্য হওয়ার জন্য আপনাকে অভিনন্দন </strong></center>
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
                                       <input type="hidden" name="boutiqueshop_id" value="<?php echo $boutiqueshop_id;?>" />
                                        <input type="hidden" name="stillImg" value="<?php echo $image;?>" />

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
               