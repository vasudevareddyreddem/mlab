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
    <script src="<?php echo base_url(); ?>assets/vendor/admin/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/admin/js/login.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/admin/js/pages.js"></script>

    <link href="<?php echo base_url(); ?>assets/vendor/admin/css/tether.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/vendor/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <!-- style -->
    <link rel="stylesheet" href="<?php echo base_url('application\views\pickup-boy\css\login.css'); ?>">
    <!-- favicon -->

</head>

<body class="backimg">
<div class="form-title">
    <h1>Login Form</h1>
</div>
<!-- Login Form-->
<div  class="login-form text-center">
    <div class="">
    </div>
    <div class="form formLogin">
        <h2>Pickup Boy Regestration</h2>
        <form method="post" action="<?php echo base_url('pickupboy/registerpost');?>" id="login_form">
            <div>
            <input  class='form-control' type="text" placeholder="Username" name="username" id="username"/>
            </div>
            <div>
            <input  class='form-control' type="text" placeholder="Email" name="email" id="email"/>
            </div>
            <div>
            <input type="text"  class='form-control' placeholder="Phone Number" name="mobile" id="mobile"/>
            </div>
            <div>

            <input type="password"  class='form-control' placeholder="Password" name="password" id="password"/>
            </div>
            <div>
            <input type="text" class='form-control' placeholder="Confirm Password" name="cpassword" id="cpassword"/>
            </div>
            <div>
            <select name="lab_id" ><option value="">Select Lab</option>
                  <?php foreach ($lab_list as $lab){?>
                <option value="<?php echo $lab->a_id; ?>"><?php echo $lab->name; ?></option>
                <?php }?>
            </select>
            </div>
            <div>
            <button type="submit">Register</button>
            </div>
        </form>
    </div>
    </div>




</div>
<!-- start js include path -->

<!-- end js include path -->
<script>
    $(document).ready(function() {
        $('#login_form').bootstrapValidator({

            fields: {
                username: {
                    validators: {
                        notEmpty: {
                            message: 'Username is required'
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'Email is required'
                        }
                    }
                },
                mobile: {
                    validators: {
                        notEmpty: {
                            message: 'Phone Number is required'
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'Password is required'
                        }
                    }
                }
            }
        })

    });
</script>

</body>
</html>