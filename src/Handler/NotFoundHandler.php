<?php

declare(strict_types=1);

namespace Joust\Handler;

use Crell\ApiProblem\ApiProblem;
use Joust\Problem\NotFound;
use Joust\Response\JsonResponseFactory;
use Override;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * @api
 */
final readonly class NotFoundHandler implements RequestHandlerInterface
{
    public function __construct(
        private JsonResponseFactory $jsonResponseFactory,
        private ApiProblem $problem = new NotFound(),
    ) {}

    #[Override]
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->jsonResponseFactory->problem($this->problem);
    }
}
