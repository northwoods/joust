<?php

declare(strict_types=1);

namespace Northwoods\Joust\Response;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;

use function Psl\Json\encode;

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

    public function respond(int $status = 200, mixed $data = []): ResponseInterface
    {
        $stream = $this->streamFactory->createStream(encode($data, $this->settings->pretty, $this->settings->flags));

        return $this->responseFactory
            ->createResponse($status)
            ->withHeader('Content-Type', $this->settings->header)
            ->withBody($stream);
    }
}
