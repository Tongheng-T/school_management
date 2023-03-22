<?php require_once("resources/config.php"); ?>

<?php include(TEMPLATE_FRONT . DS . "header.php") ?>

<div class="top_center" align="center">


   <div class="center">
      <h1>សូមស្វាគមន៏</h1>
      <img src="resources/images/loog.png" height="200px" alt="">
      <?php display_message(); ?>
      <form action="" method="post">

         <div class="txt_field">
            <input type="text" name="username" placeholder="Username" required>

         </div>
         <div class="txt_field">
            <input type="password" name="password" placeholder="Password" required>

         </div>
         <input type="submit" style="font-family:Khmer OS Battambang;" name="submit" value="ចូលប្រើ">
      </form>


   </div>
   
<?php login_admin();?>
</div>


<div class="container">



   <!-- Footer -->
   <footer>
      <div class="row">
         <div class="col-lg-12">
            <p>Develop By: Tongheng-T</p>
         </div>
      </div>
   </footer>

</div>


</body>

</html>