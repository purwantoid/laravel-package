<?php

declare(strict_types=1);

namespace Purwantoid\LaravelPackage;

use Illuminate\Support\Str;
use Purwantoid\LaravelPackage\Concerns\Package\HasAssets;
use Purwantoid\LaravelPackage\Concerns\Package\HasBladeComponents;
use Purwantoid\LaravelPackage\Concerns\Package\HasCommands;
use Purwantoid\LaravelPackage\Concerns\Package\HasConfigs;
use Purwantoid\LaravelPackage\Concerns\Package\HasInertia;
use Purwantoid\LaravelPackage\Concerns\Package\HasInstallCommand;
use Purwantoid\LaravelPackage\Concerns\Package\HasMigrations;
use Purwantoid\LaravelPackage\Concerns\Package\HasRoutes;
use Purwantoid\LaravelPackage\Concerns\Package\HasServiceProviders;
use Purwantoid\LaravelPackage\Concerns\Package\HasTranslations;
use Purwantoid\LaravelPackage\Concerns\Package\HasViewComposers;
use Purwantoid\LaravelPackage\Concerns\Package\HasViews;
use Purwantoid\LaravelPackage\Concerns\Package\HasViewSharedData;

class Package
{
    use HasAssets;
    use HasBladeComponents;
    use HasCommands;
    use HasConfigs;
    use HasInertia;
    use HasInstallCommand;
    use HasMigrations;
    use HasRoutes;
    use HasServiceProviders;
    use HasTranslations;
    use HasViewComposers;
    use HasViews;
    use HasViewSharedData;

    public string $name;

    public string $basePath;

    public function name(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function shortName(): string
    {
        return Str::after($this->name, 'laravel-');
    }

    public function basePath(?string $directory = null): string
    {
        if ($directory === null) {
            return $this->basePath;
        }

        return $this->basePath . DIRECTORY_SEPARATOR . ltrim($directory, DIRECTORY_SEPARATOR);
    }

    public function setBasePath(string $path): static
    {
        $this->basePath = $path;

        return $this;
    }
}
