<?php include("header.php"); ?>
<?php if (!$session->is_signed_in()) {
    redirect("login.php");
} ?>
<!-- Navigation -->
<?php

$user = new Admin\Classes\Users;

if (isset($_POST['update'])) {
    if ($user) {
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];
        $user->username = $_POST['username'];
        $user->password = $_POST['password'];
        $user->user_image = $_POST['user_image'];
        $user->save();
        $user->update();
    }
}

?>
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
                    Photos
                    <small>Subheading</small>
                </h1>

                <form action="" method="post">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="">Avatar</label>
                                    <input type="file" name="user_image" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">First Name</label>
                                    <input type="text" name="first_name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="text" name="password" class="form-control">
                                </div>
                                <div class="info-box-update pull-right ">
                                    <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<?php include("includes/footer.php"); ?>