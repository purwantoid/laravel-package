<?php

namespace Purwantoid\LaravelPackage\Tests\PackageServiceProviderTests\BladeComponentsTests;

use Purwantoid\LaravelPackage\Package;
use Purwantoid\LaravelPackage\Tests\TestPackage\Src\Components\TestComponent;
use Purwantoid\LaravelPackage\Tests\TestPackage\Src\Components\TestComponentTwo;

trait PackageHasViewComponentsLegacyTest
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-package-tools')
            ->hasViews()
            ->hasViewComponent(prefix: 'abc', viewComponentName: TestComponent::class)
            ->hasViewComponents('abc', TestComponentTwo::class);
    }
}

uses(PackageHasViewComponentsLegacyTest::class);

it('can load multiple blade components by legacy hasViewComponents', function (): void {
    $content = view('package-tools::component-test-two')->render();

    expect($content)->toStartWith('<div>hello mars</div>');
})->group('blade', 'blade-components', 'legacy');

it('can publish multiple blade components by legacy hasViewComponents', function (): void {
    $file = app_path('View/Components/vendor/package-tools/TestComponent.php');
    expect($file)->not->toBeFileOrDirectory();

    $this
        ->artisan('vendor:publish --tag=laravel-package-tools-components')
        ->assertSuccessful();

    expect($file)->toBeFile();
})->group('blade', 'blade-components', 'legacy');
