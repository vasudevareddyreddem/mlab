
			<div class="page-content-wrapper">
                <div class="page-content">

					<div class="row">
                       <div class="col-md-12">
                            <div class="card card-topline-aqua">
                                <div class="card-head">
                                     <header>Dispatch Medicine</header>
                                </div>
                                <div class="card-body ">
                                    <table id="saveStage" class="display table" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
												<th>Name</th>
                                                <th>Mobile No </th>
                                                <th>Medicine List</th>
                                                <th>Price</th>
                                                <th>Discount</th>
                                                <th>Total Amount</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
																					<?php if($status==1){
																						$cnt=1;

																						foreach($list as $row){?>
																							<tr>
																								<td><?php echo $cnt;?></td>
																								<td><?php echo $row['name'];?></td>
																									<td><?php echo $row['mobile'];?></td>

																									<td><?php echo $row['mlist'];?></td>
																									<td><?php echo $row['aprice'];?></td>
																									<td><?php echo $row['discount'];?></td>
																									<td><?php echo $row['final'];?></td>


																									<td class="valigntop">
																											<div class="btn-group">
																													<button class="btn btn-xs deepPink-bgcolor dropdown-toggle no-margin" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
																															<i class="fa fa-angle-down"></i>
																													</button>
																													<ul class="dropdown-menu" role="menu">
																															<li>
																																	<a href="<?php echo base_url('pharmacyadmin/dispatch_order/').base64_encode($row['cust_order_id']);?>">
																																			<i class="fa fa-save"></i> Dispatch</a>
																															</li>

																													</ul>
																											</div>
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
