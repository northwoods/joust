<?php

declare(strict_types=1);

namespace Northwoods\Joust\Tests;

use League\Uri\UriTemplate;
use Northwoods\Joust\Method;
use Northwoods\Joust\Route;
use Northwoods\Joust\RouteHandler;
use Northwoods\Joust\Tests\Fixture\TestHandler;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Route::class)]
final class RouteTest extends TestCase
{
    public function testExposesItsParts(): void
    {
        $template = new UriTemplate('/users/{id}');
        $handler = new RouteHandler(TestHandler::class);

        $route = new Route(Method::Get, $template, $handler);

        $this->assertSame(Method::Get, $route->method());
        $this->assertSame($template, $route->template());
        $this->assertSame($handler, $route->handler());
    }
}
