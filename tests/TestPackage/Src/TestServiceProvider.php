<?php

namespace Purwantoid\LaravelPackage\Tests\TestPackage\Src;

use Closure;
use Purwantoid\LaravelPackage\Exceptions\InvalidPackage;
use Purwantoid\LaravelPackage\Package;
use Purwantoid\LaravelPackage\PackageServiceProvider;

class TestServiceProvider extends PackageServiceProvider
{
    public static ?InvalidPackage $thrownException = null;

    public static ?Closure $configurePackageUsing = null;

    public static function reset(): void
    {
        static::$thrownException = null;
        static::$publishes = [];
        static::$publishGroups = [];

        if (function_exists('app') && method_exists(app(), 'version')) {
            if (version_compare(app()->version(), '11.27.1') >= 0) {
                static::$optimizeCommands = [];
                static::$optimizeClearCommands = [];
            }

            if (version_compare(app()->version(), '11') >= 0) {
                static::$publishableMigrationPaths = [];
            }
        }

    }

    public function configurePackage(Package $package): void
    {
        $configClosure = static::$configurePackageUsing ?? function (Package $package): void {};

        ($configClosure)($package);
    }

    /**
     * Handle exceptions in PackageServiceProvider generated during register or boot
     *
     * The first exception is stored so that the Pest testcase can replay it during test initiation
     **/
    public function register(): self
    {
        static::$thrownException = null;

        try {
            parent::register();
        } catch (InvalidPackage $e) {
            static::$thrownException = $e;
        }

        return $this;
    }

    public function boot(): self
    {
        // Do not run boot if there was an exception in register
        if (static::$thrownException instanceof InvalidPackage) {
            return $this;
        }

        try {
            parent::boot();
        } catch (InvalidPackage $e) {
            static::$thrownException = $e;
        }

        return $this;
    }
}
