<?php

use Phalcon\Loader;

/**
 * @var \Phalcon\Config $config
 */

$loader = new Loader();

$dir = dirname(__DIR__);

$loader->registerNamespaces([
    'App\Http\Middleware' => $dir . DS . $config->application->middlewareDir,
    'App\Http\Exceptions' => $dir . DS . $config->application->exceptionsDir,
    'App\Repositories' => $dir . DS . $config->application->repositoriesDir,
    'App\Models' => $dir . DS . $config->application->modelsDir,
    'App\Http\Controllers' => $dir . DS . $config->application->controllersDir,
]);

$loader->register();
