<?php

declare(strict_types=1);

namespace Joust\Tests;

use Joust\Method;
use Joust\Route;
use Joust\RouteHandler;
use Joust\Tests\Fixture\TestHandler;
use League\Uri\UriTemplate;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * @internal
 */
abstract class TestCase extends PHPUnitTestCase
{
    /**
     * @param class-string<RequestHandlerInterface> $handler
     */
    protected function createRoute(
        Method $method = Method::Get,
        string $template = '/',
        string $handler = TestHandler::class,
    ): Route {
        return new Route($method, new UriTemplate($template), new RouteHandler($handler));
    }
}
