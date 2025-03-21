<?php

//me sirve para trabajar en mi proyecto mientra el que esta en vendor sirve para composer
require_once __DIR__ . '/../vendor/autoload.php';

spl_autoload_register(function(string $className) {

    $className = substr($className, 4);
    $classPath = __DIR__ . '/../classes/' . $className . '.php';

    if(file_exists($classPath)) {
        require_once $classPath;
    }
});
