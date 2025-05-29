<?php

declare(strict_types=1);

namespace Purwantoid\LaravelPackage\Tests;

use Carbon\Carbon;
use Purwantoid\LaravelPackage\Tests\TestTime as BaseTestTime;

class SimpleTime
{
    public function __call($name, $arguments)
    {
        return BaseTestTime::$name(...$arguments);
    }

    public function freeze(?string $time = null, string $format = 'Y-m-d H:i:s'): Carbon
    {
        if ($time === null) {
            $format = null;
        }

        return BaseTestTime::freeze($format, $time);
    }
}
