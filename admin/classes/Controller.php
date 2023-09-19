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


    function ad_user()
    {
        global $twig, $session;
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
                return $twig->render('ad_user.html.twig', []);
            }
        }
    }

    function admin_content()
    {
        global $twig, $session;
        $session = new Session();
        $photos = new Photos;
        $comments = new Comment;
        return $twig->render('admin_content.html.twig', []);
    }

    function comment_photo()
    {
        global $twig, $session;
        if (empty($_GET['id'])) {
            redirect('photos');
        }
        $comments = Comment::find_the_comments($_GET['id']);
        return $twig->render('comment_photo.html.twig', []);
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
        global $twig;
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
        global $twig;
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
        return $twig->render('edit_photo.html.twig', []);
    }
}
function edit_user()
{
    global $twig;
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
    return $twig->render('edit_user.html.twig', []);
}
function header()
{
    ob_start();
}
function dashboard()
{
    global $session;
    if (!$session->is_signed_in()) {
        redirect("login");
    }
    function footer()
    {
        global $twig, $session;
        $user = new Users;
        $photo = new Photos;
        $comment = new Comment;
        return $twig->render('footer.html.twig', [
            'count' => $session->count,
            'user' => $user->number_photo(),
            'photo' => $photo->number_photo(),
            'comment' => $comment->number_photo(),
        ]);
    }
    function login()
    {
        global $session, $twig;
        if ($session->is_signed_in()) {
            redirect("index.php");
        }

        if (isset($_POST['submit'])) {

            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            //Method to check database user
            $user_found = Users::verify_user($username, $password);

            if ($user_found) {

                $session->login($user_found);
                redirect("index");
            } else {

                $the_message = "Your password or username are incorrect";
            }
        } else {
            $the_message = "";
            $username = "";
            $password = "";
        }
        return $twig->render('login.html.twig', [
            'message' => $the_message,
            'username' => htmlentities($username),
            'password' => htmlentities($password),
        ]);
    }
    function photos()
    {
        global $session, $twig;
        if (!$session->is_signed_in()) {
            redirect("login.php");
        }
        $photos = Photos::find_all();
    }
    function upload()
    {
        global $session;
        if (!$session->is_signed_in()) {
            redirect("login.php");
        }
        if (isset($_POST['submit'])) {

            $photo = new Photos();

            $photo->title = $_POST['title'];
            $photo->set_file($_FILES['file_upload']);
        }
    }
    function users()
    {
        $users = Users::find_all();
    }
}
