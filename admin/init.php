<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
define('SITE_ROOT', 'xampp' . DS . 'htdocs' . DS . 'gallery' . DS . 'admin');

include("functions.php");
include("config.php");
include('autoload.php');

global $database, $session;

use Admin\Classes\Database;
use Admin\Classes\Session;

$database = new Database();
$session  = new Session();
