<?php

namespace Purwantoid\LaravelPackage\Tests\PackageServiceProviderTests\InstallCommandTests;

use Purwantoid\LaravelPackage\Commands\InstallCommand;
use Purwantoid\LaravelPackage\Package;

trait InstallerAssetsLegacyTest
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-package-tools')
            ->hasAssets()
            ->hasInstallCommand(function (InstallCommand $command): void {
                $command->publishAssets();
            });
    }
}

uses(InstallerAssetsLegacyTest::class);

it('can install the assets', function (): void {
    $file = public_path('vendor/package-tools/dummy.js');
    expect($file)->not->toBeFileOrDirectory();

    $this
        ->artisan('package-tools:install')
        ->assertSuccessful();

    expect($file)->toBeFile();
})->group('installer', 'legacy');
