
			<div class="page-content-wrapper">
                <div class="page-content">

					<div class="row">
                       <div class="col-md-12">
                            <div class="card card-topline-aqua">
                                <div class="card-head">
                                     <header>History</header>
                                </div>
                                <div class="card-body ">
                                    <table id="saveStage" class="display table" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
												<th>Order Id</th>
												<th>Name</th>
                                                <th>Mobile No </th>
                                                <th>Medicine List</th>
                                                <th>Total Amount</th>
                                                <th>Date & Time</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
																					<?php if($status==1){
																						$cnt=1;

																						foreach($list as $row){?>
                                            <tr>
																							<td><?php echo $cnt;?></td>
																							<td><?php echo $row['cust_order_id'];?></td>
																							<td><?php echo $row['name'];?></td>
																								<td><?php echo $row['mobile'];?></td>

																								<td><?php echo $row['mlist'];?></td>

																								<td><?php echo $row['final'];?></td>
																								<td><?php echo $row['created_date'];?></td>
                                                <td class="valigntop">
																							<?php  if($row['status']==1){
																								echo 'Packing';
																							}else if($row['status']==2){
																									echo 'Dispatched';
																								}else if($row['status']==3){
																									echo 'Delivered';
																								}
																								
																								?>
                                                </td>
                                            </tr>
																						<?php $cnt++;	}}?>


                                        </tbody>
                                    </table>
                                </div>
								<div class="clearfix">&nbsp;</div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
