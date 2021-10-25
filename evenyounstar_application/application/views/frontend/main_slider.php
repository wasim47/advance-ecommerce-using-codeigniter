<div class="banner-widget-wrapper fifth-slot-enabled big-banner fk-position-relative newvd">
    <div class="banner-widget-images-wrapper line big-banner-image">
               		<?php 
						$i=0;
						foreach($bannerslider->result() as $banner):
							$image=$banner->image;
							$banner_name1=$banner->banner_name;
							if($i==0){
								$class='banner-image tab-content';
							}
							else{
								$class='banner-image tab-content fk-hidden';	
							}
						?>
		                <div class="<?php echo $class;?>" id="b-tab<?php echo $i;?>-content">
                    <a  href="#" data-tracking-id="banner_<?php echo $i;?>_image">
                        <img src="<?php echo base_url('uploads/images/banner/'.$image)?>" style="width:100%; height:auto" alt="<?php echo $banner_name1;?>" title="<?php echo $banner_name1;?>" />
                    </a>
                    
                </div>
                		<?php 
						$i++;
						endforeach;?>

    </div>
    <div class="banner-widget-tabs-wrapper line banner-tabs">
    
    <ul>
       				 <?php 
					 $j=0;
						foreach($bannerslider->result() as $banner1):
							$banner_name=$banner1->banner_name;
							$subtitle=$banner1->subtitle;
							if($j==0){
								$class1='banner-tab tab first-tab selected';
							}
							else{
								$class1='banner-tab second-tab tab';	
							}
						?>
                    <li class="nav-list unit size1of5">
                            <a href="#" id="b-tab<?php echo $j;?>" class="<?php echo $class1;?>" data-tracking-id="banner_tab_<?php echo $j;?>"  style="font-family: BNG,SutonnyBanglaOMJ,SolaimanLipi;">
                                <span class="first-line fk-uppercase" title="<?php echo $banner_name;?>" style="font-size:15px"><?php echo $banner_name;?> </span>
                                <span class="second-line" title="<?php echo $subtitle;?>" style="font-size:13px"><?php echo $subtitle;?></span>
                            </a>
                    </li>
                    <?php 
					 $j++;
						endforeach;?>
                    
        </ul>
        
        
        
        
        
        <!--<ul>
                    <li class="nav-list unit size1of5">
                            <a href="#" id="b-tab0"
                               class="banner-tab tab first-tab selected "
                               data-tracking-id="banner_tab_0">
                                <span class="first-line fk-uppercase" title="Launching ">Women Salwer Kameez </span>
                                <span class="second-line" title="Moto 360 (2nd Gen)">Latest Stylish Collection</span>
                            </a>
                    </li>
                    <li class="nav-list unit size1of5">
                            <a href="#" id="b-tab1"
                               class="banner-tab tab third-tab "
                               data-tracking-id="banner_tab_1">
                                <span class="first-line fk-uppercase" title="GOQii at Rs. 1499">Men Wear</span>
                                <span class="second-line" title="Only on App">Latest Panjabi and Sherwani</span>
                            </a>
                    </li>
                    <li class="nav-list unit size1of5">
                            <a href="#" id="b-tab2"
                               class="banner-tab tab second-tab "
                               data-tracking-id="banner_tab_2">
                                <span class="first-line fk-uppercase" title="Weighing Scales">Benaroshi & Katan Sarees</span>
                                <span class="second-line" title="Just Rs.699 on App">Women all Kind of Benaroshi</span>
                            </a>
                    </li>
                    <li class="nav-list unit size1of5">
                            <a href="#" id="b-tab3"
                               class="banner-tab tab third-tab "
                               data-tracking-id="banner_tab_3">
                                <span class="first-line fk-uppercase" title="Reebok Z Pump ">Tangail & Jamdani </span>
                                <span class="second-line" title="Flipkart Exclusive">Butikbd Exclusive</span>
                            </a>
                    </li>
                    <li class="nav-list unit size1of5">
                            <a href="#" id="b-tab4"
                               class="banner-tab tab third-tab "
                               data-tracking-id="banner_tab_4">
                                <span class="first-line fk-uppercase" title="Citrus Juicer">Silk Sarees</span>
                                <span class="second-line" title="Just Rs.599 on App">Less than 1500 BDT</span>
                            </a>
                    </li>
        </ul>-->
    </div>
</div>





                
<script>
    (function() {
        var timerId = null, timerEnabled=true, tabsArray = $(".banner-tab"), currentTab = 0, numOfTabs = tabsArray.length;
        var tabs = $(".big-banner").tabs({clickDisabled:false, fadeDuration:400}).data("tabs_instance");
        $(".big-banner").bind("tabChange", function(ev, tab){
            var $img = $("#"+tab.id+"-content").find("img");
            $img.attr("data-url") && $img.attr("src", $img.attr("data-url")).removeAttr("data-url");
        });
        $(".banner-tab").bind("mouseenter", function() {
            tabs.changeTab(this);
            timerId && clearTimeout(timerId) && (timerEnabled=false);
        });
            function cycleTabs() {
                if(timerEnabled){
                  currentTab++;
                  timerId = setTimeout(function(){
                      tabs.changeTab(tabsArray[currentTab%numOfTabs]);
                      cycleTabs();
                  }, 5000);
                }
            }
            function lazyfetch() {
               $(".big-banner").find("img[data-url]").each(function(){
                   $(this).attr("src",$(this).attr("data-url")).removeAttr("data-url");
               }).first().on("load", cycleTabs);
            }
            addWindowOnload(lazyfetch);
    })();
</script>
<script type="text/javascript">
    addOnload(function(){
      FKART.utils.runOnload();
    });
</script>
