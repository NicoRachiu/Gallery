<?php
include('Bootstrap.php');

use Admin\Classes\Controller;
use Admin\Classes\Router;

$router     = new Router();
$controller = new Controller();

// Index route
$router->addRoute('GET', '/', [$controller, 'index']);
$router->addRoute('GET', '/login', [$controller, 'login']);
$router->addRoute('POST', '/login', [$controller, 'login']);
$router->addRoute('POST', '/ad_user', [$controller, 'ad_user']);
$router->addRoute('GET', '/ad_user', [$controller, 'ad_user']);
echo $router->matchRoute();
