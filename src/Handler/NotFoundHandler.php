<?php

declare(strict_types=1);

namespace Northwoods\Joust\Handler;

use Override;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Server\RequestHandlerInterface;

use function Psl\Json\encode;

final readonly class NotFoundHandler implements RequestHandlerInterface
{
    public function __construct(
        private ResponseFactoryInterface $responseFactory,
        private StreamFactoryInterface $streamFactory,
    ) {}

    #[Override]
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $body = $this->streamFactory->createStream(encode(['error' => 'NotFound']));

        return $this->responseFactory
            ->createResponse(404)
            ->withHeader('Content-Type', 'application/json')
            ->withBody($body);
    }
}
