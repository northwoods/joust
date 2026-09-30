<?php

declare(strict_types=1);

namespace Northwoods\Joust\Handler;

use League\Uri\UriTemplate;
use Northwoods\Joust\Method;
use Northwoods\Joust\RouteHandler;
use Northwoods\Joust\RouteInterface;
use Override;

final class NotFoundRoute implements RouteInterface
{
    #[Override]
    public function methods(): iterable
    {
        return Method::cases();
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
