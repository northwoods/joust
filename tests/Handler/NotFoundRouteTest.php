<?php

declare(strict_types=1);

namespace Joust\Tests\Handler;

use Joust\Handler\NotFoundHandler;
use Joust\Handler\NotFoundRoute;
use Joust\Tests\TestCase;
use LogicException;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(NotFoundRoute::class)]
final class NotFoundRouteTest extends TestCase
{
    public function testMethodIsGet(): void
    {
        $this->expectException(LogicException::class);

        $route = new NotFoundRoute();

        $route->method();
    }

    public function testTemplateIsRoot(): void
    {
        $this->expectException(LogicException::class);

        $route = new NotFoundRoute();

        $route->template();
    }

    public function testHandlerResolvesNotFoundHandler(): void
    {
        $route = new NotFoundRoute();

        $this->assertSame(NotFoundHandler::class, $route->handler()->name);
    }
}
