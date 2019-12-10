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
class ResponseJson implements MiddlewareInterface
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
        $return = $app->getReturnedValue();

        if (!empty($return)) {
            $app->response->setJsonContent($return);
        } else {
            throw new Http204Exception(
                'NoContent',
                ControllerBase::ERROR_NO_CONTENT
            );
        }

        $app->response->send();
        return true;
    }
}
