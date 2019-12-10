<?php


namespace App\Http\Middleware;


use App\Http\Controllers\ControllerBase;
use App\Http\Exceptions\Http204Exception;
use Phalcon\Mvc\Micro;
use Phalcon\Mvc\Micro\MiddlewareInterface;

/**
 * ResponseMiddleware
 *
 * Manipulates the response
 */
class CorsHeaders implements MiddlewareInterface
{
    /**
     * Before anything happens
     *
     * @param Micro $app
     *
     * @return bool
     */
    public function call(Micro $app)
    {
        $origin = $app->request->hasHeader("ORIGIN") ? $app->request->getHeader("ORIGIN") : '*';

        $app->response->setHeader("Access-Control-Allow-Origin", $origin)
            ->setHeader("Access-Control-Allow-Methods", 'GET,PUT,POST,DELETE,OPTIONS')
            ->setHeader("Access-Control-Allow-Headers", 'Origin, X-Requested-With, Content-Range, Content-Disposition, Content-Type, Authorization')
            ->setHeader("Access-Control-Allow-Credentials", true);

        $app->response->sendHeaders();

        return true;
    }
}
