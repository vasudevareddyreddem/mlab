<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<div class="page-content-wrapper">
    <div class="page-content">

        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>Edit Profile</header>
                    </div>
                    <div class="card-body">
                        <!-- Tab panes -->
                        <form class="pad30 form-horizontal" action=" " method="post" id="edit_profile">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="ep_name" id="ep_name" placeholder="Enter Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Mobile Number</label>
                                    <input type="text" class="form-control" name="ep_mobile" id="ep_mobile" placeholder="Enter Mobile Number">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Email Id</label>
                                    <input type="text" class="form-control" name="ep_email" id="ep_email" placeholder="Enter Email Id">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Address1</label>
                                    <input type="text" class="form-control" name="" id="" placeholder="Address1">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>City</label>
                                    <input type="text" class="form-control" name="" id="" placeholder="Enter City">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>State</label>
                                    <input type="text" class="form-control" name="" id="" placeholder="Enter State">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Zipcode</label>
                                    <input type="text" class="form-control" name="" id="" placeholder="Enter Zipcode">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label>Profile Pic</label>
                                    <input type="file" class="form-control" name="" id="">
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


<?php include('footer.php'); ?>

<script>
	$(document).ready(function() {
    $('#edit_profile').bootstrapValidator({
        
        fields: {
            ep_name: {
                validators: {
                    notEmpty: {
                        message: 'Please enter Name'
                    }
                }
            },
            ep_mobile: {
                validators: {
                    notEmpty: {
                        message: 'Please enter mobile number'
                    }
                }
            },
            ep_email: {
                validators: {
                    notEmpty: {
                        message: 'Please enter email id'
                    }
                }
            }
            }
        })
     
});
</script>
