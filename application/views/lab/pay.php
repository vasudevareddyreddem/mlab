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
                                        <th>Name</th>
                                        <td>
                                            <?php echo isset($details['name'])?$details['name']:''; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Email Address</th>
                                        <td>
                                            <?php echo isset($details['email_id'])?$details['email_id']:''; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Mobile</th>
                                        <td>
                                            <?php echo isset($details['mobile_no'])?$details['mobile_no']:''; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Project</th>
                                        <td>
                                            <?php echo isset($details['project'])?$details['project']:''; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Amount</th>
                                        <td>
                                            <?php echo isset($details['amount'])?$details['amount']:''; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Pay</th>
                                        <td>
                                            <?php echo isset($details['pay'])?$details['pay']:''; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Due</th>
                                        <td>
                                            <?php echo isset($details['due'])?$details['due']:''; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2"><strong>Address:</strong>
                                            <?php echo isset($details['adress'])?$details['adress']:''; ?>
                                        </td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="container mb-4">
                        <div class="row justify-content-md-center">
                            <div class="col-md-3">
                                <form id="paymentform" name="paymentform" action="<?php echo base_url('payment/success'); ?>" method="POST">
                                    
                                    <a href="#" class="btn btn-info mt-3 pb-2" name="" value="">Back</a>
                                    
                                    <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="<?php echo $details['key']?>" data-amount="<?php echo $details['amount']?>" data-currency="INR" data-name="<?php echo $details['name']?>" data-image="<?php echo $details['image']?>" data-description="<?php echo $details['description']?>" data-prefill.name="<?php echo $details['prefill']['name']?>" data-prefill.email="<?php echo $details['prefill']['email']?>" data-prefill.contact="<?php echo $details['prefill']['contact']?>" data-notes.shopping_order_id="<?php echo $details['b_id']?>" data-order_id="<?php echo $details['order_id']?>" <?php if ($details['display_currency'] !=='INR' ) { ?> data-display_amount="<?php echo $details['amount']?>" <?php } ?>
                                    <?php if ($details['display_currency'] !== 'INR') { ?> data-display_currency="<?php echo $details['display_currency']?>" <?php } ?>
                                    >
                                    </script>
                                    
                                    <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
                                    <input type="hidden" name="b_id" value="<?php echo isset($details['b_id'])?$details['b_id']:''; ?>">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>