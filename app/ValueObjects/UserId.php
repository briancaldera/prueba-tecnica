<?php

namespace App\ValueObjects;

class UserId
{
    public readonly int $id;

    public function __construct(int $id)
    {
        if ($id < 0) {
            throw new \InvalidArgumentException("Id cannot be negative");
        }

        $this->id = $id;
    }

    public function __toString(): string
    {
        return "$this->id";
    }
}
