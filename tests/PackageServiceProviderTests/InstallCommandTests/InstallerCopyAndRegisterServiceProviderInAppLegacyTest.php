<?php

namespace Purwantoid\LaravelPackage\Tests\PackageServiceProviderTests\InstallCommandTests;

use Purwantoid\LaravelPackage\Commands\InstallCommand;
use Purwantoid\LaravelPackage\Package;

trait InstallerCopyAndRegisterServiceProviderInAppLegacyTest
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-package-tools')
            ->hasConfigFile()
            ->publishesServiceProvider('MyPackageServiceProvider')
            ->hasInstallCommand(function (InstallCommand $command): void {
                $command->copyAndRegisterServiceProviderInApp();
            });
    }
}

uses(InstallerCopyAndRegisterServiceProviderInAppLegacyTest::class);

/*
 * If we leave the published config file in,
 * all subsequent tests will fail
 */
afterEach(function (): void {
    $file = config_path('app.php');
    $newContent = str_replace(
        'App\Providers\MyPackageServiceProvider::class,',
        '',
        file_get_contents($file)
    );

    file_put_contents($file, $newContent);
});

it('can copy and register the service provider in the app', function (): void {
    $this
        ->artisan('package-tools:install')
        ->assertSuccessful();

    if ((int) app()->version() < 11) {
        expect(base_path('config/app.php'))->toHaveContentsIncluding("App\Providers\MyPackageServiceProvider::class");
    }
})->group('installer', 'legacy');
