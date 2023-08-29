<<?php

    include("init.php");

    // Verifica se l'utente ha effettuato l'accesso
    if (!$session->is_signed_in()) {
        redirect("login.php");
    }

    // Verifica se l'ID del commento è stato fornito
    if (empty($_GET['id'])) {
        redirect('users.php');
    }

    // Cerca il commento con l'ID specificato
    $comment = Admin\Classes\Comment::find_all_users_by_id($_GET['id']);

    // Se il commento esiste, eliminalo e reindirizza l'utente alla pagina dei commenti
    if ($comment) {
        $comment->delete();
        redirect("comments.php");
    } else {
        // Altrimenti, reindirizza l'utente alla pagina dei commenti
        redirect('comments.php');
    }
