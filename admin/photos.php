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
                    Photos
                    <small>Subheading</small>
                </h1>
                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Id</th>
                                <th>File</th>
                                <th>Title</th>
                                <th>size</th>
                                <th>Comments</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $photos = Admin\Classes\Photos::find_all(); ?>
                            <?php foreach ($photos as $photo) :
                            ?>
                                <tr>
                                    <td><img src="<?php echo $photo->picture_path(); ?> " width="150">
                                        <div class="action_links">
                                            <a href="delete_photo.php?id=<?php echo $photo->id; ?>">Delete</a>
                                            <a href="edit_photo.php?id=<?php echo $photo->id; ?>">Edit</a>
                                            <a href="../photo.php?id=<?php echo $photo->id; ?>">View</a>
                                        </div>
                                    </td>
                                    <td><?php echo $photo->id; ?></td>
                                    <td><?php echo $photo->filename; ?></td>
                                    <td><?php echo $photo->title; ?></td>
                                    <td><?php echo $photo->size; ?></td>
                                    <td>
                                        <?php

                                        $comments = Admin\Classes\Comment::find_the_comments($photo->id);
                                        echo count($comments);


                                        ?>
                                        <a href="comment_photo.php?id=<?php echo $photo->id ?>">Comments</a>
                                    </td>
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