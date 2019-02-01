<div class="page-content-wrapper">
  <div class="page-content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-topline-aqua">
          <div class="card-head">
            <header>Pick Up Orders List</header>
          </div>
          <div class="card-body ">
            <div class="table-responsive">
              <table id="pickup_orders" class="display table" style="width:100%;">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Patient Name</th>
                    <th>Mobile Number</th>
                    <th>Order Tests</th>
                    <th>Address</th>
                    <th>Pick Up Date & Time</th>
                    <th>Payment</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (isset($pickup_orders) && count($pickup_orders) > 0) { ?>
                    <?php $sno = 1; ?>
                    <?php foreach ($pickup_orders as $pickup_order) { ?>
                      <tr>
                        <td><?php echo $sno; ?></td>
                        <td><?php echo $pickup_order['p_name']; ?></td>
                        <td><?php echo $pickup_order['mobile']; ?></td>
                        <td><?php echo $pickup_order['test_name']; ?></td>
                        <td><?php echo $pickup_order['address']; ?></td>
                        <td><?php echo $pickup_order['updated_at']; ?></td>
                        <td>
                          <?php
                          if($pickup_order['payment_type']==1){ echo "Online"; } else if($pickup_order['payment_type']==3){ echo "Swipe on Delivery";} else if($pickup_order['payment_type']==2){  echo "Cash On Delivery"; }
                          ?>
                        </td>
                        <td class="valigntop">
                          <div class="btn-group">
                            <button class="btn btn-xs deepPink-bgcolor dropdown-toggle no-margin" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                              <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                              <li>
                                <?php if ($pickup_order['lab_status'] == 3) { ?>
                                  <a href="javascript;void(0);" onclick="return false" class="border border-warning">
                                    <i class="fa fa-hourglass-start"></i>&nbsp;Already picked
                                  </a>
                                <?php } else { ?>
                                  <a href="javascript;void(0);" onclick="orderpickup('<?php echo base64_encode(htmlentities($pickup_order['order_item_id']));?>');pickupstatus();" data-toggle="modal" data-target="#myModal">
                                    <i class="fa fa-hourglass-start"></i>&nbsp;Start for Pickup
                                  </a>
                                <?php } ?>
                              </li>
                              <li>
                                <a href="javascript;void(0);" onclick="ongoing_orders('<?php echo base64_encode(htmlentities($pickup_order['order_item_id']));?>');ongoingstatus();" data-toggle="modal" data-target="#myModal">
                                  <i class="fa fa-money"></i>&nbsp;
                                  Collected Samples / Money</a>
                                </li>
                              </ul>
                            </div>
                          </td>
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
