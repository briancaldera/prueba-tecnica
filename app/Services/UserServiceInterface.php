<?php

namespace App\Services;

use App\DTOs\RegisterUserRequest;
use App\DTOs\UserResponseDTO;

interface UserServiceInterface {

    public function RegisterUserUseCase(RegisterUserRequest $request): UserResponseDTO;
}