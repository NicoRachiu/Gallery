<?php

namespace Admin\Classes; // aggiungi la dichiarazione del namespace

spl_autoload_register(function ($class) {
    $class = str_replace('Admin\Classes\\', '', $class);
    $classFilePath = __DIR__ . DS . 'Classes' . DS . $class . '.php';

    if (\file_exists($classFilePath)) { // usa il backslash per il namespace globale
        require_once($classFilePath); // usa il backslash per il namespace globale
    }
});
