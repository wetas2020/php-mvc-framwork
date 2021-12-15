<?php

namespace app\core\exception;

class ForbiddenException extends \Exception
{
    protected $message = 'You are not allowed to access this page';
    protected $code = 403;
}