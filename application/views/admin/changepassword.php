<div class="page-content-wrapper">
    <div class="page-content">

        <div class="row">
            <div class="col-md-12 mx-auto my-auto">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>Change Password</header>
                    </div>
                    <div class="card-body">
                        <!-- Tab panes -->
                        <form class="" action="<?php echo base_url('profile/changepasswordpost/'); ?>" method="post" id="changepassword">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Old Password</label>
                                    <input type="password" class="form-control" name="oldpassword" id="oldpassword" placeholder="Old Password">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>New Password</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="New Password">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Confirm New Passowrd</label>
                                    <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Confirm New Password">
                                </div>
                                <div class="clearfix">&nbsp;</div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
	$(document).ready(function() {
    $('#changepassword').bootstrapValidator({
        
        fields: {
            oldpassword: {
                validators: {
					notEmpty: {
						message: 'Old Password is required'
					},
					stringLength: {
                        min: 6,
                        message: 'Old Password  must be at least 6 characters'
                    },
					regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~'"\\|=^?$%*)(_+-]*$/,
					message: 'Old Password wont allow <>[]'
					}
				}
            }, password: {
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
            },
           
            confirmpassword: {
					 validators: {
						 notEmpty: {
						message: 'Confirm Password is required'
					},
					identical: {
						field: 'password',
						message: 'password and confirm Password do not match'
					}
					}
				}
            }
        })
     
});
</script>
