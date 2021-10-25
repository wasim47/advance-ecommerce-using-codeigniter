<?php include('admin_tophead.php');?>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0; height:auto">
                        <a href="#"><img src="<?php echo base_url();?>assets/images/front/butikbdlogo.png" class="img-responsive" style="margin:10px;"></a>
                    </div>
                    <div class="clearfix"></div>



                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                      		<h3 style="font-size:18px">Administration</h3>
                            <ul class="nav side-menu">
                          <?php if($this->session->userdata('AdminType')=="Super Admin"):?>
                                <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?php echo base_url('ouradminmanage/dashboard');?>">Dashboard</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-desktop"></i>Administration<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('ouradminmanage/admin_list');?>">Admin List</a></li>
                                            <li><a href="<?php echo base_url('ouradminmanage/admin_registration');?>">New Admin Registration</a></li>
                                        </ul>
                                    </li>
                                <li><a><i class="fa fa-desktop"></i>Membership<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('ouradminmanage/membership');?>">Membership List</a></li>
                                            <li><a href="<?php echo base_url('ouradminmanage/membershipRenew');?>">Membership Renew</a></li>
                                        </ul>
                                    </li>
                                <li><a><i class="fa fa-picture-o"></i>Boutique Shop<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                	    <li><a href="<?php echo base_url('ouradminmanage/boutique_list');?>">Boutique List</a></li>
                                        <li><a href="<?php echo base_url('ouradminmanage/boutique_registration');?>">New Boutique Shop</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-desktop"></i>Agent<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('ouradminmanage/agent_list');?>">Agent List</a></li>
                                            <li><a href="<?php echo base_url('ouradminmanage/agent_registration');?>">New Agent</a></li>
                                        </ul>
                                    </li>
                             </ul>
                          </div>
                          <?php endif; ?>      
                         <?php if($this->session->userdata('AdminType')!="Moderator"):?>
                         	<div class="menu_section">
                            <h3 style="font-size:18px">Product</h3>
                            <ul class="nav side-menu">
                                <li><a><i class="fa fa-bars"></i>Product Category<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                	    <li><a href="<?php echo base_url('ouradminmanage/category_list');?>">Category List</a></li>
                                        <li><a href="<?php echo base_url('ouradminmanage/category_registration');?>">New Category</a></li>
                                        <li><a href="<?php echo base_url('ouradminmanage/sub_category_list');?>">Sub Category List</a></li>
                                        <li><a href="<?php echo base_url('ouradminmanage/sub_category_registration');?>">New Sub Category</a></li>
                                        <li><a href="<?php echo base_url('ouradminmanage/last_category_list');?>">Last Category List</a></li>
                                        <li><a href="<?php echo base_url('ouradminmanage/last_category_registration');?>">New Last Category</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-picture-o"></i>Product Size Manage<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                	    <li><a href="<?php echo base_url('ouradminmanage/size_list');?>">Product Size  List</a></li>
                                        <li><a href="<?php echo base_url('ouradminmanage/size_registration');?>">New Product Size </a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-picture-o"></i>Product Manage<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                	    <li><a href="<?php echo base_url('ouradminmanage/product_list');?>">Product List</a></li>
                                        <li><a href="<?php echo base_url('ouradminmanage/product_registration');?>">New Product</a></li>
                                    </ul>
                                </li>
                            </ul>
                          </div>
                         <?php endif; ?>  
                         <div class="menu_section">
                         <h3 style="font-size:18px">Inventory</h3>
                            <ul class="nav side-menu">   
                                <li><a><i class="fa fa-picture-o"></i>Customer<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                	    <li><a href="<?php echo base_url('ouradminmanage/customer_list');?>">Customer List</a></li>
                                        <li><a href="<?php echo base_url('ouradminmanage/customer_registration');?>">New Customer</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-picture-o"></i>Order<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                	    <li><a href="<?php echo base_url('ouradminmanage/order_list');?>">Order List</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-picture-o"></i>Inventory<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                	    <li><a href="<?php echo base_url('ouradminmanage/inventory');?>">Inventory</a></li>
                                    </ul>
                                </li>
                           </ul>
                          </div>
                        <?php if($this->session->userdata('AdminType')=="Super Admin"):?>  
                         <div class="menu_section">
                         	<h3 style="font-size:18px">Website</h3>
                            <ul class="nav side-menu">       
                                <li><a><i class="fa fa-picture-o"></i>Advertisement Manage<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('ouradminmanage/advertisement_list');?>">advertisement List</a></li>
                                            <li><a href="<?php echo base_url('ouradminmanage/advertisement_registration');?>">advertisement Registration</a></li>
                                        </ul>
                                    </li>
                                <li><a><i class="fa fa-bars"></i>Menu Manage<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('ouradminmanage/menu_list');?>">Menu List</a></li>
                                            <li><a href="<?php echo base_url('ouradminmanage/menu_registration');?>">Menu Registration</a></li>
                                        </ul>
                                    </li>
                                <li><a><i class="fa fa-font"></i>Article Manage<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                	    <li><a href="<?php echo base_url('ouradminmanage/article_list');?>">Article List</a></li>
                                        <li><a href="<?php echo base_url('ouradminmanage/article_registration');?>">Article Registration</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-font"></i>Features Manage<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                	    <li><a href="<?php echo base_url('ouradminmanage/feature_list');?>">Features List</a></li>
                                        <li><a href="<?php echo base_url('ouradminmanage/feature_registration');?>">Features Registration</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-picture-o"></i>Banner Banage<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                	    <li><a href="<?php echo base_url('ouradminmanage/banner_list');?>">Banner List</a></li>
                                        <li><a href="<?php echo base_url('ouradminmanage/banner_registration');?>">Banner Registration</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-picture-o"></i>Photo Gallery Manage<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                	    <li><a href="<?php echo base_url('ouradminmanage/photogallery_list');?>">Photo gallery List</a></li>
                                        <li><a href="<?php echo base_url('ouradminmanage/photogallery_registration');?>">New Photo gallery</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-picture-o"></i>Events Manage<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                	    <li><a href="<?php echo base_url('ouradminmanage/events_list');?>">Events List</a></li>
                                        <li><a href="<?php echo base_url('ouradminmanage/events_registration');?>">Events Registration</a></li>
                                    </ul>
                                </li>
                               </ul>
                              </div>
                        <?php endif; ?>
                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>
            <div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="<?php echo base_url();?>asset/images/img.jpg" alt=""><?php echo $this->session->userdata('AdminAccessName');?>
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="javascript:;">  Profile</a></li>
                                    <li><a href="<?php echo base_url('ouradminmanage/logout');?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </li>
                                </ul>
                            </li>

                            

                        </ul>
                    </nav>
                </div>

            </div>