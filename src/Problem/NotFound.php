<?php

declare(strict_types=1);

namespace Northwoods\Joust\Problem;

use Crell\ApiProblem\ApiProblem;

/**
 * @api
 */
final class NotFound extends ApiProblem
{
    protected string $title = 'Not Found';
    protected string $detail = 'Endpoint not found.';
    protected int $status = 404;
}
