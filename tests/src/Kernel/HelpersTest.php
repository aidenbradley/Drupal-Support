<?php

namespace Drupal\Tests\drupal_support\Kernel;

use Drupal\Core\Url;
use Drupal\drupal_support\HigherOrderTapProxy;
use Drupal\drupal_support\Optional;
use Drupal\KernelTests\KernelTestBase;
use Drupal\Tests\drupal_support\Kernel\TestClasses\TestClass;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class HelpersTest extends KernelTestBase
{
    protected static $modules = [
        'drupal_support',
    ];

    /** @test */
    public function tap_helper(): void
    {
        $class = TestClass::create();

        $this->assertInstanceOf(HigherOrderTapProxy::class, tap($class));

        tap($class)->setTitle('test title');

        $this->assertEquals('test title', $class->title);

        tap($class)->setTitle('change title')->setTitle('change title again');

        $this->assertEquals('change title again', $class->title);
    }

    /** @test */
    public function route_helper(): void
    {
        // test against node routes
        $this->enableModules([
            'node',
        ]);

        $this->assertEquals('/node/add', route('node.add_page'));

        $this->assertEquals('http://localhost/node/add', route('node.add_page', [], [
            'absolute' => true,
        ]));

        $this->assertEquals('/node/add/custom', route('node.add', [
            'node_type' => 'custom',
        ]));

        $absoluteNodeAddRoute = route('node.add', ['node_type' => 'custom'], ['absolute' => true]);
        $this->assertEquals('http://localhost/node/add/custom', $absoluteNodeAddRoute);
    }

    /** @test */
    public function url_helper(): void
    {
        // test against node routes
        $this->enableModules([
            'node',
        ]);

        $url = url('node.add_page');

        $this->assertInstanceOf(Url::class, $url);
        $this->assertEquals('node.add_page', $url->getRouteName());
    }

    /** @test */
    public function rescue_helper(): void
    {
        $class = TestClass::create();

        $this->assertEquals('fallback value', rescue(function() use ($class) {
            $class->throwException();
        }, 'fallback value'));

        $this->assertEquals('hello', rescue(function() use ($class) {
            return $class->returnHello();
        }));
    }

    /** @test */
    public function redirect_helper(): void
    {
        // test against node routes
        $this->enableModules([
            'node',
        ]);

        $redirect = redirect('node.add_page');

        $this->assertInstanceOf(RedirectResponse::class, $redirect);
        $this->assertEquals('http://localhost/node/add', $redirect->getTargetUrl());

        $redirect = redirect('node.add_page', Response::HTTP_MOVED_PERMANENTLY);
        $this->assertEquals(Response::HTTP_MOVED_PERMANENTLY, $redirect->getStatusCode());
    }

    /** @test */
    public function optional_helper(): void
    {
        $class = TestClass::create();

        $this->assertInstanceOf(Optional::class, optional($class));

        optional($class, function(TestClass $class) {
            $class->setTitle('title set');

            return $class;
        });

        $this->assertEquals('title set', $class->title);

        $this->assertNull(optional(null)->propertyThatDoesNotExist);
        $this->assertNull(optional(null)->methodThatDoesNotExist());
    }
}
