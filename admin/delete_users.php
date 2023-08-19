<?php include("init.php");
if (!$session->is_signed_in()) {
    redirect("login.php");
}  ?>
<!-- Navigation -->
<?php

if (empty($_GET['id'])) {
    redirect('users.php');
}

$users = Users::find_all_users_by_id($_GET['id']);

if ($users) {
    $users->delete();
    redirect("users.php");
} else {
    redirect('users.php');
}
