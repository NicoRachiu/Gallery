<?php include("includes/header.php"); //include("init.php") 
?>

<?php if (!$session->is_signed_in()) {
    redirect("login.php");
}  ?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->


    <?php include("includes/top_nav.php"); ?>


    <!-- Top Menu Items -->
    <?php include("includes/side_nav.php"); ?>
    <!-- /.navbar-collapse -->
</nav>

<div id="page-wrapper">
    <?php include("includes/admin_content.php");
    ?>
</div>
<!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>