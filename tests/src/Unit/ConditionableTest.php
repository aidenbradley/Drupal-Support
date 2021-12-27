<?php

namespace Drupal\Tests\drupal_support\Unit;

use Drupal\Tests\drupal_support\Unit\TestClasses\ConditionableClass;
use Drupal\Tests\UnitTestCase;

class ConditionableTest extends UnitTestCase
{
    /** @test */
    public function when_method(): void
    {
        $conditionable = ConditionableClass::create();

        $conditionable->setTitle('default');
        $this->assertEquals('default', $conditionable->title);

        $conditionable->when(true, function(ConditionableClass $class) {
            $class->setTitle('changed title');
        });

        $this->assertEquals('changed title', $conditionable->title);

        $conditionable->when(false, function(ConditionableClass $class) {
            $class->setTitle('new title');
        });

        $this->assertEquals('changed title', $conditionable->title);
    }

    /** @test */
    public function unless_method(): void
    {
        $conditionable = ConditionableClass::create();

        $conditionable->setTitle('default');
        $this->assertEquals('default', $conditionable->title);

        $conditionable->unless(true, function(ConditionableClass $class) {
            $class->setTitle('changed title');
        });

        $this->assertEquals('default', $conditionable->title);

        $conditionable->unless(false, function(ConditionableClass $class) {
            $class->setTitle('new title');
        });

        $this->assertEquals('new title', $conditionable->title);
    }
}
