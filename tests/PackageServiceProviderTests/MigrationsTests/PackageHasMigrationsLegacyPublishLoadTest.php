<?php

namespace Purwantoid\LaravelPackage\Tests\PackageServiceProviderTests\MigrationsTests;

use Purwantoid\LaravelPackage\Package;

trait PackageHasMigrationsLegacyPublishLoadTest
{
    public function configurePackage(Package $package): void
    {
        testTime()->freeze('2020-01-01 00:00:00');

        $package
            ->name('laravel-package-tools')
            ->hasMigration(migrationFileName: 'create_table_explicit_normal')
            ->hasMigrations(
                'create_table_explicit_stub',
                'folder/create_table_subfolder_explicit_stub',
                'folder/create_table_subfolder_explicit_normal',
            )
            ->hasMigration(migrationFileName: '2025_03_14_011123_create_laravel_package_tools_table_stub')
            ->runsMigrations();
    }
}

uses(PackageHasMigrationsLegacyPublishLoadTest::class);

$expectPublished = [
    'create_table_explicit_normal',
    'create_table_explicit_stub',
    'folder/create_table_subfolder_explicit_normal',
    'folder/create_table_subfolder_explicit_stub',
    'create_laravel_package_tools_table_stub',
];
$expectLoaded = [
    '2025_03_14_011123_create_laravel_package_tools_table_stub',
    'create_table_explicit_normal',
    'create_table_explicit_stub',
    'folder/create_table_subfolder_explicit_normal',
    'folder/create_table_subfolder_explicit_stub',
    'create_laravel_package_tools_table_stub',
];

it('publishes only the explicitly listed migrations', function () use ($expectPublished): void {
    $this
        ->artisan('vendor:publish --tag=package-tools-migrations')
        ->assertSuccessful();

    expect(__DIR__ . '/../../TestPackage/database/migrations')->toHaveExpectedMigrationsPublished($expectPublished)
        ->and(__DIR__ . '/../../TestPackage/database/migrations')->toHaveOnlyExpectedMigrationsPublished($expectPublished);
})->group('migrations', 'legacy');

it("doesn't overwrite an existing migration", function (): void {
    $this
        ->artisan('vendor:publish --tag=package-tools-migrations')
        ->assertSuccessful();

    $filePath = database_path('migrations/2020_01_01_000001_create_table_explicit_normal.php');

    expect(true)->toHaveExpectedMigrationsPublished('2020_01_01_000001_create_table_explicit_normal');

    file_put_contents($filePath, 'modified');

    $this
        ->artisan('vendor:publish --tag=package-tools-migrations')
        ->assertSuccessful();

    expect($filePath)->toHaveContentsMatching('modified');
})->group('migrations', 'legacy');

it("does overwrite an existing migration with 'artisan migrate --force'", function (): void {
    $this
        ->artisan('vendor:publish --tag=package-tools-migrations')
        ->assertSuccessful();

    expect(true)->toHaveExpectedMigrationsPublished('2020_01_01_000001_create_table_explicit_normal');

    $filePath = database_path('migrations/2020_01_01_000001_create_table_explicit_normal.php');

    file_put_contents($filePath, 'overwritten');

    $this
        ->artisan('vendor:publish --tag=package-tools-migrations  --force')
        ->assertSuccessful();

    expect($filePath)->toHaveContentsMatchingFile(__DIR__ . '/../../TestPackage/database/migrations/create_table_explicit_normal.php');
})->group('migrations', 'legacy');

it("loads only the explicitly listed non-stub migrations for 'artisan migrate'", function () use ($expectLoaded): void {
    $this
        ->artisan('vendor:publish --tag=package-tools-migrations')
        ->assertSuccessful();

    expect(__DIR__ . '/../../TestPackage/database/migrations')->toHaveExpectedMigrationsLoaded($expectLoaded)
        ->and(__DIR__ . '/../../TestPackage/database/migrations')->toHaveOnlyExpectedMigrationsLoaded($expectLoaded);
})->group('migrations', 'legacy');
