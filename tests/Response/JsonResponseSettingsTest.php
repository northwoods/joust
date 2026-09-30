<?php

declare(strict_types=1);

namespace Northwoods\Joust\Tests\Response;

use Northwoods\Joust\Response\JsonResponseSettings;
use Northwoods\Joust\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;

use const JSON_INVALID_UTF8_IGNORE;

#[CoversClass(JsonResponseSettings::class)]
final class JsonResponseSettingsTest extends TestCase
{
    public function testDefaults(): void
    {
        $settings = new JsonResponseSettings();

        $this->assertSame('application/json; charset=utf-8', $settings->header);
        $this->assertFalse($settings->pretty);
        $this->assertSame(0, $settings->flags);
    }

    public function testCustomValues(): void
    {
        $settings = new JsonResponseSettings('application/vnd.api+json', true, JSON_INVALID_UTF8_IGNORE);

        $this->assertSame('application/vnd.api+json', $settings->header);
        $this->assertTrue($settings->pretty);
        $this->assertSame(JSON_INVALID_UTF8_IGNORE, $settings->flags);
    }
}
