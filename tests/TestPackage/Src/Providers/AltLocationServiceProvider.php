<?php

namespace Purwantoid\LaravelPackage\Tests\TestPackage\Src\Providers;

use Purwantoid\LaravelPackage\Package;
use Purwantoid\LaravelPackage\PackageServiceProvider;

class AltLocationServiceProvider extends PackageServiceProvider
{
    public function getPackageBaseDir(): string
    {
        return parent::getPackageBaseDir();
    }

    public function configurePackage(Package $package): void
    {
        $package->name('laravel-package-tools');
    }
}
