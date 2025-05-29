<?php

namespace Purwantoid\LaravelPackage\Tests\PackageServiceProviderTests\CommandsTests;

use Purwantoid\LaravelPackage\Package;
use Purwantoid\LaravelPackage\Tests\TestPackage\Src\Commands\FourthTestCommand;
use Purwantoid\LaravelPackage\Tests\TestPackage\Src\Commands\OtherTestCommand;
use Purwantoid\LaravelPackage\Tests\TestPackage\Src\Commands\TestCommand;
use Purwantoid\LaravelPackage\Tests\TestPackage\Src\Commands\ThirdTestCommand;

trait PackageHasCommandsLegacyTest
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-package-tools')
            ->hasRoute('web')
            ->hasCommand(commandClassName: TestCommand::class)
            ->hasCommands([OtherTestCommand::class])
            ->hasCommands(ThirdTestCommand::class, FourthTestCommand::class);
    }
}

uses(PackageHasCommandsLegacyTest::class);

it('can register and execute Commands loaded by hasCommands', function (): void {
    $this
        ->artisan('package-tools:test-command')
        ->assertSuccessful()
        ->expectsOutput('output of test command');

    $this
        ->artisan('package-tools:other-test-command')
        ->assertSuccessful()
        ->expectsOutput('output of other test command');
})->group('commands', 'legacy');

it('can register & execute a legacy Command loaded by class name as part of a web transaction', function (): void {
    $response = $this->get('execute-command');

    expect($response->baseResponse->getStatusCode())->toBe(200);
    expect($response->baseResponse->getContent())->toContain('output of test command');
})->group('commands', 'legacy');
