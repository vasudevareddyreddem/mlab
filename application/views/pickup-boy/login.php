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
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- bootstrap -->
    <link href="css/tether.min.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- style -->
    <link rel="stylesheet" href="css/login.css">
    <!-- favicon -->

</head>

<body class="backimg">
    <div class="form-title">
        <h1>Login Form</h1>
    </div>
    <!-- Login Form-->
    <div class="login-form text-center">
        <div class="">
        </div>
        <div class="form formLogin">
            <h2>Login to your account</h2>
            <form method="" action="" id="login_form">
                <input type="text" placeholder="Username" name="username" id="username"/>
                <input type="password" placeholder="Password" name="password" id="password"/>
                <div class="remember text-left">
                    <div class="checkbox checkbox-primary">
                        <input id="checkbox2" type="checkbox" checked>
                        <label for="checkbox2">
                            Remember me
                        </label>
                    </div>
                </div>
                <a href="dashboard.php" class="btn btn-primary btn-block text-white">Login</a>
                <div class="forgetPassword"><a href="javascript:void(0)">Forgot your password?</a>
                </div>
            </form>
        </div>

        <div class="form formReset">
            <h2>Reset your password?</h2>
            <form>
                <input type="email" placeholder="Email Address" />
                <button>Send Verification Email</button>
            </form>
        </div>
    </div>
    <!-- start js include path -->
    <script src="js/jquery.min.js"></script>
    <script src="js/login.js"></script>
    <script src="js/pages.js"></script>
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