<?php


namespace App\Http\Exceptions;


abstract class AbstractHttpException extends \RuntimeException {
    const KEY_CODE = 'code';
    const KEY_MESSAGE = 'message';
    const KEY_TRACE = 'trace';
}
