<?php

namespace Purwantoid\LaravelPackage\Tests\PackageServiceProviderTests\CommandsTests;

use Purwantoid\LaravelPackage\Package;
use Purwantoid\LaravelPackage\Tests\TestPackage\Src\Commands\TestCommand;

trait PackageHasCommandLegacyTest
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-package-tools')
            ->hasCommand(commandClassName: TestCommand::class);
    }
}

uses(PackageHasCommandLegacyTest::class);

it('can execute a registered commands', function (): void {
    $this
        ->artisan('package-tools:test-command')
        ->assertExitCode(0);
})->group('commands', 'legacy');
