	<section>
		<div class="container">
			<div class="row middlecontainer">
            <div class="col-sm-12">
          
            
            	
            	<div class="col-sm-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3652.4496456220577!2d90.42266831444606!3d23.73133989542225!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b84f60051f17%3A0xc4d5064345841031!2sButikbd!5e0!3m2!1sbn!2sbd!4v1456362767909" width="550" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
               
                </div>
                 <?php echo form_open_multipart('index/contact_email', 'class="form-horizontal form-label-left"');?>
                 <div class="col-sm-6">
        
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="last-name">Name <span class="required">*</span>
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="text" name="name" required class="form-control col-md-7 col-xs-12"
                                    placeholder='Name' onFocus="this.placeholder=''" onBlur="this.placeholder='Name'">
                                </div>
                            </div>
                            <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Email<span class="required">*</span>
                            </label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="text" name="email" required class="form-control col-md-7 col-xs-12" placeholder='Email' onFocus="this.placeholder=''" onBlur="this.placeholder='Email'">
                            </div>
                         </div>
                            <div class="form-group">
                <label for="middle-name" class="control-label col-md-4 col-sm-4 col-xs-12">phone</label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <input  class="form-control col-md-7 col-xs-12" type="text" name="phone"
                    placeholder='phone' onFocus="this.placeholder=''" onBlur="this.placeholder='phone'">
                </div>
            </div>
                            <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">Message<span class="required">*</span>
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <textarea type="text" name="address" required class="form-control col-md-7 col-xs-12" placeholder='Message' onFocus="this.placeholder=''" onBlur="this.placeholder='Message'"></textarea>
                </div>
            </div>
                            <div class="form-group" style="float:right">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="submit" name="registration" class="btn btn-success" style="cursor:pointer" value="Submit">
                                </div>
                            </div>
                            
             <div class="clearfloat"></div> </div>
                 <?php echo form_close();?>
       			  
            </div>
           <div class="col-sm-12 pull-left">
                    <div class="ntic_text_area">
                        <div class="main_tex">
                        	<p><?php echo stripslashes($articledetails['details']);?></p>
                        </div>
                        
                    </div>
                </div>
            </div>
            
		</div>
        
	</section>