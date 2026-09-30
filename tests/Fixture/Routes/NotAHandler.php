<?php

declare(strict_types=1);

namespace Joust\Tests\Fixture\Routes;

use Joust\Attribute\AsRoute;

/**
 * Carries a route attribute but is not a request handler, so it must be skipped.
 */
#[AsRoute]
final class NotAHandler {}
