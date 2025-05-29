<?php

namespace Purwantoid\LaravelPackage\Tests\PackageServiceProviderTests\CommandsTests;

use Purwantoid\LaravelPackage\Package;
use Purwantoid\LaravelPackage\Tests\TestPackage\Src\Commands\FourthTestCommand;
use Purwantoid\LaravelPackage\Tests\TestPackage\Src\Commands\OtherTestCommand;
use Purwantoid\LaravelPackage\Tests\TestPackage\Src\Commands\TestCommand;
use Purwantoid\LaravelPackage\Tests\TestPackage\Src\Commands\ThirdTestCommand;

trait PackageHasConsoleCommandsLegacyTest
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-package-tools')
            ->hasConsoleCommand(commandClassName: TestCommand::class)
            ->hasConsoleCommands([OtherTestCommand::class])
            ->hasConsoleCommands(ThirdTestCommand::class, FourthTestCommand::class);
    }
}

uses(PackageHasConsoleCommandsLegacyTest::class);

it('can register and execute legacy Console Commands loaded by hasConsoleCommand', function (): void {
    $this
        ->artisan('package-tools:test-command')
        ->assertSuccessful()
        ->expectsOutput('output of test command');

    $this
        ->artisan('package-tools:other-test-command')
        ->assertSuccessful()
        ->expectsOutput('output of other test command');
})->group('commands', 'legacy');
