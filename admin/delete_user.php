<?php include("init.php"); ?>
<?php if (!$session->is_signed_in()) {
    redirect("login.php");
}  ?>
<!-- Navigation -->
<?php

if (empty($_GET['id'])) {
    redirect('users.php');
}

$photo = Admin\Classes\Users::find_all_users_by_id($_GET['id']);

if ($photo) {
    $photo->delete();
    redirect("users.php");
} else {
    redirect('users.php');
}
