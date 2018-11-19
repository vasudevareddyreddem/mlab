<div class="page-content-wrapper">
    <div class="page-content">

        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>History</header>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="saveStage" class="display table" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>Patient Name</th>
                                        <th>Mobile Number</th>
                                        <th>Test Name / Package Name</th>
                                        <th>Amount</th>
                                        <th>Delivery charges</th>
                                        <th>Time</th>
                                        <th>Payment Type</th>
                                        <th>Created Date & Time</th>
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
                                <td><?php echo isset($lis['test_duartion'])?$lis['test_duartion']:''; ?></td>
                                <td>
								<?php if($lis['payment_type']==1){ echo "Online"; } else if($lis['payment_type']==3){ echo "Swipe on Delivery";}else if($lis['payment_type']==2){  echo "Cash On Delivery"; } ?>
								</td>
								<td><?php echo isset($lis['created_at'])?$lis['created_at']:''; ?></td>
                            
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