<?php

namespace Purwantoid\LaravelPackage\Tests\PackageServiceProviderTests\_BasicTests;

use Purwantoid\LaravelPackage\Package;

trait PackageNameLegacyTest
{
    public function configurePackage(Package $package): void
    {
        $package->name(name: 'laravel-package-tools');
    }
}

uses(PackageNameLegacyTest::class);

it('will not blow up when a name is set', function (): void {
    expect(true)->toBeTrue();
})->group('base', 'legacy');
