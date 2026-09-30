<?php

declare(strict_types=1);

namespace Northwoods\Joust\Tests;

use Northwoods\Joust\Handler\NotFoundRoute;
use Northwoods\Joust\Method;
use Northwoods\Joust\RouteList;
use Northwoods\Joust\Router;
use Nyholm\Psr7\ServerRequest;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Router::class)]
final class RouterTest extends TestCase
{
    public function testMatchesRouteByMethodAndUri(): void
    {
        $route = $this->createRoute(Method::Get, '/users/{id}');
        $router = new Router(new RouteList($route));

        $result = $router->match(new ServerRequest('GET', '/users/42'));

        $this->assertSame($route, $result->route);
        $this->assertTrue($result->result->isSuccessful());
        $this->assertSame('42', $result->result->string('id'));
    }

    public function testSkipsRoutesWithNonMatchingMethod(): void
    {
        $post = $this->createRoute(Method::Post, '/users/{id}');
        $get = $this->createRoute(Method::Get, '/users/{id}');
        $router = new Router(new RouteList($post, $get));

        $result = $router->match(new ServerRequest('GET', '/users/42'));

        $this->assertSame($get, $result->route);
    }

    public function testContinuesWhenUriDoesNotMatch(): void
    {
        $miss = $this->createRoute(Method::Get, '/users/{id}');
        $hit = $this->createRoute(Method::Get, '/posts/{id}');
        $router = new Router(new RouteList($miss, $hit));

        $result = $router->match(new ServerRequest('GET', '/posts/7'));

        $this->assertSame($hit, $result->route);
    }

    public function testReturnsNotFoundWhenUriDoesNotMatch(): void
    {
        $route = $this->createRoute(Method::Get, '/users/{id}');
        $router = new Router(new RouteList($route));

        $result = $router->match(new ServerRequest('GET', '/other'));

        $this->assertInstanceOf(NotFoundRoute::class, $result->route);
        $this->assertTrue($result->result->isEmpty());
    }

    public function testReturnsNotFoundWhenNoRouteMatchesMethod(): void
    {
        $route = $this->createRoute(Method::Post, '/users/{id}');
        $router = new Router(new RouteList($route));

        $result = $router->match(new ServerRequest('GET', '/users/42'));

        $this->assertInstanceOf(NotFoundRoute::class, $result->route);
    }

    public function testUsesCustomNotFoundRoute(): void
    {
        $notFound = $this->createRoute(Method::Get, '/');
        $router = new Router(new RouteList($this->createRoute(Method::Post, '/users')), $notFound);

        $result = $router->match(new ServerRequest('GET', '/users'));

        $this->assertSame($notFound, $result->route);
    }
}
