<?php

namespace Purwantoid\LaravelPackage\Tests\PackageServiceProviderTests\InstallCommandTests;

use Purwantoid\LaravelPackage\Commands\InstallCommand;
use Purwantoid\LaravelPackage\Package;

trait InstallerStarRepoLegacyTest
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-package-tools')
            ->hasConfigFile()
            ->hasInstallCommand(function (InstallCommand $command): void {
                $command->askToStarRepoOnGitHub('spatie/spatie.be');
            });
    }
}

uses(InstallerStarRepoLegacyTest::class);

it('can propose to star the repo', function (): void {
    $this
        ->artisan('package-tools:install')
        ->assertSuccessful()
        ->expectsConfirmation('Would you like to star our repo on GitHub?');
})->group('installer', 'legacy');
