<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

spl_autoload_register(function($classname) {
    $paths = ['classes/', 'model/'];
    $extension = '.class.php';

    foreach ($paths as $path) {
        $fullPath = $path . $classname . $extension;
        
        if (file_exists($fullPath)) {
            require_once $fullPath;
            return;   
        }
    }

    return false;
});


