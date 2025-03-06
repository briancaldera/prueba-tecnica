<?php

namespace App\Controllers;

use App\DTOs\RegisterUserRequest;
use App\Services\UserService;
use App\Services\UserServiceInterface;

class RegisterUserController
{

    public function __construct(private UserServiceInterface $userService = new UserService())
    {
    }

    public function RegisterUser(mixed $request)
    {
        $registerUserRequest = new RegisterUserRequest(
            name: $request['name'],
            email: $request['email'],
            password: $request['password'],
        );

        $res = $this->userService->RegisterUserUseCase($registerUserRequest);

        return $res->toJson();
    }
}