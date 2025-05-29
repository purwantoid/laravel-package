<?php

namespace Purwantoid\LaravelPackage\Tests\PackageServiceProviderTests\CommandsTests;

use Purwantoid\LaravelPackage\Package;
use Purwantoid\LaravelPackage\Tests\TestPackage\Src\Commands\TestCommand;

trait PackageHasCommandWithinAppLegacyTest
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-package-tools')
            ->hasRoutes('web')
            ->hasCommand(TestCommand::class);
    }
}

uses(PackageHasCommandWithinAppLegacyTest::class);

it('can execute a registered command in the context of the app', function (): void {
    $response = $this->get('execute-command');

    $response->assertSee('output of test command');
});
