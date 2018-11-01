<!DOCTYPE html>
<html>


<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />

    <title>Forgot Password</title>
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

<body class="backimg">
    <div class="form-title">
        <h1>Forgot Password</h1>
    </div>
    <!-- Login Form-->
    <div class="login-form text-center">
        <div class="">
        </div>
        <div class="form formLogin">
            <h2>Forgot Password</h2>
              <form id="login_form" action="<?php echo base_url('admin/forgotpost'); ?>" method="post">
				<?php $csrf = array(
						'name' => $this->security->get_csrf_token_name(),
						'hash' => $this->security->get_csrf_hash()
									); ?>
				<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
				<div class="form-group ">
				<input type="text" class="form-control" id="email" name="email" value=""	placeholder="Email Address" required>
				
			  </div>
                <button  type="submit"  class="btn btn-primary btn-block text-white">Submit</button>
               
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