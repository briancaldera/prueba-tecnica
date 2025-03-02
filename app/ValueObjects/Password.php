<?php

namespace App\ValueObjects;

use \InvalidArgumentException;

class Password
{
    public static const string PASSWORD_ALGO = PASSWORD_BCRYPT;
    public static const int PASSWORD_BCRYPT_COST = 12;

    public readonly string $hash;

    public function __construct(string $password)
    {
        $password = trim($password);

        if ($password === "") {
            throw new InvalidArgumentException("Password cannot be empty");
        }

        if (strlen($password) < 12) {
            throw new InvalidArgumentException("Password must be at least 12 characters long");
        }

        if (strlen($password) > 255) {
            throw new InvalidArgumentException("Password cannot be longer than 255 characters");
        }

        // Usamos BCRYPT con 12 rounds de costo y salt generado automaticamente
        $hash = password_hash($password, self::PASSWORD_ALGO, [
            'cost' => self::PASSWORD_BCRYPT_COST,
        ]);

        $this->hash = $hash;
    }

    public function compare(string $other): bool
    {
        return password_verify($other, $this->hash);
    }

    public function __toString(): string
    {
        return $this->hash;
    }
}