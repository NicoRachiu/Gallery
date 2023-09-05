<?php

namespace Admin\Classes;

class Controller
{
    public function index()
    {
        $session = new Session();

        if (!$session->is_signed_in()) {
            redirect("login");
        }

        exit;
    }

    public function login()
    {
        if (isset($_POST['submit'])) {

            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            //Method to check database user
            $user_found = Admin\Classes\Users::verify_user($username, $password);

            if ($user_found) {

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
                'colors' => ['red', 'blue', 'green']
            ]
        );

        exit;
    }
}