<?php

declare(strict_types=1);

namespace Northwoods\Joust\Attribute;

use Generator;
use Northwoods\Joust\Route;
use Northwoods\Joust\RouteHandler;
use Psr\Http\Server\RequestHandlerInterface;
use ReflectionClass;
use WyriHaximus\Lister;

use function is_subclass_of;
use function Psl\invariant;

final readonly class CollectRoutes
{
    /**
     * @param non-empty-string $directory
     * @return iterable<int, Route>
     */
    public function in(string $directory): iterable
    {
        /** @var list<class-string> $classes */
        $classes = Lister::instantiatableClassesInDirectory($directory);

        foreach ($classes as $class) {
            if (!$this->isRequestHandler($class)) {
                continue;
            }

            yield from $this->on($class);
        }
    }

    /**
     * @return Generator<int, Route>
     */
    public function on(string $class): iterable
    {
        invariant($this->isRequestHandler($class), "Not a RequestHandlerInterface: {$class}");

        $handler = new RouteHandler($class);

        foreach (new ReflectionClass($class)->getAttributes(AsRoute::class) as $attr) {
            $route = $attr->newInstance();

            yield new Route($route->methods, $route->template, $handler);
        }
    }

    /**
     * @phpstan-assert-if-true class-string<RequestHandlerInterface> $class
     */
    private function isRequestHandler(string $class): bool
    {
        return is_subclass_of($class, class: RequestHandlerInterface::class, allow_string: true);
    }
}
