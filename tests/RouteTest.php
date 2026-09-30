<?php

declare(strict_types=1);

namespace Northwoods\Joust\Tests;

use League\Uri\UriTemplate;
use Northwoods\Joust\Method;
use Northwoods\Joust\Route;
use Northwoods\Joust\RouteHandler;
use Northwoods\Joust\Tests\Fixture\TestHandler;
use PHPUnit\Framework\Attributes\CoversClass;
use Psl\Type\Exception\AssertException;

#[CoversClass(Route::class)]
final class RouteTest extends TestCase
{
    public function testExposesItsParts(): void
    {
        $template = new UriTemplate('/users/{id}');
        $handler = new RouteHandler(TestHandler::class);

        $route = new Route([Method::Get, Method::Post], $template, $handler);

        $this->assertSame([Method::Get, Method::Post], [...$route->methods()]);
        $this->assertSame($template, $route->template());
        $this->assertSame($handler, $route->handler());
    }

    public function testRejectsValuesThatAreNotMethods(): void
    {
        $this->expectException(AssertException::class);

        // @mago-expect analysis:possibly-invalid-argument
        new Route(['GET'], new UriTemplate('/'), new RouteHandler(TestHandler::class));
    }
}
