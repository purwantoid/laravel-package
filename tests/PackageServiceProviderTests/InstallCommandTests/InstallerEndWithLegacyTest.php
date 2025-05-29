<?php

namespace Purwantoid\LaravelPackage\Tests\PackageServiceProviderTests\InstallCommandTests;

use Purwantoid\LaravelPackage\Commands\InstallCommand;
use Purwantoid\LaravelPackage\Package;

trait InstallerEndWithLegacyTest
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-package-tools')
            ->hasConfigFile()
            ->hasInstallCommand(function (InstallCommand $command): void {
                $command->endWith(function (InstallCommand $installCommand): void {
                    $this->stringFromEnd = "set by {$installCommand->getName()}";
                });
            });
    }
}
uses(InstallerEndWithLegacyTest::class);

beforeEach(function (): void {
    $this->stringFromEnd = '';
});

it('can execute the end with', function (): void {
    $this
        ->artisan('package-tools:install')
        ->assertSuccessful();

    expect($this->stringFromEnd)->toBe('set by package-tools:install');
})->group('installer', 'legacy');
