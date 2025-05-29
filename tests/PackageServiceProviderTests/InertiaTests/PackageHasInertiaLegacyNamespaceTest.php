<?php

namespace Purwantoid\LaravelPackage\Tests\PackageServiceProviderTests\InertiaTests;

use Purwantoid\LaravelPackage\Package;

trait PackageHasInertiaLegacyNamespaceTest
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-package-tools')
            ->hasInertiaComponents('my-inertia');
    }
}

uses(PackageHasInertiaLegacyNamespaceTest::class);

it('can publish the default inertia components with alternate namespace using legacy hasInertiaComponents', function (): void {
    $file = resource_path('js/Pages/MyInertia/inertia.js');
    expect($file)->not->toBeFileOrDirectory();

    $this
        ->artisan('vendor:publish --tag=my-inertia-inertia-components')
        ->assertSuccessful();

    expect($file)->toBeFile();
})->group('inertia', 'legacy');
