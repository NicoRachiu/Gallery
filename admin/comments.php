<?php

include("includes/header.php");

// Verifica se l'utente ha effettuato l'accesso
if (!$session->is_signed_in()) {
    redirect("login.php");
}

?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <?php include("includes/top_nav.php") ?>

    <!-- Top Menu Items -->
    <?php include("includes/side_nav.php") ?>
</nav>

<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Comment
                    <small>Subheading</small>
                </h1>

                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Author</th>
                                <th>Body</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $comments = comment::find_all(); ?>
                            <?php foreach ($comments as $comment) : ?>

                                <tr>
                                    <td><?php echo $comment->id; ?></td>
                                    <td><?php echo $comment->body; ?></td>
                                    <td><?php echo $comment->author; ?>
                                        <div class="actions_links">
                                            <a href="delete_comment.php?id=<?php echo $comment->id; ?>">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>