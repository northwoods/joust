<?php

declare(strict_types=1);

namespace Northwoods\Joust;

use League\Uri\UriTemplate;

/**
 * @api
 */
interface Route
{
    /**
     * @return iterable<int, Method>
     */
    public function methods(): iterable;

    public function template(): UriTemplate;

    public function handler(): RouteHandler;
}
