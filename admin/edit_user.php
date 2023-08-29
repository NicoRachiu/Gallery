<?php include("header.php"); ?>
<?php if (!$session->is_signed_in()) {
    redirect("login.php");
}  ?>
<?php

use Admin\Classes\Users; ?>
<!-- Navigation -->
<?php
if (empty($_GET['id'])) {
    redirect('users.php');
    //echo 'ciao';

}
$user = Users::find_all_users_by_id($_GET['id']);

if (isset($_POST['update'])) {
    if ($user) {

        $user->username = $_POST['username'];
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];
        $user->password = $_POST['password'];

        if (!empty($_FILES['user_image'])) {
            $user->set_file($_FILES['user_image']);
            $user->save_user_and_image();
        }

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
                    Edit Photo
                    <small>Subheading</small>
                </h1>

                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <img src="<?php echo $user->image_path_and_placeholder(); ?>" width="400px">
                                </div>
                                <div class=" form-group"><input type="file" name="user_image" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control" value="<?php echo $user->username; ?>">

                                </div>

                                <div class="form-group">

                                    <label for="username">First Name</label>
                                    <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name; ?>">


                                    <div class="form-group"> <label for="last_name">Last Name</label>
                                        <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name ? $user->last_name : '' ?>">

                                        <div class="form-group">

                                            <label for="password">Password</label>
                                            <input class="form-control" name="password" value="<?php echo $user->password; ?>">

                                        </div>
                                        <?php include("includes/footer.php"); ?>
                                        <div class="info-box-update pull-right ">
                                            <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
                                        </div>
                                        <div class="info-box-delete pull-left">
                                            <a href="delete_users.php?id=<?php echo $user->id; ?>" class="btn btn-danger btn-lg ">Delete</a>
                                        </div>

                </form>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->