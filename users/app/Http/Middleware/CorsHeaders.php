<?php


namespace App\Http\Middleware;


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
        $allowedOrigins = $app->config->cors->allowedOrigins->toArray();
        $origin = $app->request->getHeader('Origin');

        if (in_array($origin, $allowedOrigins)) {
            $app->response->setHeader("Access-Control-Allow-Origin", $origin);
        }
        $app->response
            ->setHeader("Access-Control-Allow-Methods", 'GET,PUT,POST,DELETE,OPTIONS')
            ->setHeader("Access-Control-Allow-Headers", 'X-Requested-With, Content-Type, Authorization')
            ->setHeader("Access-Control-Allow-Credentials", true);

        $app->response->sendHeaders();

        return true;
    }
}
