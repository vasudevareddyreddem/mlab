
<div class="page-content-wrapper">
    <div class="page-content">

        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>My Profile</header>
                        <a href="<?php echo base_url('pharmacyadmin/profileedit/'); ?>" class="btn btn-primary btn-sm pull-right mt-2 mr-4">Edit</a>
                    </div>
                    <div class="card-body ">
                        <div class="table-responsive">
                            <table id="" class="table table-bordered" style="width:100%;">
                                <tbody>
                                    <tr>
                                        <td>Name</td>
                                        <td><?php echo isset($mlab_details['name'])?$mlab_details['name']:'';
                                         ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mobile Number</td>
                                        <td><?php echo isset($mlab_details['mobile'])?$mlab_details['mobile']:''; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email Id</td>
                                        <td><?php echo isset($mlab_details['email'])?$mlab_details['email']:''; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td><?php echo isset($mlab_details['address1'])?$mlab_details['address1']:''; ?></td>
                                    </tr>
                                    <!--<tr>
                                        <td>Address2</td>
                                        <td><?php echo isset($mlab_details['address2'])?$mlab_details['address2']:''; ?></td>
                                    </tr>-->
                                    <tr>
                                        <td>City</td>
                                        <td><?php echo isset($mlab_details['city'])?$mlab_details['city']:''; ?></td>
                                    </tr>
                                    <tr>
                                        <td>State</td>
                                        <td><?php echo isset($mlab_details['state'])?$mlab_details['state']:''; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Pincode</td>
                                        <td><?php echo isset($mlab_details['zipcode'])?$mlab_details['zipcode']:''; ?></td>
                                    </tr>
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
