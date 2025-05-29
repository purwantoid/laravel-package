<?php

namespace Purwantoid\LaravelPackage\Tests\PackageServiceProviderTests\MigrationsTests;

use Purwantoid\LaravelPackage\Package;

trait PackageDiscoversMigrationsLegacyAltPathPublishOnlyTest
{
    public function configurePackage(Package $package): void
    {
        testTime()->freeze('2020-01-01 00:00:00');

        $package
            ->name('laravel-package-tools')
            ->discoversMigrations(discoversMigrations: true, path: '/database/migrations_alt');
    }
}

uses(PackageDiscoversMigrationsLegacyAltPathPublishOnlyTest::class);

$expectPublished = [
    'create_table_alt_discover_normal',
    'create_table_alt_discover_stub',
    'create_table_alt_explicit_normal',
    'create_table_alt_explicit_stub',
    'alt_non_migration_text_file.txt',
];
$expectLoaded = [
];

it('publishes only migrations by discoversMigrations', function () use ($expectPublished): void {
    $this
        ->artisan('vendor:publish --tag=package-tools-migrations')
        ->assertSuccessful();

    expect(__DIR__ . '/../../TestPackage/database/migrations_alt')->toHaveExpectedMigrationsPublished($expectPublished)
        ->and(__DIR__ . '/../../TestPackage/database/migrations_alt')->toHaveOnlyExpectedMigrationsPublished($expectPublished);
})->group('migrations', 'legacy');

it('does not overwrite an existing migration by discoversMigrations', function (): void {
    $this
        ->artisan('vendor:publish --tag=package-tools-migrations')
        ->assertSuccessful();

    expect(true)->toHaveExpectedMigrationsPublished('2020_01_01_000001_create_table_alt_discover_normal');

    $filePath = database_path('migrations/2020_01_01_000001_create_table_alt_discover_normal');

    file_put_contents($filePath, 'modified');

    $this
        ->artisan('vendor:publish --tag=package-tools-migrations')
        ->assertSuccessful();

    expect($filePath)->toHaveContentsMatching('modified');
})->group('migrations', 'legacy');

it("loads only the discovered non-stub migrations by discoversMigrations for 'artisan migrate'", function () use ($expectLoaded): void {
    $this
        ->artisan('vendor:publish --tag=package-tools-migrations')
        ->assertSuccessful();

    expect(__DIR__ . '/../../TestPackage/database/migrations_alt')->toHaveExpectedMigrationsLoaded($expectLoaded)
        ->and(__DIR__ . '/../../TestPackage/database/migrations_alt')->toHaveOnlyExpectedMigrationsLoaded($expectLoaded);
})->group('migrations', 'legacy');
