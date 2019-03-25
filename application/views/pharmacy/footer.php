
    <!-- start js include path -->

    <!-- bootstrap -->
    <script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" ></script>
    <script src="<?php echo base_url('assets/js/bootstrapValidator.min.js');?>" ></script>
    <!-- counterup -->
	<!-- data tables -->
    <script src="<?php echo base_url('assets/js/jquery.dataTables.min.js');?>" ></script>
 	<script src="<?php echo base_url('assets/js/dataTables.bootstrap4.min.js');?>" ></script>
    <script src="<?php echo base_url('assets/js/table_data.js');?>" ></script>
   
	<script src="<?php echo base_url('assets/js/app.js');?>" ></script>
    <script src="<?php echo base_url('assets/js/layout.js');?>" ></script>
    <!-- material -->
    <script src="<?php echo base_url('assets/material/material.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/Chart.bundle.js');?>" ></script>
    <script src="<?php echo base_url('assets/js/utils.js');?>" ></script>
    <script src="<?php echo base_url('assets/js/home-data2.js');?>" ></script>
    <script>
    function total_bill(){
    $('table thead th').each(function(i)
    {
      //alert();
       if(i==4){
      calculateColumn(i);
    }
    });
    }

    function calculateColumn(i)
    {
    var total = 0;
    $('table tr').each(function()
    {
    var value = parseInt($('td', this).eq(i).children('input').val());
    if (!isNaN(value))
    {
    total += value;
    }
  });
    $('#btotal').val(total);

    }
    </script>
    <script>
        $(document).ready(function() {
          $(document).on('change','.med',function(){

            price=$(this).children('option:selected').data('price');

            $(this).parent().parent().find('.price').val(price);
            total_bill();
          });
          $(document).on('change','.price',function(){

            price=$(this).val();
            qty=$(this).parent().parent().find('.qty').val();
            discount=$(this).parent().parent().find('.discount').val();
            if($qty==null || $qty==''){
              return false;
            }
            if(discount==null || discount==''){
              discount=0;
            }
            mprice=(price-(price/100)*discount)*qty;

            $(this).parent().parent().find('.total').val(mprice);
            total_bill();

          });
          $(document).on('keyup','.qty',function(){

            qty=$(this).val();
          price=$(this).parent().parent().find('.price').val();
          discount=$(this).parent().parent().find('.discount').val();
          if(price==null || price==''){
            return false;
          }
          if(discount==null || discount==''){
            discount=0;
          }
          mprice=(price-(price/100)*discount)*qty;

          $(this).parent().parent().find('.total').val(mprice);
          total_bill();
          });
          $(document).on('keyup','.discount',function(){

            discount=$(this).val();
          price=$(this).parent().parent().find('.price').val();
          qty=$(this).parent().parent().find('.qty').val();
          if(price==null || price==''){
            return false;
          }
          if(qty==null || qty==''){
            return false;
          }
          mprice=(price-(price/100)*discount)*qty;

          $(this).parent().parent().find('.total').val(mprice);
          total_bill();

          });
            var counter = 0;
            //var mlist=<?php echo $jmlist; ?>;
    //         $("#addRow").on("click", function() {
    //
    //             var newRow = $("<tr>");
    //             var cols = "";
    //               cols += '<td><select class="form-control med" name="medicine[]"><option value="" selected disabled>Select</option>';
		// $.each(mlist, function(i, list) {
    //     cols += '<option data-price="'+list.mrp+'" value="'+list.id+'">'+list.medicine_name+'</option>';
    //
    //           });
    //             cols += '<td><input type="text"  readonly class="form-control price" placeholder="Price" name="price[]"/></td>';
    //
    //             cols += '<td><input type="text"  class="form-control discount" placeholder="Discount" name="discount[]"/></td>';
    //
    //            cols += '<td><input type="text" class="form-control qty" placeholder="Quantity" name="qty[]"/></td>';
    //
    //
    //             cols += '<td><input type="text" readonly class="form-control total" placeholder="Total" name="total[]"/></td>';
    //
    //             cols += '<td><button type="button" class="ibtnDel btn btn-md btn-danger"><i class="fa fa-trash"></i></button></td>';
    //             newRow.append(cols);
    //           tr=$("table.table-list").append(newRow);
    //           select=tr.find('td:nth-child(1)').children('select');
    //
    //           $('#bpage').bootstrapValidator('addField',select);
    //           input2=tr.find('td:nth-child(2)').children('input');
    //             input3=tr.find('td:nth-child(3)').children('input');
    //               input4=tr.find('td:nth-child(4)').children('input');
    //                 input5=tr.find('td:nth-child(5)').children('input');
    //                 $('#bpage').bootstrapValidator('addField', input2);
    //                 $('#bpage').bootstrapValidator('addField', input3);
    //                 $('#bpage').bootstrapValidator('addField', input4);
    //                 $('#bpage').bootstrapValidator('addField', input5);
    //
    //
    //             counter++;
    //         });

            $("table.table-list").on("click", ".ibtnDel", function(event) {
                $(this).closest("tr").remove();
                counter -= 1;
                  total_bill();
            });
        });
    </script>


  </body>

</html>
