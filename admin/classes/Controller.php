<?php

namespace Admin\Classes;

class Controller
{
    public function index(): string
    {
        global $session, $twig;

        if (!$session->is_signed_in()) {
            redirect('login');
        }

        $photos = Photos::find_all();

        return $twig->render('Frontend/index.html.twig', [
            'photos'  => $photos
        ]);
    }

    public function admin(): string
    {
        global $twig, $session;

        $photos         = new Photos;
        $users          = new Users;
        $user           = Users::find_all();
        $comments       = new Comment;
        $comments_array = $comments->find_all();
        $comment = array_slice($comments_array, -3, 3);
        $username = $users->find_all_users_by_id($session->user_id);
        return $twig->render('admin/index.html.twig', [
            'count'          => $session->count,
            'number_photo' => $photos->number_photo(),
            'number_users' => $users->number_photo(),
            'number_comments' => $comments->number_photo(),
            'comments' => $comment,
            'route' => 'admin',
            'username' => $username->first_name . ' ' . $username->last_name,
        ]);
    }

    public function users(): string
    {
        global $twig;

        return $twig->render('Admin/users.html.twig', [
            'route' => 'users',
        ]);
    }

    public function addUser(): string
    {
        global $twig, $session;
        if (!$session->is_signed_in()) {
            redirect("login");
        }
        $user = new Users;

        if (isset($_POST['update'])) {
            $user->first_name = $_POST['first_name'];
            $user->last_name = $_POST['last_name'];
            $user->username = $_POST['username'];
            $user->password = $_POST['password'];
            $user->user_image = $_POST['user_image'];
            $user->save();
            $user->update();
        }
        return $twig->render('Admin/user-add.html.twig', []);
    }

    public function userEdit(...$args): string
    {
        global $twig, $session;

        if (!$session->is_signed_in()) {
            redirect('login');
        }

        $user = Users::find_all_users_by_id($args['id']);

        if (!$user) {
            redirect('users');
        }

        if (isset($_POST['update'])) {

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

        return $twig->render('Admin/user-edit.html.twig', ['user' => $user]);
    }

    public function userDelete(...$args): void
    {
        global $session;

        if (!$session->is_signed_in()) {
            redirect('login');
        }

        if (empty($args['id'])) {
            redirect('users');
        }

        $user = Users::find_all_users_by_id($args['id']);

        if ($user) {
            $user->delete();
        }

        redirect('users');
    }

    public function upload(): string
    {
        global $twig, $session;

        if (!$session->is_signed_in()) {
            redirect('login');
        }

        if (isset($_POST['submit'])) {

            $photo = new Photos();

            $photo->title = $_POST['title'];
            $photo->set_file($_FILES['file_upload']);
        }

        return $twig->render('Admin/upload.html.twig', [
            'route' => 'upload',
        ]);
    }

    public function photos(...$args): string
    {
        global $session, $twig;

        if (!$session->is_signed_in()) {
            redirect('login');
        }

        return $twig->render('Admin/photos.html.twig', ['photos' => Photos::find_all(), 'route' => 'photos',]);
    }

    public function photoEdit(...$args): string
    {
        global $twig, $session;

        if (!$session->is_signed_in()) {
            redirect("login.php");
        }

        if (empty($_GET['id'])) {
            redirect('photos');
        }

        $photo = Photos::find_all_users_by_id($_GET['id']);

        if (isset($_POST['update']) && $photo) {
            $photo->title = $_POST['title'];
            $photo->caption = $_POST['caption'];
            $photo->alternative_text = $_POST['alternative_text'];
            $photo->description = $_POST['description'];
            $photo->save();
            $photo->update();
        }

        return $twig->render('Admin/photo-edit.html.twig', ['photo' => $photo]);
    }

    public function photoDelete(): void
    {
        global $session;

        if (!$session->is_signed_in()) {
            redirect('login');
        }

        if (empty($_GET['id'])) {
            redirect('photos');
        }

        $photo = Photos::find_all_users_by_id($_GET['id']);

        if ($photo) {
            $photo->delete_photo();
        }

        redirect('photos');
    }

    public function comments(): string
    {
        global $session, $twig;

        if (!$session->is_signed_in()) {
            redirect('login');
        }

        return $twig->render('Admin/comments.html.twig', ['comments' => Comment::find_all(), 'route' => 'comments',]);
    }

    public function comment_photo(...$args): string
    {
        global $twig, $session;

        if (empty($args['id'])) {
            redirect("index.php");
        }
        if (empty($_GET['id'])) {
            redirect('photos');
        }

        $comments = Comment::find_the_comments($_GET['id']);

        return $twig->render('Admin/photos.html.twig', []);
    }

    public function commentDelete(): void
    {
        global $session;

        if (!$session->is_signed_in()) {
            redirect('login');
        }

        if (empty($_GET['id'])) {
            redirect('comments');
        }

        $comment = Comment::find_all_users_by_id($_GET['id']);

        if ($comment) {
            $comment->delete();
        }

        redirect('comments');
    }

    public function login(): string
    {
        global $session, $twig;

        if ($session->is_signed_in()) {
            redirect('admin');
        }

        $the_message = '';
        $username    = '';
        $password    = '';

        if (isset($_POST['submit'])) {

            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            //Method to check database user
            $user_found = Users::verify_user($username, $password);

            if ($user_found) {

                $session->login($user_found);

                redirect('admin');
            } else {
                $the_message = "Your password or username are incorrect";
            }
        }

        return $twig->render('Frontend/login.html.twig', [
            'message'  => $the_message,
            'username' => htmlentities($username),
            'password' => htmlentities($password),
        ]);
    }

    public function photo(...$args): string
    {
        global $twig;

        if (empty($args['id'])) {
            redirect('/');
        }

        $photo = Photos::find_all_users_by_id($args['id']);

        if (isset($_POST['submit'])) {
            $author      = trim($_POST['author']);
            $body        = trim($_POST['body']);
            $new_comment = Comment::create_comment($photo->id, $author, $body);

            if ($new_comment && $new_comment->save() && $new_comment->update()) {
                //$new_comment->update();
                redirect("photo?id={$photo->id}");
            } else {
                $message = "something it's wrong at line photo.php:20";
            }
        }

        return $twig->render('photo.html.twig', [
            'picture_path' => $photo->picture_path(),
            'caption'      => $photo->caption,
            'comments'     => Comment::find_the_comments($photo->id),
        ]);
    }

    public function logout(): void
    {
        global $session;

        $session->logout();

        redirect('login');
    }
}
