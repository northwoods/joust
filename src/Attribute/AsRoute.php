<?php

declare(strict_types=1);

namespace Northwoods\Joust\Attribute;

use Attribute;
use League\Uri\UriTemplate;
use Northwoods\Joust\Method;

use function is_array;
use function Psl\Vec\map;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final readonly class AsRoute
{
    /** @var list<Method> */
    public array $methods;
    public UriTemplate $template;

    /**
     * @param array<Method|non-empty-string>|Method|non-empty-string $methods
     * @param UriTemplate|string $template
     */
    public function __construct(array|Method|string $methods = [Method::Get], UriTemplate|string $template = '/')
    {
        if (!is_array($methods)) {
            $methods = [$methods];
        }

        $this->methods = map($methods, self::normalizeMethod(...));
        $this->template = self::normalizeTemplate($template);
    }

    private static function normalizeMethod(Method|string $method): Method
    {
        if ($method instanceof Method) {
            return $method;
        }

        return Method::from($method);
    }

    private static function normalizeTemplate(UriTemplate|string $template): UriTemplate
    {
        if ($template instanceof UriTemplate) {
            return $template;
        }

        return new UriTemplate($template);
    }
}
