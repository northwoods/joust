<?php

declare(strict_types=1);

namespace Northwoods\Joust;

use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

use function Psl\Type\class_string;

/**
 * @api
 */
final readonly class RouteHandler
{
    /**
     * @phpstan-assert class-string<RequestHandlerInterface> $name
     */
    public function __construct(
        public string $name,
    ) {
        class_string(RequestHandlerInterface::class)->assert($this->name);
    }

    public function resolve(ContainerInterface $container): RequestHandlerInterface
    {
        // @mago-expect analysis:mixed-return-statement
        return $container->get($this->name);
    }
}
