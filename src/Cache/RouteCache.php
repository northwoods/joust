<?php

declare(strict_types=1);

namespace Joust\Cache;

use Joust\RouteList;

use function dirname;
use function file_get_contents;
use function file_put_contents;
use function is_dir;
use function is_file;
use function is_string;
use function mkdir;
use function Psl\invariant;
use function Psl\Type\instance_of;
use function Psl\Vec\values;
use function serialize;
use function unserialize;

use const LOCK_EX;

final readonly class RouteCache
{
    public function __construct(
        private RouteCollector $collector,
    ) {}

    public function read(string $file): RouteList
    {
        invariant(is_file($file), "Cache does not exist: {$file}");

        $contents = file_get_contents($file);

        invariant(is_string($contents), "Failed to read cache: {$file}");

        return instance_of(RouteList::class)->assert(unserialize($contents));
    }

    public function write(string $source, string $file): void
    {
        $directory = dirname($file);

        invariant(
            is_dir($directory) || mkdir($directory, permissions: 0o755, recursive: true),
            "Cache directory does not exist: {$directory}",
        );

        $routes = new RouteList(...values($this->collector->in($source)));

        invariant(
            file_put_contents($file, serialize($routes), flags: LOCK_EX) !== false,
            "Failed to write cache: {$file}",
        );
    }
}
