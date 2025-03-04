<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\ValueObjects\Name;

class NameTest extends TestCase
{
    public function test_name_cannot_be_empty()
    {
        $this->expectException(\InvalidArgumentException::class);

        $name = new Name('');
    }

    public function test_name_cannot_contain_whitespaces()
    {
        $this->expectException(\InvalidArgumentException::class);

        $name = new Name('John Doe');
    }

    public function test_name_cannot_be_longer_than_255_characters()
    {
        $this->expectException(\InvalidArgumentException::class);

        $name = new Name('dAUXomdsWgJiExkoyrncTkvitUAfgHCkgeULUtBjCuYwQELREkLLrbrjOVQzglYrVXtgWAHGNmCdpRiZBjoqHyljzWpmfwNTovu');
    }

    public function test_name_can_be_created()
    {

        $text = 'John';

        $name = new Name($text);

        $this->assertEquals($text, $name->name);
    }
}
