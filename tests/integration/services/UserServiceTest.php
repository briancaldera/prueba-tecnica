<?php

use App\DTOs\UserResponseDTO;
use App\Repositories\UserRepositoryInterface;
use PHPUnit\Framework\TestCase;
use App\Services\UserService;
use App\DTOs\RegisterUserRequest;

class UserServiceTest extends TestCase {
    public function test_service_registers_user() {
        // Arrange
        $service = new UserService();

        $request = new RegisterUserRequest('John', 'johndoe@example.com', 'examplePassword123=');

        // Act
        $result = $service->RegisterUserUseCase($request);

        // Assert
        $this->assertInstanceOf(UserResponseDTO::class, $result);
        $this->assertObjectHasProperty('id', $result);
        $this->assertObjectHasProperty('name', $result);
        $this->assertObjectHasProperty('email', $result);
        $this->assertObjectHasProperty('createdAt', $result);
    }
}