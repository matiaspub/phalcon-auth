<?php

use Phalcon\Db\Adapter\Pdo\Factory as PdoFactory;

$di = new Phalcon\Di\FactoryDefault();

$di->setShared('config', $config);

$di->setShared('response', function () {
    $response = new Phalcon\Http\Response();
    $response->setContentType('application/json', 'utf-8');
    return $response;
});

$di->set('db', function () use ($config) {
    return PdoFactory::load($config->database);
});

return $di;
