<?php

// require_once dirname(__DIR__) . '/vendor/autoload.php';

spl_autoload_register(function($classname) {
    $path = 'classes/';
    $extension = '.class.php';
    $fullPath = $path . $classname . $extension;

    if (!file_exists($fullPath)) return false;

    require_once $fullPath;
});


