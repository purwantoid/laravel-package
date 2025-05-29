<?php

declare(strict_types=1);

namespace Purwantoid\LaravelPackage\Exceptions;

use Exception;

final class InvalidPackage extends Exception
{
    public static function nameIsRequired(): self
    {
        return new self('This package does not have a name. You can set one with `$package->name("yourName")`');
    }
}
