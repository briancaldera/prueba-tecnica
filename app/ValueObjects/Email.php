<?php

namespace App\ValueObjects;

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
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("Invalid email address");
        }

        if (empty($email)) {
            throw new \InvalidArgumentException("Email cannot be empty");
        }
    }

    function __toString(): string {
        return $this->email;
    }
}