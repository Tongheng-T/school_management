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
                    <h3 class="box-title">Order List</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                <div class="box-body">
                    <div style="overflow-x:auto;">
                        <table id="orderlisttable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Invoice ID</th>
                                    <th>Customer Namme</th>
                                    <th>OrderDate</th>
                                    <th>Total</th>
                                    <th>Paid</th>
                                    <th>Due</th>
                                    <th>Payment Type</th>
                                    <th>Print</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php

                                ?>

                                <!-- <td>
                            <a href="deleteproduct.php?id=' . $row->pid . '" class="btn btn-danger" role="button"><span class="glyphicon glyphicon-trash" style="color:#ffffff" data-toggle="tooltip" title="Delete Product"></span></a>
                        </td> -->
                            </tbody>

                        </table>
                    </div>

                </div>
            <!-- </form> -->

        </div>

  </section>
  <!-- /.content -->

<!-- /.content-wrapper -->

