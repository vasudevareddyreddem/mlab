
<style>

</style>

<div class="page-content-wrapper">
    <div class="page-content">

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card  card-topline-aqua">
                    <div class="card-head">
                        <header>Track Order</header>
                    </div>
                    <div class="card-body ">
                        <div class="container">
                            <div class="row">
                                <section style="width:80%;margin-left:10%;">
                                    <div class="wizard">
                                        <div class="wizard-inner">
                                            <div class="connecting-line"></div>
                                            <ul class="nav nav-tabs" role="tablist">

                                                <li role="presentation" class="active">
                                                    <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                                                        <span class="round-tab">
                                                            <i class="fa fa-check-circle"></i>
                                                        </span>
                                                    </a>
                                                </li>

                                                <li role="presentation" class="disabled">
                                                    <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                                                        <span class="round-tab">
                                                            <i class="fa fa-gift"></i>
                                                        </span>
                                                    </a>
                                                </li>
                                                <li role="presentation" class="disabled">
                                                    <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                                                        <span class="round-tab">
                                                            <i class="fa fa-truck"></i>
                                                        </span>
                                                    </a>
                                                </li>

                                                <li role="presentation" class="disabled">
                                                    <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                                                        <span class="round-tab">
                                                            <i class="fa fa-thumbs-up"></i>
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <form role="form">
                                            <div class="tab-content">
                                                <div class="tab-pane active" role="tabpanel" id="step1">
                                                    <h1 class="text-center">Order Confirmed</h1>
                                                </div>
                                                <div class="tab-pane" role="tabpanel" id="step2">
                                                    <h1 class="text-center">Packed</h1>
                                                </div>
                                                <div class="tab-pane" role="tabpanel" id="step3">
                                                    <h1 class="text-center">Shipped</h1>
                                                </div>
                                                <div class="tab-pane" role="tabpanel" id="complete">
                                                    <h1 class="text-center">You have successfully completed your order.</h1>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </form>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end admited patient list -->
    </div>
</div>
<script>
    $(function() {
        $('.btn-circle').on('click', function() {
            $('.btn-circle.btn-info').removeClass('btn-info').addClass('btn-default');
            $(this).addClass('btn-info').removeClass('btn-default').blur();
        });
    });
</script>
