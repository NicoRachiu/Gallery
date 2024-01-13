<?php
include('Bootstrap.php');

use Admin\Classes\Controller;
use Admin\Classes\Router;

$router     = new Router();
$controller = new Controller();

$router->addRoute('GET', '/', [$controller, 'index']);

$router->addRoute('GET', '/login', [$controller, 'login']);
$router->addRoute('POST', '/login', [$controller, 'login']);

$router->addRoute('GET', '/admin', [$controller, 'admin']);

$router->addRoute('GET', '/profile', [$controller, 'profile']);
$router->addRoute('POST', '/profile', [$controller, 'profile']);

$router->addRoute('GET', '/users', [$controller, 'users']);
$router->addRoute('POST', '/users', [$controller, 'users']);
$router->addRoute('GET', '/user-add', [$controller, 'addUser']);
$router->addRoute('POST', '/user-add', [$controller, 'addUser']);
$router->addRoute('GET', '/user-edit', [$controller, 'userEdit']);
$router->addRoute('POST', '/user-edit', [$controller, 'userEdit']);
$router->addRoute('GET', '/user-delete', [$controller, 'userDelete']);

$router->addRoute('GET', '/upload', [$controller, 'upload']);
$router->addRoute('POST', '/upload', [$controller, 'upload']);

$router->addRoute('GET', '/photos', [$controller, 'photos']);
$router->addRoute('POST', '/photos', [$controller, 'photos']);
$router->addRoute('GET', '/photo-edit', [$controller, 'photoEdit']);
$router->addRoute('POST', '/photo-edit', [$controller, 'photoEdit']);
$router->addRoute('GET', '/photo-delete', [$controller, 'photoDelete']);

$router->addRoute('GET', '/comments', [$controller, 'comments']);
$router->addRoute('POST', '/comments', [$controller, 'comments']);

$router->addRoute('GET', '/comment_photo', [$controller, 'comment_photo']);
$router->addRoute('POST', '/comment_photo', [$controller, 'comment_photo']);

$router->addRoute('GET', '/photo', [$controller, 'photo']);

$router->addRoute('GET', '/logout', [$controller, 'logout']);

echo $router->matchRoute();
