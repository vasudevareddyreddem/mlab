<div class="page-content-wrapper">
    <div class="page-content">

        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>Order Pickup</header>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="saveStage" class="display table table-striped" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>Patient Name</th>
                                        <th>Mobile Number</th>
                                        <th>Test Name / Package Name</th>
                                        <th>Sample Pickup Date & Time</th>
                                        <th>Amount</th>
                                        <th>Delivery charges</th>
                                        <th>Payment Type</th>
                                        <th>Created Date & Time</th>
                                        <th>Customer Status</th>
                                        <th>Lab Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($order_list) && count($order_list)>0){ ?>
                                    <?php foreach($order_list as $lis){ ?>
                                    <tr>
                                        <td>
                                            <?php echo isset($lis['p_name'])?$lis['p_name']:''; ?>
                                        </td>
                                        <td>
                                            <?php echo isset($lis['mobile'])?$lis['mobile']:''; ?>
                                        </td>
                                        <td>
                                            <?php echo isset($lis['test_name'])?$lis['test_name']:''; ?>
                                            <?php echo isset($lis['test_package_name'])?$lis['test_package_name']:''; ?>
                                        <td>
                                            <?php echo isset($lis['date'])?$lis['date']:''; ?>
                                            <?php echo isset($lis['time'])?$lis['time']:''; ?>
                                        </td>

                                        </td>
                                        <td>
                                            <?php echo isset($lis['amount'])?$lis['amount']:''; ?>
                                        </td>

                                        <td>
                                            <?php echo isset($lis['delivery_charge'])?$lis['delivery_charge']:''; ?>
                                        </td>

                                        <td>
                                            <?php if($lis['payment_type']==1){ echo "Online"; } else if($lis['payment_type']==3){ echo "Swipe on Delivery";}else if($lis['payment_type']==2){  echo "Cash On Delivery"; } ?>
                                        </td>
                                        <td>
                                            <?php echo isset($lis['created_at'])?$lis['created_at']:''; ?>
                                        </td>
                                        <td>
                                            <?php if($lis['status']==1){ echo "Success"; } else if($lis['status']==2){ echo "Canceled";} ?>
                                        </td>
                                        <td>
                                            <?php if($lis['lab_status']==1){ echo "Accepted"; } else if($lis['lab_status']==2){ echo "Rejected";}else if($lis['lab_status']==0){  echo "Pending"; } ?>
                                        </td>
                                        <td class="valigntop">
                                            <?php if($lis['status']==1){ ?>
                                            <div class="btn-group">
                                                <button class="btn btn-xs deepPink-bgcolor dropdown-toggle no-margin" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                    <i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        <a href="javascript;void(0);" onclick="admindeactive('<?php echo base64_encode(htmlentities($lis['order_item_id']));?>');adminstatus();" data-toggle="modal" data-target="#myModal">
                                                            <i class="fa fa-save"></i> Accept</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript;void(0);" onclick="admindelete('<?php echo base64_encode(htmlentities($lis['order_item_id']));?>');adminstatus2();" data-toggle="modal" data-target="#myModal1">
                                                            <i class="fa fa-trash-o"></i>Reject</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <?php } ?>
                                        </td>


                                    </tr>

                                    <?php } ?>
                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="clearfix">&nbsp;</div>
                </div>
            </div>
        </div>


    </div>
</div>
<div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

            <div style="padding:10px">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 style="pull-left" class="modal-title">Confirmation</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissible" id="errormsg" style="display:none;"></div>
                <div class="row">
                    <div class="col-lg-12">
                        <form id="defaultForm" method="post" action="<?php echo base_url('lab/orderstatus_reject'); ?>">
                            <div id="content2" class="col-lg-12 form-group">
                                Are you sure ?
                            </div>

                            <div class="col-lg-12">
                                <input class="form-control" type="text" name="reason" id="reason" placeholder="Enter reason" value="" required>
                            </div>
                            <br>
                            <div class="col-lg-12">
                                <input type="hidden" name="order_item_id_id" id="order_item_id_id" class="popid" value="">
                                <button type="button" aria-label="Close" data-dismiss="modal" class="btn blueBtn float-right">Cancel</button>
                            </div>
                            <button type="submit" class="btn btn-primary" name="Submit" value="Submit">Submit</button>

                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
<script>
    $("#saveStage").DataTable({
        "order": [
            [7, "desc"]
        ]
    });

    function admindeactive(id) {
        $(".popid").attr("href", "<?php echo base_url('lab/orderstatus_accept'); ?>" + "/" + id);
    }

    function adminstatus(id) {
        $('#content1').html('Are you sure you want to Accept?');
    }

    function admindelete(id) {
        $("#order_item_id_id").val(id);
    }

    function adminstatus2(id) {
        $('#content1').html('Are you sure you want to reject?');
    }
</script>
