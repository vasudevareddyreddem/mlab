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
	                                    <p> <?php echo isset($mlab_details['name'])?$mlab_details['name']:''; ?> </p>
	                                    <a href="#"><i class="fa fa-circle user-online"></i><span class="txtOnline"> Online</span></a>
	                                </div>
	                            </div>
	                        </li>
	                        <li class="nav-item start ">
	                            <a href="<?php echo base_url('dashboard'); ?>" class="nav-link nav-toggle">
	                                <i class="material-icons">dashboard</i>
	                                <span class="title">Dashboard</span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
                            </li>
							<?php if($mlab_details['role']==1){ ?>
                            <li class="nav-item <?php if($this->uri->segment(1)=='lab' || $this->uri->segment(1)=='seller'){ echo "active";} ?>">
	                            <a  class="nav-link nav-toggle"> <i class="fa fa-flask"></i>
	                                <span class="title">Seller Lab</span>  <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="<?php echo base_url('seller'); ?>" class="nav-link "> <span class="title">Add</span>
                                        </a>
                                    </li>
                                    <li class="nav-item ">
                                        <a href="<?php echo base_url('seller/lists'); ?>" class="nav-link "> <span class="title">List</span>
                                        </a>
                                    </li>
									<li class="nav-item ">
                                        <a href="<?php echo base_url('lab/orders'); ?>" class="nav-link "> <span class="title">Orders</span>
                                        </a>
                                    </li>
	                            </ul>
	                        </li>
                            <li class="nav-item <?php if($this->uri->segment(1)=='pharmacy'){ echo "active";} ?>">
	                            <a  class="nav-link nav-toggle"> <i class="fa fa-hospital-o"></i>
	                                <span class="title">Seller Pharmacy</span>  <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="<?php echo base_url('pharmacy'); ?>" class="nav-link "> <span class="title">Add</span>
                                        </a>
                                    </li>
                                    <li class="nav-item ">
                                        <a href="<?php echo base_url('pharmacy/lists'); ?>" class="nav-link "> <span class="title">List</span>
                                        </a>
                                    </li>
	                            </ul>
	                        </li>
							<li class="nav-item ">
	                            <a href="<?php echo base_url('payments/lists'); ?>" class="nav-link "> <i class="fa fa-money"></i>
	                                <span class="title">Payments</span> <span class="arrow"></span>
	                            </a>
	                        </li>
							<?php }else if($mlab_details['role']==2){ ?>
							<li class="nav-item  ">
	                            <a  href="<?php echo base_url('lab/allorders'); ?>" class="nav-link ">
                                    <i class="fa fa-ambulance"></i>
	                                <span class="title">Order Pickup</span> <span class="arrow"></span>
	                            </a>
	                        </li>
							<li class="nav-item  ">
	                            <a  href="<?php echo base_url('lab/reports'); ?>" class="nav-link ">
                                    <i class="fa fa-copy" style="font-weight: bold;"></i>
	                                <span class="title">Upload Reports</span> <span class="arrow"></span>
	                            </a>
	                        </li>
							<li class="nav-item  ">
	                            <a  href="<?php echo base_url('lab'); ?>" class="nav-link ">
                                    <i class="fa fa-file-text"></i>
	                                <span class="title">Upload Lab Tests</span> <span class="arrow"></span>
	                            </a>
	                        </li>
							<li class="nav-item  ">
	                            <a  href="<?php echo base_url('lab/packages'); ?>" class="nav-link ">
                                    <i class="fa fa-upload"></i>
	                                <span class="title">Upload Lab Packages</span> <span class="arrow"></span>
	                            </a>
	                        </li>
							<li class="nav-item  ">
	                            <a href="<?php echo base_url('history/laborders'); ?>" class="nav-link ">
                                    <i class="fa fa-history"></i>
	                                <span class="title">History</span> <span class="arrow"></span>
	                            </a>
	                        </li>
                            <li class="nav-item  ">
	                            <a href="<?php echo base_url('payments'); ?>" class="nav-link ">
                                    <i class="fa fa-money"></i>
	                                <span class="title">Payments</span> <span class="arrow"></span>
	                            </a>
	                        </li>
                            <li class="nav-item">
	                            <a  class="nav-link nav-toggle">
                                    <i class="fa fa-money"></i>
	                                <span class="title">Add PickUp Boy</span> <span class="arrow"></span>
	                            </a>
                              <ul class="sub-menu">
                                  <li class="nav-item">
                                      <a href="<?php echo base_url('pickupboy/create'); ?>" class="nav-link "> <span class="title">Add</span>
                                      </a>
                                  </li>
                                  <li class="nav-item ">
                                      <a href="<?php echo base_url('pickupboy'); ?>" class="nav-link "> <span class="title">List</span>
                                      </a>
                                  </li>
                            </ul>
	                        </li>
							<?php } elseif ($mlab_details['role']==4) { ?>
                <li class="nav-item">
                    <a href="<?php echo base_url('pickupboy/pickup'); ?>" class="nav-link"> <i class="fa fa-hourglass-half"></i>
                        <span class="title">Pick Up Orders</span> <span class="arrow"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('pickupboy/ongoing'); ?>" class="nav-link"> <i class="fa fa-truck"></i>
                        <span class="title">on Going Orders</span> <span class="arrow"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('pickupboy/completed'); ?>" class="nav-link"> <i class="fa fa-check-circle"></i>
                        <span class="title">Completed Orders</span> <span class="arrow"></span>
                    </a>
                </li>
              <?php } elseif ($mlab_details['role']==3) { ?>
                <li class="nav-item  ">
	                            <a  href="<?php echo base_url('pharmacyadmin/orders');?>" class="nav-link "> <i class="material-icons">person</i>
	                                <span class="title">Orders</span> <span class="arrow"></span>
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
              <?php }?>
                            <li class="nav-item ">
	                            <a href="<?php echo base_url('dashboard/logout'); ?>" class="nav-link ">
                                    <i class="fa fa-sign-out"></i>
	                                <span class="title">Logout</span> <span class="arrow"></span>
	                            </a>
	                        </li>
	                    </ul>
	                </div>
                </div>
            </div>
            <!-- end sidebar menu -->
