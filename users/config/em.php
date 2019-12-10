<?php

use App\Http\Middleware\CorsHeaders;
use App\Http\Middleware\ResponseJson;
use Phalcon\Events\Manager;

$em = new Manager();

$em->attach('micro', new ResponseJson());
$app->after(new ResponseJson());

$em->attach('micro', new CorsHeaders());
$app->before(new CorsHeaders());

return $em;
