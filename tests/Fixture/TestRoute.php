<?php

declare(strict_types=1);

namespace Northwoods\Joust\Tests\Fixture;

use League\Uri\UriTemplate;
use Northwoods\Joust\Method;
use Northwoods\Joust\RouteHandler;
use Northwoods\Joust\RouteInterface;
use Override;

final readonly class TestRoute implements RouteInterface
{
    public function __construct(
        private Method $method,
        private UriTemplate $template,
        private RouteHandler $handler,
    ) {}

    #[Override]
    public function method(): Method
    {
        return $this->method;
    }

    #[Override]
    public function template(): UriTemplate
    {
        return $this->template;
    }

    #[Override]
    public function handler(): RouteHandler
    {
        return $this->handler;
    }
}
