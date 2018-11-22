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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php $cnt=1;foreach($order_list as $lis){ ?>
									<tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo isset($lis['test_name'])?$lis['test_name']:''; ?></td>
                                        <td class="valigntop">
                                            <div class="btn-group"><a href="#">
                                                <button class="btn btn-xs deepPink-bgcolor dropdown-toggle no-margin" type="button" aria-expanded="false">
                                                    <i class="fa fa-arrow-up"></i>Upload
                                                </button></a>
                                            </div>
                                        </td>
                                    </tr>
								<?php $cnt++;} ?>
                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-default">Upload Excel Sheet</button>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </div>
                    <div class="clearfix">&nbsp;</div>
                </div>
            </div>
        </div>


    </div>
</div>
