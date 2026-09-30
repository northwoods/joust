<?php

declare(strict_types=1);

namespace Northwoods\Joust\Response;

/**
 * @api
 */
final readonly class JsonResponseSettings
{
    public function __construct(
        public string $contentType = 'application/json',
        public string $charset = 'utf-8',
        public bool $pretty = false,
        public int $flags = 0,
    ) {}
}
