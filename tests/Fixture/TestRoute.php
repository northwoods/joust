<?php

declare(strict_types=1);

namespace Northwoods\Joust\Tests\Fixture;

use League\Uri\UriTemplate;
use Northwoods\Joust\Method;
use Northwoods\Joust\Route;
use Northwoods\Joust\RouteHandler;
use Override;

final readonly class TestRoute implements Route
{
    /**
     * @param list<Method> $methods
     */
    public function __construct(
        private array $methods,
        private UriTemplate $template,
        private RouteHandler $handler,
    ) {}

    #[Override]
    public function methods(): iterable
    {
        return $this->methods;
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
