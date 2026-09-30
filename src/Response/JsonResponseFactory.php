<?php

declare(strict_types=1);

namespace Northwoods\Joust\Response;

use Crell\ApiProblem\ApiProblem;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;

use function Psl\Json\encode;
use function Psl\Str\Byte\contains;

/**
 * @api
 */
final readonly class JsonResponseFactory
{
    public function __construct(
        private ResponseFactoryInterface $responseFactory,
        private StreamFactoryInterface $streamFactory,
        private JsonResponseSettings $settings = new JsonResponseSettings(),
    ) {}

    public function problem(ApiProblem $problem): ResponseInterface
    {
        return $this->respond($problem->getStatus(), $problem, ApiProblem::CONTENT_TYPE_JSON);
    }

    public function respond(int $status = 200, mixed $data = [], ?string $type = null): ResponseInterface
    {
        $type ??= $this->settings->contentType;

        if (!contains($type, needle: 'charset')) {
            $type = "{$type}; charset={$this->settings->charset}";
        }

        $response = $this->responseFactory->createResponse($status)->withHeader('Content-Type', $type);
        $stream = $this->streamFactory->createStream(encode($data, $this->settings->pretty, $this->settings->flags));

        return $response->withBody($stream);
    }
}
