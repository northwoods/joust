<?php

declare(strict_types=1);

namespace Northwoods\Joust\Handler;

use Northwoods\Joust\Response\JsonResponseFactory;
use Override;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final readonly class NotFoundHandler implements RequestHandlerInterface
{
    public function __construct(
        private JsonResponseFactory $jsonResponseFactory,
    ) {}

    #[Override]
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->jsonResponseFactory->respond(404, ['error' => 'NotFound']);
    }
}
