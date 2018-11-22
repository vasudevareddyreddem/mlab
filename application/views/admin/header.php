<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />

    <title>Seller Lab</title>
    <!-- google font -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css" />
    <!-- icons -->
    <link href="<?php echo base_url(); ?>assets/vendor/admin/assets/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/vendor/admin/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!--bootstrap -->
    <link href="<?php echo base_url(); ?>assets/vendor/admin/css/tether.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/vendor/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/vendor/admin/css/bootstrapValidator.min.css" rel="stylesheet" type="text/css" />
    <!-- Material Design Lite CSS -->
    <link href="<?php echo base_url(); ?>assets/vendor/admin/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/vendor/admin/css/material.min.css" rel="stylesheet" >
	<link href="<?php echo base_url(); ?>assets/vendor/admin/css/material_style.css" rel="stylesheet" >
    <!-- Theme Styles -->
    <link href="<?php echo base_url(); ?>assets/vendor/admin/css/theme_style.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/vendor/admin/css/style.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/vendor/admin/css/custom.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/vendor/admin/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/vendor/admin/css/theme-color.css" rel="stylesheet" type="text/css" />
	  <link href="<?php echo base_url(); ?>assets/vendor/admin/css/select2.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo base_url(); ?>assets/vendor/admin/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
	    <script src="<?php echo base_url(); ?>assets/vendor/admin/js/jquery.min.js" ></script>
    <!-- bootstrap -->
    <script src="<?php echo base_url(); ?>assets/vendor/admin/js/bootstrap.min.js" ></script>
    <script src="<?php echo base_url(); ?>assets/vendor/admin/js/bootstrapValidator.min.js" ></script>
    <!-- counterup -->

</head>
<!-- END HEAD -->

<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-indigo white-sidebar-color logo-indigo">
    <div class="page-wrapper">
        <!-- start header -->
        <div class="page-header navbar navbar-fixed-top">
            <div class="page-header-inner ">
                <!-- logo start -->
                <div class="page-logo">
                    <a href="dashboard.php">

                        <span class="logo-default">Seller Admin</span> </a>
                </div>
                <!-- logo end -->
                <ul class="nav navbar-nav navbar-left in">
                    <li><a href="#" class="menu-toggler sidebar-toggler"><i class="fa fa-bars"></i></a></li>
                </ul>
                <!-- start mobile menu -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                    <span></span>
                </a>
                <!-- end mobile menu -->
                <!-- start header menu -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                        <!-- start manage user dropdown -->
                        <li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
							<?php if($mlab_details['profile_pic']==''){ ?>
								<img alt="" class="img-circle " src="<?php echo base_url(); ?>assets/vendor/admin/img/dp.jpg" />
							<?php }else{ ?>
								<img alt="" class="img-circle " src="<?php echo base_url('assets/profile_pic/'.$mlab_details['profile_pic']); ?>" />
							<?php } ?>
						
                               
                                <span class="username username-hide-on-mobile"> <?php echo isset($mlab_details['name'])?$mlab_details['name']:''; ?> </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="<?php echo base_url('profile'); ?>">
                                        <i class="fa fa-user"></i> Profile 
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('profile/changepassword'); ?>">
                                        <i class="fa fa-cog"></i> Change Password
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('dashboard/logout'); ?>">
                                        <i class="fa fa-sign-out"></i> Log Out 
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
	<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
			
			<div style="padding:10px">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 style="pull-left" class="modal-title">Confirmation</h4>
			</div>
			<div class="modal-body">
			<div class="alert alert-danger alert-dismissible" id="errormsg" style="display:none;"></div>
			  <div class="row">
				<div id="content1" class="col-xs-12 col-xl-12 form-group">
				Are you sure ? 
				</div>
				</div>
				<div class="row">
				<div class="col-md-6 col-sm-6  col-sm-6 ">
				  <button type="button" aria-label="Close" data-dismiss="modal" class="btn  blueBtn pull-left">Cancel</button>
				</div>
				<div class="col-md-6 col-sm-6  col-sm-6 ">
                <a href="?id=value" class="btn  blueBtn popid pull-right" style="text-decoration:none;"> <span aria-hidden="true">Ok</span></a>
				</div>
			 </div>
		  </div>
      </div>
      
    </div>
  </div>
	<?php if($this->session->flashdata('success')): ?>
<div class="alert_msg1 animated slideInUp bg-succ">
   <?php echo $this->session->flashdata('success');?> &nbsp; <i class="fa fa-check text-success ico_bac" aria-hidden="true"></i>
</div>
<?php endif; ?>
<?php if($this->session->flashdata('error')): ?>
<div class="alert_msg1 animated slideInUp bg-warn">
   <?php echo $this->session->flashdata('error');?> &nbsp; <i class="fa fa-exclamation-triangle text-success ico_bac" aria-hidden="true"></i>
</div>
<?php endif; ?>