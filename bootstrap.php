<?php
function exception_error_handler($severity, $message, $file, $line) {
    throw new \ErrorException($message, 0, $severity, $file, $line);
}
set_error_handler("exception_error_handler",E_ALL);

$dir = realpath(dirname(__FILE__));
require_once $dir.'/vendor/autoload.php';