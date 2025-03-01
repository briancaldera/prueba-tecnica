<?php

namespace App\ValueObjects;

class Name
{
    public readonly string $firstName;
    public readonly string $lastName;
    public function __construct(string $firstName, string $lastName)
    {

        $firstName = trim($firstName);
        $lastName = trim($lastName);

        if ($firstName === "") {
            throw new \InvalidArgumentException("First name cannot be empty");
        }

        if ($lastName === "") {
            throw new \InvalidArgumentException("Last name cannot be empty");
        }

        if (strlen($firstName) > 255) {
            throw new \InvalidArgumentException("First name cannot be longer than 255 characters");
        }

        if (strlen($lastName) > 255) {
            throw new \InvalidArgumentException("Last name cannot be longer than 255 characters");
        }

        if (preg_match('/[^a-zA-Z]/', $firstName)) {
            throw new \InvalidArgumentException("First name can only contain letters");
        }

        if (preg_match('/[^a-zA-Z]/', $lastName)) {
            throw new \InvalidArgumentException("Last name can only contain letters");
        }

        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function __tostring(): string {
        return $this->firstName ." ". $this->lastName;
    }
}