
    <!-- start js include path -->

    <!-- bootstrap -->
    <script src="<?php echo base_url('assets/vendor/admin/js/bootstrap.min.js');?>" ></script>
    <script src="<?php echo base_url('assets/vendor/admin/js/bootstrapValidator.min.js');?>" ></script>
    <!-- counterup -->
	<!-- data tables -->
    <script src="<?php echo base_url('assets/vendor/admin/vendor/admin/js/jquery.dataTables.min.js');?>" ></script>
 	<script src="<?php echo base_url('assets/vendor/admin/vendor/admin/js/dataTables.bootstrap4.min.js');?>" ></script>
    <script src="<?php echo base_url('assets/vendor/admin/vendor/admin/js/table_data.js');?>" >
    <!-- Common js-->
    <!-- Common js-->
	<script src="<?php echo base_url('assets/vendor/admin/js/app.js');?>" ></script>
    <script src="<?php echo base_url('assets/vendor/admin/js/layout.js');?>" ></script>
    <!-- material -->
    <script src="<?php echo base_url('assets/vendor/admin/material/material.min.js');?>"></script>
	<script src="<?php echo base_url('assets/vendor/admin/js/Chart.bundle.js');?>" ></script>
    <script src="<?php echo base_url('assets/vendor/admin/js/utils.js');?>" ></script>
    <script src="<?php echo base_url('assets/vendor/admin/js/home-data2.js');?>" ></script>
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
         
        });
    </script>


  </body>

</html>
