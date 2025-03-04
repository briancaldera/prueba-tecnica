<?php

namespace App\Exceptions;

class InvalidEmailException extends \Exception {
    protected $message = "El email es inválido";

    function __construct(string $message = "", int $code = 0, \Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
        $this->message = $message;
    }
}
