<?php

declare(strict_types=1);

namespace Northwoods\Joust;

use Psr\Http\Message\RequestInterface;

use function Psl\Str\Byte\uppercase;

/**
 * @api
 */
enum Method: string
{
    case Get = 'GET';
    case Head = 'HEAD';
    case Post = 'POST';
    case Put = 'PUT';
    case Delete = 'DELETE';
    case Connect = 'CONNECT';
    case Options = 'OPTIONS';
    case Trace = 'TRACE';
    case Patch = 'PATCH';

    public static function fromRequest(RequestInterface $request): self
    {
        return self::from(uppercase($request->getMethod()));
    }
}
