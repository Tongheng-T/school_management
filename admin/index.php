<?php require_once("../resources/config.php");?>

<?php include(TEMPLATE_BACK ."/header.php") ;?>

<?php check_login();?>


<div class="content-wrapper">
        

        <?php 
        
        if($_SERVER['REQUEST_URI'] == "/ss/admin/" || $_SERVER['REQUEST_URI'] == "/ss/admin/itemt") {

            include(TEMPLATE_BACK ."/blank.php") ;

        }

        if(isset($_GET['itemt'])){

            include(TEMPLATE_BACK ."/admin_content.php") ;
        }
        if(isset($_GET['orders'])){

            include(TEMPLATE_BACK ."/orders.php") ;
        }

        if(isset($_GET['addsubject'])){

            include(TEMPLATE_BACK ."/add_subject.php") ;
        }

        if(isset($_GET['sbname'])){

            include(TEMPLATE_BACK ."/name_sb.php") ;
        }

        if(isset($_GET['addscore'])){

            include(TEMPLATE_BACK ."/add_score.php") ;
        }

        if(isset($_GET['editscore'])){

            include(TEMPLATE_BACK ."/edit_score.php") ;
        }

        if(isset($_GET['addname'])){

            include(TEMPLATE_BACK ."/add_name.php") ;
        }

        if(isset($_GET['add_product'])){

            include(TEMPLATE_BACK ."/add_product.php") ;
        }
        
        if(isset($_GET['owe_money'])){

            include(TEMPLATE_BACK ."/owe_money.php") ;
        }
        if(isset($_GET['owe_money_all'])){

            include(TEMPLATE_BACK ."/owe_money_all.php") ;
        }

        if(isset($_GET['products'])){

            include(TEMPLATE_BACK ."/Products.php") ;
        }
        if(isset($_GET['edit_product'])){

            include(TEMPLATE_BACK ."/edit_product.php") ;
        }
        
        if(isset($_GET['delete_product'])){

            include(TEMPLATE_BACK ."/delete_product.php") ;
        }
        if(isset($_GET['delete_reports'])){

            include(TEMPLATE_BACK ."/delete_reports.php") ;
        }
        if(isset($_GET['reports'])){

            include(TEMPLATE_BACK ."/reports.php") ;
        }
        if (isset($_GET['page'])) {

            include(TEMPLATE_BACK . "/reports.php");
        }
        if (isset($_GET['staff'])) {

            include(TEMPLATE_BACK . "/staff.php");
        }
        if (isset($_GET['edit_staff'])) {

            include(TEMPLATE_BACK . "/edit_staff.php");
        }
        if (isset($_GET['total_monthly'])) {

            include(TEMPLATE_BACK . "/total_monthly.php");
        }
        if (isset($_GET['invoices_owe_money'])) {

            include(TEMPLATE_BACK . "/invoices_owe_money.php");
        }
        if (isset($_GET['tak'])) {

            include(TEMPLATE_BACK . "/tak.php");
        }
        if (isset($_GET['month'])) {

            include(TEMPLATE_BACK . "/month.php");
        }
        if (isset($_GET['total_mm'])) {

            include(TEMPLATE_BACK. "/total_mm.php");
        }

        if (isset($_GET['name_seller'])) {

            include(TEMPLATE_BACK. "/name_seller.php");
        }
        ?>



</div>


<!-- /#page-wrapper -->
<?php include(TEMPLATE_BACK ."/footer.php") ;?>

