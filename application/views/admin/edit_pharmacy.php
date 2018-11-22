
			<div class="page-content-wrapper">
                <div class="page-content">
                    
					<div class="row">
                       <div class="col-md-12">
                            <div class="card card-topline-aqua">
                                <div class="card-head">
                                     <header>Edit Pharmacy</header>
                                    <div class="tools">
                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
	                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
	                                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body ">
                                    <div class="container">
									<form class="" action="<?php echo base_url('pharmacy/editpost/'); ?>" method="post" id="add_seller" name="add_seller" enctype="multipart/form-data">
											<input type="hidden" name="a_id" id="a_id" value="<?php echo isset($pharmacy_details['a_id'])?$pharmacy_details['a_id']:''; ?>">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label> Name of the Pharmacy</label>
                                                <input type="text" class="form-control"  name="name" id="name" placeholder="Enter Name" value="<?php echo isset($pharmacy_details['name'])?$pharmacy_details['name']:''; ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label> Email Address </label>
                                                <input type="email" class="form-control"  name="email" id="email" placeholder="Enter Email" value="<?php echo isset($pharmacy_details['email'])?$pharmacy_details['email']:''; ?>">
                                            </div>
                                         
                                            <div class="form-group col-md-6">
                                                <label >Mobile Number</label>
                                                <input type="text" class="form-control"  name="mobile" id="mobile" placeholder="Enter Mobile" value="<?php echo isset($pharmacy_details['mobile'])?$pharmacy_details['mobile']:''; ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label> Landline / Alternate Mobile No </label>
                                                <input type="text" class="form-control"  name="altmobile" id="altmobile" placeholder="Landline / Alternate Mobile No" value="<?php echo isset($pharmacy_details['altmobile'])?$pharmacy_details['altmobile']:''; ?>">
                                            </div> 
                                            <div class="form-group col-md-6">
                                                <label> GSTIN </label>
                                                <input type="text" class="form-control"  name="gstin" id="gstin" placeholder="GSTIN" value="<?php echo isset($pharmacy_details['gstin'])?$pharmacy_details['gstin']:''; ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label >Address</label>
                                                <input type="text" class="form-control"  name="address" id="address" placeholder="Enter Address" value="<?php echo isset($pharmacy_details['address1'])?$pharmacy_details['address1']:''; ?>">
                                            </div>
											 <div class="form-group col-md-6">
												<label>City</label>
												<input type="text" class="form-control" name="city" id="city" placeholder="Enter City" value="<?php echo isset($pharmacy_details['city'])?$pharmacy_details['city']:''; ?>">
											</div>
											     
								  <?php $states = array ('Andhra Pradesh' => 'Andhra Pradesh', 'Arunachal Pradesh' => 'Arunachal Pradesh', 'Assam' => 'Assam', 'Bihar' => 'Bihar', 'Chhattisgarh' => 'Chhattisgarh', 'Goa' => 'Goa', 'Gujarat' => 'Gujarat', 'Haryana' => 'Haryana', 'Himachal Pradesh' => 'Himachal Pradesh', 'Jammu & Kashmir' => 'Jammu & Kashmir', 'Jharkhand' => 'Jharkhand', 'Karnataka' => 'Karnataka', 'Kerala' => 'Kerala', 'Madhya Pradesh' => 'Madhya Pradesh', 'Maharashtra' => 'Maharashtra', 'Manipur' => 'Manipur', 'Meghalaya' => 'Meghalaya', 'Mizoram' => 'Mizoram', 'Nagaland' => 'Nagaland', 'Odisha' => 'Odisha', 'Punjab' => 'Punjab', 'Rajasthan' => 'Rajasthan', 'Sikkim' => 'Sikkim', 'Tamil Nadu' => 'Tamil Nadu', 'Telangana' => 'Telangana', 'Tripura' => 'Tripura', 'Uttarakhand' => 'Uttarakhand','Uttar Pradesh' => 'Uttar Pradesh', 'West Bengal' => 'West Bengal', 'Andaman & Nicobar' => 'Andaman & Nicobar', 'Chandigarh' => 'Chandigarh', 'Dadra and Nagar Haveli' => 'Dadra and Nagar Haveli', 'Daman & Diu' => 'Daman & Diu', 'Delhi' => 'Delhi', 'Lakshadweep' => 'Lakshadweep', 'Puducherry' => 'Puducherry'); ?>
                                            <div class="form-group col-md-6">
                                                <label >State</label>
                                                <select class="form-control" name="state" id="state">
												  <option value="">Select State</option>
                                                   <?php foreach($states as $key=>$state):
														if($pharmacy_details['state'] == $state):
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
                                                <input type="text" class="form-control"  name="country" id="country" placeholder="Enter Country" value="<?php echo isset($pharmacy_details['country'])?$pharmacy_details['country']:''; ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label> Pincode </label>
                                                <input type="text" class="form-control"  name="pincode" id="pincode" placeholder="Enter PinCode" value="<?php echo isset($pharmacy_details['zipcode'])?$pharmacy_details['zipcode']:''; ?>">
                                            </div>
											<div class="form-group col-md-6">
                                                <label> Accrediations </label>
                                                <input type="text" class="form-control"  name="accrediations" id="accrediations" placeholder="Enter Accrediations"  value="<?php echo isset($pharmacy_details['accrediations'])?$pharmacy_details['accrediations']:''; ?>">
                                            </div> 											
                                            <div class="clearfix">&nbsp;</div>
                                            <div class="col-md-12 text-center">
                                                    <button type="submit" class="btn btn-primary">Update Pharmacy</button>
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
    $('#add_seller').bootstrapValidator({
        
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
			altmobile: {
                 validators: {
					notEmpty: {
						message: 'Landline / Alternate Mobile No  is required'
					},
					regexp: {
					regexp:  /^[0-9]{10,14}$/,
					message:'Landline / Alternate Mobile No  must be 10 to 14 digits'
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
            },gstin: {
                validators: {
					notEmpty: {
						message: 'GSTIN is required'
					},
                    regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'GSTIN wont allow <> [] = % '
					}
                }
            },accrediations: {
                validators: {
					notEmpty: {
						message: 'Accrediations is required'
					},
                    regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Accrediations wont allow <> [] = % '
					}
                }
            },address: {
                validators: {
					notEmpty: {
						message: 'Address is required'
					},
                    regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Address wont allow <> [] = % '
					}
                }
            },pincode: {
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
