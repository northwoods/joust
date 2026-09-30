<?php

declare(strict_types=1);

namespace Joust;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use Override;
use Traversable;

use function Psl\Iter\count;
use function Psl\Vec\values;

/**
 * @api
 * @implements IteratorAggregate<int, Route>
 */
final readonly class RouteList implements Countable, IteratorAggregate
{
    /** @var list<Route> */
    private array $items;

    public function __construct(Route ...$items)
    {
        $this->items = values($items);
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
