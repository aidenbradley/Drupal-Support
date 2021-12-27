<?php

namespace Drupal\Tests\drupal_support\Unit\TestClasses;

use Drupal\drupal_support\Concerns\Conditionable;

class ConditionableClass
{
    use Conditionable;

    public $title;

    public static function create(): self
    {
        return new self();
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
}
