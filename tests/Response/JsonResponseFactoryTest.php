<?php

declare(strict_types=1);

namespace Northwoods\Joust\Tests\Response;

use Northwoods\Joust\Response\JsonResponseFactory;
use Northwoods\Joust\Response\JsonResponseSettings;
use Northwoods\Joust\Tests\TestCase;
use Nyholm\Psr7\Factory\Psr17Factory;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(JsonResponseFactory::class)]
final class JsonResponseFactoryTest extends TestCase
{
    public function testRespondUsesDefaults(): void
    {
        $factory = new Psr17Factory();
        $json = new JsonResponseFactory($factory, $factory);

        $response = $json->respond();

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('application/json; charset=utf-8', $response->getHeaderLine('Content-Type'));
        $this->assertSame('[]', (string) $response->getBody());
    }

    public function testRespondEncodesStatusAndData(): void
    {
        $factory = new Psr17Factory();
        $json = new JsonResponseFactory($factory, $factory);

        $response = $json->respond(404, ['error' => 'NotFound']);

        $this->assertSame(404, $response->getStatusCode());
        $this->assertSame('{"error":"NotFound"}', (string) $response->getBody());
    }

    public function testRespondUsesCustomSettings(): void
    {
        $factory = new Psr17Factory();
        $json = new JsonResponseFactory($factory, $factory, new JsonResponseSettings('text/plain', true));

        $response = $json->respond(201, ['a' => 1]);

        $this->assertSame(201, $response->getStatusCode());
        $this->assertSame('text/plain', $response->getHeaderLine('Content-Type'));
        $this->assertSame("{\n    \"a\": 1\n}", (string) $response->getBody());
    }
}
