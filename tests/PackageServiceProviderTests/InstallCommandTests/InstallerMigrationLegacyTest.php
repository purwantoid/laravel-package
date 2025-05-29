<?php

namespace Purwantoid\LaravelPackage\Tests\PackageServiceProviderTests\InstallCommandTests;

use Purwantoid\LaravelPackage\Commands\InstallCommand;
use Purwantoid\LaravelPackage\Package;

trait InstallerMigrationLegacyTest
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-package-tools')
            ->hasConfigFile()
            ->hasMigration('create_table_explicit_normal')
            ->hasInstallCommand(function (InstallCommand $command): void {
                $command->publishMigrations();
            });
    }
}

uses(InstallerMigrationLegacyTest::class);

it('can install the migrations', function (): void {
    $this
        ->artisan('package-tools:install')
        ->assertSuccessful();

    expect(true)->toHaveExpectedMigrationsPublished('create_table_explicit_normal');
})->group('installer', 'legacy');
