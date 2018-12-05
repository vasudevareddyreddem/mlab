
<div class="page-content-wrapper">
    <div class="page-content">

        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>Payments</header>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="saveStage" class="display table" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>Time Period</th>
                                        <th>Orders Received</th>
                                        <th>Cash Amount</th>
                                        <th>Online Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php if(isset($week_wise_payments) && count($week_wise_payments)>0){ ?>
								<?php foreach($week_wise_payments as $list){ ?>
                                    <tr>
                                        <td>
										<?php echo isset($list['week_from'])?$list['week_from']:''; ?>&nbsp;-&nbsp;
										<?php echo isset($list['week_to'])?$list['week_to']:''; ?>
										</td>
                                        <td><?php echo isset($list['cnt'])?$list['cnt']:''; ?></td>
                                        <td>
										<?php echo isset($list['cash'])?$list['cash']:''; ?>
										<?php if($list['commision_amt']>0 && $list['commision_payment_status']==''){ ?>
										<a href="<?php echo base_url('payments/pay/'.base64_encode($list['week_from']).'/'.base64_encode($list['week_to'])); ?>">Pay</a>
										<?php }else if($list['commision_amt']>0 && $list['commision_payment_status']!=''){ ?>
										<b>Commision amount ( <?php echo $list['commision_amt']; ?> ) Paid </b>
										<?php } ?>
										
										</td>
                                        <td><?php echo isset($list['online'])?$list['online']:''; ?></td>
                                    </tr>
								<?php } ?>
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
