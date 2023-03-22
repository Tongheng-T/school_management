<?php

// if ($_SESSION['useremail'] == "" or $_SESSION['role'] == "User") {
//   header('location:index.php');
// }

?>
<!-- Content Wrapper. Contains page content -->

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Admin Dashboard
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
      <li class="active">Here</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content container-fluid">

    <!--------------------------
        | Your Page Content Here |
        -------------------------->


    <div class="box box-warning">
      <form action="" method="get" name="">
        <div class="box-header with-border">
          <div class="col-md-3">
            <br>
            <h3 class="box-title" style="font-family:tong;">បញ្ចូលពន្ទុប្រចាំខែ: <?php $date = date('m'); echo convert_month_kh($date);?></h3>
            <?php display_message(); ?>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label style="font-family:tong;">ខែ:  </label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="datepicker" name="date" value="<?php echo date("Y-m-d"); ?>" data-date-format="yyyy-mm-dd">
              </div>
              <!-- /.input group -->
            </div>
          </div>
        </div>
        <!-- /.box-header -->
        <!-- form start -->

        <div class="box-body">
          <div style="overflow-x:auto;font-family:tong;" id="orderlisttable">
            <?php get_sb_name();?>
          

        
          </div>

        </div>
      </form>
      <!-- <?php
            if (isset($_POST['btnedit'])) {
              echo ' <div align="center">
              <input type="submit" name="btnupdate" value="រក្សាទុកការកែប្រែ" class="btn btn-success">
        
            </div>';
            } else {
              echo ' <div align="center">
              <input type="submit" name="btnedit" value="កែប្រែ" class="btn btn-info">
 
            </div>';
            }
            ?> -->

    </div>

  </section>
  <!-- /.content -->

<!-- /.content-wrapper -->

<script>
  $('#datepicker').datepicker({
    autoclose: true
  });

  $("#datepicker").on('change', function(e) {

    var date = this.value;
    $.ajax({
      url: "../resources/inser_scors.php",
      method: "POST",
      data: {
        monthly: date
      },
      success: function(data) {
        // console.log(data);

        $('#orderlisttable').html(data);
        $('#orderlisttable').append(data.htmlresponse);

      }
    })
  })
</script>