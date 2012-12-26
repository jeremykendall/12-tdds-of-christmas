<?php

error_reporting(-1);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

date_default_timezone_set('America/Chicago');

set_include_path(implode(PATH_SEPARATOR, array(
    get_include_path(),
    realpath(__DIR__ . '/../library')
)));

define('PROJECT_ROOT_DIR', realpath(__DIR__ . '/..'));

function autoload($className)
{
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    require $fileName;
}

spl_autoload_register('autoload');

function d($expression)
{
    var_dump($expression);
}

function dd($expression)
{
    d($expression);
    die();
}
