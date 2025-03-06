<?php

use App\Controllers\RegisterUserController;
use PHPUnit\Framework\TestCase;
use Db\Doctrine\Utils\TestUtils;

class RegisterUserControllerTest extends TestCase {

    protected function tearDown(): void
    {
        TestUtils::wipeTable('users');
    }

    public function test_register_user() {
        // Arrange
        $controller = new RegisterUserController();

        $data = [
            "name"=> "John",
            "email"=> "johndoe@example.com",
            "password" => "ExamplePassword123=",
        ];

        // Act
        $res = $controller->RegisterUser($data);
        
        // Assert
        $this->assertJson($res);
    }
}
