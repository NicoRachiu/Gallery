<?php

spl_autoload_register(function ($class) {

    $class = str_replace('\\', '/', $class);
    $classFilePath = ROOT_PATH.DS.$class.'.php';

    if (file_exists($classFilePath)) { // usa il backslash per il namespace globale
        require_once($classFilePath); // usa il backslash per il namespace globale
    }
});