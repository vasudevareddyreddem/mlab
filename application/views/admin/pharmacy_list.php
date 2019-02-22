<div class="page-content-wrapper">
    <div class="page-content">

        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>Pharmacy List</header>
                    </div>
                    <div class="card-body table-responsive">
                        <?php if(isset($pharmacy_details) && count($pharmacy_details)>0){ ?>
                        <table id="lablist" class="display table table-striped" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Name of the Pharmacy</th>
                                    <th>Email</th>
                                    <th>Mobile No </th>
                                    <th>Reg Date & Time</th>
									 <th>Discount Percentage</th>
                                    <th>Qr Image</th>
                                    <th> Print qr code</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach($pharmacy_details as $list){ ?>
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
                                        <?php echo $list['discount_per']; ?>
                                    </td>
                                    <td id=<?php echo $list['a_id']; ?>>
                                      <img src="<?php echo base_url().$list['qr_path']?>" alt="" >
                                         <br>
                                             <?php echo $list['name']; ?>

                                    </td>
                                    <td>
                                      <button class='btn btn-xs btn-primary print
                                      ' value='<?php echo $list['a_id']; ?>'>print</button>
                                    </td>

                                    <td>
                                        <?php if($list['status']==1){ echo "Active"; }else{  echo "Deactive"; } ?>
                                    </td>
                                    <td class="valigntop">
                                        <div class="btn-group">
                                            <a href="<?php echo base_url('pharmacy/edit/'.base64_encode($list['a_id'])); ?>"><button class="btn btn-xs btn-primary">Edit</button></a>&nbsp;
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
        $(".popid").attr("href", "<?php echo base_url('pharmacy/status'); ?>" + "/" + id);
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
        $(".popid").attr("href", "<?php echo base_url('pharmacy/deletes'); ?>" + "/" + id);
    }

    function adminstatus2(id) {

        $('#content1').html('Are you sure you want to delete?');

    }
</script>
<script text='javascript'>
$('.print').on('click',function(){
value=this.value;



   var divToPrint=document.getElementById(value);

   newWin= window.open("");

   newWin.document.write(divToPrint.outerHTML);

   newWin.print();

   newWin.close();






});
</script>
