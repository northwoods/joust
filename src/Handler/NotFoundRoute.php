<?php

declare(strict_types=1);

namespace Northwoods\Joust\Handler;

use League\Uri\UriTemplate;
use Northwoods\Joust\Method;
use Northwoods\Joust\RouteHandler;
use Northwoods\Joust\RouteInterface;
use Override;

/**
 * @api
 */
final readonly class NotFoundRoute implements RouteInterface
{
    #[Override]
    public function method(): Method
    {
        return Method::Get;
    }

    #[Override]
    public function template(): UriTemplate
    {
        return new UriTemplate('/');
    }

    #[Override]
    public function handler(): RouteHandler
    {
        return new RouteHandler(NotFoundHandler::class);
    }
}
