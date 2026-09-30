<?php

declare(strict_types=1);

namespace Northwoods\Joust\Attribute;

use Attribute;
use League\Uri\UriTemplate;
use Northwoods\Joust\Method;

use function is_string;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final readonly class AsRoute
{
    public Method $method;
    public UriTemplate $template;

    /**
     * @param Method|non-empty-string $method
     * @param UriTemplate|string $template
     */
    public function __construct(Method|string $method = Method::Get, UriTemplate|string $template = '/')
    {
        $this->method = is_string($method) ? Method::from($method) : $method;
        $this->template = is_string($template) ? new UriTemplate($template) : $template;
    }
}
