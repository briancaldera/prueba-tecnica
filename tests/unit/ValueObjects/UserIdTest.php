<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\ValueObjects\UserId;
use \InvalidArgumentException;

class UserIdTest extends TestCase {
    
    public function test_does_not_accept_negative_number() {
        $this->expectException(InvalidArgumentException::class);

        $userId = new UserId(-1000);
    }

    public function test_accepts_0() {

        $userId = new UserId(0);

        $this->assertEquals($userId->id, 0);
    }

    public function test_two_ids_are_the_same() {

        $userId = new UserId(0);
        $userId2 = new UserId(0);

        $this->assertEquals($userId, $userId2);
    }

    public function test_two_ids_are_not_the_same() {

        $userId = new UserId(0);
        $userId2 = new UserId(1);

        $this->assertNotEquals($userId, $userId2);
    }
}