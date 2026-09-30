<?php

declare(strict_types=1);

namespace Northwoods\Joust\Tests;

use Northwoods\Joust\Method;
use Nyholm\Psr7\ServerRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;

#[CoversClass(Method::class)]
final class MethodTest extends TestCase
{
    #[DataProvider('provideRequestMethods')]
    public function testFromRequest(string $method, Method $expected): void
    {
        $request = new ServerRequest($method, '/');

        $this->assertSame($expected, Method::fromRequest($request));
    }

    /**
     * @return iterable<string, array{string, Method}>
     */
    public static function provideRequestMethods(): iterable
    {
        yield 'uppercase' => ['GET', Method::Get];
        yield 'lowercase' => ['get', Method::Get];
        yield 'mixed case' => ['pAtCh', Method::Patch];
        yield 'post' => ['POST', Method::Post];
    }
}
