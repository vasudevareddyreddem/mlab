<div class="page-content-wrapper">
  <div class="page-content">

    <div class="row">
      <div class="col-md-12">
        <div class="card card-topline-aqua">
          <div class="card-head">
            <header>Add Pickup Boy</header>
            <div class="tools">
              <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
              <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
              <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
            </div>
          </div>
          <div class="card-body ">
            <div class="container">
              <form class="" action="<?php echo base_url('pickupboy/update'); ?>" method="post" id="add_pickupboy" name="add_pickupboy" enctype="multipart/form-data">

                <div class="row">
                  <div class="form-group col-md-6">
                    <label> Name</label>
                    <input type="text" class="form-control"  name="name" id="name" placeholder="Enter Name" value="<?php if (isset($pickupboy_details['name'])) { echo $pickupboy_details['name']; } ?>">
                  </div>
                  <div class="form-group col-md-6">
                    <label> Email Address </label>
                    <input type="text" class="form-control"  name="email" id="email" placeholder="Enter Email" value="<?php if (isset($pickupboy_details['email'])) { echo $pickupboy_details['email']; } ?>">
                  </div>
                  <div class="form-group col-md-6">
                    <label >Mobile Number</label>
                    <input type="text" class="form-control"  name="mobile" id="mobile" placeholder="Enter Mobile"  value="<?php if (isset($pickupboy_details['mobile'])) { echo $pickupboy_details['mobile']; } ?>">
                  </div>
              <div class="form-group col-md-6">
                <label >Address</label>
                <input type="text" class="form-control"  name="address1" id="address" placeholder="Enter Address" value="<?php if (isset($pickupboy_details['address1'])) { echo $pickupboy_details['address1']; } ?>">
              </div>
              <div class="form-group col-md-6">
                <label>City</label>
                <input type="text" class="form-control" name="city" id="city" placeholder="Enter City" value="<?php if (isset($pickupboy_details['city'])) { echo $pickupboy_details['city']; } ?>">
              </div>

              <?php $states = array ('Andhra Pradesh' => 'Andhra Pradesh', 'Arunachal Pradesh' => 'Arunachal Pradesh', 'Assam' => 'Assam', 'Bihar' => 'Bihar', 'Chhattisgarh' => 'Chhattisgarh', 'Goa' => 'Goa', 'Gujarat' => 'Gujarat', 'Haryana' => 'Haryana', 'Himachal Pradesh' => 'Himachal Pradesh', 'Jammu & Kashmir' => 'Jammu & Kashmir', 'Jharkhand' => 'Jharkhand', 'Karnataka' => 'Karnataka', 'Kerala' => 'Kerala', 'Madhya Pradesh' => 'Madhya Pradesh', 'Maharashtra' => 'Maharashtra', 'Manipur' => 'Manipur', 'Meghalaya' => 'Meghalaya', 'Mizoram' => 'Mizoram', 'Nagaland' => 'Nagaland', 'Odisha' => 'Odisha', 'Punjab' => 'Punjab', 'Rajasthan' => 'Rajasthan', 'Sikkim' => 'Sikkim', 'Tamil Nadu' => 'Tamil Nadu', 'Telangana' => 'Telangana', 'Tripura' => 'Tripura', 'Uttarakhand' => 'Uttarakhand','Uttar Pradesh' => 'Uttar Pradesh', 'West Bengal' => 'West Bengal', 'Andaman & Nicobar' => 'Andaman & Nicobar', 'Chandigarh' => 'Chandigarh', 'Dadra and Nagar Haveli' => 'Dadra and Nagar Haveli', 'Daman & Diu' => 'Daman & Diu', 'Delhi' => 'Delhi', 'Lakshadweep' => 'Lakshadweep', 'Puducherry' => 'Puducherry'); ?>
              <div class="form-group col-md-6">
                <label >State</label>
                <select class="form-control" name="state" id="state">
                  <option value="">Select State</option>
                  <?php foreach($states as $key=>$state):
                    if($pickupboy_details['state'] == $state):
                      $selected ='selected=selected';
                      else :
                        $selected = '';
                      endif;
                      ?>
                      <option value = "<?php echo $state?>" <?php echo $selected;?> ><?php echo $state?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label >Country</label>
                  <input type="text" class="form-control"  name="country" id="country" placeholder="Enter Country" value="<?php if (isset($pickupboy_details['country'])) { echo $pickupboy_details['country']; } ?>">
                </div>
                <div class="form-group col-md-6">
                  <label> Pincode </label>
                  <input type="text" class="form-control"  name="zipcode" id="zipcode" placeholder="Enter PinCode" value="<?php if (isset($pickupboy_details['zipcode'])) { echo $pickupboy_details['zipcode']; } ?>">
                </div>
                <div class="clearfix">&nbsp;</div>
                <input type="hidden" name="a_id" id="a_id" value="<?php echo isset($pickupboy_details['a_id']) ? $pickupboy_details['a_id']:''; ?>">
                <div class="col-md-12 text-center">
                  <button type="submit" class="btn btn-primary">Add Pickup Boy</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix">&nbsp;</div>
  </div>
</div>
</div>


</div>
</div>
<script>
$(document).ready(function() {
  $('#add_pickupboy').bootstrapValidator({
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
      password: {
        validators: {
          notEmpty: {
            message: 'Password is required'
          },
          stringLength: {
            min: 6,
            message: 'Password  must be at least 6 characters. '
          },
          regexp: {
            regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~'"\\|=^?$%*)(_+-]*$/,
              message: 'Password wont allow <>[]'
            }
          }
        },confirmPassword: {
          validators: {
            notEmpty: {
              message: 'Confirm Password is required'
            },
            identical: {
              field: 'password',
              message: 'Password and Confirm Password do not match'
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
      }

    }
  },country: {
    validators: {
      notEmpty: {
        message: 'Country is required'
      },
      regexp: {
        regexp: /^[a-zA-Z ]+$/,
        message: 'Country can only consist of alphabets and Space'
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
