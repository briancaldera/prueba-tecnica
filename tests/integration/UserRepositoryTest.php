<?php

use App\Models\User;
use App\Repositories\DoctrineUserRepository;
use Db\Doctrine\Utils\TestUtils;
use PHPUnit\Framework\TestCase;
use App\ValueObjects\UserId;
use App\ValueObjects\Email;
use App\ValueObjects\Password;
use App\ValueObjects\Name;

class UserRepositoryTest extends TestCase {
    public function tearDown(): void {
        TestUtils::wipeTable('users');
    }

    public function test_repo_can_create_a_user() {
        // Arrange
        $repo = new DoctrineUserRepository();

        $user = new User(
            name: new Name('Mary'),
            email: new Email('mary@example.com'),
            password: Password::fromPassword('Password123='),
            createdAt: new \DateTimeImmutable('now'),
            id: null,
        );

        // Act
        $repo->save($user);

        // Assert
        $this->assertNotNull($user->id);
    }

    public function test_repo_can_find_a_user_by_id() {
        // Arrange
        $repo = new DoctrineUserRepository();

        $user = new User(
            name: new Name('Mary'),
            email: new Email('mary@example.com'),
            password: Password::fromPassword('Password123='),
            createdAt: new \DateTimeImmutable('now'),
            id: null,
        );
        $repo->save($user);

        // Act
        $id = new UserId($user->id->id);
        $user = $repo->findById($id);

        // Assert
        $this->assertNotNull($user);
        $this->assertInstanceOf(User::class, $user);
    }

    public function test_repo_can_delete_a_user() {
        // Arrange
        $repo = new DoctrineUserRepository();

        $user = new User(
            name: new Name('Mary'),
            email: new Email('mary@example.com'),
            password: Password::fromPassword('Password123='),
            createdAt: new \DateTimeImmutable('now'),
            id: null,
        );
        $repo->save($user);

        // Act
        $id = new UserId($user->id->id);
        $repo->delete($id);

        // Assert
        $shouldBeNull = $repo->findById($id);
        $this->assertNull($shouldBeNull);    
    }
}