<?php

namespace App;

class ErrorHandler {
    public function __construct() {
        set_error_handler([$this, 'customErrorHandler']);
    }

    public function customErrorHandler($errno, $errstr, $errfile, $errline) {
        error_reporting(E_ALL);
        ini_set("display_errors", 1);

        $backtrace = debug_backtrace();

        $function = isset($backtrace[1]['function']) ? $backtrace[1]['function'] : 'N/A';
        $class = isset($backtrace[1]['class']) ? $backtrace[1]['class'] : 'N/A';

        $message = "Error: [$errno] $errstr - $errfile:$errline (function: $function, class: $class)";

        $rootPath = dirname(__DIR__, 2);

        error_log($message . PHP_EOL, 3, $rootPath . "/error_logs.txt");
    }
}