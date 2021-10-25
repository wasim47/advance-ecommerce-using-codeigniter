<?php
if($advertisementUpdate->num_rows()>0){
	foreach($advertisementUpdate->result() as $advertisementData);
	$b_id=$advertisementData->b_id;
	$advertisementTitle=$advertisementData->advertisement_name;
	$adPhoto=$advertisementData->image;
	$adPosition=$advertisementData->adPosition;
}
else{
	$b_id='';
	$advertisementTitle=set_value('advertisement_name');
	$adPhoto='';
	$adPosition=set_value('adPosition');
	}
?>
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>advertisement Registration Details</h3>
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
                                                   advertisement Information </h4>
                                                 </a>
                                            </div>
                                            
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                        			    <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">advertisement Name<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="advertisement_name" required class="form-control col-md-7 col-xs-12" 
                                                placeholder='advertisement Name' value="<?php echo $advertisementTitle; ?>"  onFocus="this.placeholder=''" onBlur="this.placeholder='advertisement Name'">
                                             <?php echo form_error('advertisement_name', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Ad Photo</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control" type="file" name="ad_photo">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Ad Position</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <!--<select name="adPosition" class="form-control" required>
                                               		<option value="">Select ad Postion</option>
                                                	<option value="Left First">Left First</option>
                                                    <option value="Left Second">Left Second</option>
                                                    <option value="Left Third">Left Third</option>
                                                    <option value="Left Fourth">Left Fourth</option>
                                                    <option value="Rgith First">Rgith First</option>
                                                    <option value="Rgith Second">Rgith Second</option>
                                                    <option value="Rgith Third">Rgith Third</option>
                                                    <option value="Rgith Fourth">Rgith Fourth</option>
                                                </select>-->
                                                <select name="adPosition" class="form-control" required>
                                               		<option value="<?php echo $adPosition;?>"><?php echo $adPosition;?></option>
                                                	<option value="Left Side">Left Side</option>
                                                    <option value="Right Side">Right Side</option>
                                                </select>
                                                <?php echo form_error('adPosition', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                            </div>
                                        </div>
                                                        <!--<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">advertisement Details<span class="required">*</span>
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <textarea type="text" name="details" class="form-control col-md-7 col-xs-12 ckeditor"><?php echo $details; ?></textarea>
                                            </div>
                                        </div>-->
                                                        
                                                        
                                                </div>
                                            </div>
                                        </div>
                                        
                               	     </div>
                                   </div> 
                                    
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <input type="hidden" name="b_id" value="<?php echo $b_id; ?>">
                                         <input type="hidden" name="adPhoto" value="<?php echo $adPhoto; ?>">
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
               