<?php

namespace App\Exceptions;

class UserAlreadyExistsException extends \Exception {
    protected $message = "Usuario ya existe";

    function __construct(string $message = "", int $code = 0, ?\Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
        $this->message = $message;
    }
}