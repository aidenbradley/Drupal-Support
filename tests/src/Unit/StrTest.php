<?php

namespace Drupal\Tests\drupal_support\Unit;

use Drupal\drupal_support\Utility\Str;
use Drupal\Tests\UnitTestCase;

class StrTest extends UnitTestCase
{
    /**
     * @test
     * @dataProvider camelCaseProvider
     */
    public function snake_case($snakeCase, $expected): void
    {
        $this->assertEquals($expected, Str::camelCase($snakeCase));
    }

    public function camelCaseProvider(): array
    {
        return [
            ['hello_world', 'helloWorld'],
            ['node', 'node'],
            ['example_1_numb3rs', 'example1Numb3rs'],
        ];
    }

    /**
     * @test
     * @dataProvider pascalCaseProvider
     */
    public function pascal_case($snakeCase, $expected): void
    {
        $this->assertEquals($expected, Str::pascalCase($snakeCase));
    }

    public function pascalCaseProvider(): array
    {
        return [
            ['hello_world', 'HelloWorld'],
            ['node', 'Node'],
            ['example_1_numb3rs', 'Example1Numb3rs'],
        ];
    }

    /** @test */
    public function starts_with(): void
    {
        $this->assertTrue(Str::startsWith('hello', 'h'));
        $this->assertTrue(Str::startsWith('w0rld', 'w'));
        $this->assertTrue(Str::startsWith('3xample', '3'));
    }

    /** @test */
    public function ends_with(): void
    {
        $this->assertTrue(Str::endsWith('hello', 'o'));
        $this->assertTrue(Str::endsWith('w0rld', 'd'));
        $this->assertTrue(Str::endsWith('exampl3', '3'));
    }
}
