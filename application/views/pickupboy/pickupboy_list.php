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
                      <th>S.NO</th>
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
                      <?php $sno = 1; ?>
                      <?php foreach ($pickupboy_list as $list) { ?>
                        <tr>
                          <td><?php echo $sno; ?></td>
                          <td><?php echo $list->name; ?></td>
                          <td><?php echo $list->email; ?></td>
                          <td><?php echo $list->mobile; ?></td>
                          <td><?php echo date('d-m-Y H:i:s',strtotime($list->created_at)); ?></td>
                          <td><?php if ($list->status == 1) { echo 'Active'; } else { echo 'Deactive'; } ?></td>
                          <!-- <td><?php echo $list->a_id; ?></td> -->
                          <td class="valigntop">
                              <div class="btn-group">
                                  <a href="<?php echo base_url('pickupboy/edit/'.base64_encode($list->a_id)); ?>"><button class="btn btn-xs btn-primary">Edit</button></a>&nbsp;
                                  <a href="javascript;void(0);" onclick="admindeactive('<?php echo base64_encode(htmlentities($list->a_id)).'/'.base64_encode(htmlentities($list->status));?>');adminstatus('<?php echo $list->status;?>')" data-toggle="modal" data-target="#myModal"><button class="btn btn-xs btn-info">
                                          <?php if($list->status==0){ echo "Active"; }else{  echo "Deactive"; } ?></button></a>&nbsp;
                                  <a href="javascript;void(0);" onclick="admindelete('<?php echo base64_encode(htmlentities($list->a_id)); ?>');adminstatus2('<?php echo $list->status;?>')" data-toggle="modal" data-target="#myModal"><button class="btn btn-xs btn-danger">Delete</button></a>
                              </div>
                          </td>
                        </tr>
                        <?php $sno++; ?>
                      <?php }  ?>
                    <?php } else { ?>
                      <tr>
                        <td colspan="7" class="text-center">No records found</td>
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
    $('#pickupboy_list').dataTable();
  });
  function admindeactive(id) {
    $(".popid").attr("href", "<?php echo base_url('pickupboy/status'); ?>" + "/" + id);
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
    $(".popid").attr("href", "<?php echo base_url('pickupboy/delete'); ?>" + "/" + id);
  }
  function adminstatus2(id) {
    $('#content1').html('Are you sure you want to delete?');
  }
</script>
