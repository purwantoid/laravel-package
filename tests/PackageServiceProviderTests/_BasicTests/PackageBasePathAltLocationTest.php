<?php

namespace Purwantoid\LaravelPackage\Tests\PackageServiceProviderTests\_BasicTests;

use Purwantoid\LaravelPackage\Package;
use Purwantoid\LaravelPackage\Tests\TestPackage\Src\Providers\AltLocationServiceProvider;

trait PackageBasePathAltLocationTest
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-package-tools');
    }
}

uses(PackageBasePathAltLocationTest::class);

it('will set the base path to the Src dir when the PackageServiceProvider is in an alternate location', function (): void {
    $provider = new AltLocationServiceProvider(app());
    expect($provider->getPackageBaseDir())->toEndWith(DIRECTORY_SEPARATOR . 'TestPackage' . DIRECTORY_SEPARATOR . 'Src');
})->group('base', 'legacy');
