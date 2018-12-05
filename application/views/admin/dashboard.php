<?php

$dec=$jan=$feb=$mar=$apr=$may=$jun=$jul=$aug=$sep=$oct=$nov=0;
if(isset($total_lab_list) && count($total_lab_list)>0){
foreach ($total_lab_list as $cri){
$dat = explode("-", $cri['created_at']);
	if($dat[1] == 12)
	{
	$dec++;
	}
	if($dat[1] == 11)
	{
		$nov++;
	}
	if($dat[1] == 10)
	{
		$oct++;
	}
	if($dat[1] == '09')
	{
		$sep++;
	}if($dat[1] == '08')
	{
		$aug++;
	}if($dat[1] == '07')
	{
		$jul++;
	}if($dat[1] == '06')
	{
		$jun++;
	}if($dat[1] == '05')
	{
		$may++;
	}if($dat[1] == 04)
	{
		$apr++;
	}if($dat[1] == 03)
	{
		$mar++;
	}if($dat[1] == 02)
	{
		$feb++;
	}if($dat[1] == 01)
	{
		$jan++;
	}
}	
} 
$dec1=$jan1=$feb1=$mar1=$apr1=$may1=$jun1=$jul1=$aug1=$sep1=$oct1=$nov1=0;
if(isset($total_pharmacy_list) && count($total_pharmacy_list)>0){
foreach ($total_pharmacy_list as $cri){
$dat = explode("-", $cri['created_at']);
	if($dat[1] == 12)
	{
	$dec1++;
	}
	if($dat[1] == 11)
	{
		$nov1++;
	}
	if($dat[1] == 10)
	{
		$oct1++;
	}
	if($dat[1] == '09')
	{
		$sep1++;
	}if($dat[1] == '08')
	{
		$aug1++;
	}if($dat[1] == '07')
	{
		$jul1++;
	}if($dat[1] == '06')
	{
		$jun1++;
	}if($dat[1] == '05')
	{
		$may1++;
	}if($dat[1] == 04)
	{
		$apr1++;
	}if($dat[1] == 03)
	{
		$mar1++;
	}if($dat[1] == 02)
	{
		$feb1++;
	}if($dat[1] == 01)
	{
		$jan1++;
	}
}	
}  

$total_lab_list = array(
    	array("y" => isset($jan)?$jan:'', "label" => "January"),
    	array("y" => isset($feb)?$feb:'', "label" => "February"),
    	array("y" => isset($mar)?$mar:'', "label" => "March"),
    	array("y" => isset($apr)?$apr:'', "label" => "April "),
    	array("y" => isset($may)?$may:'', "label" => "May"),
    	array("y" => isset($jun)?$jun:'', "label" => "June"),
    	array("y" => isset($jul)?$jul:'', "label" => "July"),
    	array("y" => isset($aug)?$aug:'', "label" => "August"),
    	array("y" => isset($sep)?$sep:'', "label" => "September"),
    	array("y" => isset($oct)?$oct:'', "label" => "October"),
    	array("y" => isset($nov)?$nov:'', "label" => "November"),
    	array("y" => isset($dec)?$dec:'', "label" => "December"),
    ); 
	$total_pharmacy_list = array(
    	array("y" => isset($jan1)?$jan1:'', "label" => "January"),
    	array("y" => isset($feb1)?$feb1:'', "label" => "February"),
    	array("y" => isset($mar1)?$mar1:'', "label" => "March"),
    	array("y" => isset($apr1)?$apr1:'', "label" => "April "),
    	array("y" => isset($may1)?$may1:'', "label" => "May"),
    	array("y" => isset($jun1)?$jun1:'', "label" => "June"),
    	array("y" => isset($jul1)?$jul1:'', "label" => "July"),
    	array("y" => isset($aug1)?$aug1:'', "label" => "August"),
    	array("y" => isset($sep1)?$sep1:'', "label" => "September"),
    	array("y" => isset($oct1)?$oct1:'', "label" => "October"),
    	array("y" => isset($nov1)?$nov1:'', "label" => "November"),
    	array("y" => isset($dec1)?$dec1:'', "label" => "December"),
    );
?>
<script>
    window.onload = function() {

        var chart = new CanvasJS.Chart("chartContainer", {
            title: {
                text: "Month wise List"
            },
            axisY: {
                title: " count range"
            },
            legend: {
                cursor: "pointer",
                dockInsidePlotArea: true,
                itemclick: toogleDataSeries
            },
            data: [{
                    type: "spline",
                    showInLegend: true,
                    name: "Total Lab List",
                    lineDashType: "solid",
                    color: "#E91E63",
                    dataPoints: <?php echo json_encode($total_lab_list, JSON_NUMERIC_CHECK); ?>
                },
                {
                    type: "spline",
                    showInLegend: true,
                    name: "Total Pharmacy List",
                    lineDashType: "solid",
                    color: "#FF9800",
                    dataPoints: <?php echo json_encode($total_pharmacy_list, JSON_NUMERIC_CHECK); ?>
                }
            ]
        });
        chart.render();

        function toogleDataSeries(e) {
            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            } else {
                e.dataSeries.visible = true;
            }
            chart.render();
        }
    }
</script>
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Dashboard</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Dashboard</li>
                </ol>
            </div>
        </div>
        <!-- start widget -->
        <div class="row">
            <div class="col-lg-5 col-md-5">
                <div class="card mt-0 btn-info">
                    <div class="panel-body">
                        <h3 class="mt-2 mb-2 text-white">No.of Lab's </h3>
                        <div class="progressbar-xs progress-rounded progress-striped progress ng-isolate-scope active">
                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo $lab_list['cnt']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $lab_list['cnt']; ?>%;"></div>
                        </div>
                        <span class="text-small margin-top-10 full-width text-white">
                            <?php echo $lab_list['cnt']; ?>
                        </span>
                    </div>
                </div>
                <div class="card btn-success">
                    <div class="panel-body">
                        <h3 class="mt-2 mb-2 text-white">No.of Pharmacy's</h3>
                        <div class="progressbar-xs progress-rounded progress-striped progress ng-isolate-scope active">
                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo $pharmacy_list['cnt']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $pharmacy_list['cnt']; ?>%;"></div>
                        </div>
                        <span class="text-small margin-top-10 full-width text-white">
                            <?php echo $pharmacy_list['cnt']; ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-7">
                <div id="chartContainer" style="height: 280px; width: 100%;"></div>
            </div>
        </div>
            
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/vendor/canvasjs.min.js"></script>