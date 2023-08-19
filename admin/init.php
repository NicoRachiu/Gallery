<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
define('SITE_ROOT', 'xampp' . DS . 'htdocs' . DS . 'gallery' . DS . 'admin');

include("functions.php");
include("config.php");
include('autoload.php');

global $database, $session;

$database = new Database();
$session  = new Session();
