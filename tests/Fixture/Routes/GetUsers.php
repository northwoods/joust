<?php

declare(strict_types=1);

namespace Northwoods\Joust\Tests\Fixture\Routes;

use LogicException;
use Northwoods\Joust\Attribute\AsRoute;
use Northwoods\Joust\Method;
use Override;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

#[AsRoute(Method::Get, '/users')]
final class GetUsers implements RequestHandlerInterface
{
    #[Override]
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        throw new LogicException('Not implemented.');
    }
}
