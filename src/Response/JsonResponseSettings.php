<?php

declare(strict_types=1);

namespace Northwoods\Joust\Response;

final readonly class JsonResponseSettings
{
    public function __construct(
        public string $header = 'application/json; charset=utf-8',
        public bool $pretty = false,
        public int $flags = 0,
    ) {}
}
