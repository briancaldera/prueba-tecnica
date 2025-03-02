<?php

namespace App\DTOs;

class RegisterUserRequest {
    function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
    ) {
        
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }

    public function toJson(): string
    {
        return json_encode($this->toArray());
    }
}
