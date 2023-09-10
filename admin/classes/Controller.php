<?php

namespace Admin\Classes;

class Controller
{
    public function index()
    {
       global $session, $twig;

        if (!$session->is_signed_in()) {
            redirect("login");
        }

        $photos = Photos::find_all();

        return $twig->render('index.html.twig', [
            'photos'  => $photos
        ]);
    }

    public function login()
    {
        global $twig, $session;

        $responseMessage = "";
        $username        = "";
        $password        = "";

        if (isset($_POST['submit'])) {

            $username   = trim($_POST['username']);
            $password   = trim($_POST['password']);
            $user_found = Users::verify_user($username, $password);

            if ($user_found) {
                $session->login($user_found);
                redirect('/');
            } else {
                $responseMessage = "Your password or username are incorrect";
            }
        }

        return $twig->render('login.html.twig', [
            'username'        => $username,
            'responseMessage' => $responseMessage,
            'password'        => $password
        ]);
    }
}

function ad_user()
{
    $session = new Session();
    if (!$session->is_signed_in()) {
        redirect("login");
    }
    $user = new Users;

    if (isset($_POST['update'])) {
        if ($user) {
            $user->first_name = $_POST['first_name'];
            $user->last_name = $_POST['last_name'];
            $user->username = $_POST['username'];
            $user->password = $_POST['password'];
            $user->user_image = $_POST['user_image'];
            $user->save();
            $user->update();
            exit;
        }
    }

    function admin_content()
    {
        $session = new Session();
        $photos = new Photos;
        $comments = new Comment;
        $template = new Template();
        $template::view(
            'Templates/admin_content.html',
            [
                'count' => $session->count,
                'number_photo' => $photos->number_photo(),
                'number_comments' => $comments->number_photo(),
            ]
        );
        exit;
    }

    function comment_photo()
    {
        if (empty($_GET['id'])) {
            redirect('photos');
        }
        $comments = Comment::find_the_comments($_GET['id']);
        $template = new Template();
    }

    function comments()
    {
        $session = new Session();
        if (!$session->is_signed_in()) {
            redirect("login");
        }
        $comments = Comment::find_all();
    }
    function delete_comment()
    {
        $session = new Session;
        if (!$session->is_signed_in()) {
            redirect("login");
        }
        if (empty($_GET['id'])) {
            redirect('users');
        }
        $comment = Comment::find_all_users_by_id($_GET['id']);
        if ($comment) {
            $comment->delete();
            redirect("comments");
        } else {
            // Altrimenti, reindirizza l'utente alla pagina dei commenti
            redirect('comments');
        }
    }
    function delete_photo()
    {
        $session = new Session();
        if (!$session->is_signed_in()) {
            redirect("login");
        }
        if (empty($_GET['id'])) {
            redirect('photos');
        }

        // Cerca la foto con l'ID specificato
        $photo = Photos::find_all_users_by_id($_GET['id']);

        // Se la foto esiste, eliminala e reindirizza l'utente alla pagina delle foto
        if ($photo) {
            $photo->delete_photo();
            redirect("photos");
        } else {
            // Altrimenti, reindirizza l'utente alla pagina delle foto
            redirect('photos');
        }
    }
    function delete_user()
    {
        $session = new Session();
        if (!$session->is_signed_in()) {
            redirect("login");
        }
        if (empty($_GET['id'])) {
            redirect('users');
        }

        $photo = Users::find_all_users_by_id($_GET['id']);

        if ($photo) {
            $photo->delete();
            redirect("users");
        } else {
            redirect('users');
        }
    }
    function edit_photo()
    {
        $session = new Session();
        if (!$session->is_signed_in()) {
            redirect("login.php");
        }
        if (isset($_POST['update'])) {
            echo "IT WORKS!!!";
        }

        if (empty($_GET['id'])) {
            redirect('photos.php');
            //echo 'ciao';
        } else {
            $photo = Photos::find_all_users_by_id($_GET['id']);

            if (isset($_POST['update'])) {

                if ($photo) {

                    $photo->title = $_POST['title'];
                    $photo->caption = $_POST['caption'];
                    $photo->alternative_text = $_POST['alternative_text'];
                    $photo->description = $_POST['description'];
                    $photo->save();
                    $photo->update();
                }
            }
        }
        $template = new Template();
        $template::view(
            'Templates/edit_photo.html',
            [
                'count' => $session->count,
                'number_photo' => $photo->title,
                'number_comments' => $photo->picture_path(),
                'caption' => $photo->caption,
                'alternative_text' => $photo->alternative_text,
                'description' => $photo->description,
                'title' => $photo->title,
                'id' => $photo->id,
            ]
        );
    }
    function edit_user()
    {
        $session = new Session();
        if (!$session->is_signed_in()) {
            redirect("login.php");
        }
        $user = Users::find_all_users_by_id($_GET['id']);

        if (isset($_POST['update'])) {
            if ($user) {

                $user->username = $_POST['username'];
                $user->first_name = $_POST['first_name'];
                $user->last_name = $_POST['last_name'];
                $user->password = $_POST['password'];

                if (!empty($_FILES['user_image'])) {
                    $user->set_file($_FILES['user_image']);
                    $user->save_user_and_image();
                }

                $user->update();
            }
        }
        $user = new Users;
        $template = new Template();
        $template::view(
            'Templates/edit_photo.html',
            [
                'image_placeholder' => $user->image_path_and_placeholder(),
                'user_name' => $user->username,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'password' => $user->password,
                'id' => $user->id
            ]
        );
    }
}
