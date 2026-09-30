<?php

declare(strict_types=1);

namespace Joust\Tests\Fixture;

use Override;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Records the request it receives and returns an empty 200 response.
 */
final class TestHandler implements RequestHandlerInterface
{
    public ?ServerRequestInterface $request = null;

    public function __construct(
        private readonly ResponseFactoryInterface $responseFactory,
    ) {}

    #[Override]
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->request = $request;

        return $this->responseFactory->createResponse(200);
    }
}
