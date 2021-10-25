<?php
if($agentUpdate->num_rows()>0){
	foreach($agentUpdate->result() as $agent);
		$agentId=$agent->user_id;
		$image=$agent->photo;
		$agent_name=$agent->username;
		$mobile=$agent->mobile;
		$division=$agent->division;
		$district=$agent->district;
		$location=$agent->location;
		$address=$agent->address;
		$mobile=$agent->mobile;
		$email=$agent->email;
		$passwordHints=$agent->passwordHints;
}
else{
		$agentId='';
		$image='';
		$agent_name='';
		$mobile='';
		$division='';
		$district='';
		$location='';
		$address='';
		$mobile='';
		$email='';
		$passwordHints='';
}
?>
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
	
	function getDistrict(strURL) {		
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
	
	
	
	function getLocation(strURL) {		
		var req = getXMLHTTP();
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('locationdiv').innerHTML=req.responseText;
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

<div class="right_col" role="main">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>agent Registration Details</h3>
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
                                                   agent Information </h4>
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
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"> agent Name: </label>
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                    <input name="agentName" id="agentName" class="form-control col-md-7 col-xs-12" type="text"  required="required" value="<?php echo $agent_name; ?>" placeholder="agent Name"/>
                                    <?php echo form_error('agentName', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                    </div>
                              </div>
                              
                              
                             
                              <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Mobile: </label>
                                        <div class="col-md-5 col-sm-5 col-xs-12">
                                        <input name="mobile" id="mobile" type="text" class="form-control col-md-7 col-xs-12" required="required"
                                         value="<?php echo $mobile; ?>" placeholder="Mobile No."/>
                                        <?php echo form_error('mobile', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                        </div>
                                  </div>
                               
                                  
                                   <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Division: </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select name="div_id" id="div_id" class="form-control col-md-7 col-xs-12"  
                                               onChange="getDistrict('<?php echo base_url();?>ouradminmanage/ajaxLocation?div_id='+this.value);"
                                                 required>
                                                <option value="<?php echo $division;?>"><?php echo $division;?></option>
                                                <?php
                                                foreach($division_list->result() as $row){
                                                $div_name=$row->name;
                                                $id=$row->id;
                                                ?>
                                                    <option value="<?php echo $id; ?>"><?php echo $div_name; ?></option>
                                                <?php
                                                }
                                                ?>
                                                </select>
                                  			 <?php echo form_error('div_id', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                            </div>
                                  </div>
                                   <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> District: </label>
                                        <div class="col-md-5 col-sm-5 col-xs-12">
                                            <div id="citydiv">
                                              <select name="district_id" id="district_id" class="form-control col-md-7 col-xs-12" required >
                                             	<option value=""><?php echo $district;?></option>
                                           	</select>
                                            </div>
                                        </div>
                                  </div>
                                   <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Upozilla: </label>
                                        <div class="col-md-5 col-sm-5 col-xs-12">
											<div id="locationdiv">
                                              <select name="location_id" id="location_id" class="form-control col-md-7 col-xs-12" required >
                                             <option value=""><?php echo $location;?></option>
                                           </select>
                                            </div>                                        
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
                                           <input type="hidden" name="agent_id" value="<?php echo $agentId; ?>">
                                            <input type="reset" class="btn btn-primary" value="Reset">
                                            <input type="submit" name="registration" class="btn btn-success" value="Submit">
                                        </div>
                                    </div>
                               <?php echo form_close();?>
                                </div>
                            </div>
                        </div>
                    </div>
               