
<div class="page-content-wrapper">
    <div class="page-content">

        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>Upload</header>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link <?php if(isset($tab) && $tab ==''){ echo "active"; } ?>" data-toggle="tab" href="#tab1">Lab Packages</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if(isset($tab) && $tab ==1){ echo "active"; } ?>" data-toggle="tab" href="#tab2">Lab Packages List</a>
                            </li>
                        </ul>
                        
                        <!-- Tab panes -->
                        <div class="tab-content">
                            
                            <div id="tab1" class="container tab-pane <?php if(isset($tab) && $tab ==''){ echo "active"; } ?>"><br>
                                <form class="pad30 form-horizontal" action="<?php echo base_url('lab/testpackagepost'); ?>" method="post" id="add_package_name" name="add_package_name">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Test Package Name</label>
                                            <input type="text" class="form-control" name="test_package_name" id="test_package_name" placeholder="Enter Package Name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Test Names</label>
                                            <select class="form-control select2" name="test_name[]" id="test_name" multiple="multiple">
                                                <option value="">Select Tests</option>
												<?php if(isset($test_lists) && count($test_lists)>0){ ?>
												<?php foreach($test_lists as $lis){ ?>
                                                <option value="<?php echo $lis['l_id']; ?>"><?php echo $lis['test_name']; ?></option>
												<?php } ?>
												<?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Discount</label>
                                            <input type="text" class="form-control" name="discount" id="discount" placeholder="Enter Discount">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Amount</label>
                                            <input type="text" class="form-control" name="amount" id="amount" placeholder="Enter Amount">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Instructions</label>
                                            <input type="text" class="form-control" name="instruction" id="instruction" placeholder="Enter Instructions">
                                        </div>
                                        <div class="clearfix">&nbsp;</div>
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary">Upload</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="tab2" class="container tab-pane <?php if(isset($tab) && $tab ==1){ echo "active"; } ?>"><br>
                                <div class="table-responsive">
								<?php if(isset($packages_test_lists) && count($packages_test_lists)>0){ ?>
                            <table id="saveStage" class="display table" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>Test Package Name</th>
                                        <th>Test Name</th>
                                        <th>Discount</th>
                                        <th>Amount</th>
                                        <th>Percentage</th>
                                        <th>Date & Time</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php foreach($packages_test_lists as $list){ ?>
                                    <tr>
                                        <td><?php echo isset($list['test_package_name'])?$list['test_package_name']:''; ?></td>
                                        <td>
										<?php if(isset($list['package_test_list']) && count($list['package_test_list'])>0){ ?>
										<?php foreach($list['package_test_list'] as $li){ ?>
											<?php 
											echo isset($li['test_name'])?$li['test_name']:'';
											echo '<br>';

											?>
										<?php } ?>
										<?php } ?>
										
										</td>
                                        <td><?php echo isset($list['discount'])?$list['discount']:''; ?></td>
                                        <td><?php echo isset($list['amount'])?$list['amount']:''; ?></td>
                                        <td><?php echo isset($list['percentage'])?$list['percentage']:''; ?></td>
                                        <td><?php echo isset($list['created_at'])?$list['created_at']:''; ?></td>
                                        <td><?php if($list['status']==1){ echo "Active";}else{ echo "Deactive";} ?></td>
                                        <td>
										  <a href="<?php echo base_url('lab/packageedit/'.base64_encode($list['l_t_p_id'])); ?>"><button class="btn btn-xs btn-primary">Edit</button></a>&nbsp;
                                             <a href="javascript;void(0);" onclick="admindeactive('<?php echo base64_encode(htmlentities($list['l_t_p_id'])).'/'.base64_encode(htmlentities($list['status']));?>');adminstatus('<?php echo $list['status'];?>')"  data-toggle="modal" data-target="#myModal" ><button class="btn btn-xs btn-info"><?php if($list['status']==0){ echo "Active"; }else{  echo "Deactive"; } ?></button></a>&nbsp;
                                            <a href="javascript;void(0);" onclick="admindelete('<?php echo base64_encode(htmlentities($list['l_t_p_id'])); ?>');adminstatus2('<?php echo $list['status'];?>')"  data-toggle="modal" data-target="#myModal" ><button class="btn btn-xs btn-danger">Delete</button></a>
										</td>
										
                                    </tr>
                                   
								<?php } ?>
                                </tbody>
                            </table>
								<?php } ?>
                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
$(document).ready(function() {
    $('#lablist').DataTable( {
        "order": [[ 5, "desc" ]]
    } );
} );

  function admindeactive(id){
	$(".popid").attr("href","<?php echo base_url('lab/packagestatus'); ?>"+"/"+id);
}
function adminstatus(id){
	if(id==1){
			$('#content1').html('Are you sure you want to Deactivate?');
		
	}if(id==0){
			$('#content1').html('Are you sure you want to activate?');
	}
}
function admindelete(id){
	$(".popid").attr("href","<?php echo base_url('lab/packagedeletes'); ?>"+"/"+id);
}
function adminstatus2(id){
	
			$('#content1').html('Are you sure you want to delete?');

}
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

