<?php

use App\Http\Exceptions\AbstractHttpException;
use Phalcon\{Config\Adapter\Ini as Config, Http\Request\Exception as PhalconHttpException, Mvc\Micro};

define('DS', DIRECTORY_SEPARATOR);

try {
    /** @var Config $config */
    $config = new Config('../config.ini');

    require '../config/loader.php';

    /** @var Phalcon\Di\FactoryDefault $di */
    $di = require '../config/di.php';

    /** @var \Phalcon\Db\Adapter\Pdo\Sqlite $db */
    $db = $di->get('db');

    $app = new Micro($di);

    $em = require '../config/em.php';
    $app->setEventsManager($em);

    require '../config/routes.php';

    $app->handle();
} catch (AbstractHttpException $e) {
    $response = $app->response;
    $response->setStatusCode($e->getCode(), $e->getMessage());
    $response->setJsonContent([
        'code' => $e->getCode(),
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
    $response->send();
} catch (PhalconHttpException $e) {
    $app->response->setStatusCode(400, 'Bad request')
        ->setJsonContent([
            AbstractHttpException::KEY_CODE    => 400,
            AbstractHttpException::KEY_MESSAGE => 'Bad request'
        ])
        ->send();
} catch (Exception $e) {
    $response = new \Phalcon\Http\Response();
    $response->setStatusCode(500, 'Internal Server Error')
        ->setJsonContent([
            AbstractHttpException::KEY_CODE    => $e->getCode(),
            AbstractHttpException::KEY_MESSAGE => $e->getMessage(),
            AbstractHttpException::KEY_TRACE => $e->getTraceAsString(),
        ])
        ->send();
}
