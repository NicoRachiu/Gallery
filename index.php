<?php
include('Admin/init.php');

use Admin\Classes\Controller;
use Admin\Classes\Router;

$router     = new Router();
$controller = new Controller();

// Index route
$router->addRoute('GET', '/', [$controller, 'index']);
$router->addRoute('GET', '/login', [$controller, 'login']);

$router->matchRoute();