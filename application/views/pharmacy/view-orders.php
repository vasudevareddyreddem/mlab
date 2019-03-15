<div class="page-content-wrapper">
   <div class="page-content">
      <div class="row">
         <div class="col-md-12">
            <div class="card card-topline-aqua">
               <div class="card-head">
                  <header>Orders</header>
               </div>
               <div class="card-body ">
                  <table id="saveStage" class="display table" style="width:100%;">
                     <thead>
                        <tr>
                           <th>S.No</th>
                           <th>Name</th>
                           <th>Address </th>
                           <th>Medicine List</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php if($status==1){ $cnt=1;foreach($list as $row){  ?>
                        <tr>
                           <td><?php echo $cnt;?></td>
                           <td><?php echo $row['name'];?></td>
                           <td><?php echo $row['address'];?></td>
                           <?php $upload_medicine_url=$this->config->item('upload_medicine_url'); ?>
                           <td><a target="_blank" href="<?php echo $upload_medicine_url.'assets/medicine_list/'.$row['med_img']; ?>"><img src="<?php echo $upload_medicine_url.'assets/medicine_list/'.$row['med_img']; ?>" alt="<?php echo $row['med_img']; ?>" width="50px" height="50px"></a></td>
                           <td class="valigntop">
                              <div class="btn-group">
                                 <button class="btn btn-xs deepPink-bgcolor dropdown-toggle no-margin" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                 <i class="fa fa-angle-down"></i>
                                 </button>
                                 <ul class="dropdown-menu" role="menu">
                                    <li>
                                       <a href="<?php echo base_url('pharmacyadmin/accept_order/').base64_encode($row['id']);?>">
                                       <i class="fa fa-save"></i> Accept / Billing</a>
                                    </li>
                                    <li>
                                       <a href="<?php echo base_url('pharmacyadmin/cancel_order/').base64_encode($row['id']);?>">
                                       <i class="fa fa-trash-o"></i>Reject</a>
                                    </li>
                                 </ul>
                              </div>
                           </td>
                        </tr>
                        <?php $cnt++;}}?>
                     </tbody>
                  </table>
               </div>
               <div class="clearfix">&nbsp;</div>
            </div>
         </div>
      </div>
   </div>
</div>
