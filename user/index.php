<?php require_once("../resources/config.php");?>

<?php include(TEMPLATE_BACK ."/header.php") ;?>

<?php check_login_user();?>



<div id="page-wrapper">

    <div class="container-fluid">

        

        <?php 
        
        if($_SERVER['REQUEST_URI'] == "/pos/public/user/" || $_SERVER['REQUEST_URI'] == "/pos/public/user/itemt") {

            include(TEMPLATE_BACK ."/admin_content.php") ;

        }

        if(isset($_GET['orders'])){

            include(TEMPLATE_BACK ."/orders.php") ;
        }
        if(isset($_GET['ordersLit'])){

            include(TEMPLATE_BACK ."/orders_Lit.php") ;
        }

        if(isset($_GET['monthly_total'])){

            include(TEMPLATE_BACK ."/monthly_total.php") ;
        }

        if(isset($_GET['admin'])){

            include(TEMPLATE_BACK ."/admin.php") ;
        }

        if(isset($_GET['add_admin'])){

            include(TEMPLATE_BACK ."/add_admin.php") ;
        }

        if(isset($_GET['edit_admin'])){

            include(TEMPLATE_BACK ."/edit_admin.php") ;
        }

        if(isset($_GET['invoices'])){

            include(TEMPLATE_BACK ."/invoices.php") ;
        }

        if(isset($_GET['add_product'])){

            include(TEMPLATE_BACK ."/add_product.php") ;
        }
 
        
        ?>


    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<?php include(TEMPLATE_BACK ."/footer.php") ;?>