<?php

namespace Purwantoid\LaravelPackage\Tests\PackageServiceProviderTests\InstallCommandTests;

use Purwantoid\LaravelPackage\Commands\InstallCommand;
use Purwantoid\LaravelPackage\Package;

trait InstallerStartWithLegacyTest
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-package-tools')
            ->hasConfigFile()
            ->hasInstallCommand(function (InstallCommand $command): void {
                $command->startWith(function (InstallCommand $installCommand): void {
                    $this->stringFromStart = "set by {$installCommand->getName()}";
                });
            });
    }
}

uses(InstallerStartWithLegacyTest::class);

beforeEach(function (): void {
    $this->stringFromStart = '';
});

it('can execute the start with', function (): void {
    $this
        ->artisan('package-tools:install')
        ->assertSuccessful();

    expect($this->stringFromStart)->toBe('set by package-tools:install');
})->group('installer', 'legacy');
