<?php

declare(strict_types=1);

namespace Purwantoid\LaravelPackage;

use Illuminate\Support\ServiceProvider;
use Purwantoid\LaravelPackage\Concerns\PackageServiceProvider\ProcessAssets;
use Purwantoid\LaravelPackage\Concerns\PackageServiceProvider\ProcessBladeComponents;
use Purwantoid\LaravelPackage\Concerns\PackageServiceProvider\ProcessCommands;
use Purwantoid\LaravelPackage\Concerns\PackageServiceProvider\ProcessConfigs;
use Purwantoid\LaravelPackage\Concerns\PackageServiceProvider\ProcessInertia;
use Purwantoid\LaravelPackage\Concerns\PackageServiceProvider\ProcessMigrations;
use Purwantoid\LaravelPackage\Concerns\PackageServiceProvider\ProcessRoutes;
use Purwantoid\LaravelPackage\Concerns\PackageServiceProvider\ProcessServiceProviders;
use Purwantoid\LaravelPackage\Concerns\PackageServiceProvider\ProcessTranslations;
use Purwantoid\LaravelPackage\Concerns\PackageServiceProvider\ProcessViewComposers;
use Purwantoid\LaravelPackage\Concerns\PackageServiceProvider\ProcessViews;
use Purwantoid\LaravelPackage\Concerns\PackageServiceProvider\ProcessViewSharedData;
use Purwantoid\LaravelPackage\Exceptions\InvalidPackage;
use ReflectionClass;

abstract class PackageServiceProvider extends ServiceProvider
{
    use ProcessAssets;
    use ProcessBladeComponents;
    use ProcessCommands;
    use ProcessConfigs;
    use ProcessInertia;
    use ProcessMigrations;
    use ProcessRoutes;
    use ProcessServiceProviders;
    use ProcessTranslations;
    use ProcessViewComposers;
    use ProcessViews;
    use ProcessViewSharedData;

    protected Package $package;

    abstract public function configurePackage(Package $package): void;

    /** @throws InvalidPackage */
    public function register()
    {
        $this->registeringPackage();

        $this->package = $this->newPackage();
        $this->package->setBasePath($this->getPackageBaseDir());

        $this->configurePackage($this->package);
        if (! isset($this->package->name) || ($this->package->name === '' || $this->package->name === '0')) {
            throw InvalidPackage::nameIsRequired();
        }

        $this->registerPackageConfigs();

        $this->packageRegistered();

        return $this;
    }

    public function registeringPackage(): void {}

    public function newPackage(): Package
    {
        return new Package();
    }

    public function packageRegistered(): void {}

    public function boot()
    {
        $this->bootingPackage();

        $this
            ->bootPackageAssets()
            ->bootPackageBladeComponents()
            ->bootPackageCommands()
            ->bootPackageConsoleCommands()
            ->bootPackageConfigs()
            ->bootPackageInertia()
            ->bootPackageMigrations()
            ->bootPackageRoutes()
            ->bootPackageServiceProviders()
            ->bootPackageTranslations()
            ->bootPackageViews()
            ->bootPackageViewComposers()
            ->bootPackageViewSharedData()
            ->packageBooted();

        return $this;
    }

    public function bootingPackage(): void {}

    public function packageBooted(): void {}

    public function packageView(?string $namespace): ?string
    {
        return is_null($namespace)
            ? $this->package->shortName()
            : $this->package->viewNamespace;
    }

    protected function getPackageBaseDir(): string
    {
        $reflector = new ReflectionClass(static::class);

        $packageBaseDir = dirname($reflector->getFileName());

        // Some packages like to keep Laravels directory structure and place
        // the service providers in a Providers folder.
        // move up a level when this is the case.
        if (str_ends_with($packageBaseDir, DIRECTORY_SEPARATOR . 'Providers')) {
            return dirname($packageBaseDir);
        }

        return $packageBaseDir;
    }
}
