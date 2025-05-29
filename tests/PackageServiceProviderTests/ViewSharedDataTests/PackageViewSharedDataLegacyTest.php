<?php

namespace Purwantoid\LaravelPackage\Tests\PackageServiceProviderTests\ViewSharedDataTests;

use Purwantoid\LaravelPackage\Package;

trait PackageViewSharedDataLegacyTest
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-package-tools')
            ->hasViews()
            ->sharesDataWithAllViews(name: 'sharedItemTest', value: 'hello_world');
    }
}

uses(PackageViewSharedDataLegacyTest::class);

it('can share data with all views', function (): void {
    $content1 = view('package-tools::shared-data')->render();
    $content2 = view('package-tools::shared-data-2')->render();

    expect($content1)->toStartWith('hello_world')
        ->and($content2)->toStartWith('hello_world');
})->group('shareddata', 'legacy');
