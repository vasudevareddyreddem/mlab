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
            <div class="col-lg-12">
                <div class="row clearfix">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="card btn-info">
                            <div class="panel-body">
                                <h3 class="mt-0 mb-3">No.of Total Orders </h3>
                                <span class="text-small margin-top-10 full-width">
                                    <?php echo isset($total_orders['cnt'])?$total_orders['cnt']:''; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="card btn-success">
                            <div class="panel-body">
                                <h3 class="mt-0 mb-3">No.of Received Orders </h3>
                                <span class="text-small margin-top-10 full-width">
                                    <?php echo isset($total_received_orders['cnt'])?$total_received_orders['cnt']:''; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="card btn-danger">
                            <div class="panel-body">
                                <h3 class="mt-0 mb-3">No.of Rejected Orders</h3>
                                <span class="text-small margin-top-10 full-width">
                                    <?php echo isset($total_reject_orders['cnt'])?$total_reject_orders['cnt']:''; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <!--<div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="card">
                            <div class="panel-body">
                                <h3>Outstanding Amount</h3>
                                <div class="progressbar-xs progress-rounded progress-striped progress ng-isolate-scope active">
                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="width: 65%;"></div>
                                </div>
                                <span class="text-small margin-top-10 full-width">14% higher than last month</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="card">
                            <div class="panel-body">
                                <h3>Instanding Amount</h3>
                                <div class="progressbar-xs progress-rounded progress-striped progress ng-isolate-scope active">
                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="width: 65%;"></div>
                                </div>
                                <span class="text-small margin-top-10 full-width">14% higher than last month</span>
                            </div>
                        </div>
                    </div>-->
                </div>
            </div>

        </div>
    </div>
</div>
