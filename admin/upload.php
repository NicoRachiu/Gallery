<?php include("header.php"); ?>

<?php if (!$session->is_signed_in()) {
    redirect("login.php");
}  ?>
<?php

if (isset($_POST['submit'])) {

    $photo = new Photos();

    $photo->title = $_POST['title'];
    $photo->set_file($_FILES['file_upload']);
}

?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->

    <?php include("top_nav.php") ?>

    <!-- Top Menu Items -->
    <?php include("side_nav.php") ?>
    <!-- /.navbar-collapse -->
</nav>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Uploads
                    <small>Subheading</small>
                </h1>
                <div class="col-md-6">

                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <div class="form-group"><input type="text" name="title" class="form-control"></div>

                        <div class="form-group"><input type="file" name="file_upload" class="form-control"></div>

                        <div class="form-group"><input type="submit" name="submit"></div>
                    </form>
                </div>
            </div>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<?php include("footer.php"); ?>