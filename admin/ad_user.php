<?php include("includes/header.php"); ?>
<?php if (!$session->is_signed_in()) {
    redirect("login.php");
}  ?>
<!-- Navigation -->
<?php

$user = new Users;

if (isset($_POST['update'])) {
    if ($user) {


        $user->username = $_POST['username'];
        $user->last_name = $_POST['last_name'];
        $user->password = $_POST['password'];
        $user->user_image = $_POST['user_image'];
        $user->save();
        $user->update();
    }
}

?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->


    <?php include("includes/top_nav.php") ?>


    <!-- Top Menu Items -->
    <?php include("includes/side_nav.php") ?>
    <!-- /.navbar-collapse -->
</nav>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Photos
                    <small>Subheading</small>
                </h1>

                <form action="" method="post">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-md-8">
                                <div class="form-group"><input type="file" name="user_image" class="form-control"></div>
                                <div class="form-group">

                                    <input type="text" name="title" class="form-control">

                                </div>



                                <div class="form-group">

                                    <label for="username">Username</label> <input type="text" name="username" class="form-control">



                                    <div class="form-group"> <label for="last_name">Last Name</label> <input type="text" name="last_name" class="form-control">

                                        <div class="form-group">

                                            <label for="password">Password</label> <textarea class="form-control" name="password"></textarea>

                                        </div>
                                        <?php include("includes/footer.php"); ?>
                                        <div class="info-box-update pull-right ">
                                            <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
                                        </div>

                </form>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->