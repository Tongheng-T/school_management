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

<section class="content container-fluid">

    <!--------------------------
        | Your Page Content Here |
        -------------------------->
<?php 
if (isset($_GET['date'])) {
    $date = $_GET['date'];
    $show = date('m', strtotime($date));
    $showw = convert_month_kh($show);
}
?>

    <div class="box box-warning">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="box-header with-border">
                <div class="col-md-3">
                    <br>
                    <h3 class="box-title" style="font-family:tong;">កែប្រែពន្ទុប្រចាំខែ <?php echo $showw ;?></h3>
                </div>

            </div>

            <!-- /.box-header -->
            <!-- form start -->

            <div class="box-body">
                <div style="overflow-x:auto;font-family:tong;">
                    <?php

                    if (isset($_GET['date'])) {

                        $date = $_GET['date'];
                        $monthly = date('Y-m', strtotime($date));
                        $query = query("SELECT * FROM category_name");
                        confirm($query);
                        $query2 = query("SELECT * FROM student_name");
                        confirm($query2);
                        $query_sb = query("SELECT * FROM tbl_category_sb");
                        confirm($query_sb);


                        $result = '';
                        $result .= '
                              <table class="table table-striped">
                              <thead>
                              <tr> ';
                        while ($row = fetch_array($query)) {
                            $result .= '
                           <th>' . $row['txt'] . '</th>

                          ';
                        }
                        while ($row = fetch_array($query_sb)) {

                            $result .= '
                            <th>' . $row['sb_name'] . '</th>

                               ';
                        }
                        $result .= '
                            </tr>
                            </thead>
                            <tbody>

                         ';
                        while ($row = fetch_array($query2)) {
                            $sdid = $row['student_id'];

                            $result .= '
    
                                    <tr>
                                    <td> ' . $row['student_id'] . '</td>
                                    <td>' . $row['student_name'] . '</td>
                                    <td> ' . $row['dob'] . '</td>
                                    <td> ' . $row['sex'] . '</td>
                                    <td> ' . $row['phone'] . '</td>

                                    ';

                            $tbl_score = query("SELECT * FROM tbl_monthly_score WHERE student_id= '$sdid' and monthly= '$monthly' ");
                            confirm($tbl_score);
                            while ($row = fetch_array($tbl_score)) {
                                $sdidd = $row['score'];
                                $student_id = $row['student_id'];

                                $result .= '
                                <input type="hidden" class="form-control pname" name="student_id[]" value="' . $student_id . '" >
                                <input type="hidden" class="form-control pname" name="date" value="' . $monthly . '" >
                                <input type="hidden" class="form-control stock"name="sb_id[]" value="' . $row["sb_id"] . '">
                                <td><input type="text" class="form-control stock"  style="width: 50px ;" name="score[]" value="' . $row["score"] . '"></td> 

                                ';
                            }
                        }

                        $result .= '
                        </tr>
                        </tbody>
                        </table>
                        <hr>
                        <div align="center">
                        <input type="submit" name="btnupdate" value="រក្សាទុកការកែប្រែ" class="btn btn-success">
                        </div>
                        <hr>
                        ';


                        echo $result;
                    }
                    updatescore();
                    ?>
                </div>

            </div>
        </form>

    </div>

</section>