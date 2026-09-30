<?php

declare(strict_types=1);

namespace Joust;

use League\Uri\UriTemplate;

/**
 * @api
 */
interface RouteInterface
{
    public function method(): Method;

    public function template(): UriTemplate;

    public function handler(): RouteHandler;
}
