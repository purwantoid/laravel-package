<?php

namespace Purwantoid\LaravelPackage\Tests\PackageServiceProviderTests\TranslationsTests;

use Purwantoid\LaravelPackage\Package;

trait PackageHasTranslationsLegacyTest
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-package-tools')
            ->hasTranslations();
    }
}

uses(PackageHasTranslationsLegacyTest::class);

it('can load the translations', function (): void {
    $this->assertEquals('translation', trans('package-tools::translations.translatable'));
})->group('translations', 'legacy');

it('can publish the translations', function (): void {
    $file = lang_path('vendor/package-tools/en/translations.php');
    expect($file)->not->toBeFileOrDirectory();

    $this
        ->artisan('vendor:publish --tag=package-tools-translations')
        ->assertSuccessful();

    expect($file)->toBeFile();
})->group('translations', 'legacy');
