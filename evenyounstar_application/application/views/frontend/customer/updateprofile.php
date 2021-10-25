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
		<div class="container">
			<div class="row middlecontainer">
				<div class="col-sm-3">
					<?php include("leftSidebar.php");?>
				</div>
				
				<div class="col-sm-9">
    				<div style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333; text-align:justify">
                        <h3 class="headline">Update Profile</h3>
                            <div class="row">
                            <div class="col-lg-11 col-lg-offset-1">
                        
                        <?php echo form_open('');
						echo $this->session->flashdata('successMsg');
						?>
                           
                           <div class="form-group">
                           <div class="col-sm-3"></div>
                           <div class="col-sm-8">  
                           	 <div class="col-sm-2">    
                                <label class="control-label">Mr.</label>
                         <input type="radio" name="gender" value="Mr." <?php if($userProfile['gender']=='Mr.'){?> checked="checked" <?php }?>/>
                            </div>
                            
                            <div class="col-sm-2"> 
                             <label class="control-label">MS.</label>
                        <input type="radio" name="gender" value="MS." <?php if($userProfile['gender']=='MS.'){?> checked="checked" <?php }?> />
                            </div>
                            
                            </div>
                        </div>
                
                           <div class="form-group">
                                <div class="col-sm-3"><label class="control-label">Username :</label></div>
                                <div class="col-sm-7">
                                    <input type="text" name="username" class="form-control" style="margin-bottom:5px;" value="<?php echo $userProfile['username'];?>"/>
                             </div>
                           </div>
                           <div class="form-group" style="margin-bottom:5px;">
                                <div class="col-sm-3"><label class="control-label">Email :</label></div>
                                <div class="col-sm-7">
                                    <input type="email" name="email" class="form-control" style="margin-bottom:5px;"  value="<?php echo $userProfile['email'];?>"/>
                                </div>
                           </div>
                           <div class="form-group">
                                <div class="col-sm-3"><label class="control-label">Mobile :</label></div>
                                <div class="col-sm-7">
                                    <input type="text" name="mobile" class="form-control" style="margin-bottom:5px;" value="<?php echo $userProfile['mobile'];?>"/>
                             </div>
                           </div>
                           
                           
                           <div class="form-group">        
                           
                         
                         
                     <div class="col-sm-3"><label class="control-label">District </label></div>
                      <div class="col-sm-7">
                      <select name="district" id="district" class="form-control" style="margin-bottom:5px;"
                                       onChange="getCity('<?php echo base_url();?>registration/ajaxData?root_id='+this.value);">
                                   
                                    <option value="<?php echo $userProfile['city'];?>"><?php echo $userProfile['city'];?></option>
                                    <?php
                                    foreach($totaldistrict->result() as $row){
									$country_name=$row->district;
                                    ?>
                                    <option value="<?php echo $country_name; ?>"><?php echo ucfirst($country_name); ?></option>
                                    <?php
                                    }
                                    ?>
                                    </select></div>
                </div>
                                   <div class="form-group">  
                                <div class="col-sm-3"><label class="control-label">Thana </label></div>      
                                    
                                       <div class="col-sm-7"><div id="citydiv">
                                        <select name="thana" id="thana" class="form-control" style="width:70%;">
                                             <option value="<?php echo $userProfile['thana'];?>" style="text-transform:capitalize"><?php echo $userProfile['thana'];?></option>
                                    </select></div>
                                    </div>
                            </div>
                
                           
                           <div class="form-group">
                                <div class="col-sm-3"><label class="control-label">Address :</label></div>
                                <div class="col-sm-7">
                                    <textarea name="address" class="form-control" style="margin-top:5px;"><?php echo $userProfile['address'];?></textarea>
                                </div>
                           </div>
                            <div class="form-group col-sm-10">
                                <input type="submit" name="editProfile" value="Submit" class="btn btn-primary pull-right"/>
                           </div>
                           
                       <?php echo form_close();?> 
                        </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
