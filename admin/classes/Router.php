<?php

namespace Admin\Classes;

use Closure;
use Exception;

class Router
{
    protected $routes = []; // stores routes

    public function addRoute(string $method, string $url, array $target)
    {
        $this->routes[$method][$url] = $target;
    }

    public function matchRoute()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $url = $_SERVER['REQUEST_URI'];

        if (isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $routeUrl => $target) {
                // Simple string comparison to see if the route URL matches the requested URL
                if ($routeUrl === $url) {
                    return call_user_func($target);
                }
            }
        }

        throw new Exception('Route not found');
    }
}
