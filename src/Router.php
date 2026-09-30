<?php

declare(strict_types=1);

namespace Northwoods\Joust;

use League\Uri\UriTemplate\ExtractionResult;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @api
 */
final readonly class Router
{
    public function __construct(
        private RouteList $routes,
        private RouteInterface $notFound = new Handler\NotFoundRoute(),
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

        return new RouterResult($this->notFound, ExtractionResult::empty());
    }
}
