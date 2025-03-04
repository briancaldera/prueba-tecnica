<?php

namespace App\ValueObjects;

class Password
{
    public const string PASSWORD_ALGO = PASSWORD_BCRYPT;
    public const int PASSWORD_BCRYPT_COST = 12;

    public private(set) readonly string $hash;

    private function __construct(string $hash) {
        $this->hash = $hash;
    }

    public static function fromPassword(string $password): self
    {
        $password = trim($password);

        if ($password === "") {
            throw new \InvalidArgumentException("Password cannot be empty");
        }

        if (strlen($password) < 12) {
            throw new \InvalidArgumentException("Password must be at least 12 characters long");
        }

        if (strlen($password) > 100) {
            throw new \InvalidArgumentException("Password cannot be longer than 100 characters");
        }

        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{12,100}$/', $password)) {
            throw new \InvalidArgumentException("Password must contain at least one lowercase letter, one uppercase letter, one digit, and one special character");
        }

        // Usamos BCRYPT con 12 rounds de costo y salt generado automaticamente
        $hash = password_hash($password, self::PASSWORD_ALGO, [
            'cost' => self::PASSWORD_BCRYPT_COST,
        ]);

        return new self($hash);
    }

    public static function fromHash(string $hash): self {
        if( strlen($hash) != 60 || !preg_match('/^\$2y\$/', $hash )) {
            throw new \InvalidArgumentException('Argument is not a hash');
        }

        return new self($hash);
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