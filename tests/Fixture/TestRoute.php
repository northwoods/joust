<?php

declare(strict_types=1);

namespace Joust\Tests\Fixture;

use Joust\Method;
use Joust\RouteHandler;
use Joust\RouteInterface;
use League\Uri\UriTemplate;
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
