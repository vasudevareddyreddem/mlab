<div class="page-container">
 			<!-- start sidebar menu -->
 			<div class="sidebar-container">
 				<div class="sidemenu-container navbar-collapse collapse fixed-menu">
	                <div id="remove-scroll">
	                    <ul class="sidemenu  page-header-fixed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
	                        <li class="sidebar-toggler-wrapper hide">
	                            <div class="sidebar-toggler">
	                                <span></span>
	                            </div>
	                        </li>
	                        <li class="sidebar-user-panel">
	                            <div class="user-panel">
	                                <div class="pull-left image">
                                    <?php if($mlab_details['profile_pic']==''){ ?>
                                      <img alt="" class="img-circle user-img-circle" src="<?php echo base_url(); ?>assets/vendor/admin/img/dp.jpg" alt="User Image" />
                                    <?php }else{ ?>
                                      <img alt="" class="img-circle user-img-circle" src="<?php echo base_url('assets/profile_pic/'.$mlab_details['profile_pic']); ?>" alt="<?php echo isset($mlab_details['profile_pic'])?$mlab_details['profile_pic']:''; ?>" />
                                    <?php } ?>
	                                </div>
	                                <div class="pull-left info">
	                                    <p> <?php echo isset($mlab_details['email'])?$mlab_details['email']:''; ?></p>
	                                    <a href="#"><i class="fa fa-circle user-online"></i><span class="txtOnline"> Online</span></a>
	                                </div>
	                            </div>
	                        </li>
	                        <li class="nav-item start ">
	                            <a href="<?php echo base_url('pharmacyadmin');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">dashboard</i>
	                                <span class="title">Dashboard</span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>

	                        </li>
	                        <li class="nav-item  ">
	                            <a  href="<?php echo base_url('pharmacyadmin/orders');?>" class="nav-link "> <i class="material-icons">person</i>
	                                <span class="title">Orders</span> <span class="arrow"></span>
	                            </a>
	                        </li>
							<li class="nav-item  ">
									<a  href="<?php echo base_url('pharmacyadmin/rejectedorders');?>" class="nav-link "> <i class="material-icons">person</i>
									<span class="title">Rejected Orders</span> <span class="arrow"></span>
									</a>
							</li>
							<li class="nav-item  ">
	                            <a  href="<?php echo base_url('pharmacyadmin/upload_medicine');?>" class="nav-link "> <i class="material-icons">person</i>
	                                <span class="title">Upload Medicine</span> <span class="arrow"></span>
	                            </a>
	                        </li>
                          <li class="nav-item  ">
                                          <a  href="<?php echo base_url('pharmacyadmin/medicine_list');?>" class="nav-link "> <i class="material-icons">person</i>
                                              <span class="title">Medicine List</span> <span class="arrow"></span>
                                          </a>
                                      </li>
							<li class="nav-item  open">
	                            <a  href="<?php echo base_url('pharmacyadmin/dispatch_medicine');?>" class="nav-link "> <i class="material-icons">person</i>
	                                <span class="title">Dispatch Medicine</span> <span class="arrow"></span>
	                            </a>
	                        </li>
                            <li class="nav-item  ">
	                            <a href="<?php echo base_url('pharmacyadmin/history');?>" class="nav-link "> <i class="material-icons">person</i>
	                                <span class="title">History</span> <span class="arrow"></span>
	                            </a>
	                        </li>
							<li class="nav-item  ">
	                            <a href="<?php echo base_url('pharmacypickupboy/add');?>" class="nav-link "> <i class="material-icons">person</i>
	                                <span class="title">Add PickUp Boy</span> <span class="arrow"></span>
	                            </a>
	                        </li>
							<li class="nav-item  ">
	                            <a href="<?php echo base_url('pharmacypickupboy/index');?>" class="nav-link "> <i class="material-icons">person</i>
	                                <span class="title">PickUp List</span> <span class="arrow"></span>
	                            </a>
	                        </li>
	                    </ul>
	                </div>
                </div>
            </div>
            <!-- end sidebar menu -->
