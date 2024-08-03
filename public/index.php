<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
(require_once __DIR__.'/../bootstrap/app.php')
    ->handleRequest(Request::capture());

function p($v){
    echo "<pre>\n\n==============\n\n".print_r($v,1)."\n\n==============\n\n</pre>";
}
function pe($v){
    die("<pre>\n\n==============\n\n".print_r($v,1)."\n\n==============\n\n</pre>");
}
