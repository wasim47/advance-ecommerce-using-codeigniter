<?php
if($categoryUpdate->num_rows()>0){
	 foreach($categoryUpdate->result() as $categoryData);
		 $cid=$categoryData->cid;
		 $cat_name=$categoryData->cat_name;
		 $catImage=$categoryData->image;
		 $short_desc=$categoryData->short_desc;
		 $boutique=$categoryData->boutiqueshop;
}
else{
	$cid='';
	$cat_name=set_value('menu_name');
	$catImage='';
	$short_desc='';
	$boutique='';
	}
?>

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
                                                   Category Information </h4>
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
												foreach($queryImg->result() as $row_scat);
													$boutiqueusername=$row_scat->username;
													 $bouUpdateId=$row_scat->user_id;
											?>
                                                <select name="boutiqueshop" id="boutiqueshop" class="form-control col-md-7 col-xs-12">
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
                                  			 <?php echo form_error('cat_id', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Category Name<span class="required">*</span>
                                            </label>
                                            <div class="col-md-5 col-sm-5 col-xs-12">
                                                <input type="text" name="category_name" required class="form-control col-md-7 col-xs-12" 
                                                placeholder='Category Name' value="<?php echo $cat_name; ?>"  onFocus="this.placeholder=''" onBlur="this.placeholder='Category Name'">
                                             <?php echo form_error('category_name', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                            </div>
                                        </div>
                                                        
                                           <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Category Image<span class="required">*</span>
                                            </label>
                                            <div class="col-md-5 col-sm-5 col-xs-12">
                                                <input type="file" name="catImage" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                          <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Status<span class="required">*</span>
                                            </label>
                                            <div class="col-md-5 col-sm-3 col-xs-12">
                                               <textarea name="short_desc" class="form-control"><?php echo $short_desc;?></textarea>
                                            </div>
                                        </div>
                                           <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Status<span class="required">*</span>
                                            </label>
                                            <div class="col-md-5 col-sm-3 col-xs-12">
                                                <select name="status" class="form-control  col-md-7 col-xs-12">
                                                    <option value="1">Enable</option>
                                                    <option value="0">Disable</option>
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
                                        <input type="hidden" name="cid" value="<?php echo $cid; ?>">
                                        <input type="hidden" name="stillimage" value="<?php echo $catImage; ?>">
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
               