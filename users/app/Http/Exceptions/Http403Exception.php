<?php


namespace App\Http\Exceptions;

class Http403Exception extends AbstractHttpException {
    protected $code = 403;
    protected $message = 'Unauthorized';
}
