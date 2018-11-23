<!DOCTYPE html>
<html>


<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />

    <title>Seller Lab</title>
    <!-- google font -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css" />
    <!-- icons -->
    <link href="<?php echo base_url(); ?>assets/vendor/admin/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- bootstrap -->
    <link href="<?php echo base_url(); ?>assets/vendor/admin/css/tether.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/vendor/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	    <link href="<?php echo base_url(); ?>assets/vendor/admin/css/bootstrapValidator.min.css" rel="stylesheet" type="text/css" />

    <!-- style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/admin/css/login.css">
    <!-- favicon -->

</head>
<style>
.login-form input {
    margin:0px;
}
</style>
<body class="backimg" style="background-image: url(<?php echo base_url(); ?>assets/vendor/admin/img/login-background.png);">
    <div class="form-title">
        <h1>&nbsp;</h1>
    </div>
    <!-- Login Form-->
    <div class="login-form text-center">
        <div class="">
        </div>
        <div class="form formLogin" style="padding-top:20px">
            <h2 ><strong>Login to your account</strong></h2>
              <form id="login_form" action="<?php echo base_url('admin/loginpost'); ?>" method="post">
				<?php $csrf = array(
						'name' => $this->security->get_csrf_token_name(),
						'hash' => $this->security->get_csrf_hash()
									); ?>
				<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
				<div class="form-group ">
				<input type="text" class="form-control" id="email" name="email" value="<?php echo $this->input->cookie('username');?>"	placeholder="Email" required>
				
			  </div>
			  <div class="form-group ">
				<input type="password" class="form-control" id="password" name="password" value="<?php echo $this->input->cookie('password');?>" placeholder="Password" required>
			  </div>
			   <div class="remember text-left">
                    <div class="checkbox checkbox-primary">
						<?php if($this->input->cookie('remember')!=''){ ?>
                        <input id="checkbox2" type="checkbox" checked  name="remember_me" value="1">
						 <?php } else{ ?>
						   <input id="checkbox2" type="checkbox"   name="remember_me" value="1">
						 <?php } ?>
                        <label for="checkbox2">
                            Remember me
                        </label>
                    </div>
                </div>
                <button  type="submit"  class="btn btn-primary btn-block text-white">Login</button>
                <div class="forgetPassword"><a href="<?php echo base_url('admin/forgotpassword'); ?>">Forgot your password?</a>
                </div>
            </form>
        </div>

    </div>
    <!-- start js include path -->
    <script src="<?php echo base_url(); ?>assets/vendor/admin/js/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/vendor/admin/js/bootstrap.min.js" ></script>
   <script src="<?php echo base_url(); ?>assets/vendor/admin/js/bootstrapValidator.min.js" ></script>
    <script src="<?php echo base_url(); ?>assets/vendor/admin/js/login.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/admin/js/pages.js"></script>
    <!-- end js include path -->
<script>
	$(document).ready(function() {
    $('#login_form').bootstrapValidator({
        
        fields: {
            email: {
                validators: {
					notEmpty: {
						message: 'Email is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
					message: 'Please enter a valid email address. For example johndoe@domain.com.'
					}
				}
            },
             
            password: {
                validators: {
					notEmpty: {
						message: 'Password is required'
					},
					stringLength: {
                        min: 6,
                        message: 'Password  must be at least 6 characters'
                    },
					regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~'"\\|=^?$%*)(_+-]*$/,
					message: 'Password wont allow <>[]'
					}
				}
                }
            }
        })
     
});	
</script>    
    
</body>
</html>
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