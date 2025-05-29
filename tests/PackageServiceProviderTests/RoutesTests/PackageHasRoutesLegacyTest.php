<?php

namespace Purwantoid\LaravelPackage\Tests\PackageServiceProviderTests\RoutesTests;

use Purwantoid\LaravelPackage\Package;

use function Pest\Laravel\get;

trait PackageHasRoutesLegacyTest
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-package-tools')
            ->hasRoute(routeFileName: 'web');
    }
}

uses(PackageHasRoutesLegacyTest::class);

it('can load the legacy route', function (): void {
    $response = get('my-route');

    $response->assertSeeText('my response');
})->group('routes', 'legacy');
