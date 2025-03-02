<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\ValueObjects\Password;

class PasswordTest extends TestCase {
    public function test_cannot_be_empty() {
        $this->expectException(\InvalidArgumentException::class);

        $password = new Password("");
    }

    public function test_cannot_be_less_than_12_characters() {
        $this->expectException(\InvalidArgumentException::class);

        $password = new Password("example");
    }

    public function test_cannot_be_more_than_100_characters() {
        $this->expectException(\InvalidArgumentException::class);

        $password = new Password('jU58Tx6cqqxqQLrTFKBASortMjnSQAbTQgJd9F5uVbvSsdESeVuoFpElDq0BsBJlHwzCNGP20a14wbkVbjNplqJH2jGhf2TJaoZ20a14wbkVbjNplqJH2jGhf2TJaoZ');
    }

    public function test_password_is_hashed_with_BCRYPT() {

        $text = 'myC00lP4ssword123+';

        $password = new Password($text);

        $this->assertNotEquals($text, $password->hash);
        $this->stringStartsWith('$2y')->evaluate($password->hash);
    }

    public function test_password_can_be_compared_to_a_string() {
        $text = 'myC00lP4ssword123+';

        $password = new Password($text);

        $this->assertTrue($password->compare('myC00lP4ssword123+'));
    }

    public function test_password_rejects_different_strings() {
        $text = 'myC00lP4ssword123+';

        $password = new Password($text);

        $this->assertFalse($password->compare('myC00lP4ssword'));
    }

    public function test_password_rejects_if_missing_uppercase() {
        $this->expectException(\InvalidArgumentException::class);

        $text = 'myfulllowercasepassword123+';

        $password = new Password($text);
    }

    public function test_password_rejects_if_missing_lowercase() {
        $this->expectException(\InvalidArgumentException::class);

        $text = 'MYFULLUPPERCASEPASSWORD123+';

        $password = new Password($text);
    }

    public function test_password_rejects_if_missing_number() {
        $this->expectException(\InvalidArgumentException::class);

        $text = 'myAlphaPassword=';

        $password = new Password($text);
    }

    public function test_password_rejects_if_missing_symbol() {
        $this->expectException(\InvalidArgumentException::class);

        $text = 'myC00lP4ssword';

        $password = new Password($text);
    }
}