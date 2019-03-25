

			<div class="page-content-wrapper">

                <div class="page-content">

					<div class="row">
                       <div class="col-md-12">
                            <div class="card card-topline-aqua">
																	<form id='upload' method="post" action="<?php echo base_url('pharmacyadmin/ins_med');?>">
                                <div class="card-head">
                                     <header>Upload Medicine</header>
                                </div>
																<div><?php if(isset($dup)){
																	if(count($dup)>0){
																		foreach($dup as $row){?>
																	<span><?php echo $row['med'];?>with this dosage  <?php echo $row['med'];?>already existed
																		<br>
																<?php	}}}?>

																 </div>
                                <div class="card-body table-responsive">

                                    <table id="saveStage" class="display table" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>HSN</th>
                                                <th>MFR</th>
                                                <th>Medicine Name</th>
                                                <th>Medicine Type</th>
                                                <th>Exipry Date</th>
                                                <th>Medicine Dosage</th>
                                                <th>Qty</th>
                                                <th>Rate</th>
                                                <th>SGST</th>
                                                <th>CGST</th>
                                                <th>MRP</th>
                                            </tr>
                                        </thead>
                                        <tbody id='body'>
                                            <tr  id='1' >
                                                <td  class="form-group"><input type="text" class="form-control "  name="hsn[]" id="" placeholder="" ></td>
                                                <td class="form-group"><input type="text" class="form-control"  name="mfr[]" id="" placeholder="" ></td>
                                                <td class="form-group"><input type="text" class="form-control"  name="mname[]" id="" placeholder="" ></td>
                                                <td class="form-group"><input type="text" class="form-control"  name="mtype[]" id="" placeholder="" ></td>
                                                <td class="form-group"><input type="date" class="form-control"  name="exp[]" id="" placeholder="" ></td>
                                                <td class="form-group"><input type="text" class="form-control"  name="dos[]" id="" placeholder="" ></td>
                                                <td class="form-group"><input type="text" class="form-control"  name="qty[]" id="" placeholder="" ></td>
                                                <td class="form-group"><input type="text" class="form-control"  name="rate[]" id="" placeholder="" ></td>
                                                <td class="form-group"><input type="text" class="form-control"  name="sgst[]" id="" placeholder="" ></td>
                                                <td class="form-group"><input type="text" class="form-control"  name="cgst[]" id="" placeholder="" ></td>
                                                <td class="form-group"><input type="text" class="form-control"  name="mrp[]" id="" placeholder="" ></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
								<div class="clearfix">&nbsp;</div>

                                <div class="text-center">
                                    <div class="col-md-12">
                                        <button id="add" type="button" class="btn btn-primary">Add more Medicine</button>
                                        <button type="submit" class="btn btn-info">Submit</button>
                                        <button  id='remove' type="button" class="btn btn-danger">Remove</button>
                                    </div>
                                    
                                </div>
															</form>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
						<script type="text/javascript">
    $(document).ready(function(){
           var count=2;
			$(document).on('click','#add',function() {


					   code= '<tr id="'+count+'">'+
									 '<td><input type="text" class="form-control"  name="hsn[]"  ></td>'+
									' <td><input type="text" class="form-control"  name="mfr[]"  ></td>'+
									'<td><input type="text" class="form-control"  name="mname[]" id="" placeholder="" ></td>'+
									 '<td><input type="text" class="form-control"  name="mtype[]" id="" placeholder="" ></td>'+
									'<td><input type="text" class="form-control"  name="exp[]" id="" placeholder="" ></td>'+
									 '<td><input type="text" class="form-control"  name="dos[]" id="" placeholder="" ></td>'+
									 '<td><input type="text" class="form-control"  name="qty[]" id="" placeholder="" ></td>'+
									 '<td><input type="text" class="form-control"  name="rate[]" id="" placeholder="" ></td>'+
									 '<td><input type="text" class="form-control"  name="cgst[]" id="" placeholder="" ></td>'+
									 '<td><input type="text" class="form-control"  name="sgst[]" id="" placeholder="" ></td>'+
									 '<td><input type="text" class="form-control"  name="mrp[]" id="" placeholder="" ></td>'+
							 '</tr>';

			        $('#body').append(code);
						count++;
			    });
					$('#remove').click(function(){
						if(count<3){
							return false;
						}
            x=count-1;
						$('#'+x).remove();
						count--;

					});
    });
</script>
<script>
	$(document).ready(function() {
    $('#upload').bootstrapValidator({

        fields: {
            'hsn[]': {
                validators: {
                    notEmpty: {
                        message: 'Enter Value'
                    }
                }
            },
            'mfr[]': {
                validators: {
                    notEmpty: {
                        message: 'Enter Value'
                    }
                }
            },
						'mname[]': {
                validators: {
                    notEmpty: {
                        message: 'Enter Value'
                    }
                }
            },
						'mtype[]': {
                validators: {
                    notEmpty: {
                        message: 'Enter Value'
                    }
                }
            },
						'exp[]': {
                validators: {
                    notEmpty: {
                        message: 'Enter Value'
                    }
                }
            },
						'dos[]': {
                validators: {
                    notEmpty: {
                        message: 'Enter Value'
                    }
                }
            },
						'qty[]': {
                validators: {
                    notEmpty: {
                        message: 'Enter Value'
                    }
                }
            },
						'rate[]': {
                validators: {
                    notEmpty: {
                        message: 'Enter Value'
                    }
                }
            },
						'cgst[]': {
                validators: {
                    notEmpty: {
                        message: 'Enter Value'
                    }
                }
            },
						'sgst[]': {
								validators: {
										notEmpty: {
												message: 'Enter Value'
										}
								}
						},
						'mrp[]': {
								validators: {
										notEmpty: {
												message: 'Enter Value'
										}
								}
						},

            }
        })

});
</script>
