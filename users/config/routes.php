<?php

use App\Http\Controllers\ControllerBase;
use App\Http\Controllers\UserController;
use App\Http\Exceptions\Http404Exception;
use Phalcon\Mvc\Micro\Collection;

$users = new Collection();
$users->setHandler(UserController::class, true);
$users->setPrefix('/user');
$users->get('', 'list');
$users->get('/login', 'login');
$app->mount($users);


// Main url
$app->get('/', function () {
    return ['code' => 200, 'status' => 'success'];
});

// not found URLs
$app->notFound(
    function () use ($app) {
        $exception =
            new Http404Exception(
                'URI not found or error in request.',
                ControllerBase::ERROR_NOT_FOUND,
                new \Exception('URI not found: ' . $app->request->getMethod() . ' ' . $app->request->getURI())
            );
        throw $exception;
    }
);
