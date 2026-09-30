<?php

declare(strict_types=1);

namespace Northwoods\Joust;

use League\Uri\UriTemplate;
use Override;

use function Psl\Type\instance_of;
use function Psl\Type\vec;

final readonly class Route implements RouteInterface
{
    public function __construct(
        /** @var list<Method> */
        private iterable $methods,
        private UriTemplate $template,
        private RouteHandler $handler,
    ) {
        vec(instance_of(Method::class))->assert($this->methods);
    }

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
