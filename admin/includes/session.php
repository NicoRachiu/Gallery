<?php

class Session
{


    public $user_id;
    public $message;
    public $count;
    public  $empty_message = "The message is empty";
    private $signed_in = false;
    public function __construct()
    {
        session_start();
        $this->check_the_login();
        $this->message(null);
        $this->check_message();
        $this->visitor_count();
    }

    public function is_signed_in()
    {
        return $this->signed_in;
    }

    public function login($user)
    {
        if ($user) {
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->signed_in = true;
        }
    }
    public function visitor_count()
    {
        if (isset($_SESSION['count'])) {

            return $this->count = $_SESSION['count']++;
        } else {
            echo "Session count doesn't exist!!!";
        }
    }


    public function logout()
    {
        unset($_SESSION['user_id'], $this->user_id);
        $this->signed_in = false;
    }


    public function message($msg)
    {

        if (!empty($msg)) {
            return $_SESSION['message'] = $msg;
        } else {
            echo $this->empty_message;
        }
    }

    private function check_the_login()
    {

        if (isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->signed_in = true;
        } else {
            unset($this->user_id);
            $this->signed_in = false;
        }
    }


    private function check_message()
    {

        if (isset($_SESSION['message'])) {

            $this->message = $_SESSION['message'];

            unset($_SESSION['message']);  //vedi alla fine il risultato;

        } else {

            $this->message = "";
        }
    }
}

$session = new Session();
