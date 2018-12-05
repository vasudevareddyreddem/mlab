<!--  The entire list of Checkout fields is available at
 https://docs.razorpay.com/docs/checkout-form#checkout-fields -->
<style>
    .razorpay-payment-button{
	 background:#192f5d;
	 color:#fff;
	 padding:3px 15px 7px;
	 border:none;
	 border-radius:2px;
     font-size: 14px;
    cursor: pointer;
 }
 </style>
<?php //echo "<pre>";print_r($details);exit; ?>


<div class="page-content-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>Bill Preview</header>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8 mx-auto">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Time Period</th>
                                        <td>
                                            <?php echo isset($week_from)?$week_from:''; ?> &nbsp; - &nbsp;
                                            <?php echo isset($week_from)?$week_from:''; ?>
                                        </td>
                                    </tr>
									<tr>
                                        <th>Total Amount</th>
                                        <td>
                                            <?php echo isset($cash)?$cash:''; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Without Pick Up amount</th>
                                        <td>
                                             <?php echo isset($with_out_delivery_cash_amt)?$with_out_delivery_cash_amt:''; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Commission amount</th>
                                        <td>
                                            <?php echo isset($commision_amt)?$commision_amt:''; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Orders</th>
                                        <td>
                                            <?php echo isset($cnt)?$cnt:''; ?>
                                        </td>
                                    </tr>
									<tr>
                                        <th>Commission rate</th>
                                        <td>
                                            <?php echo isset($lab_details['commission_amt'])?$lab_details['commission_amt']:''; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Pay Amount</th>
                                        <td>
                                            <?php echo isset($commision_amt)?$commision_amt:''; ?>
                                        </td>
                                    </tr>
                                   

                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="container mb-4">
                        <div class="row justify-content-md-center">
                            <div class="col-md-3">
                                <form id="paymentform" name="paymentform" action="<?php echo base_url('Payments/success'); ?>" method="POST">
                                    <input type="hidden" name="week_from" id="week_from" value="<?php echo base64_encode($week_from); ?>">
                                    <input type="hidden" name="week_to" id="week_to" value="<?php echo base64_encode($week_to); ?>">
                                    <input type="hidden" name="payamount" id="payamount" value="<?php echo base64_encode($commision_amt); ?>">
                                    <input type="hidden" name="cnt" id="cnt" value="<?php echo base64_encode($cnt); ?>">
                                    <input type="hidden" name="cash" id="cash" value="<?php echo base64_encode($cash); ?>">
                                    <input type="hidden" name="with_out_delivery_cash_amt" id="with_out_delivery_cash_amt" value="<?php echo base64_encode($with_out_delivery_cash_amt); ?>">
                                    <a href="<?php echo base_url('payments/pay/'.base64_encode($week_from).''.base64_encode($week_to)); ?>" class="btn btn-info mt-3 pb-2" name="" value="">Back</a>
                                    
                                    <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="<?php echo $details['key']?>" data-amount="<?php echo $details['amount']?>" data-currency="INR" data-name="<?php echo $details['name']?>" data-image="<?php echo $details['image']?>" data-description="<?php echo $details['description']?>" data-prefill.name="<?php echo $details['prefill']['name']?>" data-prefill.email="<?php echo $details['prefill']['email']?>" data-prefill.contact="<?php echo $details['prefill']['contact']?>" data-notes.shopping_order_id="<?php echo $details['b_id']?>" data-order_id="<?php echo $details['order_id']?>" <?php if ($details['display_currency'] !=='INR' ) { ?> data-display_amount="<?php echo $details['amount']?>" <?php } ?>
                                    <?php if ($details['display_currency'] !== 'INR') { ?> data-display_currency="<?php echo $details['display_currency']?>" <?php } ?>
                                    >
                                    </script>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>