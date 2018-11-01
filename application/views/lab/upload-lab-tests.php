<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
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
                                <a class="nav-link active" data-toggle="tab" href="#tab1">Lab Test</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab2">Lab Packages</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div id="tab1" class="container tab-pane active"><br>
                                <form class="pad30 form-horizontal" action=" " method="post" id="lt_form">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Test Type</label>
                                            <input type="text" class="form-control" name="lt_test_type" id="lt_test_type" placeholder="Enter Test Type">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Test Name</label>
                                            <input type="text" class="form-control" name="lt_test_name" id="lt_test_name" placeholder="Enter Test Name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Estimated Duration</label>
                                            <input type="text" class="form-control" name="lt_est_duartion" id="lt_est_duartion" placeholder="Enter Duration">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Amount</label>
                                            <input type="text" class="form-control" name="lt_amount" id="lt_amount" placeholder="Enter Amount">
                                        </div>
                                        <div class="clearfix">&nbsp;</div>
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-default">Upload Excel Sheet</button>
                                            <button type="submit" class="btn btn-primary">Upload</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="tab2" class="container tab-pane fade"><br>
                                <form class="pad30 form-horizontal" action=" " method="post" id="lp_form">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Test Package Name</label>
                                            <input type="text" class="form-control" name="lp_tpname" id="lp_tpname" placeholder="Enter Package Name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Test Names</label>
                                            <select class="form-control" name="lp_test_name" id="lp_test_name" multiple>
                                                <option value="" disabled selected>Select Tests</option>
                                                <option value="1">Option1</option>
                                                <option value="2">Option2</option>
                                                <option value="3">Option3</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Discount</label>
                                            <input type="text" class="form-control" name="lp_discount" id="lp_discount" placeholder="Enter Discount">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Amount</label>
                                            <input type="text" class="form-control" name="lp_amount" id="lp_amount" placeholder="Enter Amount">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Instructions</label>
                                            <input type="text" class="form-control" name="lp_instr" id="lp_instr" placeholder="Enter Instructions">
                                        </div>
                                        <div class="clearfix">&nbsp;</div>
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-default">Upload Excel Sheet</button>
                                            <button type="submit" class="btn btn-primary">Upload</button>
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
</div>


<?php include('footer.php'); ?>

<script>
	$(document).ready(function() {
    $('#lt_form').bootstrapValidator({
        
        fields: {
            lt_test_type: {
                validators: {
                    notEmpty: {
                        message: 'Please enter test type'
                    }
                }
            },
            lt_test_name: {
                validators: {
                    notEmpty: {
                        message: 'Please enter test name'
                    }
                }
            },
            lt_est_duartion: {
                validators: {
                    notEmpty: {
                        message: 'Please enter estimated duration'
                    }
                }
            },
            lt_amount: {
                validators: {
                    notEmpty: {
                        message: 'Please enter amount'
                    }
                }
            }
            }
        })
     
});
</script>

<script>
	$(document).ready(function() {
    $('#lp_form').bootstrapValidator({
        
        fields: {
            lp_tpname: {
                validators: {
                    notEmpty: {
                        message: 'Please enter package name'
                    }
                }
            },
            lp_test_name: {
                validators: {
                    notEmpty: {
                        message: 'Please select test names'
                    }
                }
            },
            lp_discount: {
                validators: {
                    notEmpty: {
                        message: 'Please enter discount'
                    }
                }
            },
            lp_amount: {
                validators: {
                    notEmpty: {
                        message: 'Please enter amount'
                    }
                }
            }
            }
        })
     
});
</script>