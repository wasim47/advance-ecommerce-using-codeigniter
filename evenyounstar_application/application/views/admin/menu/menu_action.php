<?php
if($menuUpdate->num_rows()>0){
	foreach($menuUpdate->result() as $menuData);
	$m_id=$menuData->m_id;
	$menuTitle=$menuData->menu_name;
	$page_structure=$menuData->page_structure;
	$boutique=$menuData->boutiqueshop;
	$details='';
	$data['rootId'] = $this->Index_model->getOneItemTable('menu','root_id',$menuData->root_id,'m_id','desc');
	$data['srootId'] = $this->Index_model->getOneItemTable('menu','sroot_id',$menuData->sroot_id,'m_id','desc');
	
	if($menuData->root_id!=0){
		$rootName = $data['rootId']['menu_name'];
		$rootId=$menuData->root_id;
		
	}
	else{
		$rootName = '';
		$rootId='';
		
	}
	
	if($menuData->sroot_id!=0){
		$srootName = $data['srootId']['menu_name'];
		$srootId=$menuData->sroot_id;
	}
	else{
		$srootName = '';
		$srootId='';
	}
}
else{
	$m_id='';
	$menuTitle=set_value('menu_name');
	$details=set_value('details');
	$page_structure='';
	$rootId='';
	$srootId='';
	$rootName='';
	$srootName='';
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
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>Menu Registration Details</h3>
                        </div>
                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="hidden" class="form-control" placeholder="Search for...">
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
                                                   menu Information </h4>
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
                                                <select name="boutiqueshop" id="boutiqueshop" class="form-control col-md-7 col-xs-12" style="width:70%">
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
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Menu Name<span class="required">*</span>
                                            </label>
                                            <div class="col-md-5 col-sm-5 col-xs-12">
                                                <input type="text" name="m_name" required class="form-control col-md-7 col-xs-12" 
                                                placeholder='Menu Name' value="<?php echo $menuTitle; ?>"  onFocus="this.placeholder=''" onBlur="this.placeholder='Menu Name'">
                                             <?php echo form_error('m_name', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                            	<label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Parent</label>
                                                <select name="root_id" class="form-control" style="width:60%; margin-bottom:5px" 
                                                onChange="getMenu('<?php echo base_url();?>ouradminmanage/ajaxData?root_id='+this.value)">
                                                	<option value="<?php echo $rootId;?>"><?php echo $rootName;?></option>
                                                    <?php foreach($root_menu->result() as $rootmenu):
															echo '<option value="'.$rootmenu->m_id.'">'.$rootmenu->menu_name.'</option>';
														endforeach;
													?>
                                                    
                                                </select>
                                                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Sub Parent</label>
                                                <div id="citydiv">
                                                <select name="sroot_id" class="form-control" style="width:60%;">
                                                	<option value="<?php echo $srootId;?>"><?php echo $srootName;?></option>
                                                </select>
                                                </div>
                                                
                                                
                                                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Page Structure</label>
                                                <select name="page_structure" class="form-control" style="width:60%; margin-top:5px">
                                                	<?php if($page_structure!=""){?>
                                                    <option value="<?php echo $page_structure;?>"><?php echo $page_structure;?></option>
                                                    <?php } ?>
                                                    <option value="article">Article</option>
                                                    <option value="gallery">Picture Gallery</option>
                                                    <option value="committee">E.C. Committee</option>
                                                    <option value="member">Membership</option>
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
                                        <input type="hidden" name="m_id" value="<?php echo $m_id; ?>">
                                            <input type="reset" class="btn btn-primary" value="Reset">
                                            <input type="submit" name="registration" class="btn btn-success" value="Submit">
                                        </div>
                                    </div>
                               <?php echo form_close();?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               