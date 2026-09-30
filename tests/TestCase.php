<?php

declare(strict_types=1);

namespace Northwoods\Joust\Tests;

use League\Uri\UriTemplate;
use Northwoods\Joust\Method;
use Northwoods\Joust\Route;
use Northwoods\Joust\RouteHandler;
use Northwoods\Joust\Tests\Fixture\TestHandler;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * @internal
 */
abstract class TestCase extends PHPUnitTestCase
{
    /**
     * @param list<Method> $methods
     * @param class-string<RequestHandlerInterface> $handler
     */
    protected function createRoute(
        array $methods = [Method::Get],
        string $template = '/',
        string $handler = TestHandler::class,
    ): Route {
        return new Route($methods, new UriTemplate($template), new RouteHandler($handler));
    }
}
