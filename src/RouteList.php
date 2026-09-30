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
 * @implements IteratorAggregate<int, RouteInterface>
 */
final readonly class RouteList implements Countable, IteratorAggregate
{
    /** @var list<RouteInterface> */
    private array $items;

    public function __construct(RouteInterface ...$items)
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
