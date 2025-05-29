<?php

namespace Purwantoid\LaravelPackage\Tests\PackageServiceProviderTests\_BasicTests;

use Purwantoid\LaravelPackage\Exceptions\InvalidPackage;
use Purwantoid\LaravelPackage\Package;

trait PackageNameNotProvidedTest
{
    public function configurePackage(Package $package): void
    {
        //
    }
}

uses(PackageNameNotProvidedTest::class);

it('will throw an exception when a name is NOT set')
    ->group('base', 'legacy')
    ->throws(InvalidPackage::class, 'This package does not have a name. You can set one with `$package->name("yourName")`');
