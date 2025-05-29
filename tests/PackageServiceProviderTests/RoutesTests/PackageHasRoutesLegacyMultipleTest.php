<?php

namespace Purwantoid\LaravelPackage\Tests\PackageServiceProviderTests\RoutesTests;

use Purwantoid\LaravelPackage\Package;

trait PackageHasRoutesLegacyMultipleTest
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-package-tools')
            ->hasRoutes('web', 'other');
    }
}

uses(PackageHasRoutesLegacyMultipleTest::class);

it('can load the legacy multiple routes', function (): void {
    $response = $this->get('my-route');
    $response->assertSeeText('my response');

    $adminResponse = $this->get('other-route');
    $adminResponse->assertSeeText('other response');
})->group('routes', 'legacy');
