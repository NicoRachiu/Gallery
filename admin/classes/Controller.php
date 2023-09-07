<?php

namespace Admin\Classes;

class Controller
{
    public function index()
    {
        include("Admin/header.php");
        include("includes/sidebar.php");
        include("includes/footer.php");

        $session = new Session();

        if (!$session->is_signed_in()) {
            redirect("login");
        }

        $photos = Photos::find_all();
        foreach ($photos as $photo) {
        }

        $template = new Template();
        $template::view(
            'Templates/login.html',
            [
                'Photo_id' => $photo->picture_path(),
                'colors' => ['red', 'blue', 'green'],
            ]
        );

        exit;
    }

    public function login()
    {
        if (isset($_POST['submit'])) {

            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            //Method to check database user
            $user_found = Users::verify_user($username, $password);

            if ($user_found) {
                $session = new Session();
                $session->login($user_found);
                redirect("index.php");
            } else {

                $the_message = "Your password or username are incorrect";
            }
        } else {
            $the_message = "";
            $username = "";
            $password = "";
        }

        $template = new Template();
        $template::view(
            'Templates/login.html',
            [
                'username' => $username,
                'colors' => ['red', 'blue', 'green'],
                'new_messgae' => $the_message,

            ]
        );

        exit;
    }
}
