<?php

namespace Purwantoid\LaravelPackage\Tests\PackageServiceProviderTests\InstallCommandTests;

use Purwantoid\LaravelPackage\Commands\InstallCommand;
use Purwantoid\LaravelPackage\Package;

trait InstallerConfigFileLegacyTest
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-package-tools')
            ->hasConfigFile()
            ->hasInstallCommand(function (InstallCommand $command): void {
                $command->publishConfigFile();
            });
    }
}

uses(InstallerConfigFileLegacyTest::class);

it('can install the config file', function (): void {
    $configFile = config_path('package-tools.php');
    expect($configFile)->not->toBeFileOrDirectory();

    $this
        ->artisan('package-tools:install')
        ->assertSuccessful();

    expect($configFile)->toBeFile();
})->group('installer', 'legacy');
