<?php

declare(strict_types=1);

namespace Joust\Tests;

use Joust\Method;
use Joust\Route;
use Joust\RouteHandler;
use Joust\Tests\Fixture\TestHandler;
use League\Uri\UriTemplate;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Route::class)]
final class RouteTest extends TestCase
{
    public function testExposesItsParts(): void
    {
        $template = new UriTemplate('/users/{id}');
        $handler = new RouteHandler(TestHandler::class);

        $route = new Route(Method::Get, $template, $handler);

        $this->assertSame(Method::Get, $route->method);
        $this->assertSame($template, $route->template);
        $this->assertSame($handler, $route->handler);
    }
}
