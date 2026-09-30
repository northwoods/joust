<?php

declare(strict_types=1);

namespace Northwoods\Joust\Tests\Handler;

use Northwoods\Joust\Handler\NotFoundHandler;
use Northwoods\Joust\Tests\TestCase;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\ServerRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(NotFoundHandler::class)]
final class NotFoundHandlerTest extends TestCase
{
    public function testHandleReturnsJsonNotFoundResponse(): void
    {
        $factory = new Psr17Factory();
        $handler = new NotFoundHandler($factory, $factory);

        $response = $handler->handle(new ServerRequest('GET', '/'));

        $this->assertSame(404, $response->getStatusCode());
        $this->assertSame('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertSame('{"error":"NotFound"}', (string) $response->getBody());
    }
}
