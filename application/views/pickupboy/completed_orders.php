<div class="page-content-wrapper">
    <div class="page-content">

        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>Completed Orders List</header>
                    </div>
                    <div class="card-body ">
                        <div class="table-responsive">
                            <table id="completed_orders" class="display table" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Customer Name</th>
                                        <th>Mobile Number</th>
                                        <th>Order List</th>
                                        <th>Address</th>
                                        <th>Pick Up Date & Time</th>
                                        <th>Payment</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php if (isset($completed_orders) && count($completed_orders) > 0) { ?>
                                    <?php $sno = 1; ?>
                                    <?php foreach ($completed_orders as $completed_order) { ?>
                                      <tr>
                                          <td><?php echo $sno; ?></td>
                                          <td><?php echo $completed_order['p_name']; ?></td>
                                          <td><?php echo $completed_order['mobile']; ?></td>
                                          <td><?php echo $completed_order['test_name']; ?></td>
                                          <td><?php echo $completed_order['address']; ?></td>
                                          <td><?php echo $completed_order['updated_at']; ?></td>
                                          <td>
                                            <?php
                                            if($completed_order['payment_type']==1){ echo "Online"; } else if($completed_order['payment_type']==3){ echo "Swipe on Delivery";} else if($completed_order['payment_type']==2){  echo "Cash On Delivery"; }
                                            ?>
                                          </td>
                                          <td class="text-success"><?php if($completed_order['lab_status'] == 5){ echo 'Completed'; } ?></td>
                                      </tr>
                                      <?php $sno++; ?>
                                    <?php } ?>
                                  <?php } else { ?>
                                    <tr>
                                      <td class="text-center" colspan="8">No records found</td>
                                    </tr>
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
<script type="text/javascript">
  $(document).ready(function(){
    $('#completed_orders').DataTable();
  });
</script>
