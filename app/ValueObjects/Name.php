<?php

namespace App\ValueObjects;

class Name
{
    public readonly string $name;
    public function __construct(string $name)
    {

        $name = trim($name);

        if ($name === "") {
            throw new \InvalidArgumentException("Name cannot be empty");
        }

        if (strlen($name) > 50) {
            throw new \InvalidArgumentException("Name cannot be longer than 50 characters");
        }

        if (preg_match('/[^a-zA-Z]/', $name)) {
            throw new \InvalidArgumentException("Name can only contain letters");
        }

        $this->name = $name;
    }

    public function __tostring(): string {
        return $this->name;
    }
}