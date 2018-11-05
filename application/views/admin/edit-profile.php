
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
                        <form class="" action="<?php echo base_url('profile/editpost/'); ?>" method="post" id="edit_profile" name="edit_profile" enctype="multipart/form-data">
                            <div class="row">
									<input type="hidden" name="a_id" id="a_id" value="<?php echo isset($mlab_details['a_id'])?$mlab_details['a_id']:''; ?>">
                                <div class="form-group col-md-6">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" value="<?php echo isset($mlab_details['name'])?$mlab_details['name']:''; ?>">
                                </div>
                              
								<div class="form-group col-md-6">
                                    <label>Mobile Number</label>
                                    <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter Mobile Number" value="<?php echo isset($mlab_details['mobile'])?$mlab_details['mobile']:''; ?>">
                                </div>
								  <div class="form-group col-md-6">
                                    <label> Landline / Alternate Mobile No </label>
                                    <input type="text" class="form-control" name="altmobile" id="altmobile" placeholder="Enter Landline / Alternate Mobile Number" value="<?php echo isset($mlab_details['altmobile'])?$mlab_details['altmobile']:''; ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Email Id</label>
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email Id" value="<?php echo isset($mlab_details['email'])?$mlab_details['email']:''; ?>">
                                </div> 
								<div class="form-group col-md-6">
                                    <label>GSTIN</label>
                                    <input type="text" class="form-control" name="gstin" id="gstin" placeholder="Enter GSTIN " value="<?php echo isset($mlab_details['gstin'])?$mlab_details['gstin']:''; ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Address1</label>
                                    <input type="text" class="form-control" name="address1" id="address1" placeholder="Address1" value="<?php echo isset($mlab_details['address1'])?$mlab_details['address1']:''; ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Address2</label>
                                    <input type="text" class="form-control" name="address2" id="address2" placeholder="Address2" value="<?php echo isset($mlab_details['address2'])?$mlab_details['address2']:''; ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>City</label>
                                    <input type="text" class="form-control" name="city" id="city" placeholder="Enter City" value="<?php echo isset($mlab_details['city'])?$mlab_details['city']:''; ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>State</label>
                                    <input type="text" class="form-control" name="state" id="state" placeholder="Enter State" value="<?php echo isset($mlab_details['state'])?$mlab_details['state']:''; ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Zipcode</label>
                                    <input type="text" class="form-control" name="zipcode" id="zipcode" placeholder="Enter Zipcode" value="<?php echo isset($mlab_details['zipcode'])?$mlab_details['zipcode']:''; ?>">
                                </div>
								<div class="form-group col-md-6">
                                    <label>Profile Pic</label>
                                    <input type="file" class="form-control" name="image" id="image" placeholder="Enter Zipcode" value="<?php echo isset($mlab_details['zipcode'])?$mlab_details['zipcode']:''; ?>">
                                </div>
                                <div class="clearfix">&nbsp;</div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
    $('#edit_profile').bootstrapValidator({
        
        fields: {
            name: {
                  validators: {
					notEmpty: {
						message: 'Name is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Name can only consist of alphanumeric, space and dot'
					}
				}
            },
            mobile: {
                 validators: {
					notEmpty: {
						message: 'Mobile Number is required'
					},
					regexp: {
					regexp:  /^[0-9]{10,14}$/,
					message:'Mobile Number must be 10 to 14 digits'
					}
				
				}
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Please enter email id'
                    },
					regexp: {
					regexp: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
					message: 'Please enter a valid email address. For example johndoe@domain.com.'
					}
                }
            },
			address1: {
                validators: {
					notEmpty: {
						message: 'Address1 is required'
					},
                    regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Address1 wont allow <> [] = % '
					}
                }
            },address2: {
                validators: {
                    regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Address2 wont allow <> [] = % '
					}
                }
            },zipcode: {
              validators: {
					notEmpty: {
						message: 'Pin code is required'
					},
					regexp: {
					regexp: /^[0-9]{5,7}$/,
					message: 'Pin code  must be  5 to 7 characters'
					}
				}
            },city: {
               validators: {
					notEmpty: {
						message: 'City is required'
					},
					regexp: {
					regexp: /^[a-zA-Z ]+$/,
					message: 'City can only consist of alphabets and Space'
					}
				
				}
            },state: {
                validators: {
					notEmpty: {
						message: 'State is required'
					},
					regexp: {
					regexp: /^[a-zA-Z ]+$/,
					message: 'State can only consist of alphabets and Space'
					}
				
				}
            },image: {
                validators: {
					regexp: {
					regexp: "(.*?)\.(png|jpg|jpeg|gif|Png)$",
					message: 'Uploaded file is not a valid. Only png,jpg,jpeg,gif,Png files are allowed'
					}
				}
            }
            }
        })
     
});
</script>
