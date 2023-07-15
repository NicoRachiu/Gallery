<?php include("includes/init.php");
if (!$session->is_signed_in()) {
    redirect("login.php");
}  ?>
<!-- Navigation -->
<?php

if (empty($_GET['id'])) {
    redirect('users.php');
}

$comment = Comment::find_all_users_by_id($_GET['id']);

if ($comment) {
    $comment->delete();
    redirect("comments.php");
} else {
    redirect('comments.php');
}
