<?php

declare(strict_types=1);

namespace Northwoods\Joust\Tests\Attribute;

use League\Uri\UriTemplate;
use Northwoods\Joust\Attribute\AsRoute;
use Northwoods\Joust\Method;
use Northwoods\Joust\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use ValueError;

#[CoversClass(AsRoute::class)]
final class AsRouteTest extends TestCase
{
    public function testDefaults(): void
    {
        $route = new AsRoute();

        $this->assertSame([Method::Get], $route->methods);
        $this->assertSame('/', (string) $route->template);
    }

    public function testNormalizesSingleMethodAndTemplate(): void
    {
        $route = new AsRoute(Method::Post, '/posts');

        $this->assertSame([Method::Post], $route->methods);
        $this->assertSame('/posts', (string) $route->template);
    }

    public function testNormalizesStringMethod(): void
    {
        $route = new AsRoute('PATCH');

        $this->assertSame([Method::Patch], $route->methods);
    }

    public function testNormalizesArrayOfMethods(): void
    {
        $route = new AsRoute([Method::Get, 'POST']);

        $this->assertSame([Method::Get, Method::Post], $route->methods);
    }

    public function testAcceptsUriTemplateInstance(): void
    {
        $template = new UriTemplate('/users/{id}');

        $route = new AsRoute(Method::Get, $template);

        $this->assertSame($template, $route->template);
    }

    public function testRejectsUnknownMethod(): void
    {
        $this->expectException(ValueError::class);

        new AsRoute('FLY');
    }
}
