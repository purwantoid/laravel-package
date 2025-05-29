<?php

namespace Purwantoid\LaravelPackage\Tests\PackageServiceProviderTests\AssetsTests;

use Purwantoid\LaravelPackage\Package;

trait PackageHasAssetsLegacyTest
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-package-tools')
            ->hasAssets();
    }
}

uses(PackageHasAssetsLegacyTest::class);

it('can publish the assets', function (): void {
    $file = public_path('vendor/package-tools/dummy.js');
    expect($file)->not->toBeFileOrDirectory();

    $this
        ->artisan('vendor:publish --tag=package-tools-assets')
        ->assertSuccessful();

    expect($file)->toBeFile();
})->group('assets', 'legacy');
