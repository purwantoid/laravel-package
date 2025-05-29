<?php

namespace Purwantoid\LaravelPackage\Tests\PackageServiceProviderTests\InstallCommandTests;

use Purwantoid\LaravelPackage\Commands\InstallCommand;
use Purwantoid\LaravelPackage\Package;

trait InstallerAskToRunMigrationsLegacyTest
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-package-tools')
            ->hasConfigFile()
            ->hasInstallCommand(function (InstallCommand $command): void {
                $command->askToRunMigrations();
            });
    }
}

uses(InstallerAskToRunMigrationsLegacyTest::class);

it('can ask to run the migrations', function (): void {
    $this
        ->artisan('package-tools:install')
        ->assertSuccessful()
        ->expectsConfirmation('Would you like to run the migrations now?');
})->group('installer', 'legacy');
