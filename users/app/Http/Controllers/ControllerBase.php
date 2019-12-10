<?php


namespace App\Http\Controllers;


use Phalcon\Di\Injectable;

abstract class ControllerBase extends Injectable
{
    const ERROR_NOT_FOUND = 404;

    const ERROR_INVALID_REQUEST = 400;

    const ERROR_NO_CONTENT = 204;
}
