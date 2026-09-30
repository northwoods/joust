<?php

declare(strict_types=1);

namespace Northwoods\Joust\Tests;

use Northwoods\Joust\RouteList;
use PHPUnit\Framework\Attributes\CoversClass;

use function iterator_to_array;

#[CoversClass(RouteList::class)]
final class RouteListTest extends TestCase
{
    public function testCountsASingleRoute(): void
    {
        $list = new RouteList($this->createRoute());

        $this->assertCount(1, $list);
    }

    public function testCountsEveryRoute(): void
    {
        $list = new RouteList($this->createRoute(), $this->createRoute(), $this->createRoute());

        $this->assertCount(3, $list);
    }

    public function testIteratesRoutesInOrder(): void
    {
        $first = $this->createRoute();
        $second = $this->createRoute();

        $list = new RouteList($first, $second);

        $this->assertSame([$first, $second], iterator_to_array($list));
    }
}
