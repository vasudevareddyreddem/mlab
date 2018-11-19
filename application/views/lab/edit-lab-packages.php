
<div class="page-content-wrapper">
    <div class="page-content">

        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>Edit Test Package </header>
                    </div>
                    <div class="card-body">
                        
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <form class="pad30 form-horizontal" action="<?php echo base_url('lab/packageeditpost'); ?>" method="post" id="add_package_name" name="add_package_name">
							<input type="hidden" name="p_id" id="p_id" value="<?php echo isset($packages_name_details['l_t_p_id'])?$packages_name_details['l_t_p_id']:''; ?>">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Test Package Name</label>
                                            <input type="text" class="form-control" name="test_package_name" id="test_package_name" placeholder="Enter Package Name" value="<?php echo isset($packages_name_details['test_package_name'])?$packages_name_details['test_package_name']:''; ?>">
                                        </div>
										<?php if(isset($packages_name_details['package_test_list']) && count($packages_name_details['package_test_list'])>0){ 
										
										foreach($packages_name_details['package_test_list'] as $li){
											$l_ids[]=$li['test_id'];
											
										}
										
										
										 } ?>
                                        <div class="form-group col-md-6">
                                            <label>Test Names</label>
                                            <select class="form-control select2" name="test_name[]" id="test_name" multiple="multiple">
                                                <option value="">Select Tests</option>
												<?php if(isset($test_lists) && count($test_lists)>0){ ?>
													<?php foreach($test_lists as $lis){ ?>
														<?php if (in_array($lis['l_id'], $l_ids)){ ?>
															<option selected value="<?php echo $lis['l_id']; ?>"><?php echo $lis['test_name']; ?></option>
														<?php }else{ ?>
		  
															<option value="<?php echo $lis['l_id']; ?>"><?php echo $lis['test_name']; ?></option>
														<?php } ?>
													<?php } ?>
												<?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Discount</label>
                                            <input type="text" class="form-control" name="discount" id="discount" placeholder="Enter Discount" value="<?php echo isset($packages_name_details['discount'])?$packages_name_details['discount']:''; ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Amount</label>
                                            <input type="text" class="form-control" name="amount" id="amount" placeholder="Enter Amount" value="<?php echo isset($packages_name_details['amount'])?$packages_name_details['amount']:''; ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Instructions</label>
                                            <input type="text" class="form-control" name="instruction" id="instruction" placeholder="Enter Instructions" value="<?php echo isset($packages_name_details['instruction'])?$packages_name_details['instruction']:''; ?>">
                                        </div> 
										<div class="form-group col-md-6">
                                            <label>Sample Pickup Charges</label>
                                            <input type="text" class="form-control" name="delivery_charge" id="delivery_charge" placeholder="Enter Sample Pickup Charges" value="<?php echo isset($packages_name_details['delivery_charge'])?$packages_name_details['delivery_charge']:''; ?>">
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
</div>



<script>

	$(document).ready(function() {
    $('#add_package_name').bootstrapValidator({

        
        fields: {
            test_package_name: {
                 validators: {
					notEmpty: {
						message: 'Package Name is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Package Name can only consist of alphanumeric, space and dot'
					}
				}
            },
            'test_name[]': {
               validators: {
					notEmpty: {
						message: 'Test Name is required'
					}
				}
            },
            test_duartion: {
                validators: {
                    notEmpty: {
                        message: 'Estimated Duration is required'
                    },regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Estimated Duration wont allow <> [] = % '
					}
                }
            },discount: {
                validators: {
                    notEmpty: {
                        message: 'Discount is required'
                    },regexp: {
					regexp: /^[0-9. ]+$/,
					message: 'Discount can only consist of digits, space and dot'
					}
                }
            },delivery_charge: {
                validators: {
                    notEmpty: {
                        message: 'Sample pickup charges is required'
                    },regexp: {
					regexp: /^[0-9. ]+$/,
					message: 'Sample Pickup Charges can only consist of digits, space and dot'
					}
                }
            },
			instruction: {
                validators: {
                    notEmpty: {
                        message: 'Instructions is required'
                    },regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Instructions wont allow <> [] = % '
					}
                }
            },
            amount: {
                validators: {
                    notEmpty: {
                        message: 'Amount is required'
                    },regexp: {
					regexp: /^[0-9. ]+$/,
					message: 'Amount can only consist of digits, space and dot'
					}
                }
            }
            }
        })
     
});
</script>

