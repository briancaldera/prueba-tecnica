<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\ValueObjects\Email;

class EmailTest extends TestCase {
    public function test_email_cannot_be_empty() {
        $this->expectException(InvalidArgumentException::class);

        $email = new Email('');
    }

    public function test_email_validates_format() {
        $this->expectException(InvalidArgumentException::class);

        $email = new Email('username@example');
    }

    public function test_email_validates_format_2() {
        $this->expectException(InvalidArgumentException::class);

        $email = new Email('username@');
    }

    public function test_email_validates_format_3() {
        $this->expectException(InvalidArgumentException::class);

        $email = new Email('username');
    }

    public function test_email_validates_format_4() {
        $this->expectException(InvalidArgumentException::class);

        $email = new Email('username@example com');
    }

    public function test_email_creates_valid() {

        $text = 'username@example.com';
        $email = new Email('username@example.com');

        $this->assertEquals($text, $email->email);
    }
}