<?php
if($customerUpdate->num_rows()>0){
	foreach($customerUpdate->result() as $customer);
			$customerId=$customer->user_id;
			$customer_name=$customer->username;
			$contact=$customer->mobile;
			$city=$customer->city;
			$email=$customer->email;
			$gender=$customer->gender;
			$address=$customer->address;
}
else{
			$customerId='';
			$customer_name= set_value('customerName');
			$contact=set_value('mobile');
			$city='';
			$email=set_value('email');
			$gender='';
			$address=set_value('address');
			$photo='';
	}
?>

<div class="right_col" role="main">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>Customer Registration Details</h3>
                        </div>
                        
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">




    





                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                
                                <div class="x_content">
                                <?php echo form_open_multipart('', 'class="form-horizontal form-label-left"');?>
                                   <div id="registration_form">	
                                  	  <div class="panel-group" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                 <h4 class="panel-title">
                                                   Customer Information </h4>
                                                 </a>
                                            </div>
                                            
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                <div class="form-group">        
                    <label class="control-label col-sm-3">Title <span style="color:#ff0000">*</span></label>
                       <label class="control-label">Mr. &nbsp;</label><input type="radio" name="gender" value="Mr."  />&nbsp;&nbsp;&nbsp;
					  <label class="control-label">MS. &nbsp;</label><input type="radio" name="gender" value="MS."  />             
                    </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"> Customer Name: </label>
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                    <input name="customerName" id="customerName" class="form-control col-md-7 col-xs-12" type="text"  required="required" value="<?php echo $customer_name; ?>" placeholder="customer Name"/>
                                    <?php echo form_error('customerName', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                    </div>
                              </div>
                              
                              
                             
                              <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Mobile: </label>
                                        <div class="col-md-5 col-sm-5 col-xs-12">
                                        <input name="mobile" id="mobile" type="text" class="form-control col-md-7 col-xs-12" required="required"
                                         value="<?php echo $contact; ?>" placeholder="Mobile No."/>
                                        <?php echo form_error('mobile', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                        </div>
                                  </div>
                               
                                  
                                   <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> District: </label>
                                        <div class="col-md-5 col-sm-5 col-xs-12">
                                       <select name="city" id="city" class="form-control col-md-7 col-xs-12" required >
                                   
                                    <option value="<?php echo $contact;?>"><?php echo $contact;?></option>
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
                                        </div>
                                  </div>
                                  
                                 
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"> Mailing Address : </label>
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                    <textarea name="address" class="form-control col-md-7 col-xs-12" placeholder="Mailing Address"><?php echo $address;?></textarea>
                                    </div>
                              </div>
                                
                                   
                                  
                                  <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Email: </label>
                                        <div class="col-md-5 col-sm-5 col-xs-12">
                                        <input name="email" id="email" class="form-control col-md-7 col-xs-12"  type="email"  required="required" 
                                        value="<?php echo $email; ?>" placeholder="Email Address"/>
                                        <?php echo form_error('email', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                        </div>
                                  </div>
                                  <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Password: </label>
                                        <div class="col-md-5 col-sm-5 col-xs-12">
                                        <input name="password" id="password" class="form-control col-md-7 col-xs-12"  type="password"  required="required"
                                         value="<?php echo set_value('password'); ?>" placeholder="Password : xxxxxxxx"/>
                                        <?php echo form_error('password', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
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
                                           <input type="hidden" name="customer_id" value="<?php echo $customerId; ?>">
                                            <input type="reset" class="btn btn-primary" value="Reset">
                                            <input type="submit" name="registration" class="btn btn-success" value="Submit">
                                        </div>
                                    </div>
                               <?php echo form_close();?>
                                </div>
                            </div>
                        </div>
                    </div>
               