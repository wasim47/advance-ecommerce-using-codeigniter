<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left" style="text-align:center; width:100%; padding:10px">
                            <h1><strong><?php echo $this->session->userdata('AdminAccessName');?></strong> Dashboard</h1>
                        </div>
                        
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">




    





                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                  <div class="col-md-12 col-sm-12 col-xs-12" style="margin:5% 0 10% 0;">
                                    <h1 style="font-size:35px; text-align:center; text-shadow:#ccc 1px 1px">Welcome to Butikbd.com</h1>
                                   <div class="clearfix"></div>
                                     <h1 style="font-size:24px; text-align:center; text-shadow:#333 1px 1px; font-family:solenmanlipi">
                                     স্বপ্ন সাধ্যের সমৃধ্যের সমাহার
                                     </h1>
                                     </div>
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
               