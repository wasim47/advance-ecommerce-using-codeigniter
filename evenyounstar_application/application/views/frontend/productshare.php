<div  class="col-sm-12 col-lg-12" style="margin:0; padding:0">
	<div class="col-sm-12 col-lg-3">
								<div id="fb-root"></div>
				<script>(function(d, s, id) {
                  var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id)) return;
                  js = d.createElement(s); js.id = id;
                  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.5&appId=1713751272185934";
                  fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>
                <div class="fb-share-button" data-href="<?php echo base_url();?>products/<?php echo $slug;?>" data-layout="button_count"></div>
</div>        
<div class="col-sm-12 col-lg-3">  
<script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: en_US</script>
<script type="IN/Share" data-url="<?php echo base_url();?>products/<?php echo $slug;?>mohamma" data-counter="right"></script>
</div>        
 <div class="col-sm-12 col-lg-4">               
<!-- google plus -->
<div class="g-plus" data-action="share" data-href="<?php echo base_url();?>products/<?php echo $slug;?>"></div>

<!-- Place this tag after the last share tag. -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
</div>

</div>