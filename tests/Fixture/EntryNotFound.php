<?php

declare(strict_types=1);

namespace Northwoods\Joust\Tests\Fixture;

use Psr\Container\NotFoundExceptionInterface;
use RuntimeException;

final class EntryNotFound extends RuntimeException implements NotFoundExceptionInterface {}
