<?php

// if ($_SESSION['useremail'] == "" or $_SESSION['role'] == "User") {
//   header('location:index.php');
// }

?>
<?php display_message();?>
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
    <?php add_score_made(); ?>
    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
        | Your Page Content Here |
        -------------------------->


        <div class="box box-warning">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="box-header with-border">
                    <div class="col-md-3">
                        <br>
                        <h3 class="box-title" style="font-family:tong;">បញ្ចូលពន្ទុប្រចាំខែ</h3>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label style="font-family:tong;">ខែ: </label>
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
                    <div style="overflow-x:auto;font-family:tong;">
                        <table id="orderlisttable" class="table table-striped">
                            <?php show_score(); ?>

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
                <hr>
                <div align="center">
                    <input type="submit" name="btnsave" value="Save Order" class="btn btn-info">

                </div>
                <hr>
            </form>

        </div>

    </section>
    <!-- /.content -->

<!-- /.content-wrapper -->


<script>
    $('#datepicker').datepicker({
        autoclose: true
    });
</script>