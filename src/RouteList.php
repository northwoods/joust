<?php

declare(strict_types=1);

namespace Northwoods\Joust;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use Override;
use Traversable;

use function Psl\Iter\count;

/**
 * @api
 * @implements IteratorAggregate<int, Route>
 */
final readonly class RouteList implements Countable, IteratorAggregate
{
    /** @var list<Route> */
    private array $items;

    public function __construct(Route $route, Route ...$more)
    {
        $this->items = [$route, ...$more];
    }

    #[Override]
    public function count(): int
    {
        return count($this->items);
    }

    #[Override]
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }
}
