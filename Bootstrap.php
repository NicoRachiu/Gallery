<?php

define('DS', DIRECTORY_SEPARATOR);
define('SITE_ROOT', 'xampp' . DS . 'htdocs' . DS . 'gallery' . DS . 'admin');
define('ROOT_PATH', __DIR__);
define('BASE_URL', 'http://'.$_SERVER['HTTP_HOST']);

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/autoload.php';

include("functions.php");
include("config.php");

global $database, $session, $twig;

$database = new Admin\Classes\Database();
$session  = new Admin\Classes\Session();

$loader = new FilesystemLoader(ROOT_PATH.DS.'Templates');
$twig   = new Environment($loader, []);