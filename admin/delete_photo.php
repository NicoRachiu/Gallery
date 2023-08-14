<?php

include("init.php");

// Verifica se l'utente ha effettuato l'accesso
if (!$session->is_signed_in()) {
    redirect("login.php");
}

// Verifica se l'ID della foto è stato fornito
if (empty($_GET['id'])) {
    redirect('photos.php');
}

// Cerca la foto con l'ID specificato
$photo = Photos::find_all_users_by_id($_GET['id']);

// Se la foto esiste, eliminala e reindirizza l'utente alla pagina delle foto
if ($photo) {
    $photo->delete_photo();
    redirect("photos.php");
} else {
    // Altrimenti, reindirizza l'utente alla pagina delle foto
    redirect('photos.php');
}
