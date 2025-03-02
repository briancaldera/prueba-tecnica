<?php

namespace App\DTOs;

class UserResponseDTO
{
    function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $email,
        public readonly \DateTimeImmutable $createdAt,
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'createdAt' => $this->createdAt->format(\DateTimeImmutable::ATOM),
        ];
    }

    public function toJson(): string
    {
        return json_encode($this->toArray());
    }
}