<?php

spl_autoload_register(function ($class) {
    // /home/vioreleremia/Projects/Nicu/Gallery/admin/classes/Database.php
    $classFilePath = __DIR__ . DS . 'classes' . DS . $class . '.php';

    if (file_exists($classFilePath)) {
        require_once($classFilePath);
    }
});
