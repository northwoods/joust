<?php

declare(strict_types=1);

namespace Northwoods\Joust\Tests\Handler;

use Northwoods\Joust\Handler\NotFoundHandler;
use Northwoods\Joust\Handler\NotFoundRoute;
use Northwoods\Joust\Method;
use Northwoods\Joust\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(NotFoundRoute::class)]
final class NotFoundRouteTest extends TestCase
{
    public function testMethodIsGet(): void
    {
        $route = new NotFoundRoute();

        $this->assertSame(Method::Get, $route->method());
    }

    public function testTemplateIsRoot(): void
    {
        $route = new NotFoundRoute();

        $this->assertSame('/', (string) $route->template());
    }

    public function testHandlerResolvesNotFoundHandler(): void
    {
        $route = new NotFoundRoute();

        $this->assertSame(NotFoundHandler::class, $route->handler()->name);
    }
}
