
			<div class="page-content-wrapper">
                <div class="page-content">

					<div class="row">
                       <div class="col-md-12">
                            <div class="card card-topline-aqua">

                                <div class="card-head">
                                     <header>Medicine List</header>
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
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id='body'>
                                      <?php     if($status==1) {
                                        foreach($mlist as $row){?>
                                            <tr  >
                                                <td><?php echo $row['hsn'];?></td>
                                                <td><?php echo $row['mfr'];?></td>
                                                <td><?php echo $row['medicine_name'];?></td>
                                                <td><?php echo $row['medicine_type'];?></td>
                                                <td><?php echo $row['expiry_date'];?></td>
                                                <td><?php echo $row['dosage'];?></td>
                                                <td><?php echo $row['quantity'];?></td>
                                                  <td><?php echo $row['rate'];?></td>
                                                <td><?php echo $row['sgst'];?></td>
                                                <td><?php echo $row['cgst'];?></td>
                                                <td><?php echo $row['mrp'];?></td>
                                               <td class="valigntop">
                                                   <div class="btn-group">
                                                       <button class="btn btn-xs deepPink-bgcolor dropdown-toggle no-margin" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                           <i class="fa fa-angle-down"></i>
                                                       </button>
                                                       <ul class="dropdown-menu" role="menu">
                                                           <li>
                                                               <a href="<?php echo base_url('pharmacyadmin/edit_medicine/').base64_encode($row['id']);?>">
                                                                   <i class="fa fa-save"></i> Edit</a>
                                                           </li>
                                                           <li>
                                                               <a href="<?php echo base_url('pharmacyadmin/med_del/').base64_encode($row['id']);?>">
                                                                   <i class="fa fa-trash-o"></i>Delete</a>
                                                           </li>
                                                       </ul>
                                                   </div>
                                               </td>
                                            </tr>
                                          <?php }}?>
                                        </tbody>
                                    </table>
                                </div>
								<div class="clearfix">&nbsp;</div>



                            </div>
                        </div>
                    </div>


                </div>
            </div>
						<script type="text/javascript">
    $(document).ready(function(){
           var count=2;
			$('#add').click(function() {


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
