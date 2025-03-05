<?php

namespace App\Exceptions;

class WeakPasswordException extends \Exception {
    protected $message = "La contraseña es débil. Debe tener al menos 8 caracteres, una letra mayúscula, un número y un símbolo";

    function __construct(string $message = "", int $code = 0, ?\Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
        $this->message = $message;
    }
}