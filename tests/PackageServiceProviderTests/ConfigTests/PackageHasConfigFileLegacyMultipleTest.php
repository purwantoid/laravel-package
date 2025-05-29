<?php

namespace Purwantoid\LaravelPackage\Tests\PackageServiceProviderTests\ConfigTests;

use Purwantoid\LaravelPackage\Package;

trait PackageHasConfigFileLegacyMultipleTest
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-package-tools')
            ->hasConfigFile(['package-tools', 'alternative-config', 'config-stub']);
    }
}

uses(PackageHasConfigFileLegacyMultipleTest::class);

it('registers multiple config files by legacy', function (): void {
    expect(config('package-tools.key'))->toBe('value')
        ->and(config('alternative-config.alternative_key'))->toBe('alternative_value');
})->group('config', 'legacy');

it("doesn't register stub config files by legacy", function (): void {
    expect(config('config-stub.stub_key'))->toBe(null);
})->group('config', 'legacy');

it('publishes multiple config files by legacy', function (): void {
    $publishedFiles = [
        config_path('package-tools.php'),
        config_path('alternative-config.php'),
        config_path('config-stub.php'),
    ];
    $nonPublishedFiles = [
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
