<?php

use App\DTOs\UserResponseDTO;
use App\Exceptions\UserAlreadyExistsException;
use PHPUnit\Framework\TestCase;
use App\Services\UserService;
use App\DTOs\RegisterUserRequest;
use Db\Doctrine\Utils\TestUtils;
use App\Events\Listeners\SendEmailListener;
use App\Events\EventBus;

class UserServiceTest extends TestCase
{

    protected function setUp(): void
    {
        $emailListener = SendEmailListener::getInstance();

        $eventBus = EventBus::getInstance();

        $eventBus->registerListener('user-registered', $emailListener);
    }

    protected function tearDown(): void
    {
        TestUtils::wipeTable('users');
    }

    public function test_service_registers_user()
    {
        // Arrange
        $service = new UserService();

        $request = new RegisterUserRequest('John', 'johndoe@example.com', 'examplePassword123=');

        // Act
        $result = $service->RegisterUserUseCase($request);

        // Assert
        $this->assertInstanceOf(UserResponseDTO::class, $result);
        $this->assertObjectHasProperty('userId', $result);
        $this->assertObjectHasProperty('createdAt', $result);
    }

    public function test_service_rejects_duplicated_email()
    {
        // Arrange
        $this->expectException(UserAlreadyExistsException::class);

        $service = new UserService();

        $request = new RegisterUserRequest('John', 'johndoe@example.com', 'examplePassword123=');
        $service->RegisterUserUseCase($request);

        // Act
        $request2 = new RegisterUserRequest('JohnDoe', 'johndoe@example.com', 'anotherPassword123=');
        $service->RegisterUserUseCase($request2);
    }
}