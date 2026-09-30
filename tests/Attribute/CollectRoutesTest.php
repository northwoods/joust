<?php

declare(strict_types=1);

namespace Northwoods\Joust\Tests\Attribute;

use LogicException;
use Northwoods\Joust\Attribute\CollectRoutes;
use Northwoods\Joust\Method;
use Northwoods\Joust\Route;
use Northwoods\Joust\Tests\Fixture\Routes\GetUsers;
use Northwoods\Joust\Tests\Fixture\Routes\NotAHandler;
use Northwoods\Joust\Tests\Fixture\Routes\UserActions;
use Northwoods\Joust\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Psl\Type\Exception\AssertException;

use function Psl\Vec\map;
use function Psl\Vec\sort;
use function Psl\Vec\values;

#[CoversClass(CollectRoutes::class)]
final class CollectRoutesTest extends TestCase
{
    private const string DIRECTORY = __DIR__ . '/../Fixture/Routes';

    public function testInCollectsRoutesFromHandlers(): void
    {
        $routes = [...new CollectRoutes()->in(self::DIRECTORY)];

        $handlers = sort(map($routes, static fn(Route $route): string => $route->handler()->name));

        $this->assertSame([GetUsers::class, UserActions::class, UserActions::class], $handlers);
    }

    public function testInSkipsClassesThatAreNotHandlers(): void
    {
        $routes = [...new CollectRoutes()->in(self::DIRECTORY)];

        $handlers = map($routes, static fn(Route $route): string => $route->handler()->name);

        $this->assertNotContains(NotAHandler::class, $handlers);
    }

    public function testOnCollectsEveryRouteAttribute(): void
    {
        $routes = [...new CollectRoutes()->on(UserActions::class)];

        $this->assertCount(2, $routes);

        $get = $routes[0] ?? throw new LogicException('Expected a GET route.');
        $delete = $routes[1] ?? throw new LogicException('Expected a DELETE route.');

        $this->assertSame(Method::Get, $get->method());
        $this->assertSame(Method::Delete, $delete->method());
        $this->assertSame('/users/{id}', (string) $get->template());
        $this->assertSame(UserActions::class, $get->handler()->name);
    }

    public function testOnRejectsClassThatIsNotAHandler(): void
    {
        $this->expectException(AssertException::class);

        values(new CollectRoutes()->on(NotAHandler::class));
    }
}
