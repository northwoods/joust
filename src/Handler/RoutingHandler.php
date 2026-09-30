<?php

declare(strict_types=1);

namespace Joust\Handler;

use Joust\Router;
use Override;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * @api
 */
final readonly class RoutingHandler implements RequestHandlerInterface
{
    public function __construct(
        private ContainerInterface $container,
        private Router $router,
    ) {}

    #[Override]
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $result = $this->router->match($request);

        $handler = $result->route->handler->resolve($this->container);

        $request = $result->inject($request);

        return $handler->handle($request);
    }
}
