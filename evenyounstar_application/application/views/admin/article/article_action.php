<?php
if($articleUpdate->num_rows()>0){
	foreach($articleUpdate->result() as $articleData);
	$a_id=$articleData->a_id;
	//$expl=explode('-',$articleData->menu_title);
	//$menu_title=implode('-',$expl);
	$menu_title=$articleData->menu_title;
	$articleTitle=$articleData->headline;
	$details=$articleData->details;
	$boutique=$articleData->boutiqueshop;
}
else{
	$a_id='';
	$articleTitle=set_value('headline');
	$menu_title='Menu';
	$details=set_value('details');
	$boutique='';
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
	
	function getMenu(strURL) {		
		
		var req = getXMLHTTP();
		//alert(req);
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('menudisplay').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}
	/*function getSubMenu(strURL) {		
		
		var req = getXMLHTTP();
		//alert(strURL);
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('submenudisplay').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}*/
</script>
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>Patient Registration Details</h3>
                        </div>
                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for...">
                                    <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">




    





                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Admin Registraion Form</h2>
                                    
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
                                                   Article Information </h4>
                                                 </a>
                                            </div>
                                            
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                <div class="form-group">
                                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Boutique Shop<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                            <?php
                                          $queryImg=$this->Index_model->getAllItemTable('boutiqueshop','user_id',$boutique,'','','user_id','desc');
												if($queryImg->num_rows() > 0){
												foreach($queryImg->result() as $row_scat);
													$boutiqueusername=$row_scat->username;
													$bouUpdateId=$row_scat->user_id;
												}
												else{
													$boutiqueusername=$boutique;
													$bouUpdateId=$boutique;
												}
											?>
                                            
                               <select name="boutiqueshop" id="boutiqueshop" class="form-control col-md-7 col-xs-12" style="width:70%" onChange="getMenu('<?php echo base_url();?>ouradminmanage/ajaxMenu?menu_id='+this.value);" >
                                                <option value="<?php echo $bouUpdateId;?>"><?php echo $boutiqueusername;?></option>
                                                <option value="Butikbd">Butikbd</option>
                                                <?php
                                                   foreach($boutiqueshop->result() as $boutiRow){
                                                   $bouId=$boutiRow->user_id;
                                                   $shopname=$boutiRow->username;
                                                ?>
                                                    <option value="<?php echo $bouId; ?>"><?php echo $shopname; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Menu<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                             <div id="menudisplay">
                                                <select name="root_id" class="form-control" style="width:60%; margin-bottom:5px">
                                                	<!--<option valeu="<?php //echo $menu_title;?>"><?php //echo $menu_title;?></option>-->
                                                    <?php foreach($root_menu->result() as $rootmenu):
															echo '<option value="'.$rootmenu->slug.'">'.$rootmenu->menu_name.'</option>';
														endforeach;
													?>
                                                    
                                                </select>
                                             </div>
                                             <?php echo form_error('root_id', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                            </div>
                                        </div>
                                       <!-- <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Article Headline<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div id="menudisplay">
                                                <select name="sroot_id" class="form-control" style="width:60%;">
                                                	<option value="">Sub Menu</option>
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Last Menu<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div id="submenudisplay">
                                                <select name="lroot_id" class="form-control" style="width:60%;">
                                                	<option value="">Last Menu</option>
                                                </select>
                                                </div>
                                            </div>
                                        </div>-->
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Article Headline<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="headline" required class="form-control col-md-7 col-xs-12" 
                                                placeholder='Headline' value="<?php echo $articleTitle; ?>"  onFocus="this.placeholder=''" onBlur="this.placeholder='Headline'">
                                             <?php echo form_error('headline', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                            </div>
                                        </div>
                                      <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Article Details<span class="required">*</span>
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <textarea type="text" name="details" class="form-control col-md-7 col-xs-12 ckeditor"><?php echo $details; ?></textarea>
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
                                        <input type="hidden" name="a_id" value="<?php echo $a_id; ?>">
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
               