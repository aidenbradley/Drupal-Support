<?php

namespace Drupal\Tests\drupal_support\Kernel\TestClasses;

class TestClass
{
    /** @var string|null */
    public $title = null;

    public static function create(): self
    {
        return new self();
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function throwException(): void
    {
        throw new \Exception();
    }

    public function returnHello(): string
    {
        return 'hello';
    }
}
