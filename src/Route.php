<?php

declare(strict_types=1);

namespace Joust;

use League\Uri\UriTemplate;

/**
 * @api
 */
final readonly class Route
{
    public function __construct(
        public Method $method,
        public UriTemplate $template,
        public RouteHandler $handler,
    ) {}
}
