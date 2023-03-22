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
            <div style="overflow-x:auto;font-family:tong;">
                <table id="student_name_listtable" class="table table-striped">
                    <thead>
                        <tr>
                            <?php get_name_bar();?>
                            <th>
                                <center><button type="button" name="add" class="btn btn-success btn-sm btnadd"> <span class="glyphicon glyphicon-plus"></span></button></center>
                            </th>
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

<script>
    //Date picker
    $('#datepicker').datepicker({
        autoclose: true
    });


    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
        checkboxClass: 'icheckbox_minimal-red',
        radioClass: 'iradio_minimal-red'
    });

    $(document).ready(function() {

        $(document).on('click', '.btnadd', function() {
            var html = '';
            html += '<tr>';
            html += '<td> <input type="hidden" class="form-control pname" name="productname[]" readonly></td>';

            html += '<td><input type="text" class="form-control" name="txtname[]" placeholder="Enter Name" required></td>';
            html += '<td><input type="date" class="form-control" name="txtdob[]" placeholder="Enter DOB" required></td>';
            html += '<td><input type="text" class="form-control" name="txtsex[]" placeholder="Enter Sex" required></td>';
            html += '<td><input type="text" class="form-control" name="txtphone[]" placeholder="Enter Phone" required></td>';

            html += '<td><center><button type="button" name="remove" class="btn btn-danger btn-sm btnremove"> <span class="glyphicon glyphicon-remove"></span></button></center></td>';
            $('#student_name_listtable').append(html);

            //Initialize Select2 Elements
            $('.productid').select2()
        })

        $(document).on('click', '.btnremove', function() {

            $(this).closest('tr').remove();
            calculate(0, 0);
            $("#txtpaid").val(0);
        })


        function calculate(dis, paid) {
            var subtotal = 0;
            var tax = 0;
            var discount = dis;
            var net_total = 0;
            var paid_amt = paid;
            var due = 0;

            $(".total").each(function() {
                subtotal = subtotal + ($(this).val() * 1);
            })

            tax = 0 * subtotal;
            net_total = tax + subtotal;
            net_total = net_total - discount;
            due = net_total - paid_amt;


            $("#txtsubtotal").val(subtotal.toFixed(2));
            $("#txttax").val(tax.toFixed(2));
            $("#txttotal").val(net_total.toFixed(2));
            $("#txtdiscount").val(discount);
            $("#txtdue").val(due.toFixed(2));

            $("#txtdiscount").keyup(function() {
                var discount = $(this).val();
                calculate(discount, 0);
            })
            $("#txtpaid").keyup(function() {
                var paid = $(this).val();
                var discount = $("#txtdiscount").val();
                calculate(discount, paid);
            })
        }


    });
</script>