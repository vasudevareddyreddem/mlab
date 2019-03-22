<div id="app" class="page-content-wrapper">
   <div class="page-content">
      <div class="row">
         <div class="col-md-12">
            <div class="card card-topline-aqua">
               <div class="card-head">
                  <header>Billing</header>
                  <a href="<?php echo base_url('pharmacyadmin/orders')?>" class="btn btn-info btn-sm mt-2 mr-3 pull-right">
                  <i class="fa fa-arrow-left mr-2"></i>Back
                  </a>
               </div>
               <div class="card-body ">
                  <!-- form start -->
                  <form id="bpage" name="" action="<?php echo base_url('pharmacyadmin/add_billing');?>" method="post">
                     <input type='hidden' name='order_id' value="<?php echo base64_encode($id);?>">
                     <div class="row">
                        <div class="form-group col-md-6">
                           <label>Date</label>
                           <input type="date" class="form-control" name="date" />
                        </div>
                        <div class="col-md-12">
                           <div class="table-responsive">
                              <table id="myTable" class="table table-list">
                                 <thead>
                                    <tr>
                                       <th>Medicine List</th>
                                       <th>Price</th>
                                       <th>Discount</th>
                                       <th>Quantity</th>
                                       <th>Total</th>
                                       <th>&nbsp;</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td class="form-group">
                                          <select   name="medicine[]" class="form-control med selectpicker">
                                             <?php if($status==1){?>
                                             <option value="" selected disabled>Select</option>
                                             <?php 	foreach($mlist as $row){ ?>
                                             <option data-price='<?php echo $row['smrp'];?>' value="<?php echo $row['id'];?>"><?php echo $row['medicine_name'];?></option>
                                             <?php }}else{?>
                                             <option value="" selected disabled>No Medicines</option>
                                             <?php }?>
                                          </select>
                                       </td>
                                       <td class="form-group">
                                          <input type="text" name="price[]" placeholder="Price" class="form-control price" readonly />
                                       </td>
                                       <td class="form-group">
                                          <input type="text" name="discount[]" placeholder="Discount" class="form-control discount" />
                                       </td>
                                       <td class="form-group">
                                          <input type="text" name="qty[]" placeholder="Quantity" class="form-control qty" />
                                       </td>
                                       <td class="form-group">
                                          <input type="text" name="total[]" placeholder="Price" class="form-control total"  readonly />
                                       </td>
                                       <td><button @click="addRow" type="button" class="btn btn-md btn-primary" ><i class="fa fa-plus"></i></button></td>
                                    </tr>
                                    <tr v-for="(input, index) in inputs">
                                       <td class="form-group">
                                          <select  name="medicine[]" class="form-control med">
                                             <?php if($status==1){?>
                                             <option value="" selected disabled>Select</option>
                                             <?php 	foreach($mlist as $row){ ?>
                                             <option data-price='<?php echo $row['smrp'];?>' value="<?php echo $row['id'];?>"><?php echo $row['medicine_name'];?></option>
                                             <?php }}else{?>
                                             <option value="" selected disabled>No Medicines</option>
                                             <?php }?>
                                          </select>
                                       </td>
                                       <td class="form-group">
                                          <input type="text" name="price[]" placeholder="Price" class="form-control price" readonly />
                                       </td>
                                       <td class="form-group">
                                          <input type="text" name="discount[]" placeholder="Discount" class="form-control discount" />
                                       </td>
                                       <td class="form-group">
                                          <input type="text" name="qty[]" placeholder="Quantity" class="form-control qty" />
                                       </td>
                                       <td class="form-group">
                                          <input type="text" name="total[]" placeholder="Price" class="form-control total"  readonly />
                                       </td>
                                       <td><button @click="deleteRow(index)" type="button" class=" btn btn-md btn-danger"><i class="fa fa-trash"></i></button></td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        <div class="form-group col-md-6">
                           <label>Total Price</label>
                           <input type="text" id='btotal' class="form-control total" name="totalprice" placeholder="Total Price"/>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                        <div class="text-center col-md-12">
                           <button type="submit" class="btn btn-md btn-success btn-flat">Add</button>
                        </div>
                     </div>
                  </form>
               </div>
               <div class="clearfix">&nbsp;</div>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
   $(document).ready(function() {
   
      $('#bpage').bootstrapValidator({
   
          fields: {
              'medicine[]': {
                  validators: {
                      notEmpty: {
                          message: 'Select Medicine'
                      }
                  }
              },
              'qty[]': {
                  validators: {
                      notEmpty: {
                          message: 'Please enter Quantity'
                      }
                  }
              },
              date: {
                  validators: {
                      notEmpty: {
                          message: 'Select  Delivery Date'
                      }
                  }
              }
              }
          })
   
   });
</script>
<script>
   var myObject = new Vue({
     el: '#app',
     data: {message: <?php echo $jmlist; ?>,inputs: []}
     ,
     methods: {
       addRow() {
         this.inputs.push({
           one: '',
           two: ''
         })
       },
       deleteRow(index) {
         this.inputs.splice(index,1)
       }
     }
   
   })
</script>
