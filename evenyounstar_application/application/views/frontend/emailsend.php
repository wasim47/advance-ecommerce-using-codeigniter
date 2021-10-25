<link href="<?php echo base_url()?>assets/css/front/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url()?>assets/css/front/font-awesome.min.css" rel="stylesheet">

		<div class="container">
			<div class="row middlecontainer">
            <div class="col-sm-12" style="margin-top:10%;">
            	
                 <?php echo form_open_multipart('emailsend/sendmail', 'class="form-horizontal form-label-left"');
				 		echo $this->session->flashdata('globalMsg');
				 ?>
                	 <div class="col-sm-12 col-lg-6 col-lg-offset-3">
                     <fieldset>
                <legend style="padding:10px;">Send Email</legend>
                <?php
                	foreach($allemail->result() as $amail){
						$senderemail[] = $amail->email;
					}
					$arrayMail = join(',',$senderemail);
				?>
                            <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Email<span class="required">*</span>
                            </label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" name="usermail" value="<?php echo $arrayMail;?>" class="form-control col-md-7 col-xs-12">
                            </div>
                         </div>
                            
                            
                            <div class="form-group" style="float:right">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="submit" name="registration" class="btn btn-success" style="cursor:pointer" value="Submit">
                                </div>
                            </div>
                        </fieldset>
                    </div>
                 <?php echo form_close();?>
             
            </div>
            </div>
		</div>
