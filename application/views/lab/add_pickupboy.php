
<div class="page-content-wrapper">
    <div class="page-content">

        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>Add PickUp Boy</header>
                    </div>
                    <div class="card-body">
                        <!-- Tab panes -->
                        <form class="" action="" method="post" id="add_pickup_boy" name="add_pickup_boy" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" value="">
                                </div>
								<div class="form-group col-md-6">
                                    <label>Mobile Number</label>
                                    <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter Mobile Number" value="">
                                </div>
								  <div class="form-group col-md-6">
                                    <label> Mobile No </label>
                                    <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter Landline / Alternate Mobile Number" value="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Email Id</label>
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email Id" value="">
                                </div> 
                                <div class="form-group col-md-6">
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="address" id="address" placeholder="Address" value="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>City</label>
                                    <input type="text" class="form-control" name="city" id="city" placeholder="Enter City" value="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>State</label>
                                    <input type="text" class="form-control" name="state" id="state" placeholder="Enter State" value="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Zipcode</label>
                                    <input type="text" class="form-control" name="zipcode" id="zipcode" placeholder="Enter Zipcode" value="">
                                </div>
								<div class="form-group col-md-6">
                                    <label>Profile Pic</label>
                                    <input type="file" class="form-control" name="image" id="image" value="">
                                </div>
                                <div class="clearfix">&nbsp;</div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
    $('#add_pickup_boy').bootstrapValidator({
        
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
			address: {
                validators: {
					notEmpty: {
						message: 'Address is required'
					},
                    regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Address wont allow <> [] = % '
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
