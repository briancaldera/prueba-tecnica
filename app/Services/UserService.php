<?php

namespace App\Services;

use App\DTOs\RegisterUserRequest;
use App\Models\User;
use App\Repositories\DoctrineUserRepository;
use App\Repositories\UserRepositoryInterface;
use App\ValueObjects\Email;
use App\ValueObjects\Name;
use App\ValueObjects\Password;
use App\DTOs\UserResponseDTO;

class UserService implements UserServiceInterface
{

    function __construct(
        protected UserRepositoryInterface $userRepository = new DoctrineUserRepository(),
    ) {

    }

    public function RegisterUserUseCase(RegisterUserRequest $request): UserResponseDTO
    {
        $user = new User(
            name: new Name($request->name),
            email: new Email($request->email),
            password: Password::fromPassword($request->password),
            createdAt: new \DateTimeImmutable('now')
        );

        $this->userRepository->save($user);

        $res = new UserResponseDTO(
            id: $user->id->id,
            name: $user->name->name,
            email: $user->email->email,
            createdAt: $user->createdAt,
        );

        return $res;
    }
}