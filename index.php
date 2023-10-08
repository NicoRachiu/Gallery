<?php
include('Bootstrap.php');

use Admin\Classes\Controller;
use Admin\Classes\Router;

$router     = new Router();
$controller = new Controller();

// Index route
$router->addRoute('GET', '/', [$controller, 'index']);
$router->addRoute('POST', '/index', [$controller, 'index']);
$router->addRoute('GET', '/login', [$controller, 'login']);
$router->addRoute('POST', '/login', [$controller, 'login']);
$router->addRoute('POST', '/add_user', [$controller, 'add_user']);
$router->addRoute('GET', '/add_user', [$controller, 'add_user']);
$router->addRoute('GET', '/photo?id=81', [$controller, 'photo']);
$router->addRoute('POST', '/photo', [$controller, 'photo']);
$router->addRoute('GET', '/users', [$controller, 'users']);
$router->addRoute('POST', '/users', [$controller, 'users']);
$router->addRoute('GET', '/comments', [$controller, 'comments']);
$router->addRoute('POST', '/comments', [$controller, 'comments']);
$router->addRoute('GET', '/edit_photo', [$controller, 'edit_photo']);
$router->addRoute('POST', '/edit_photo', [$controller, 'edit_photo']);
$router->addRoute('GET', '/admin_content', [$controller, 'admin_content']);
$router->addRoute('POST', '/admin_content', [$controller, 'admin_content']);
$router->addRoute('GET', '/dashboard', [$controller, 'dashboard']);
$router->addRoute('POST', '/dashboard', [$controller, 'dashboard']);
$router->addRoute('GET', '/upload', [$controller, 'upload']);
$router->addRoute('POST', '/upload', [$controller, 'upload']);
$router->addRoute('GET', '/comment_photo', [$controller, 'comment_photo']);
$router->addRoute('POST', '/comment_photo', [$controller, 'comment_photo']);
$router->addRoute('GET', '/photos', [$controller, 'photos']);
$router->addRoute('POST', '/photos', [$controller, 'photos']);
echo $router->matchRoute();
