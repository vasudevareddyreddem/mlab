<div class="page-content-wrapper">
    <div class="page-content">

        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>On Going Orders List</header>
                    </div>
                    <div class="card-body ">
                        <div class="table-responsive">
                            <table id="ongoing_orders" class="display table" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Customer Name</th>
                                        <th>Mobile Number</th>
                                        <th>Order List</th>
                                        <th>Address</th>
                                        <th>Pick Up Date & Time</th>
                                        <th>Payment</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php if (isset($ongoing_orders) && count($ongoing_orders) > 0) { ?>
                                    <?php $sno = 1; ?>
                                    <?php foreach ($ongoing_orders as $ongoing_order) { ?>
                                      <tr>
                                          <td><?php echo $sno; ?></td>
                                          <td><?php echo $ongoing_order['p_name']; ?></td>
                                          <td><?php echo $ongoing_order['mobile']; ?></td>
                                          <td><?php echo $ongoing_order['test_name']; ?></td>
                                          <td><?php echo $ongoing_order['address']; ?></td>
                                          <td><?php echo $ongoing_order['updated_at']; ?></td>
                                          <td>
                                            <?php
                                            if($ongoing_order['payment_type']==1){ echo "Online"; } else if($ongoing_order['payment_type']==3){ echo "Swipe on Delivery";} else if($ongoing_order['payment_type']==2){  echo "Cash On Delivery"; }
                                            ?>
                                          </td>
                                          <td class="valigntop">
                                              <div class="btn-group">
                                                  <a href="javascript;void(0);" onclick="ordercompleted('<?php echo base64_encode(htmlentities($ongoing_order['order_item_id']));?>');ordercomplete();" data-toggle="modal" data-target="#myModal">
                                                  <button class="btn btn-xs btn-info">Submitted Samples / Money</button>
                                                  </a>
                                              </div>
                                          </td>
                                      </tr>
                                      <?php $sno++; ?>
                                    <?php } ?>
                                  <?php } else { ?>
                                    <tr>
                                      <td colspan='8' class="text-center">No records found</td>
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
    $('#ongoing_orders').DataTable();
  });
  //order complete
  function ordercompleted(id) {
    $(".popid").attr("href", "<?php echo base_url('pickupboy/complete_orders'); ?>" + "/" + id);
  }
  function ordercomplete() {
      $('#content1').html('Are you sure you want to complete the order ?');
  }
</script>
