<?php

namespace Admin\Classes;

class Database
{
    public $connection;

    public function __construct()
    {
        $this->open_db_connection();
    }

    public function escape_string($string)
    {
        //$escaped_string = mysqli_real_escape_string($this->connection, $string);
        $escaped_string = $this->connection->real_escape_string($string);

        return $escaped_string;
    }

    public function open_db_connection()
    {
        //$this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PAS, DB_NAME);
        $this->connection = new \mysqli(DB_HOST, DB_USER, DB_PAS, DB_NAME);

        if ($this->connection->connect_errno) {
            die("failed" . $this->connection->connect_error);
        }
    }

    public function query($sql)
    {
        //$result = mysqli_query($this->connection, $sql);
        $result = $this->connection->query($sql);
        $this->confirm_query($result);

        return $result;
    }

    private function confirm_query($result)
    {
        if (!$result) {
            die("Query filed");
        }
    }
}

$database = new Database();
