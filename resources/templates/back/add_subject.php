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
            <?php display_message(); ?>
        </div>
        <!-- /.box-header -->
        <!-- form start -->

        <div class="box-body">
            <form role="form" action="" method="post">

                <?php add_subject(); ?>





                <div class="col-md-8">

                    <table id="tablecategory" class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>CATEGORY</th>
                                <th>COLOR</th>
                                <th>EDIT</th>
                                <th>DELETE</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php get_category_sb(); ?>
                        </tbody>

                    </table>

                </div>




            </form>

        </div>
        <!-- </form> -->

    </div>

</section>
<!-- /.content -->

<!-- /.content-wrapper -->



<script>
    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    //Color chooser button
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function(e) {
        e.preventDefault()
        //Save color
        currColor = $(this).css('color')
        var txt = currColor;
        //Add color effect to button
        $('#add-new-event').css({
            'background-color': currColor,
            'border-color': currColor
        })
         document.getElementById("add-new-event").value = txt;
    })
    
    $('#add-new-event').click(function(e) {
        e.preventDefault()
        //Get value and make sure it is not null
        var val = $('#new-event').val()
        if (val.length == 0) {
            return
        }

        //Create events
        var event = $('<div />')
        event.css({
            'background-color': currColor,
            'border-color': currColor,
            'color': '#fff'
        }).addClass('external-event')
        event.html(val)
        $('#external-events').prepend(event)

        //Add draggable funtionality
        init_events(event)

        //Remove event from text input
        $('#new-event').val('')

    })
</script>