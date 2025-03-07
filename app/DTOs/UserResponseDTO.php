<?php

namespace App\DTOs;

class UserResponseDTO
{
    function __construct(
        public readonly int $userId,
        public readonly string $message,
        public readonly \DateTimeImmutable $createdAt,
    ) {
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->userId,
            'message' => $this->message,
            'createdAt' => $this->createdAt->format(\DateTimeImmutable::ATOM),
        ];
    }

    public function toJson(): string
    {
        return json_encode($this->toArray());
    }
}