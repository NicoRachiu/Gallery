<?php include("header.php"); ?>
<?php
if (!$session->is_signed_in()) {
    redirect("login.php");
}  ?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->

    <?php include("top_nav.php"); ?>

    <!-- Top Menu Items -->
    <?php include("side_nav.php"); ?>
    <!-- /.navbar-collapse -->
</nav>

<div id="page-wrapper">
    <?php include("admin_content.php");
    ?>
</div>
<!-- /#page-wrapper -->
<?php
$template = new Template();
$template::view(
    'about.html',
    [
        'title' => 'Home Page',
        'colors' => ['red', 'blue', 'green']
    ]
);
?>
<?php include("footer.php"); ?>