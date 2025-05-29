<?php

namespace Purwantoid\LaravelPackage\Tests\PackageServiceProviderTests\MigrationsTests;

use Purwantoid\LaravelPackage\Package;

trait PackageDiscoversMigrationsLegacyResetTest
{
    public function configurePackage(Package $package): void
    {
        testTime()->freeze('2020-01-01 00:00:00');

        $package
            ->name('laravel-package-tools')
            ->discoversMigrations(discoversMigrations: true)
            ->discoversMigrations(discoversMigrations: false)
            ->runsMigrations();
    }
}

uses(PackageDiscoversMigrationsLegacyResetTest::class);

$expectPublished = [
];
$expectLoaded = [
];

it('publishes no migrations', function () use ($expectPublished): void {
    $this
        ->artisan('vendor:publish --tag=package-tools-migrations')
        ->assertSuccessful();

    expect(__DIR__ . '/../../TestPackage/database/migrations')->toHaveExpectedMigrationsPublished($expectPublished)
        ->and(__DIR__ . '/../../TestPackage/database/migrations')->toHaveOnlyExpectedMigrationsPublished($expectPublished);
})->group('migrations', 'legacy');

it("loads no non-stub migrations for 'artisan migrate'", function () use ($expectLoaded): void {
    $this
        ->artisan('vendor:publish --tag=package-tools-migrations')
        ->assertSuccessful();

    expect(__DIR__ . '/../../TestPackage/database/migrations')->toHaveExpectedMigrationsLoaded($expectLoaded)
        ->and(__DIR__ . '/../../TestPackage/database/migrations')->toHaveOnlyExpectedMigrationsLoaded($expectLoaded);
})->group('migrations', 'legacy');
