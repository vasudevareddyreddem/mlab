

<div class="page-content-wrapper">
    <div class="page-content">

        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>Pick Up Orders List</header>
                    </div>
                    <div class="card-body ">
                        <div class="table-responsive">
                            <table id="saveStage" class="display table" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Patient Name</th>
                                        <th>Mobile Number</th>
                                        <th>Order Tests</th>
                                        <th>Address</th>
                                        <th>Pick Up Date & Time</th>
                                        <th>Payment</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $count=1;
                                foreach ($order_list as $list ){?>
                                    <tr>
                                        <td><?php echo $count;?></td>
                                        <td><?php echo $list->p_name;?></td>
                                        <td><?php echo $list->mobile;?></td>
                                        <td><?php echo $list->test_name;?></td>
                                        <td><?php echo $list->address;?></td>
                                        <td><?php echo $list->address;?></td>
                                        <td>$list->mobile</td>
                                        <td>COD</td>
                                        <td class="valigntop">
                                            <div class="btn-group">
                                                <button class="btn btn-xs deepPink-bgcolor dropdown-toggle no-margin" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                    <i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-hourglass-start"></i>&nbsp;Start for Pickup
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="">
                                                            <i class="fa fa-money"></i>&nbsp;
                                                            Collected Samples / Money</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php }?>
                                    <tr>
                                        <td>2</td>
                                        <td>xxxxx</td>
                                        <td>xxxxxx</td>
                                        <td>xxxxx</td>
                                        <td>xxxx</td>
                                        <td>xxxx</td>
                                        <td>COD</td>
                                        <td class="valigntop">
                                            <div class="btn-group">
                                                <button class="btn btn-xs deepPink-bgcolor dropdown-toggle no-margin" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                    <i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-hourglass-start"></i>&nbsp;Start for Pickup
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="">
                                                            <i class="fa fa-money"></i>&nbsp;
                                                            Collected Samples / Money</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>xxxxx</td>
                                        <td>xxxxxx</td>
                                        <td>xxxxx</td>
                                        <td>xxxx</td>
                                        <td>xxxx</td>
                                        <td>COD</td>
                                        <td class="valigntop">
                                            <div class="btn-group">
                                                <button class="btn btn-xs deepPink-bgcolor dropdown-toggle no-margin" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                    <i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-hourglass-start"></i>&nbsp;Start for Pickup
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="">
                                                            <i class="fa fa-money"></i>&nbsp;
                                                            Collected Samples / Money</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>xxxxx</td>
                                        <td>xxxxxx</td>
                                        <td>xxxxx</td>
                                        <td>xxxx</td>
                                        <td>xxxx</td>
                                        <td>COD</td>
                                        <td class="valigntop">
                                            <div class="btn-group">
                                                <button class="btn btn-xs deepPink-bgcolor dropdown-toggle no-margin" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                    <i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-hourglass-start"></i>&nbsp;Start for Pickup
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="">
                                                            <i class="fa fa-money"></i>&nbsp;
                                                            Collected Samples / Money</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>xxxxx</td>
                                        <td>xxxxxx</td>
                                        <td>xxxxx</td>
                                        <td>xxxx</td>
                                        <td>xxxx</td>
                                        <td>COD</td>
                                        <td class="valigntop">
                                            <div class="btn-group">
                                                <button class="btn btn-xs deepPink-bgcolor dropdown-toggle no-margin" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                    <i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-hourglass-start"></i>&nbsp;Start for Pickup
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="">
                                                            <i class="fa fa-money"></i>&nbsp;
                                                            Collected Samples / Money</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
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
