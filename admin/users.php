<?php include("header.php"); ?>
<?php if (!$session->is_signed_in()) {
    redirect("login.php");
}  ?>

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
                    USERS
                    <small>Subheading</small>
                </h1>
                <a href="ad_user.php" class="btn btn-primary">ADD USER</a>
                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Photo</th>
                                <th>Username</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $users = Admin\Classes\Users::find_all(); ?>
                            <?php foreach ($users as $user) :
                            ?>
                                <tr>
                                    <td><?php echo $user->id; ?></td>
                                    <td><img class="user-image" src="<?php echo $user->image_path_and_placeholder(); ?> ">

                                    </td>
                                    <td><?php echo $user->username; ?>
                                        <div class="actions_links">
                                            <a href="delete_user.php?id=<?php echo $user->id; ?>">Delete</a>
                                            <a href="edit_user.php?id=<?php echo $user->id; ?>">Edit</a>
                                        </div>
                                    </td>

                                    <td><?php echo $user->first_name; ?></td>
                                    <td><?php echo $user->last_name; ?></td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<?php include("footer.php"); ?>