<?php

error_reporting(-1);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

date_default_timezone_set('America/Chicago');

require_once __DIR__ . '/../vendor/autoload.php';

call_user_func(function() {
    $loader = new \Composer\Autoload\ClassLoader();
    $loader->add('Tdd\Test', __DIR__);
    $loader->register();
});

function d($expression)
{
    var_dump($expression);
}

function dd($expression)
{
    d($expression);
    die();
}
