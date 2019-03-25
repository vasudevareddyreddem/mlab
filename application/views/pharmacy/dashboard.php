
<div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Dashboard</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                   <!-- start widget -->
	                  <div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="row clearfix">
			                    <div class="col-md-4 col-sm-6 col-xs-12">
									<div class="card mt-0 btn-info">
										<div class="panel-body">
											<h4 class="mt-2 mb-2 text-white">No.of Received Orders This Month  </h4>
											<div class="progressbar-xs progress-rounded progress-striped progress ng-isolate-scope active">
												<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo $rorders;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $rorders;?>%;"></div>
											</div>
											<span class="text-small margin-top-10 full-width text-white">
												<?php echo $rorders;?>
											</span>
										</div>
									</div>
			                       
			                    </div>
								<div class="col-md-4 col-sm-6 col-xs-12">
									<div class="card mt-0 btn-warning">
										<div class="panel-body">
											<h4 class="mt-2 mb-2 text-white">Orders Dispatched </h4>
											<div class="progressbar-xs progress-rounded progress-striped progress ng-isolate-scope active">
												<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo $dorders;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $dorders;?>%;"></div>
											</div>
											<span class="text-small margin-top-10 full-width text-white">
												<?php echo $dorders;?>
											</span>
										</div>
									</div>
			                       
			                    </div>
								<div class="col-md-4 col-sm-6 col-xs-12">
									<div class="card mt-0 btn-success">
										<div class="panel-body">
											<h4 class="mt-2 mb-2 text-white">Total Amount</h4>
											<div class="progressbar-xs progress-rounded progress-striped progress ng-isolate-scope active">
												<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo $amt;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $amt;?>%;"></div>
											</div>
											<span class="text-small margin-top-10 full-width text-white">
												<?php echo $amt;?>
											</span>
										</div>
									</div>
			                       
			                    </div>
			                 
			                </div>
						</div>

			        	</div>


                </div>
            </div>
