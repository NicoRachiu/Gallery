<?php

function autoload($class)
{
    $the_path = __DIR__ . DS . "{$class}.php";

    if (file_exists($the_path)) {
        require_once($the_path);
    }
}

spl_autoload_register('autoload');

function redirect($location)
{
    header("Location: {$location}");
}
