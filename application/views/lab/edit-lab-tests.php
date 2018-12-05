<div class="page-content-wrapper">
    <div class="page-content">

        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>Edit Test</header>
                    </div>
                    <div class="card-body">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <form class="pad30 form-horizontal" action="<?php echo base_url('lab/testeditpost'); ?>" method="post" id="add_test_form">
                                <input type="hidden" id="l_t_id" name="l_t_id" value="<?php echo isset($test_name_details['l_id'])?$test_name_details['l_id']:''; ?>">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Test Type</label>
                                        <input type="text" class="form-control" name="test_type" id="test_type" placeholder="Enter Test Type" value="<?php echo isset($test_name_details['test_type'])?$test_name_details['test_type']:''; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Test Name</label>
                                        <input type="text" class="form-control" name="test_name" id="test_name" placeholder="Enter Test Name" value="<?php echo isset($test_name_details['test_name'])?$test_name_details['test_name']:''; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Reports In</label>
                                        <input type="text" class="form-control" name="test_duartion" id="test_duartion" placeholder="Enter Duration" value="<?php echo isset($test_name_details['test_duartion'])?$test_name_details['test_duartion']:''; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Amount</label>
                                        <input type="text" class="form-control" name="test_amount" id="test_amount" placeholder="Enter Amount" value="<?php echo isset($test_name_details['test_amount'])?$test_name_details['test_amount']:''; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Sample Pickup Charges</label>
                                        <input type="text" class="form-control" name="delivery_charge" id="delivery_charge" placeholder="Enter Sample Pickup Charges" value="<?php echo isset($test_name_details['delivery_charge'])?$test_name_details['delivery_charge']:''; ?>">
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
        $('#lablist').DataTable({
            "order": [
                [4, "desc"]
            ]
        });
    });

    function admindeactive(id) {
        $(".popid").attr("href", "<?php echo base_url('lab/status'); ?>" + "/" + id);
    }

    function adminstatus(id) {
        if (id == 1) {
            $('#content1').html('Are you sure you want to Deactivate?');

        }
        if (id == 0) {
            $('#content1').html('Are you sure you want to activate?');
        }
    }

    function admindelete(id) {
        $(".popid").attr("href", "<?php echo base_url('lab/deletes'); ?>" + "/" + id);
    }

    function adminstatus2(id) {

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
                            message: 'Reports In is required'
                        },
                        regexp: {
                            regexp: /^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
                            message: 'Reports In wont allow <> [] = % '
                        }
                    }
                },
                delivery_charge: {
                    validators: {
                        notEmpty: {
                            message: 'Sample pickup charges is required'
                        },
                        regexp: {
                            regexp: /^[0-9. ]+$/,
                            message: 'Sample Pickup Charges can only consist of digits, space and dot'
                        }
                    }
                },
                test_amount: {
                    validators: {
                        notEmpty: {
                            message: 'Amount is required'
                        },
                        regexp: {
                            regexp: /^[0-9. ]+$/,
                            message: 'Test Name can only consist of alphanumeric, space and dot'
                        }
                    }
                }
            }
        })

    });
</script>