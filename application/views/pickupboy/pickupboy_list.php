<div class="page-content-wrapper">
  <div class="page-content">

    <div class="row">
      <div class="col-md-12">
        <div class="card card-topline-aqua">
          <div class="card-head">
            <header>Pickup Boy List</header>
          </div>
          <div class="card-body ">
            <div class="table-responsive">
                <table id="pickupboy_list" class="display table table-striped" style="width:100%;">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Mobile No </th>
                      <th>Reg Date & Time</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($pickupboy_list) && count($pickupboy_list) > 0){ ?>
                      <?php foreach ($pickupboy_list as $list) { ?>
                        <tr>
                          <td><?php echo $list->name; ?></td>
                          <td><?php echo $list->email; ?></td>
                          <td><?php echo $list->mobile; ?></td>
                          <td><?php echo date('d-m-Y H:i:s',strtotime($list->created_at)); ?></td>
                          <td><?php if ($list->status == 1) { echo 'Active'; } else { echo 'Inactive'; } ?></td>
                          <td><?php echo $list->a_id; ?></td>
                        </tr>
                      <?php }  ?>
                    <?php } else { ?>
                      <tr>
                        <td>No records found</td>
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
  <script>
  $(document).ready(function() {
    $('#pickupboy_list').datatable();
  });
</script>
