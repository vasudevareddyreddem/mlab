
<?php //echo '<pre>';print_r($pickup_orders);exit; ?>
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
              <table id="pickup_orders" class="display table" style="width:100%;">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Order id</th>
                    <th>Patient Name</th>
                    <th>Mobile Number</th>
                    <th>Address</th>
                    <th>Updated Date & Time</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(isset($pickup_orders) && count($pickup_orders)>0) { ?>
                    <?php $sno = 1; ?>
                    <?php foreach ($pickup_orders as $pickup_order) { ?>
                      <tr>
							<td><?php echo $sno; ?></td>
							<td><?php echo $pickup_order['cust_order_id']; ?></td>
							<td><?php echo $pickup_order['cust_name']; ?></td>
							<td><?php echo $pickup_order['mobile']; ?></td>
							<td><?php echo $pickup_order['address']; ?></td>
							<td><?php echo $pickup_order['updated_date']; ?></td>
							<td><?php if($pickup_order['status']==1){ echo "Packed";}else if($pickup_order['status']==2){ echo "Dispatched"; }else if($pickup_order['status']==3){ echo "Deliveried"; }else if($pickup_order['status']==0){ echo "Accepted"; } ?></td>
							
						</tr>
                        <?php $sno++; ?>
                      <?php } ?>
                    <?php } else { ?>
                      <tr>
                        <td colspan="8" class="text-center">No Orders found</td>
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
    $('#pickup_orders').DataTable();
  });
  function orderpickup(id) {
    $(".popid").attr("href", "<?php echo base_url('pickupboy/order_pickup'); ?>" + "/" + id);
  }
  function pickupstatus() {
    $('#content1').html('Are you sure you want to Start Pickup ?');
  }
  function ongoing_orders(id) {
    $(".popid").attr("href", "<?php echo base_url('pickupboy/ongoing_orders'); ?>" + "/" + id);
  }
  function ongoingstatus() {
    $('#content1').html('Are you sure you want to process the order ?');
  }
</script>
