<div class="page-content-wrapper">
    <div class="page-content">

        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>Upload Samples</header>
                    </div>
                    <div class="card-body ">
                        <div class="table-responsive">
                            <table id="saveStage" class="display table table-striped" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>Patient Name</th>
                                        <th>Mobile Number</th>
                                        <th>Test Name / Package Name</th>
                                        <th>Amount</th>
                                        <th>Delivery charges</th>
                                        <th>Sample Pickup Date & Time</th>
                                        <th>Payment Type</th>
                                        <th>PickUp Boy Status</th>
                                        <th>Created Date & Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($order_list) && count($order_list)>0){ ?>
						<?php foreach($order_list as $lis){ ?>
                            <tr>
                                <td><?php echo isset($lis['p_name'])?$lis['p_name']:''; ?></td>
                                <td><?php echo isset($lis['mobile'])?$lis['mobile']:''; ?></td>
                                <td>
								<?php echo isset($lis['test_name'])?$lis['test_name']:''; ?>
								<?php echo isset($lis['test_package_name'])?$lis['test_package_name']:''; ?>

								</td>
                                <td><?php echo isset($lis['amount'])?$lis['amount']:''; ?></td>
                                <td><?php echo isset($lis['delivery_charge'])?$lis['delivery_charge']:''; ?></td>
                                <td><?php echo isset($lis['date'])?$lis['date']:''; ?><?php echo isset($lis['time'])?$lis['time']:''; ?></td>
                                <td>
								<?php if($lis['payment_type']==1){ echo "Online"; } else if($lis['payment_type']==3){ echo "Swipe on Delivery";}else if($lis['payment_type']==2){  echo "Cash On Delivery"; } ?>
								</td>
                <td>
                  <?php
                    if($lis['lab_status']== 1){ echo "Accepted"; }
                    else if($lis['lab_status']== 2){ echo "Rejected";}
                    else if($lis['lab_status']== 0){  echo "Pending"; }
                    else if($lis['lab_status']== 3){ echo 'Picked up'; }
                    else if($lis['lab_status']== 4){ echo 'On going'; }
                    else if($lis['lab_status']== 5){ echo 'Completed'; }
                  ?>
                  <?php
                    if(isset($lis['pickupboy_id']) && !empty($lis['pickupboy_id'])){
                      echo '('. $lis['pickupboy_id'].')';
                    } else {
                      echo '';
                    }
                  ?>
                </td>
								<td><?php echo isset($lis['created_at'])?$lis['created_at']:''; ?></td>
								 <td class="valigntop">
                                            <div class="btn-group"><a href="<?php echo base_url('lab/uploadreports/'.base64_encode($lis['order_item_id'])); ?>">
                                                <button class="btn btn-xs deepPink-bgcolor dropdown-toggle no-margin" type="button" aria-expanded="false">
                                                    <i class="fa fa-arrow-up"></i>Upload
                                                </button></a>
                                            </div>
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
<script>
 $("#saveStage").DataTable({
		 "order": [[7, "desc" ]]
	});
</script>
