<div class="page-content-wrapper">
   <div class="page-content">
      <div class="row">
         <div class="col-md-12">
            <div class="card card-topline-aqua">
               <div class="card-head">
                  <header>Rejected Orders</header>
               </div>
               <div class="card-body ">
                  <table id="saveStage" class="display table" style="width:100%;">
                     <thead>
                        <tr>
                           <th>S.No</th>
                           <th>Order Id</th>
                           <th>Name</th>
                           <th>Mobile</th>
                           <th>Address </th>
                           <th>Medicine List</th>
                           <th>Date & Time</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php if($status==1){ $cnt=1;foreach($list as $row){  ?>
                        <tr>
                           <td><?php echo $cnt;?></td>
                           <td><?php echo $row['id'];?></td>
                           <td><?php echo $row['name'];?></td>
                           <td><?php echo $row['mobile'];?></td>
                           <td><?php echo $row['address'];?></td>
                           <?php $upload_medicine_url=$this->config->item('upload_medicine_url'); ?>
                           <td><a target="_blank" href="<?php echo $upload_medicine_url.'assets/medicine_list/'.$row['med_img']; ?>"><img src="<?php echo $upload_medicine_url.'assets/medicine_list/'.$row['med_img']; ?>" alt="<?php echo $row['med_img']; ?>" width="50px" height="50px"></a></td>
							<td><?php echo $row['created_date'];?></td>                          
						  
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
