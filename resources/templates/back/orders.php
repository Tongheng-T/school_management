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
    <!-- <form action="" method="post" name=""> -->
    <div class="box-header with-border">
      <h3 class="box-title">student List</h3>
      <?php display_message(); ?>
    </div>
    <!-- /.box-header -->
    <!-- form start -->

    <div class="box-body">
      <div style="overflow-x:auto;font-family:tong;">
        <table id="student_name_listtable" class="table table-striped">
          <thead>
            <tr>
              <?php get_name_bar(); ?>
              <th>Edit</th>
              <th>Delete</th>
              <th>
                <center><button type="button" name="add" class="btn btn-success btn-sm btnadd"> <span class="glyphicon glyphicon-plus"></span></button></center>
              </th>
            </tr>
          </thead>
          <tbody>

            <?php get_category_name(); ?>

          </tbody>
        </table>
      </div>

    </div>
    <!-- </form> -->

  </div>

</section>
<!-- /.content -->

<!-- /.content-wrapper -->

<script>
  $(".btnadd").on('click', function() {

    var date = this.value;
    $.ajax({
      url: "../resources/inser_scors.php",
      method: "POST",
      data: {
        monthly: date
      },
      success: function(data) {
        // console.log(data);

        $('#student_name_listtable').html(data);
        $('#student_name_listtable').append(data.htmlresponse);

      }
    })
  })
</script>