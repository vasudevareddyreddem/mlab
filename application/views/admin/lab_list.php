<div class="page-content-wrapper">
    <div class="page-content">

        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>Lab List</header>
                    </div>
                    <div class="card-body ">
                        <div class="table-responsive">
                        <?php if(isset($lab_lists) && count($lab_lists)>0){ ?>
                        <table id="lablist" class="display table table-striped" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Name of the Lab</th>
                                    <th>Email</th>
                                    <th>Mobile No </th>
                                    <th>Reg Date & Time</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach($lab_lists as $list){ ?>
                                <tr>
                                    <td>
                                        <?php echo $list['name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $list['email']; ?>
                                    </td>
                                    <td>
                                        <?php echo $list['mobile']; ?>
                                    </td>
                                    <td>
                                        <?php echo $list['created_at']; ?>
                                    </td>
                                    <td>
                                        <?php if($list['status']==1){ echo "Active"; }else{  echo "Deactive"; } ?>
                                    </td>
                                    <td class="valigntop">
                                        <div class="btn-group">
                                            <a href="<?php echo base_url('seller/edit/'.base64_encode($list['a_id'])); ?>"><button class="btn btn-xs btn-primary">Edit</button></a>&nbsp;
                                            <a href="javascript;void(0);" onclick="admindeactive('<?php echo base64_encode(htmlentities($list['a_id'])).'/'.base64_encode(htmlentities($list['status']));?>');adminstatus('<?php echo $list['status'];?>')" data-toggle="modal" data-target="#myModal"><button class="btn btn-xs btn-info">
                                                    <?php if($list['status']==0){ echo "Active"; }else{  echo "Deactive"; } ?></button></a>&nbsp;
                                            <a href="javascript;void(0);" onclick="admindelete('<?php echo base64_encode(htmlentities($list['a_id'])); ?>');adminstatus2('<?php echo $list['status'];?>')" data-toggle="modal" data-target="#myModal"><button class="btn btn-xs btn-danger">Delete</button></a>
                                        </div>
                                    </td>
                                </tr>

                                <?php } ?>
                            </tbody>
                        </table>

                        <?php }else{?>
                        <div>NO data Available</div>
                        <?php } ?>
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
        $('#lablist').DataTable({
            "order": [
                [3, "desc"]
            ]
        });
    });

    function admindeactive(id) {
        $(".popid").attr("href", "<?php echo base_url('seller/status'); ?>" + "/" + id);
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
        $(".popid").attr("href", "<?php echo base_url('seller/deletes'); ?>" + "/" + id);
    }

    function adminstatus2(id) {

        $('#content1').html('Are you sure you want to delete?');

    }
</script>