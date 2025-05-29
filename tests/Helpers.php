<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Generic Helpers
|--------------------------------------------------------------------------
*/

use Purwantoid\LaravelPackage\Tests\SimpleTime;

function is_before_laravel_version(string $actualVersion, string $minVersion): bool
{
    return version_compare($actualVersion, $minVersion) < 0;
}

function message_before_laravel_version(string $minVersion, ?string $method = ''): string
{
    return "LaravelPackageTools '$method' functionality not available until Laravel v" . $minVersion;
}

function testTime(): SimpleTime
{
    return new SimpleTime();
}
