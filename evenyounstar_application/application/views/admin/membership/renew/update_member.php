<script>
function form_submit(){
var backid = document.getElementById("back").value;
var saveid = document.getElementById("save").value;
//alert(saveid);
if(saveid){
//alert(saveid);
document.MemberForm.submit();
}

}
function form_back(){
	window.history.back();
}

function form_reset(){
	document.MemberForm.reset();
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
<style>
.form_area label{
	width:20%;
	float:left;
	}
.form_area .input_area{
	width:70%;
	float:left;
	}
</style>
<div id="main-container"> 
<div id="container">
	<div id="title-container">
    <div class="title">
      <h2>New member</h2>
    </div>
    <div class="button-container">
        <input type="button" value="Back" id="back" onclick="form_back();" />
        <input type="button" value="Reset"  id="reset" onclick="form_reset();"/>
        <input type="button" value="Save"  id="save" onclick="form_submit();"/>
    
    </div>
</div>

<div id="content-container">
	<div id="sidebar-inner">
	  <?php include("left_menu_member.php");?>
	</div>    
    <div id="content-inner">
    
            	
            	<div id="display_member">
				
				<?php echo form_open('member/link_form', 'name="MemberForm"');?>
				
                <fieldset class="fieldset">
                	<legend class="legend">General Information</legend>                    
						<div class="form_area">
                        	<div class="left">
                                <div class="row">
                                    <label> Member Name: </label>
                                    <div class="input_area">
                                    <input name="memberName" id="memberName" style="width:70%" type="text"  required="required"
                                    value="<?php echo $memberdata['username'];?>" placeholder="Member Name"/>
                                    <?php echo form_error('memberName', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                    </div>
                              </div>
                              <div class="row">
                                    <label> Member Photo:<font color="#FF0000">&nbsp;*</font> </label>
                                    <div class="input_area"><input type="file" name="userfile" id="file"/>
                                   </div>
                              </div>
                              
                             
                              <div class="row">
                                        <label> Mobile: </label>
                                        <div class="input_area">
                                        <input name="mobile" id="mobile" type="text" style="width:50%" required="required"
                                         value="<?php echo $memberdata['mobile'];?>" placeholder="Mobile No."/>
                                        <?php echo form_error('mobile', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                        </div>
                                  </div>
                               <div class="row">
                                        <label> Profession: </label>
                                        <div class="input_area">
                                        <input name="profession" id="profession" value="<?php echo $memberdata['profession'];?>" type="text" style="width:50%" required="required" placeholder="Profession"/>
                                        </div>
                                  </div>
                                  
                                   <div class="row">
                                        <label> Country: </label>
                                        <div class="input_area">
                                       <select name="country" id="country" style="float:left; width:50%; padding:0; margin:0" required 
                                       onChange="getCity('<?php echo base_url();?>category/ajax_cat?parent_id='+this.value);">
                                   
                                    <option value="<?php echo $memberdata['country'];?>"><?php echo $memberdata['country'];?></option>
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
                                    <?php echo form_error('country', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                        </div>
                                  </div>
                                  
                              <div class="row">
                                        <label> City: </label>
                                        <div class="input_area" id="citydiv">
                                        <select name="city" id="city" style="float:left;width:50%;  padding:0; margin:0">
                                       		 <option value="" style="text-transform:capitalize">Please Select State/City</option>
                                	 	</select>
                                        <?php echo form_error('city', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                        </div>
                                  </div>   
                                <div class="row">
                                    <label> Mailing Address : </label>
                                    <div class="input_area">
                                    <textarea name="address" rows="6" cols="40" placeholder="Mailing Address"><?php echo $memberdata['address'];?></textarea>
                                    </div>
                              </div>
                                
                                  
                                  
                                  
                                        <div class="row">
                                        <label> Date of Birth: </label>
                                        <div class="input_area"> 
                                        <?php $dateofBirth =  $memberdata['dob'];
											list($year,$month,$day)=explode('-',$dateofBirth);
										?>
                                        <span>
                                        <select name="dobDay" style="width:20%; float:left; padding:0; margin:0">
                                                <option value="<?php echo $day; ?>"><?php echo $day; ?></option>
                                                <?php for($i=1;$i<=31;$i++)
                                                print("<option>".$i."</option>"); ?>	
                                            </select>
                                           </span>
                                        <span>
                                            <select name="dobMonth" style="width:25%; float:left; padding:0; margin:0">
                                                <option value="<?php echo $month; ?>"><?php echo $month; ?></option>
                                                <?php for($i=1;$i<13;$i++)
                                                print("<option value='".$i."'>".date('F',strtotime('01.'.$i.'.2015'))."</option>"); ?>	
                                            </select>
                                        </span>
                                        <span>
                                            <select name="dobYear" style="width:20%; float:left; padding:0; margin:0">
                                                <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                                <?php for($i=1920;$i<=2000;$i++)
                                                print("<option>".$i."</option>"); ?>	
                                            </select>
                                        </span>
                                        
                                      </div>
                                  </div>
                                  <div class="row">
                                        <label> Place of Birth: </label>
                                        <div class="input_area">
                                        <input name="placeofBirth" id="placeofBirth" style="width:50%" type="text"  placeholder="Place of Birth"
                                        value="<?php echo $memberdata['dobPlace'];?>"/>
                                        </div>
                                  </div>
                                  
                                  
                                  <div class="row">
                                        <label> Marrital Status: </label>
                                        <div class="input_area">
                                     		  <select name="merital_status" style="float:left; width:25%; padding:0; margin:0">
                                                    <option value="Married">Married</option>
                                                    <option value="Unmarried">Unmarried</option>
                                                </select>
                                        </div>
                                  </div>
                                   
                                  <div class="row">
                                        <label> Gender: </label>
                                        <div class="input_area">
                                          <select name="gender" style="float:left; width:25%; padding:0; margin:0">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                               			 </select>
                                        </div>
                                  </div>
                                  <div class="row">
                                        <label> Email: </label>
                                        <div class="input_area">
                                        <input name="email" id="email" style="width:70%"  type="email"  required="required" 
                                        value="<?php echo $memberdata['email'];?>" placeholder="Email Address"/>
                                        <?php echo form_error('email', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                        </div>
                                  </div>
                                  <div class="row">
                                        <label> Password: </label>
                                        <div class="input_area">
                                        <input name="password" id="password" style="width:70%"  type="text"  required="required"
                                         value="<?php echo $memberdata['passwordHints'];?>" placeholder="Password : xxxxxxxx"/>
                                        <?php echo form_error('password', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                        </div>
                                  </div>
                                
                          </div>
                             
						</div>
                        
                </fieldset>
                
               
                
                
            <input type="hidden" name="memberId" value="<?php echo $memberdata['user_id'];?>" />
                
     <?php echo form_close();?>

            </div>			
                    
    </div>
</div>
</div>
</div>
