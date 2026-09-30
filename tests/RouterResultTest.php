<?php

declare(strict_types=1);

namespace Joust\Tests;

use Joust\RouterResult;
use League\Uri\UriTemplate\ExtractionResult;
use Nyholm\Psr7\ServerRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use Psl\Type\Exception\AssertException;

#[CoversClass(RouterResult::class)]
final class RouterResultTest extends TestCase
{
    public function testInjectAddsResultAsRequestAttribute(): void
    {
        $result = new RouterResult($this->createRoute(), ExtractionResult::empty());

        $injected = $result->inject(new ServerRequest('GET', '/'));

        $this->assertSame($result, $injected->getAttribute(RouterResult::class));
    }

    public function testFromRequestReturnsInjectedResult(): void
    {
        $result = new RouterResult($this->createRoute(), ExtractionResult::empty());
        $request = $result->inject(new ServerRequest('GET', '/'));

        $this->assertSame($result, RouterResult::fromRequest($request));
    }

    public function testFromRequestFailsWhenAttributeIsMissing(): void
    {
        $this->expectException(AssertException::class);

        RouterResult::fromRequest(new ServerRequest('GET', '/'));
    }
}
