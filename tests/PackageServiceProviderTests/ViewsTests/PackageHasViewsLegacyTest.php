<?php

namespace Purwantoid\LaravelPackage\Tests\PackageServiceProviderTests\ViewsTests;

use Purwantoid\LaravelPackage\Package;

trait PackageHasViewsLegacyTest
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-package-tools')
            ->hasViews();
    }
}

uses(PackageHasViewsLegacyTest::class);

it('can load default views', function (): void {
    $content = view('package-tools::test')->render();

    expect($content)->toStartWith('This is a blade view');
})->group('views', 'legacy');

it('can publish default views', function (): void {
    $file = resource_path('views/vendor/package-tools/test.blade.php');
    expect($file)->not->toBeFileOrDirectory();

    $this
        ->artisan('vendor:publish --tag=package-tools-views')
        ->assertSuccessful();

    expect($file)->toBeFile();
})->group('views', 'legacy');
