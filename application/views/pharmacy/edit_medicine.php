
<div class="page-content-wrapper">
  <div class="page-content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-topline-aqua">

          <div class="card-head">
            <header>Edit Medicine</header>
          </div>
          <form method='post' action='<?php echo base_url('pharmacyadmin/insert_edit_med');?>'>
            <input type='hidden' value="<?php echo base64_encode($med['id']);?>" name='id'>
          <div class="card-body ">
            <div class="form-group col-md-6">
              <label> HSN </label>
              <input type="text" class="form-control"  name="hsn" id=""  value="<?php echo $med['hsn'];?>" >
            </div>
            <div class="form-group col-md-6">
              <label> MFR </label>
              <input type="text" class="form-control"  name="mfr" id="" value="<?php echo $med['mfr'];?>" >
            </div>

            <div class="form-group col-md-6">
              <label>   Medicine Name </label>
              <input type="text" class="form-control"  name="mname" id="" value="<?php echo $med['medicine_name'];?>" >
            </div>
            <div class="form-group col-md-6">
              <label>   Medicine Type </label>
              <input type="text" class="form-control"  name="mtype" id="" value="<?php echo $med['medicine_type'];?>" >
            </div>

            <div class="form-group col-md-6">
              <label>     Medicine Dosage </label>
              <input type="text" class="form-control"  name="dos" id="" value="<?php echo $med['dosage'];?>" >
            </div>
            <div class="form-group col-md-6">
              <label>  Qty</label>
              <input type="text" class="form-control"  name="qty" id="" value="<?php echo $med['quantity'];?>" >
            </div>

            <div class="form-group col-md-6">
              <label>  Rate </label>
              <input type="text" class="form-control"  name="rate" id="" value="<?php echo $med['rate'];?>" >
            </div>
            <div class="form-group col-md-6">
              <label>    SGST </label>
              <input type="text" class="form-control"  name="sgst" id=""  value="<?php echo $med['sgst'];?>">
            </div>

            <div class="form-group col-md-6">
              <label>   CGST</label>
              <input type="text" class="form-control"  name="cgst" id="" value="<?php echo $med['cgst'];?>" >
            </div>
            <div class="form-group col-md-6">
              <label>MRP</label>
              <input type="text" class="form-control"  name="mrp" id="" value="<?php echo $med['mrp'];?>" >
            </div>

    </div>
    <div class="clearfix">&nbsp;</div>

    <div class="text-center">
      <div class="col-md-12">

        <button type="submit" class="btn btn-info">Submit</button>

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
  $('#add').click(function() {


    code= '<tr id="'+count+'">'+
    '<input type="text" class="form-control"  name="hsn[]"  >'+
    ' <input type="text" class="form-control"  name="mfr[]"  >'+
    '<input type="text" class="form-control"  name="mname[]" id="" placeholder="" >'+
    '<input type="text" class="form-control"  name="mtype[]" id="" placeholder="" >'+
    '<input type="text" class="form-control"  name="exp[]" id="" placeholder="" >'+
    '<input type="text" class="form-control"  name="dos[]" id="" placeholder="" >'+
    '<input type="text" class="form-control"  name="qty[]" id="" placeholder="" >'+
    '<input type="text" class="form-control"  name="rate[]" id="" placeholder="" >'+
    '<input type="text" class="form-control"  name="cgst[]" id="" placeholder="" >'+
    '<input type="text" class="form-control"  name="sgst[]" id="" placeholder="" >'+
    '<input type="text" class="form-control"  name="mrp[]" id="" placeholder="" >'+
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
