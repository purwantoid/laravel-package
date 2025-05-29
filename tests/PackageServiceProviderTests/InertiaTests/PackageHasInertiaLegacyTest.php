<?php

namespace Purwantoid\LaravelPackage\Tests\PackageServiceProviderTests\InertiaTests;

use Purwantoid\LaravelPackage\Package;

trait PackageHasInertiaLegacyTest
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-package-tools')
            ->hasInertiaComponents();
    }
}

uses(PackageHasInertiaLegacyTest::class);

it('can publish the default inertia components with legacy hasInertiaComponents', function (): void {
    $file = resource_path('js/Pages/PackageTools/inertia.js');
    expect($file)->not->toBeFileOrDirectory();

    $this
        ->artisan('vendor:publish --tag=package-tools-inertia-components')
        ->assertSuccessful();

    expect($file)->toBeFile();
})->group('inertia', 'legacy');
