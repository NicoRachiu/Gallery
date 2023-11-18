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
        $method       = $_SERVER['REQUEST_METHOD'];
        $uriParts     = parse_url($_SERVER['REQUEST_URI']);
        $currentRoute = $uriParts['path'];
        if (isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $route => $target) {

                if ($route !== $currentRoute) {
                    continue;
                }

                if (isset($uriParts['query'])) {
                    parse_str($uriParts['query'], $queryVars);

                    return call_user_func_array($target, $queryVars);
                }

                return call_user_func($target);
            }
        }

        throw new Exception('Route not found');
    }
}
