<?php

namespace Purwantoid\LaravelPackage\Tests\PackageServiceProviderTests\ConfigTests;

use Purwantoid\LaravelPackage\Package;

trait PackageHasConfigFileLegacyDefaultTest
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-package-tools')
            ->hasConfigFile();
    }
}

uses(PackageHasConfigFileLegacyDefaultTest::class);

it('registers only the default config file by legacy', function (): void {
    expect(config('package-tools.key'))->toBe('value');
})->group('config', 'legacy');

it('publishes only the default config file by legacy', function (): void {
    $publishedFiles = [
        config_path('package-tools.php'),
    ];
    $nonPublishedFiles = [
        config_path('alternative-config.php'),
        config_path('config-stub.php'),
        config_path('unpublished-config.php'),
        config_path('unpublished-stub.php'),
    ];
    expect($publishedFiles)->each->not->toBeFileOrDirectory()
        ->and($nonPublishedFiles)->each->not->toBeFileOrDirectory();

    $this
        ->artisan('vendor:publish --tag=package-tools-config')
        ->assertSuccessful();

    expect($publishedFiles)->each->toBeFile()
        ->and($nonPublishedFiles)->each->not->toBeFileOrDirectory();
})->group('config', 'legacy');
