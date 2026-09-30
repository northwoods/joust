<?php

declare(strict_types=1);

namespace Joust\Handler;

use Joust\Method;
use Joust\RouteHandler;
use Joust\RouteInterface;
use League\Uri\UriTemplate;
use LogicException;
use Override;

/**
 * @api
 */
final readonly class NotFoundRoute implements RouteInterface
{
    #[Override]
    public function method(): Method
    {
        throw new LogicException('Route applies to any method');
    }

    #[Override]
    public function template(): UriTemplate
    {
        throw new LogicException('Route applies to any path');
    }

    #[Override]
    public function handler(): RouteHandler
    {
        return new RouteHandler(NotFoundHandler::class);
    }
}
