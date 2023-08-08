<?php include("admin/includes/header.php"); ?>
<?php include("admin/classes/Photos.php"); ?>
<?php $photos = Photos::find_all(); ?>
<div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-12">
        <div class="thumbnails row">
            <?php foreach ($photos as $photo) : ?>

                <div class="col-xs-6 col-md-3">
                    <a class="thumbnail" href="photo.php?id=<?php echo $photo->id; ?>">
                        <img src="admin/<?php echo $photo->picture_path(); ?>" alt="">
                        </img>
                    </a>

                </div>



            <?php endforeach; ?>
        </div>

    </div>




    <!-- Blog Sidebar Widgets Column -->
    <div class="col-md-4">
        <?php include("includes/sidebar.php"); ?>
    </div>
    <!-- /.row -->
    <?php include("includes/footer.php"); ?>