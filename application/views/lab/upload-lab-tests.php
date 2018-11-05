
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
                                <a class="nav-link <?php if($tab==''){ echo "active"; } ?>" data-toggle="tab" href="#tab1">Lab Test</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if($tab==1){ echo "active"; } ?>" data-toggle="tab" href="#tab2">Lab Test List</a>
                            </li>
                        </ul>
                        
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div id="tab1" class="container tab-pane <?php if($tab==''){ echo "active"; } ?>"><br>
                                <form class="pad30 form-horizontal" action="<?php echo base_url('lab/testaddpost'); ?>" method="post" id="add_test_form">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Test Type</label>
                                            <input type="text" class="form-control" name="test_type" id="test_type" placeholder="Enter Test Type">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Test Name</label>
                                            <input type="text" class="form-control" name="test_name" id="test_name" placeholder="Enter Test Name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Estimated Duration</label>
                                            <input type="text" class="form-control" name="test_duartion" id="test_duartion" placeholder="Enter Duration">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Amount</label>
                                            <input type="text" class="form-control" name="test_amount" id="test_amount" placeholder="Enter Amount">
                                        </div>
                                        <div class="clearfix">&nbsp;</div>
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary">Upload</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="tab2" class="container tab-pane <?php if($tab==1){ echo "active"; } ?>"><br>
                                <div class="table-responsive">
								<?php if(isset($test_lists) && count($test_lists)>0){ ?>
                            <table id="saveStage" class="display table" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>Test Type</th>
                                        <th>Test Name</th>
                                        <th>Estimated Duration</th>
                                        <th>Amount</th>
                                        <th>Date & Time</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php foreach($test_lists as $list){ ?>
                                    <tr>
                                        <td><?php echo isset($list['test_type'])?$list['test_type']:''; ?></td>
                                        <td><?php echo isset($list['test_name'])?$list['test_name']:''; ?></td>
                                        <td><?php echo isset($list['test_duartion'])?$list['test_duartion']:''; ?></td>
                                        <td><?php echo isset($list['test_amount'])?$list['test_amount']:''; ?></td>
                                        <td><?php echo isset($list['created_at'])?$list['created_at']:''; ?></td>
                                        <td><?php if($list['status']==1){ echo "Active";}else{ echo "Deactive";} ?></td>
                                        <td>
										  <a href="<?php echo base_url('lab/testedit/'.base64_encode($list['l_id'])); ?>"><button class="btn btn-xs btn-primary">Edit</button></a>&nbsp;
                                             <a href="javascript;void(0);" onclick="admindeactive('<?php echo base64_encode(htmlentities($list['l_id'])).'/'.base64_encode(htmlentities($list['status']));?>');adminstatus('<?php echo $list['status'];?>')"  data-toggle="modal" data-target="#myModal" ><button class="btn btn-xs btn-info"><?php if($list['status']==0){ echo "Active"; }else{  echo "Deactive"; } ?></button></a>&nbsp;
                                            <a href="javascript;void(0);" onclick="admindelete('<?php echo base64_encode(htmlentities($list['l_id'])); ?>');adminstatus2('<?php echo $list['status'];?>')"  data-toggle="modal" data-target="#myModal" ><button class="btn btn-xs btn-danger">Delete</button></a>
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
        "order": [[ 4, "desc" ]]
    } );
} );

  function admindeactive(id){
	$(".popid").attr("href","<?php echo base_url('lab/status'); ?>"+"/"+id);
}
function adminstatus(id){
	if(id==1){
			$('#content1').html('Are you sure you want to Deactivate?');
		
	}if(id==0){
			$('#content1').html('Are you sure you want to activate?');
	}
}
function admindelete(id){
	$(".popid").attr("href","<?php echo base_url('lab/deletes'); ?>"+"/"+id);
}
function adminstatus2(id){
	
			$('#content1').html('Are you sure you want to delete?');

}
	$(document).ready(function() {
    $('#add_test_form').bootstrapValidator({
        
        fields: {
            test_type: {
                 validators: {
					notEmpty: {
						message: 'Test Type is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Test Type can only consist of alphanumeric, space and dot'
					}
				}
            },
            test_name: {
               validators: {
					notEmpty: {
						message: 'Test Name is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Test Name can only consist of alphanumeric, space and dot'
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
            },
            test_amount: {
                validators: {
                    notEmpty: {
                        message: 'Amount is required'
                    },regexp: {
					regexp: /^[0-9. ]+$/,
					message: 'Test Name can only consist of alphanumeric, space and dot'
					}
                }
            }
            }
        })
     
});
</script>

