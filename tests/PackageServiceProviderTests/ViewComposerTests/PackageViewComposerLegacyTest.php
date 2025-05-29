<?php

namespace Purwantoid\LaravelPackage\Tests\PackageServiceProviderTests\ViewComposerTests;

use Purwantoid\LaravelPackage\Package;

trait PackageViewComposerLegacyTest
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-package-tools')
            ->hasViews()
            ->hasViewComposer(view: '*', viewComposer: function ($view): void {
                $view->with('sharedItemTest', 'hello world');
            });
    }
}

uses(PackageViewComposerLegacyTest::class);

it('can load the view composer and render shared data', function (): void {
    $content = view('package-tools::shared-data')->render();

    expect($content)->toStartWith('hello world');
})->group('viewcomposer', 'legacy');
