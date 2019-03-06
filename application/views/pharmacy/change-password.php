
<div class="page-content-wrapper">
    <div class="page-content">

        <div class="row">
            <div class="col-md-6 mx-auto my-auto">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>Change Password</header>
                    </div>
                    <div class="card-body">
                        <!-- Tab panes -->
                        <form class="pad30 form-horizontal" action=" " method="post" id="change_password">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Old Password</label>
                                    <input type="text" class="form-control" name="old_pass" id="old_pass" placeholder="Enter Test Type">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>New Password</label>
                                    <input type="text" class="form-control" name="new_pass" id="new_pass" placeholder="Enter Test Name">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Confirm New Passowrd</label>
                                    <input type="text" class="form-control" name="confirm_new_pass" id="confirm_new_pass" placeholder="Confirm New Password">
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
    $('#change_password').bootstrapValidator({

        fields: {
            old_pass: {
                validators: {
                    notEmpty: {
                        message: 'Please enter old password'
                    }
                }
            },
            new_pass: {
                validators: {
                    notEmpty: {
                        message: 'Please enter new password'
                    }
                }
            },
            confirm_new_pass: {
                validators: {
                    notEmpty: {
                        message: 'Please confirm new password'
                    }
                }
            }
            }
        })

});
</script>
