<?php require_once("../Templates/header.html.twig"); ?>

<?php
$session->logout();
redirect("login.php");
?>
