<?php

namespace App\ValueObjects;

use App\Exceptions\InvalidEmailException;

class Email
{
    public readonly string $email;

    public function __construct(string $email)
    {
        $email = trim($email);

        self::validate($email);

        $this->email = $email;
    }

    private static function validate(string $email)
    {
        if (empty($email)) {
            throw new InvalidEmailException("Email cannot be empty");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException("Invalid email address");
        }
    }

    function __toString(): string {
        return $this->email;
    }
}