<?php

declare(strict_types=1);

namespace Joust;

use Joust\Handler\NotFoundHandler;
use League\Uri\UriTemplate;
use League\Uri\UriTemplate\ExtractionResult;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @api
 */
final readonly class Router
{
    public function __construct(
        private RouteList $routes,
        private ?RouteHandler $defaultHandler = null,
    ) {}

    public function match(ServerRequestInterface $request): RouterResult
    {
        $requestMethod = Method::fromRequest($request);
        $requestUri = (string) $request->getUri();

        foreach ($this->routes as $route) {
            if ($route->method() !== $requestMethod) {
                continue;
            }

            $result = $route->template()->extract($requestUri);

            if ($result->isSuccessful()) {
                return new RouterResult($route, $result);
            }
        }

        $requestHandler = $this->defaultHandler ?? new RouteHandler(NotFoundHandler::class);

        return new RouterResult(
            new Route($requestMethod, new UriTemplate($requestUri), $requestHandler),
            ExtractionResult::empty(),
        );
    }
}
