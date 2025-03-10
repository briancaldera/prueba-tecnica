<?php

namespace App\Services;

use App\DTOs\RegisterUserRequest;
use App\Events\EventBus;
use App\Events\UserRegisteredEvent;
use App\Models\User;
use App\Repositories\DoctrineUserRepository;
use App\Repositories\UserRepositoryInterface;
use App\ValueObjects\Email;
use App\ValueObjects\Name;
use App\ValueObjects\Password;
use App\DTOs\UserResponseDTO;
use App\Exceptions\UserAlreadyExistsException;
use App\Services\UserServiceInterface;
use App\Services\EmailServiceInterface;
use App\Services\EmailService;

class UserService implements UserServiceInterface
{
    protected EventBus $eventBus;
    function __construct(
        protected UserRepositoryInterface $userRepository = new DoctrineUserRepository(),
        protected EmailServiceInterface $emailService = new EmailService(),
    ) {
        $this->eventBus = EventBus::getInstance();
    }

    public function RegisterUserUseCase(RegisterUserRequest $request): UserResponseDTO
    {
        $user = new User(
            name: new Name($request->name),
            email: new Email($request->email),
            password: Password::fromPassword($request->password),
            createdAt: new \DateTimeImmutable('now')
        );

        if ($this->emailService->emailExists($user->email)) {
            throw new UserAlreadyExistsException('User already exists');
        }

        $this->userRepository->save($user);

        $this->eventBus->dispatch(new UserRegisteredEvent($user));

        $res = new UserResponseDTO(
            userId: $user->id->id,
            message: 'Usuario creado exitosamente',
            createdAt: $user->createdAt,
        );

        return $res;
    }
}