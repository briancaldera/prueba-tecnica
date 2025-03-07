<?php

use App\Models\User;
use App\ValueObjects\Email;
use App\ValueObjects\Name;
use App\ValueObjects\Password;
use App\ValueObjects\UserId;
use PhpUnit\Framework\TestCase;

class UserTest extends TestCase {
    public function test_user_can_be_created() {
        
        $user = new User(
            name: new Name('Mary'),
            email: new Email('mary@example.com'),
            password: Password::fromPassword('Password123='),
            createdAt: new \DateTimeImmutable('now'),
            id: new UserId('10'),
        );

        $this->assertInstanceOf(User::class, $user);
        $this->assertInstanceOf(Name::class, $user->name);
        $this->assertInstanceOf(Email::class, $user->email);
        $this->assertInstanceOf(Password::class, $user->password);
        $this->assertInstanceOf(\DateTimeImmutable::class, $user->createdAt);
        $this->assertInstanceOf(UserId::class, $user->id);
    }
}
