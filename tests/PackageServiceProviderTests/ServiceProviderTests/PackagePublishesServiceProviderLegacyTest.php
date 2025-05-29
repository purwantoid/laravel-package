<?php

namespace Purwantoid\LaravelPackage\Tests\PackageServiceProviderTests\ServiceProviderTests;

use Purwantoid\LaravelPackage\Package;

trait PackagePublishesServiceProviderLegacyTest
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-package-tools')
            ->publishesServiceProvider(providerName: 'MyPackageServiceProvider');
    }
}

uses(PackagePublishesServiceProviderLegacyTest::class);

it('can publish a service provider', function (): void {
    $providerPath = app_path('Providers/MyPackageServiceProvider.php');

    expect($providerPath)->not->toBeFileOrDirectory();

    $this
        ->artisan('vendor:publish --tag=package-tools-provider')
        ->assertSuccessful();

    expect($providerPath)->toBeFile();
})->group('provider', 'legacy');
