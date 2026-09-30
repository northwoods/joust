<?php

declare(strict_types=1);

namespace Northwoods\Joust\Tests;

use Northwoods\Joust\RouteHandler;
use Northwoods\Joust\Tests\Fixture\TestContainer;
use Northwoods\Joust\Tests\Fixture\TestHandler;
use Nyholm\Psr7\Factory\Psr17Factory;
use PHPUnit\Framework\Attributes\CoversClass;
use Psl\Type\Exception\AssertException;
use stdClass;

#[CoversClass(RouteHandler::class)]
final class RouteHandlerTest extends TestCase
{
    public function testResolveReturnsHandlerFromContainer(): void
    {
        $handler = new TestHandler(new Psr17Factory());
        $container = new TestContainer([TestHandler::class => $handler]);

        $routeHandler = new RouteHandler(TestHandler::class);

        $this->assertSame($handler, $routeHandler->resolve($container));
    }

    public function testConstructorRejectsClassThatIsNotAHandler(): void
    {
        $this->expectException(AssertException::class);

        // @mago-expect analysis:invalid-argument
        new RouteHandler(stdClass::class);
    }

    public function testConstructorRejectsUnknownClass(): void
    {
        $this->expectException(AssertException::class);

        // @mago-expect analysis:possibly-invalid-argument
        new RouteHandler('Northwoods\Joust\Tests\Fixture\DoesNotExist');
    }
}
