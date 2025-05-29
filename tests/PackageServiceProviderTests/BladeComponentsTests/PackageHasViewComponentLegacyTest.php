<?php

namespace Purwantoid\LaravelPackage\Tests\PackageServiceProviderTests\BladeComponentsTests;

use Purwantoid\LaravelPackage\Package;
use Purwantoid\LaravelPackage\Tests\TestPackage\Src\Components\TestComponent;

trait PackageHasViewComponentLegacyTest
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-package-tools')
            ->hasViews()
            ->hasViewComponent(prefix: 'abc', viewComponentName: TestComponent::class);
    }
}

uses(PackageHasViewComponentLegacyTest::class);

it('can load blade components using legacy hasViewComponent', function (): void {
    $content = view('package-tools::component-test')->render();

    expect($content)->toStartWith('<div>hello world</div>');
})->group('blade', 'blade-components', 'legacy');

it('can publish blade components by legacy hasViewComponent', function (): void {
    $file = app_path('View/Components/vendor/package-tools/TestComponent.php');
    expect($file)->not->toBeFileOrDirectory();

    $this
        ->artisan('vendor:publish --tag=laravel-package-tools-components')
        ->assertSuccessful();

    expect($file)->toBeFile();
})->group('blade', 'blade-components', 'legacy');
