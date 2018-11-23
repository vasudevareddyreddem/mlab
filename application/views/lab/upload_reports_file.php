<?php //echo '<pre>';print_r($order_list);exit; ?>
<div class="page-content-wrapper">
    <div class="page-content">

        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>Upload Samples</header>
                    </div>
                    <div class="card-body ">
                        <div class="table-responsive">
                            <table id="" class="display table" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Tests</th>
                                        <th>Reports attachment</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php if(isset($order_list) && count($order_list)>0){ ?>
									<?php $cnt=1;foreach($order_list as $lis){ ?>
										<tr>
											<td><?php echo $cnt; ?></td>
											<td><?php echo isset($lis['test_name'])?$lis['test_name']:''; ?></td>
											<td>
											<?php if($lis['report_file']!=''){ ?>
											<a target="_blank" href="<?php echo base_url('assets/reportfiles/'.$lis['report_file']); ?>">Downalod</a>
											<?php }  ?>
											</td>
											<td class="valigntop">
												<div class="btn-group">
												<form action="<?php echo base_url('lab/uploadfile'); ?>" method="post" enctype="multipart/form-data">
													<input  type="hidden" name="o_p_t_id" id="o_p_t_id" value="<?php echo isset($lis['o_p_t_id'])?$lis['o_p_t_id']:''; ?>">
													<input  type="hidden" name="order_item_id" id="order_item_id" value="<?php echo isset($order_item_id)?$order_item_id:''; ?>">
													<input  type="file" name="image" id="image">
													<button class="btn btn-xs deepPink-bgcolor dropdown-toggle no-margin" type="submit" aria-expanded="false">
														<i class="fa fa-arrow-up"></i>Upload
													</button>
												</form>
												</div>
											</td>
										</tr>
									<?php $cnt++;} ?>
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